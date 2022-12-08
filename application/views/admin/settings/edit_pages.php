<?php 
$pages = $language_content;

$query = $this->db->query("select * from language WHERE status = '1'");
$lang_test = $query->result_array();
?>
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="row">
			<div class="col-xl-8 offset-xl-2">
			
				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col">
							<h3 class="page-title"><?php echo(!empty($pages['lg_admin_edit_pages']))?($pages['lg_admin_edit_pages']) : 'Edit Pages';  ?></h3>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				<div class="card">
					<div class="card-body">
						<form action="<?php echo base_url().'admin/settings/edit_pages/' . $pages_val['id']; ?>" id="add_pages" method="post" autocomplete="off" enctype="multipart/form-data">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
							<div class="form-group">
								<label><?php echo(!empty($pages['lg_admin_title']))?($pages['lg_admin_title']) : 'Titles';  ?></label>
								<input class="form-control" type="text"  name="title" id="title" value="<?php echo $pages_val['title']; ?>">
							</div>
							<div class="form-group">
								<label><?php echo(!empty($pages['lg_admin_slug']))?($pages['lg_admin_slug']) : 'Slug';  ?> <small><?php echo(!empty($pages['lg_admin_auto_slug']))?($pages['lg_admin_auto_slug']) : '(If you leave it empty, it will be generated automatically.)';  ?></small></label>
								<input class="form-control" type="text"  name="pages_slug" id="pages_slug" value="<?php echo $pages_val['slug']; ?>">
							</div>
							<div class="form-group">
								<label><?php echo(!empty($pages['lg_admin_description']))?($pages['lg_admin_description']) : 'Description';  ?>  <small><?php echo(!empty($pages['lg_admin_meta_tag']))?($pages['lg_admin_meta_tag']) : '(Meta Tag)';  ?></small></label>
								<input class="form-control" type="text"  name="pages_desc" id="pages_desc" value="<?php echo $pages_val['description']; ?>">
							</div>
							<div class="form-group">
								<label><?php echo(!empty($pages['lg_admin_keywords']))?($pages['lg_admin_keywords']) : 'Keywords';  ?>   <small><?php echo(!empty($pages['lg_admin_meta_tag']))?($pages['lg_admin_meta_tag']) : '(Meta Tag)';  ?></small></label>
								<input class="form-control" type="text"  name="pages_key" id="pages_desc" value="<?php echo $pages_val['keywords']; ?>">
							</div>
							<div class="form-group">
                                <label><?php echo(!empty($pages['lg_admin_language']))?($pages['lg_admin_language']) : 'language';  ?></label>
                                <select class="form-control select" name="pages_lang" id="pages_lang">
                                    <option value=""><?php echo(!empty($pages['lg_admin_select_language']))?($pages['lg_admin_select_language']) : 'Select Language';  ?></option>
                                    <?php foreach ($lang_test as $rows) {  ?>
                                    <option value="<?php echo $rows['id'];?>"<?php if($rows['id']==$pages_val['lang_id']) echo 'selected';?>><?php echo $rows['language'];?></option>
                                   <?php } ?>
                                </select>
                            </div>
							<div class="form-group">
								<label><?php echo(!empty($pages['lg_admin_location']))?($pages['lg_admin_location']) : 'Location';  ?></label><br>
								 <label><input type="radio" name="pages_loc" value="1"<?=(!empty($pages_val['location'])&&$pages_val['location']==1)?'checked':'';?>> <?php echo(!empty($pages['lg_admin_top_menu']))?($pages['lg_admin_top_menu']) : 'Top Menu';  ?> </label>&nbsp
								 <label><input type="radio" name="pages_loc" value="2"<?=(!empty($pages_val['location'])&&$pages_val['location']==2)?'checked':'';?>> <?php echo(!empty($pages['lg_admin_quick_links']))?($pages['lg_admin_quick_links']) : 'Quick Links';  ?></label>
							</div>
							<div class="form-group">
								 <label><?php echo(!empty($pages['lg_admin_visibility']))?($pages['lg_admin_visibility']) : 'Visibility';  ?></label><br>
								 <label><input type="radio" name="pages_visibility" value="1"<?=(!empty($pages_val['visibility'])&&$pages_val['visibility']==1)?'checked':'';?>> <?php echo(!empty($pages['lg_admin_show']))?($pages['lg_admin_show']) : 'Show';  ?> </label>&nbsp
								 <label><input type="radio" name="pages_visibility" value="2"<?=(!empty($pages_val['visibility'])&&$pages_val['visibility']==2)?'checked':'';?>> <?php echo(!empty($pages['lg_admin_hide']))?($pages['lg_admin_hide']) : 'Hide';  ?></label>
							</div>
							<div class="form-group">
								<label><?php echo(!empty($pages['lg_admin_content']))?($pages['lg_admin_content']) : 'Content';  ?></label>
								<textarea class='form-control' id='ck_editor_textarea_id' rows='6' name="content"><?php echo $pages_val['page_content']; ?></textarea>
								<?php echo display_ckeditor($ckeditor_editor1); ?>
							</div>
							<div class="mt-4">
								<button class="btn btn-primary " name="form_submit" value="submit" type="submit"><?php echo(!empty($pages['lg_admin_save_changes']))?($pages['lg_admin_save_changes']) : 'Save';  ?></button>

								<a href="<?php echo $base_url; ?>admin/pages-list"  class="btn btn-cancel"><?php echo(!empty($pages['lg_admin_cancel']))?($pages['lg_admin_cancel']) : 'Cancel';  ?></a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

					