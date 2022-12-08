<?php

$this->db->from('services');

$services_count = $this->db->count_all_results();

$this->db->from('services');

$this->db->where('status', 1);

$this->db->order_by('total_views', 'DESC');

$this->db->limit(3);

$popular = $this->db->get()->result_array();



$limit = settingValue('new_services_count')?settingValue('new_services_count'):'10';

$this->db->from('services');

$services_count = $this->db->count_all_results();

$this->db->from('services');

$this->db->where('status', 1);

$this->db->order_by('id', 'DESC');

$this->db->limit($limit);

$newest = $this->db->get()->result_array();



$query = $this->db->query("select * from system_settings WHERE status = 1");

$result = $query->result_array();



if (!empty($result)) {

    foreach ($result as $data) {

        if ($data['key'] == 'currency_option') {

            $currency_option = $data['value'];

        }

    }

}

$bgquery = $this->db->query("select * from bgimage WHERE bgimg_for = 'banner'");

$bgresult = $bgquery->result_array();

if(!empty($bgresult[0]['upload_image']))

{

	$bgimg=base_url().$bgresult[0]['upload_image'];

}

else

{

	$bgimg=base_url().'assets/img/banner.jpg';

}


$banner_showhide = $this->db->get_where('bgimage',array('bgimg_id'=> 1))->row();

$howit_showhide = $this->db->get_where('system_settings',array('key'=> 'how_showhide'))->row();





?>

<?php if($banner_showhide->banner_settings == 1)  { ?>

<section class="hero-section">

    <div class="layer"> 

        <div class="home-banner" style="background-image: url('<?php echo $bgimg;?>');"></div>	

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-12">

                    <div class="section-search">
                        <?php 
                        foreach ($home_banner_language as $home_language) { ?>
    						<h1><?php echo(!empty($home_language['title']))?($home_language['title']) : 'Worlds Largest Marketplace';  ?></h1>

    						<p><?php echo(!empty($home_language['content']))?($home_language['content']) : 'Search From 0 Awesome Verified Ads!';  ?></p>
                        <?php } ?>

                        <?php if($banner_showhide->main_search == 1)  { ?>						

                        <div class="search-box">

                            <form action="<?php echo base_url(); ?>search" id="search_service" method="post">

                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

                                <div class="search-input line">

                                    <i class="fas fa-tv bficon"></i>

                                    <div class="form-group mb-0">

                                        <input type="text" class="form-control common_search search" name="common_search" id="search-blk" placeholder="<?php echo (!empty($user_language[$user_selected]['lg_what_you_look'])) ? $user_language[$user_selected]['lg_what_you_look'] : $default_language['en']['lg_what_you_look']; ?>" >

                                    </div>

                                </div>

                                <div class="search-input">

                                    <i class="fas fa-location-arrow bficon"></i>

                                    <div class="form-group mb-0">

                                        <input type="text" class="form-control" value="<?php echo $this->session->userdata('user_address');?>" name="user_address" id="user_address" placeholder="<?php echo (!empty($user_language[$user_selected]['lg_your_location'])) ? $user_language[$user_selected]['lg_your_location'] : $default_language['en']['lg_your_location']; ?>">

                                        <input type="hidden" value="" name="user_latitude" id="user_latitude">

                                        <input type="hidden" value="" name="user_longitude" id="user_longitude">
                                        <?php if(settingValue('location_type') == 'live') { ?>
                                            <a class="current-loc-icon current_location" data-id="1" href="javascript:void(0);" onclick="change_location()"><i class="fas fa-crosshairs"></i></a>
                                        <?php } ?>

                                    </div>

                                </div>

                                <div class="search-btn">

                                    <button class="btn search_service" name="search" value="search"  type="button"><?php echo (!empty($user_language[$user_selected]['lg_search'])) ? $user_language[$user_selected]['lg_search'] : $default_language['en']['lg_search']; ?></button>

                                </div>

                            <?php } ?>

                            </form>

                        </div>

                        <ul id="searchResult"></ul>

                         <?php if($banner_showhide->popular_search == 1)  { ?> 

                        <div class="search-cat">

                            <i class="fas fa-circle"></i>

                        <?php 
                        foreach ($home_popularsea_language as $popularsea_language) { ?>
                            <span><?php echo(!empty($popularsea_language['content']))?($popularsea_language['content']) : $popularsea_language['content'];  ?></span>

                        <?php } ?>

                        <?php foreach ($popular as $popular_services) { ?>

                            <a href="<?php echo base_url() . 'service-preview/' . $popular_services['url']; ?>">

                                <?php echo $popular_services['service_title'] ?>

                            </a>

                        <?php } ?>

                        </div>

                         <?php } ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<?php } ?>

<?php  if(settingValue('featured_showhide') == 1) { ?>

<section class="category-section">

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                <div class="row">

                    <div class="col-md-6">

                        <div class="heading">

                        <?php foreach ($home_featured_language as $featured_language) { ?>
                            <h2><?php echo(!empty($featured_language['title']))?($featured_language['title']) : 'Featured Categories';  ?></h2>

                            <span><?php echo(!empty($featured_language['content']))?($featured_language['content']) : 'Search From Featured Categories';  ?></span>
                        <?php } ?>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="viewall">

                            <h4><a href="<?php echo base_url(); ?>all-categories"><?php echo (!empty($user_language[$user_selected]['lg_View_All'])) ? $user_language[$user_selected]['lg_View_All'] : $default_language['en']['lg_View_All']; ?> <i class="fas fa-angle-right"></i></a></h4>

                            <span><?php echo (!empty($user_language[$user_selected]['lg_Featured_Categories'])) ? $user_language[$user_selected]['lg_Featured_Categories'] : $default_language['en']['lg_Featured_Categories']; ?></span>

                        </div>

                    </div>

                </div>						

                <div class="catsec">

                    <div class="row">
                        <?php

                        if (!empty($featured_category)) {

                            foreach ($featured_category as $crows) {

                                ?>

                                <div class="col-lg-4 col-md-6">
                                <?php 
                                $RemoveSpecialChar = $this->home->RemoveSpecialChar($crows['category_name']);
                                $output =  preg_replace('/[^A-Za-z0-9-]+/', '-', $RemoveSpecialChar);

                                $cat_slug = str_replace(" ","-",trim($output));

                                $inputs['category_slug'] = strtolower($cat_slug);

                                $cat_slug = ($crows['category_slug'])?$crows['category_slug']:$inputs['category_slug'];


                                $data = array('category_slug'=>$cat_slug);

                                if(empty($crows['category_slug'])) {

                                    $this->db->update('categories', $data, array('id'=>$crows['id']));
                                }

                                ?>
                                    <a href="<?php echo base_url(); ?>search/<?php echo str_replace(' ', '-', strtolower($crows['category_slug'])); ?>">

                                        <div class="cate-widget">

										<?php if ($crows['category_image'] != '' && (@getimagesize(base_url().$crows['category_image']))) { ?>

                                            <img src="<?php echo base_url() . $crows['category_image']; ?>" alt="">

										<?php } else { ?>

											 <img alt="Category Image" src="<?php echo ($placholder_img)? base_url().$placholder_img:base_url().'uploads/placeholder_img/1641376256_banner.jpg'; ?>">

										<?php } 
                                        $cat_lang = ($this->session->userdata('user_select_language'))?$this->session->userdata('user_select_language'):'en';
                                        $this->db->where('category_id', $crows['id']);
                                        $this->db->where('lang_type', $cat_lang);
                                        $cat_name = $this->db->get('categories_lang')->row();
                                        ?>

                                            <div class="cate-title">

                                                <h3><span><i class="fas fa-circle"></i> <?php echo $cat_name->category_name; ?></span></h3>

                                            </div>

                                            <div class="cate-count">

                                                <i class="fas fa-clone"></i> <?php echo $crows['category_count']; ?>

                                            </div>

                                        </div>

                                    </a>

                                </div>

                                <?php

                            }

                        } else { ?>



                        <div class="col-lg-12">

                        <div class="category">

                        <h5 class="text-center"><?php echo (!empty($user_language[$user_selected]['lg_no_categories_found'])) ? $user_language[$user_selected]['lg_no_categories_found'] : $default_language['en']['lg_no_categories_found'] ?></h5>

                        </div>

                        </div>

                        <?php

                        }

                        ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<?php } ?>



<?php  if(settingValue('newest_ser_showhide') == 1) { ?>

<section class="popular-services">

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                <div class="row">

                    <div class="col-md-6">

                        <div class="heading">

                        <?php foreach ($home_latest_language as $latest_language) { ?>
                            <h2><?php echo(!empty($latest_language['title']))?($latest_language['title']) : 'Newest Services';  ?></h2>

                            <span><?php echo(!empty($latest_language['content']))?($latest_language['content']) : 'Newest Service Contents';  ?></span>
                        <?php } ?>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="viewall">

                            <h4><a href="<?php echo base_url(); ?>all-services"><?php echo (!empty($user_language[$user_selected]['lg_View_All'])) ? $user_language[$user_selected]['lg_View_All'] : $default_language['en']['lg_View_All']; ?> <i class="fas fa-angle-right"></i></a></h4>

                            <span><?php echo (!empty($user_language[$user_selected]['lg_newest_services'])) ? $user_language[$user_selected]['lg_newest_services'] : 'Newested Services'; ?></span>

                        </div>

                    </div>

                </div>

                <div class="service-carousel">

                    <div class="service-slider owl-carousel owl-theme">



                        <?php



                        if (!empty($newest)) {

                            foreach ($newest as $nrows) {

                                $this->db->select("service_image");

                                $this->db->from('services_image');

                                $this->db->where("service_id", $nrows['id']);

                                $this->db->where("status", 1);

                                $image = $this->db->get()->row_array();

                                $lang = ($this->session->userdata('user_select_language'))?$this->session->userdata('user_select_language'):settingValue('language');

                                $cat_name = $this->db->select('cl.category_name')->from('categories c')->join('categories_lang cl', 'cl.category_id = c.id', 'left')->where(array('c.id'=>$nrows['category'],'c.status'=> 1, 'cl.lang_type'=>$lang))->get()->row()->category_name;
                                
                                $provider_details = $this->db->where('id', $nrows['user_id'])->get('providers')->row_array();





                                $this->db->select('AVG(rating)');

                                $this->db->where(array('service_id' => $nrows['id'], 'status' => 1));

                                $this->db->from('rating_review');

                                $rating = $this->db->get()->row_array();

                                $avg_rating = round($rating['AVG(rating)'], 1);



                                $user_currency_code = '';

                                $userId = $this->session->userdata('id');

                                If (!empty($userId)) {

                                    $service_amount = $nrows['service_amount'];



                                    $type = $this->session->userdata('usertype');

                                    if ($type == 'user') {

                                        $user_currency = get_user_currency();

                                    } else if ($type == 'provider') {

                                        $user_currency = get_provider_currency();

                                    } $user_currency_code = $user_currency['user_currency_code'];



                                    $service_amount = get_gigs_currency($nrows['service_amount'], $nrows['currency_code'], $user_currency_code);

                                } else {

                                    $user_currency_code = settings('currency');

                                    $service_currency_code = $nrows['currency_code'];

                                    $service_amount = get_gigs_currency($nrows['service_amount'], $nrows['currency_code'], $user_currency_code);

                                }

                                if (is_nan($service_amount) || is_infinite($service_amount)) {

                                    $service_amount = $nrows['service_amount'];

                                }                         

                                ?>

                                <div class="service-widget">

                                    <div class="service-img">

                                        <a href="<?php echo base_url() . 'service-preview/' . $nrows['url']; ?>">

                                        

                                        <?php if ($image['service_image'] != '' && (@getimagesize(base_url().$image['service_image']))) { ?>

                                            <img class="img-fluid serv-img" alt="Service Image" src="<?php echo base_url() . $image['service_image']; ?>" alt="">

                                        <?php } else { ?>

                                             <img class="img-fluid serv-img" alt="Service Image" src="<?php echo ($placholder_img)?$placholder_img:base_url().'uploads/placeholder_img/1641376256_banner.jpg';?>">

                                        <?php } ?>



                                        </a>

                                        <div class="item-info">

                                            <div class="service-user">

                                                <a href="#">

                                                    <?php  if ($provider_details['profile_img'] != '' && (@getimagesize(base_url().$provider_details['profile_img']))) { ?>

                                                        <img src="<?php echo base_url() . $provider_details['profile_img'] ?>">

                                                    <?php } else { ?>

                                                        <img src="<?php echo base_url(); ?>assets/img/user.jpg">

                                                        

        <?php } ?>

                                                </a>

                                                <span class="service-price"><?php echo currency_conversion($user_currency_code) . $service_amount; ?></span>

                                            </div>

                                            <div class="cate-list">
                                                <a class="bg-yellow" href="<?php echo base_url() . 'search/' . str_replace(' ', '-', strtolower($cat_name)); ?>"><?php echo ucfirst($cat_name); ?></a></div>

                                        </div>

                                    </div>

                                    <div class="service-content">

                                        <?php 



                                        $RemoveSpecialChar = $this->home->RemoveSpecialChar($nrows['service_title']);

                                        $output =  preg_replace('/[^A-Za-z0-9-]+/', '-', $RemoveSpecialChar);

                                        $service_url = str_replace(" ","-",trim($output));

                                        $inputs['url'] = strtolower($service_url);

                                        $service_url = ($nrows['url'])?$nrows['url']:$inputs['url'];



                                        $data = array('url'=>$service_url);

                                        if(empty($nrows['url'])) {

                                            $this->db->update('services', $data, array('id'=>$nrows['id']));

                                        }

                                        ?>

                                        <h3 class="title">
                                            <?php 
                                                $ser_lang = ($this->session->userdata('user_select_language'))?$this->session->userdata('user_select_language'):'en';
                                                $this->db->where('service_id', $nrows['id']);
                                                $this->db->where('lang_type', $ser_lang);
                                                $service_name = $this->db->get('service_lang')->row_array();
                                            ?>
                                            <a href="<?php echo base_url() . 'service-preview/' .$service_url; ?>"><?php echo ucfirst($service_name['service_name']); ?></a>

                                        </h3>

                                        <div class="rating">

                                            <?php

                                            for ($x = 1; $x <= $avg_rating; $x++) {

                                                echo '<i class="fas fa-star filled"></i>';

                                            }

                                            if (strpos($avg_rating, '.')) {

                                                echo '<i class="fas fa-star"></i>';

                                                $x++;

                                            }

                                            while ($x <= 5) {

                                                echo '<i class="fas fa-star"></i>';

                                                $x++;

                                            }

                                            ?>

                                            <span class="d-inline-block average-rating">(<?php echo $avg_rating ?>)</span>

                                        </div>

                                        <div class="user-info">



                                            <div class="row">

                                                <?php if ($this->session->userdata('id') != '') {

                                                    ?>

                                                    <span class="col ser-contact"><i class="fas fa-phone mr-1"></i> <span>xxxxxxxx<?= rand(00, 99) ?></span></span>

                                                <?php } else { ?>

                                                    <span class="col ser-contact"><i class="fas fa-phone mr-1"></i> <span>xxxxxxxx<?= rand(00, 99) ?></span></span>

        <?php } ?>

                                                <span class="col ser-location"><span><?php echo ucfirst($nrows['service_location']); ?></span> <i class="fas fa-map-marker-alt ml-1"></i></span>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <?php

                            }

                        } else {



                            echo '<div> 

                                    <p class="mb-0">'. (!empty($user_language[$user_selected]["lg_no_service"])) ? $user_language[$user_selected]["lg_no_service"] : $default_language["en"]["lg_no_service"];

                                    '</p>

                                </div>';

                        }

                        ?>

                    </div> 

                </div>

            </div>

        </div>

    </div>

</section>

<?php  }  ?>



<?php  if(settingValue('popular_ser_showhide') == 1) { ?>

<section class="popular-services">

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                <div class="row">

                    <div class="col-md-6">

                        <div class="heading">

                        <?php foreach ($home_popular_language as $popular_language) { ?>
                            <h2><?php echo(!empty($popular_language['title']))?($popular_language['title']) : 'Popular Services';  ?></h2>

                            <span><?php echo(!empty($popular_language['content']))?($popular_language['content']) : 'Popular Service Contents';  ?></span>
                        <?php } ?>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="viewall">

                            <h4><a href="<?php echo base_url(); ?>all-services"><?php echo (!empty($user_language[$user_selected]['lg_View_All'])) ? $user_language[$user_selected]['lg_View_All'] : $default_language['en']['lg_View_All']; ?> <i class="fas fa-angle-right"></i></a></h4>

                            <span><?php echo (!empty($user_language[$user_selected]['lg_Most_Popular'])) ? $user_language[$user_selected]['lg_Most_Popular'] : $default_language['en']['lg_Most_Popular']; ?></span>

                        </div>

                    </div>

                </div>

                <div class="service-carousel">

                    <div class="service-slider owl-carousel owl-theme">



                        <?php

                        if (!empty($services)) {

                            foreach ($services as $srows) {





                                $this->db->select("service_image");

                                $this->db->from('services_image');

                                $this->db->where("service_id", $srows['id']);

                                $this->db->where("status", 1);

                                $image = $this->db->get()->row_array();



                                $provider_details = $this->db->where('id', $srows['user_id'])->get('providers')->row_array();





                                $this->db->select('AVG(rating)');

                                $this->db->where(array('service_id' => $srows['id'], 'status' => 1));

                                $this->db->from('rating_review');

                                $rating = $this->db->get()->row_array();

                                $avg_rating = round($rating['AVG(rating)'], 1);



                                $user_currency_code = '';

                                $userId = $this->session->userdata('id');

                                If (!empty($userId)) {

                                    $service_amount = $srows['service_amount'];



                                    $type = $this->session->userdata('usertype');

                                    if ($type == 'user') {

                                        $user_currency = get_user_currency();

                                    } else if ($type == 'provider') {

                                        $user_currency = get_provider_currency();

                                    } $user_currency_code = $user_currency['user_currency_code'];



                                    $service_amount = get_gigs_currency($srows['service_amount'], $srows['currency_code'], $user_currency_code);

                                } else {

                                    $user_currency_code = settings('currency');

                                    $service_currency_code = $srows['currency_code'];

                                    $service_amount = get_gigs_currency($srows['service_amount'], $srows['currency_code'], $user_currency_code);

                                }

                                if (is_nan($service_amount) || is_infinite($service_amount)) {

                                    $service_amount = $srows['service_amount'];

                                }



                                $RemoveSpecialChar = $this->home->RemoveSpecialChar($srows['service_title']);

                                $output = preg_replace('!\s+!', ' ', $RemoveSpecialChar);

                                $service_url = str_replace(" ","-",trim($output));

                                $inputs['url'] = strtolower($service_url);

                                $service_url = ($srows['url'])?$srows['url']:$inputs['url'];



                                $data = array('url'=>$service_url);

                                if(empty($srows['url'])) {

                                    $this->db->update('services', $data, array('id'=>$srows['id']));

                                }                         

                                ?>

                                <div class="service-widget">

                                    <div class="service-img">

                                        <a href="<?php echo base_url() . 'service-preview/' . $srows['url']; ?>">

										

										<?php if ($image['service_image'] != '' && (@getimagesize(base_url().$image['service_image']))) { ?>

                                            <img class="img-fluid serv-img" alt="Service Image" src="<?php echo base_url() . $image['service_image']; ?>" alt="">

										<?php } else { ?>

											 <img class="img-fluid serv-img" alt="Service Image" src="<?php echo ($placholder_img)?$placholder_img:base_url().'uploads/placeholder_img/1641376256_banner.jpg';?>">

										<?php } ?>



                                        </a>

                                        <div class="item-info">

                                            <div class="service-user">

                                                <a href="#">

                                                    <?php  if ($provider_details['profile_img'] != '' && (@getimagesize(base_url().$provider_details['profile_img']))) { ?>

                                                        <img src="<?php echo base_url() . $provider_details['profile_img'] ?>">

                                                    <?php } else { ?>

														<img src="<?php echo base_url(); ?>assets/img/user.jpg">

                                                        

        <?php } ?>

                                                </a>

                                                <span class="service-price"><?php echo currency_conversion($user_currency_code) . $service_amount; ?></span>

                                            </div>

                                            <div class="cate-list">
                                                <?php 
                                                    $this->db->where('category_name', $srows['category_name']);
                                                    $cat_names = $this->db->get('categories')->row();
                                                    $cat_langs = ($this->session->userdata('user_select_language'))?$this->session->userdata('user_select_language'):'en';
                                                    $this->db->where('category_id', $cat_names->id);
                                                    $this->db->where('lang_type', $cat_langs);
                                                    $cat_namess = $this->db->get('categories_lang')->row();
                                                 ?>
                                                <a class="bg-yellow" href="<?php echo base_url() . 'search/' . str_replace(' ', '-', strtolower($srows['category_name'])); ?>"><?php echo $cat_namess->category_name; ?></a></div>

                                        </div>

                                    </div>

                                    <div class="service-content">

                                        <h3 class="title">
                                            <?php 
                                                $ser_lang = ($this->session->userdata('user_select_language'))?$this->session->userdata('user_select_language'):'en';
                                                $this->db->where('service_id', $srows['id']);
                                                $this->db->where('lang_type', $ser_lang);
                                                $service_name = $this->db->get('service_lang')->row_array();
                                            ?>
                                            <a href="<?php echo base_url() . 'service-preview/' .$srows['url']; ?>"><?php echo ucfirst($service_name['service_name']); ?></a>

                                        </h3>

                                        <div class="rating">

                                            <?php

                                            for ($x = 1; $x <= $avg_rating; $x++) {

                                                echo '<i class="fas fa-star filled"></i>';

                                            }

                                            if (strpos($avg_rating, '.')) {

                                                echo '<i class="fas fa-star"></i>';

                                                $x++;

                                            }

                                            while ($x <= 5) {

                                                echo '<i class="fas fa-star"></i>';

                                                $x++;

                                            }

                                            ?>

                                            <span class="d-inline-block average-rating">(<?php echo $avg_rating ?>)</span>

                                        </div>

                                        <div class="user-info">



                                            <div class="row">

                                                <?php if ($this->session->userdata('id') != '') {

                                                    ?>

                                                    <span class="col ser-contact"><i class="fas fa-phone mr-1"></i> <span>xxxxxxxx<?= rand(00, 99) ?></span></span>

                                                <?php } else { ?>

                                                    <span class="col ser-contact"><i class="fas fa-phone mr-1"></i> <span>xxxxxxxx<?= rand(00, 99) ?></span></span>

        <?php } ?>

                                                <span class="col ser-location"><span><?php echo ucfirst($srows['service_location']); ?></span> <i class="fas fa-map-marker-alt ml-1"></i></span>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <?php

                            }

                        } else {



                            echo '<div>	

									<p class="mb-0">'. (!empty($user_language[$user_selected]["lg_no_service"])) ? $user_language[$user_selected]["lg_no_service"] : $default_language["en"]["lg_no_service"];

									'</p>

								</div>';

                        }

                        ?>

                    </div> 

                </div>

            </div>

        </div>

    </div>

</section>

<?php  }  ?>

<?php  if(settingValue('top_rating_showhide') == 1) { ?>

<section class="popular-services">

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                <div class="row">

                    <div class="col-md-6">

                        <div class="heading">

                        <?php foreach ($home_featured_ser_language as $featured_ser_language) { ?>
                            <h2><?php echo(!empty($featured_ser_language['title']))?($featured_ser_language['title']) : 'Featured Services';  ?></h2>

                            <span><?php echo(!empty($featured_ser_language['content']))?($featured_ser_language['content']) : 'Featured Service Contents';  ?></span>
                        <?php } ?>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="viewall">

                            <h4><a href="<?php echo base_url(); ?>featured-services"><?php echo (!empty($user_language[$user_selected]['lg_View_All'])) ? $user_language[$user_selected]['lg_View_All'] : $default_language['en']['lg_View_All']; ?> <i class="fas fa-angle-right"></i></a></h4>

                            <span><?php echo (!empty($user_language[$user_selected]['lg_features_services'])) ? $user_language[$user_selected]['lg_features_services'] : $default_language['en']['lg_features_services']; ?></span>

                        </div>

                    </div>

                </div>

                <div class="service-carousel">

                    <div class="service-slider owl-carousel owl-theme">



                        <?php

                        if (!empty($top_rating_services)) {

                            foreach ($top_rating_services as $srows) {
                                $lang = ($this->session->userdata('user_select_language'))?$this->session->userdata('user_select_language'):settingValue('language');

                                $feature_cat_name = $this->db->select('cl.category_name')->from('categories c')->join('categories_lang cl', 'cl.category_id = c.id', 'left')->where(array('c.id'=>$srows['category'],'c.status'=> 1, 'cl.lang_type'=>$lang))->get()->row()->category_name;
                                $this->db->select("service_image");

                                $this->db->from('services_image');

                                $this->db->where("service_id", $srows['id']);

                                $this->db->where("status", 1);

                                $image = $this->db->get()->row_array();



                                $provider_details = $this->db->where('id', $srows['user_id'])->get('providers')->row_array();





                                $this->db->select('AVG(rating)');

                                $this->db->where(array('service_id' => $srows['id'], 'status' => 1));

                                $this->db->from('rating_review');

                                $rating = $this->db->get()->row_array();

                                $avg_rating = round($rating['AVG(rating)'], 1);



                                $user_currency_code = '';

                                $userId = $this->session->userdata('id');

                                If (!empty($userId)) {

                                    $service_amount = $srows['service_amount'];



                                    $type = $this->session->userdata('usertype');

                                    if ($type == 'user') {

                                        $user_currency = get_user_currency();

                                    } else if ($type == 'provider') {

                                        $user_currency = get_provider_currency();

                                    } $user_currency_code = $user_currency['user_currency_code'];



                                    $service_amount = get_gigs_currency($srows['service_amount'], $srows['currency_code'], $user_currency_code);

                                } else {

                                    $user_currency_code = settings('currency');

                                    $service_currency_code = $srows['currency_code'];

                                    $service_amount = get_gigs_currency($srows['service_amount'], $srows['currency_code'], $user_currency_code);

                                }

                                if (is_nan($service_amount) || is_infinite($service_amount)) {

                                    $service_amount = $srows['service_amount'];

                                } 



                                $RemoveSpecialChar = $this->home->RemoveSpecialChar($srows['service_title']);

                                $output = preg_replace('!\s+!', ' ', $RemoveSpecialChar);

                                $service_url = str_replace(" ","-",trim($output));

                                $inputs['url'] = strtolower($service_url);

                                $service_url = ($srows['url'])?$srows['url']:$inputs['url'];



                                $data = array('url'=>$service_url);

                                if(empty($srows['url'])) {

                                    $this->db->update('services', $data, array('id'=>$srows['id']));

                                }                           

                                ?>

                                <div class="service-widget">

                                    <div class="service-img">

                                        <a href="<?php echo base_url() . 'service-preview/' . $srows['url']; ?>">

                                        

                                        <?php if ($image['service_image'] != '' && (@getimagesize(base_url().$image['service_image']))) { ?>

                                            <img class="img-fluid serv-img" alt="Service Image" src="<?php echo base_url() . $image['service_image']; ?>" alt="">

                                        <?php } else { ?>

                                             <img class="img-fluid serv-img" alt="Service Image" src="<?php echo ($placholder_img)?$placholder_img:base_url().'uploads/placeholder_img/1641376256_banner.jpg';?>">

                                        <?php } ?>



                                        </a>

                                        <div class="item-info">

                                            <div class="service-user">

                                                <a href="#">

                                                    <?php  if ($provider_details['profile_img'] != '' && (@getimagesize(base_url().$provider_details['profile_img']))) { ?>

                                                        <img src="<?php echo base_url() . $provider_details['profile_img'] ?>">

                                                    <?php } else { ?>

                                                        <img src="<?php echo base_url(); ?>assets/img/user.jpg">

                                                        

        <?php } ?>

                                                </a>

                                                <span class="service-price"><?php echo currency_conversion($user_currency_code) . $service_amount; ?></span>

                                            </div>

                                            <div class="cate-list">

                                                <a class="bg-yellow" href="<?php echo base_url() . 'search/' . str_replace(' ', '-', strtolower($feature_cat_name)); ?>"><?php echo ucfirst($feature_cat_name); ?></a></div>

                                        </div>

                                    </div>

                                    <div class="service-content">

                                        <h3 class="title">
                                            <?php 
                                                $ser_lang = ($this->session->userdata('user_select_language'))?$this->session->userdata('user_select_language'):'en';
                                                $this->db->where('service_id', $srows['id']);
                                                $this->db->where('lang_type', $ser_lang);
                                                $service_name = $this->db->get('service_lang')->row_array();
                                            ?>
                                            <a href="<?php echo base_url() . 'service-preview/' .$srows['url']; ?>"><?php echo ucfirst($service_name['service_name']); ?></a>

                                        </h3>

                                        <div class="rating">

                                            <?php

                                            for ($x = 1; $x <= $avg_rating; $x++) {

                                                echo '<i class="fas fa-star filled"></i>';

                                            }

                                            if (strpos($avg_rating, '.')) {

                                                echo '<i class="fas fa-star"></i>';

                                                $x++;

                                            }

                                            while ($x <= 5) {

                                                echo '<i class="fas fa-star"></i>';

                                                $x++;

                                            }

                                            ?>

                                            <span class="d-inline-block average-rating">(<?php echo $avg_rating ?>)</span>

                                        </div>

                                        <div class="user-info">



                                            <div class="row">

                                                <?php if ($this->session->userdata('id') != '') {

                                                    ?>

                                                    <span class="col ser-contact"><i class="fas fa-phone mr-1"></i> <span>xxxxxxxx<?= rand(00, 99) ?></span></span>

                                                <?php } else { ?>

                                                    <span class="col ser-contact"><i class="fas fa-phone mr-1"></i> <span>xxxxxxxx<?= rand(00, 99) ?></span></span>

        <?php } ?>

                                                <span class="col ser-location"><span><?php echo ucfirst($srows['service_location']); ?></span> <i class="fas fa-map-marker-alt ml-1"></i></span>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <?php

                            }

                        } else {



                            echo '<div> 

                                    <p class="mb-0">'. (!empty($user_language[$user_selected]["lg_no_service"])) ? $user_language[$user_selected]["lg_no_service"] : $default_language["en"]["lg_no_service"];

                                    '</p>

                                </div>';

                        }

                        ?>

                    </div> 

                </div>

            </div>

        </div>

    </div>

</section>

<?php  }  ?>


<!-- Blog Section -->

<?php  if(settingValue('blog_showhide') == 1) { ?>
    <!-- Blog -->
		<section class="popular-services">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="row">
							<div class="col-md-6">
								<div class="heading aos" data-aos="fade-up">

                                <?php foreach ($home_blog_language as $blog_language) { ?>
                                    <h2><?php echo(!empty($blog_language['title']))?($blog_language['title']) : 'Blogs';  ?></h2>

                                    <span><?php echo(!empty($blog_language['content']))?($blog_language['content']) : 'Latest From Our Blog';  ?></span>
                                <?php } ?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="viewall aos" data-aos="fade-up">
									<h4><a href="<?php echo $base_url; ?>all-blogs"><?php echo (!empty($user_language[$user_selected]['lg_View_All'])) ? $user_language[$user_selected]['lg_View_All'] : $default_language['en']['lg_View_All']; ?> <i class="fas fa-angle-right"></i></a></h4>
									<span>Blogs</span>
								</div>
							</div>
						</div>
						<div class="row aos" data-aos="fade-up">

                        <?php if($blogs){
                            foreach($blogs as $post){ ?>
                                <!-- Blog Post -->
                                <div class="col-md-6 col-xl-4 col-sm-12 d-flex">
                                    <div class="blog grid-blog flex-fill">
                                        <div class="blog-image blog-inner-image">
											<?php if ($post['image_default'] != '' && (@getimagesize(base_url().$post['image_default']))) { ?>
                                            <a href="<?php echo $base_url; ?>user-blog-details/<?php echo $post['url']; ?>">
												<img class="img-fluid" src="<?php echo $post['image_default']; ?>" alt="Post Image">
                                            </a>
											<?php } else { ?>
											<a href="<?php echo $base_url; ?>user-blog-details/<?php echo $post['url']; ?>">
												<img src="<?php echo base_url(); ?>assets/img/service-placeholder.jpg">
											</a>
											<?php } ?>
                                        </div>
                                        <div class="blog-content">
                                            <h3 class="blog-title"><a href="<?php echo $base_url; ?>user-blog-details/<?php echo $post['url']; ?>"><?php echo $post['title']; ?></a></h3>
											<div class="blog-read d-flex justify-content-between align-items-center">
												<div class= "blog-date">
													<p><i class="far fa-calendar mr-2"></i><?php echo date('d-M-Y',strtotime($post['createdAt'])); ?></p>
												</div>
												<div class="blog-read-more">
													<a href="<?php echo $base_url; ?>user-blog-details/<?php echo $post['url']; ?>"> Read more<i class="fas fa-arrow-right ml-2"></i></a>
												</div>
											</div>
										</div>
                                    </div>										
                                </div>
                                <!-- /Blog Post -->
                            <?php } 
                        } else { 
                            echo '<div> 

                                    <p class="mb-0">'. (!empty($user_language[$user_selected]["lg_no_blogs"])) ? $user_language[$user_selected]["lg_no_blogs"] : $default_language["en"]["lg_no_blogs"];

                                    '</p>

                                </div>';
                        } ?> 

						</div>
					</div>
				</div>
			</div>
			</section>
		<!-- /Blog -->
<?php } ?>

<?php  if(settingValue('how_showhide') == 1) { ?>

<section class="how-work">

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                <div class="heading howitworks">

                    <?php foreach ($home_how_it_language as $how_it_language) { ?>
                        <h2><?php echo(!empty($how_it_language['title']))?($how_it_language['title']) : 'How It Works';  ?></h2>

                        <span><?php echo(!empty($how_it_language['content']))?($how_it_language['content']) : 'How It Works Content';  ?></span>
                    <?php } ?>

                </div>

                <div class="howworksec">

                    <div class="row">

                        <div class="col-lg-4">

                            <div class="howwork">

                                <div class="iconround">

                                    <div class="steps">01</div>

                                        <?php

                                        $bo1query = $this->db->query("select * from bgimage WHERE bgimg_for = 'bottom_image1'");

                                        $bo1result = $bo1query->result_array();

                                        if(!empty(settingValue('how_title_img_1'))){                                            

                                            echo '<img src="'.base_url().settingValue('how_title_img_1').'">';

                                        }else{

                                            

                                            echo '<img src="'.base_url().'assets/img/icon-1.png">';

                                        }

                                        ?>

                                    

                                </div>

                                <?php foreach ($home_step_1_language as $step_1_language) { ?>
                                    <h3><?php echo(!empty($step_1_language['title']))?($step_1_language['title']) : 'Choose What To Do';  ?></h3>

                                    <p><?php echo(!empty($step_1_language['content']))?($step_1_language['content']) : 'Aliquam lorem ante, dapibus in, viverra quis, feugiat Phasellus viverra nulla ut metus varius laoreet.';  ?></p>
                                <?php } ?>

                            </div>

                        </div>

                        <div class="col-lg-4">

                            <div class="howwork">

                                <div class="iconround">

                                    <div class="steps">02</div>

                                    <?php

                                        $bo2query = $this->db->query("select * from bgimage WHERE bgimg_for = 'bottom_image2'");

                                        $bo2result = $bo2query->result_array();

                                        if(!empty(settingValue('how_title_img_2'))){                                            

                                            echo '<img src="'.base_url().settingValue('how_title_img_2').'">';

                                        }else{

                                            

                                            echo '<img src="'.base_url().'assets/img/icon-2.png">';

                                        }

                                        ?>

                                </div>

                                <?php foreach ($home_step_2_language as $step_2_language) { ?>
                                    <h3><?php echo(!empty($step_2_language['title']))?($step_2_language['title']) : 'Find What You Want';  ?></h3>

                                    <p><?php echo(!empty($step_2_language['content']))?($step_2_language['content']) : 'Aliquam lorem ante, dapibus in, viverra quis, feugiat Phasellus viverra nulla ut metus varius laoreet.';  ?></p>
                                <?php } ?>

                            </div>

                        </div>

                        <div class="col-lg-4">

                            <div class="howwork">

                                <div class="iconround">

                                    <div class="steps">03</div>

                                    <?php

                                        $bo3query = $this->db->query("select * from bgimage WHERE bgimg_for = 'bottom_image3'");

                                        $bo3result = $bo3query->result_array();

                                        if(!empty(settingValue('how_title_img_3'))){                                            

                                            echo '<img src="'.base_url().settingValue('how_title_img_3').'">';

                                        }else{

                                            

                                            echo '<img src="'.base_url().'assets/img/icon-3.png">';

                                        }

                                        ?>

                                </div>

                                <?php foreach ($home_step_3_language as $step_3_language) { ?>
                                    <h3><?php echo(!empty($step_3_language['title']))?($step_3_language['title']) : 'Amazing Places';  ?></h3>

                                    <p><?php echo(!empty($step_3_language['content']))?($step_3_language['content']) : 'Aliquam lorem ante, dapibus in, viverra quis, feugiat Phasellus viverra nulla ut metus varius laoreet.';  ?></p>
                                <?php } ?>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<?php } ?>

<?php  if(settingValue('download_showhide') == 1) { ?>

    <section class="app-section d-none" id="how-work">

        <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    <div class="heading howitworks">

                        <?php foreach ($home_down_language as $down_language) { ?>
                            <h2><?php echo(!empty($down_language['title']))?($down_language['title']) : 'Download Our App';  ?></h2>

                            <span><?php echo(!empty($down_language['content']))?($down_language['content']) : 'Aliquam lorem ante, dapibus in, viverra quis';  ?></span>
                        <?php } ?>

                        <div class="mt-3">

                        <a href="<?=(settingValue('app_store_link')?settingValue('app_store_link'):'#')?>" target="_blank" rel="noopener noreferrer"><img class="thumbnail m-b-0" src="<?php echo base_url() . settingValue('app_store_img'); ?>"></a>
                            <a href="<?=(settingValue('play_store_link')?settingValue('play_store_link'):'#')?>" target="_blank" rel="noopener noreferrer"><img class="thumbnail m-b-0" src="<?php echo base_url() . settingValue('play_store_img'); ?>"></a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

<?php } ?>

<!-- App Section -->