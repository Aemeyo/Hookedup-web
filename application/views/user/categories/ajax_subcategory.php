
			<?php
			$placholder_img = $this->db->get_where('system_settings', array('key'=>'service_placeholder_image'))->row()->value;
			//echo '<pre>'; print_r($category); exit;
			if(!empty($subcategory)) {
				foreach ($subcategory as $crows) {
					$category_name=strtolower($crows['subcategory_name']);
					if(!empty($crows['subcategory_image']) && (@getimagesize(base_url().$crows['subcategory_image']))){
						$subcategory_image = base_url().$crows['subcategory_image'];
					}else{
						$subcategory_image = ($placholder_img)? base_url().$placholder_img:base_url().'uploads/placeholder_img/1641376256_banner.jpg';
					} 

				?>
			<div class="col-lg-4 col-md-6">
				<a href="<?php echo base_url();?>search/maincategories/<?php echo str_replace(' ', '-', $category_name);?>">
					<div class="cate-widget">
						<img src="<?php echo $subcategory_image;?>" alt="">
						<div class="cate-title">
							<?php            
                                $output =  preg_replace('/[^A-Za-z0-9-]+/', '-', $crows['category_name']);

                                $cat_slug = str_replace(" ","-",trim($output));

                                $inputs['subcategory_slug'] = strtolower($cat_slug);

                                $cat_slug = ($crows['subcategory_slug'])?$crows['subcategory_slug']:$inputs['subcategory_slug'];


                                $data = array('subcategory_slug'=>$cat_slug);

                                if(empty($crows['subcategory_slug'])) {

                                    $this->db->update('categories', $data, array('id'=>$crows['id']));
                                }
                                $this->db->where('category_id', $crows['id']);
					            $this->db->where('lang_type', $this->session->userdata('user_select_language'));
					            $cat_name = $this->db->get('categories_lang')->row();
                                ?>
							<a href="<?php echo base_url();?>maincategories/<?php echo $crows['subcategory_slug'];?>"><h3><span><i class="fas fa-circle"></i> <?php echo $category_name;?></span></h3></a>
						</div>
						<div class="cate-count">
							<i class="fas fa-clone"></i> <?php echo $crows['category_count'];?>
						</div>
					</div>
				</a>
			</div>
			<?php } }
			else { ?>

				<div class="col-lg-12">
				<div class="category">
				<?php echo (!empty($user_language[$user_selected]['lg_no_categories_found'])) ? $user_language[$user_selected]['lg_no_categories_found'] : $default_language['en']['lg_no_categories_found'] ?>
				</div>
				</div>
				<?php
				} 

			echo $this->ajax_pagination->create_links();
			?>
			<script src="<?php echo base_url();?>assets/js/functions.js"></script>	