<div class="breadcrumb-bar">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="breadcrumb-title">
					<?php  
						$cat_lang = ($this->session->userdata('user_select_language'))?$this->session->userdata('user_select_language'):'en';
						$this->db->where('category_id', $cat_name->id);
			            $this->db->where('lang_type', $cat_lang);
			            $cat_names = $this->db->get('categories_lang')->row_array();
					?>
					<h2><?php echo $cat_names['category_name'];?> - <?php echo (!empty($user_language[$user_selected]['lg_Sub_Category'])) ? $user_language[$user_selected]['lg_Sub_Category'] : $default_language['en']['lg_Sub_Category']; ?> </h2>
				</div>
			</div>
			<div class="col-auto float-right ml-auto breadcrumb-menu">
				<nav aria-label="breadcrumb" class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url();?>"><?php echo (!empty($user_language[$user_selected]['lg_home'])) ? $user_language[$user_selected]['lg_home'] : $default_language['en']['lg_home']; ?></a></li>
						<li class="breadcrumb-item active" aria-current="page"><?php echo (!empty($user_language[$user_selected]['lg_Sub_Category'])) ? $user_language[$user_selected]['lg_Sub_Category'] : $default_language['en']['lg_Sub_Category']; ?></li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<div class="content">
	<div class="container">
		<div class="">
			<?php 
			$pagination=explode('|',$this->ajax_pagination->create_links());
			?>
		</div>					
		<div class="catsec">
			<div class="row" id="dataList">

			<?php
			$placholder_img = $this->db->get_where('system_settings', array('key'=>'service_placeholder_image'))->row()->value;

			//; exit;
			if(!empty($category)) {
				foreach ($category as $crows) {
					$subcategory_name=strtolower($crows['subcategory_name']);
					$subcategory_name = str_replace('&', '_', strtolower($subcategory_name));
					$cat_name=strtolower($cat_name->category_name);
					$cat_names = $this->uri->segment(2); //str_replace('&', '_', strtolower($cat_name));

					

					if(!empty($crows['subcategory_image']) && (@getimagesize(base_url().$crows['subcategory_image']))){
						$category_image = base_url().$crows['subcategory_image'];
					}else{
						$category_image = ($placholder_img)? base_url().$placholder_img:base_url().'uploads/placeholder_img/1641376256_banner.jpg';
					} 
					$crowcategory = strtolower($cat_name);
				?>
			<div class="col-lg-4 col-md-6">
					<div class="cate-widget">
						<img src="<?php echo $category_image;?>" alt="">
						<div class="cate-title">

							<!-- <a href="<?php echo base_url();?>maincategories/<?php echo $crows['id'];?>"><h3><span><i class="fas fa-circle"></i> <?php echo ucfirst($crows['subcategory_name']);?></span></h3></a> -->
							<?php            
                                $output =  preg_replace('/[^A-Za-z0-9-]+/', '-', $crows['subcategory_name']);

                                $cat_slug = str_replace(" ","-",trim($output));

                                $inputs['subcategory_slug'] = strtolower($cat_slug);

                                $cat_slug = ($crows['subcategory_slug'])?$crows['subcategory_slug']:$inputs['subcategory_slug'];


                                $data = array('subcategory_slug'=>$cat_slug);

                                if(empty($crows['subcategory_slug'])) {

                                    $this->db->update('subcategories', $data, array('id'=>$crows['id']));
                                }
                                $subcat_lang = ($this->session->userdata('user_select_language'))?$this->session->userdata('user_select_language'):'en';
                                $this->db->where('subcategory_id', $crows['id']);
					            $this->db->where('lang_type', $subcat_lang);
					            $subcat_name = $this->db->get('subcategories_lang')->row();
                                ?>
							<a href="<?php echo base_url();?>search/<?php $cat_name = str_replace('&', '_', strtolower($subcategory_name)); echo str_replace(' ', '-', $cat_name)?>"><h3><span><i class="fas fa-circle"></i> <?php echo ucfirst($subcat_name->subcategory_name);?></span></h3></a>

						</div>
						<div class="cate-count">
							<a class="text-white" href="<?php echo base_url();?>search/<?php echo str_replace(' ', '-', $cat_names)."/".str_replace(' ', '-', $subcategory_name);?>"><i class="fas fa-clone"></i> <?php echo $crows['category_count'];?></a>

						</div>
					</div>
			</div>
			<?php } }
			else {  ?>

			<div class="col-lg-12">
			<div class="category">
			<?php echo (!empty($user_language[$user_selected]['lg_no_categories_found'])) ? $user_language[$user_selected]['lg_no_categories_found'] : $default_language['en']['lg_no_categories_found'] ?>
			</div>
			</div>
			<?php
			} 

			echo $this->ajax_pagination->create_links();
			?>
			</div>
		</div>
	</div>
</div>