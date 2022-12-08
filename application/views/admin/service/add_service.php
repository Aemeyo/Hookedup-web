<?php 
$add_service = $language_content;
$currency_option = $this->db->get_where('system_settings',array('key' => 'currency_option'))->row()->value;

$user_currency_code = $currency_option;
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
							<h3 class="page-title"><?php echo(!empty($add_service['lg_admin_add_service']))?($add_service['lg_admin_add_service']) : 'Admin Add Service';  ?></h3>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				
				<div class="card">
					<div class="card-body">
                    <form method="post" enctype="multipart/form-data" autocomplete="off" id="add_service" action="<?php echo base_url() ?>admin/service/add_service_ajax">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <input class="form-control" type="hidden" name="currency_code" value="<?php echo $user_currency_code; ?>">
                    <div class="service-fields">
                        <h3><?php echo(!empty($add_service['lg_admin_service_information']))?($add_service['lg_admin_service_information']) : 'Service Information';  ?></h3>
                        <input type="hidden" class="form-control" id="map_key" value="<?php echo settingValue('map_key');?>" >
                        <div class="row">
                        	<div class="col-lg-12">
                                <div class="form-group">
                                    <label><?php echo(!empty($add_service['lg_admin_select_provider']))?($add_service['lg_admin_select_provider']) : 'Select Provider';  ?><span class="text-danger">*</span></label>
                                    <select class="form-control select" name="username">
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
                                    <?php if (!empty($pro_name['name'])) { ?>
									<option value="<?=$providers['id']?>"><?php echo (!empty($pro_name['name']))?$pro_name['name']:''?></option>

									<?php } }?>
								</select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <?php foreach ($lang_test as $langval) { ?>
                                <div class="form-group">
                                    <label><?php echo(!empty($add_service['lg_admin_service_title']))?($add_service['lg_admin_service_title']) : 'Service Titles';  ?>(<?php echo $langval->language; ?>) <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="service_title_<?php echo $langval->id; ?>" id="service_title" required>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo(!empty($add_service['lg_admin_service_amount']))?($add_service['lg_admin_service_amount']) : 'Service Amount';  ?> <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="service_amount" id="service_amount" >
                                </div>
                            </div>
                           <?php if(settingValue('location_type') == 'live') { ?>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label><?php echo(!empty($add_service['lg_admin_service_location']))?($add_service['lg_admin_service_location']) : 'Service Location';  ?> <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="service_location" id="service_location">
                                        <input type="hidden" name="service_latitude" id="service_latitude">
                                        <input type="hidden" name="service_longitude" id="service_longitude">
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                       <label><?php echo(!empty($add_service['lg_admin_country']))?($add_service['lg_admin_country']) : 'Country';  ?> <span class="text-danger">*</span></label>
                                        <select class="form-control" id="country_id" name="country_id" >
                                    <option value=''><?php echo(!empty($add_service['lg_admin_select_country']))?($add_service['lg_admin_select_country']) : 'Select Country';  ?></option>
                                    <?php foreach($country as $row){?>
                                    <option value='<?php echo $row['id'];?>'><?php echo $row['country_name'];?></option> 
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
                    <div class="service-fields">
                        <h3><?php echo(!empty($add_service['lg_admin_service_category']))?($add_service['lg_admin_service_category']) : 'Service Category';  ?></h3>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo(!empty($add_service['lg_admin_category']))?($add_service['lg_admin_category']) : 'Category';  ?> <span class="text-danger">*</span></label>
                                    <select class="form-control select" title="Category" name="category" id="category"   ></select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo(!empty($add_service['lg_admin_sub_category']))?($add_service['lg_admin_sub_category']) : 'Sub Category';  ?> <span class="text-danger">*</span></label>
                                    <select class="form-control select" title="Sub Category" name="subcategory" id="subcategory"  ></select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="service-fields">
                        <h3><?php echo(!empty($add_service['lg_admin_service_offer']))?($add_service['lg_admin_service_offer']) : 'Service Offer';  ?></h3>

                        <div class="membership-info">
                            <div class="row form-row membership-cont">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label><?php echo(!empty($add_service['lg_admin_service_offered']))?($add_service['lg_admin_service_offered']) : 'Service Offered';  ?>  <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="service_offered[]" id="field1" class="">
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <div class="add-more form-group">
                            <a href="javascript:void(0);" class="add-membership"><i class="fas fa-plus-circle mr-1"></i><?php echo(!empty($add_service['lg_admin_add_more']))?($add_service['lg_admin_add_more']) : 'Add More';  ?></a>
                        </div>
                    </div>
                    <div class="service-fields">
                        <h3><?php echo(!empty($add_service['lg_admin_details_information']))?($add_service['lg_admin_details_information']) : 'Details Information';  ?></h3>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="text-center">
                                    <div id="load_div"></div>
                                </div>
                                    <label><?php echo(!empty($add_service['lg_admin_descriptions']))?($add_service['lg_admin_descriptions']) : 'Descriptions';  ?></label>
                                    <textarea class='form-control content-textarea ckeditor' id='ck_editor_textarea_id2' rows='6' name='about'></textarea>
                                    <?php echo display_ckeditor($ckeditor_editor1);  ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="service-fields">
                        <h3><?php echo(!empty($add_service['lg_admin_service_gallery']))?($add_service['lg_admin_service_gallery']) : 'Service Gallery';  ?></h3>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="services-upload">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span><?php echo(!empty($add_service['lg_admin_upload_service_image']))?($add_service['lg_admin_upload_service_image']) : 'Upload service image';  ?>*</span>
                                    <input type="file" name="images[]" id="images" multiple accept="image/jpeg, image/png, image/gif,">
                                    <input type="file" name="images2[]" id="images2" multiple accept="image/jpeg, image/png, image/gif," style="display:none;">
                                </div>
                                <div id="uploadPreview"></div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="submit_status" value="0">
                    <div class="service-fields-btns">
			             <button class="btn btn-primary" name="form_submit" value="submit" type="submit"><?php echo(!empty($add_service['lg_admin_add']))?($add_service['lg_admin_add']) : 'Save';  ?></button>

						<a href="<?php echo $base_url; ?>service-list"  class="btn btn-cancel"><?php echo(!empty($add_service['lg_admin_back']))?($add_service['lg_admin_back']) : 'back';  ?></a>
					</div>
                </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>