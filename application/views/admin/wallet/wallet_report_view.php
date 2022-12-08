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
		<form action="<?php echo base_url()?>admin/wallet" method="post" id="filter_inputs">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
    
			<div class="card filter-card">
				<div class="card-body pb-0">
					<div class="row filter-row">
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($wallet['lg_admin_user']))?($wallet['lg_admin_user']) : 'User';  ?></label>
								<select class="form-control" id="user_id_f" name="token">
									<option value=""><?php echo(!empty($wallet['lg_admin_select_user']))?($wallet['lg_admin_select_user']) : 'Select User';  ?></option>
									<?php foreach ($all_member as $pro) 
									{
									if($pro['type']==1){
										$type_name='Provider';
									}else{
										$type_name='User';
									}
									if(!empty($filter['token_f'])==$pro['token']){
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
			<li class="nav-item active">
				<a class="nav-link" href="<?php echo base_url().'admin/wallet'; ?>"><?php echo(!empty($wallet['lg_admin_wallet_report']))?($wallet['lg_admin_wallet_report']) : 'Wallet Report';  ?></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url().'admin/wallet-history'; ?>"><?php echo(!empty($wallet['lg_admin_wallet_history']))?($wallet['lg_admin_wallet_history']) : 'Wallet History';  ?></a>
			</li>
			<li class="nav-item">
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
                                        <th><?php echo(!empty($wallet['lg_admin_wallet_amt']))?($wallet['lg_admin_wallet_amt']) : 'Wallet Amt';  ?></th>
                                       <th><?php echo(!empty($wallet['lg_admin_role']))?($wallet['lg_admin_role']) : 'Role';  ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

									if(!empty($list)) {
                                    $i=1;
									
                                    foreach ($list as $rows) {
									if(!empty($rows['date'])){
										$date=date(settingValue('date_format'), strtotime($rows['date']));
									}else{
										$date='-';
									}
									
									if($rows['role']==1){
										$role=' Provider ';
										$color='success';
									}else{
										$role='User';
										$color='primary';
									}

									$user_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
									if($rows['type'] == 1) {
				                        $this->db->where('modules', 'provider');
				                        if(!empty($rows['user_id'])){
				                        $this->db->where('name_id', $rows['user_id']);
				                        }
				                        $this->db->where('lang_type', $user_lang);
				                        $lang_pro = $this->db->get('users_lang')->row_array();
			                        }

			                        if($rows['type'] == 2) {
			                        	$this->db->where('modules', 'user');
				                        if(!empty($rows['user_id'])){
				                        $this->db->where('name_id', $rows['user_id']);
				                        }
				                        $this->db->where('lang_type', $user_lang);
				                        $lang_pro = $this->db->get('users_lang')->row_array();
			                        }
			                        if (!empty($lang_pro['name'])) {
			                        	$name = $lang_pro['name'];
			                        } else {
			                        	$name = $rows['user_name'];
			                        }
									echo '<tr>
										<td>'.$i++.'</td>
										<td>'.$date.'</td>
										<td>
											<h2 class="table-avatar">
												<a href="#" class="avatar avatar-sm mr-2">
													<img class="avatar-img rounded-circle" alt="" src="'.base_url().$rows['user_image'].'">
												</a>
												<a href="javascript:void(0);">'.str_replace('-', ' ', $name).'</a>
											</h2>
										</td>
										<td>'.$rows['user_mobile'].'</td>
										<td>'.currency_conversion($rows['currency_code']).$rows['wallet_amt'].'</td>
										<td><label class="badge badge-'.$color.'">'.ucfirst($role).'</lable></td>
									</tr>';
									} 
									} else {
									?>
									<tr>
										<td colspan="6">
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