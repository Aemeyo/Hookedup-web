<?php 
$admin_settings = $language_content;
?>
<div class="page-wrapper">
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title"><?php echo(!empty($admin_settings['lg_admin_currency_settings']))?($admin_settings['lg_admin_currency_settings']) : 'Currency Settings';  ?></h3>
				</div>
				<div class="col-auto text-right">
					<div class="col-sm-4 text-right m-b-20">
						<a href="<?php echo base_url().'admin/settings/create-currency'; ?>" class="btn btn-primary add-button"><i class="fas fa-plus"></i></a>
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
						<table class="table table-hover table-center categories_table">
							<thead>
								<tr>
									<th><?php echo(!empty($admin_settings['lg_admin_#']))?($admin_settings['lg_admin_#']) : '#';  ?></th>
									<th><?php echo(!empty($admin_settings['lg_admin_currency_name']))?($admin_settings['lg_admin_currency_name']) : 'Currency Name';  ?></th>
									<th><?php echo(!empty($admin_settings['lg_admin_currency_symbol']))?($admin_settings['lg_admin_currency_symbol']) : 'Currency Symbol';  ?></th>
									<th><?php echo(!empty($admin_settings['lg_admin_currency_code']))?($admin_settings['lg_admin_currency_code']) : 'Currency Code';  ?></th>
									<th><?php echo(!empty($admin_settings['lg_admin_currency_rate']))?($admin_settings['lg_admin_currency_rate']) : 'Currency Rate';  ?></th>
									<th class="text-right"><?php echo(!empty($admin_settings['lg_admin_action']))?($admin_settings['lg_admin_action']) : 'Action';  ?></th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (!empty($lists)) {
									$i=1;
									foreach ($lists as $row) {
								?>
									<tr>
										<td> <?php echo $i++; ?></td>
										<td> <?php echo $row['currency_name']; ?></td>
										<td> <?php echo $row['currency_symbol']; ?></td>
										<td> <?php echo $row['currency_code']; ?></td>
										<td> <?php echo $row['rate']; ?></td>
										<td class="text-right">
											<a href="<?php echo base_url().'admin/settings/currency-edit/' . $row['id']; ?>" class="btn btn-sm bg-success-light"><i class="far fa-edit mr-1"></i> <?php echo(!empty($admin_settings['lg_admin_edit']))?($admin_settings['lg_admin_edit']) : 'Edit';  ?></a>&nbsp;
											<!-- <a class='btn btn-sm bg-danger-light delete_show' id="cur_del" data-id="<?php  echo $row['id']; ?>"><i class="far fa-trash-alt"></i> <?php echo(!empty($admin_settings['lg_admin_delete']))?($admin_settings['lg_admin_delete']) : 'Delete';  ?></a> -->
											<a href="<?php echo base_url().'admin/settings/currency_delete/' . $row['id']; ?>" class="btn btn-sm bg-danger-light"> <i class="far fa-trash-alt"></i> <?php echo(!empty($admin_settings['lg_admin_delete']))?($admin_settings['lg_admin_delete']) : 'Delete';  ?></a>
										</td>
									</tr>
									<?php
										
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

<div class="modal" id="cur_delete_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5><?php echo(!empty($admin_settings['lg_admin_delete_confiramtion']))?($admin_settings['lg_admin_delete_confiramtion']) : 'Delete Confiramtion';  ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><?php echo(!empty($admin_settings['lg_admin_are_currency']))?($admin_settings['lg_admin_are_currency']) : 'Are you confirm to delete this currency.';  ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" id="confirm_delete_cur" data-id="" class="btn btn-primary"><?php echo(!empty($admin_settings['lg_admin_yes']))?($admin_settings['lg_admin_yes']) : 'Yes';  ?></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo(!empty($admin_settings['lg_admin_no']))?($admin_settings['lg_admin_no']) : 'No';  ?></button>
      </div>
    </div>
  </div>
</div>