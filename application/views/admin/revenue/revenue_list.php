<?php 
$revenue = $language_content;
?>
<div class="page-wrapper">
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title"><?php echo(!empty($revenue['lg_admin_revenue']))?($revenue['lg_admin_revenue']) : 'Revenue';  ?></h3>
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
		<form action="<?php echo base_url()?>revenue" method="post" id="filter_inputs">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
    
			<div class="card filter-card">
				<div class="card-body pb-0">
					<div class="row filter-row">
					
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($revenue['lg_admin_provider_name']))?($revenue['lg_admin_provider_name']) : 'Provider Name';  ?></label>
								<select class="form-control" name="provider_name" >
									<option value=""><?php echo(!empty($revenue['lg_admin_select_provider_name']))?($revenue['lg_admin_select_provider_name']) : 'Select provider name';  ?></option>
									<?php foreach ($provider_list as $provider) { ?>
									<option value="<?=$provider['id']?>"><?php echo $provider['name']?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($revenue['lg_admin_date']))?($revenue['lg_admin_date']) : 'Date';  ?></label>
								<div class="cal-icon">
									<input class="form-control datetimepicker" type="text" name="date" id="date">
								</div>
							</div>
						</div>
						
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<button class="btn btn-primary btn-block" name="form_submit" value="submit" type="submit"><?php echo(!empty($revenue['lg_admin_submit']))?($revenue['lg_admin_submit']) : 'Submit';  ?></button>
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
							<table class=" table table-hover table-center mb-0 payment_table" >
								<thead>
									<tr>
										<th><?php echo(!empty($revenue['lg_admin_#']))?($revenue['lg_admin_#']) : '#';  ?></th>
										<th><?php echo(!empty($revenue['lg_admin_date']))?($revenue['lg_admin_date']) : 'Date';  ?></th>
										<th><?php echo(!empty($revenue['lg_admin_provider_name']))?($revenue['lg_admin_provider_name']) : 'Provider Name';  ?></th>
										<th><?php echo(!empty($revenue['lg_admin_user_name']))?($revenue['lg_admin_user_name']) : 'User Name';  ?></th>
										<th><?php echo(!empty($revenue['lg_admin_amount']))?($revenue['lg_admin_amount']) : 'Amount';  ?></th>
										<th><?php echo(!empty($revenue['lg_admin_commission_amount']))?($revenue['lg_admin_commission_amount']) : 'Commission Amount';  ?></th>
										<th><?php echo(!empty($revenue['lg_admin_status']))?($revenue['lg_admin_status']) : 'Status';  ?></th>
									</tr>
								</thead>
								<tbody>
								<?php
								if(!empty($list)) {
									$i=1;
								foreach ($list as $rows) { 
                                $amount=$rows['amount'];
                                $comi=$rows['commission'];
								if($comi == ''){
									$comi = 0;
								}else{
									$comi = (float) $comi;
								}
                                $comAount=(int)$amount *$comi/100;
                                $user_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
                                $this->db->where('modules', 'user');
		                        if(!empty($rows['user_id'])){
		                        $this->db->where('name_id', $rows['user_id']);
		                        }
		                        $this->db->where('lang_type', $user_lang);
		                        $lang_user = $this->db->get('users_lang')->row_array();

		                        $this->db->where('modules', 'provider');
		                        if(!empty($rows['provider_id'])){
		                        $this->db->where('name_id', $rows['provider_id']);
		                        }
		                        $this->db->where('lang_type', $user_lang);
		                        $lang_pro = $this->db->get('users_lang')->row_array();

		                        $this->db->where('id', $rows['provider_id']);
                    			$pro_name = $this->db->get('providers')->row_array();

                    			$this->db->where('id', $rows['user_id']);
                    			$user_name = $this->db->get('users')->row_array();
                                ?>
								<tr>
									 
									<td><?php echo $i++; ?></td> 
									<td><?=date(settingValue('date_format'), strtotime($rows['date']));?></td>
									<td><?php
											echo ($lang_pro)?$lang_pro['name']:$user_name['name'];
										?>
									</td> 
									<td><?php
											echo ($lang_user)?$lang_user['name']:$pro_name['name'];
										?>
									</td> 
									<td><?php echo currency_code_sign($rows['currency_code']).($rows['amount']); ?></td> 
									<td><?php echo currency_code_sign($rows['currency_code']).($comAount); ?></td> 
									<td><label class="badge badge-success">Completed</label></td> 
									
									<!-- Compete Request Accept update_status_user -->

								</tr>
								<?php } } else {
								?>
								<tr>
									<td colspan="9">
										<div class="text-center text-muted"><?php echo(!empty($revenue['lg_admin_no_records_found']))?($revenue['lg_admin_no_records_found']) : 'No Records Found';  ?></div>
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