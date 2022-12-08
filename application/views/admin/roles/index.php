<?php 
$categories = $language_content;
?>
<div class="page-wrapper">
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title"><?php echo(!empty($categories['lg_roles_permissions']))?($categories['lg_roles_permissions']) : 'Roles & Permissions';  ?></h3>
				</div>
				<div class="col-auto text-right">
					<a href="<?php echo $base_url; ?>categories" class="btn btn-primary add-button"><i class="fas fa-sync"></i></a>
					
					<a href="<?php echo $base_url; ?>admin/add-roles-permissions" class="btn btn-primary add-button"><i class="fas fa-plus"></i></a>
				
				</div>
			</div>
		</div>
		<!-- /Page Header -->
				
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover table-center mb-0 categories_table" id="categories_table">
								<thead>
									<tr>
										<th><?php echo(!empty($categories['lg_admin_#']))?($categories['lg_admin_#']) : '#';  ?></th>
										<th><?php echo(!empty($categories['lg_role_name']))?($categories['lg_role_name']) : 'Role Name';  ?></th>
										<!-- <th><?php //echo(!empty($categories['lg_permissions']))?($categories['lg_permissions']) : 'Permissions';  ?></th> -->
										<th><?php echo(!empty($categories['lg_admin_action']))?($categories['lg_admin_action']) : 'Action';  ?></th>		  
									</tr>
								</thead>
								<tbody>
									<?php
									$i=1;
									if(!empty($roles)){
										foreach ($roles as $rows) { 
											$role_name = $this->db->get_where('roles_permissions_lang', array('role_id'=>$rows['id'], 'lang_type'=>settingValue('language')))->row()->role_name;
											?>
										<tr>
											<td><?php echo $i++; ?></td>
											<td><?php echo $role_name; ?></td>
											<!-- <td><?php //echo wordwrap($rows['permission_modules'], 60, '<br />', true); ?></td> -->
											<td>
												<a href="<?php echo $base_url; ?>admin/edit-roles-permissions/<?php echo $rows['id']; ?>" class="btn btn-sm bg-success-light mr-2">
													<i class="far fa-edit mr-1"></i>Edit
												</a>
												<a href="javascript:;" class="on-default remove-row btn btn-sm bg-danger-light mr-2 delete_roles" id="Onremove_'.$rows['id'].'" data-id="<?php echo $rows['id']; ?>"><i class="far fa-trash-alt mr-1"></i>Delete</a>
											</td>
										</tr>
										<?php }
									} else { ?>
										<tr>
											<td colspan="4"><div class="text-center text-muted">No records found</div></td>
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