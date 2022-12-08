
			<?php
			$placholder_img = $this->db->get_where('system_settings', array('key'=>'service_placeholder_image'))->row()->value;
			if(!empty($category)) {
				foreach ($category as $crows) {
					$category_name=strtolower($crows['category_name']);
					if(!empty($crows['category_image']) && (@getimagesize(base_url().$crows['category_image']))){
						$category_image = base_url().$crows['category_image'];
					}else{
						$category_image = ($placholder_img)? base_url().$placholder_img:base_url().'uploads/placeholder_img/1641376256_banner.jpg';
					} 

				?>
			<div class="col-lg-4 col-md-6">
				<a href="<?php echo base_url();?>search/<?php echo str_replace(' ', '-', $category_name);?>">
					<div class="cate-widget">
						<img src="<?php echo $category_image;?>" alt="">
						<div class="cate-title">
							<?php            
                                $output =  preg_replace('/[^A-Za-z0-9-]+/', '-', $crows['category_name']);

                                $cat_slug = str_replace(" ","-",trim($output));

                                $inputs['category_slug'] = strtolower($cat_slug);

                                $cat_slug = ($crows['category_slug'])?$crows['category_slug']:$inputs['category_slug'];


                                $data = array('category_slug'=>$cat_slug);

                                if(empty($crows['category_slug'])) {

                                    $this->db->update('categories', $data, array('id'=>$crows['id']));
                                }
                                $cat_lang = ($this->session->userdata('user_select_language'))?$this->session->userdata('user_select_language'):'en';
                                $this->db->where('category_id', $crows['id']);
					            $this->db->where('lang_type', $cat_lang);
					            $cat_name = $this->db->get('categories_lang')->row();
                                ?>
							<a href="<?php echo base_url();?>maincategories/<?php echo $crows['category_slug'];?>"><h3><span><i class="fas fa-circle"></i> <?php echo $cat_name->category_name;?></span></h3></a>
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