<?php
$category = $this->db->get('categories')->result_array();
$subcategory = $this->db->get('subcategories')->result_array();
$services = $this->db->get('services')->result_array();
$user_list = $this->db->select('id,name,type,token')->get('users')->result_array();
$provider_list = $this->db->select('id,name,type,token')->get('providers')->result_array();
$all_member=array_merge($user_list,$provider_list);
$wallet = $language_content;

?>
<div class="page-wrapper">
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title"><?php echo(!empty($wallet['lg_wallet']))?($wallet['lg_wallet']) : 'Wallet';  ?></h3>
				</div>
				<div class="col-auto text-right">
					<a class="btn btn-white filter-btn mr-2" href="javascript: void(0);" id="filter_search">
						<i class="fas fa-filter"></i>
					</a>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		
		<!-- Search Filter -->
		<form action="<?php echo base_url()?>admin/wallet-request-history" method="post" id="filter_inputs">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
    
			<div class="card filter-card">
				<div class="card-body pb-0">
					<div class="row filter-row">
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($wallet['lg_admin_user']))?($wallet['lg_admin_user']) : 'User';  ?></label>
								<select class="form-control" id="token" name="token">
									<option value=""><?php echo(!empty($wallet['lg_admin_select_user']))?($wallet['lg_admin_select_user']) : 'Select User';  ?></option>
									<?php foreach ($all_member as $pro) 
									{
									if($pro['type']==1){
										$type_name='Provider';
									}else{
										$type_name='User';
									}
									if(!empty($filter) && $filter['token_f']==$pro['id']){
										$select='selected';
									}else{
										$select='';
									}
									?>
									<option <?=$select;?> value="<?=$pro['token']?>"><?php echo ucfirst($pro['name']).'-'.$type_name;?></option>
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($wallet['lg_admin_from_date']))?($wallet['lg_admin_from_date']) : 'From Date';  ?></label>
								<?php
								if(!empty($filter['service_from'])){
									$fr_date=$filter['service_from'];
								}else{
									$fr_date='';
								}
								if(!empty($filter['service_to'])){
									$to_date=$filter['service_to'];
								}else{
									$to_date='';
								}
								?>
								<div class="cal-icon">
									<input class="form-control start_date" type="text" id="from_f" name="from" value="<?=$fr_date;?>">
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($wallet['lg_admin_to_date']))?($wallet['lg_admin_to_date']) : 'To Date';  ?></label>
								<div class="cal-icon">
									<input class="form-control end_date" type="text" id="to_f" name="to" value="<?=$to_date;?>">
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<button class="btn btn-primary btn-block" name="form_submit" value="submit" type="submit"><?php echo(!empty($wallet['lg_admin_submit']))?($wallet['lg_admin_submit']) : 'Submit';  ?></button>
							</div>   
						</div>   
					</div>
				</div>
			</div>
		</form>
		<!-- /Search Filter -->
		
		<ul class="nav nav-tabs menu-tabs">
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url().'admin/wallet'; ?>"><?php echo(!empty($wallet['lg_admin_wallet_report']))?($wallet['lg_admin_wallet_report']) : 'Wallet Report';  ?></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url().'admin/wallet-history'; ?>"><?php echo(!empty($wallet['lg_admin_wallet_history']))?($wallet['lg_admin_wallet_history']) : 'Wallet History';  ?></a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" href="<?php echo base_url().'admin/wallet-request-history'; ?>"><?php echo(!empty($wallet['lg_admin_wallet_request_history']))?($wallet['lg_admin_wallet_request_history']) : 'Wallet Request History';  ?></a>
			</li>
		</ul>
		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover table-center mb-0 service_table" >
                                <thead>
                                    <tr>
                                        <th><?php echo(!empty($wallet['lg_admin_#']))?($wallet['lg_admin_#']) : '#';  ?></th>
                                        <th><?php echo(!empty($wallet['lg_admin_date']))?($wallet['lg_admin_date']) : 'Date';  ?></th>
                                        <th><?php echo(!empty($wallet['lg_admin_name']))?($wallet['lg_admin_name']) : 'Name';  ?></th>
                                        <th><?php echo(!empty($wallet['lg_admin_mobile']))?($wallet['lg_admin_mobile']) : 'Mobile';  ?></th>
                                        <th><?php echo(!empty($wallet['lg_admin_role']))?($wallet['lg_admin_role']) : 'Role';  ?></th>
                                        <th><?php echo(!empty($wallet['lg_admin_bank_details']))?($wallet['lg_admin_bank_details']) : 'Bank Details';  ?></th>
                                        <th><?php echo(!empty($wallet['lg_admin_current_amt']))?($wallet['lg_admin_current_amt']) : 'Current Amt';  ?></th>
                                        <th><?php echo(!empty($wallet['lg_admin_debit_amt']))?($wallet['lg_admin_debit_amt']) : 'Debit Amt';  ?></th>
                                        <th><?php echo(!empty($wallet['lg_admin_reason']))?($wallet['lg_admin_reason']) : 'Reason';  ?></th>
                                        <th><?php echo(!empty($wallet['lg_admin_pay_type']))?($wallet['lg_admin_pay_type']) : 'Pay Type';  ?></th>
                                        <th><?php echo(!empty($wallet['lg_admin_action']))?($wallet['lg_admin_action']) : 'Action';  ?></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(!empty($list)) {

                                    $i=1;
                                    foreach ($list as $rows) {
									if(!empty($rows['date'])){
										$date =date(settingValue('date_format').' H:i:s', strtotime($rows['date']));
									}else{
										$date='-';
									}

									if(!empty($rows['credit_wallet'])){
										$color_t='success';
										$message_t='Credit';
									}else{
										$color_t='danger';
										$message_t='Debit';
									}
									if($rows['role']==1){
										$role=' provider ';
										$color='success';
									}else{
										$role='user';
										$color='primary';
									}
									if($rows['role']==1) { 
										$det = '<button type="button" class="btn btn-primary badge" onclick="getBankDetails('.$rows['user_provider_id'].');"><i class="fas fa-eye mr-1"></i>Bank</button>'; 
									} else {
										$det = '-';
									}

									if($rows['paid_status'] == 'pending') { 
										$paid_status =  'selected';
									} else {
										$paid_status =  '';
									}
									if($rows['paid_status'] == 'paid') {
										$paid_status1 =  'selected';
									} else {
										$paid_status1 =  '';
									}
									if($rows['paid_status'] == 'cancel') {
										$paid_status2 =  'selected';
									} else {
										$paid_status2 =  '';
									}
									$user_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
									if($rows['role'] == 1) {
                    $this->db->where('modules', 'provider');
                    if(!empty($rows['user_provider_id'])){
                    $this->db->where('name_id', $rows['user_provider_id']);
                    }
                    $this->db->where('lang_type', $user_lang);
                    $lang_pro = $this->db->get('users_lang')->row_array();
                  }

                  if($rows['role'] == 2) {
                  	$this->db->where('modules', 'user');
                    if(!empty($rows['user_provider_id'])){
                    $this->db->where('name_id', $rows['user_provider_id']);
                    }
                    $this->db->where('lang_type', $user_lang);
                    $lang_pro = $this->db->get('users_lang')->row_array();
                  }
									echo '<tr>
										<td>'.$i++.'</td>
										<td>'.$date.'</td>
										<td>
											<h2 class="table-avatar">
												<a href="#" class="avatar avatar-sm mr-2">
													<img class="avatar-img rounded-circle" alt="" src="'.base_url().$rows['user_image'].'">
												</a>
												<a href="javascript:void(0);">'.str_replace('-', ' ', $lang_pro['name']).'</a>
											</h2>
										</td>
										<td>'.$rows['user_mobile'].'</td>
										<td><span class="badge badge-'.$color.'">'.ucfirst($role).'</span></td>
										<td>'.$det.'</td>
										<td>'.currency_conversion($rows['currency_code']).$rows['current_wallet'].'</td>
										<td>'.currency_conversion($rows['currency_code']).$rows['debit_wallet'].'</td>
										<td>'.$rows['reason'].'</td>
										<td><span class="badge badge-'.$color_t.'">'.$message_t.'</span></td>';
										echo '<td><select class="form-control request_status_change" name="ser_status" data-id="'.$rows['id'].'" data-providerid="'.$rows['user_provider_id'].'" data-amount="'.$rows['debit_wallet'].'">
											<option value="">Select Status</option>
											<option value="pending" '.$paid_status.'>Pending</option>
											<option value="paid" '.$paid_status1.'>Paid</option>
											<option value="cancel" '.$paid_status2.'>Cancel</option>
											</select></td>';  
									echo '</tr>';
									} 
									} else {
									?>
									<tr>
										<td colspan="12">
											<div class="text-center text-muted"><?php echo(!empty($wallet['lg_admin_no_records_found']))?($wallet['lg_admin_no_records_found']) : 'No Records Found';  ?></div>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo(!empty($wallet['lg_lg_admin_bank_details']))?($wallet['lg_lg_admin_bank_details']) : 'Bank Details';  ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
			<div class="card-body">
				<div class="row">
					<p class="col-sm-6"><?php echo(!empty($wallet['lg_lg_admin_account_holder_name']))?($wallet['lg_lg_admin_account_holder_name']) : 'Account holder name';  ?></p>
					<p class="ac_holder col-sm-6"></p>
				</div>
				<div class="row">
					<p class="col-sm-6"><?php echo(!empty($wallet['lg_admin_account_number']))?($wallet['lg_admin_account_number']) : 'Account Number';  ?></p>
					<p class="ac_no col-sm-6"></p>
				</div>
				<div class="row">
					<p class="col-sm-6"><?php echo(!empty($wallet['lg_admin_iban_number']))?($wallet['lg_admin_iban_number']) : 'IBAN Number';  ?></p>
					<p class="iban_no col-sm-6"></p>
				</div>
				<div class="row">
					<p class="col-sm-6"><?php echo(!empty($wallet['lg_admin_bank_name']))?($wallet['lg_admin_bank_name']) : 'Bank Name';  ?></p>
					<p class="bank_name col-sm-6"></p>
				</div>
				<div class="row">
					<p class="col-sm-6"><?php echo(!empty($wallet['lg_admin_bank_address']))?($wallet['lg_admin_bank_address']) : 'Bank Address';  ?></p>
					<p class="address col-sm-6"></p>
				</div>
				<div class="row">
					<p class="col-sm-6"><?php echo(!empty($wallet['lg_admin_sort_code']))?($wallet['lg_admin_sort_code']) : 'Sort Codes';  ?></p>
					<p class="sort_code col-sm-6"></p>
				</div>
				<div class="row">
					<p class="col-sm-6"><?php echo(!empty($wallet['lg_admin_swift_code']))?($wallet['lg_admin_swift_code']) : 'Swift Code';  ?></p>
					<p class="swift_code col-sm-6"></p>
				</div>
				<div class="row">
					<p class="col-sm-6"><?php echo(!empty($wallet['lg_admin_ifsc_code']))?($wallet['lg_admin_ifsc_code']) : 'IFSC Code';  ?></p>
					<p class="ifsc_code col-sm-6"></p>
				</div>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="docUploadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo(!empty($wallet['lg_upload_payment_document']))?($wallet['lg_upload_payment_document']) : 'Upload Payment Document';  ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
			<div class="card-body">
				<form id="upload_document" action="<?php echo base_url();?>admin/wallet/wallet_request_status" method="post" autocomplete="off" enctype="multipart/form-data">
					<div class="form-group">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
						<input type="hidden" name="id" id="transaction_id" value=""/>
						<input type="hidden" name="provider_id" id="provider_id" value=""/>
					<div class="form-group">
						<label><?php echo(!empty($wallet['lg_Upload_Image']))?($wallet['lg_Upload_Image']) : 'Upload Image';  ?></label>
						<input class="form-control" type="file"  name="upload_doc" id="upload_doc">
					</div>
					<div class="mt-4">
						<button class="btn btn-primary " name="form_submit" value="submit" type="submit"><?php echo(!empty($wallet['lg_admin_submit']))?($wallet['lg_admin_submit']) : 'Submit';  ?></button>
					</div>
				</form>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	function getBankDetails(id) {
		var csrf_token=$('#admin_csrf').val();
		var base_url=$('#base_url').val();
		$('#exampleModal').modal('show');
		$.ajax({
			type:'POST',
     		url: base_url+'provider_bank_details',
     		data :  {id:id,csrf_token_name:csrf_token},
     		dataType:'json',
     		success:function(res) {
     			$('.ac_holder').text(res.account_holder_name);
     			$('.ac_no').text(res.account_number);
     			$('.iban_no').text(res.account_iban);
     			$('.bank_name').text(res.bank_name);
     			$('.address').text(res.bank_address);
     			$('.sort_code').text(res.sort_code);
     			$('.swift_code').text(res.routing_number);
     			$('.ifsc_code').text(res.routing_number);
     		}

		})
	}
</script>