<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}
	public function is_valid_login($username,$password)
	{
		$password = md5($password);
		$this->db->select('user_id, profile_img,token,role');
		$this->db->from('administrators');
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		//$this->db->where_in('role',[1,2]);
	  	$result = $this->db->get()->row_array();
	  	//echo $this->db->last_query(); exit;
		return $result;
	}
  
  	public function update_data($table, $data, $where = [])
  	{
        if (count($where) > 0) {
            $this->db->where($where);
            $status = $this->db->update($table, $data);
            return $status;
        } else {
            $this->db->insert($table, $data);
            return $this->db->insert_id();
        }
    }
	
	public function get_cod()
	{
		$this->db->select('bs.id,bs.currency_code,s.service_title,p.name as providername,u.name as username,cod.amount,cod.status,u.id as user_id,p.id as provider_id,s.id as service_id');
		$this->db->from('book_service_cod AS cod');
		$this->db->join('book_service AS bs', 'bs.id = cod.book_id', 'left');
		$this->db->join('users AS u', 'u.id = bs.user_id', 'left');
		$this->db->join('providers AS p', 'p.id = bs.provider_id', 'left');
		$this->db->join('services AS s', 's.id = bs.service_id', 'left');
		$this->db->order_by('cod.id', 'DESC');
		$result = $this->db->get()->result_array();
		return $result;		
	}
 
   public function getSingleData($table,$where=array()) {

        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    public function admin_details($user_id)
	{
		$results = array();
		$results = $this->db->get_where('administrators',array('user_id'=>$user_id))->row_array();
		return $results;
	}
	public function GetBannerDet()
	{
		$results = array();
		$results = $this->db->get_where('bgimage',array('bgimg_id !='=>0))->result_array();
		return $results;
	}
	public function GetBannerDetId($id)
	{
		$results = array();
		$results = $this->db->get_where('bgimage',array('bgimg_id'=>$id))->row_array();
		return $results;
	}

	public function update_profile($data)
	{
		$user_id = $this->session->userdata('admin_id');
	    $results = $this->db->update('administrators', $data, array('user_id'=>$user_id));
	    return $results;
	}

	public function change_password($user_id,$confirm_password,$current_password)
	{

        $current_password = md5($current_password);
        $this->db->where('user_id', $user_id);
        $this->db->where(array('password'=>$current_password));
        $record = $this->db->count_all_results('administrators');

        if($record > 0){

          $confirm_password = md5($confirm_password);
          $this->db->where('user_id', $user_id);
          return $this->db->update('administrators',array('password'=>$confirm_password));
        }else{
          return 2;
        }
	}

	public function get_setting_list() {
	    $data = array();
	    $stmt = "SELECT a.*"
	            . " FROM system_settings AS a"
	            . " ORDER BY a.`id` ASC";
	    $query = $this->db->query($stmt);
	    if ($query->num_rows()) {
	        $data = $query->result_array();
	    }
	    return $data;
    }

    public function edit_payment_gateway($id)
    {
        $query = $this->db->query(" SELECT * FROM `payment_gateways` WHERE `id` = $id ");
        $result = $query->row_array();
        return $result;
    }

    public function midtrans_payment_gateway($id)
    {
        
        $result = $this->db->get_where('midtrans_gateway', array('id'=>$id))->row_array();
        return $result;
    }
	
	public function midtrans_payout_gateway($id)
    {
        
        $result = $this->db->get_where('midtrans_payout_gateway', array('gateway_type'=>$id))->row_array();
        return $result;
    }

	public function edit_razor_payment_gateway($id)
    {
        $query = $this->db->query(" SELECT * FROM `razorpay_gateway` WHERE `id` = $id ");
        $result = $query->row_array();
        return $result;
    }
	
	public function edit_paypal_payment_gateway($id)
    {
        $query = $this->db->query(" SELECT * FROM `paypal_payment_gateways` WHERE `id` = $id ");
        $result = $query->row_array();
        return $result;
    }
    public function edit_paystack_payment_gateway($id)
    {
        $query = $this->db->query(" SELECT * FROM `paystack_payment_gateways` WHERE `id` = $id ");
        $result = $query->row_array();
        return $result;
    }
	
	public function edit_paytab_payment_gateway()
    {
        $query = $this->db->query(" SELECT * FROM `paytabs_details`");
        $result = $query->row_array();
        return $result;
    }
	
	
	
	

     public function all_payment_gateway()
    {
      $this->db->select('*');
        $this->db->from('payment_gateways');
        $query = $this->db->get();
        return $query->result_array();         
    }

        public function categories_list()
		{
			$query = $this->db->query(" SELECT * FROM `categories` WHERE `status` = 1  ORDER BY id DESC")->result_array();
			return $query;
		}

		public function categories_list_filter($category,$from_date,$to_date){

			        if(!empty($from_date)) {
					$from_date=date("Y-m-d", strtotime($from_date));
					}else{
					$from_date='';
					}
					if(!empty($to_date)) {
					$to_date=date("Y-m-d", strtotime($to_date));
					}else{
					$to_date='';
					}
					$this->db->select('*');
					$this->db->from('categories');
					if(!empty($from_date)){
						$this->db->where('date(created_at) >=',$from_date);
					}
					if(!empty($to_date)){
						$this->db->where('date(created_at) <=',$to_date);
					}
					if(!empty($category)){
					$this->db->where('id',$category);
					}
					$this->db->where('status',1);
					return $this->db->get()->result_array();

		}

		/*subcategory filter*/
		public function subcategory_filter($category,$subcategory,$from,$to){
				
					if(!empty($from)) {
					$from_date=date("Y-m-d", strtotime($from));
					}else{
					$from_date='';
					}
					if(!empty($to)) {
					$to_date=date("Y-m-d", strtotime($to));
					}else{
					$to_date='';
					}

			        $this->db->select('s.*,c.category_name');
					$this->db->from('subcategories s');
					$this->db->join('categories c', 'c.id = s.category', 'left');
					if(!empty($from_date)){
						$this->db->where('date(s.created_at) >=',$from_date);
					}
					if(!empty($to_date)){
						$this->db->where('date(s.created_at) <=',$to_date);
					}
					if(!empty($category)){
						$this->db->where('s.category',$category);
					}
					if(!empty($subcategory)){
						$this->db->where('s.id',$subcategory);
					}
					$this->db->where('s.status',1);
					return $this->db->get()->result_array();

		}

		public function subcategories_list()
		{
			$this->db->select('s.id,s.subcategory_name,s.category,s.subcategory_slug, s.subcategory_image, s.status, s.created_at, s.updated_on, c.category_name');
			$this->db->from('subcategories s');
			$this->db->join('categories c', 'c.id = s.category', 'left');
			$this->db->join('subcategories_lang sl', 'sl.subcategory_id = s.id', 'left');
			$this->db->where('s.status',1);
			$this->db->order_by('s.id', 'DESC');
			return $this->db->get()->result_array();
		}
		public function search_catsuball($category,$subcategory)
		{
			$this->db->select('s.*,c.category_name');
			$this->db->from('subcategories s');
			$this->db->join('categories c', 'c.id = s.category', 'left');
			return $this->db->where(array('s.id'=>$category,'c.id'=>$subcategory,'s.status'=>1))->get()->result_array();
		}

		public function search_subcategory($subcategory)
		{
			$this->db->select('s.*,c.category_name');
			$this->db->from('subcategories s');
			$this->db->join('categories c', 'c.id = s.category', 'left');
			return $this->db->where(array('c.id'=>$subcategory,'s.status'=>1))->get()->result_array();
		}

		public function search_category($category)
		{
			$this->db->select('s.*,c.category_name');
			$this->db->from('subcategories s');
			$this->db->join('categories c', 'c.id = s.category', 'left');
			return $this->db->where(array('c.id'=>$category,'s.status'=>1))->get()->result_array();
		}
		
        public function categories_details($id)
		{
			return $this->db->get_where('categories',array('id'=>$id))->row_array();
		}
		public function appkeyword_details($id)
		{
			return $this->db->get_where('categories',array('id'=>$id))->row_array();
		}

		public function subcategories_details($id)
		{
			return $this->db->get_where('subcategories',array('id'=>$id))->row_array();
		}
                
    public function language_list()
	{
		$this->db->order_by('id', 'DESC'); 
		return $this->db->get('language')->result_array();
	}

	public function Revenue_list($provider='', $date='') { 
		if($provider != '') {
			$this->db->where('ren.provider', $provider);
		}
		if($date != '') {
			$this->db->where('ren.date', date('Y-m-d', strtotime($date)));
		}

		$this->db->select('ren.date,ren.currency_code,ren.amount,ren.commission,ur.name as user,pro.name as provider,ur.id as user_id,pro.id as provider_id');
		$this->db->from('revenue ren');
		$this->db->join('users ur', 'ur.id = ren.user', 'left');
		$this->db->join('providers pro', 'pro.id = ren.provider', 'left');
		$this->db->order_by('ren.id', 'DESC');
		$query=$this->db->get();
		$result=$query->result_array();
		//echo 'post<pre>'; print_r($this->db->last_query()); exit;
		return $result;
	}

	public function ColorList()
	{
		return $this->db->get('theme_color_change')->result_array();
	}
		
	public function contact_list()
	{
		$this->db->order_by('id', 'DESC');
		return $this->db->get('contact_form_details')->result_array();
	}

	public function contact_list_filter($name,$email)
	{
		$this->db->select('*');
		$this->db->from('contact_form_details');
		if(!empty($name)){
			$this->db->where('name like ',$name);
		}
		if(!empty($email)){
			$this->db->where('email like',$email);
		}
		$this->db->order_by('id', 'DESC');					
		return $this->db->get()->result_array();
	}
		
	public function footercount()
    {
        $query  = $this->db->query("SELECT id FROM  `footer_menu` WHERE STATUS =1");
        $result = $query->num_rows();
        return $result;
	}
	public function is_valid_menu_name($menu_name)
    {
        $query  = $this->db->query("SELECT * FROM `footer_menu` WHERE `title` =  '$menu_name';");
        $result = $query->num_rows();
        return $result;
	}
	public function is_valid_submenu($menu_name)
    {
        $query  = $this->db->query("SELECT * FROM `footer_submenu` WHERE `title` =  '$menu_name';");
        $result = $query->num_rows();
        return $result;
    }
    public function edit_footer_menu($id)
    {
        $query  = $this->db->query("SELECT * FROM `footer_menu` WHERE `id` =  $id;");
        $result = $query->result_array();
        return $result;
	}
	public function get_footer_menu($end, $start)
    {
        $query  = $this->db->query("SELECT * FROM  `footer_menu` LIMIT $start , $end ");
        $result = $query->result_array();
        return $result;
    }
    
    public function get_footer_submenu()
    {
        $query  = $this->db->query("SELECT footer_submenu.*,footer_menu.title FROM `footer_submenu` INNER JOIN footer_menu ON footer_menu.id = footer_submenu.`footer_menu` WHERE footer_submenu.status = 1 ORDER BY footer_submenu.id DESC");
        $result = $query->result_array();
        return $result;
    }
    
    public function get_all_footer_menu()
    {
        $query  = $this->db->query("SELECT * FROM  `footer_menu` WHERE status = 1 ORDER BY id DESC");
        $result = $query->result_array();
        return $result;
    }
    
    public function get_all_footer_submenu()
    {
        $query  = $this->db->query("SELECT footer_submenu.*,footer_menu.title FROM `footer_submenu` INNER JOIN footer_menu ON footer_menu.id = footer_submenu.`footer_menu`");
        $result = $query->num_rows();
        return $result;
	}

	public function edit_submenu($id)
    {
        $query  = $this->db->query("SELECT footer_submenu . * , footer_menu.title
                                    FROM  `footer_submenu` 
                                    INNER JOIN footer_menu ON footer_menu.id = footer_submenu.`footer_menu` 
                                    WHERE footer_submenu.id = $id ");
        $result = $query->result_array();
        return $result;
	}
	public function edit_country_code_config($id)
    {
        $query  = $this->db->query("SELECT * FROM `country_table` WHERE `id` =  $id;");
        $result = $query->result_array();
        return $result;
	}

	public function get_country_code_config()
    {
        $query  = $this->db->query("SELECT * FROM  `country_table`");
        $result = $query->result_array();
        return $result;
    }
	
	public function contactreply_list($id)
    {
        $query  = $this->db->query("SELECT cr.*,c.email,c.message FROM  `contact_reply` as cr left join contact_form_details as c on cr.contact_id = c.id where cr.contact_id = $id");
       // $query  = $this->db->query("SELECT c.name,c.email,c.message,c.created_at FROM `contact_form_details` as c where c.id = $id");
        $result = $query->result_array();
        return $result;
    }
	
	
	public function check_admin_email($email)
	  {
		$this->db->select('*');
		$this->db->from('administrators');
			$this->db->where('email',$email);
			$this->db->where_in('role',[1,2]);
		  $result = $this->db->get()->row_array();
		return $result;
	  }
	  
	public function check_admin_emailbyid($email,$admin_id)
	  {
		$this->db->select('*');
		$this->db->from('administrators');
			$this->db->where('email',$email);
			$this->db->where('user_id !=',$admin_id);
			$this->db->where_in('role',[1,2]);
		  $result = $this->db->get()->row_array();
		return $result;
	  }
	  
	  
	  
	public function save_pwdlink_data($user_data)
   {
      $result  = $this->db->insert('forget_password_det',$user_data);
      $insert_id = $this->db->insert_id();
      return $insert_id;
   }
   
   
    public function update_pwdlink_data($data, $id) {
		$this->db->where('user_id',$id);
		$status = $this->db->update('forget_password_det', $data);
		return $status;
   
    }
	
	public function update_res_pwd($data, $id) {
	$this->db->where('user_id',$id);
	$status = $this->db->update('administrators', $data);
	return $status;

	}
	
	public function update_forpwd_status($data, $id) {
		$this->db->where('user_id',$id);
		$status = $this->db->update('forget_password_det', $data);
		return $status;
   
    }
	
	public function pn_list()
	{
		$query = $this->db->query("SELECT * FROM `push_notification` WHERE `status` = 1 ORDER BY id DESC")->result_array();
		return $query;
	}
	public function getting_pages_list($id)
    {
      $query  = $this->db->query("SELECT * FROM  `page_content` WHERE id = $id")->result();
        return $query;         
    }
    public function getting_faq_list()
    {
      $query  = $this->db->get('faq')->result();
/*      echo "<pre>"; print_r($query);exit;
*/    return $query;         
    }
	
	public function GetBannersettings()
	{
		$results = array();
		$results = $this->db->get_where('bgimage',array('bgimg_id'=> 1))->result_array();
		return $results;
	}

	public function Getpopularsettings()
	{
		$results = array();
		$results = $this->db->get('language_management')->result_array();
		return $results;
	}

	/* Blog Category List */
	public function blog_categories_list()
	{
		$lang_id = $this->db->where('language_value',settingValue('language'))->get('language')->row()->id;
		$this->db->select('blog_categories.*,language.language');
		$this->db->from('blog_categories');
		$this->db->join('language','language.id=blog_categories.lang_id');
		$this->db->where('blog_categories.status',1);
		$this->db->where('blog_categories.lang_id', $lang_id);
		$this->db->order_by('blog_categories.id','desc');

		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		return array();
	}

	public function blog_categories_details($id)
	{
		return $this->db->get_where('blog_categories',array('id'=>$id))->row_array();
	}
	//get categories by lang
    public function get_blog_categories_by_lang($lang_id)
    {
        $this->db->where('blog_categories.lang_id', $lang_id);
        $this->db->order_by('category_order');
        $query = $this->db->get('blog_categories');
        return $query->result_array();
    }

	public function get_posts_all($status = '',$id = '')
    {
		$this->db->select('blog_categories.name as cat_name,language.language,blog_posts.*,administrators.full_name,administrators.profile_img');
		$this->db->from('blog_posts');
		$this->db->join('blog_categories','blog_categories.id=blog_posts.category_id');
		$this->db->join('administrators','administrators.user_id=blog_posts.createdBy');
		$this->db->join('language','language.id=blog_categories.lang_id');
		if($status){
			$this->db->where('blog_posts.status',$status);
		}
		if($id){
			$this->db->where('blog_posts.id',$id);
		}
		$this->db->order_by('blog_posts.createdAt','desc');

		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		return array();
    }
	var $table = 'revenue';
	var $column_order = array('', 'provider','user','date'); //set column field database for datatable orderable
	var $column_search = array('provider','user'); //set column field database for datatable searchable 
	var $order = array('id' => 'asc');

	public function r_get_datatables_query() {
		$this->db->from($this->table);
			$i = 0;
			foreach ($this->column_search as $item) // loop column
			{
				if(isset($_POST['search']['value']) && !empty($_POST['search']['value'])){

					if($i===0) // first loop
					{
							$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
							$this->db->like($item, $_POST['search']['value']);
					}
					else
					{

						if($item == 'status'){
							if(strtolower($_POST['search']['value'])=='active'){
								$search_val = 1;
								$this->db->or_like($item, $search_val);
							}
							if(strtolower($_POST['search']['value'])=='inactive'){
								$search_val = 0;
								$this->db->or_like($item, $search_val);
							}


							}else{
								$search_val = $_POST['search']['value'];
								$this->db->or_like($item, $search_val);
							}

					}

					if(count($this->column_search) - 1 == $i) //last loop
							$this->db->group_end(); //close bracket
				}
			$i++;
		}

		if(isset($_POST['order'])) // here order processing
		{
				$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
		}
	}


	public function revenue_list_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

    public function revenue_list_filtered(){

        $this->r_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    /** [Get Currencies] */
    public function get_currency_config()
    {
        $query  = $this->db->query("SELECT `id`, `currency_name`, `currency_symbol`, `currency_code`, `rate`, `status` FROM  `currency_rate` WHERE `delete_status` =  1 ORDER BY id ASC");
        $result = $query->result_array();
        return $result;
    }

    /** [Edit Currency] */
    public function edit_currency_config($id)
    {
        $query  = $this->db->query("SELECT `id`, `currency_name`, `currency_symbol`, `currency_code`, `rate`, `status` FROM `currency_rate` WHERE `id` =  $id;");
        $result = $query->row_array();
        return $result;
	}

	public function homebannersettings()
	{
		$results = array();
		$results = $this->db->query("SELECT * FROM `home_settings` WHERE `modules` =  'banner';")->result_array();
		return $results;
	}

	public function homepopular_searchsettings()
	{
		$results = array();
		$results = $this->db->query("SELECT * FROM `home_settings` WHERE `modules` =  'popular_search';")->result_array();
		return $results;
	}

	public function homefeaturedsettings()
	{
		$results = array();
		$results = $this->db->query("SELECT * FROM `home_settings` WHERE `modules` =  'featured';")->result_array();
		return $results;
	}

	public function homelatestsettings()
	{
		$results = array();
		$results = $this->db->query("SELECT * FROM `home_settings` WHERE `modules` =  'latest';")->result_array();
		return $results;
	}

	public function homepopularsettings()
	{
		$results = array();
		$results = $this->db->query("SELECT * FROM `home_settings` WHERE `modules` =  'popular';")->result_array();
		return $results;
	}

	public function homefeatured_sersettings()
	{
		$results = array();
		$results = $this->db->query("SELECT * FROM `home_settings` WHERE `modules` =  'featured_services';")->result_array();
		return $results;
	}

	public function homehowsettings()
	{
		$results = array();
		$results = $this->db->query("SELECT * FROM `home_settings` WHERE `modules` =  'how_it_works';")->result_array();
		return $results;
	}

	public function homestep1settings()
	{
		$results = array();
		$results = $this->db->query("SELECT * FROM `home_settings` WHERE `modules` =  'step_1';")->result_array();
		return $results;
	}

	public function homestep2settings()
	{
		$results = array();
		$results = $this->db->query("SELECT * FROM `home_settings` WHERE `modules` =  'step_2';")->result_array();
		return $results;
	}

	public function homestep3settings()
	{
		$results = array();
		$results = $this->db->query("SELECT * FROM `home_settings` WHERE `modules` =  'step_3';")->result_array();
		return $results;
	}

	public function homeblogsettings()
	{
		$results = array();
		$results = $this->db->query("SELECT * FROM `home_settings` WHERE `modules` =  'blog';")->result_array();
		return $results;
	}

	public function homedownloadsettings()
	{
		$results = array();
		$results = $this->db->query("SELECT * FROM `home_settings` WHERE `modules` =  'download_sec';")->result_array();
		return $results;
	}

	//add category name
    public function add_category_name($category_id)
    {
    	$query = $this->db->query("select * from language WHERE status = '1'");
		$languages = $query->result();
        foreach ($languages as $language) {
            $data = array(
                'category_id' => $category_id,
                'lang_type' => $language->language_value,
                'category_name' => $this->input->post('category_name_' . $language->id, true)
            );
            $this->db->insert('categories_lang', $data);
        }
    }

    //update category name
    public function update_category_name($category_id)
    {
    	$query = $this->db->query("select * from language WHERE status = '1'");
		$languages = $query->result();
        foreach ($languages as $language) {
            $data = array(
                'category_id' => $category_id,
                'lang_type' => $language->language_value,
                'category_name' => $this->input->post('category_name_' . $language->id, true)
            );
            //check category name exists
            $this->db->where('category_id', $category_id);
            $this->db->where('lang_type', $language->language_value);
            $row = $this->db->get('categories_lang')->row();
            if (empty($row)) {
                $this->db->insert('categories_lang', $data);
            } else {
                $this->db->where('category_id', $category_id);
                $this->db->where('lang_type', $language->language_value);
                $this->db->update('categories_lang', $data);
            }
        }
    }

    //Add Role Name
    public function add_role_permissions($role_id)
    {
    	$query = $this->db->query("select * from language WHERE status = '1'");
		$languages = $query->result();
        foreach ($languages as $language) {
            $data = array(
                'role_id' => $role_id,
                'lang_type' => $language->language_value,
                'role_name' => $this->input->post('role_name_' . $language->id, true)
            );
            $this->db->insert('roles_permissions_lang', $data);
        }
       	return 1;
    }

    //Update Role Name
    public function update_roles_permissions($role_id)
    {
    	$query = $this->db->query("select * from language WHERE status = '1'");
		$languages = $query->result();
        foreach ($languages as $language) {
            $data = array(
                'role_id' => $role_id,
                'lang_type' => $language->language_value,
                'role_name' => $this->input->post('role_name_' . $language->id, true)
            );
            //check role name exists
            $this->db->where('role_id', $role_id);
            $this->db->where('lang_type', $language->language_value);
            $row = $this->db->get('roles_permissions_lang')->row();
            if (empty($row)) {
                $this->db->insert('roles_permissions_lang', $data);
            } else {
                $this->db->where('role_id', $role_id);
                $this->db->where('lang_type', $language->language_value);
                $this->db->update('roles_permissions_lang', $data);
            }
            return 1;
        }
    }

    //add subcategory name
    public function add_subcategory_name($subcategory_id)
    {
    	$query = $this->db->query("select * from language WHERE status = '1'");
		$languages = $query->result();
        foreach ($languages as $language) {
            $data = array(
                'subcategory_id' => $subcategory_id,
                'lang_type' => $language->language_value,
                'subcategory_name' => $this->input->post('subcategory_name_' . $language->id, true)
            );
            $this->db->insert('subcategories_lang', $data);
        }
    }

    //update subcategory name
    public function update_subcategory_name($subcategory_id)
    {
    	$query = $this->db->query("select * from language WHERE status = '1'");
		$languages = $query->result();
        foreach ($languages as $language) {
            $data = array(
                'subcategory_id' => $subcategory_id,
                'lang_type' => $language->language_value,
                'subcategory_name' => $this->input->post('subcategory_name_' . $language->id, true)
            );
            //check category name exists
            $this->db->where('subcategory_id', $subcategory_id);
            $this->db->where('lang_type', $language->language_value);
            $row = $this->db->get('subcategories_lang')->row();
            if (empty($row)) {
                $this->db->insert('subcategories_lang', $data);
            } else {
                $this->db->where('subcategory_id', $subcategory_id);
                $this->db->where('lang_type', $language->language_value);
                $this->db->update('subcategories_lang', $data);
            }
        }
    }

    public function aboutussettings()
	{
		$results = array();
		$results = $this->db->query("SELECT * FROM `home_settings` WHERE `modules` =  'about_us';")->result_array();
		return $results;
	}

	public function cookie_policysettings()
	{
		$results = array();
		$results = $this->db->query("SELECT * FROM `home_settings` WHERE `modules` =  'cookie_policy';")->result_array();
		return $results;
	}

	public function helpsettings()
	{
		$results = array();
		$results = $this->db->query("SELECT * FROM `home_settings` WHERE `modules` =  'help';")->result_array();
		return $results;
	}

	public function privacy_policysettings()
	{
		$results = array();
		$results = $this->db->query("SELECT * FROM `home_settings` WHERE `modules` =  'privacy_policy';")->result_array();
		return $results;
	}

	public function termssettings()
	{
		$results = array();
		$results = $this->db->query("SELECT * FROM `home_settings` WHERE `modules` =  'terms_condition';")->result_array();
		return $results;
	}

	//add ratings name
    public function add_rating_name($rating_id)
    {
    	$query = $this->db->query("select * from language WHERE status = '1'");
		$languages = $query->result();
        foreach ($languages as $language) {
            $data = array(
                'rating_id' => $rating_id,
                'lang_type' => $language->language_value,
                'rating_name' => $this->input->post('name_' . $language->id, true)
            );
            $this->db->insert('rating_type_lang', $data);
        }
    }

    //update rating name
    public function update_rating_name($rating_id)
    {
    	$query = $this->db->query("select * from language WHERE status = '1'");
		$languages = $query->result();
        foreach ($languages as $language) {
            $data = array(
                'rating_id' => $rating_id,
                'lang_type' => $language->language_value,
                'rating_name' => $this->input->post('name_' . $language->id, true)
            );
            //check rating name exists
            $this->db->where('rating_id', $rating_id);
            $this->db->where('lang_type', $language->language_value);
            $row = $this->db->get('rating_type_lang')->row();
            if (empty($row)) {
                $this->db->insert('rating_type_lang', $data);
            } else {
                $this->db->where('rating_id', $rating_id);
                $this->db->where('lang_type', $language->language_value);
                $this->db->update('rating_type_lang', $data);
            }
        }
    }

    public function check_language($cookie,$lang)
	{
		$this->db->where('lang_type', $lang);
		$this->db->where('modules', $cookie);
		$this->db->from('cookies');
		$result = $this->db->get();
		$results = $result->row_array();
		if($result->num_rows() > 0){
			return $results['id'];
		}
		
	}

	public function check_website_language($cookie,$lang)
	{
		$this->db->where('lang_type', $lang);
		$this->db->where('modules', $cookie);
		$this->db->from('cookies');
		$result = $this->db->get();
		$results = $result->row_array();
		if($result->num_rows() > 0){
			return $results['id'];
		}
		
	}

	//add subscription name
    public function add_subscription_name($sub_id)
    {
    	$query = $this->db->query("select * from language WHERE status = '1'");
		$languages = $query->result();
        foreach ($languages as $language) {
            $data = array(
                'sub_id' => $sub_id,
                'lang_type' => $language->language_value,
                'subscription_name' => $this->input->post('subscription_name_' . $language->id, true)
            );
            $this->db->insert('subscription_lang', $data);
        }
    }


    //update subscription name
    public function update_subscription_name($sub_id)
    {
    	$query = $this->db->query("select * from language WHERE status = '1'");
		$languages = $query->result();
        foreach ($languages as $language) {
            $data = array(
                'sub_id' => $sub_id,
                'lang_type' => $language->language_value,
                'subscription_name' => $this->input->post('subscription_name_' . $language->id, true)
            );
            //check category name exists
            $this->db->where('sub_id', $sub_id);
            $this->db->where('lang_type', $language->language_value);
            $row = $this->db->get('subscription_lang')->row();
            if (empty($row)) {
                $this->db->insert('subscription_lang', $data);
            } else {
                $this->db->where('sub_id', $sub_id);
                $this->db->where('lang_type', $language->language_value);
                $this->db->update('subscription_lang', $data);
            }
        }
    }

    //add admin name
    public function add_admin_name($name_id)
    {
    	$query = $this->db->query("select * from language WHERE status = '1'");
		$languages = $query->result();
        foreach ($languages as $language) {
            $data = array(
                'modules' => 'admin',
                'name_id' => $name_id,
                'lang_type' => $language->language_value,
                'name' => $this->input->post('full_name_' . $language->id, true)
            );
           //check admin name exists
            $this->db->where('modules','admin');
            $this->db->where('name_id', $name_id);
            $this->db->where('lang_type', $language->language_value);
            $row = $this->db->get('users_lang')->row();
            if (empty($row)) {
                $this->db->insert('users_lang', $data);
            } else {
            	$this->db->where('modules','admin');
                $this->db->where('name_id', $name_id);
                $this->db->where('lang_type', $language->language_value);
                $this->db->update('users_lang', $data);
            }
        }
    }

    //add user name
    public function add_user_name($name_id)
    {
    	$query = $this->db->query("select * from language WHERE status = '1'");
		$languages = $query->result();
        foreach ($languages as $language) {
            $data = array(
                'modules' => 'user',
                'name_id' => $name_id,
                'lang_type' => $language->language_value,
                'name' => $this->input->post('name_' . $language->id, true)
            );
           //check user name exists
            $this->db->where('modules','user');
            $this->db->where('name_id', $name_id);
            $this->db->where('lang_type', $language->language_value);
            $row = $this->db->get('users_lang')->row();
            if (empty($row)) {
                $this->db->insert('users_lang', $data);
            } else {
            	$this->db->where('modules','user');
                $this->db->where('name_id', $name_id);
                $this->db->where('lang_type', $language->language_value);
                $this->db->update('users_lang', $data);
            }
        }
    }

    //add provider name
    public function add_provider_name($name_id)
    {
    	$query = $this->db->query("select * from language WHERE status = '1'");
		$languages = $query->result();
        foreach ($languages as $language) {
            $data = array(
                'modules' => 'provider',
                'name_id' => $name_id,
                'lang_type' => $language->language_value,
                'name' => $this->input->post('name_' . $language->id, true)
            );
           //check provider name exists
            $this->db->where('modules','provider');
            $this->db->where('name_id', $name_id);
            $this->db->where('lang_type', $language->language_value);
            $row = $this->db->get('users_lang')->row();
            if (empty($row)) {
                $this->db->insert('users_lang', $data);
            } else {
            	$this->db->where('modules','provider');
                $this->db->where('name_id', $name_id);
                $this->db->where('lang_type', $language->language_value);
                $this->db->update('users_lang', $data);
            }
        }
    }

    public function category_wid_list()
	{
		$results = array();
		$results = $this->db->query("SELECT * FROM `footer_submenu_lang` WHERE `modules` =  'category_widget';")->result_array();
		return $results;
	}

	public function contact_wid_list()
	{
		$results = array();
		$results = $this->db->query("SELECT * FROM `footer_submenu_lang` WHERE `modules` =  'contact_widget';")->result_array();
		return $results;
	}

	public function social_wid_list()
	{
		$results = array();
		$results = $this->db->query("SELECT * FROM `footer_submenu_lang` WHERE `modules` =  'social_widget';")->result_array();
		return $results;
	}

	public function pages_details($id)
	{
		return $this->db->get_where('pages_list',array('id'=>$id))->row_array();
	}

	public function get_all_comments() {
		return $this->db->where('status!=', 2)->order_by('id', 'DESC')->get('blog_comments')->result_array();
	}

	public function get_roles_permissions($id=null) {
		if(!empty($id)) {
			$this->db->where('id', $id);
		}
		return $this->db->order_by('id', 'DESC')->get_where('roles_permissions', array('status'=>1))->result_array();
	}

	public function result_getall() {
		$this->db->select('SP.*,U.name,S.subscription_name,SD.expiry_date_time,SD.paid_status');
		$this->db->from('subscription_payment SP');
		$this->db->join('subscription_details SD','SD.subscription_id=SP.subscription_id','left'); 
		$this->db->join('subscription_fee S','S.id=SP.subscription_id','left'); 
		$this->db->join('providers U','U.id=SP.subscriber_id','left');
		$this->db->where(array('SP.tokenid'=> 'Offline Payment'));
		$this->db->group_by('SP.id');
		$query = $this->db->get();
		return $query->result_array();

	}

	public function provider_list()
	{
		$this->db->select('P.name,P.id');
		$this->db->from('providers P');
		$this->db->join('business_hours B','B.provider_id=P.id','left'); 
		$this->db->join('subscription_details SD','SD.subscriber_id=P.id','left');
		$this->db->where('SD.expiry_date_time>',  date('y-m-d'));
		$query = $this->db->get();
		return $query->result_array();
			
	}

	public function edit_service_list($id)
	{
		return $this->db->where('id',$id)->get('services')->row_array();
			
	}

	public function abuse_reports()
	{
		$results = array();
		$results = $this->db->order_by('id', 'DESC')->where('status', 1)->get('abuse_reports')->result_array();
		return $results;
	}

	public function abuse_reports_list($id)
    {
        $results = array();
		$results = $this->db->query("SELECT * FROM `abuse_reports` WHERE `id` =  $id;")->result_array();
		return $results;
    }

    public function language_fetch_data()
	{
	  $this->db->select("*");
	  $this->db->where('language', 'en');
	  $this->db->from('language_management');
	  return $this->db->get();
	  echo $this->db->last_query();exit;
	}


    //Get Providers name and wallet amount
    public function providersData() {
    	$provider_data = $this->db->select('p.id,p.name,p.currency_code,wt.wallet_amt')
    			->from('providers p')
    			->join('wallet_table wt', 'wt.user_provider_id = p.id')
    			->where(array('p.status'=>1, 'wt.type'=>1))
    			->get()
    			->result_array();

    	return $provider_data;
    }

    //Update Providers wallet's amount
    public function reduce_user_balance($user_id, $amount) {
    	$wallet_amt = $this->db->select('*')->from('wallet_table')->where(array('user_provider_id'=>$user_id, 'type'=>1))->get()->row();
    	$token = $this->db->get_where('providers', array('id'=>$user_id))->row();
    	
    	/* wallet infos */
		$history_pay['token'] = $token->token;
		$history_pay['currency_code']=$token->currency_code;
		$history_pay['user_provider_id'] = $user_id;
		$history_pay['type'] = '1';
		$history_pay['tokenid'] = 'payout'.$token->token;
		$history_pay['payment_detail'] = 'Payout Request';
		$history_pay['charge_id'] = '';
		$history_pay['transaction_id'] = '';
		$history_pay['exchange_rate'] = '';
		$history_pay['paid_status'] = 'pass';
		$history_pay['cust_id'] = 'Self';
		$history_pay['card_id'] = 'Self';
		$history_pay['total_amt'] = $amount;
		$history_pay['fee_amt'] = 0;
		$history_pay['net_amt'] = 0;
		$history_pay['amount_refund'] = 0;
		$history_pay['current_wallet'] = $wallet_amt->wallet_amt;
		$history_pay['credit_wallet'] = $amount; //(($pay_info->balance_transaction->net) / 100);
		$history_pay['debit_wallet'] = 0;
		$history_pay['avail_wallet'] = $wallet_amt->wallet_amt - $amount; //
		$history_pay['reason'] = 'Withdrawal Amount(Admin)';
		$history_pay['created_at'] = date('Y-m-d H:i:s');
		if ($this->db->insert('wallet_transaction_history', $history_pay)) {
			/* update wallet table */
			$wallet_dat['currency_code']=$wallet_amt->currency_code;
			$wallet_dat['wallet_amt'] = $history_pay['avail_wallet']; 
			$wallet_dat['updated_on'] = date('Y-m-d H:i:s');
			$where = array('token' => $token->token);
			$this->db->set($wallet_dat);
	        $this->db->where($where);
	        $this->db->update('wallet_table');

	        return $this->db->affected_rows() != 0 ? true : false;
		}
    }

    public function getPayoutRequest() {
    	$request_data = $this->db->get_where('payouts', array('status'=>0))->result_array();
    	
    	return $request_data;
    }

    public function getCompletedPayouts() {
    	$completed_data = $this->db->get_where('payouts', array('status'=>1))->result_array();
    	
    	return $completed_data;
    }

}
?>
