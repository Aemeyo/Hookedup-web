<?php 
$emailtemplate = $language_content;
?>
<div class="page-wrapper">
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title"><?php echo(!empty($emailtemplate['lg_admin_email_template']))?($emailtemplate['lg_admin_email_template']) : 'Email template';  ?></h3>
				</div>
			</div>
		</div>
		<!-- /Page Header -->		

				
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							 <table class="table table-hover table-center mb-0 emailtemplate_table">
                            <thead>
                                <tr>
                                    <th><?php echo(!empty($emailtemplate['lg_admin_reference_id']))?($emailtemplate['lg_admin_reference_id']) : 'Reference ID';  ?></th>
                                    <th><?php echo(!empty($emailtemplate['lg_admin_email_title']))?($emailtemplate['lg_admin_email_title']) : 'Email Titles';  ?></th>
                                    <th class="text-right"><?php echo(!empty($emailtemplate['lg_admin_action']))?($emailtemplate['lg_admin_action']) : 'Action';  ?></th>
                                </tr>
                            </thead>
                            <tbody >
                                <?php                                
                                
                                if (!empty($list)) {
                                    $sno = 1;
                                    foreach ($list as $row) {                          
                                            ?>
                                            <tr>
                                                <td><?php echo $row['template_type'] ?></td>  
                                                <td> <?php echo $row['template_title'] ?></td>                                                
                                                <td class="text-right">
                                                    <a href="<?php echo base_url('edit-emailtemplate/' . $row['template_id']); ?>" class="btn btn-sm bg-success-light mr-2" title="Edit"><i class="far fa-edit mr-1"></i> <?php echo(!empty($emailtemplate['lg_admin_edit']))?($emailtemplate['lg_admin_edit']) : 'Edit';  ?></a>
                                                </td>
                                            </tr>
                                            <?php
                                        
                                   $sno = $sno +1;
                                        }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="11"><p class="text-danger text-center m-b-0"><?php echo(!empty($emailtemplate['lg_admin_no_records_found']))?($emailtemplate['lg_admin_no_records_found']) : 'No Records Found';  ?></p></td>
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