<?php
	$providers = $this->db->get('providers')->result_array();
	$payments = $language_content;
?>
<div class="page-wrapper">
	<div class="content container-fluid">

		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title">Earnings</h3>
				</div>
				<div class="col-auto text-right">
					<a class="btn btn-white filter-btn mr-3" href="javascript:void(0);" id="filter_search">
						<i class="fas fa-filter"></i>
					</a>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		
		<!-- Search Filter -->
		<form action="<?php echo base_url()?>admin/payments/earnings" method="post" id="filter_inputs">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
    

			<div class="card filter-card">
				<div class="card-body pb-0">
					<div class="row filter-row">
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($payments['lg_admin_provider']))?($payments['lg_admin_provider']) : 'Provider';  ?></label>
								<select class="form-control" name="provider_id">
									<option value=""><?php echo(!empty($payments['lg_admin_select_provider']))?($payments['lg_admin_select_provider']) : 'Select Provider';  ?></option>
									<?php foreach ($providers as $pro) { ?>
									<option value="<?=$pro['id']?>"><?php echo $pro['name']?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($payments['lg_admin_status']))?($payments['lg_admin_status']) : 'Status';  ?></label>
								<select class="form-control" name="status">
									<option value=""><?php echo(!empty($payments['lg_admin_select_status']))?($payments['lg_admin_select_status']) : 'Select Status';  ?></option>
									<option value="1"><?php echo(!empty($payments['lg_admin_pending']))?($payments['lg_admin_pending']) : 'Pending';  ?></option>
									<option value="2"><?php echo(!empty($payments['lg_admin_inprogress']))?($payments['lg_admin_inprogress']) : 'Inprogress';  ?></option>
									<option value="3"><?php echo(!empty($payments['lg_complete_res_user']))?($payments['lg_complete_res_user']) : 'Complete Request to User';  ?></option>
									<option value="5"><?php echo(!empty($payments['lg_admin_rejected_user']))?($payments['lg_admin_rejected_user']) : 'Rejected by User';  ?></option>
									<option value="6"><?php echo(!empty($payments['lg_Payment_Completed']))?($payments['lg_Payment_Completed']) : 'Payment Completed';  ?></option>
									<option value="7"><?php echo(!empty($payments['lg_admin_cancelled_provider']))?($payments['lg_admin_cancelled_provider']) : 'Cancelled by Provider';  ?></option>
								</select>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($payments['lg_admin_from_date']))?($payments['lg_admin_from_date']) : 'From Date';  ?></label>
								<div class="cal-icon">
									<input class="form-control start_date" type="text" name="from">
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($payments['lg_admin_to_date']))?($payments['lg_admin_to_date']) : 'To Date';  ?></label>
								<div class="cal-icon">
									<input class="form-control end_date" type="text" name="to">
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<button class="btn btn-primary btn-block" name="form_submit" value="submit" type="submit"><?php echo(!empty($payments['lg_admin_submit']))?($payments['lg_admin_submit']) : 'Submit';  ?></button>
							</div>
						</div>
					</div>

				</div>
			</div>
		</form>
		<!-- /Search Filter -->

		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover table-center mb-0 payment_table">
                                <thead>
                                    <tr>
                                        <th><?php echo(!empty($payments['lg_admin_#']))?($payments['lg_admin_#']) : '#';  ?></th>
                                        <th><?php echo(!empty($payments['lg_admin_service']))?($payments['lg_admin_service']) : 'service';  ?></th>
                                        <th><?php echo(!empty($payments['lg_admin_provider']))?($payments['lg_admin_provider']) : 'Provider';  ?></th>
										<th><?php echo(!empty($payments['lg_admin_payment_type']))?($payments['lg_admin_payment_type']) : 'Payment Type';  ?></th>
                                        <th><?php echo(!empty($payments['lg_admin_amount']))?($payments['lg_admin_amount']) : 'Amount';  ?></th>
                                        <th><?php echo(!empty($payments['lg_admin_commission_rate']))?($payments['lg_admin_commission_rate']) : 'Commission Rate';  ?></th>
                                        <th><?php echo(!empty($payments['lg_admin_status']))?($payments['lg_admin_status']) : 'Status';  ?></th>
                                        <th><?php echo(!empty($payments['lg_admin_earned_amount']))?($payments['lg_admin_earned_amount']) : 'Earned Amount';  ?></th>
                                        <th><?php echo(!empty($payments['lg_admin_date']))?($payments['lg_admin_date']) : 'Date';  ?></th>
                                        <th><?php echo(!empty($payments['lg_admin_action']))?($payments['lg_admin_action']) : 'action';  ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(!empty($list)) {
										$i=1;
										foreach ($list as $rows) {
											$com = settingValue('commission')/100 ;
											$com_amnt = $rows['amount']*$com;
											$ded_amnt = $rows['amount']-$rows['amount']*$com;
                                        $amount_refund=''; 
									 	if(!empty($rows['reject_paid_token'])){
									 	if($rows['admin_reject_comment']=="This service amount favour for User"){
									 		$status="Amount refund to User";
									 	}else{
                                          $status="Amount refund to Provider";
									 	}
									 }
									 	$user_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
                    $this->db->where('modules', 'provider');
                    $this->db->where('name_id', $rows['provider_id']);
                    $this->db->where('lang_type', $user_lang);
                    $lang_pro = $this->db->get('users_lang')->row_array();

                    $this->db->where('id', $rows['provider_id']);
                    $lang_name = $this->db->get('providers')->row_array();
                    
                    $this->db->where('service_id', $rows['service_id']);
                    $this->db->where('lang_type', $user_lang);
                    $service_name = $this->db->get('service_lang')->row_array();

									 	//print_r($rows);exit;
										$provider_name = $this->db->where('id',$rows['provider_id'])->get('providers')->row_array();
										$user_name = $this->db->where('id',$rows['user_id'])->get('users')->row_array();
										$service = $this->db->where('id',$rows['service_id'])->get('services')->row_array();
										$admin_payment = $this->db->where('booking_id',$rows['id'])->get('admin_payment')->row_array();
										
										if($rows['status'] == 1) {
                                            $status = 'Pending';
										}
										elseif($rows['status'] == 2) {
                                            $status = 'Inprogress';
										}
										elseif($rows['status'] == 3) {
                                            $status = 'Complete Request to User';
										}
										elseif($rows['status'] == 5&&empty($rows['reject_paid_token'])) {
                                            $status = 'Rejected by User';
										}
										elseif($rows['status'] == 6) {
                                            $status = 'Payment Completed';
										}
										elseif($rows['status'] == 7&&empty($rows['reject_paid_token'])) {
                                            $status = 'Cancelled by Provider';
										}
										elseif($rows['status'] == 8) {
                                            $status = 'Completed';
										} elseif($rows['status'] == 4) {
											$status = 'User Accepted';
										} else {
											$status = '-';
										}

										$datef = explode(' ', $rows['updated_on']);
		                                if(settingValue('time_format') == '12 Hours') {
		                                    $time = date('h:ia', strtotime($datef[1]));
		                                } elseif(settingValue('time_format') == '24 Hours') {
		                                   $time = date('H:i:s', strtotime($datef[1]));
		                                } else {
		                                    $time = date('G:ia', strtotime($datef[1]));
		                                }
		                                $date = date(settingValue('date_format'), strtotime($datef[0]));
		                                $timeBase = $date.' '.$time;
										?>
                                        <tr>
											<td><?php echo $i++ ?></td> 
											<td><?php
												echo ($service_name)?$service_name['service_name']:'';?></td>
											<td><?php
												echo ($lang_pro)?$lang_pro['name']: $lang_name['name'];?></td>
											<td><?php 
													if ($rows['cod'] == 1) {
														echo "COD";
													} else {
														echo "Wallet";
													}
												?>		
											</td>
											<td><?php echo currency_conversion($rows['currency_code']).$rows['amount']?></td>
											<td><?php 
												if ($rows['cod'] == 2) {
													echo currency_conversion($rows['currency_code']).$com_amnt;
												} else {
													echo "$0";
												}
												?>		
											</td>
											<td><?php echo $status; ?></td>
											<td><?php 
													if ($rows['cod'] == 1) {
														echo "$0";
													} else {
														echo currency_conversion($rows['currency_code']).$ded_amnt;
													} 
												?>
											</td>
											<td><?php echo $timeBase; ?></td>
											<td>
												<a href="#" id="ear_del" class="btn btn-sm bg-danger-light  delete_menu" data-id="<?php  echo $rows['id']; ?>">
                          <i class="far fa-trash-alt "></i>
                           <?php echo(!empty($payments['lg_admin_delete']))?($payments['lg_admin_delete']) : 'Delete';  ?>
                        </a>
                      </td>
										</tr>
                                    <?php } } else {
                                    ?>
									<tr>
										<td colspan="7">
											<div class="text-center text-muted"><?php echo(!empty($payments['lg_admin_no_records_found']))?($payments['lg_admin_no_records_found']) : 'No Records Found';  ?></div>
										</td>
									</tr>
									<?php } ?>
                                </tbody>
                            </table>
						</div> 
					</div> 
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="ear_delete_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5><?php echo(!empty($payments['lg_admin_delete_confiramtion']))?($payments['lg_admin_delete_confiramtion']) : 'Delete Confiramtion';  ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><?php echo(!empty($payments['lg_admin_are_delete_earning']))?($payments['lg_admin_are_delete_earning']) : 'Are You Confirm To Delete This Earning.';  ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" id="confirm_delete_ear" data-id="" class="btn btn-primary"><?php echo(!empty($payments['lg_admin_yes']))?($payments['lg_admin_yes']) : 'Yes';  ?></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo(!empty($payments['lg_admin_no']))?($payments['lg_admin_no']) : 'No';  ?></button>
      </div>
    </div>
  </div>
</div>