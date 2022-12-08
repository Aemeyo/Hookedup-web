<?php
	$state = $language_content;

?>
<div class="page-wrapper">
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title"><?php echo(!empty($state['lg_admin_state']))?($state['lg_admin_state']) : 'State';  ?></h3>
				</div>
				<div class="col-auto text-right">
					<a href="<?php echo $base_url; ?>service-list" class="btn btn-primary add-button"><i class="fas fa-sync"></i></a>

					<a href="<?php echo $base_url; ?>add-state" class="btn btn-white add-button"><i class="fas fa-plus"></i></a>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		
		<div class="status-toggle mb-3 d-flex">
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover table-center mb-0 service_table">
                                <thead>
									<tr>
										<th><?php echo(!empty($state['lg_admin_#']))?($state['lg_admin_#']) : '#';  ?></th>
										<th><?php echo(!empty($state['lg_admin_country_code']))?($state['lg_admin_country_code']) : 'Country Code';  ?></th>									
										<th><?php echo(!empty($state['lg_admin_country_name']))?($state['lg_admin_country_name']) : 'Country Name';  ?></th>
										<th><?php echo(!empty($state['lg_admin_state_name']))?($state['lg_admin_state_name']) : 'State Name';  ?></th>
										<th><?php echo(!empty($state['lg_admin_action']))?($state['lg_admin_action']) : 'Action';  ?></th>
									</tr>
								</thead>
                                <tbody>
								<?php
								if (!empty($lists)) {
									$sno = 0;
									foreach ($lists as $row) {
										$_id = isset($row['id']) ? $row['id'] : '';
										if (!empty($_id)) {
											$country_code = isset($row['ccode']) ? $row['ccode'] : '';
											$country_name = isset($row['cname']) ? $row['cname'] : '';
											$state_name = isset($row['name']) ? $row['name'] : '';
											
								?>
								<tr>
									<td> <?php echo ++$sno; ?></td>
									<td> <?php echo $country_code; ?></td>												
									<td> <?php echo $country_name ?></td>
									<td> <?php echo $state_name ?></td>
									<td>
										<a href="<?php echo base_url().'admin/dashboard/edit_state/' . $_id; ?>" class="btn btn-sm bg-success-light me-2"><i class="far fa-edit me-1"></i> Edit</a>&nbsp;
										<a href="javascript:;" class="on-default remove-row btn btn-sm bg-danger-light me-2 delete_state_code_config" id="state_del" data-id="<?php echo $_id; ?>"><i class="far fa-trash-alt me-1"></i> Delete</a>
									</td>
								</tr>
									<?php
										}
									}
								} else {
									?>
									<tr>
										<td colspan="9">
											<div class="text-center text-muted"><?php echo(!empty($state['lg_admin_no_records_found']))?($state['lg_admin_no_records_found']) : 'No Records Found';  ?></div>
										</td>
									</tr>
									<?php } ?>
                                </tbody>
                            </table>
						</div> 
					</div> 
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="state_delete_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5><?php echo(!empty($admin_settings['lg_admin_delete_confiramtion']))?($admin_settings['lg_admin_delete_confiramtion']) : 'Delete Confiramtion';  ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><?php echo(!empty($state['lg_admin_delete_state']))?($state['lg_admin_delete_state']) : 'Are you confirm to delete this state.';  ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" id="confirm_delete_state" data-id="" class="btn btn-primary"><?php echo(!empty($admin_settings['lg_admin_yes']))?($admin_settings['lg_admin_yes']) : 'Yes';  ?></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo(!empty($admin_settings['lg_admin_no']))?($admin_settings['lg_admin_no']) : 'No';  ?></button>
      </div>
    </div>
  </div>
</div>