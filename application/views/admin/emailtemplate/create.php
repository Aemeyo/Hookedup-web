<?php 
$emailtemplate = $language_content;
?>
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
					<h4 class="page-title m-b-20 m-t-0"><?php echo(!empty($emailtemplate['lg_admin_create_email_template']))?($emailtemplate['lg_admin_create_email_template']) : 'Create Email Template';  ?></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">                        

                        <form class="form-horizontal" action="<?php echo base_url('admin/emailtemplate/create'); ?>" method="POST" enctype="multipart/form-data" >
							<div class="form-group">
								<label class="col-sm-3 control-label"><?php echo(!empty($emailtemplate['lg_admin_email_title']))?($emailtemplate['lg_admin_email_title']) : 'Email Titles';  ?></label>
								<div class="col-sm-9">
									<input type="text" name="template_title" id="template_title" class="form-control" placeholder="Email template name" required="required">                             
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label"><?php echo(!empty($emailtemplate['lg_admin_template_content']))?($emailtemplate['lg_admin_template_content']) : 'Template Content';  ?></label>
								<div class="col-sm-9">
									<?php
										echo "<textarea class='form-control' id='ck_editor_textarea_id' rows='6' name='template_content'> </textarea>";
										echo display_ckeditor($ckeditor_editor1);
									
									?>
								</div>
							</div>
							<div class="m-t-30 text-center">
								<button name="form_submit" type="submit" class="btn btn-primary" value="true"><?php echo(!empty($emailtemplate['lg_admin_save']))?($emailtemplate['lg_admin_save']) : 'Save';  ?></button>
								<a href="<?php echo base_url().'admin/emailtemplate' ?>" class="btn btn-default m-l-5"><?php echo(!empty($emailtemplate['lg_admin_cancel']))?($emailtemplate['lg_admin_cancel']) : 'Cancel';  ?></a>
							</div>
						</form>                          
                    </div>
                </div>
			</div>
        </div>
    </div>
</div>