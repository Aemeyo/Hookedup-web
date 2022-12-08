<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vtweb extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-gZXNb4JmB9VWfiE4Q6TYtfce', 'production' => false);
		$this->load->library('veritrans');
		$this->veritrans->config($params);
		$this->load->helper('url');

		
    }

	public function index()
	{
		$this->load->view('checkout_vtweb');
	}

	public function vtweb_checkout()
	{

		// echo "fsdssssxsd";
		$postdata= $this->input->post();
        
        $this->session->set_userdata('gross_amount',$postdata['gross_amount']);
		
        /*if($postdata['productdetail']=='wallet'){

            echo "hello";
		    $user  = $this->db->where('email', $postdata['email'])->get('users')->row_array();
            $amount        = $postdata['gross_amount'];
            $user_id       = $user['id'];
            $user_name     = $user['name'];
            $user_token    = $user['token'];
            $currency_type = $user['currency_code'];
            $usertType     = $user['type'];

            $wallet = $this->db->where('user_provider_id', $user_id)->where('type', 2)->get('wallet_table')->row_array();
            $wallet_amt = $wallet['wallet_amt'];

            $history_pay['token']=$user_token;
            $history_pay['user_provider_id']=$user_id;
            $history_pay['currency_code']= $user['currency_code'];
            $history_pay['credit_wallet'] = $amount;
            $history_pay['debit_wallet'] = 0;
            $history_pay['type']='1';
            $history_pay['transaction_id']= "";
            $history_pay['paid_status']='1';
            $history_pay['total_amt']=$amount;
            if($wallet_amt){
                $current_wallet = $wallet_amt+$amount;
            }else{
                $current_wallet = $amount;
            }
            $history_pay['current_wallet']=$current_wallet;
            $history_pay['avail_wallet'] = $current_wallet;
            $history_pay['reason']='Wallet Amount Added';
            $history_pay['payment_type']='midtrans';
            $history_pay['created_at']=date('Y-m-d H:i:s');
           $inserthis= $this->db->insert('wallet_transaction_history',$history_pay);
            // echo $this->db->last_query(); exit;

            if($this->db->affected_rows() > 0){ 
   
            $this->db->where('user_provider_id', $user_id)->update('wallet_table', array(
                    'currency_code' => $user['currency_code'],
                    'wallet_amt' => $current_wallet
                )); 
               // echo $this->db->last_query(); exit;                                           
            }
           

            
        }else{
        	$new_details = array();
            $stripe = array();
            $plan_id = explode('_', $postdata['order_id']);
            $subscription_id = $plan_id[1];
            $user  = $this->db->where('email', $postdata['email'])->get('providers')->row_array();
            $user_id       = $user['id'];

            $this->db->select('duration');
            $record = $this->db->get_where('subscription_fee',array('id'=>$subscription_id))->row_array();
               
            if(!empty($record)) {
                $duration = $record['duration'];
                $days = 30;
                switch ($duration) {
                    case 1:
                       $days = 30;
                        break;
                    case 2:
                       $days = 60;
                       break;
                    case 3:
                       $days = 90;
                       break;
                    case 6:
                       $days = 180;
                       break;
                    case 12:
                       $days = 365;
                       break;
                    case 24:
                       $days = 730;
                       break;

                    default:
                       $days = 30;
                       break;
                }

                $subscription_date = date('Y-m-d H:i:s');
                $expiry_date_time =  date('Y-m-d H:i:s',strtotime(date("Y-m-d  H:i:s", strtotime($subscription_date)) ." +".$days."days"));

               $new_details['subscriber_id'] = $stripe['subscriber_id'] = $user_id;
               $new_details['subscription_id'] = $stripe['subscription_id'] = $subscription_id;
               $new_details['subscription_date'] = $stripe['subscription_date'] = $subscription_date;
               $new_details['expiry_date_time'] = $expiry_date_time;
               $new_details['type']=1;  
                     $this->db->where('subscriber_id', $user_id);
               $count = $this->db->count_all_results('subscription_details');
               if($count == 0){
                    $this->db->insert('subscription_details', $new_details);
                    $this->db->insert('subscription_details_history', $new_details);
                    $stripe['sub_id'] = $this->db->insert_id();

                } else {
                    $this->db->where('subscriber_id', $user_id);
                    $this->db->update('subscription_details', $new_details);
                    $this->db->insert('subscription_details_history', $new_details);
                    $this->db->where('subscriber_id', $user_id);
                    $details_sub = $this->db->get('subscription_details')->row_array();
                    $stripe['sub_id'] = $subscription_id;
                }
                $stripe['tokenid'] = $user['token'];
                $stripe['payment_details'] = 'midtrans';
              $this->db->insert('subscription_payment', $stripe);

             
            }

        }*/
        
		// echo "<pre>";print_r($postdata);exit();
		$returnurl=$postdata['return_url'];
		$transaction_details = array(
			'order_id' 			=> uniqid(),
			'gross_amount' 	=> $postdata['gross_amount']
		);

		// echo "<pre>";print_r($transaction_details);exit();

		// Populate customer's billing address
	

		// Populate customer's Info
		$customer_details = array(
			'first_name' 			=> $postdata['first_name'],
			'last_name' 			=> "",
			'email' 					=> $postdata['email'],
			'phone' 					=> $postdata['phone'],
			'billing_address' => $postdata['address'],
			'shipping_address'=> $postdata['address']
			);

		// Data yang akan dikirim untuk request redirect_url.
		// Uncomment 'credit_card_3d_secure' => true jika transaksi ingin diproses dengan 3DSecure.
		$transaction_data = array(
			'payment_type' 			=> 'vtweb', 
			'vtweb' 						=> array(
				//'enabled_payments' 	=> ['credit_card'],
				'credit_card_3d_secure' => true
			),
			'transaction_details'=> $transaction_details,
			'customer_details' 	 => $customer_details,
			 'returnurl' 	 => $returnurl
		);
	
		try
		{
            //app sandbox payment url
			$vtweb_url = $this->veritrans->vtweb_charge($transaction_data);
            // print_r($vtweb_url);exit;
			header('Location: ' . $vtweb_url);
		} 
		catch (Exception $e) 
		{
    		echo $e->getMessage();	
		}
		
	}

	public function notification()
	{
		echo 'test notification handler';
		$json_result = file_get_contents('php://input');
		$result = json_decode($json_result);

		if($result){
		$notif = $this->veritrans->status($result->order_id);
		}

		error_log(print_r($result,TRUE));

		//notification handler sample

		$transaction = $notif->transaction_status;
		$type = $notif->payment_type;
		$order_id = $notif->order_id;
		$fraud = $notif->fraud_status;

		if ($transaction == 'capture') {
		  // For credit card transaction, we need to check whether transaction is challenge by FDS or not
		  if ($type == 'credit_card'){
		    if($fraud == 'challenge'){
		      // TODO set payment status in merchant's database to 'Challenge by FDS'
		      // TODO merchant should decide whether this transaction is authorized or not in MAP
		      echo "Transaction order_id: " . $order_id ." is challenged by FDS";
		      } 
		      else {
		      // TODO set payment status in merchant's database to 'Success'
		      echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
		      }
		    }
		  }
		else if ($transaction == 'settlement'){
		  // TODO set payment status in merchant's database to 'Settlement'
		  echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
		  } 
		  else if($transaction == 'pending'){
		  // TODO set payment status in merchant's database to 'Pending'
		  echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
		  } 
		  else if ($transaction == 'deny') {
		  // TODO set payment status in merchant's database to 'Denied'
		  echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
		}

	}


	public function midtranspay() {
		$pay_data = $_REQUEST;
		// echo "<pre>";print_r($pay_data);exit;

		//Wallet - Paysolution
		if($pay_data['productdetail'] == 'wallet') {
			$user  = $this->db->where('email', $pay_data['customeremail'])->get('users')->row_array();
            $amount        = $pay_data['total'];
            $user_id       = $user['id'];
            $user_name     = $user['name'];
            $user_token    = $user['token'];
            $currency_type = $user['currency_code'];

            $wallet = $this->db->where('user_provider_id', $user_id)->where('type', 2)->get('wallet_table')->row_array();
            $wallet_amt = $wallet['wallet_amt'];

            $history_pay['token']=$user_token;
            $history_pay['user_provider_id']=$user_id;
            $history_pay['currency_code']= $user['currency_code'];
            $history_pay['credit_wallet'] = $amount;
            $history_pay['debit_wallet'] = 0;
            $history_pay['type']='1';
            $history_pay['transaction_id']= $pay_data['refno'];
            $history_pay['paid_status']='1';
            $history_pay['total_amt']=$amount;
            if($wallet_amt){
                $current_wallet = $wallet_amt+$amount;
            }else{
                $current_wallet = $amount;
            }
            $history_pay['current_wallet']=$wallet_amt;
            $history_pay['avail_wallet'] = $current_wallet;
            $history_pay['reason']='Wallet Amount Added';
            $history_pay['payment_type']='midtrans';
            $history_pay['created_at']=date('Y-m-d H:i:s');
            if($this->db->insert('wallet_transaction_history',$history_pay)){                     $this->db->where('user_provider_id', $user_id)->update('wallet_table', array(
                    'currency_code' => $user['currency_code'],
                    'wallet_amt' => $current_wallet
                ));                                            
           	}
            if($this->db->affected_rows() > 0) {
				echo 1;
            } else {
            	echo 0;
            }

        } else {
        	//Subscription - Midtrans
            $new_details = array();
            $stripe = array();
            $plan_id = explode('_', $pay_data['productdetail']);
            $subscription_id = $plan_id[1];
            $user  = $this->db->where('email', $pay_data['customeremail'])->get('providers')->row_array();
            $user_id       = $user['id'];

            $this->db->select('duration');
            $record = $this->db->get_where('subscription_fee',array('id'=>$subscription_id))->row_array();
               
            if(!empty($record)) {
                $duration = $record['duration'];
                $days = 30;
                switch ($duration) {
                    case 1:
                       $days = 30;
                      	break;
                    case 2:
                       $days = 60;
                       break;
                    case 3:
                       $days = 90;
                       break;
                    case 6:
                       $days = 180;
                       break;
                    case 12:
                       $days = 365;
                       break;
                    case 24:
                       $days = 730;
                       break;

                    default:
                       $days = 30;
                       break;
                }

                $subscription_date = date('Y-m-d H:i:s');
                $expiry_date_time =  date('Y-m-d H:i:s',strtotime(date("Y-m-d  H:i:s", strtotime($subscription_date)) ." +".$days."days"));

               $new_details['subscriber_id'] = $stripe['subscriber_id'] = $user_id;
               $new_details['subscription_id'] = $stripe['subscription_id'] = $subscription_id;
               $new_details['subscription_date'] = $stripe['subscription_date'] = $subscription_date;
               $new_details['expiry_date_time'] = $expiry_date_time;
               $new_details['type']=1;  
                     $this->db->where('subscriber_id', $user_id);
               $count = $this->db->count_all_results('subscription_details');
               if($count == 0){
                    $this->db->insert('subscription_details', $new_details);
                    $this->db->insert('subscription_details_history', $new_details);
                    $stripe['sub_id'] = $this->db->insert_id();

                } else {
                    $this->db->where('subscriber_id', $user_id);
                    $this->db->update('subscription_details', $new_details);
                    $this->db->insert('subscription_details_history', $new_details);
                    $this->db->where('subscriber_id', $user_id);
                    $details_sub = $this->db->get('subscription_details')->row_array();
                    $stripe['sub_id'] = $subscription_id;
                }
                $stripe['tokenid'] = $user['token'];
                $stripe['payment_details'] = 'midtrans';
                $this->db->insert('subscription_payment', $stripe);
                if($this->db->affected_rows() > 0) {
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                echo 0;
            }
        }
	}
}
