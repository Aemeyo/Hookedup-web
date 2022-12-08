<?php 
$admin_settings = $language_content;
?>
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title"><?php echo(!empty($admin_settings['lg_admin_smssettings']))?($admin_settings['lg_admin_smssettings']) : 'SMS Settings';  ?></h3>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <form id="form_smssetting" action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <div class="row">
                <div class="col-xl-8 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5><?php echo(!empty($admin_settings['lg_admin_default_otp']))?($admin_settings['lg_admin_default_otp']) : 'Default OTP';  ?></h5>
                                    <p class="mb-0"><?php echo(!empty($admin_settings['lg_admin_youusedefaultotp']))?($admin_settings['lg_admin_youusedefaultotp']) : 'You can use default otp';  ?> <strong><?php echo(!empty($admin_settings['lg_admin_1234']))?($admin_settings['lg_admin_1234']) : '1234';  ?></strong> <?php echo(!empty($admin_settings['lg_admin_fordemopurpose']))?($admin_settings['lg_admin_fordemopurpose']) : 'for demo purpose';  ?></p>
                                </div>
                                <div class="col-auto">
                                    <div class="status-toggle">
                                        <?php if ($user_role == 1) { ?>
                                            <input  id="default_otp" class="check" type="checkbox" name="default_otp" <?php echo ($default_otp == 1) ? 'checked' : ''; ?>>
                                        <?php } else { ?>
                                            <input  id="default_otp" class="check" type="checkbox" name="default_otp" <?php echo ($default_otp == 1) ? 'checked' : ''; ?> disabled>
                                        <?php } ?>
                                        <label for="default_otp" class="checktoggle">checkbox</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-8 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs menu-tabs">
                                <li data-id="nexmo" class="nav-item active">
                                    <a href="javascript:void(0);" class="nav-link"><?php echo(!empty($admin_settings['lg_admin_nexmo']))?($admin_settings['lg_admin_nexmo']) : 'Nexmo';  ?></a>
                                </li>
                                <li data-id="2factor" class="nav-item ">
                                   <a href="javascript:void(0);" class="nav-link"><?php echo(!empty($admin_settings['lg_admin_2factor']))?($admin_settings['lg_admin_2factor']) : '2Factor';  ?></a>
                                </li>
                                <li data-id="twilio" class="nav-item">
                                    <a href="javascript:void(0);" class="nav-link"><?php echo(!empty($admin_settings['lg_admin_twilio']))?($admin_settings['lg_admin_twilio']) : 'Twilio';  ?></a>
                                </li>
                            </ul>
                            <div id="nexmo_div">
                                <div class="row align-items-center mb-4">
                                    <div class="col">
                                         <h4 class="mb-0"><?php echo(!empty($admin_settings['lg_admin_nexmo']))?($admin_settings['lg_admin_nexmo']) : 'Nexmo';  ?></h4>
                                    </div>
                                    <div class="col-auto">
										<div class="status-toggle">
											<input type="checkbox" name="sms_option" class="check sms_option" id="nexmo" value="Nexmo" <?php if($sms_option == 'Nexmo') { echo 'checked'; } ?> >
											<label for="nexmo" class="checktoggle">checkbox</label>
										</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label><?php echo(!empty($admin_settings['lg_admin_apikey']))?($admin_settings['lg_admin_apikey']) : 'Api Key';  ?></label>
                                    <input type="text" class="form-control" name="nexmo_sms_key" value="<?php if (isset($nexmo_sms_key)) echo $nexmo_sms_key; ?>">
                                </div>
                                <div class="form-group">
                                    <label><?php echo(!empty($admin_settings['lg_admin_apisecretkey']))?($admin_settings['lg_admin_apisecretkey']) : 'API Secret Key';  ?></label>
                                    <input type="text" class="form-control" name="nexmo_sms_secret_key" value="<?php if (isset($nexmo_sms_secret_key)) echo $nexmo_sms_secret_key; ?>">
                                </div>
                                <div class="form-group">
                                    <label><?php echo(!empty($admin_settings['lg_admin_senderid']))?($admin_settings['lg_admin_senderid']) : 'Sender ID';  ?></label>
                                    <input type="text" class="form-control" name="nexmo_sms_sender_id" value="<?php if (isset($nexmo_sms_secret_key)) echo $nexmo_sms_secret_key; ?>">
                                </div>
                                <div class="mt-4">
                                    <button name="form_submit" type="submit" class="btn btn-primary center-block" value="true"><?php echo(!empty($admin_settings['lg_admin_save_changes']))?($admin_settings['lg_admin_save_changes']) : 'Save Changes';  ?></button>
                                </div>
                            </div>
                          
                            <!-- 2Factor -->
                            <div id="2factor_div">
								<div class="row align-items-center mb-4">
									<div class="col">
										 <h4 class="mb-0"><?php echo(!empty($admin_settings['lg_admin_2factor']))?($admin_settings['lg_admin_2factor']) : '2Factor';  ?></h4>
									</div>
									<div class="col-auto">
										<div class="status-toggle">
											<input type="checkbox" name="sms_option" class="check sms_option" id="2Factor" value="2Factor" <?php if($sms_option == '2Factor') { echo 'checked'; } ?>>
											<label for="2Factor" class="checktoggle">checkbox</label>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<label><?php echo(!empty($admin_settings['lg_admin_apikeysandbox']))?($admin_settings['lg_admin_apikeysandbox']) : 'API Key Sandbox';  ?></label>
									<input type="text" class="form-control" name="factor_sms_key" value="<?php if (isset($factor_sms_key)) echo $factor_sms_key; ?>">
								</div>
								<div class="form-group">
									<label><?php echo(!empty($admin_settings['lg_admin_apikeylive']))?($admin_settings['lg_admin_apikeylive']) : 'API Key Live';  ?></label>
									<input type="text" class="form-control" name="factor_sms_livekey_1" value="<?php if (isset($factor_sms_livekey_1)) echo $factor_sms_livekey_1; ?>">
								</div>
								<div class="form-group">
									<label><?php echo(!empty($admin_settings['lg_admin_apisecretkey']))?($admin_settings['lg_admin_apisecretkey']) : 'API Secret Key';  ?></label>
									<input type="text" class="form-control" name="factor_sms_secret_key_1" value="<?php if (isset($factor_sms_secret_key_1)) echo $factor_sms_secret_key_1; ?>">
								</div>
								<div class="form-group">
									<label><?php echo(!empty($admin_settings['lg_admin_senderid']))?($admin_settings['lg_admin_senderid']) : 'Sender ID';  ?></label>
									<input type="text" class="form-control" name="factor_sms_sender_id_1" value="<?php if (isset($factor_sms_sender_id_1)) echo $factor_sms_sender_id_1; ?>">
								</div>
								<div class="mt-4">
									<button name="form_submit" type="submit" class="btn btn-primary center-block" value="true"><?php echo(!empty($admin_settings['lg_admin_save_changes']))?($admin_settings['lg_admin_save_changes']) : 'Save Changes';  ?></button>
								</div>
                            </div>
                                
                            <!-- Twilio -->
                            <div id="twilio_div">
								<div class="row align-items-center mb-4">
									<div class="col">
										 <h4 class="mb-0"><?php echo(!empty($admin_settings['lg_admin_twilio']))?($admin_settings['lg_admin_twilio']) : 'Twilio';  ?></h4>
									</div>
									<div class="col-auto">
										<div class="status-toggle">
											<input type="checkbox" name="sms_option" class="check sms_option" id="twilio" value="Twilio" <?php if($sms_option == 'Twilio') { echo 'checked'; } ?>>
											<label for="twilio" class="checktoggle">checkbox</label>
										</div>
									</div>
								</div>

								<div class="form-group">
									<label><?php echo(!empty($admin_settings['lg_admin_sid']))?($admin_settings['lg_admin_sid']) : 'Sid';  ?></label>
									<input type="text" class="form-control" name="twilio_sms_key" value="<?php if (isset($twilio_sms_key)) echo $twilio_sms_key; ?>">
								</div>
								<div class="form-group">
									<label><?php echo(!empty($admin_settings['lg_admin_token']))?($admin_settings['lg_admin_token']) : 'Token';  ?></label> 
									<input type="text" class="form-control" name="twilio_sms_livekey" value="<?php if (isset($twilio_sms_livekey)) echo $twilio_sms_livekey; ?>">
								</div>
								<div class="form-group">
									<label><?php echo(!empty($admin_settings['lg_admin_phone']))?($admin_settings['lg_admin_phone']) : 'Phone';  ?></label>
									<input type="text" class="form-control" name="twilio_sms_secret_key" value="<?php if (isset($twilio_sms_secret_key)) echo $twilio_sms_secret_key; ?>">
								</div>
								<div class="mt-4">
									<button name="form_submit" type="submit" class="btn btn-primary center-block" value="true"><?php echo(!empty($admin_settings['lg_admin_save_changes']))?($admin_settings['lg_admin_save_changes']) : 'Save Changes';  ?></button>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </form>
    </div>
</div>