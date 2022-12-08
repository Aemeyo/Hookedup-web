<style type="text/css">
    input[type="file"] {
  display: block;
}
.imageThumb {
  max-height: 75px;
  border: 2px solid;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}
</style>

<?php 
$type = $this->session->userdata('usertype');
if ($type == 'user') {
$user_currency = get_user_currency();
} else if ($type == 'provider') {
$user_currency = get_provider_currency();
}
$user_currency_code = $user_currency['user_currency_code'];

$query = $this->db->query("select * from language WHERE status = '1'");
$lang_test = $query->result();
?>


<div class="content">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="section-header text-center">
                    <h2><?php echo (!empty($user_language[$user_selected]['lg_add_services'])) ? $user_language[$user_selected]['lg_add_services'] : $default_language['en']['lg_add_services']; ?></h2>
                </div>

    

                <form method="post" enctype="multipart/form-data" autocomplete="off" id="add_service" action="<?php echo base_url() ?>user/service/add_service_ajax">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <input class="form-control" type="hidden" name="currency_code" value="<?php echo $user_currency_code; ?>">
                    <div class="service-fields mb-3">
                        <h3 class="heading-2"><?php echo (!empty($user_language[$user_selected]['lg_service_info'])) ? $user_language[$user_selected]['lg_service_info'] : $default_language['en']['lg_service_info']; ?></h3>
                        <input type="hidden" class="form-control" id="map_key" value="<?php echo settingValue('map_key');?>" >
                        <div class="row">
                            <div class="col-lg-12">
                                <?php foreach ($lang_test as $langval) { ?>
                                <div class="form-group">
                                    <label><?php echo (!empty($user_language[$user_selected]['lg_service_title'])) ? $user_language[$user_selected]['lg_service_title'] : $default_language['en']['lg_service_title']; ?>(<?php echo $langval->language; ?>) <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="service_title_<?php echo $langval->id; ?>" id="service_title" required>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo (!empty($user_language[$user_selected]['lg_Service_Amount'])) ? $user_language[$user_selected]['lg_Service_Amount'] : $default_language['en']['lg_Service_Amount']; ?> <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="service_amount" id="service_amount" >
                                </div>
                            </div>
                            <?php if(settingValue('location_type') == 'live') { ?>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label><?php echo (!empty($user_language[$user_selected]['lg_Service_Location'])) ? $user_language[$user_selected]['lg_Service_Location'] : $default_language['en']['lg_Service_Location']; ?> <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="service_location" id="service_location">
                                        <input type="hidden" name="service_latitude" id="service_latitude">
                                        <input type="hidden" name="service_longitude" id="service_longitude">
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label><?php echo (!empty($user_language[$user_selected]['lg_country'])) ? $user_language[$user_selected]['lg_country'] : 'Country'; ?> <span class="text-danger">*</span></label>
                                        <select class="form-control" id="country_id" name="country_id" >
                                    <option value=''><?php echo (!empty($user_language[$user_selected]['lg_Select_Country'])) ? $user_language[$user_selected]['lg_Select_Country'] : $default_language['en']['lg_Select_Country']; ?></option>
                                    <?php foreach($country as $row){?>
                                    <option value='<?php echo $row['id'];?>'><?php echo $row['country_name'];?></option> 
                                <?php } ?>
                                </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label><?php echo (!empty($user_language[$user_selected]['lg_state'])) ? $user_language[$user_selected]['lg_state'] : 'State'; ?> <span class="text-danger">*</span></label>
                                       <select class="form-control" name="state_id" id="state_id" >
                                </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label><?php echo (!empty($user_language[$user_selected]['lg_city'])) ? $user_language[$user_selected]['lg_city'] : 'City'; ?> <span class="text-danger">*</span></label>
                                        <select class="form-control" name="city_id" id="city_id">
                                </select>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="service-fields mb-3">
                        <h3 class="heading-2"><?php echo (!empty($user_language[$user_selected]['lg_service_category'])) ? $user_language[$user_selected]['lg_service_category'] : $default_language['en']['lg_service_category']; ?></h3>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo (!empty($user_language[$user_selected]['lg_category'])) ? $user_language[$user_selected]['lg_category'] : $default_language['en']['lg_category']; ?> <span class="text-danger">*</span></label>
                                    <select class="form-control select" title="Category" name="category" id="category"></select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo (!empty($user_language[$user_selected]['lg_Sub_Category'])) ? $user_language[$user_selected]['lg_Sub_Category'] : $default_language['en']['lg_Sub_Category']; ?> <span class="text-danger">*</span></label>
                                    <select class="form-control select" title="Sub Category" name="subcategory" id="subcategory"  ></select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if(settingValue('service_offered_showhide') == 1) { ?>
                        <div class="service-fields mb-3">
                            <h3 class="heading-2"><?php echo (!empty($user_language[$user_selected]['lg_service_offer'])) ? $user_language[$user_selected]['lg_service_offer'] : $default_language['en']['lg_service_offer']; ?></h3>

                            <div class="membership-info">
                                <div class="row form-row membership-cont">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label><?php echo (!empty($user_language[$user_selected]['lg_service_offered'])) ? $user_language[$user_selected]['lg_service_offered'] : $default_language['en']['lg_service_offered']; ?> <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="service_offered[]" id="field1" class="">
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="add-more form-group">
                                <a href="javascript:void(0);" class="add-membership"><i class="fas fa-plus-circle"></i> <?php echo (!empty($user_language[$user_selected]['lg_add_more'])) ? $user_language[$user_selected]['lg_add_more'] : $default_language['en']['lg_add_more']; ?></a>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="service-fields mb-3">
                        <h3 class="heading-2"><?php echo (!empty($user_language[$user_selected]['lg_details_information'])) ? $user_language[$user_selected]['lg_details_information'] : $default_language['en']['lg_details_information']; ?></h3>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="text-center">
                                    <div id="load_div"></div>
                                </div>
                                    <label><?php echo (!empty($user_language[$user_selected]['lg_descriptions'])) ? $user_language[$user_selected]['lg_descriptions'] : $default_language['en']['lg_descriptions']; ?></label>
                                    <textarea class='form-control content-textarea' id='ck_editor_textarea_id5' rows='6' name='about'></textarea>
                                    <?php echo display_ckeditor($ckeditor_editor5);  ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="service-fields mb-3">
                        <h3 class="heading-2"><?php echo (!empty($user_language[$user_selected]['lg_service_gallery'])) ? $user_language[$user_selected]['lg_service_gallery'] : $default_language['en']['lg_service_gallery']; ?></h3>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="service-upload">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span><?php echo (!empty($user_language[$user_selected]['lg_upload_service_images'])) ? $user_language[$user_selected]['lg_upload_service_images'] : $default_language['en']['lg_upload_service_images']; ?> *</span>
                                    <input type="file" name="images[]" id="images" multiple accept="image/jpeg, image/png, image/gif,">
                                    <input type="file" name="images2[]" id="images2" multiple accept="image/jpeg, image/png, image/gif," style="display:none;">
                                </div>
                                <div id="uploadPreview"></div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="submit_status" value="0">
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn" type="submit" id="submit_add_service" name="form_submit" value="submit"><?php echo (!empty($user_language[$user_selected]['lg_Submit'])) ? $user_language[$user_selected]['lg_Submit'] : $default_language['en']['lg_Submit']; ?></button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>