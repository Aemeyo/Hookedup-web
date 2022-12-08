<?php 
$admin_settings = $language_content;

$query = $this->db->query("select * from language WHERE status = '1'");
$lang_test = $query->result();

$row = $this->db->get('seo')->result_array();
?>
<div class="page-wrapper">
			<div class="content container-fluid">
			
				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col-12">
							<h3 class="page-title"><?php echo(!empty($admin_settings['lg_admin_seo_settings']))?($admin_settings['lg_admin_seo_settings']) : 'SEO Settings';  ?></h3>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				<form accept-charset="utf-8" id="seo_settings" action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
					<div class="row">
						<div class=" col-lg-6 col-sm-12 col-12">
							<div class="card">
								<div class="card-body">
									<?php 
										if (!empty($row)) {
											foreach ($row as $seo) { 
									?>	
									<?php 
										foreach ($lang_test as $langval) {
											if($langval->language_value ==  $seo['lang_type']) {
									?>
									<div class="form-group">
										<label><?php echo(!empty($admin_settings['lg_admin_meta_title']))?($admin_settings['lg_admin_meta_title']) : 'Meta Title';  ?>(<?php echo $langval->language; ?>) <span class="manidory">*</span></label>
										<input type="text" class="form-control" name="meta_title_<?php echo $langval->id; ?>" id="meta_title" value="<?php echo ($seo['meta_title'])?$seo['meta_title']:''; ?>">
									</div>
									<?php } } } } ?>
									<?php 
										if (!empty($row)) {
											foreach ($row as $seo) { 
									?>	
									<?php 
										foreach ($lang_test as $langval) {
											if($langval->language_value ==  $seo['lang_type']) {
									?>
									<div class="form-group">
										<label><?php echo(!empty($admin_settings['lg_admin_meta_keywords']))?($admin_settings['lg_admin_meta_keywords']) : 'Meta Keywords';  ?> (<?php echo $langval->language; ?>)<span class="manidory">*</span></label>
										<input type="text" data-role="tagsinput" class="input-tags form-control"  name="meta_keyword_<?php echo $langval->id; ?>"  id="services" value="<?php echo ($seo['meta_keyword'])?$seo['meta_keyword']:''; ?>">
									</div>
									<?php } } } } ?>
									<?php 
										if (!empty($row)) {
											foreach ($row as $seo) { 
									?>	
									<?php 
										foreach ($lang_test as $langval) {
											if($langval->language_value ==  $seo['lang_type']) {
									?>
									<div class="form-group">
										<label><?php echo(!empty($admin_settings['lg_admin_meta_description']))?($admin_settings['lg_admin_meta_description']) : 'Meta Description';  ?>(<?php echo $langval->language; ?>)  <span class="manidory">*</span></label>
										<textarea class="form-control"  name="meta_desc_<?php echo $langval->id; ?>" id="meta_desc" value="<?php if (isset($meta_desc ))  ?>"><?php echo ($seo['meta_desc'])?$seo['meta_desc']:''; ?></textarea>
									</div>
									<?php } } } } ?>
									<div class="form-groupbtn">
										<button name="form_submit" type="submit" class="btn btn-update me-2" value="true"><?php echo(!empty($admin_settings['lg_admin_update']))?($admin_settings['lg_admin_update']) : 'Update';  ?></button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>