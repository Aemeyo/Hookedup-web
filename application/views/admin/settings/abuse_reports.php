<?php 
$admin_settings = $language_content;
?>
<div class="page-wrapper">
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title">Abuse Reports</h3>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table class="table custom-table mb-0 datatable" id="pages_status">
								<thead>
									<tr>
										<th><?php echo(!empty($admin_settings['lg_admin_#']))?($admin_settings['lg_admin_#']) : '#';  ?> </th>
										<th><?php echo(!empty($admin_settings['lg_admin_provider']))?($admin_settings['lg_admin_provider']) : 'Provider';  ?></th>
										<th>Reported By User</th>
										<th><?php echo(!empty($admin_settings['lg_admin_description']))?($admin_settings['lg_admin_description']) : 'description';  ?></th>
										<th>Created at</th>
										<th><?php echo(!empty($admin_settings['lg_admin_action']))?($admin_settings['lg_admin_action']) : 'Action';  ?></th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$i=1;
										foreach ($list as $row) {
										$user_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
										$this->db->where('modules', 'user');
								        $this->db->where('name_id', $row['report_user_id']);
								        $this->db->where('lang_type', $user_lang);
								        $user_name = $this->db->get('users_lang')->row_array();

								        $this->db->where('modules', 'provider');
								        $this->db->where('name_id', $row['pro_id']);
								        $this->db->where('lang_type', $user_lang);
								        $pro_name = $this->db->get('users_lang')->row_array();
									 ?>
									<tr>
										<td> <?php echo $i++; ?></td>
										<td> <?php echo $pro_name['name']; ?></td>
										<td> <?php echo $user_name['name']; ?></td>
										<td><?php echo wordwrap($row['description'], 50, '<br />', true);?></td>
										<td> <?php echo $row['created_at']; ?></td>

										<td> <a href="<?php echo base_url().'abuse-details/' . $row['id']; ?>" class="btn btn-sm bg-info-light">
										<i class="far fa-eye mr-1"></i> <?php echo(!empty($admin_settings['lg_admin_view']))?($admin_settings['lg_admin_view']) : 'View';  ?>
									</a></td>
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

<div class="modal" id="abuse_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5><?php echo(!empty($user_language[$user_selected]['lg_admin_delete_confirmation']))?($user_language[$user_selected]['lg_admin_delete_confirmation']) : 'Are you confirm to Delete.';  ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" id="abuse_desc"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="confirm_abuse_sub" data-userid="<?php echo $this->session->userdata('id'); ?>" data-id="" class="btn btn-primary"><?php echo(!empty($user_language[$user_selected]['lg_admin_confirm']))?($user_language[$user_selected]['lg_admin_confirm']) : 'Confirm';  ?></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo(!empty($user_language[$user_selected]['lg_admin_cancel']))?($user_language[$user_selected]['lg_admin_cancel']) : 'Cancel';  ?></button>
      </div>
    </div>
  </div>
</div>