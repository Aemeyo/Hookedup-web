<?php
   $user_details = $this->db->get('users')->result_array();
   $adminuser = $language_content;
?>
<div class="page-wrapper">
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title"><?php echo(!empty($adminuser['lg_admin_users']))?($adminuser['lg_admin_users']) : 'Users';  ?></h3>
				</div>
				<div class="col-auto text-right">
					<a class="btn btn-white filter-btn mr-3" href="javascript:void(0);" id="filter_search">
						<i class="fas fa-filter"></i>
					</a>
					<a href="<?php echo base_url().'users/edit/'; ?>" class="btn btn-primary add-button"><i class="fas fa-plus"></i></a>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		
		<!-- Search Filter -->
		<form action="<?php echo base_url()?>admin/dashboard/users_list" method="post" id="filter_inputs">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
    
			<div class="card filter-card">
				<div class="card-body pb-0">
					<div class="row filter-row">
					
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($adminuser['lg_admin_user_name']))?($adminuser['lg_admin_user_name']) : 'User Name';  ?></label>
								<select class="form-control" name="username">
									<option value=""><?php echo(!empty($adminuser['lg_admin_select_user_name']))?($adminuser['lg_admin_select_user_name']) : 'Select user name';  ?></option>
									<?php foreach ($user_details as $user) {
										$user_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
										$this->db->where('modules', 'user');
										if (!empty($user['id'])) {
								        $this->db->where('name_id', $user['id']);
								        }
								        $this->db->where('lang_type', $user_lang);
								        $user_name = $this->db->get('users_lang')->row_array();
								    ?>
									<option value="<?=$user['name']?>"><?php
												echo ($user_name)?$user_name['name']: $user['name'];?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label class="col-form-label"><?php echo(!empty($adminuser['lg_admin_email_id']))?($adminuser['lg_admin_email_id']) : 'Email Id';  ?></label>
								<select class="form-control" name="email">
									<option value=""><?php echo(!empty($adminuser['lg_admin_select_email']))?($adminuser['lg_admin_select_email']) : 'Select email';  ?></option>
									<?php foreach ($user_details as $user) { ?>
									<option value="<?=$user['email']?>"><?php echo $user['email']?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($adminuser['lg_admin_from_date']))?($adminuser['lg_admin_from_date']) : 'From Date';  ?></label>
								<div class="cal-icon">
									<input class="form-control start_date" type="text" name="from">
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($adminuser['lg_admin_to_date']))?($adminuser['lg_admin_to_date']) : 'To Date';  ?></label>
								<div class="cal-icon">
									<input class="form-control end_date" type="text" name="to">
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<button class="btn btn-primary btn-block" name="form_submit" value="submit" type="submit"><?php echo(!empty($adminuser['lg_admin_submit']))?($adminuser['lg_admin_submit']) : 'Submit';  ?></button>
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
                            <table class="custom-table table table-hover table-center mb-0 w-100" id="users_table">
                                <thead>
                                    <tr>
                                        <th><?php echo(!empty($adminuser['lg_admin_#']))?($adminuser['lg_admin_#']) : '#';  ?></th>
                                        <th><?php echo(!empty($adminuser['lg_admin_user_name']))?($adminuser['lg_admin_user_name']) : 'User Name';  ?></th>
                                        <th><?php echo(!empty($adminuser['lg_admin_email']))?($adminuser['lg_admin_email']) : 'Email';  ?></th>
                                        <th><?php echo(!empty($adminuser['lg_admin_contact']))?($adminuser['lg_admin_contact']) : 'Contact Nos';  ?></th>
                                        <th><?php echo(!empty($adminuser['lg_admin_signup_date']))?($adminuser['lg_admin_signup_date']) : 'Signup Date';  ?></th>
										<th><?php echo(!empty($adminuser['lg_admin_last_login']))?($adminuser['lg_admin_last_login']) : 'Last Login';  ?></th>
										<th><?php echo(!empty($adminuser['lg_admin_status']))?($adminuser['lg_admin_status']) : 'Status';  ?></th>
                               		 	<th><?php echo(!empty($adminuser['lg_admin_action']))?($adminuser['lg_admin_action']) : 'Action';  ?></th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php

									if(!empty($lists)) {
										$i=1;
										foreach ($lists as $rows) {
											if($rows['status']==1) {
												$val='checked';
												$tag='data-toggle="tooltip" title="Click to Deactivate User ..!"';
											}
											else {
												$val='';
												$tag='data-toggle="tooltip" title="Click to Activate User ..!"';
											}
											$profile_img = $rows['profile_img'];
											if(empty($profile_img)){
												$profile_img ='assets/img/user.jpg';
											}
											$avail=$rows['id'];
											if($avail==0){
		                                        $attr='';
		                                        $tag='';
											}else{
		                                        $attr='disabled';
		                                        $tag='data-toggle="tooltip" title="Some One was Booked The Service So You Cannot Modified It ..!"';
											}
											if(!empty($rows['created_at'])){
												$date=date(settingValue('created_at'), strtotime($rows['last_login']));
											}else{
												$date='-';
											}
											

											$base_url = base_url()."users/edit/".$rows['id'];

											$action = "<a href='".$base_url."'' class='btn btn-sm bg-success-light mr-2'><i class='far fa-edit mr-1'></i> Edit </a>
												<a class='btn btn-sm bg-danger-light delete_show' data-id='".$rows['id']."'><i class='far fa-trash-alt mr-1' ></i> Delete</a>";

											echo'<tr>
											<td>'.$i++.'</td>
											<td>
												<h2 class="table-avatar">
													<a href="#" class="avatar avatar-sm mr-2">
														<img class="avatar-img rounded-circle" alt="" src="'.base_url().$profile_img.'">
													</a>
													<a href="'.base_url().'user-details/'.$rows['id'].'">'.str_replace('-', ' ', $rows['name']).'</a>
												</h2>
											</td>
											<td>'.$rows['email'].'</td>
											<td>'.$rows['mobileno'].'</td>
											<td>'.$rows['created_at'].'</td>
											<td>'.$rows['last_login'].'</td>
	                                        <td>
	                                        	<div '.$tag.'>
												<div class="status-toggle mb-2">
													<input '.$attr.' disabled id="status_'.$rows['id'].'" class="check change_Status_provider1" data-id="'.$rows['id'].' type="checkbox" '.$val.'>
													<label for="status_'.$rows['id'].'" class="checktoggle">checkbox</label>
												</div>
											</div>
											</td>
											<td>'.$action.'</td>
											</tr>';
										}
                                    }
                                    else {
										echo '<tr><td colspan="6"><div class="text-center text-muted">No records found</div></td></tr>';
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootbox.min.js"></script>