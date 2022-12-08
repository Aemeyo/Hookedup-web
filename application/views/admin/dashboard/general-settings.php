<?php 
$admin_settings = $language_content;

$query = $this->db->query("select * from language WHERE status = '1'");
$lang_test = $query->result();
?>
<div class="page-wrapper">
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-12">
					<h3 class="page-title"><?php echo(!empty($admin_settings['lg_admin_general_settings']))?($admin_settings['lg_admin_general_settings']) : 'General Settings';  ?></h3>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		<div class="row">
			<div class=" col-lg-6 col-sm-12 col-12">
				<form accept-charset="utf-8" id="general_settings" action="" method="POST" enctype="multipart/form-data">
				<div class="card">
					<div class="card-header">
						<div class="card-heads">
							<h4 class="card-title"><?php echo(!empty($admin_settings['lg_admin_website_basic_details']))?($admin_settings['lg_admin_website_basic_details']) : 'Website Basic Details';  ?></h4>
						</div>
					</div>
					<div class="card-body">
						<input type="hidden" id="user_csrf" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
						<?php foreach ($lang_test as $langval) { 
							$this->db->where('modules', 'website');
						    $this->db->where('lang_type', $langval->language_value);
						    $lang_website_check = $this->db->get('cookies')->result_array();
						?>
						<div class="form-group">
							<label><?php echo(!empty($admin_settings['lg_admin_website_name']))?($admin_settings['lg_admin_website_name']) : 'Website Name';  ?><span class="manidory">*</span>(<?php echo $langval->language; ?>)</label>
						<?php foreach ($lang_website_check as $website_check) { ?>
							<input type="text" class="form-control" name="website_name_<?php echo $langval->id; ?>" id="website_name" placeholder="Enter Website Name" value="<?php echo $website_check['cookie_name']; ?>">
						<?php } ?>
						</div>
						<?php } ?>
						<div class="form-group">
							<label><?php echo(!empty($admin_settings['lg_admin_contact_details']))?($admin_settings['lg_admin_contact_details']) : 'Contact Details';  ?> <span class="manidory">*</span></label>
							<input type="text" class="form-control" name="contact_details" id="contact_details"  placeholder="Enter contact details" value="<?php echo $contact_details; ?>">
						</div>
						<div class="form-group">
							<label><?php echo(!empty($admin_settings['lg_admin_mobile_number']))?($admin_settings['lg_admin_mobile_number']) : 'Mobile Number';  ?> <span class="manidory">*</span></label>
							<input type="text" class="form-control" name="mobile_number" id="mobile_number" placeholder="Enter Mobile Number" value="<?php echo $mobile_number; ?>">
						</div>

						<div class="form-group">
							<label><?php echo(!empty($admin_settings['lg_admin_language']))?($admin_settings['lg_admin_language']) : 'Language';  ?><span class="manidory">*</span></label>
							 <select class="form-control" name="language" id="language" required>
							 	<option value=""><?php echo(!empty($admin_settings['lg_admin_select_language']))?($admin_settings['lg_admin_select_language']) : 'Select Language';  ?></option>
                                <?php foreach ($languages as $lang) { ?>
                                    <option value="<?php echo $lang['language_value']; ?>" <?php if ($lang['language_value'] == $language) echo 'selected'; ?>><?php echo $lang['language']; ?>
                                    </option>
                                <?php } ?>
                            </select>
						</div>
						<div class="form-group mb-5">
							<label class="d-flex">
								<span><?php echo(!empty($admin_settings['lg_admin_service_location_radius']))?($admin_settings['lg_admin_service_location_radius']) : 'Service Location Radius';  ?> </span>
								<div class="ml-3">
									<input  id="radius_showhide" class="check" type="checkbox" name="radius_showhide"<?=settingValue('radius_showhide')?'checked':'';?>>
									<label for="radius_showhide" id="loc_radius_showhide" class="checktoggle">checkbox</label>
								</div>
							</label>
							<div class="loan-set text-center my-2">
								<h3 ><span id="currencys"></span> <?php echo(!empty($admin_settings['lg_admin_km']))?($admin_settings['lg_admin_km']) : 'km';  ?></h3>
							</div>
							<input type="range" min="1" max="10000" value="<?php echo $radius; ?>" class="slider" id="myRange">
							<input type="hidden" name="radius" id="radius" class="form-control" value="<?php echo $radius; ?>">
						</div>
						<div class="form-group">
							<label><?php echo(!empty($admin_settings['lg_admin_commission_percentage']))?($admin_settings['lg_admin_commission_percentage']) : 'Commission Percentage';  ?></label>
							<input type="text" class="form-control" name="commission" id="commission" placeholder="" value="<?php echo $commission; ?>">
						</div>

						<div class="form-group">
							<label class="d-flex">
								<span>Service Location Type</span>
							</label>
							<div class="form-group mb-4">
								<div class="custom-control custom-radios custom-control-inline">
									<input class="custom-control-input" id="manual" type="radio"  name="location_type" value="manual" <?php if($location_type == 'manual') { echo 'checked'; } ?> >
									<label class="custom-control-label" for="manual"><?php echo(!empty($admin_settings['lg_manual']))?($admin_settings['lg_manual']) : 'Manual';  ?></label>
								</div>
								<div class="custom-control custom-radios custom-control-inline">
									<input class="custom-control-input" id="live" type="radio"  name="location_type" value="live"  <?php if($location_type == 'live') { echo 'checked'; } ?> >
									<label class="custom-control-label" for="live"><?php echo(!empty($admin_settings['lg_live']))?($admin_settings['lg_live']) : 'Live';  ?></label>
								</div>
							</div>
						</div>
						<div class="form-groupbtn">
							<button name="form_submit" type="submit" class="btn btn-update me-2" value="true"><?php echo(!empty($admin_settings['lg_admin_update']))?($admin_settings['lg_admin_update']) : 'Update';  ?></button>
						</div>
					</div>
				</div>
			</form>
			<form accept-charset="utf-8" id="placeholder_settings" action="" method="POST" enctype="multipart/form-data">
					<input type="hidden" id="user_csrf" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
					<div class="card">
						<div class="card-header">
							<div class="card-heads">
								<h4 class="card-title"><?php echo(!empty($admin_settings['lg_admin_placeholder_image_settings']))?($admin_settings['lg_admin_placeholder_image_settings']) : 'Placeholder Image Settings';  ?></h4>
							</div>
						</div>
						<div class="card-body">
							<div class="form-group ">
								<p class="settings-label"><?php echo(!empty($admin_settings['lg_admin_service_placeholder']))?($admin_settings['lg_admin_service_placeholder']) : 'Service Placeholder';  ?> <span class="manidory">*</span></p>
									<input type="file" accept="image/*" name="service_placeholder_image" id="service_placeholder_image" class="form-control">
								<h6 class="settings-size">Recommended image size is <span>800px x 600px</span></h6>
								<div class="upload-images">
									<?php if (!empty($service_placeholder_image)) { ?><img src="<?php echo base_url() . $service_placeholder_image ?>" class="site-logo"><?php } ?>
								</div>
							</div>
							<div class="form-group mb-0">
								<p class="settings-label"><?php echo(!empty($admin_settings['lg_admin_profile_placeholder']))?($admin_settings['lg_admin_profile_placeholder']) : 'Profile Placeholder';  ?><span class="manidory">*</span></p>
									<input type="file" accept="image/*" name="profile_placeholder_image" id="profile_placeholder_image" class="form-control">
								<h6 class="settings-size">Recommended image size is <span>300px x 300px</span></h6>
								<div class="upload-images upload-imagesprofile">
									<?php if (!empty($profile_placeholder_image)) { ?><img src="<?php echo base_url() . $profile_placeholder_image ?>" class="site-logo"><?php } ?>
								</div>
							</div><br>
							<div class="form-groupbtn">
								<button name="form_submit" type="submit" class="btn btn-update me-2" value="true"><?php echo(!empty($admin_settings['lg_admin_update']))?($admin_settings['lg_admin_update']) : 'Update';  ?></button>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class=" col-lg-6 col-sm-12 col-12">
				<form accept-charset="utf-8" id="image_settings" action="" method="POST" enctype="multipart/form-data">
					<input type="hidden" id="user_csrf" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
					<div class="card">
						<div class="card-header">
							<div class="card-heads">
								<h4 class="card-title"><?php echo(!empty($admin_settings['lg_admin_image_settings']))?($admin_settings['lg_admin_image_settings']) : 'Image Settings';  ?></h4>
							</div>
						</div>
						<div class="card-body">
							<div class="form-group">
								<p class="settings-label"><?php echo(!empty($admin_settings['lg_admin_logo']))?($admin_settings['lg_admin_logo']) : 'Logo';  ?> <span class="manidory">*</span></p>
									<input type="file" accept="image/*" name="logo_front" id="logo_front" class="form-control">
								<h6 class="settings-size">Recommended image size is <span>280px x 36px</span></h6>
								<div class="upload-images ">
									<?php if (!empty($logo_front)) { ?><img src="<?php echo base_url() . $logo_front ?>" class="site-logo"><?php } ?>
								</div>
							</div>
							<div class="form-group">
								<p class="settings-label"><?php echo(!empty($admin_settings['lg_admin_favicon']))?($admin_settings['lg_admin_favicon']) : 'Favicon';  ?> <span class="manidory">*</span></p>
									<input type="file" accept="image/*" name="favicon" id="favicon"  class="form-control">
								<h6 class="settings-size">Recommended image size is <span>16px x 16px or 32px x 32px</span></h6>
								<h6 class="settings-size"> Accepted formats: only png and icon</h6>
								<div class="upload-images upload-imagesprofile">
									<?php if (!empty($favicon)) { ?><img src="<?php echo base_url() .'uploads/logo/'.$favicon ?>" class="fav-icon"><?php } ?>
								</div>
							</div>
							<div class="form-group">
								<p class="settings-label"><?php echo(!empty($admin_settings['lg_admin_icon']))?($admin_settings['lg_admin_icon']) : 'Icon';  ?> <span class="manidory">*</span></p>
									<input type="file" accept="image/*" name="header_icon" id="header_icon" class="form-control">
								<h6 class="settings-size">Recommended image size is <span>100px x 100px </span></h6>
								<div class="upload-images upload-imagesprofile">
									<?php if (!empty($header_icon)) { ?><img src="<?php echo base_url() . $header_icon ?>" class="fav-icon"><?php } ?>
								</div>
							</div>
							<div class="form-groupbtn">
								<button name="form_submit" type="submit" class="btn btn-update me-2" value="true"><?php echo(!empty($admin_settings['lg_admin_update']))?($admin_settings['lg_admin_update']) : 'Update';  ?></button>
							</div>
						</div>
					</div>
				</form>

				<form accept-charset="utf-8" id="demo_access_settings" action="" method="POST" enctype="multipart/form-data">
					<input type="hidden" id="user_csrf" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
					<div class="card">
						<div class="card-header">
							<div class="card-heads">
								<h4 class="card-title"><?php echo(!empty($admin_settings['lg_admin_access_settings']))?($admin_settings['lg_admin_access_settings']) : 'Admin Access Settings';  ?></h4>
							</div>
						</div>
						<div class="card-body">
							<div class="form-group">
								<p class="settings-label"><?php echo(!empty($admin_settings['lg_admin_demo_access']))?($admin_settings['lg_admin_demo_access']) : 'Demo Access';  ?><h6 class="settings-size"><span></span></h6></p>
								<div class="form-group mb-4">
									<div class="custom-control custom-radios custom-control-inline">
										<input class="custom-control-input" id="yes" type="radio"  name="demo_access" value="1" <?php if($demo_access == '1') { echo 'checked'; } ?> >
										<label class="custom-control-label" for="yes"><?php echo(!empty($admin_settings['lg_yes']))?($admin_settings['lg_yes']) : 'Yes';  ?></label>
									</div>
									<div class="custom-control custom-radios custom-control-inline">
										<input class="custom-control-input" id="no" type="radio"  name="demo_access" value="0"  <?php if($demo_access == '0') { echo 'checked'; } ?> >
										<label class="custom-control-label" for="no"><?php echo(!empty($admin_settings['lg_no']))?($admin_settings['lg_no']) : 'No';  ?></label>
									</div>
								</div>
							</div>
							<div class="form-groupbtn">
								<button name="form_submit" type="submit" class="btn btn-update me-2" value="true"><?php echo(!empty($admin_settings['lg_admin_update']))?($admin_settings['lg_admin_update']) : 'Update';  ?></button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>