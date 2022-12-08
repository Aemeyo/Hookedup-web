<?php 
$admin_settings = $language_content;
?>
<div class="page-wrapper">
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title"><?php echo(!empty($admin_settings['lg_admin_pages']))?($admin_settings['lg_admin_pages']) : 'Pages';  ?></h3>
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
										<th><?php echo(!empty($admin_settings['lg_admin_pages']))?($admin_settings['lg_admin_pages']) : 'Pages';  ?> </th>
										<th><?php echo(!empty($admin_settings['lg_admin_slug']))?($admin_settings['lg_admin_slug']) : 'Slug';  ?></th>
										<th ><?php echo(!empty($admin_settings['lg_admin_status']))?($admin_settings['lg_admin_status']) : 'Status';  ?></th>
										<th><?php echo(!empty($admin_settings['lg_admin_action']))?($admin_settings['lg_admin_action']) : 'Action';  ?></th>
									</tr>
								</thead>
								<tbody>
									<?php 
										foreach ($pages as $key => $page) {
										if($page->status==1) {
										$val='checked';
									}
									else {
										$val=''; 
									}
								$pages_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
								$this->db->where('modules', $page->modules);
					            $this->db->where('lang_type', $pages_lang);
					            $pages_name = $this->db->get('home_settings')->row();
									 ?>
									<tr>
										<td style="text-transform: capitalize;"><?php echo(!empty($pages_name->title))?($pages_name->title) : 'Pages';  ?></td>
										<td><?php echo $page->page_slug; ?></td>
										<td class="text-center">
	                                		<?php if($page->page_route == 'home-page') { 
	                                			$attr = 'disabled';
	                                		} else {
	                                			$attr = '';
	                                		} ?>
	                                		<div class="status-toggle">
											<input <?php echo $attr; ?> id="pages_status<?php echo $page->id ?>" class="check pages_status" data-id="<?php echo $page->id ?>" type="checkbox" <?php echo $val ?>>
											<label for="pages_status<?php echo $page->id ?>" class="checktoggle">checkbox</label>
										</div>
										</td>
										<td >
											<a href="<?php echo $base_url; ?>settings/<?php echo $page->page_route; ?>/<?php echo $page->id; ?>" class="btn btn-sm bg-success-light me-2">
												<i class="far fa-edit me-1"></i><?php echo(!empty($admin_settings['lg_admin_edit']))?($admin_settings['lg_admin_edit']) : 'Edit';  ?>
											</a>
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