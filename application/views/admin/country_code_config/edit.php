<?php 
$admin_settings = $language_content;
?>
<div class="page-wrapper">
	<div class="content container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h4 class="page-title m-b-20 m-t-0"><?php echo(!empty($admin_settings['lg_admin_country_codeedit']))?($admin_settings['lg_admin_country_codeedit']) : 'Country code Edit';  ?></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="card-box">
                        <?php foreach ($datalist as $value) { ?>
                            <form id="edit_country" action="<?php echo base_url().'admin/country_code_config/edit/' . $value['id']; ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
                                <label><?php echo(!empty($admin_settings['lg_admin_country_code']))?($admin_settings['lg_admin_country_code']) : 'Country Code';  ?></label>
                                <input type="text" class="form-control" name="country_code" id="country_code" required value="<?php if ($value['country_code']) { echo $value['country_code']; } ?>">
                            </div>
                            <div class="form-group">
                                <label><?php echo(!empty($admin_settings['lg_admin_country_id']))?($admin_settings['lg_admin_country_id']) : 'Country ID';  ?></label>
                                <input type="text" class="form-control" name="country_id" id="country_id" required value="<?php if ($value['country_id']) { echo $value['country_id']; } ?>">
                            </div>
                            <div class="form-group">
                                <label><?php echo(!empty($admin_settings['lg_admin_country_name']))?($admin_settings['lg_admin_country_name']) : 'Country Name';  ?></label>
                                <input type="text" class="form-control" name="country_name" id="country_name" required value="<?php if ($value['country_name']) { echo $value['country_name']; } ?>">
                            </div>
                                <div class="m-t-30 text-center">
                                    <button name="form_submit" type="submit" class="btn btn-primary" value="true"><?php echo(!empty($admin_settings['lg_admin_save_changes']))?($admin_settings['lg_admin_save_changes']) : 'Save Changes';  ?></button>
                                    <a href="<?php echo $base_url; ?>admin/country-code-config"  class="btn btn-primary"><?php echo(!empty($admin_settings['lg_admin_cancel']))?($admin_settings['lg_admin_cancel']) : 'Cancels';  ?></a>
                                </div>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>