<?php
   $module_details = $this->db->where('status',1)->get('admin_modules')->result_array();
   $pushnotification = $language_content;

?>
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="row">
			<div class="col-xl-12 offset-xl-12">
			
				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col">
							<h3 class="page-title"><?=$title;?></h3>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				
				<div class="card">
					<div class="card-body">
						<form method="post" autocomplete="off" enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?=(!empty($user['user_id']))?$user['user_id']:''?>" id="user_id">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
							
							<div class="form-group">
								<label><?php echo(!empty($pushnotification['lg_admin_subject']))?($pushnotification['lg_admin_subject']) : 'Subject';  ?></label>
								<input type="text" name="subject" class="form-control" />
							</div>
							
							<div class="form-group">
								<label><?php echo(!empty($pushnotification['lg_admin_message']))?($pushnotification['lg_admin_message']) : 'Message';  ?></label>
								<textarea class="form-control" rows='10' name="message" id="message" ></textarea>
							</div>
							<div class="form-group">
								<label><?php echo(!empty($pushnotification['lg_admin_send_to']))?($pushnotification['lg_admin_send_to']) : 'Send To';  ?></label>
								<div class="example1">
									<div><input type="checkbox" name="selectall1" id="selectall1" class="all" value="1"> <label for="selectall1"><strong><?php echo(!empty($pushnotification['lg_admin_select_all']))?($pushnotification['lg_admin_select_all']) : 'Select all';  ?></strong></label></div>
									
									<div><input type="checkbox" name="accesscheck[]" id="check_1" value="1"> <label for="check_1"><?php echo(!empty($pushnotification['lg_admin_user']))?($pushnotification['lg_admin_user']) : 'User';  ?></label></div>								
									<div><input type="checkbox" name="accesscheck[]" id="check_2" value="2"> <label for="check_2"><?php echo(!empty($pushnotification['lg_admin_provider']))?($pushnotification['lg_admin_provider']) : 'Provider';  ?></label></div>								
								</div>
							</div>
							<div class="mt-4">
								<button class="btn btn-primary " name="form_submit1" value="submit" type="submit"><?php echo(!empty($pushnotification['lg_admin_submit']))?($pushnotification['lg_admin_submit']) : 'Submit';  ?></button>
								<a href="<?php echo $base_url; ?>admin/announcements"  class="btn btn-cancel"><?php echo(!empty($pushnotification['lg_admin_cancel']))?($pushnotification['lg_admin_cancel']) : 'Cancel';  ?></a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

