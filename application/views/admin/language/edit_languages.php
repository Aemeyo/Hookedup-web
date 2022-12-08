<?php 
$admin_settings = $language_content;
?>
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="row">
			<div class="col-xl-8 offset-xl-2">
			
				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col">
							<h3 class="page-title"><?php echo(!empty($admin_settings['lg_admin_edit_language']))?($admin_settings['lg_admin_edit_language']) : 'Edit Language';  ?></h3>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				
				<div class="card">
					<div class="card-body">
					
						<!-- Form -->
						<form accept-charset="utf-8" id="language_settings" action="" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
							<input type="hidden" name="lang_id" class="form-control" id="lang_id" value="<?php echo $lang_details->id; ?>">
							<div class="form-group">
								<label><?php echo(!empty($admin_settings['lg_admin_name']))?($admin_settings['lg_admin_name']) : 'Name';  ?></label>
								<input class="form-control" type="text" name="language" id="language" placeholder="english" value="<?php echo ($lang_details)?$lang_details->language:''; ?>">
							</div>
							<div class="form-group">
								<label><?php echo(!empty($admin_settings['lg_admin_code']))?($admin_settings['lg_admin_code']) : 'Code';  ?></label>
								<input class="form-control" type="text" name="language_value" id="language_value" placeholder="en" value="<?php echo ($lang_details)?$lang_details->language_value:''; ?>">
							</div>
							<div class="form-group">
								<label class="d-block"> <?php echo(!empty($admin_settings['lg_admin_status']))?($admin_settings['lg_admin_status']) : 'status';  ?></label>
								<div class="form-check form-check-inline form-radio">
									<input class="form-check-input" type="radio" name="status" value="1" id="language_active" <?php if($lang_details->status == '1') { echo 'checked'; } ?>>
									<label class="form-check-label" for="language_active">
										<?php echo(!empty($admin_settings['lg_admin_active']))?($admin_settings['lg_admin_active']) : 'Active';  ?>
									</label>
								</div>
								<div class="form-check form-check-inline form-radio">
									<input class="form-check-input" type="radio" name="status" value="2" id="language_inactive" <?php if($lang_details->status == '2') { echo 'checked'; } ?>>
									<label class="form-check-label" for="language_inactive">
										<?php echo(!empty($admin_settings['lg_admin_inactive']))?($admin_settings['lg_admin_inactive']) : 'Inactive';  ?>
									</label>
								</div><br><br>

								<div class="form-group">
	                                <label><?php echo(!empty($admin_settings['lg_admin_rtlltr']))?($admin_settings['lg_admin_rtlltr']) : 'RTL or LTR (optional)';  ?></label>
	                                <select class="form-control select" name="tag" id="tag">
	                                    <option value=""><?php echo(!empty($admin_settings['lg_admin_select_tag']))?($admin_settings['lg_admin_select_tag']) : 'Select Tag';  ?></option>
	                                    <option value="rtl" <?php if($lang_details->tag == 'rtl') { echo 'selected'; } ?>><?php echo(!empty($admin_settings['lg_admin_rtl']))?($admin_settings['lg_admin_rtl']) : 'RTL';  ?></option>
	                                    <option value="ltr" <?php if($lang_details->tag == 'ltr') { echo 'selected'; } ?>><?php echo(!empty($admin_settings['lg_admin_ltr']))?($admin_settings['lg_admin_ltr']) : 'LTR';  ?></option>
	                                    
	                                </select>
	                            </div>
							</div>
							<div class="mt-4">
								<button name="form_submit" type="submit" class="btn btn-update me-2" value="true"><?php echo(!empty($admin_settings['lg_admin_submit']))?($admin_settings['lg_admin_submit']) : 'Submit';  ?></button>
								<a href="<?php echo $base_url; ?>languages"  class="btn btn-cancel"><?php echo(!empty($admin_settings['lg_admin_cancel']))?($admin_settings['lg_admin_cancel']) : 'Cancel';  ?></a>
							</div>
						</form>
						<!-- Form -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>