<?php 
$add_service = $language_content;

$category = $this->service->get_category();
$subcategory = $this->service->get_subcategory($services['category']); 
$service_image = $this->service->service_image($services['id']);
$service_id = $services['id'];
$subscriptions = $language_content;
$currency_option = $this->db->get_where('system_settings',array('key' => 'currency_option'))->row()->value;
$user_currency_code = $currency_option;
$service_amount = get_gigs_currency($services['service_amount'], $services['currency_code'], $user_currency_code);
if (is_nan($service_amount) || is_infinite($service_amount)) {
    $service_amount = $services['service_amount'];
}
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
						<div class="col-sm-12">
							<h3 class="page-title"><?php echo(!empty($add_service['lg_admin_edit_service']))?($add_service['lg_admin_edit_service']) : 'Admin Edit Service';  ?></h3>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				<div class="card">
					<div class="card-body">
                        <form method="post" enctype="multipart/form-data" autocomplete="off" id="update_service" action="<?php echo base_url() ?>admin/service/update_service">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <input class="form-control" type="hidden" name="currency_code" value="<?php echo $user_currency_code; ?>">
                    <div class="service-fields mb-3">
                        <h3 class="heading-2"><?php echo(!empty($add_service['lg_admin_service_information']))?($add_service['lg_admin_service_information']) : 'Service Information';  ?></h3>
                        <input type="hidden" name="service_id" id="service_id" value="<?php echo $services['id']; ?>">
                        <input type="hidden" class="form-control" id="map_key" value="<?php echo settingValue('map_key');?>" >
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label><?php echo(!empty($add_service['lg_admin_select_provider']))?($add_service['lg_admin_select_provider']) : 'Select Provider';  ?><span class="text-danger">*</span></label>
                                    <select class="form-control" name="username">
                                    <option value=""><?php echo(!empty($add_service['lg_admin_select_provider_name']))?($add_service['lg_admin_select_provider_name']) : 'Select provider name';  ?></option>
                                    <?php foreach ($provider_list as $providers) { 
                                        $pro_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
                                        $this->db->where('modules', 'provider');
                                        if (!empty($providers['id'])) {
                                        $this->db->where('name_id', $providers['id']);
                                        }
                                        $this->db->where('lang_type', $pro_lang);
                                        $pro_name = $this->db->get('users_lang')->row_array();
                                    ?>
                                    <option value="<?=$providers['id']?>"<?php if($providers['id']==$services['user_id']) echo 'selected';?>><?php echo (!empty($pro_name['name']))?$pro_name['name']:''?></option>
                                    <?php } ?>
                                </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <?php foreach ($lang_test as $langval) { 
                                    $this->db->where('service_id', $services['id']);
                                    $this->db->where('lang_type', $langval->language_value);
                                    $lang_service = $this->db->get('service_lang')->row_array();
                                ?>
                                <div class="form-group">
                                    <label><?php echo(!empty($add_service['lg_admin_service_title']))?($add_service['lg_admin_service_title']) : 'Service Titles';  ?>(<?php echo $langval->language; ?>) <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="service_title_<?php echo $langval->id; ?>" id="service_title" value="<?php echo $lang_service['service_name']; ?>">
                                </div>
                                <?php }  ?>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                   <label><?php echo(!empty($add_service['lg_admin_service_amount']))?($add_service['lg_admin_service_amount']) : 'Service Amount';  ?> <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="service_amount" id="service_amount" value="<?php echo $service_amount; ?>">
                                </div>
                            </div>
                            <?php if(settingValue('location_type') == 'live') { ?>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label><?php echo(!empty($add_service['lg_admin_service_location']))?($add_service['lg_admin_service_location']) : 'Service Location';  ?> <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="service_location" id="service_location" value="<?php echo $services['service_location'] ?>" > 
                                    <input type="hidden" name="service_latitude" id="service_latitude" value="<?php echo $services['service_latitude'] ?>">
                                    <input type="hidden" name="service_longitude" id="service_longitude" value="<?php echo $services['service_longitude'] ?>">
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                    <label><?php echo(!empty($add_service['lg_admin_country']))?($add_service['lg_admin_country']) : 'Country';  ?> <span class="text-danger">*</span></label>
                                    <select class="form-control" id="country_id" name="country_id" >
                                    <option value=''><?php echo(!empty($add_service['lg_admin_select_country']))?($add_service['lg_admin_select_country']) : 'Select Country';  ?></option>
                                    <?php foreach($country as $row){?>
                                    <option value='<?php echo $row['id'];?>' <?php if(!empty($services['service_country'])){ echo ($row['id']==$services['service_country'])?'selected':'';}?>><?php echo $row['country_name'];?></option> 
                                <?php } ?>
                                </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label><?php echo(!empty($add_service['lg_admin_state']))?($add_service['lg_admin_state']) : 'State';  ?> <span class="text-danger">*</span></label>
                                        <select class="form-control" name="state_id" id="state_id" >
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label><?php echo(!empty($add_service['lg_admin_city']))?($add_service['lg_admin_city']) : 'City';  ?> <span class="text-danger">*</span></label>
                                        <select class="form-control" name="city_id" id="city_id">
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <input type="hidden" id="country_id_value" value="<?= isset($services['service_country'])?$services['service_country']:'';?>">
                    <input type="hidden" id="state_id_value" value="<?= $services['service_state'];?>">
                    <input type="hidden" id="city_id_value" value="<?= $services['service_city'];?>">
                    <div class="service-fields mb-3">
                        <h3><?php echo(!empty($add_service['lg_admin_service_category']))?($add_service['lg_admin_service_category']) : 'Service Category';  ?></h3>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo(!empty($add_service['lg_admin_category']))?($add_service['lg_admin_category']) : 'Category';  ?> <span class="text-danger">*</span></label>
                                    <select class="form-control" id="category1" name="category" > 
                                    <?php foreach ($category as $cat) { ?>
                                        <option value="<?= $cat['id'] ?>"  <?php if ($cat['id'] == $services['category']) { ?> selected = "selected" <?php } ?>><?php echo $cat['category_name'] ?>
                                        </option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo(!empty($add_service['lg_admin_sub_category']))?($add_service['lg_admin_sub_category']) : 'Sub Category';  ?> <span class="text-danger">*</span></label>
                                    <select class="form-control" id="subcategory" name="subcategory"> 
                                    <?php foreach ($subcategory as $sub_category) { ?>
                                        <option value="<?= $sub_category['id'] ?>"  <?php if ($sub_category['id'] == $services['subcategory']) { ?> selected = "selected" <?php } ?>><?php echo $sub_category['subcategory_name'] ?>
                                        </option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="service-fields mb-3">
                        <h3><?php echo(!empty($add_service['lg_admin_service_offer']))?($add_service['lg_admin_service_offer']) : 'Service Offer';  ?></h3>

                        <div class="membership-info">
                        <?php
                        if (!empty($serv_offered) && $serv_offered != 'null') {
                            $offered_data = json_decode($serv_offered[0]['service_offered']);
                            $count = is_array($offered_data) ? count($offered_data) : 0 ;
                            if ($count == 0){ ?>
                                <div class="row form-row membership-cont">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="service_offered[]"  value="<?php echo $serv_offered[0]['service_offered']; ?>" >
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 col-lg-2">
                                        <a href="#" class="btn btn-danger trash"><i class="far fa-times-circle"></i></a>
                                    </div>
                                </div>
                            <?php } else { 
                                foreach ($offered_data as $key => $value) {
                            ?>

                                <div class="row form-row membership-cont">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                    <label><?php echo(!empty($add_service['lg_admin_service_offered']))?($add_service['lg_admin_service_offered']) : 'Service Offered';  ?>  <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="service_offered[]"  value="<?php echo $value; ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 col-lg-2">
                                        <div class="form-group">
                                            <label class="d-block">&nbsp;</label>
                                            <a href="#" class="btn btn-danger trash"><i class="far fa-times-circle"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }  
                                    }
                            } else {
                            ?>
                                <div class="row form-row membership-cont">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="service_offered[]"  value="" >
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 col-lg-2">
                                        <div class="form-group">
                                            <a href="#" class="btn btn-danger trash"><i class="far fa-times-circle"></i></a>
                                        </div>
                                    </div>
                                </div>
                        <?php } ?>
                        </div>
                        <div class="add-more form-group">
                            <a href="javascript:void(0);" class="add-membership"><i class="fas fa-plus-circle"></i><?php echo(!empty($add_service['lg_admin_add_more']))?($add_service['lg_admin_add_more']) : 'Add More';  ?></a>
                        </div>
                    </div>
                    <div class="service-fields mb-3">
                        <h3 class="heading-2"><?php echo(!empty($add_service['lg_admin_details_information']))?($add_service['lg_admin_details_information']) : 'Details Information';  ?></h3>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label><?php echo(!empty($add_service['lg_admin_descriptions']))?($add_service['lg_admin_descriptions']) : 'Descriptions';  ?></label>
                                    <textarea class='form-control content-textarea' id='ck_editor_textarea_id2' rows='6' name='about'><?php echo $services['about'] ?></textarea>
                                    <?php echo display_ckeditor($ckeditor_editor1);  ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="service-fields mb-3">
                        <h3><?php echo(!empty($add_service['lg_admin_service_gallery']))?($add_service['lg_admin_service_gallery']) : 'Service Gallery';  ?></h3>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="services-upload">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span><?php echo(!empty($add_service['lg_admin_upload_service_image']))?($add_service['lg_admin_upload_service_image']) : 'Upload service image';  ?>*</span>
                                    <input type="file"  name="images[]" id="images" multiple accept="image/jpeg, image/png, image/gif,">

                                </div>  
                                <div id="uploadPreview">
                                    <ul class="upload-wrap" id="imgList">
                                    <?php
                                    $service_img = array();
                                    for ($i = 0; $i < count($service_image); $i++) { ?>
                                        <li id="service_img_<?php echo $service_image[$i]['id']; ?>">
                                            <div class="upload-images">

                                                <a href="javascript:void(0);" class="file_close1 btn btn-icon btn-danger btn-sm delete_img" data-img_id="<?php echo $service_image[$i]['id']; ?>">X</a><img alt="Service Image" src="<?php echo base_url() . $service_image[$i]['service_image']; ?>">
                                            </div>
                                        </li>
                                    <?php } ?>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="submit_status" value="0">
                    <div class="mt-4 text-center">
                    <?php if($user_role==1){ ?>
                    <button class="btn btn-primary " name="form_submit" value="submit" type="submit"><?php echo(!empty($add_service['lg_admin_save_changes']))?($add_service['lg_admin_save_changes']) : 'Save';  ?></button>
                    <?php }?>

                    <a href="<?php echo $base_url; ?>service-list"  class="btn btn-cancel"><?php echo(!empty($add_service['lg_admin_back']))?($add_service['lg_admin_back']) : 'back';  ?></a>
                    </div>
                </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>