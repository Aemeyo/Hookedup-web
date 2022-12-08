<?php 
$admin_settings = $language_content;
?>
<div class="page-wrapper">
			<div class="content container-fluid">
			
				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col-12">
							<h3 class="page-title"><?php echo(!empty($admin_settings['lg_admin_system_settings']))?($admin_settings['lg_admin_system_settings']) : 'System Settings';  ?></h3>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				
				<div class="row">
					<div class=" col-lg-6 col-sm-12 col-12">
						<form accept-charset="utf-8" id="map_settings" action="" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
							<div class="card">
								<div class="card-header">
									<div class="card-heads">
										<h4 class="card-title"><?php echo(!empty($admin_settings['lg_admin_google_mapapi']))?($admin_settings['lg_admin_google_mapapi']) : 'Google Map API Key';  ?></h4>
									</div>
								</div>
								<div class="card-body">
									<div class="form-group">
										<label><?php echo(!empty($admin_settings['lg_admin_google_mapapi']))?($admin_settings['lg_admin_google_mapapi']) : 'Google Map API Key';  ?></label>
										<input type="text" name="map_key" id="map_key" class="form-control" value="<?php echo ($map_key)?$map_key:''; ?>">
									</div>
									<div class="form-group">
										<div class="form-links">
											<a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank"><?php echo(!empty($admin_settings['lg_admin_how_googlemapapikey']))?($admin_settings['lg_admin_how_googlemapapikey']) : 'How to create google map API key?';  ?></a>
										</div>
									</div>
									<div class="form-groupbtn">
										<button name="form_submit" type="submit" class="btn btn-update me-2" value="true"><?php echo(!empty($admin_settings['lg_admin_update']))?($admin_settings['lg_admin_update']) : 'Update';  ?></button>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class=" col-lg-6 col-sm-12 col-12">
						<form accept-charset="utf-8" id="apikey_settings" action="" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
							<div class="card">
								<div class="card-header">
									<div class="card-heads">
										<h4 class="card-title"><?php echo(!empty($admin_settings['lg_admin_push_notification']))?($admin_settings['lg_admin_push_notification']) : 'Push Notification';  ?></h4>
									</div>
								</div>
								<div class="card-body">
									<div class="form-group">
										<label><?php echo(!empty($admin_settings['lg_admin_firebase_serverkey']))?($admin_settings['lg_admin_firebase_serverkey']) : 'Firebase Server Key';  ?></label>
										<input type="text" name="firebase_server_key" id="firebase_server_key" class="form-control" value="<?php echo ($firebase_server_key)?$firebase_server_key:''; ?>">
									</div>
									<div class="form-group">
										<div class="form-links">
											<a href="https://firebase.google.com/docs/android/setup" target="_blank"><?php echo(!empty($admin_settings['lg_admin_how_firebasesetup']))?($admin_settings['lg_admin_how_firebasesetup']) : 'How to create firebase setup?';  ?></a>
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