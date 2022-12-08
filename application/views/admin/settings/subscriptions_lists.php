<?php
$sub_trans = $language_content;
?>
<div class="page-wrapper">
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title"><?php echo(!empty($sub_trans['lg_admin_transaction_details']))?($sub_trans['lg_admin_transaction_details']) : 'Transaction Details';  ?></h3>
				</div>
			</div>
		</div>
		<!-- Page Header -->
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
                        <div class="table-responsive subscriptions-lists">
                            <table class="table custom-table mb-0 w-100 payment_table">
                                <thead>
                                    <tr>
                                        <th><?php echo(!empty($sub_trans['lg_admin_#']))?($sub_trans['lg_admin_#']) : '#';  ?></th>
                                        <th><?php echo(!empty($sub_trans['lg_admin_provider_name']))?($sub_trans['lg_admin_provider_name']) : 'Provider Name';  ?></th>
                                        <th><?php echo(!empty($sub_trans['lg_admin_subscription']))?($sub_trans['lg_admin_subscription']) : 'Subscription';  ?></th>                       
                                        <th><?php echo(!empty($sub_trans['lg_admin_amount']))?($sub_trans['lg_admin_amount']) : 'Amount';  ?></th>                       
										<th><?php echo(!empty($sub_trans['lg_admin_subscription_durations']))?($sub_trans['lg_admin_subscription_durations']) : 'Duration';  ?></th>
										<th><?php echo(!empty($sub_trans['lg_admin_start_date']))?($sub_trans['lg_admin_start_date']) : 'Start Date';  ?></th>
										<th><?php echo(!empty($sub_trans['lg_admin_end_date']))?($sub_trans['lg_admin_end_date']) : 'End Date';  ?></th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
									if(!empty($lists)) {
									$i=1;
									foreach ($lists as $rows) {

										$profile_img = $rows->profile_img;
										if(empty($profile_img)){
											$profile_img ='assets/img/user.jpg';
										}
										if($rows->type == 1){
											$urll = 'provider-details';
										} else {
											$urll = 'freelancer-details';
										} 
										$full_date =date('Y-m-d H:i:s', strtotime($rows->subscription_date));
										$date=date(settingValue('date_format'), strtotime($full_date));
										$date_f=date(settingValue('date_format'), strtotime($full_date));
										$yes_date=date(settingValue('date_format'),(strtotime ( '-1 day' , strtotime (date('Y-m-d')) ) ));
										$time=date('H:i',strtotime($full_date));
										$session = date('h:i A', strtotime($time));
										if($date == date('Y-m-d')){
											$timeBase ="Today ".$session;
										}elseif($date == $yes_date){
											$timeBase ="Yester day ".$session;
										}else{
											$timeBase =$date_f." ".$session;
										}
										
										$full_dates =date('Y-m-d H:i:s', strtotime($rows->expiry_date_time));
										$dates=date(settingValue('date_format'), strtotime($full_dates));
										$date_fs=date(settingValue('date_format'), strtotime($full_dates));
										$yes_dates=date(settingValue('date_format'),(strtotime ( '-1 day' , strtotime (date('Y-m-d')) ) ));
										$times=date('H:i',strtotime($full_dates));
										$sessions = date('h:i A', strtotime($times));
										if($dates == date('Y-m-d')){
											$timeBases ="Today ".$sessions;
										}elseif($dates == $yes_dates){
											$timeBases ="Yester day ".$sessions;
										}else{
											$timeBases =$date_fs." ".$sessions;
										}
										
										//Currency Convertion Based
										$currency_code = settingValue('currency_option'); 
										$currency_code_old = $rows->currency_code;
										$subscription_amount = get_gigs_currency($rows->fee, $currency_code_old, $currency_code);

										$user_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
				                        $this->db->where('modules', 'provider');
				                        if (!empty($rows->subscriber_id)) {
				                        $this->db->where('name_id', $rows->subscriber_id);
				                        }
				                        $this->db->where('lang_type', $user_lang);
				                        $lang_pro = $this->db->get('users_lang')->row_array();

				                        $provider_name = ($lang_pro['name'])?$lang_pro['name']: $rows->name;

					                    $this->db->where('sub_id', $rows->subscription_id);
					                    $this->db->where('lang_type', $user_lang);
					                    $sub_name = $this->db->get('subscription_lang')->row_array();

					                    $subs_name = ($sub_name['subscription_name'])?$sub_name['subscription_name']: $rows->subscription_name;

										echo'<tr>
											<td>'.$i++.'</td>
											<td><h2 class="table-avatar"><a href="#" class="avatar avatar-sm me-2"> <img class="avatar-img rounded-circle" src="'.base_url().$profile_img.'"></a>
											<a href="'.base_url().$urll.'/'.$rows->id.'">'.str_replace('-', ' ', $provider_name).'</a></h2></td>
											
											
											<td>'.$subs_name.'</td>
											<td>'.$subscription_amount.'</td>
											<td>'.$rows->fee_description.'</td>
											<td>'.$timeBase.'</td>
                                             <td>'.$timeBases.'</td>';
											
										echo '</tr>';
									}
                                    }

									else {
									echo '<tr><td colspan="4"><div class="text-center text-muted">No records found</div></td></tr>';
									}
                                   
									?>
                                </tbody>
                            </table>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>