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
                            <h3 class="page-title"><?php echo(!empty($admin_settings['lg_admin_add_web_keywords']))?($admin_settings['lg_admin_add_web_keywords']) : 'Add Web Keywords';  ?></h3>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <div class="card">
                    <div class="card-body">
                        <form action="" id="lang_keywords_settings" method="post" autocomplete="off" enctype="multipart/form-data">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>

                            <div class="form-group">
                                <label><?php echo(!empty($admin_settings['lg_admin_filed_name']))?($admin_settings['lg_admin_filed_name']) : 'Filed Name';  ?></label>
                                <input class="form-control" type="text"  name="filed_name" id="category_name">
                            </div>
                            <div class="form-group">
                                <label><?php echo(!empty($admin_settings['lg_admin_key_name']))?($admin_settings['lg_admin_key_name']) : 'Key Name';  ?></label>
                                <input class="form-control check_key_name" type="text"  name="key_name" id="category_name" style="text-transform: lowercase;">
                            </div>
                            

                            <div class="mt-4">
                                <button class="btn btn-primary " name="form_submit" value="submit" type="submit" value="true"><?php echo(!empty($admin_settings['lg_admin_add_language']))?($admin_settings['lg_admin_add_language']) : 'Add Language';  ?></button>

                                <a href="<?php echo $base_url; ?>web-languages/<?php echo $this->uri->segment(2); ?>"  class="btn btn-cancel"><?php echo(!empty($admin_settings['lg_admin_cancel']))?($admin_settings['lg_admin_cancel']) : 'Cancel';  ?></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

