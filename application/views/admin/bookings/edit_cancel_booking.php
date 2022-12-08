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
							<h3 class="page-title"><?php echo(!empty($booking['lg_admin_edit_cancel_booking']))?($booking['lg_admin_edit_cancel_booking']) : 'Edit Cancel Booking';  ?></h3>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				
				<div class="card">
					<div class="card-body">
                        <form id="edit_cancel_form" method="post" autocomplete="off" enctype="multipart/form-data">
                        	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
    

                            <div class="form-group">
                                <label><?php echo(!empty($booking['lg_admin_service_name']))?($booking['lg_admin_service_name']) : 'Service Name :';  ?> </label>
                              <label><?=$list->service_title;?></label>
                            </div>
                          
                            <div class="form-group">
                                <label><?php echo(!empty($booking['lg_admin_user_name']))?($booking['lg_admin_user_name']) : 'User Name :';  ?> </label>
                              <label><?=$list->user_name;?></label>
                            </div>
                              <div class="form-group">
                                <label><?php echo(!empty($booking['lg_admin_provider_name ']))?($booking['lg_admin_provider_name ']) : 'Provider Name :';  ?> </label>
                              <label><?=$list->provider_name;?></label>
                            </div>
                             <div class="form-group">
                                <label><?php echo(!empty($booking['lg_admin_date_:']))?($booking['lg_admin_date_:']) : 'Date :';  ?> </label>
                              <label><?=date('d M Y',strtotime($list->service_date));?></label>
                            </div>
                            <div class="form-group">
                                <label><?php echo(!empty($booking['lg_admin_total']))?($booking['lg_admin_total']) : 'Total :s';  ?> </label>
                              <label><?=$list->amount;?></label>
                            </div>
                             <div class="form-group">
                                <label><?php echo(!empty($booking['lg_admin_amount_refund']))?($booking['lg_admin_amount_refund']) : 'Amount Refund To :s';  ?> </label>
                                <div class="col-md-5">
                              <select class="form-control" name="amount_refund">
                              	<option value=""><?php echo(!empty($booking['lg_admin_select_one']))?($booking['lg_admin_select_one']) : 'Select Ones';  ?></option>
                              	<option value="1"><?php echo(!empty($booking['lg_admin_provider']))?($booking['lg_admin_provider']) : 'Provider';  ?></option>
                              	<option value="2"><?php echo(!empty($booking['lg_admin_user']))?($booking['lg_admin_user']) : 'User';  ?></option>
                              </select>
                              <input type="hidden" name="booking_id" value="<?=$list->id;?>">
                          </div>
                            </div>
                            <div class="mt-4">
                            	 <?php if($user_role==1){?>
                                <button class="btn btn-primary" name="form_submit" value="submit" type="submit"><?php echo(!empty($booking['lg_admin_save_changes']))?($booking['lg_admin_save_changes']) : 'Save Changes';  ?></button>
                               <?php }?>
								<a href="<?php echo $base_url; ?>admin/cancel-report"  class="btn btn-cancel"><?php echo(!empty($booking['lg_admin_cancel']))?($booking['lg_admin_cancel']) : 'Cancel';  ?></a>
                            </div>
                        </form>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>