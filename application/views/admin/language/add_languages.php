<?php 
$admin_settings = $language_content;
?>
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xl-8 offset-xl-2">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title"><?php echo(!empty($admin_settings['lg_admin_add_languages']))?($admin_settings['lg_admin_add_languages']) : 'Add Languages';  ?></h3>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo $base_url; ?>insert-language" id="add_language" method="post" autocomplete="off" enctype="multipart/form-data">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>

                            <div class="form-group">
                                <label><?php echo(!empty($admin_settings['lg_admin_language_name']))?($admin_settings['lg_admin_language_name']) : 'Name';  ?></label>
                                <input class="form-control" type="text" required  name="language_name" id="language_name">
                            </div>
                            <div class="form-group">
                                <label><?php echo(!empty($admin_settings['lg_admin_language_value']))?($admin_settings['lg_admin_language_value']) : 'Language Value';  ?></label>
                                <input class="form-control" type="text"  required name="language_value" id="language_value">
                            </div>
                            <div class="form-group">
                                <label><?php echo(!empty($admin_settings['lg_admin_rtlltr']))?($admin_settings['lg_admin_rtlltr']) : 'RTL or LTR (optional)';  ?></label>
                                <select class="form-control select" name="language_type" id="language_type">
                                    <option value=""><?php echo(!empty($admin_settings['lg_admin_select_tag']))?($admin_settings['lg_admin_select_tag']) : 'Select Tag';  ?></option>
                                    <option value="rtl"><?php echo(!empty($admin_settings['lg_admin_rtl']))?($admin_settings['lg_admin_rtl']) : 'RTL';  ?></option>
                                    <option value="ltr"><?php echo(!empty($admin_settings['lg_admin_ltr']))?($admin_settings['lg_admin_ltr']) : 'LTR';  ?></option>
                                    
                                </select>
                            </div>

                            <div class="mt-4">
                                    <button class="btn btn-primary " name="form_submit" value="submit" type="submit"><?php echo(!empty($admin_settings['lg_admin_add_language']))?($admin_settings['lg_admin_add_language']) : 'Add Language';  ?></button>

                                <a href="<?php echo $base_url; ?>language"  class="btn btn-cancel"><?php echo(!empty($admin_settings['lg_admin_cancel']))?($admin_settings['lg_admin_cancel']) : 'Cancel';  ?></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

