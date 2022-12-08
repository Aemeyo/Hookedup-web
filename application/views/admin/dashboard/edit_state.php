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
							<h3 class="page-title">Edit State</h3>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				<div class="card">
					<div class="card-body">
						<?php
                            foreach ($datalist as $value) {
                            ?>
                                <form id="edit_state" action="<?php echo base_url().'admin/dashboard/edit_state/' . $value['id']; ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
                                    <label>Country</label>
                                    <select name="countryid" id="countryid" class="form-control" required>
    									<option value="">Select Country</option>
    									<?php foreach($countrys as $c) {?>
    										<option value="<?php echo $c['id']; ?>" <?php if($value['country_id'] == $c['id']) echo 'selected'; ?>><?php echo $c['country_name'];?></option>
    									<?php } ?>
    								</select>
                                </div>
                               
                                <div class="form-group">
                                    <label>State name</label>
                                    <input type="text" class="form-control" name="state_name" id="state_name" required value="<?php if ($value['name']) { echo $value['name']; } ?>">
                                </div>
							<div class="mt-4">
								<button class="btn btn-primary " name="form_submit" value="submit" type="submit"><?php echo(!empty($state['lg_admin_save_changes']))?($state['lg_admin_save_changes']) : 'Save';  ?></button>
								<a href="<?php echo $base_url; ?>state-list"  class="btn btn-cancel"><?php echo(!empty($state['lg_admin_cancel']))?($state['lg_admin_cancel']) : 'Cancel';  ?></a>
							</div>
						</form>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

					