<?php 
$subcategories = $language_content;

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
							<h3 class="page-title"><?php echo(!empty($subcategories['lg_admin_add_sub_category']))?($subcategories['lg_admin_add_sub_category']) : 'Add Sub Category';  ?></h3>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
					
				<div class="card">
					<div class="card-body">
                        <form id="add_subcategory" method="post" autocomplete="off" enctype="multipart/form-data">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
    
                            <div class="form-group">
                                <label><?php echo(!empty($subcategories['lg_admin_category']))?($subcategories['lg_admin_category']) : 'Category';  ?></label>
                                <select class="form-control select" name="category" id="cat" required>
                                    <option value=""><?php echo(!empty($subcategories['lg_admin_select_category']))?($subcategories['lg_admin_select_category']) : 'Select Category';  ?></option>
                                    <?php foreach ($categories as $rows) { 
                                        $cat_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
                                        $this->db->where('category_id', $rows['id']);
                                        $this->db->where('lang_type', $cat_lang);
                                        $cat_name = $this->db->get('categories_lang')->row();

                                    ?>
                                    <option value="<?php echo $rows['id'];?>"><?php echo $cat_name->category_name;?></option>
                                   <?php } ?>
                                </select>
                            </div>
                            <?php foreach ($lang_test as $langval) { ?>
                            <div class="form-group">
                                <label><?php echo(!empty($subcategories['lg_admin_subcategory_name']))?($subcategories['lg_admin_subcategory_name']) : 'Sub Category Name';  ?>(<?php echo $langval->language; ?>)</label>
                                <input class="form-control" type="text"  name="subcategory_name_<?php echo $langval->id; ?>" id="subcategory_name" required>
                            </div>
                            <?php }  ?>
                            <div class="form-group">
                                <label><?php echo(!empty($subcategories['lg_admin_subcategory_slug']))?($subcategories['lg_admin_subcategory_slug']) : 'Sub Category Slug';  ?> (Ex:test-slug)</label>
                                <input class="form-control" type="text"  name="subcategory_slug" id="subcategory_slug" required>
                            </div>
                            <div class="form-group">
                                <label><?php echo(!empty($subcategories['lg_admin_subcategory_image']))?($subcategories['lg_admin_subcategory_image']) : 'Sub Category Image';  ?></label>
                                <input class="form-control" type="file"  name="subcategory_image" id="subcategory_image">
                            </div>
                            <div class="mt-4">
                                <button class="btn btn-primary" name="form_submit" value="submit" type="submit"><?php echo(!empty($subcategories['lg_admin_add_subcategoryy']))?($subcategories['lg_admin_add_subcategoryy']) : 'Add Subcategory';  ?></button>
                                     
								<a href="<?php echo $base_url; ?>subcategories" class="btn btn-cancel"><?php echo(!empty($subcategories['lg_admin_cancel']))?($subcategories['lg_admin_cancel']) : 'Cancel';  ?></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>