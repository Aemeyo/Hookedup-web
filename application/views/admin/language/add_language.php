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
							<h3 class="page-title"><?php echo(!empty($admin_settings['lg_admin_add_languages']))?($admin_settings['lg_admin_add_languages']) : 'Add Languages';  ?></h3>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				
				<div class="card">
					<div class="card-body">
					
						<!-- Form -->
						<form accept-charset="utf-8" id="language_settings" action="" method="POST" enctype="multipart/form-data">
                            	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
							<div class="form-group">
								<label><?php echo(!empty($admin_settings['lg_admin_name']))?($admin_settings['lg_admin_name']) : 'Name';  ?></label>
								<input class="form-control" type="text" placeholder="english" name="language" id="language">
							</div>
							<div class="form-group">
								<label><?php echo(!empty($admin_settings['lg_admin_code']))?($admin_settings['lg_admin_code']) : 'Code';  ?></label>
								<input class="form-control" type="text" placeholder="en" name="language_value" id="language_value">
							</div>
							<div class="form-group">
								<label class="d-block"> <?php echo(!empty($admin_settings['lg_admin_status']))?($admin_settings['lg_admin_status']) : 'status';  ?></label>
								<div class="form-check form-check-inline form-radio">
									<input class="form-check-input" type="radio" name="status" id="status" value="1" id="language_active" checked>
									<label class="form-check-label" for="language_active">
										<?php echo(!empty($admin_settings['lg_admin_active']))?($admin_settings['lg_admin_active']) : 'Active';  ?>
									</label>
								</div>
								<div class="form-check form-check-inline form-radio">
									<input class="form-check-input" type="radio" name="status" id="status" value="2" id="language_inactive" >
									<label class="form-check-label" for="language_inactive">
										<?php echo(!empty($admin_settings['lg_admin_inactive']))?($admin_settings['lg_admin_inactive']) : 'Inactive';  ?>
									</label>
								</div>
							</div>
							<div class="form-group">
                                <label><?php echo(!empty($admin_settings['lg_admin_rtlltr']))?($admin_settings['lg_admin_rtlltr']) : 'RTL or LTR (optional)';  ?></label>
                                <select class="form-control select" name="tag" id="tag">
                                    <option value=""><?php echo(!empty($admin_settings['lg_admin_select_tag']))?($admin_settings['lg_admin_select_tag']) : 'Select Tag';  ?></option>
                                    <option value="rtl" selected><?php echo(!empty($admin_settings['lg_admin_rtl']))?($admin_settings['lg_admin_rtl']) : 'RTL';  ?></option>
                                    <option value="ltr"><?php echo(!empty($admin_settings['lg_admin_ltr']))?($admin_settings['lg_admin_ltr']) : 'LTR';  ?></option>
                                    
                                </select>
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