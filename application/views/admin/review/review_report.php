<?php 
$review_report = $language_content;
?>
<div class="page-wrapper">
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title"><?php echo(!empty($review_report['lg_admin_ratings']))?($review_report['lg_admin_ratings']) : 'Ratings';  ?></h3>
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
		<form action="<?php echo base_url()?>review-reports" method="post" id="filter_inputs">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
    

			<div class="card filter-card">
				<div class="card-body pb-0">
					<div class="row filter-row">
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($review_report['lg_admin_service']))?($review_report['lg_admin_service']) : 'Service';  ?></label>
								<select class="form-control" name="service_id">
									<option value=""><?php echo(!empty($review_report['lg_admin_select_service']))?($review_report['lg_admin_select_service']) : 'Select Service';  ?></option>
									<?php foreach ($service_list as $pro) { 
										$ser_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
	                                    $this->db->where('service_id', $pro['id']);
	                                    $this->db->where('lang_type', $ser_lang);
	                                    $service_name = $this->db->get('service_lang')->row_array();
									?>
									<option value="<?=$pro['id']?>"><?php echo $service_name['service_name']?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($review_report['lg_admin_provider_name']))?($review_report['lg_admin_provider_name']) : 'Provider Name';  ?></label>
								<select class="form-control" name="provider_id">
									<option value=""><?php echo(!empty($review_report['lg_admin_select_provider']))?($review_report['lg_admin_select_provider']) : 'Select Provider';  ?></option>
									<?php foreach ($provider_list as $pro) { 
										$user_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
				                        $this->db->where('modules', 'provider');
				                        if (!empty($pro['id'])) {
				                        $this->db->where('name_id', $pro['id']);
				                        }
				                        $this->db->where('lang_type', $user_lang);
				                        $lang_pro = $this->db->get('users_lang')->row_array();
									?>
									<option value="<?=$pro['id']?>"><?php echo ucfirst($lang_pro['name']);?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($review_report['lg_admin_user_name']))?($review_report['lg_admin_user_name']) : 'User Name';  ?></label>
								<select class="form-control" name="user_id">
									<option value=""><?php echo(!empty($review_report['lg_admin_select_user']))?($review_report['lg_admin_select_user']) : 'Select User';  ?></option>
									<?php foreach ($user_list as $pro) { 
										$user_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
				                        $this->db->where('modules', 'user');
				                        if (!empty($pro['id'])) {
				                        $this->db->where('name_id', $pro['id']);
				                        }
				                        $this->db->where('lang_type', $user_lang);
				                        $lang_user = $this->db->get('users_lang')->row_array();
									?>
									<option value="<?=$pro['id']?>"><?php echo ucfirst($lang_user['name']);?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($review_report['lg_admin_type']))?($review_report['lg_admin_type']) : 'Type';  ?></label>
								<select class="form-control" name="type_id">
									<option value=""><?php echo(!empty($review_report['lg_admin_select_type']))?($review_report['lg_admin_select_type']) : 'Select Type';  ?></option>
									<?php foreach ($rating_type as $pro) { ?>
									<option value="<?=$pro['id']?>"><?php echo $pro['name']?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($review_report['lg_admin_from_date']))?($review_report['lg_admin_from_date']) : 'From Date';  ?></label>
								<div class="cal-icon">
									<input class="form-control start_date" type="text" name="from">
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($review_report['lg_admin_to_date']))?($review_report['lg_admin_to_date']) : 'To Date';  ?></label>
								<div class="cal-icon">
									<input class="form-control end_date" type="text" name="to">
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<button class="btn btn-primary btn-block" name="form_submit" value="submit" type="submit"><?php echo(!empty($review_report['lg_admin_submit']))?($review_report['lg_admin_submit']) : 'Submit';  ?></button>
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
							<table class=" table table-hover table-center mb-0 payment_table">
								<thead>
									<tr>
										<th><?php echo(!empty($review_report['lg_admin_#']))?($review_report['lg_admin_#']) : '#';  ?></th>
										<th><?php echo(!empty($review_report['lg_admin_date']))?($review_report['lg_admin_date']) : 'Date';  ?></th>
										<th><?php echo(!empty($review_report['lg_admin_provider_name']))?($review_report['lg_admin_provider_name']) : 'Provider Name';  ?></th>
										<th><?php echo(!empty($review_report['lg_admin_user_name']))?($review_report['lg_admin_user_name']) : 'User Name';  ?></th>
										<th><?php echo(!empty($review_report['lg_admin_service_name']))?($review_report['lg_admin_service_name']) : 'Service Name';  ?></th>
										<th><?php echo(!empty($review_report['lg_admin_type']))?($review_report['lg_admin_type']) : 'Type';  ?></th>
										<th><?php echo(!empty($review_report['lg_admin_ratings']))?($review_report['lg_admin_ratings']) : 'Ratings';  ?></th>
										<th><?php echo(!empty($review_report['lg_admin_comments']))?($review_report['lg_admin_comments']) : 'Comments';  ?></th>
										
										<!-- <th class="text-right">Action</th> -->
									
									</tr>
								</thead>
								<tbody>
								<?php
								if(!empty($list)) {
									$i=1;
								foreach ($list as $rows) { 
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

			                        $this->db->where('service_id', $rows['service_id']);
                                    $this->db->where('lang_type', $user_lang);
                                    $service_name = $this->db->get('service_lang')->row_array();
								?> 
								<tr>
									<td><?php echo $i++ ?></td> 
									<td><?=date(settingValue('date_format'), strtotime($rows['created']));?></td>
									<td><?php
											echo ($lang_pro)?$lang_pro['name']:$rows['provider_name'];
										?>
									</td> 
									<td><?php
											echo ($lang_user)?$lang_user['name']:$rows['user_name'];
										?>
									</td> 
									<td><?php echo $service_name['service_name']?></td>
									<td><?php echo $rows['type_name']?></td>
									<td><?php echo $rows['rating']?></td>
									<td><?php echo wordwrap($rows['review'], 60, '<br />', true);?></td>
									<?php /*if($user_role==1) { ?>
									<td class="text-right">
										<a data-id="<?php echo $rows['id']?>"  href="javascript:void(0);" class="btn btn-sm bg-danger-light mr-2 delete_review_comment">
											<i class="far fa-trash-alt mr-1"></i> <?php echo(!empty($review_report['lg_admin_delete']))?($review_report['lg_admin_delete']) : 'Delete';  ?>
										</a>
									</td>
								<?php } else { ?>
									<td class="text-right">
										<a href="javascript:void(0);" class="btn btn-sm bg-danger-light mr-2">
											<i class="far fa-trash-alt mr-1"></i> <?php echo(!empty($review_report['lg_admin_delete']))?($review_report['lg_admin_delete']) : 'Delete';  ?>
										</a>
									</td>
							<?php } */ ?>
								</tr>
								<?php } } else {
								?>
								<tr>
									<td colspan="9">
										<div class="text-center text-muted">No records found</div>
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