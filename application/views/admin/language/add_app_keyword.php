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
                            <h3 class="page-title"><?php echo(!empty($admin_settings['lg_admin_add_page']))?($admin_settings['lg_admin_add_page']) : 'Add Page';  ?></h3>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo $base_url; ?>insert_app_keyword" id="add_app_keywords" method="post" autocomplete="off" enctype="multipart/form-data">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
                            <input class="form-control" type="hidden"  name="lang_key" id="lang_key" value="<?php echo $this->uri->segment(2); ?>">
                            <div class="form-group">
                                <label><?php echo(!empty($admin_settings['lg_admin_page_name']))?($admin_settings['lg_admin_page_name']) : 'Page Name';  ?></label>
                                <input class="form-control" type="text"  name="page_name" id="page_name">
                            </div>
                            
                            <div class="mt-4">
                                <button class="btn btn-primary " name="form_submit" value="submit" type="submit"><?php echo(!empty($admin_settings['lg_admin_add_page']))?($admin_settings['lg_admin_add_page']) : 'Add Page';  ?></button>
                                <a href="<?php echo base_url().'app-page-list/'.$this->uri->segment(2); ?>"  class="btn btn-cancel"><?php echo(!empty($admin_settings['lg_admin_cancel']))?($admin_settings['lg_admin_cancel']) : 'Cancel';  ?></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

