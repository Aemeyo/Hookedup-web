<div class="content">
    <div class="container">
        <div class="row">
            <?php
            $type = $this->session->userdata('usertype');
            if ($type == 'user') {
                ?>
                <?php $this->load->view('user/home/user_sidemenu'); ?>
            <?php } else { ?>
                <?php $this->load->view('user/home/provider_sidemenu'); ?>
            <?php } ?>
            <div class="col-xl-9 col-md-8">
               
                <div class="dashboradsec">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="widget-title"><?php echo (!empty($user_language[$user_selected]['lg_Notifications'])) ? $user_language[$user_selected]['lg_Notifications'] : $default_language['en']['lg_Notifications']; ?></h4>
                        </div>
                        <?php if(!empty($notification_list)){ ?>
                        <div class="col-md-6 text-right">
                            <a id="not_del_all"data-id="" class='btn btn-sm bg-danger-light'><i class='far fa-trash-alt mr-1' ></i> <?php echo (!empty($user_language[$user_selected]['lg_delete_all'])) ? $user_language[$user_selected]['lg_delete_all'] : $default_language['en']['lg_delete_all']; ?></a>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="notcenter" id="dataListnotify">
                        <?php
                        if (!empty($notification_list)) {
                            foreach ($notification_list as $key => $value) {
                                $datef = explode(' ', $value["created_at"]);
                                if(settingValue('time_format') == '12 Hours') {
                                    $time = date('h:ia', strtotime($datef[1]));
                                } elseif(settingValue('time_format') == '24 Hours') {
                                   $time = date('H:i:s', strtotime($datef[1]));
                                } else {
                                    $time = date('G:ia', strtotime($datef[1]));
                                }
                                $date = date(settingValue('date_format'), strtotime($datef[0]));
                                $timeBase = $date.' '.$time;
                                ?>
                                <div class="notificationlist">
                                    <div class="inner-content-blk position-relative">
                                        <div class="d-flex text-dark">
                                <?php
                                if (file_exists($value['profile_img'])) {
                                    $image = base_url() . $value['profile_img'];
                                } else {
                                    $image = base_url() . 'assets/img/user.jpg';
                                }
                                ?>
                                            <img class="rounded" src="<?php echo $image; ?>" width="50" alt="">
                                            <div class="noti-contents">
                                                <h3><strong style="word-break: break-all;"><?= $value['message']; ?></strong></h3>
                                                <span><?= $timeBase; ?></span>
                                            </div>
                                             <a class='btn btn-sm bg-danger-light' id="not_del"data-id="<?php  echo $value['notification_id']; ?>"><i class='far fa-trash-alt mr-1' ></i> </a>
                                        </div>

                                    </div>
                                </div>

    <?php }
} else { ?>
                            <div class="notificationlist">
                                <p class="text-center text-danger mt-3"><?php echo (!empty($user_language[$user_selected]['lg_notification_empty'])) ? $user_language[$user_selected]['lg_notification_empty'] : $default_language['en']['lg_notification_empty']; ?></p>
                            </div>
<?php } ?>
                        <?php
                        if (!empty($notification_list)) {
                            echo $this->ajax_pagination->create_links();
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="not_delete_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5><?php echo(!empty($user_language[$user_selected]['lg_admin_delete_confirmation']))?($user_language[$user_selected]['lg_admin_delete_confirmation']) : 'Are you confirm to Delete.';  ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><?php echo(!empty($user_language[$user_selected]['lg_are_confirm_delete']))?($user_language[$user_selected]['lg_are_confirm_delete']) : 'Are you confirm to Delete.';  ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" id="confirm_delete_sub" data-id="" class="btn btn-primary"><?php echo(!empty($user_language[$user_selected]['lg_admin_confirm']))?($user_language[$user_selected]['lg_admin_confirm']) : 'Confirm';  ?></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo(!empty($user_language[$user_selected]['lg_admin_cancel']))?($user_language[$user_selected]['lg_admin_cancel']) : 'Cancel';  ?></button>
      </div>
    </div>
  </div>
</div>
<div class="modal" id="notall_delete_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5><?php echo(!empty($user_language[$user_selected]['lg_admin_delete_confirmation']))?($user_language[$user_selected]['lg_admin_delete_confirmation']) : 'Are you confirm to Delete.';  ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><?php echo(!empty($user_language[$user_selected]['lg_confrim_delete_all']))?($user_language[$user_selected]['lg_confrim_delete_all']) : 'Are you confirm to Delete all.';  ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" id="confirm_deleteall_sub" data-id="" class="btn btn-primary"><?php echo(!empty($user_language[$user_selected]['lg_admin_confirm']))?($user_language[$user_selected]['lg_admin_confirm']) : 'Confirm';  ?></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo(!empty($user_language[$user_selected]['lg_admin_cancel']))?($user_language[$user_selected]['lg_admin_cancel']) : 'Cancel';  ?></button>
      </div>
    </div>
  </div>
</div>