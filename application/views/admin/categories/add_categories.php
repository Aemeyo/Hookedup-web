<?php 
$categories = $language_content;

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
							<h3 class="page-title"><?php echo(!empty($categories['lg_admin_add_category']))?($categories['lg_admin_add_category']) : 'Add Category';  ?></h3>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				<div class="card">
					<div class="card-body">
						<form id="add_category" method="post" autocomplete="off" enctype="multipart/form-data">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
							<?php foreach ($lang_test as $langval) { ?>
							<div class="form-group">
								<label><?php echo(!empty($categories['lg_admin_category_name']))?($categories['lg_admin_category_name']) : 'Category Name';  ?>(<?php echo $langval->language; ?>)</label>
								<input class="form-control" type="text"  name="category_name_<?php echo $langval->id; ?>" id="category_name" required>
							</div>
							<?php }  ?>
							<div class="form-group">
								<label><?php echo(!empty($categories['lg_admin_category_slug']))?($categories['lg_admin_category_slug']) : 'Category Slug';  ?> (Ex:test-slug)</label>
								<input class="form-control" type="text"  name="category_slug" id="category_slug">
							</div>
							<div class="form-group">
								<label><?php echo(!empty($categories['lg_admin_category_image']))?($categories['lg_admin_category_image']) : 'Category Image';  ?></label>
								<input class="form-control" type="file"  name="category_image" id="category_image">
							</div>
							<div class="form-group">
								<label><?php echo(!empty($categories['lg_admin_is_featured']))?($categories['lg_admin_is_featured']) : 'Is Featured?';  ?></label><br>
								 <label><input type="radio" name="is_featured" value="1"> <?php echo(!empty($categories['lg_admin_yes']))?($categories['lg_admin_yes']) : 'Yes';  ?> </label>&nbsp
								 <label><input type="radio" name="is_featured" value="2" checked> <?php echo(!empty($categories['lg_admin_no']))?($categories['lg_admin_no']) : 'No';  ?></label>
							</div>
							<div class="mt-4">
								<button class="btn btn-primary " name="form_submit" value="submit" type="submit"><?php echo(!empty($categories['lg_admin_add_category']))?($categories['lg_admin_add_category']) : 'Add Category';  ?></button>

								<a href="<?php echo $base_url; ?>categories"  class="btn btn-cancel"><?php echo(!empty($categories['lg_admin_cancel']))?($categories['lg_admin_cancel']) : 'Cancel';  ?></a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

					