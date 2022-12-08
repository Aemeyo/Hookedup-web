<?php 
$user_id = $this->uri->segment('2');
$user_details = $this->db->where('id',$user_id)->get('users')->row_array();
$adminuser = $language_content;
?>
<div class="page-wrapper">
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title"><?php echo(!empty($adminuser['lg_admin_users_details']))?($adminuser['lg_admin_users_details']) : 'Users Details';  ?></h3>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		
		<div class="row">
			<div class="col-lg-4">
				<div class="card">
					<div class="card-body text-center">
						<?php if($user_details['profile_img'] != '')
						{?>
						<img class="rounded-circle img-fluid mb-3" alt="User Image" src="<?php echo $base_url.$user_details['profile_img'] ?>">
						<?php } else { ?>
						<img class="rounded-circle img-fluid mb-3" alt="User Image" src="<?php echo $base_url?>assets/img/user.jpg">
						<?php } ?>
						<h5 class="card-title text-center">
							<span><?php echo(!empty($adminuser['lg_admin_account_status']))?($adminuser['lg_admin_account_status']) : 'Account Status';  ?></span>
						</h5>
						<?php
						if($user_details['status']==1) {
							$val='checked';
						}
						else {
							$val='';
						}
						?>
						<?php if($user_details['status'] == 1) { ?>
						<button class="btn btn-success" type="button"><i class="fas fa-user-check"></i> <?php echo(!empty($adminuser['lg_admin_active']))?($adminuser['lg_admin_active']) : 'Active';  ?></button>
						<?php } else { ?>
						<button class="btn btn-danger" type="button"><i class="fas fa-user-check"></i> <?php echo(!empty($adminuser['lg_admin_inactive']))?($adminuser['lg_admin_inactive']) : 'Inactive';  ?></button>
						<?php } ?>
					</div>
				</div>
			</div>
			
			<div class="col-lg-8">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title d-flex justify-content-between">
							<span><?php echo(!empty($adminuser['lg_admin_personal_details']))?($adminuser['lg_admin_personal_details']) : 'Personal Details';  ?></span>
						</h5>
						<div class="row">
							<p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3"><?php echo(!empty($adminuser['lg_admin_name']))?($adminuser['lg_admin_name']) : 'Name';  ?></p>
							<?php 
								$user_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
		                        $this->db->where('modules', 'user');
		                        $this->db->where('name_id', $user_details['id']);
		                        $this->db->where('lang_type', $user_lang);
		                        $lang_user = $this->db->get('users_lang')->row_array();
							?>
							<p class="col-sm-9">
								<?php
									echo ($lang_user)?$lang_user['name']: $user_details['name'];
								?>
							</p>
						</div>
						<div class="row">
							<p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3"><?php echo(!empty($adminuser['lg_admin_email_id']))?($adminuser['lg_admin_email_id']) : 'Email Id';  ?></p>
							<p class="col-sm-9"><?php echo $user_details['email']?></p>
						</div>
						<div class="row">
							<p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3"><?php echo(!empty($adminuser['lg_admin_mobile']))?($adminuser['lg_admin_mobile']) : 'Mobile';  ?></p>
							<p class="col-sm-9"><?php echo $user_details['country_code']?>-<?php echo $user_details['mobileno']?></p>
						</div>
					</div>
				</div> 
				<div class="card">
					<div class="card-body">
						<h5 class="card-title d-flex justify-content-between">
							<span><?php echo(!empty($adminuser['lg_admiin_account_details']))?($adminuser['lg_admiin_account_details']) : 'Account Details';  ?></span>
						</h5>
						<div class="row">
							<p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3"><?php echo(!empty($adminuser['lg_admin_account_holder_name']))?($adminuser['lg_admin_account_holder_name']) : 'Account holder name';  ?></p>
							<p class="col-sm-9"><?php echo $user_details['account_holder_name']?></p>
						</div>
						<div class="row">
							<p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3"><?php echo(!empty($adminuser['lg_admin_account_number']))?($adminuser['lg_admin_account_number']) : 'Account Number';  ?></p>
							<p class="col-sm-9"><?php echo $user_details['account_number']?></p>
						</div>
						<div class="row">
							<p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3"><?php echo(!empty($adminuser['lg_admin_iban_number']))?($adminuser['lg_admin_iban_number']) : 'IBAN Number';  ?></p>
							<p class="col-sm-9"><?php echo $user_details['account_iban']?></p>
						</div>
						<div class="row">
							<p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3"><?php echo(!empty($adminuser['lg_admin_bank_name']))?($adminuser['lg_admin_bank_name']) : 'Bank Name';  ?></p>
							<p class="col-sm-9 mb-0"><?php echo $user_details['bank_name']?></p>
						</div>
						<div class="row">
							<p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3"><?php echo(!empty($adminuser['lg_admin_bank_address']))?($adminuser['lg_admin_bank_address']) : 'Bank Address';  ?></p>
							<p class="col-sm-9 mb-0"><?php echo $user_details['bank_address']?></p>
						</div>
						<div class="row">
							<p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3"><?php echo(!empty($adminuser['lg_admin_sort_code']))?($adminuser['lg_admin_sort_code']) : 'Sort Code';  ?></p>
							<p class="col-sm-9 mb-0"><?php echo $user_details['sort_code']?></p>
						</div>
						<div class="row">
							<p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3"><?php echo(!empty($adminuser['lg_admin_swift_code']))?($adminuser['lg_admin_swift_code']) : 'Swift Code';  ?></p>
							<p class="col-sm-9 mb-0"><?php echo $user_details['routing_number']?></p>
						</div>
						<div class="row">
							<p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3"><?php echo(!empty($adminuser['lg_admin_ifsc_code']))?($adminuser['lg_admin_ifsc_code']) : 'IFSC Code';  ?></p>
							<p class="col-sm-9 mb-0"><?php echo $user_details['account_ifsc']?></p>
						</div>
					</div>
				</div>                      
			</div>
		</div>
	</div>
</div>