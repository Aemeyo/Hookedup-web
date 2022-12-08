<?php
	$service_list = $language_content;
	$refund_staus = array(
array("id"=>1,'value'=>'Approved'),
array("id"=>2,'value'=>'Rejected'),
);
?>
<div class="page-wrapper">
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title">Refund Request</h3>
				</div>
				<div class="col-auto text-right">
					<a href="<?php echo $base_url; ?>refund-request-list" class="btn btn-primary add-button"><i class="fas fa-sync"></i></a>
					<!-- <a class="btn btn-white filter-btn mr-3" href="javascript:void(0);" id="filter_search">
						<i class="fas fa-filter"></i>
					</a> -->
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		
		<div class="status-toggle mb-3 d-flex">
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover table-center mb-0 service_table">
                                <thead>
                                    <tr>
                                        <th><?php echo(!empty($service_list['lg_admin_#']))?($service_list['lg_admin_#']) : '#';  ?></th>
                                        <th><?php echo(!empty($service_list['lg_admin_provider_name']))?($service_list['lg_admin_provider_name']) : 'Provider Name';  ?></th>
                                        <th><?php echo(!empty($service_list['lg_admin_username']))?($service_list['lg_admin_username']) : 'username';  ?></th>
                                        <th><?php echo(!empty($service_list['lg_admin_service']))?($service_list['lg_admin_service']) : 'Service';  ?></th>
                                        <th><?php echo(!empty($service_list['lg_admin_amount']))?($service_list['lg_admin_amount']) : 'Amount';  ?></th>
                                        <th><?php echo(!empty($service_list['lg_admin_date']))?($service_list['lg_admin_date']) : 'Date';  ?></th>
                                        <th>Deleted Reason</th>
                                        <th><?php echo(!empty($service_list['lg_admin_action']))?($service_list['lg_admin_action']) : 'Action';  ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(!empty($list)) {
									$i=1;
									foreach ($list as $rows) {
									if(!empty($rows['created_at'])){
										$date=date(settingValue('date_format'), strtotime($rows['created_at']));
									}else{
										$date='-';
									}

									$user_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
									$this->db->where('modules', 'provider');
			                        $this->db->where('name_id', $rows['provider_id']);
			                        $this->db->where('lang_type', $user_lang);
			                        $pro_name = $this->db->get('users_lang')->row_array();

			                        $this->db->where('modules', 'user');
			                        $this->db->where('name_id', $rows['user_id']);
			                        $this->db->where('lang_type', $user_lang);
			                        $user_name = $this->db->get('users_lang')->row_array();	

                                    $this->db->where('service_id', $rows['service_id']);
                                    $this->db->where('lang_type', $user_lang);
                                    $service_name = $this->db->get('service_lang')->row_array();

                                    $refund_reason = wordwrap($rows['reason'], 50, '<br />', true);
                                    $badge= '';
                                    $disabled= '';
                                    if ($rows['status']==1) {
										$badge='approval';
										$color='info';
										$disabled = "disabled";
									}
									//echo "<pre>";print_r($rows);exit;
									 ?>
									<tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $pro_name['name']; ?></td>                                       
                                        <td><?php echo $user_name['name']; ?></td>
                                        <td><?php echo $service_name['service_name']; ?></td>
                                        <td><?php echo currency_code_sign(settings('currency')); ?><?php echo $rows['amount']; ?></td>
                                        <td><?php echo $date; ?></td>
                                        <td><?php echo $rows['reason']; ?></td>
										<td> 
											<?php if($rows['status'] == 0) { ?>
											<select class="form-control refun_status" name="refun_status" data-id="<?php echo $rows['id']; ?>"  data-booking_id="<?php echo $rows['booking_id']; ?>" <?php $disabled; ?>> 
												<option value="">Select Status</option>
												<?php foreach ($refund_staus as $pro) { 
													if($rows['status'] == $pro['id']) { 
														$select = 'selected';
													} ?>
												<option value="<?php echo $pro['id']; ?>"><?php echo $pro['value']; ?></option>
											<?php } ?> 
											</select>
										<?php } elseif($rows['status'] == 1) { ?>

												<span class="badge badge-success">Approved</span>

											 <?php  } else { ?>
											  	<span class="badge badge-danger">Rejected</span>
											<?php  } 

										?>
										</td>
									</tr>
								
								<?php 	} } else {
                                    ?>
									<tr>
										<td colspan="9">
											<div class="text-center text-muted"><?php echo(!empty($service_list['lg_admin_no_records_found']))?($service_list['lg_admin_no_records_found']) : 'No Records Found';  ?></div>
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