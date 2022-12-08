<?php 
$admin_settings = $language_content;
?>
<div class="page-wrapper">
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-12">
					<h3 class="page-title"><?php echo(!empty($admin_settings['lg_admin_cache_settings']))?($admin_settings['lg_admin_cache_settings']) : 'Cache Settings';  ?></h3>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		<div class="row">
			<div class=" col-lg-6 col-sm-12 col-12">
				<form class="form-horizontal"  method="POST" enctype="multipart/form-data" id="product_cache" action="<?php echo base_url('admin/settings/cache_settings'); ?>">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
					<div class="card">
						<div class="card-header">
							<div class="card-heads">
								<h4 class="card-title">Service Cache System</h4>
								<div class="col-auto">
									<div class="status-toggle mr-3">
	                                    <input  id="pro_cache_status" class="check" type="checkbox" name="pro_cache_status"<?=settingValue('pro_cache_status')?'checked':'';?>>
	                                    <label for="pro_cache_status" class="checktoggle">checkbox</label>
	                        		</div>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label><?php echo(!empty($admin_settings['lg_admin_refresh_cache']))?($admin_settings['lg_admin_refresh_cache']) : 'Refresh Cache Files When Database Changes';  ?></label><br>
								 <label><input type="radio" name="refresh_cache" value="1" <?=(!empty(settingValue('pro_cache_status'))&&settingValue('pro_cache_status')==1)?'checked':'';?>> <?php echo(!empty($admin_settings['lg_admin_yes']))?($admin_settings['lg_admin_yes']) : 'Yes';  ?> </label>&nbsp
								 <label><input type="radio" name="refresh_cache" value="0" <?=(settingValue('pro_cache_status')==0)?'checked':'';?>> <?php echo(!empty($admin_settings['lg_admin_no']))?($admin_settings['lg_admin_no']) : 'No';  ?></label>
							</div>
			                <div class="form-group">
	                            <label><?php echo(!empty($admin_settings['lg_admin_cache_refresh_time']))?($admin_settings['lg_admin_cache_refresh_time']) : 'Cache Refresh Time (Minute)';  ?></label>
	                            <small>(<?php echo(!empty($admin_settings['lg_admin_after_this_time']))?($admin_settings['lg_admin_after_this_time']) : 'After this time, your cache files will be refreshed.';  ?>)</small>
	                            <input type="number" class="form-control" name="cache_refresh_time" value="<?php echo settingValue('cache_refresh_time'); ?>">
			                </div>
								<div class="form-groupbtn">
									<button name="form_submit" type="submit" class="btn btn-primary" value="true"><?php echo(!empty($admin_settings['lg_admin_save']))?($admin_settings['lg_admin_save']) : 'Save';  ?></button>

									<a href="<?php echo base_url(); ?>admin/settings/clear_all_cache"  class="btn btn-cancel">Reset</a>
								</div>
						</div>
					</div>
				</form>
			</div>

			<div class=" col-lg-6 col-sm-12 col-12 d-flex">
				<div class="card flex-fill">
					<form class="form-horizontal"  method="POST" enctype="multipart/form-data" id="chat" action="<?php echo base_url('admin/settings/static_cache_system'); ?>">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
						<div class="card-header">
							<div class="card-heads">
								<h4 class="card-title"><?php echo(!empty($admin_settings['lg_admin_static_content_cache']))?($admin_settings['lg_admin_static_content_cache']) : 'Static Content Cache System';  ?></h4>
							</div>
						</div>
						<div class="card-body">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6">
		                            	<label><?php echo(!empty($admin_settings['lg_admin_status']))?($admin_settings['lg_admin_status']) : 'Status';  ?></label>
		                            </div>
		                            <div class="col-sm-6">
			                            <div class="status-toggle mr-3">
			                                    <input  id="static_content_cache_system" class="check" type="checkbox" name="static_content_cache_system"<?=settingValue('static_content_cache_system')?'checked':'';?>>
			                                    <label for="static_content_cache_system" class="checktoggle">checkbox</label>
			                        	</div>
			                        </div>
	                        	</div>
			                </div>
								<div class="form-groupbtn">
									<button name="form_submit" type="submit" class="btn btn-primary" value="true"><?php echo(!empty($admin_settings['lg_admin_save']))?($admin_settings['lg_admin_save']) : 'Save';  ?></button>

									<a href="<?php echo base_url(); ?>admin/settings/clear_all_cache"  class="btn btn-cancel">Reset</a>
								</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>