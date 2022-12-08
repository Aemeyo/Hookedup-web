<?php 
$bo1query = $this->db->query("select * from bgimage WHERE bgimg_for = 'bottom_image1'");
$bo1result = $bo1query->result_array();

$bo2query = $this->db->query("select * from bgimage WHERE bgimg_for = 'bottom_image2'");
$bo2result = $bo2query->result_array();

$bo3query = $this->db->query("select * from bgimage WHERE bgimg_for = 'bottom_image3'");
$bo3result = $bo3query->result_array();

$howquery = $this->db->query("select * from language_management WHERE lang_value = 'how it works'");
$howresult = $howquery->result_array();

$how_content= $this->db->query("select * from language_management WHERE lang_value = 'Aliquam lorem ante, dapibus in, viverra quis'");
$how_con_result = $how_content->result_array();
$admin_settings = $language_content;

$query = $this->db->query("select * from language WHERE status = '1'");
$lang_test = $query->result();
?>
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="row">
			<div class="col-lg-8 m-auto">
				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col-12">
							<h3 class="page-title"><?php echo(!empty($admin_settings['lg_admin_home_page']))?($admin_settings['lg_admin_home_page']) : 'Home Page';  ?></h3>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				
				<div class="row">
					<div class=" col-lg-12 col-sm-12 col-12">
						<form class="form-horizontal" id="banner_settings" action="<?php echo base_url('admin/settings/bannersettings'); ?>"  method="POST" enctype="multipart/form-data" >
							 <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<div class="card">
							<?php 
								if (!empty($list)) {
								foreach ($list as $item) {
							?>
							<div class="card-header">
								<div class="card-heads">
									<h4 class="card-title"><?php echo(!empty($admin_settings['lg_admin_banner_settings']))?($admin_settings['lg_admin_banner_settings']) : 'Banner Settings';  ?></h4>
									<div>
										<div class="status-toggle">
											<input  id="banner_showhide" class="check" type="checkbox" name="banner_showhide"<?=($item['banner_settings']==1)?'checked':'';?>>
		                                    <label for="banner_showhide" class="checktoggle">checkbox</label>
                                		</div>
									</div>
								</div>
							</div>
							<?php } ?>
							<div class="card-body">
							<?php 
								if (!empty($lang_test)) {
									foreach ($lang_test as $langval) { 
										$items = $this->db->get_where('home_settings', array('modules' => 'banner', 'lang_type' => $langval->language_value))->result_array(); ?>
								
										<input type="hidden" name="id[]" class="form-control" value="<?php echo $items[0]['id']; ?>">
										<div class="form-group">
											<label><?php echo(!empty($admin_settings['lg_admin_title']))?($admin_settings['lg_admin_title']) : 'Title';  ?>(<?php echo $langval->language; ?>)</label>
											<input type="text" name="banner_content_<?php echo $langval->id; ?>" class="form-control" value="<?php echo ucwords($items[0]['title']); ?>" required>
										</div>

										<div class="form-group">
											<label><?php echo(!empty($admin_settings['lg_admin_content']))?($admin_settings['lg_admin_content']) : 'Content';  ?>(<?php echo $langval->language; ?>)</label>
											<input type="text" name="banner_sub_content_<?php echo $langval->id; ?>" class="form-control" value="<?php echo ucwords($items[0]['content']); ?>" required>
										</div>
							<?php   } 
								} ?>

								<?php  foreach ($list as $item) { ?>
									<div class="form-group">
										<p class="settings-label"><?php echo(!empty($admin_settings['lg_admin_bannerimage']))?($admin_settings['lg_admin_bannerimage']) : 'Banner image';  ?></p>
										<div class="form-group">
											<input class="form-control" type="file"  name="upload_image" id="upload_image">
										</div>
										<?php if(!empty($item['upload_image'])) { ?>
											<div class="upload-images d-block">
												<img class="thumbnail m-b-0" src="<?php echo base_url() . $item['upload_image']; ?>">
												<a href="javascript:void(0);" class="btn-icon logo-hide-btn">
													<i class="fa fa-times"></i>
												</a>
												<h6><?php echo ucwords($item['upload_image']); ?></h6>
											</div>
										<?php } else { ?>
												<div class="upload-images d-block">
												<img class="thumbnail m-b-0" src="<?php echo base_url() . 'assets/img/banner.jpg'; ?>">
											</div>
										<?php } ?>
									</div>

									<div class="form-group">
										<div class="row">
											<div class="col-lg-5 col-12">
												<div class="card-heads mb-3">
												<h4 class="card-title f-14"><?php echo(!empty($admin_settings['lg_admin_main_search']))?($admin_settings['lg_admin_main_search']) : 'Main Search';  ?> </h4>
												<div class="status-toggle mr-3">
				                                    <input  id="main_showhide" class="check" type="checkbox" name="main_showhide"<?=($item['main_search']==1)?'checked':'';?>>
				                                    <label for="main_showhide" class="checktoggle">checkbox</label>
	                                			</div>
												</div>
												<div class="card-heads mb-3">
													<h4 class="card-title f-14"><?php echo(!empty($admin_settings['lg_admin_popular_searches']))?($admin_settings['lg_admin_popular_searches']) : 'Popular Searches';  ?></h4>
													<div class="status-toggle mr-3">
														 <input  id="popular_showhide" class="check" type="checkbox" name="popular_showhide"<?=($item['popular_search']==1)?'checked':'';?>>
				                                    <label for="popular_showhide" class="checktoggle">checkbox</label>
	                                			</div>
												</div>
											</div>
										</div>
									</div>
								<?php 
									if (!empty($lang_test)) {
											foreach ($lang_test as $langval) { 
												$popularSearch = $this->db->get_where('home_settings', array('modules' => 'popular_search', 'lang_type' => $langval->language_value))->result_array(); ?>
												<div class="form-group">
													<label><?php echo(!empty($admin_settings['lg_admin_popular_searches_labelname']))?($admin_settings['lg_admin_popular_searches_labelname']) : 'Popular Searches Label Name';  ?>(<?php echo $langval->language; ?>)</label>
													<input type="text" name="popular_label_<?php echo $langval->id; ?>" class="form-control" value="<?php echo ucwords($popularSearch[0]['content']); ?>" required>
												</div>
									<?php  }  
									} ?>
									<div class="form-groupbtn">
										<button name="form_submit" type="submit" class="btn btn-primary" value="true"><?php echo(!empty($admin_settings['lg_admin_update']))?($admin_settings['lg_admin_update']) : 'Update';  ?></button>
										<a href="<?php echo base_url(); ?>admin/pages"  class="btn btn-cancel"><?php echo(!empty($admin_settings['lg_admin_back']))?($admin_settings['lg_admin_back']) : 'Back';  ?></a>
									</div>
					<?php }
						}
							 ?>
							</div>
						</div>
					</form>


					<form class="form-horizontal" id="featured_categories" action="<?php echo base_url('admin/settings/featured_categories'); ?>"  method="POST" enctype="multipart/form-data" >
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<div class="card">
							<div class="card-header">
								<div class="card-heads">
									<h4 class="card-title"><?php echo(!empty($admin_settings['lg_admin_featured_categories']))?($admin_settings['lg_admin_featured_categories']) : 'Featured Categories';  ?></h4>
									<div>
										<div class="status-toggle">
		                                    <input id="featured_showhide" class="check" type="checkbox" name="featured_showhide"<?=settingValue('featured_showhide')?'checked':'';?>>
		                                    <label for="featured_showhide" class="checktoggle">checkbox</label>
                                		</div>
									</div>
								</div>
							</div>
							<div class="card-body">
								<?php if (!empty($lang_test)) {
										foreach ($lang_test as $langval) { 
											$feature = $this->db->get_where('home_settings', array('modules' => 'featured', 'lang_type' => $langval->language_value))->result_array(); ?>
											<input type="hidden" name="id[]" class="form-control" value="<?php echo $feature[0]['id']; ?>">
											<div class="form-group">
												<label><?php echo(!empty($admin_settings['lg_admin_title']))?($admin_settings['lg_admin_title']) : 'Title';  ?>(<?php echo $langval->language; ?>)</label>
												<input type="text" name="featured_title_<?php echo $langval->id; ?>" class="form-control" value="<?php echo ucwords($feature[0]['title']); ?>" required>
											</div>

											<div class="form-group">
												<label><?php echo(!empty($admin_settings['lg_admin_content']))?($admin_settings['lg_admin_content']) : 'Content';  ?>(<?php echo $langval->language; ?>)</label>
												<input type="text" name="featured_content_<?php echo $langval->id; ?>" class="form-control" value="<?php echo ucwords($feature[0]['content']); ?>"required>
											</div>
								  <?php } 
									} ?>

								<?php $count = explode(',', settingValue('featured_categories')); ?>
								<div class="form-group">
									<label class="form-head mb-0"><?php echo(!empty($admin_settings['lg_admin_categories']))?($admin_settings['lg_admin_categories']) : 'Categories';  ?></label>

									<!-- <span>( Max 6 only )</span> -->
									<select class="form-control select selected_featured_categories"  name="selected_categories[]" id="selected_featured_categories" multiple="multiple">
									<?php foreach ($featured as $rows) { 
											$selected_featured = (settingValue('featured_categories'))?explode(',', settingValue('featured_categories')):'';
											if(!empty($selected_featured)) { ?>
												<option value="<?php echo $rows['id']; ?>" <?php if(in_array($rows['id'], $selected_featured)) { echo 'selected'; } ?>><?php echo $rows['category_name']; ?>
												</option>
												<?php }
												else { ?>
												<option value="<?php echo $rows['id']; ?>"><?php echo $rows['category_name']; ?></option>
											<?php } ?>							
									<?php } ?>
								</select>
								<!-- <span class="categories_error" id="categories_error" style="color: red; display:none">Max only 6 categories</span> -->
								<input type="hidden" name="selected_categories1" id="selected_categories1" value="<?php echo settingValue('featured_categories'); ?>">
								</div>
								<div class="form-groupbtn">
									<button name="form_submit" type="submit" class="btn btn-primary" value="true"><?php echo(!empty($admin_settings['lg_admin_update']))?($admin_settings['lg_admin_update']) : 'Update';  ?></button>
									<a href="<?php echo base_url(); ?>admin/pages"  class="btn btn-cancel"><?php echo(!empty($admin_settings['lg_admin_back']))?($admin_settings['lg_admin_back']) : 'Back';  ?></a>
								</div>
							</div>
						</div>
					</form>

					<form class="form-horizontal" id="newest_services" action="<?php echo base_url('admin/settings/newestservices'); ?>"  method="POST" enctype="multipart/form-data" >
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<div class="card">
							<div class="card-header">
								<div class="card-heads">
									<h4 class="card-title"><?php echo(!empty($admin_settings['lg_admin_newest_services']))?($admin_settings['lg_admin_newest_services']) : 'Newest Services';  ?></h4>
									<div>
										<div class="status-toggle">
		                                    <input  id="newest_ser_showhide" class="check" type="checkbox" name="newest_ser_showhide"<?=settingValue('newest_ser_showhide')?'checked':'';?>>
		                                    <label for="newest_ser_showhide" class="checktoggle">checkbox</label>
                                		</div>
									</div>
								</div>
							</div>
							<div class="card-body">

								<?php 
								if (!empty($lang_test)) { 
									foreach ($lang_test as $langval) { 
										$lat = $this->db->get_where('home_settings', array('modules' => 'latest', 'lang_type' => $langval->language_value))->result_array();
										?>
										<input type="hidden" name="id[]" class="form-control" value="<?php echo $lat[0]['id']; ?>">
										<div class="form-group">
											<label><?php echo(!empty($admin_settings['lg_admin_title']))?($admin_settings['lg_admin_title']) : 'Title';  ?>(<?php echo $langval->language; ?>)</label>
											<input type="text" name="new_title_services_<?php echo $langval->id; ?>" class="form-control" value="<?php echo ucwords($lat[0]['title']); ?>" required>
										</div>

										<div class="form-group">
											<label><?php echo(!empty($admin_settings['lg_admin_content']))?($admin_settings['lg_admin_content']) : 'Content';  ?>(<?php echo $langval->language; ?>)</label>
											<input type="text" name="new_content_services_<?php echo $langval->id; ?>" class="form-control" value="<?php echo ucwords($lat[0]['content']); ?>" required>
										</div>
								<?php } } ?>

								<div class="form-group">
									<label class="form-head mb-0"><?php echo(!empty($admin_settings['lg_admin_number_service']))?($admin_settings['lg_admin_number_service']) : 'Number of service';  ?><span>( Min 6 to Max 20 only )</span></label>
									<input type="number" min="6" max="20" class="form-control numeric" name="new_services_count" value="<?php echo settingValue('new_services_count'); ?>">
									<span class="error" style="color: Red; display: none">* Input digits (0 - 9)</span>
								</div>
								<div class="form-groupbtn">
									<button name="form_submit" type="submit" class="btn btn-primary" value="true"><?php echo(!empty($admin_settings['lg_admin_update']))?($admin_settings['lg_admin_update']) : 'Update';  ?></button>
									<a href="<?php echo base_url(); ?>admin/pages"  class="btn btn-cancel"><?php echo(!empty($admin_settings['lg_admin_back']))?($admin_settings['lg_admin_back']) : 'Back';  ?></a>
								</div>
							</div>
						</div>
						</form>

						<form class="form-horizontal" id="popular_services" action="<?php echo base_url('admin/settings/popularservices'); ?>"  method="POST" enctype="multipart/form-data" >
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<div class="card">
							<div class="card-header">
								<div class="card-heads">
									<h4 class="card-title"><?php echo(!empty($admin_settings['lg_admin_popular_services']))?($admin_settings['lg_admin_popular_services']) : 'Popular Services';  ?></h4>
									<div>
										<div class="status-toggle">
		                                    <input  id="popular_ser_showhide" class="check" type="checkbox" name="popular_ser_showhide"<?=settingValue('popular_ser_showhide')?'checked':'';?>>
		                                    <label for="popular_ser_showhide" class="checktoggle">checkbox</label>
                                		</div>
									</div>
								</div>
							</div>
							<div class="card-body">

								<?php 
								if (!empty($lang_test)) {
									foreach ($lang_test as $langval) {
										$pop = $this->db->get_where('home_settings', array('modules' => 'popular', 'lang_type' => $langval->language_value))->result_array(); ?>
										<input type="hidden" name="id[]" class="form-control" value="<?php echo $pop[0]['id']; ?>">
										<div class="form-group">
											<label><?php echo(!empty($admin_settings['lg_admin_title']))?($admin_settings['lg_admin_title']) : 'Title';  ?>(<?php echo $langval->language; ?>)</label>
											<input type="text" name="title_services_<?php echo $langval->id; ?>" class="form-control" value="<?php echo ucwords($pop[0]['title']); ?>" required>
										</div>
										<div class="form-group">
											<label><?php echo(!empty($admin_settings['lg_admin_content']))?($admin_settings['lg_admin_content']) : 'Content';  ?>(<?php echo $langval->language; ?>)</label>
											<input type="text" name="content_services_<?php echo $langval->id; ?>" class="form-control" value="<?php echo ucwords($pop[0]['content']); ?>" required>
										</div>

								<?php } } ?>

								<div class="form-group">
									<label class="form-head mb-0"><?php echo(!empty($admin_settings['lg_admin_number_service']))?($admin_settings['lg_admin_number_service']) : 'Number of service';  ?><span>( Min 6 to Max 20 only )</span></label>
									<input type="number" min="6" max="20" class="form-control numeric" name="services_count" value="<?php echo settingValue('services_count'); ?>">
									<span class="error" style="color: Red; display: none">* Input digits (0 - 9)</span>
								</div>
								<div class="form-groupbtn">
									<button name="form_submit" type="submit" class="btn btn-primary" value="true"><?php echo(!empty($admin_settings['lg_admin_update']))?($admin_settings['lg_admin_update']) : 'Update';  ?></button>
									<a href="<?php echo base_url(); ?>admin/pages"  class="btn btn-cancel"><?php echo(!empty($admin_settings['lg_admin_back']))?($admin_settings['lg_admin_back']) : 'Back';  ?></a>
								</div>
							</div>
						</div>
						</form>

						<form class="form-horizontal" id="top_rating_services" action="<?php echo base_url('admin/settings/topratingservices'); ?>"  method="POST" enctype="multipart/form-data" >
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<div class="card">
							<div class="card-header">
								<div class="card-heads">
									<h4 class="card-title"><?php echo(!empty($admin_settings['lg_admin_featured_services']))?($admin_settings['lg_admin_featured_services']) : 'Featured Services';  ?></h4>
									<div>
										<div class="status-toggle">
		                                    <input  id="top_rating_showhide" class="check" type="checkbox" name="top_rating_showhide"<?=settingValue('top_rating_showhide')?'checked':'';?>>
		                                    <label for="top_rating_showhide" class="checktoggle">checkbox</label>
                                		</div>
									</div>
								</div>
							</div>
							<div class="card-body">

								<?php 
								if (!empty($lang_test)) {
									foreach ($lang_test as $langval) { 
										$fea_ser = $this->db->get_where('home_settings', array('modules' => 'featured_services', 'lang_type' => $langval->language_value))->result_array();
										?>
										<input type="hidden" name="id[]" class="form-control" value="<?php echo $fea_ser['id']; ?>">
										<div class="form-group">
											<label><?php echo(!empty($admin_settings['lg_admin_title']))?($admin_settings['lg_admin_title']) : 'Title';  ?>(<?php echo $langval->language; ?>)</label>
											<input type="text" name="rating_title_services_<?php echo $langval->id; ?>" class="form-control" value="<?php echo ucwords($fea_ser[0]['title']); ?>" required>
										</div>

										<div class="form-group">
											<label><?php echo(!empty($admin_settings['lg_admin_content']))?($admin_settings['lg_admin_content']) : 'Content';  ?>(<?php echo $langval->language; ?>)</label>
											<input type="text" name="rating_content_services_<?php echo $langval->id; ?>" class="form-control" value="<?php echo ucwords($fea_ser[0]['content']); ?>" required>
										</div>
										-------------------------------------------------------------------------
								<?php } 
								} ?>

								<div class="form-group">
									<label class="form-head mb-0"><?php echo(!empty($admin_settings['lg_admin_number_service']))?($admin_settings['lg_admin_number_service']) : 'Number of service';  ?><span>( Min 6 to Max 20 only )</span></label>
									<input type="number" min="6" max="20" class="form-control numeric" name="rating_services_count" value="<?php echo settingValue('rating_services_count'); ?>">
									<span class="error" style="color: Red; display: none">* Input digits (0 - 9)</span>
								</div>
								<div class="form-groupbtn">
									<button name="form_submit" type="submit" class="btn btn-primary" value="true"><?php echo(!empty($admin_settings['lg_admin_update']))?($admin_settings['lg_admin_update']) : 'Update';  ?></button>
									<a href="<?php echo base_url(); ?>admin/pages"  class="btn btn-cancel"><?php echo(!empty($admin_settings['lg_admin_back']))?($admin_settings['lg_admin_back']) : 'Back';  ?></a>
								</div>
							</div>
						</div>
						</form>


						<form class="form-horizontal" id="how_it_works" action="<?php echo base_url('admin/settings/howitworks'); ?>"  method="POST" enctype="multipart/form-data" >
							 <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<div class="card">
							<div class="card-header">
								<div class="card-heads">
									<h4 class="card-title"><?php echo(!empty($admin_settings['lg_admin_how_works']))?($admin_settings['lg_admin_how_works']) : 'How It Works';  ?></h4>
									<div>
										<div class="status-toggle">
		                                    <input  id="how_showhide" class="check" type="checkbox" name="how_showhide"<?=settingValue('how_showhide')?'checked':'';?>>
		                                    <label for="how_showhide" class="checktoggle">checkbox</label>
                                		</div>
									</div>
								</div>
							</div>
							<div class="card-body">

								<?php 
								if (!empty($lang_test)) {
									foreach ($lang_test as $langval) {
										$how_works = $this->db->get_where('home_settings', array('modules' => 'how_it_works', 'lang_type' => $langval->language_value))->result_array(); ?>
										<input type="hidden" name="id[]" class="form-control" value="<?php echo $how_works[0]['id']; ?>">
										<div class="form-group">
											<label><?php echo(!empty($admin_settings['lg_admin_title']))?($admin_settings['lg_admin_title']) : 'Title';  ?>(<?php echo $langval->language; ?>)</label>
											<input type="text" name="how_title_<?php echo $langval->id; ?>" class="form-control" value="<?php echo ucwords($how_works[0]['title']); ?>" required>
										</div>
										<div class="form-group">
											<label><?php echo(!empty($admin_settings['lg_admin_content']))?($admin_settings['lg_admin_content']) : 'Content';  ?>(<?php echo $langval->language; ?>)</label>
											<input type="text" name="how_content_<?php echo $langval->id; ?>" class="form-control" value="<?php echo ucwords($how_works[0]['content']); ?>" required>
										</div>
								<?php } } ?>
								
								<div class="form-group">
									<h6 class="form-heads mb-0"><?php echo(!empty($admin_settings['lg_admin_step1']))?($admin_settings['lg_admin_step1']) : 'Step 1';  ?></h6>
								</div>

								<?php 
								if (!empty($lang_test)) {
									foreach ($lang_test as $langval) {
										$step1 = $this->db->get_where('home_settings', array('modules' => 'step_1', 'lang_type' => $langval->language_value))->result_array(); ?>
									<input type="hidden" name="id[]" class="form-control" value="<?php echo $step1[0]['id']; ?>">
									<div class="form-group">
										<label><?php echo(!empty($admin_settings['lg_admin_title']))?($admin_settings['lg_admin_title']) : 'Title';  ?>(<?php echo $langval->language; ?>)</label>
										<input type="text" name="how_title_1_<?php echo $langval->id; ?>" class="form-control" value="<?php echo ucwords($step1[0]['title']); ?>" required>
									</div>
									<div class="form-group">
										<label><?php echo(!empty($admin_settings['lg_admin_content']))?($admin_settings['lg_admin_content']) : 'Content';  ?>(<?php echo $langval->language; ?>)</label>
										<input type="text" name="how_content_1_<?php echo $langval->id; ?>" class="form-control" value="<?php echo ucwords($step1[0]['content']); ?>" required>
									</div>
								<?php } } ?>
								
									<div class="form-group">
										<p class="settings-label"><?php echo(!empty($admin_settings['lg_admin_image']))?($admin_settings['lg_admin_image']) : 'Image';  ?></p>
										 <input class="form-control" type="file"  name="how_title_img_1" id="upload_image">
										 <?php if(!empty(settingValue('how_title_img_1'))) { ?>
											<div class="upload-images ">
												<img class="thumbnail m-b-0" src="<?php echo base_url() . settingValue('how_title_img_1'); ?>">
											</div>
										<?php } else { ?>
											<img class="thumbnail m-b-0" src="<?php echo base_url() .'assets/img/icon-1.png'; ?>">
									<?php } ?>
									</div>
								
								<div class="form-group">
									<h6 class="form-heads mb-0"><?php echo(!empty($admin_settings['lg_admin_step2']))?($admin_settings['lg_admin_step2']) : 'Step 2';  ?></h6>
								</div>

								<?php 
								if (!empty($lang_test)) {
									foreach ($lang_test as $langval) { 
										$step2 = $this->db->get_where('home_settings', array('modules' => 'step_2', 'lang_type' => $langval->language_value))->result_array(); ?>
										<input type="hidden" name="id[]" class="form-control" value="<?php echo $step2[0]['id']; ?>">
										<div class="form-group">
											<label><?php echo(!empty($admin_settings['lg_admin_title']))?($admin_settings['lg_admin_title']) : 'Title';  ?>(<?php echo $langval->language; ?>)</label>
											<input type="text" name="how_title_2_<?php echo $langval->id; ?>" class="form-control" value="<?php echo ucwords($step2[0]['title']); ?>" required>
										</div>
										<div class="form-group">
											<label><?php echo(!empty($admin_settings['lg_admin_content']))?($admin_settings['lg_admin_content']) : 'Content';  ?>(<?php echo $langval->language; ?>)</label>
											<input type="text" name="how_content_2_<?php echo $langval->id; ?>" class="form-control" value="<?php echo ucwords($step2[0]['content']); ?>" required>
										</div>
								<?php } 
								} ?>

								<div class="form-group">
									<p class="settings-label"><?php echo(!empty($admin_settings['lg_admin_image']))?($admin_settings['lg_admin_image']) : 'Image';  ?></p>
									 <input class="form-control" type="file"  name="how_title_img_2" id="upload_image">
									 <?php if(!empty(settingValue('how_title_img_2'))) { ?>
										<div class="upload-images ">
											<img class="thumbnail m-b-0" src="<?php echo base_url() . settingValue('how_title_img_2'); ?>">
										</div>
									<?php } else { ?>
											<img class="thumbnail m-b-0" src="<?php echo base_url() .'assets/img/icon-2.png'; ?>">
									<?php } ?>
								</div>
								<div class="form-group">
									<h6 class="form-heads mb-0"><?php echo(!empty($admin_settings['lg_admin_step3']))?($admin_settings['lg_admin_step3']) : 'Step 3';  ?></h6>
								</div>

								<?php 
								if (!empty($lang_test)) {
									foreach ($lang_test as $langval) {
										$step3 = $this->db->get_where('home_settings', array('modules' => 'step_3', 'lang_type' => $langval->language_value))->result_array(); ?>
										<input type="hidden" name="id[]" class="form-control" value="<?php echo $step3[0]['id']; ?>">
										<div class="form-group">
											<label><?php echo(!empty($admin_settings['lg_admin_title']))?($admin_settings['lg_admin_title']) : 'Title';  ?>(<?php echo $langval->language; ?>)</label>
											<input type="text" name="how_title_3_<?php echo $langval->id; ?>" class="form-control" value="<?php echo ucwords($step3[0]['title']); ?>" required>
										</div>
										<div class="form-group">
											<label><?php echo(!empty($admin_settings['lg_admin_content']))?($admin_settings['lg_admin_content']) : 'Content';  ?>(<?php echo $langval->language; ?>)</label>
											<input type="text" name="how_content_3_<?php echo $langval->id; ?>" class="form-control" value="<?php echo ucwords($step3[0]['content']); ?>" required>
										</div>
								<?php } } ?>

								<div class="form-group">
									<p class="settings-label"><?php echo(!empty($admin_settings['lg_admin_image']))?($admin_settings['lg_admin_image']) : 'Image';  ?></p>
									 <input class="form-control" type="file"  name="how_title_img_3" id="upload_image">
									<?php if(!empty(settingValue('how_title_img_3'))) { ?>
									<div class="upload-images ">
										<img class="thumbnail m-b-0" src="<?php echo (base_url() . settingValue('how_title_img_3'))?base_url() . settingValue('how_title_img_3'):base_url() .'assets/img/icon-3.png'; ?>">
									</div>
								<?php } else { ?>
									<div class="upload-images ">
										<img class="thumbnail m-b-0" src="<?php echo base_url() .'assets/img/icon-3.png'; ?>">
									</div>
								<?php } ?>
								</div>
								<div class="form-groupbtn">
									<button name="form_submit" type="submit" class="btn btn-primary" value="true"><?php echo(!empty($admin_settings['lg_admin_update']))?($admin_settings['lg_admin_update']) : 'Update';  ?></button>
									<a href="<?php echo base_url(); ?>admin/pages"  class="btn btn-cancel"><?php echo(!empty($admin_settings['lg_admin_back']))?($admin_settings['lg_admin_back']) : 'Back';  ?></a>
								</div>
							</div>
						</div>
					</form>
					<form class="form-horizontal" id="blog_sec" action="<?php echo base_url('admin/settings/blog_sec'); ?>" method="POST" enctype="multipart/form-data" >
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
						<div class="card">
							<div class="card-header">
								<div class="card-heads">
									<h4 class="card-title"><?php echo(!empty($admin_settings['lg_admin_blog_section']))?($admin_settings['lg_admin_blog_section']) : 'Blog Section';  ?></h4>
									<div>
										<div class="status-toggle">
		                                    <input  id="blog_showhide" class="check" type="checkbox" name="blog_showhide"<?=settingValue('blog_showhide')?'checked':'';?>>
		                                    <label for="blog_showhide" class="checktoggle">checkbox</label>
                                		</div>
									</div>
								</div>
							</div>
							<div class="card-body">

								<?php 
								if (!empty($lang_test)) {
									foreach ($lang_test as $langval) {
										$blog = $this->db->get_where('home_settings', array('modules' => 'step_3', 'lang_type' => $langval->language_value))->result_array(); ?>
										<input type="hidden" name="id[]" class="form-control" value="<?php echo $blog[0]['id']; ?>">
										<div class="form-group">
											<label><?php echo(!empty($admin_settings['lg_admin_title']))?($admin_settings['lg_admin_title']) : 'Title';  ?>(<?php echo $langval->language; ?>)</label>
											<input type="text" name="blog_title_<?php echo $langval->id; ?>" class="form-control" value="<?php echo ucwords($blog[0]['title']); ?>" required>
										</div>
										<div class="form-group">
											<label><?php echo(!empty($admin_settings['lg_admin_content']))?($admin_settings['lg_admin_content']) : 'Content';  ?>(<?php echo $langval->language; ?>)</label>
											<input type="text" name="blog_content_<?php echo $langval->id; ?>" class="form-control" value="<?php echo ucwords($blog[0]['content']); ?>" required>
										</div>
								<?php } } ?>

								<div class="form-groupbtn">
									<button name="form_submit" type="submit" class="btn btn-primary" value="true"><?php echo(!empty($admin_settings['lg_admin_update']))?($admin_settings['lg_admin_update']) : 'Update';  ?></button>
									<a href="<?php echo base_url(); ?>admin/pages"  class="btn btn-cancel"><?php echo(!empty($admin_settings['lg_admin_back']))?($admin_settings['lg_admin_back']) : 'Back';  ?></a>
								</div>
							</div>
						</div>
					</form>
					<form class="form-horizontal" id="download_sec" action="<?php echo base_url('admin/settings/download_sec'); ?>" method="POST" enctype="multipart/form-data" >
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
						<div class="card">
							<div class="card-header">
								<div class="card-heads">
									<h4 class="card-title"><?php echo(!empty($admin_settings['lg_admin_download_section']))?($admin_settings['lg_admin_download_section']) : 'Download Section';  ?></h4>
									<div>
										<div class="status-toggle">
		                                    <input  id="download_showhide" class="check" type="checkbox" name="download_showhide"<?=settingValue('download_showhide')?'checked':'';?>>
		                                    <label for="download_showhide" class="checktoggle">checkbox</label>
                                		</div>
									</div>
								</div>
							</div>
							<div class="card-body">

								<?php 
								/* if (!empty($lang_test)) {
									foreach ($lang_test as $langval) {
										$down = $this->db->get_where('home_settings', array('modules' => 'download_sec', 'lang_type' => $langval->language_value))->result_array(); ?>
										<input type="hidden" name="id[]" class="form-control" value="<?php echo $down[0]['id']; ?>">
										<div class="form-group">
											<label><?php echo(!empty($admin_settings['lg_admin_title']))?($admin_settings['lg_admin_title']) : 'Title';  ?>(<?php echo $langval->language; ?>)</label>
											<input type="text" name="download_title_<?php echo $langval->id; ?>" class="form-control" value="<?php echo ucwords($down[0]['title']); ?>" required>
										</div>
										<div class="form-group">
											<label><?php echo(!empty($admin_settings['lg_admin_content']))?($admin_settings['lg_admin_content']) : 'Content';  ?>(<?php echo $langval->language; ?>)</label>
											<input type="text" name="download_content_<?php echo $langval->id; ?>" class="form-control" value="<?php echo ucwords($down[0]['content']); ?>" required>
										</div>
								<?php } 
								} */ ?>

								<div class="row">
									<div class="col-lg-6 col-12">
										<div class="form-group">
											<p class="settings-label"><?php echo(!empty($admin_settings['lg_admin_app_store']))?($admin_settings['lg_admin_app_store']) : 'App Store (iOs)';  ?></p>
												<input class="form-control" type="file"  name="app_store_img" id="upload_image">
											<?php if(!empty(settingValue('app_store_img'))) { ?>
											<div class="upload-images ">
												<img class="thumbnail m-b-0" src="<?php echo base_url() . settingValue('app_store_img'); ?>">
												<a href="javascript:void(0);" class="btn-icon logo-hide-btn">
													<i class="fa fa-times"></i>
												</a>
											</div>
										<?php } else { ?>
											<img class="thumbnail m-b-0" src="<?php echo base_url() . 'assets/img/gp-02.jpg'; ?>">
										<?php } ?>
										</div>
									</div>
									<div class="col-lg-6 col-12">
										<div class="form-group">
											<label><?php echo(!empty($admin_settings['lg_admin_app_link']))?($admin_settings['lg_admin_app_link']) : 'App Link';  ?></label>
											<input type="text" class="form-control" name="play_store_link"  value="<?php echo settingValue('play_store_link'); ?>">
										</div>
									</div>
									
								</div>
								<div class="row">
									<div class="col-lg-6 col-12">
										<div class="form-group">
											<p class="settings-label"><?php echo(!empty($admin_settings['lg_admin_google_play_store']))?($admin_settings['lg_admin_google_play_store']) : 'Google Play Store';  ?></p>
												<input class="form-control" type="file"  name="play_store_img" id="upload_image">
											<?php if(!empty(settingValue('play_store_img'))) { ?>
											<div class="upload-images ">
												<img class="thumbnail m-b-0" src="<?php echo base_url() . settingValue('play_store_img'); ?>">
												<a href="javascript:void(0);" class="btn-icon logo-hide-btn">
													<i class="fa fa-times"></i>
												</a>
											</div>
											<?php } else { ?>
													<img class="thumbnail m-b-0" src="<?php echo base_url() . 'assets/img/gp-01.jpg'; ?>">
											<?php } ?>
										</div>
									</div>
									<div class="col-lg-6 col-12">
										<div class="form-group">
											<label><?php echo(!empty($admin_settings['lg_admin_app_link']))?($admin_settings['lg_admin_app_link']) : 'App Link';  ?></label>
											<input type="text" class="form-control" name="app_store_link"  value="<?php echo settingValue('app_store_link'); ?>">
										</div>
									</div>
								</div>
								<div class="form-groupbtn">
									<button name="form_submit" type="submit" class="btn btn-primary" value="true"><?php echo(!empty($admin_settings['lg_admin_update']))?($admin_settings['lg_admin_update']) : 'Update';  ?></button>
									<a href="<?php echo base_url(); ?>admin/pages"  class="btn btn-cancel"><?php echo(!empty($admin_settings['lg_admin_back']))?($admin_settings['lg_admin_back']) : 'Back';  ?></a>
								</div>
							</div>
						</div>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>