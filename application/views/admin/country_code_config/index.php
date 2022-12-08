<?php 
$admin_settings = $language_content;
?>
<div class="page-wrapper">
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title"><?php echo(!empty($admin_settings['lg_admin_country_code']))?($admin_settings['lg_admin_country_code']) : 'Country Code';  ?></h3>
				</div>
				<div class="col-auto text-right">
					<div class="col-sm-4 text-right m-b-20">
						<a href="<?php echo base_url().'admin/country-code-config/create'; ?>" class="btn btn-primary add-button"><i class="fas fa-plus"></i></a>
					</div>
				
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		<?php
			if ($this->session->userdata('message')) {
				echo $this->session->userdata('message');
			}
			?>
		<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover m-b-0 categories_table">
							<thead>
								<tr>
									<th><?php echo(!empty($admin_settings['lg_admin_#']))?($admin_settings['lg_admin_#']) : '#';  ?></th>
									<th><?php echo(!empty($admin_settings['lg_admin_country_code']))?($admin_settings['lg_admin_country_code']) : 'Country Code';  ?></th>
									<th><?php echo(!empty($admin_settings['lg_admin_country_id']))?($admin_settings['lg_admin_country_id']) : 'Country ID';  ?></th>
									<th><?php echo(!empty($admin_settings['lg_admin_country_name']))?($admin_settings['lg_admin_country_name']) : 'Country Name';  ?></th>
									<th class="text-right"><?php echo(!empty($admin_settings['lg_admin_action']))?($admin_settings['lg_admin_action']) : 'Action';  ?></th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (!empty($lists)) {
									$sno = 0;
									foreach ($lists as $row) {
										$_id = isset($row['id']) ? $row['id'] : '';
										if (!empty($_id)) {
											$country_code = isset($row['country_code']) ? $row['country_code'] : '';
											$country_id = isset($row['country_id']) ? $row['country_id'] : '';
											$country_name = isset($row['country_name']) ? $row['country_name'] : '';
											$user_status = 'Inactive';
											if (isset($row['status']) && $row['status'] == 1) {
												$user_status = 'Active';
											}
								?>
											<tr>
												<td> <?php echo ++$sno; ?></td>
												<td> <?php echo $country_code; ?></td>
												<td> <?php echo $country_id; ?></td>
												<td> <?php echo $country_name ?></td>
												<td class="text-right">
													<a href="<?php echo base_url().'admin/country-code-config/edit/' . $_id; ?>" class="btn btn-sm bg-success-light mr-2"><i class="far fa-edit mr-1"></i> <?php echo(!empty($admin_settings['lg_admin_edit']))?($admin_settings['lg_admin_edit']) : 'Edit';  ?></a>&nbsp;
													<a href="javascript:;" class="on-default remove-row btn btn-sm bg-danger-light mr-2 delete_country_code_config" id="Onremove_<?php echo $_id; ?>" data-id="<?php echo $_id; ?>"><i class="far fa-trash-alt mr-1"></i> <?php echo(!empty($admin_settings['lg_admin_delete']))?($admin_settings['lg_admin_delete']) : 'Delete';  ?></a>
												</td>
											</tr>
									<?php
										}
									}
								} else {
									?>
									<tr>
										<td colspan="5">
											<p class="text-danger text-center m-b-0"><?php echo(!empty($admin_settings['lg_admin_no_records_found']))?($admin_settings['lg_admin_no_records_found']) : 'No Records Found';  ?></p>
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
</div>