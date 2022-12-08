<?php 
$sub_categories = $language_content;

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
							<h3 class="page-title"><?php echo(!empty($sub_categories['lg_admin_edit_sub_category']))?($sub_categories['lg_admin_edit_sub_category']) : 'Edit Sub Category';  ?></h3>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				
				<div class="card">
					<div class="card-body">
						<form id="update_subcategory" method="post" autocomplete="off" enctype="multipart/form-data">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
    
							<div class="form-group">
								<label><?php echo(!empty($sub_categories['lg_admin_category']))?($sub_categories['lg_admin_category']) : 'Category';  ?></label>
								<select class="form-control select" name="category" id="category">
									<option value=""><?php echo(!empty($sub_categories['lg_admin_select_category']))?($sub_categories['lg_admin_select_category']) : 'Select Category';  ?></option>
									<?php foreach ($categories as $rows) { 
										$cat_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
                                        $this->db->where('category_id', $rows['id']);
                                        $this->db->where('lang_type', $cat_lang);
                                        $cat_name = $this->db->get('categories_lang')->row();
									?>
									<option value="<?php echo $rows['id'];?>" <?php if($rows['id']==$subcategories['category']) echo 'selected';?>><?php echo $cat_name->category_name;?></option>
									<?php } ?>
								</select>
							</div>
							<?php foreach ($lang_test as $langval) { 
    							$this->db->where('subcategory_id', $subcategories['id']);
						        $this->db->where('lang_type', $langval->language_value);
						        $lang_subcategory = $this->db->get('subcategories_lang')->row();
							?>
							
							<?php								
							//image check
							if($subcategories['subcategory_image']){
									$subcat_img=$subcategories['subcategory_image'];
								}else{
									$subcat_img='assets/img/service-placeholder.jpg';
								}														
							?>
							<div class="form-group">
								<label><?php echo(!empty($sub_categories['lg_admin_subcategory_name']))?($sub_categories['lg_admin_subcategory_name']) : 'Sub Category Name';  ?>(<?php echo $langval->language; ?>)</label>
								<input class="form-control" type="text" value="<?php echo (!empty($lang_subcategory)) ? $lang_subcategory->subcategory_name : ""; ?>"  name="subcategory_name_<?php echo $langval->id; ?>" id="subcategory_name" required>
							</div>
							<?php }  ?>
							<input class="form-control" type="hidden" value="<?php echo $subcategories['id'];?>"  name="subcategory_id" id="subcategory_id">
							<div class="form-group">
                                <label><?php echo(!empty($subcategories['lg_admin_subcategory_slug']))?($subcategories['lg_admin_subcategory_slug']) : 'Sub Category Slug';  ?> (Ex:test-slug)</label>
                                <input class="form-control" type="text"  name="subcategory_slug" id="subcategory_slug" value="<?php echo $subcategories['subcategory_slug'];?>">
                            </div>
							<div class="form-group">
								<label><?php echo(!empty($sub_categories['lg_admin_subcategory_image']))?($sub_categories['lg_admin_subcategory_image']) : 'Sub Category Image';  ?></label>
								<input class="form-control" type="file"  name="subcategory_image" id="subcategory_image">
							</div>
							<div class="form-group">
								<div class="avatar">
									<!-- <img class="avatar-img rounded" alt="" src="<?php echo base_url().$subcategories['subcategory_image'];?>"> -->
									<img class="avatar-img rounded" alt="" src="<?php echo base_url().$subcat_img;?>">
								</div>
							</div>
							<div class="mt-4">
								<button class="btn btn-primary" name="form_submit" value="submit" type="submit"><?php echo(!empty($sub_categories['lg_admin_save_cahnges']))?($sub_categories['lg_admin_save_cahnges']) : 'Save Changes';  ?></button>
	
								<a href="<?php echo $base_url; ?>subcategories" class="btn btn-cancel"><?php echo(!empty($sub_categories['lg_admin_cancel']))?($sub_categories['lg_admin_cancel']) : 'Cancel';  ?></a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>