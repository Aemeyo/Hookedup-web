<?php 
$categories_lang = $language_content;

$query = $this->db->query("select * from language WHERE status = '1'");
$lang_test = $query->result();
?>
<div class="page-wrapper">
	<div class="content container-fluid">
	
		<div class="row">
			<div class="col-xl-8 offset-xl-2">

				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col">
							<h3 class="page-title"><?php echo(!empty($categories_lang['lg_admin_edit_category']))?($categories_lang['lg_admin_edit_category']) : 'Edit Category';  ?></h3>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				
				<div class="card">
					<div class="card-body">
                        <form id="update_category" method="post" autocomplete="off" enctype="multipart/form-data">
                        	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
    						<input class="form-control" type="hidden" value="<?php echo $categories['id'];?>"  name="category_id" id="category_id">
    						<?php foreach ($lang_test as $langval) { 
    							$this->db->where('category_id', $categories['id']);
						        $this->db->where('lang_type', $langval->language_value);
						        $lang_category = $this->db->get('categories_lang')->row();
    						?>
                            <div class="form-group">
                                <label><?php echo(!empty($categories_lang['lg_admin_category_name']))?($categories_lang['lg_admin_category_name']) : 'Category Name';  ?>(<?php echo $langval->language; ?>)</label>
                                <input class="form-control" type="text" value="<?php echo (!empty($lang_category)) ? $lang_category->category_name : ""; ?>"  name="category_name_<?php echo $langval->id; ?>" id="category_name" required>
                            </div>
                            <?php }  ?>
                            <div class="form-group">
								<label><?php echo(!empty($categories['lg_admin_category_slug']))?($categories['lg_admin_category_slug']) : 'Category Slug';  ?> (Ex:test-slug)</label>
								<input class="form-control" type="text"  name="category_slug" id="category_slug" value="<?php echo $categories['category_slug'];?>">
							</div>

							<?php								
								if($categories['category_image']){
									$cat_img=$categories['category_image'];
								}else{
									$cat_img='assets/img/service-placeholder.jpg';
								}														
							?>
                            <div class="form-group">
                                <label><?php echo(!empty($categories_lang['lg_admin_category_image']))?($categories_lang['lg_admin_category_image']) : 'Category Image';  ?></label>
                                <input class="form-control" type="file"  name="category_image" id="category_image">
                            </div>
                            <div class="form-group">
								<div class="avatar">
									<!-- <img class="avatar-img rounded" alt="" src="<?php echo base_url().$categories['category_image'];?>">
									 -->
									<img class="avatar-img rounded" alt="" src="<?php echo base_url().$cat_img;?>">
									
								</div>
                            </div>
                            <div class="form-group">
								<label><?php echo(!empty($categories_lang['lg_admin_is_featured']))?($categories_lang['lg_admin_is_featured']) : 'Is Featured?';  ?></label><br>
								 <label><input type="radio" name="is_featured" value="1" <?=(!empty($categories['is_featured'])&&$categories['is_featured']==1)?'checked':'';?>><?php echo(!empty($categories_lang['lg_admin_yes']))?($categories_lang['lg_admin_yes']) : 'Yes';  ?></label>
								 <label><input type="radio" name="is_featured" value="0" <?=($categories['is_featured']==0)?'checked':'';?>><?php echo(!empty($categories_lang['lg_admin_no']))?($categories_lang['lg_admin_no']) : 'No';  ?></label>
								 
							</div>
                            <div class="mt-4">
                                <button class="btn btn-primary" name="form_submit" value="submit" type="submit"><?php echo(!empty($categories_lang['lg_admin_save_changes']))?($categories_lang['lg_admin_save_changes']) : 'Save Changes';  ?></button>

								<a href="<?php echo $base_url; ?>categories"  class="btn btn-cancel"><?php echo(!empty($categories_lang['lg_admin_cancel']))?($categories_lang['lg_admin_cancel']) : 'Cancel';  ?></a>
                            </div>
                        </form>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>