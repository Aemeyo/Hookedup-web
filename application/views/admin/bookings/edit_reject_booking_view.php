<?php 
$booking = $language_content;
?>
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="row">
			<div class="col-xl-8 offset-xl-2">
					
				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col">
							<?php if($list['payment_status']==5){?>
							<h3 class="page-title"><?php echo(!empty($booking['lg_admin_edit_reject_payment']))?($booking['lg_admin_edit_reject_payment']) : 'Edit Reject Payment';  ?></h3>
							<?php }else{ ?>
								<h3 class="page-title"><?php echo(!empty($booking['lg_admin_edit_cancel_payment']))?($booking['lg_admin_edit_cancel_payment']) : 'Edit Cancel Payment';  ?></h3>
							<?php }?>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				
				<div class="card">
					<div class="card-body">
						<form method="post" method="post" action="<?=base_url('pay-reject')?>" id="reject_payment_submit" autocomplete="off" enctype="multipart/form-data">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
    

							<input type="hidden" name="booking_id" value="<?=$list['id'];?>">
                            <div class="form-group">
                                <label><?php echo(!empty($booking['lg_admin_service_title']))?($booking['lg_admin_service_title']) : 'Service Title';  ?></label>
                                <input class="form-control" type="text" name="service_name" id="service_name" value="<?=!empty($list['service_title'])?$list['service_title']:'';?>" readonly>
                            </div>
							<div class="form-group">
                                <label><?php echo(!empty($booking['lg_admin_service_amount']))?($booking['lg_admin_service_amount']) : 'Service Amount';  ?></label>
                                <input class="form-control" type="text" name="service_amount" id="service_amount" value="<?=!empty($list['amount'])?$list['amount']:'';?>" readonly>
                            </div>
                            <div class="form-group">
                                <label><?php echo(!empty($booking['lg_admin_rejection_comments.']))?($booking['lg_admin_rejection_comments.']) : 'Rejection Comments.';  ?></label>
                                <textarea class="form-control" readonly=""><?=!empty($list['reason'])?$list['reason']:'not mentioned...';?></textarea>
                            </div>
                            <div class="form-group">
                                <label><?php echo(!empty($booking['lg_admin_service_amount_favour']))?($booking['lg_admin_service_amount_favour']) : 'Service Amount Favour for';  ?></label>
								<div>
									<label class="radio-inline"><input class="pay_for"  type="radio" checked="checked" name="pay_for" value="1"> <?php echo(!empty($booking['lg_admin_provider']))?($booking['lg_admin_provider']) : 'Provider';  ?> </label>
									<label class="radio-inline"><input class="pay_for"  type="radio" name="pay_for" value="2"> <?php echo(!empty($booking['lg_admin_user']))?($booking['lg_admin_user']) : 'User';  ?> </label>
								</div>
                            </div>
                            <input type="hidden" name="token" id="token" value="<?=$list['provider_token'];?>">
							<div class="form-group">
                                <label><?php echo(!empty($booking['lg_admin_favour_comments']))?($booking['lg_admin_favour_comments']) : 'Favour comments';  ?></label>
                                <textarea name="favour_comment" id="fav_com" class="form-control"><?php echo(!empty($booking['lg_admin_this_service_amount_favour']))?($booking['lg_admin_this_service_amount_favour']) : 'This service amount favour for Provider';  ?></textarea>
                            </div>
                            <div class="mt-4">
                                <button class="btn btn-primary" name="form_submit" value="submit" type="submit"><?php echo(!empty($booking['lg_admin_submit']))?($booking['lg_admin_submit']) : 'Submit';  ?></button>

								<a href="<?php echo $base_url; ?>admin/reject-report"  class="btn btn-cancel"><?php echo(!empty($booking['lg_admin_cancel']))?($booking['lg_admin_cancel']) : 'Cancel';  ?></a>
                            </div>
                            <input type="hidden" id="user_token" value="<?=$list['user_token'];?>">
                            <input type="hidden" id="provider_token" value="<?=$list['provider_token'];?>">
                        </form>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
