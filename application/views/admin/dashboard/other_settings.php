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
					<h3 class="page-title"><?php echo(!empty($admin_settings['lg_admin_other_settings']))?($admin_settings['lg_admin_other_settings']) : 'Other Settings';  ?></h3>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		
		<div class="row">
			<div class=" col-lg-6 col-sm-12 col-12">
				<form class="form-horizontal"  method="POST" enctype="multipart/form-data" id="google_analytics" action="<?php echo base_url('admin/settings/analytics'); ?>">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
				<div class="card">
					<div class="card-header">
						<div class="card-heads">
							<h4 class="card-title"><?php echo(!empty($admin_settings['lg_admin_enable_google_analytics']))?($admin_settings['lg_admin_enable_google_analytics']) : 'Enable Google Analytics';  ?></h4>
							<div class="col-auto">
								<div class="status-toggle mr-3">
                                    <input  id="analytics_showhide" class="check" type="checkbox" name="analytics_showhide"<?=settingValue('analytics_showhide')?'checked':'';?>>
                                    <label for="analytics_showhide" class="checktoggle">checkbox</label>
                        		</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label><?php echo(!empty($admin_settings['lg_admin_google_analytics']))?($admin_settings['lg_admin_google_analytics']) : 'Google Analytics';  ?> <span class="manidory">*</span></label>
							<textarea class="form-control" placeholder="Google Analytics" name="google_analytics"><?php echo settingValue('google_analytics'); ?></textarea>
						</div>
						<div class="form-groupbtn">
							<button name="form_submit" type="submit" class="btn btn-primary" value="true"><?php echo(!empty($admin_settings['lg_admin_save']))?($admin_settings['lg_admin_save']) : 'Save';  ?></button>
						</div>
					</div>
				</div>
			</form>
			</div>
			<div class=" col-lg-6 col-sm-12 col-12 d-flex">
				<div class="card flex-fill">
					<form class="form-horizontal"  method="POST" enctype="multipart/form-data" id="cookies" action="<?php echo base_url('admin/settings/cookies'); ?>">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
					<div class="card-header">
						<div class="card-heads">
							<h4 class="card-title"><?php echo(!empty($admin_settings['lg_admin_cookies_agreement']))?($admin_settings['lg_admin_cookies_agreement']) : 'Cookies Agreement';  ?></h4>
							<div class="col-auto">
								<div class="status-toggle mr-3">
                                    <input  id="cookies_showhide" class="check" type="checkbox" name="cookies_showhide"<?=settingValue('cookies_showhide')?'checked':'';?>>
                                    <label for="cookies_showhide" class="checktoggle">checkbox</label>
                        		</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<?php foreach ($lang_test as $langval) { 
							$this->db->where('modules', 'cookie');
						    $this->db->where('lang_type', $langval->language_value);
						    $lang_cookie_check = $this->db->get('cookies')->result_array();
						?>
						<div class="form-group">
							<label><?php echo(!empty($admin_settings['lg_admin_google_adsensecode']))?($admin_settings['lg_admin_google_adsensecode']) : 'Google Adsense Code';  ?><span class="manidory">*(<?php echo $langval->language; ?>)</span></label>
							<?php foreach ($lang_cookie_check as $lang_cookie) { ?>
							<textarea class="form-control summernote" placeholder="Cookies" name="cookies_<?php echo $langval->id; ?>"><?php echo $lang_cookie['cookie_name']; ?></textarea>
							<?php } ?>
						</div>
						<?php } ?>
						<div class="form-groupbtn">
							<button name="form_submit" type="submit" class="btn btn-primary" value="true"><?php echo(!empty($admin_settings['lg_admin_save']))?($admin_settings['lg_admin_save']) : 'Save';  ?></button>
						</div>
					</div>
					</form>
				</div>
			
			</div>
		</div>
	</div>
</div>