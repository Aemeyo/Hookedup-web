<?php 
$state = $language_content;

?>
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="row">
			<div class="col-xl-8 offset-xl-2">
			
				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col">
							<h3 class="page-title"><?php echo(!empty($state['lg_admin_add_state']))?($state['lg_admin_add_state']) : 'Add State';  ?></h3>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				<div class="card">
					<div class="card-body">
						<form action="<?php echo base_url()?>admin/dashboard/add_state" id="add_state" method="post" autocomplete="off" enctype="multipart/form-data">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
							<div class="form-group">
								<label><?php echo(!empty($state['lg_admin_country']))?($state['lg_admin_country']) : 'Country';  ?></label>
                                    <select name="countryid" id="countryid" class="form-control" required>
    									<option value="">Select Country</option>
    									<?php foreach($countrys as $c) {?>
    										<option value="<?php echo $c['id']; ?>"><?php echo $c['country_name'];?></option>
    									<?php } ?>
    								</select>
							</div>
							<div class="form-group">
								<label>State Name</label>
								<input class="form-control" type="text"  name="state_name" id="state_name">
							</div>
							<div class="mt-4">
								<button class="btn btn-primary " name="form_submit" value="submit" type="submit"><?php echo(!empty($state['lg_admin_add']))?($state['lg_admin_add']) : 'Adds';  ?></button>
								<a href="<?php echo $base_url; ?>state-list"  class="btn btn-cancel"><?php echo(!empty($state['lg_admin_cancel']))?($state['lg_admin_cancel']) : 'Cancel';  ?></a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

					