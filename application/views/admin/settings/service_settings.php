<?php 
$admin_settings = $language_content;
?>
<div class="page-wrapper">
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-12">
					<h3 class="page-title"><?php echo(!empty($admin_settings['lg_admin_service_settings']))?($admin_settings['lg_admin_service_settings']) : 'Service Settings';  ?></h3>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		<div class="row">
			<div class=" col-lg-8 col-sm-12 col-12">
				<form class="form-horizontal"  method="POST" enctype="multipart/form-data" id="reviews" action="<?php echo base_url('admin/service-settings'); ?>">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
					<div class="card">
						<div class="card-header">
							<div class="card-heads">
								<h4 class="card-title"><?php echo(!empty($admin_settings['lg_admin_reviews_details']))?($admin_settings['lg_admin_reviews_details']) : 'Review Details';  ?></h4>
								<div class="col-auto">
									<div class="status-toggle mr-3">
	                                    <input  id="review_showhide" class="check" type="checkbox" name="review_showhide"<?=settingValue('review_showhide')?'checked':'';?>>
	                                    <label for="review_showhide" class="checktoggle">checkbox</label>
	                        		</div>
								</div>
							</div>
							<br>
							<div class="card-heads">
								<h4 class="card-title"><?php echo(!empty($admin_settings['lg_booking_service']))?($admin_settings['lg_booking_service']) : 'Booking Service';  ?></h4>
								<div class="col-auto">
									<div class="status-toggle mr-3">
	                                    <input  id="booking_showhide" class="check" type="checkbox" name="booking_showhide"<?=settingValue('booking_showhide')?'checked':'';?>>
	                                    <label for="booking_showhide" class="checktoggle">checkbox</label>
	                        		</div>
								</div>
							</div>
							<br>
							<div class="card-heads">
								<h4 class="card-title"><?php echo(!empty($admin_settings['lg_service_offered']))?($admin_settings['lg_service_offered']) : 'Service Offered';  ?></h4>
								<div class="col-auto">
									<div class="status-toggle mr-3">
	                                    <input  id="service_offered_showhide" class="check" type="checkbox" name="service_offered_showhide"<?=settingValue('service_offered_showhide')?'checked':'';?>>
	                                    <label for="service_offered_showhide" class="checktoggle">checkbox</label>
	                        		</div>
								</div>
							</div>
							<br>
							<div class="card-heads">
								<h4 class="card-title"><?php echo(!empty($admin_settings['lg_service_availability']))?($admin_settings['lg_service_availability']) : 'Service Availability';  ?></h4>
								<div class="col-auto">
									<div class="status-toggle mr-3">
	                                    <input  id="service_availability_showhide" class="check" type="checkbox" name="service_availability_showhide"<?=settingValue('service_availability_showhide')?'checked':'';?>>
	                                    <label for="service_availability_showhide" class="checktoggle">checkbox</label>
	                        		</div>
								</div>
							</div>
							<br>
							<div class="card-heads">
								<h4 class="card-title"><?php echo(!empty($admin_settings['lg_provider_email']))?($admin_settings['lg_provider_email']) : 'Provider Email';  ?></h4>
								<div class="col-auto">
									<div class="status-toggle mr-3">
	                                    <input  id="provider_email_showhide" class="check" type="checkbox" name="provider_email_showhide"<?=settingValue('provider_email_showhide')?'checked':'';?>>
	                                    <label for="provider_email_showhide" class="checktoggle">checkbox</label>
	                        		</div>
								</div>
							</div>
							<br>
							<div class="card-heads">
								<h4 class="card-title"><?php echo(!empty($admin_settings['lg_provider_mobileno']))?($admin_settings['lg_provider_mobileno']) : 'Provider Mobile no.';  ?></h4>
								<div class="col-auto">
									<div class="status-toggle mr-3">
	                                    <input  id="provider_mobileno_showhide" class="check" type="checkbox" name="provider_mobileno_showhide"<?=settingValue('provider_mobileno_showhide')?'checked':'';?>>
	                                    <label for="provider_mobileno_showhide" class="checktoggle">checkbox</label>
	                        		</div>
								</div>
							</div>
							<br>
							<div class="card-heads">
								<h4 class="card-title"><?php echo(!empty($admin_settings['lg_provider_status']))?($admin_settings['lg_provider_status']) : 'Provider Status';  ?></h4>
								<div class="col-auto">
									<div class="status-toggle mr-3">
	                                    <input  id="provider_status_showhide" class="check" type="checkbox" name="provider_status_showhide"<?=settingValue('provider_status_showhide')?'checked':'';?>>
	                                    <label for="provider_status_showhide" class="checktoggle">checkbox</label>
	                        		</div>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="form-groupbtn">
								<button name="form_submit" type="submit" class="btn btn-primary" value="true"><?php echo(!empty($admin_settings['lg_admin_save']))?($admin_settings['lg_admin_save']) : 'Save';  ?></button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>