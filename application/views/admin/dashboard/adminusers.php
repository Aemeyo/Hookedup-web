<?php
   $user_details = $this->db->get('administrators')->result_array();
   $adminuser = $language_content;
?>
<div class="page-wrapper">
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title"><?php echo(!empty($adminuser['lg_admin_admin_users']))?($adminuser['lg_admin_admin_users']) : 'Admin Users';  ?></h3>
				</div>
				<div class="col-auto text-right">
					<a class="btn btn-white filter-btn mr-3" href="javascript:void(0);" id="filter_search">
						<i class="fas fa-filter"></i>
					</a>
					<a href="<?=base_url().'adminusers/edit/';?>" class="btn btn-primary add-button"><i class="fas fa-plus"></i></a>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		
		<!-- Search Filter -->
		<form action="<?php echo base_url()?>admin/dashboard/adminusers_list" method="post" id="filter_inputs">
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
										$admin_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
										$this->db->where('modules', 'admin');
							      $this->db->where('name_id', $user['user_id']);
							      $this->db->where('lang_type', $admin_lang);
							      $admin_name = $this->db->get('users_lang')->row_array();
									?>
									<option value="<?=$user['username']?>"><?php echo $admin_name['name']?></option>
									<?php } ?>
								</select>
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
              <table class="custom-table table table-hover table-center mb-0 w-100" id="adminusers_table">
                <thead>
                  <tr>
                    <th><?php echo(!empty($adminuser['lg_admin_#']))?($adminuser['lg_admin_#']) : '#';  ?></th>
                    <th><?php echo(!empty($adminuser['lg_admin_full_name']))?($adminuser['lg_admin_full_name']) : 'Full Name';  ?></th>
                    <th><?php echo(!empty($adminuser['lg_admin_username']))?($adminuser['lg_admin_username']) : 'User Name';  ?></th>
										<th><?php echo(!empty($adminuser['lg_admin_email_id']))?($adminuser['lg_admin_email_id']) : 'Email ID';  ?></th>
                    <th><?php echo(!empty($adminuser['lg_admin_action']))?($adminuser['lg_admin_action']) : 'Action';  ?></th>
                  </tr>
                </thead>
              	<tbody>
									<?php
									if(!empty($lists)) {
										$i=1;
										foreach ($lists as $rows) {
											if($rows['profile_img']) {
												$profile_img = $rows['profile_img'];
											} else {
												$profile_img ='assets/img/user.jpg';
											}
										 	$base_url=base_url()."adminusers/edit/".$rows['user_id'];

											$action="<a href='".$base_url."'' class='btn btn-sm bg-success-light mr-2'><i class='far fa-edit mr-1'></i> ".$adminuser['lg_admin_edit']." </a>";
											if($user_role==1){
												$action .="<a class='btn btn-sm bg-danger-light delete_show' data-id='".$rows['user_id']."'><i class='far fa-trash-alt mr-1' ></i> ".$adminuser['lg_admin_delete']."</a>";
										}

										$admin_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
										$this->db->where('modules', 'admin');
							      $this->db->where('name_id', $rows['user_id']);
							      $this->db->where('lang_type', $admin_lang);
							      $admin_name = $this->db->get('users_lang')->row_array();
							      $admin_val_name = $admin_name['name'];
											echo'<tr>
												<td>'.$i++.'</td>
												<td>
													<h2 class="table-avatar">
														<a href="#" class="avatar avatar-sm mr-2">
															<img class="avatar-img rounded-circle" alt="" src="'.base_url().$profile_img.'">
														</a>
														<a href="'.base_url().'adminuser-details/'.$rows['user_id'].'">'.str_replace('-', ' ', $admin_val_name).'</a>
													</h2>
												</td>
												<td>'.$rows['username'].'</td>
												<td>'.$rows['email'].'</td>
												<td>'.$action.'</td>
											</tr>';
										}              
									}
									else {
										echo '<tr><td colspan="5"><div class="text-center text-muted">No records found</div></td></tr>';
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

<div class="modal" id="delete_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5><?php echo(!empty($adminuser['lg_admin_delete_confirmation']))?($adminuser['lg_admin_delete_confirmation']) : 'Delete Confirmation';  ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><?php echo(!empty($adminuser['lg_admin_confirm_delete']))?($adminuser['lg_admin_confirm_delete']) : 'Are you confirm to Delete.';  ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" id="confirm_btn_admin" data-id="" class="btn btn-primary"><?php echo(!empty($adminuser['lg_admin_confirm']))?($adminuser['lg_admin_confirm']) : 'Confirm';  ?></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo(!empty($adminuser['lg_admin_cancel']))?($adminuser['lg_admin_cancel']) : 'Cancel';  ?></button>
      </div>
    </div>
  </div>
</div>
