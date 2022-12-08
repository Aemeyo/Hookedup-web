<?php 
$admin_settings = $language_content;
?>
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-lg-10">
                    <h3 class="page-title"><?php echo(!empty($admin_settings['lg_admin_translation']))?($admin_settings['lg_admin_translation']) : 'Translation -';  ?><span class="text-primary"><?php echo $langName; ?></span></h3>
                </div>
                <div class="text-right mb-3">
                    <a href="<?php echo base_url('add-admin-keyword/')?><?php echo $this->uri->segment(2);?> " class="btn btn-primary add-button"><i class="fas fa-plus"></i></a>
                    <a href="<?php echo $base_url; ?>languages" class="btn btn-primary"><?php echo(!empty($admin_settings['lg_admin_back']))?($admin_settings['lg_admin_back']) : 'Back';  ?></a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-center mb-0 categories_table" id="categories_table">
                                <thead>
                                    <tr>
                                        <th><?php echo(!empty($admin_settings['lg_admin_#']))?($admin_settings['lg_admin_#']) : '#';  ?></th>
                                        <th width="45%"><?php echo(!empty($admin_settings['lg_admin_key']))?($admin_settings['lg_admin_key']) : 'Key';  ?></th>
                                        <th width="45%"><?php echo(!empty($admin_settings['lg_admin_value']))?($admin_settings['lg_admin_value']) : 'Value';  ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach ($lang_keywords as $key => $value) { 
                                            $val = str_replace('_', ' ', $value->lang_key); 
                                            $val1 = ltrim($val, 'lg ');
                                            $langKey = ucfirst($val1);
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $langKey; ?></td>
                                            <td>
                                                <input type="text" class="form-control langKeyName" name="<?php echo $value->lang_value; ?>" id="langKeyName" value="<?php echo $value->lang_value; ?>" data-id="<?php echo $value->sno; ?>" data-key="<?php echo $value->language; ?>">
                                            </td>
                                        </tr>
                                     
                                <?php $i++; } ?>
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>