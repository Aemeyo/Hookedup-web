<?php
   $user_details = $this->db->get('administrators')->result_array();
   $pushnotification = $language_content;

?>
<div class="page-wrapper">
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title"><?php echo(!empty($pushnotification['lg_admin_push_notification_list']))?($pushnotification['lg_admin_push_notification_list']) : 'Announcements List';  ?></h3>
				</div>
				<div class="col-auto text-right">
					<a class="btn btn-white filter-btn mr-3" href="javascript:void(0);" id="filter_search">
						<i class="fas fa-filter"></i>
					</a>
					<a href="<?=base_url().'admin/send-announcements';?>" class="btn btn-primary add-button"><i class="fas fa-plus"></i></a>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		
	
		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
                        <div class="table-responsive">
                            <table class="custom-table table table-hover table-center mb-0 w-100" id="pushnot_table">
                                <thead>
                                    <tr>
                                        <th><?php echo(!empty($pushnotification['lg_admin_#']))?($pushnotification['lg_admin_#']) : '#';  ?></th>
                                        <th><?php echo(!empty($pushnotification['lg_admin_subject']))?($pushnotification['lg_admin_subject']) : 'Subject';  ?></th>
                                        <th><?php echo(!empty($pushnotification['lg_admin_message']))?($pushnotification['lg_admin_message']) : 'Message';  ?></th>
																				<th><?php echo(!empty($pushnotification['lg_admin_send_to']))?($pushnotification['lg_admin_send_to']) : 'Send To';  ?></th>
																				<th><?php echo(!empty($pushnotification['lg_admin_date']))?($pushnotification['lg_admin_date']) : 'Date';  ?></th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
									if(!empty($list)) {
										$i=1;
										$user='';
										$provider='';

										foreach ($list as $rows) {
											if(!empty($rows['created_on'])){
												$date=date(settingValue('date_format'). ' H:i:s', strtotime($rows['created_on']));
											}else{
												$date='-';
											}
										if($rows['user_status']==1)
										{
											$user='Users';
										}
										if($rows['provider_status']==1)
										{
											$provider='Providers';
										}
										 $base_url=base_url()."adminusers/edit/".$rows['id'];

										$action="<a href='".$base_url."'' class='btn btn-sm bg-success-light mr-2'>
      <i class='far fa-edit mr-1'></i> Edit
      </a>
      <a class='btn btn-sm bg-info-light delete_show' data-id='".$rows['id']."'><i class='fa fa-trash' ></i> Delete</a>";
					echo'<tr>
					<td>'.$i++.'</td>
			
			<td>'.$rows['subject'].'</td>
			<td>'.$rows['message'].'</td>
				<td>'.$user.'/'.$provider.'</td>
				<td>'.$date.'</td>
										</tr>';
										}
                                    }
                                    else {
										echo '<tr><td colspan="6"><div class="text-center text-muted">No records found</div></td></tr>';
                                    }
									?>
                                </tbody>
                            </table>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="delete_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5><?php echo(!empty($pushnotification['lg_admin_delete_confirmation']))?($pushnotification['lg_admin_delete_confirmation']) : 'Delete Confirmation';  ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><?php echo(!empty($pushnotification['lg_admin_are_confirm_delete']))?($pushnotification['lg_admin_are_confirm_delete']) : 'Are you confirm to Delete.';  ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" id="confirm_btn_admin" data-id="" class="btn btn-primary"><?php echo(!empty($pushnotification['lg_admin_confirm']))?($pushnotification['lg_admin_confirm']) : 'Confirm';  ?></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo(!empty($pushnotification['lg_admin_cancel']))?($pushnotification['lg_admin_cancel']) : 'Cancel';  ?></button>
      </div>
    </div>
  </div>
</div>
