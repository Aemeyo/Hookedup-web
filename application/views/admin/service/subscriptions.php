<?php 
$subscriptions = $language_content;
?>
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title"><?php echo(!empty($subscriptions['lg_admin_subscriptions']))?($subscriptions['lg_admin_subscriptions']) : 'Subscriptions';  ?></h3>
                </div>
                <div class="col-auto text-right">
                    <a href="<?php echo $base_url; ?>add-subscription" class="btn btn-primary add-button">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->


        <div class="row pricing-box">

            <?php
            if (!empty($list)) {


                foreach ($list as $subscription) {

                    $str = $subscription['fee_description'];
                    $description = (explode(" ", $str));
                    $description = $description[1];
                    //Currency Convertion Based 
                    $currency_code_old = $subscription['currency_code'];
                    $subscription_amount = get_gigs_currency($subscription['fee'], $currency_code_old, $currency_code);
                    switch ($description) {
                        case "Day":
                            $drt= "Day";
                            break;
                        case "Days":
                            $drt= "Day";
                            break;
                        case "Month":
                            $drt= "Monthly";
                            break;
                        case "Months":
                            $drt= "Monthly";
                            break;
                        case "Year":
                            $drt= "Yearly";
                            break;
                        case "Years":
                            $drt= "Yearly";
                            break;
                        default:
                            $drt= "Monthly";
                    }

                    $sub_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
                    $this->db->where('sub_id', $subscription['id']);
                    $this->db->where('lang_type', $sub_lang);
                    $sub_name = $this->db->get('subscription_lang')->row();
                    ?>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="pricing-header">
                                    <h2><?php echo $sub_name->subscription_name; ?></h2>
                                    <p><?php echo $drt; ?> <?php echo(!empty($subscriptions['lg_admin_price']))?($subscriptions['lg_admin_price']) : 'Price';  ?></p>
                                </div>              
                                <div class="pricing-card-price">
                                    <h3 class="heading2 price">
                                        <?php echo currency_code_sign(settings('currency')).$subscription_amount; ?>
                                    </h3>
                                    <p>
                                        <?php echo(!empty($subscriptions['lg_admin_duration:']))?($subscriptions['lg_admin_duration:']) : 'Duration:';  ?> <span><?php echo $subscription['fee_description']; ?></span>
                                    </p>
                                </div>
                                <ul class="pricing-options">
                                    <li>
                                        <i class="far fa-check-circle"></i> <?php echo(!empty($subscriptions['lg_admin_one_listing_submission']))?($subscriptions['lg_admin_one_listing_submission']) : 'One listing submission';  ?>
                                    </li>
                                    <li>
                                        <i class="far fa-check-circle"></i> <?php echo $subscription['fee_description']; ?> <?php echo(!empty($subscriptions['lg_admin_expiration']))?($subscriptions['lg_admin_expiration']) : 'expiration';  ?>
                                    </li>
                                </ul>
                                <a href="<?php echo $base_url . 'edit-subscription/' . $subscription['id']; ?>" class="btn btn-primary btn-block"><?php echo(!empty($subscriptions['lg_admin_edit']))?($subscriptions['lg_admin_edit']) : 'Edit';  ?></a>
								<button type="button" sid="<?=$subscription['id']?>" id="chkdel_subcribe" class="btn btn-danger btn-block"><?php echo(!empty($subscriptions['lg_admin_delete']))?($subscriptions['lg_admin_delete']) : 'Delete';  ?></button>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }else {
                echo '<tr><td colspan="4"><div class="text-center text-muted">No records found</div></td></tr>';
            }
            ?>
        </div>
    </div>
</div>
<div class="modal" id="sub_delete_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5><?php echo(!empty($subscriptions['lg_admin_delete_confirmation']))?($subscriptions['lg_admin_delete_confirmation']) : 'Delete Confirmation';  ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><?php echo(!empty($subscriptions['lg_admin_are_confirm_delete']))?($subscriptions['lg_admin_are_confirm_delete']) : 'Are you confirm to Delete.';  ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" id="confirm_delete_sub1" data-id="" class="btn btn-primary"><?php echo(!empty($subscriptions['lg_admin_confirm']))?($subscriptions['lg_admin_confirm']) : 'Confirm';  ?></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo(!empty($subscriptions['lg_admin_cancel']))?($subscriptions['lg_admin_cancel']) : 'Cancel';  ?></button>
      </div>
    </div>
  </div>
</div>