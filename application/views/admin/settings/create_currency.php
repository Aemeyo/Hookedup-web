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
                        <div class="col-sm-12">
                            <h4 class="page-title m-b-20 m-t-0"><?php echo(!empty($admin_settings['lg_admin_currency_create']))?($admin_settings['lg_admin_currency_create']) : 'Currency Create';  ?></h4>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo base_url().'admin/settings/create-currency/'; ?>" method="POST" enctype="multipart/form-data" id="currency_add">
                            <div class="form-group">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
                            <label><?php echo(!empty($admin_settings['lg_admin_currency_name']))?($admin_settings['lg_admin_currency_name']) : 'Currency Name';  ?></label>
                            <input type="text" class="form-control" name="currency_name" id="currency_name">
                        </div>
                        <div class="form-group">
                            <label><?php echo(!empty($admin_settings['lg_admin_currency_symbol']))?($admin_settings['lg_admin_currency_symbol']) : 'Currency Symbol';  ?>
                            </label>
                            <input type="text" class="form-control" name="currency_symbol" id="currency_symbol">
                        </div>
                        <div class="form-group">
                            <label><?php echo(!empty($admin_settings['lg_admin_currency_code']))?($admin_settings['lg_admin_currency_code']) : 'Currency Code';  ?></label>
                            <input type="text" class="form-control" name="currency_code" id="currency_code">
                        </div>
                        <div class="form-group">
                            <label><?php echo(!empty($admin_settings['lg_admin_currency_rate']))?($admin_settings['lg_admin_currency_rate']) : 'Currency Rates';  ?></label>
                            <input type="number" step="0.01" min="0" class="form-control cur-rate" name="rate" id="rate">
                        </div>
                        <div class="form-group">
                            <label><?php echo(!empty($admin_settings['lg_admin_status']))?($admin_settings['lg_admin_status']) : 'Status';  ?></label>
                            &nbsp;
                            <label><input type="radio" name="status" value="1" checked><?php echo(!empty($admin_settings['lg_admin_active']))?($admin_settings['lg_admin_active']) : 'Active';  ?></label>
                            &nbsp;
                             <label><input type="radio" name="status" value="2"><?php echo(!empty($admin_settings['lg_admin_inactive']))?($admin_settings['lg_admin_inactive']) : 'Inactive';  ?></label>
                        </div>
                            <div class="mt-4">
                                <button name="form_submit" type="submit" class="btn btn-primary" value="true"><?php echo(!empty($admin_settings['lg_admin_save_changes']))?($admin_settings['lg_admin_save_changes']) : 'Save Changes';  ?></button>
                                <a href="<?php echo $base_url; ?>admin/currency-settings"  class="btn btn-cancel"><?php echo(!empty($admin_settings['lg_admin_cancel']))?($admin_settings['lg_admin_cancel']) : 'Cancel';  ?></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>