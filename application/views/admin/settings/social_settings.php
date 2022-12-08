<?php 
$admin_settings = $language_content;
?>
<div class="page-wrapper">
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-12">
					<h3 class="page-title"><?php echo(!empty($admin_settings['lg_admin_login_settings']))?($admin_settings['lg_admin_login_settings']) : 'Login Settings';  ?></h3>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		
		<div class="row">
			<div class=" col-lg-12">
				<div class="card">
					<div class="card-header">
						<div class="card-heads">
							<h4 class="card-title"><?php echo(!empty($admin_settings['lg_admin_login_settings(one time setup)']))?($admin_settings['lg_admin_login_settings(one time setup)']) : 'Login Settings (one time setup)';  ?></h4>
						</div>
					</div>
					<form accept-charset="utf-8" id="social_settings" action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
						<div class="card-body">
							<div class="form-group">
								<label><?php echo(!empty($admin_settings['lg_admin_login_type']))?($admin_settings['lg_admin_login_type']) : 'Login Type';  ?></label>
								<div class="form-group mb-4">
									<div class="custom-control custom-radios custom-control-inline">
										<input class="custom-control-input" id="phpmail" type="radio"  name="login_type" value="mobile" <?php echo (!empty($login_type)&&$login_type=="mobile")?"checked":"";?>>
										<label class="custom-control-label" for="phpmail"><?php echo(!empty($admin_settings['lg_admin_mobile_no']))?($admin_settings['lg_admin_mobile_no']) : 'Mobile No';  ?></label>
									</div>
									<div class="custom-control custom-radios custom-control-inline">
										<input class="custom-control-input" id="chkYes" type="radio"  name="login_type" value="email" <?php echo (!empty($login_type)&&$login_type=="email")?"checked":"";?>>
										<label class="custom-control-label" for="chkYes"><?php echo(!empty($admin_settings['lg_admin_email_id']))?($admin_settings['lg_admin_email_id']) : 'Email ID';  ?></label>
										<input type="hidden" class="loginemail" name="test" value="<?php echo $login_type ?>">
									</div>
								</div>
							</div>

							<?php //if($login_type == 'mobile') { ?>
							<div class="form-group" id="otp_by">
								<label><?php echo(!empty($admin_settings['lg_admin_otp_by']))?($admin_settings['lg_admin_otp_by']) : 'OTP Bys';  ?></label>
								<div class="form-group">
									<div class="custom-control custom-radios custom-control-inline">
										<input class="custom-control-input" id="phpmails" type="radio" name="otp_by" value="sms" <?php echo (!empty($otp_by)&&$otp_by=="sms")?"checked":"";?>>
										<label class="custom-control-label" for="phpmails"><?php echo(!empty($admin_settings['lg_admin_sms']))?($admin_settings['lg_admin_sms']) : 'SMS';  ?></label>
									</div>
									<div class="custom-control custom-radios custom-control-inline">
										<input class="custom-control-input" id="smtpmails" type="radio" name="otp_by" value="email" <?php echo (!empty($otp_by)&&$otp_by=="email")?"checked":"";?>>
										<label class="custom-control-label" for="smtpmails"><?php echo(!empty($admin_settings['lg_admin_mail']))?($admin_settings['lg_admin_mail']) : 'Mail';  ?></label>
									</div>
								</div>
							</div>
							<?php //} ?>
							<div class="form-group mt-5">
								<div class="form-groupbtn">
									<ul>
										<li>	
											<button name="form_submit" type="submit" class="btn btn-update me-2" value="true"><?php echo(!empty($admin_settings['lg_admin_update']))?($admin_settings['lg_admin_update']) : 'Update';  ?></button>
										</li>
										<li>	
											<a href="<?php echo $base_url; ?>admin/social-settings"  class="btn btn-cancel"><?php echo(!empty($admin_settings['lg_admin_cancel']))?($admin_settings['lg_admin_cancel']) : 'Cancel';  ?></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div  id="showemail" style="display: none;">
			<div class="row">
				<div class=" col-lg-6 col-sm-12 col-12">
					<div class="card">
						<div class="card-header">
							<div class="card-heads">
								<h4 class="card-title"><?php echo(!empty($admin_settings['lg_admin_google_logincredential']))?($admin_settings['lg_admin_google_logincredential']) : 'Google Login Credential';  ?></h4>
								<div class="col-auto">
									<div class="status-toggle">
										<input id="default_ot" class="check" type="checkbox" checked="">
										<label for="default_ot" class="checktoggle">checkbox</label>
									</div>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label><?php echo(!empty($admin_settings['lg_admin_clientid']))?($admin_settings['lg_admin_clientid']) : 'Client ID';  ?></label>
								<input type="text" class="form-control">
							</div>
							<div class="form-group">
								<label><?php echo(!empty($admin_settings['lg_admin_client_secret']))?($admin_settings['lg_admin_client_secret']) : 'Client Secret';  ?></label>
								<input type="text" class="form-control">
							</div>
							<div class="form-group ">
								<div class="form-groupbtn">
									<ul>
										<li>	
											<a class="btn btn-primary">Save</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class=" col-lg-6 col-sm-12 col-12">
					<div class="card">
						<div class="card-header">
							<div class="card-heads">
								<h4 class="card-title">Twiter Login Credential</h4>
								<div class="col-auto">
									<div class="status-toggle">
										<input id="default_o" class="check" type="checkbox" >
										<label for="default_o" class="checktoggle">checkbox</label>
									</div>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label>Client ID</label>
								<input type="text" class="form-control">
							</div>
							<div class="form-group">
								<label>Client Secret</label>
								<input type="text" class="form-control">
							</div>
							<div class="form-group ">
								<div class="form-groupbtn">
									<ul>
										<li>	
											<a class="btn btn-primary">Save</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class=" col-lg-6 col-sm-12 col-12">
					<div class="card">
						<div class="card-header">
							<div class="card-heads">
								<h4 class="card-title">Facebook</h4>
								<div class="col-auto">
									<div class="status-toggle">
										<input id="default" class="check" type="checkbox" checked >
										<label for="default" class="checktoggle">checkbox</label>
									</div>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label>App ID</label>
								<input type="text" class="form-control">
							</div>
							<div class="form-group">
								<label>App Secret</label>
								<input type="text" class="form-control">
							</div>
							<div class="form-group ">
								<div class="form-groupbtn">
									<ul>
										<li>	
											<a class="btn btn-primary">Save</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>