<?php 
$admin_settings = $language_content;
?>
<div class="page-wrapper">
	<div class="content container-fluid">
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title"><?php echo(!empty($admin_settings['lg_admin_languages']))?($admin_settings['lg_admin_languages']) : 'Languages';  ?></h3>
				</div>
				<div class="col-auto text-end">
					<a class="btn btn-primary add-button" href="<?php echo base_url()?>add-languages">
						<i class="fas fa-plus"></i>
					</a>
					<a class="btn btn-primary" href="<?php echo base_url(). 'admin/language/exportlang'?>">
						<i class="fas fa-download mr-2"></i>Web Export</a>
					<a class="btn btn-primary" href="<?php echo base_url(). 'admin/language/exporapptlang'?>">
						<i class="fas fa-download mr-2"></i>App Export</i>
					</a>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<?php  ?>
							<table class="table custom-table mb-0 datatable">
								<thead>
									<tr>
										<th><?php echo(!empty($admin_settings['lg_admin_#']))?($admin_settings['lg_admin_#']) : '#';  ?></th>
										<th><?php echo(!empty($admin_settings['lg_admin_language']))?($admin_settings['lg_admin_language']) : 'Language';  ?></th>
										<th><?php echo(!empty($admin_settings['lg_admin_code']))?($admin_settings['lg_admin_code']) : 'Code';  ?></th>
										<th><?php echo(!empty($admin_settings['lg_admin_rtl']))?($admin_settings['lg_admin_rtl']) : 'RTL';  ?></th>
										<th><?php echo(!empty($admin_settings['lg_admin_default_language']))?($admin_settings['lg_admin_default_language']) : 'Default Language';  ?></th>
										<th><?php echo(!empty($admin_settings['lg_admin_status']))?($admin_settings['lg_admin_status']) : 'Status';  ?></th>
										<th class="text-end"><?php echo(!empty($admin_settings['lg_admin_action']))?($admin_settings['lg_admin_action']) : 'Action';  ?></th>
										<th class="text-end">Import</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1; foreach ($language as $lang) { 
										if($lang->language_value == 'en') { 
                                			$attr = 'disabled';
                                		} else {
                                			$attr = '';
                                		} ?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $lang->language; ?></td>
										<td><?php echo $lang->language_value; ?></td>
										<td>
											<div>
												<div class="status-toggle">
													<input  id="tag_<?php echo $lang->id; ?>" class="check language_tag" data-id="<?php echo $lang->id; ?>" type="checkbox" <?php if($lang->tag == 'rtl') { echo 'checked'; } ?> <?php if($this->session->userdata('role') != 1) { echo 'disabled'; } ?>>
													<label for="tag_<?php echo $lang->id; ?>" class="checktoggle">checkbox</label>
												</div>
											</div> 
		                                </td>
		                                <td>
											<div>
												<div class="status-toggle">
													<input  id="default_<?php echo $lang->id; ?>" class="check default_lang" data-id="<?php echo $lang->id; ?>" data-status="<?php echo $lang->default_language; ?>" type="checkbox" <?php if($lang->default_language == 1) { echo 'checked'; } ?> <?php if($this->session->userdata('role') != 1) { echo 'disabled'; } ?>>
													<label for="default_<?php echo $lang->id; ?>" class="checktoggle">checkbox</label>
												</div>
											</div> 
		                                </td>
		                                <td>
											<div>
												<div class="status-toggle" disabled>
													<input <?php echo $attr; ?> id="status_<?php echo $lang->id; ?>" class="check language_status" data-id="<?php echo $lang->id; ?>" type="checkbox" <?php if($lang->status == 1) { echo 'checked'; } ?> <?php if($this->session->userdata('role') != 1) { echo 'disabled'; } ?> >
													<label for="status_<?php echo $lang->id; ?>" class="checktoggle" disabled>checkbox</label>
												</div>
											</div> 
		                                </td>
										<td class="text-end">
											<a class="btn btn-sm bg-info-light mr-2" href="<?php echo base_url().'web-languages/'.$lang->language_value;?>" title="Web Translation">
												<i class="fas fa-language mr-1"></i><?php echo(!empty($admin_settings['lg_admin_web']))?($admin_settings['lg_admin_web']) : 'Web';  ?>
											</a>
											<a class="btn btn-sm bg-warning-light mr-2" href="<?php echo base_url().'app-page-list/'.$lang->language_value;?>" title="App Translation">
												<i class="fas fa-language mr-1"></i><?php echo(!empty($admin_settings['lg_admin_app']))?($admin_settings['lg_admin_app']) : 'App';  ?>
											</a>
											<a class="btn btn-sm bg-primary-light mr-2" href="<?php echo base_url().'admin-web-languages/'.$lang->language_value;?>" title="App Translation">
												<i class="fa fa-language mr-1"></i><?php echo(!empty($admin_settings['lg_admin_admin']))?($admin_settings['lg_admin_admin']) : 'Admin';  ?>
											</a>
											<a href="<?php echo base_url().'edit-languages/'.$lang->language_value;?>" class="btn btn-sm bg-success-light mr-2" title="Edit">
												<i class="far fa-edit"></i>
											</a>
											<?php if($lang->language_value != 'en') { ?>
												<a href="#" class="btn btn-sm bg-danger-light mr-2 delete_language" data-id="<?php echo $lang->language_value; ?>">
													<i class="far fa-trash-alt"></i>
												</a>
											<?php } ?>
										</td>
										<td>
											<a class="btn btn-primary btn-sm lang_code" href="javascript:void(0);" data-toggle="modal" data-target="#importmodal" data-lang="<?php echo $lang->language_value; ?>" >
											<i class="fas fa-cloud-upload-alt mr-2"></i><?php echo(!empty($admin_settings['lg_admin_web']))?($admin_settings['lg_admin_web']) : 'Web';  ?></a>
											<a class="btn btn-primary btn-sm lang_app_code" href="javascript:void(0);" data-toggle="modal" data-target="#importappmodal" data-lang="<?php echo $lang->language_value; ?>" >
											<i class="fas fa-cloud-upload-alt mr-2"></i><?php echo(!empty($admin_settings['lg_admin_app']))?($admin_settings['lg_admin_app']) : 'App';  ?></a>
										</td>
									</tr>
									<?php $i++; } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="importmodal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5><?php echo(!empty($admin_settings['lg_admin_web_language_upload']))?($admin_settings['lg_admin_web_language_upload']) : 'Web Language File Upload';  ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url(). 'admin/language/importlang'?>" method="post" enctype="multipart/form-data">
        	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
        	<input type="file" id="add_language" name="add_language" placeholder="Select file" required accept=".csv">
        	<input type="hidden" name="lang_code" id="code_value">
      </div>
      <div class="modal-footer">
        <button type="submit" id="confirm_delete_sub" data-id="" class="btn btn-primary"><?php echo(!empty($admin_settings['lg_admin_confirm']))?($admin_settings['lg_admin_confirm']) : 'Confirm';  ?></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo(!empty($admin_settings['lg_admin_cancel']))?($admin_settings['lg_admin_cancel']) : 'Cancel';  ?></button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="importappmodal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5><?php echo(!empty($admin_settings['lg_amdin_app_language_upload']))?($admin_settings['lg_amdin_app_language_upload']) : 'App Language File Upload';  ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url(). 'admin/language/importapplang'?>" method="post" enctype="multipart/form-data">
        	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
        	<input type="file" id="add_app_language" name="add_app_language" placeholder="Select file" required>
        	<input type="hidden" name="lang_code" id="code_app_value">
      </div>
      <div class="modal-footer">
        <button type="submit" id="confirm_delete_sub" data-id="" class="btn btn-primary"><?php echo(!empty($admin_settings['lg_admin_confirm']))?($admin_settings['lg_admin_confirm']) : 'Confirm';  ?></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo(!empty($admin_settings['lg_admin_cancel']))?($admin_settings['lg_admin_cancel']) : 'Cancel';  ?></button>
        </form>
      </div>
    </div>
  </div>
</div>