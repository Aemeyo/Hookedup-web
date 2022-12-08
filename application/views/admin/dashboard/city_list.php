<?php
	$service_list = $language_content;
	//print_r($lists);exit;
?>
<div class="page-wrapper">
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title">City</h3>
				</div>
				<div class="col-auto text-right">
					<a href="<?php echo $base_url; ?>city-list" class="btn btn-primary add-button"><i class="fas fa-sync"></i></a>

					<a href="<?php echo $base_url; ?>add-city" class="btn btn-white add-button"><i class="fas fa-plus"></i></a>
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
										<th>#</th>		
										<th>County Name</th>
										<th>State Name</th>
										<th>City Name</th>
										<th>Action</th>
									</tr>
							  </thead>
                <tbody>
								<?php
								if (!empty($lists)) {
									$sno = 0;
									foreach ($lists as $row) {
										$_id = isset($row['id']) ? $row['id'] : '';
										if (!empty($_id)) {
											$country_name = isset($row['cname']) ? $row['cname'] : '';
											$state_name = isset($row['state_name']) ? $row['state_name'] : '';
											$city_name = isset($row['name']) ? $row['name'] : '';
											
								?>
											<tr>
												<td> <?php echo ++$sno; ?></td>	
												<td> <?php echo $country_name; ?></td>												
												<td> <?php echo $state_name; ?></td>
												<td> <?php echo $city_name ?></td>
												<td>
													<a href="<?php echo base_url().'admin/dashboard/edit_city/' . $_id; ?>" class="btn btn-sm bg-success-light me-2"><i class="far fa-edit me-1"></i> Edit</a>&nbsp;
														<a href="javascript:;" class="on-default remove-row btn btn-sm bg-danger-light me-2 delete_city_code_config" id="city_del" data-id="<?php echo $_id; ?>"><i class="far fa-trash-alt me-1"></i> Delete</a>
												</td>
											</tr>
									<?php
										}
									}
								} else {
									?>
									<tr>
										<td colspan="9">
											<div class="text-center text-muted"><?php echo(!empty($service_list['lg_admin_no_records_found']))?($service_list['lg_admin_no_records_found']) : 'No Records Found';  ?></div>
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

<div class="modal" id="city_delete_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5><?php echo(!empty($admin_settings['lg_admin_delete_confiramtion']))?($admin_settings['lg_admin_delete_confiramtion']) : 'Delete Confiramtion';  ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you confirm to delete this City.</p>
      </div>
      <div class="modal-footer">
        <button type="button" id="confirm_delete_city" data-id="" class="btn btn-primary"><?php echo(!empty($admin_settings['lg_admin_yes']))?($admin_settings['lg_admin_yes']) : 'Yes';  ?></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo(!empty($admin_settings['lg_admin_no']))?($admin_settings['lg_admin_no']) : 'No';  ?></button>
      </div>
    </div>
  </div>
</div>