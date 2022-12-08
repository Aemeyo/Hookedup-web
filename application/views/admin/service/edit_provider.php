<?php 
$service_providers = $language_content;

$query = $this->db->query("select * from language WHERE status = '1'");
$lang_test = $query->result();
?>
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="row">
			<div class="col-xl-8 offset-xl-2">
			
				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col">
							<h3 class="page-title"><?=$title;?></h3>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				
				<div class="card">
					<div class="card-body">
						<form id="add_provider" method="post" autocomplete="off" enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?=(!empty($user['id']))?$user['id']:''?>" id="user_id">
							<input type="hidden" id="provider_csrf" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
							<?php 
    						 foreach ($lang_test as $langval) { 
							 	if(!empty($user)){
							 	$this->db->where('modules', 'provider');
								$this->db->where('name_id', $user['id']);
						      	$this->db->where('lang_type', $langval->language_value);
						      	$lang_provider = $this->db->get('users_lang')->row_array();
						     }
    						?>
							<div class="form-group">
								<label><?php echo(!empty($service_providers['lg_admin_name']))?($service_providers['lg_admin_name']) : 'Name';  ?>(<?php echo $langval->language; ?>)</label>
								<input class="form-control" type="text"  name="name_<?php echo $langval->id; ?>" id="name" value="<?=(!empty($lang_provider['name']))?$lang_provider['name']: $user['name']?>">
							</div>
							<?php }  ?>
							<div class="form-group">
								<?php 
								if (!empty($user)) {
								$mob_no = '+'.$user['country_code'].$user['mobileno'];
									
								} ?>
								
								<label><?php echo(!empty($service_providers['lg_admin_mobile_number']))?($service_providers['lg_admin_mobile_number']) : 'Mobile Number';  ?></label><br>
								<input type="hidden" name="country_code" id="country_code" value="<?php echo (!empty($user['country_code']))?$user['country_code']:''?>">
								<input class="form-control no_only mobileno" type="text" name="mobileno" id="mobileno" value="<?php echo (!empty($user['mobileno']))?$mob_no:''?>">
							</div>
							<div class="form-group">
								<label><?php echo(!empty($service_providers['lg_admin_email']))?($service_providers['lg_admin_email']) : 'Email';  ?></label>
								<input class="form-control" type="text"  name="email" id="email" value="<?=(!empty($user['email']))?$user['email']:''?>">
							</div>
							<div class="form-group">
								<label><?php echo(!empty($service_providers['lg_admin_profile_image']))?($service_providers['lg_admin_profile_image']) : 'Profile Image';  ?></label>
								<div class="media align-items-center">
									<div class="media-left">
										<?php
										if (!empty($user['profile_img'])) { ?>
											<img class="rounded-circle" src="<?php echo base_url().$user['profile_img'];?>" width="100" height="100" class="profile-img avatar-view-img" id="preview_img">
										<?php  } else {?>
											<img class="rounded-circle" src="<?php echo base_url('assets/img/user.jpg');?>" width="100" height="100" class="profile-img avatar-view-img" id="preview_img">
											
										<?php }
										?>									
									</div>
									<div class="media-body">
										
										<div class="uploader"><button type="button" class="btn btn-secondary btn-sm ml-2 avatar-view-btn"><?php echo(!empty($service_providers['lg_admin_change_profile_picture']))?($service_providers['lg_admin_change_profile_picture']) : 'Change profile picture';  ?></button>
										<input type="hidden" id="crop_prof_img" name="profile_img" value="<?php echo(!empty($user['profile_img']))?($user['profile_img']) : '';  ?>">
										</div>
										<span id="image_error" class="text-danger" ></span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label><?php echo(!empty($service_providers['lg_admin_status']))?($service_providers['lg_admin_status']) : 'Status';  ?></label>
								&nbsp;
								<label><input type="radio" name="status" value="1" <?=(!empty($user['status'])&&$user['status']==1)?'checked':'';?>><?php echo(!empty($service_providers['lg_admin_active']))?($service_providers['lg_admin_active']) : 'Active';  ?></label>
								&nbsp;
								 <label><input type="radio" name="status" <?=(!empty($user['status'])&&$user['status']==2)?'checked':'';?> value="2"><?php echo(!empty($service_providers['lg_admin_inactive']))?($service_providers['lg_admin_inactive']) : 'Inactive';  ?></label>
							</div>
							<div class="mt-4">
								<button class="btn btn-primary " name="form_submit" value="submit" type="submit"><?php echo(!empty($service_providers['lg_admin_submit']))?($service_providers['lg_admin_submit']) : 'Submit';  ?></button>
								<a href="<?php echo $base_url; ?>service-providers"  class="btn btn-cancel"><?php echo(!empty($service_providers['lg_admin_cancel']))?($service_providers['lg_admin_cancel']) : 'Cancel';  ?></a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="avatar-modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php echo(!empty($service_providers['lg_admin_profile_image']))?($service_providers['lg_admin_profile_image']) : 'Profile Image';  ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<?php $curprofile_img = (!empty($profile['profile_img']))?$profile['profile_img']:''; ?>
				<form class="avatar-form" action="<?=base_url('admin/dashboard/crop_profile_img/'.$curprofile_img)?>" enctype="multipart/form-data" method="post">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
    
					<div class="avatar-body">
						<!-- Upload image and data -->
						<div class="avatar-upload">
							<input class="avatar-src" name="avatar_src" type="hidden">
							<input class="avatar-data" name="avatar_data" type="hidden">
							<label for="avatarInput"><?php echo(!empty($service_providers['lg_admin_select_image']))?($service_providers['lg_admin_select_image']) : 'Select Image';  ?></label>
							<input class="avatar-input" id="avatarInput" name="avatar_file" type="file" accept="image/*">
							<span id="image_upload_error" class="error" ></span>
						</div>
						<!-- Crop and preview -->
						<div class="row">
							<div class="col-md-12">
								<div class="avatar-wrapper"></div>
							</div>
						</div>
						<div class="mt-4 text-center">
							<button class="btn btn-primary avatar-save upload_images" id="upload_images" type="submit" ><?php echo(!empty($service_providers['lg_admin_yes_save_changes']))?($service_providers['lg_admin_yes_save_changes']) : 'Yes, Save Changes';  ?></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>