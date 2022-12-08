<?php 
$subscriptions = $language_content;

$query = $this->db->query("select * from language WHERE status = '1'");
$lang_test = $query->result();
?>
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="row">
			<div class="col-xl-8 offset-xl-2">
			
				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="page-title"><?php echo(!empty($subscriptions['lg_admin_edit_subscription']))?($subscriptions['lg_admin_edit_subscription']) : 'Edit Subscription';  ?></h3>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				
				<div class="card">
					<div class="card-body">
                        <form id="editSubscription" method="post" action="<?php echo base_url()?>admin/service/update_subscription">
                        	
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<input class="form-control" type="hidden" value="<?php echo $subscription['id']; ?>" name="subscription_id" id="subscription_id">
    						<?php foreach ($lang_test as $langval) { 
    							$this->db->where('sub_id', $subscription['id']);
						        $this->db->where('lang_type', $langval->language_value);
						        $lang_sub = $this->db->get('subscription_lang')->row();
    						?>
                            <div class="form-group">
                                <label><?php echo(!empty($subscriptions['lg_admin_subscription_name']))?($subscriptions['lg_admin_subscription_name']) : 'Subscription Name';  ?>(<?php echo $langval->language; ?>)</label>
                                <input class="form-control" type="text" value="<?php echo (!empty($lang_sub)) ? $lang_sub->subscription_name : ""; ?>" name="subscription_name_<?php echo $langval->id; ?>" id="subscription_name">
                                
                            </div>
                            <?php }  ?>
                            <div class="form-group">
                                <label><?php echo(!empty($subscriptions['lg_admin_subscription_amount']))?($subscriptions['lg_admin_subscription_amount']) : 'Subscription Amount';  ?></label>
                                <input class="form-control" type="number" step="0.01" min="0" value="<?php echo $subscription_amt; ?>" name="amount" id="amount">
                            </div>
                            <!-- <div class="form-group">
                                <label><?php echo(!empty($subscriptions['lg_admin_subscription_durations']))?($subscriptions['lg_admin_subscription_durations']) : 'Subscription Durations';  ?></label>
								<select class="form-control" name="duration" id="duration">
									<option value=""><?php echo(!empty($subscriptions['lg_admin_select_duration']))?($subscriptions['lg_admin_select_duration']) : 'Select Duration';  ?></option>
									<option value="1" <?php echo $subscription['duration']==1 ? "selected":""; ?>><?php echo(!empty($subscriptions['lg_admin_one_month']))?($subscriptions['lg_admin_one_month']) : 'One Month';  ?></option>
									<option value="3" <?php echo $subscription['duration']==3 ? "selected":""; ?>><?php echo(!empty($subscriptions['lg_admin_3_months']))?($subscriptions['lg_admin_3_months']) : '3 Months';  ?></option>
									<option value="6" <?php echo $subscription['duration']==6 ? "selected":""; ?>><?php echo(!empty($subscriptions['lg_admin_6_months']))?($subscriptions['lg_admin_6_months']) : '6 Months';  ?></option>
									<option value="12" <?php echo $subscription['duration']==12 ? "selected":""; ?>><?php echo(!empty($subscriptions['lg_admin_one_year']))?($subscriptions['lg_admin_one_year']) : 'One Year';  ?></option>
									<option value="24" <?php echo $subscription['duration']==24 ? "selected":""; ?>><?php echo(!empty($subscriptions['lg_admin_2_years']))?($subscriptions['lg_admin_2_years']) : '2 Years';  ?></option>
                                <label>Subscription Amount</label>
                                <input class="form-control sub-amount" type="number" step="0.01" min="0" value="<?php echo $subscription_amt; ?>" name="amount" id="amount">
                            </div> -->
                            <div class="form-group">
                                <label>Subscription Duration</label>
								<select class="form-control" name="duration" id="duration" <?php if($subscription['duration']==0) { ?> disabled="disabled" <?php }?>>
									<option value="">Select Duration</option>
									<option value="0" <?php echo $subscription['duration']==0 ? "selected":""; ?> >One Day</option>
									<option value="1" <?php echo $subscription['duration']==1 ? "selected":""; ?>>One Month</option>
									<option value="3" <?php echo $subscription['duration']==3 ? "selected":""; ?>>3 Months</option>
									<option value="6" <?php echo $subscription['duration']==6 ? "selected":""; ?>>6 Months</option>
									<option value="12" <?php echo $subscription['duration']==12 ? "selected":""; ?>>One Year</option>
									<option value="24" <?php echo $subscription['duration']==24 ? "selected":""; ?>>2 Years</option>
								</select>
                                <input type="hidden" name="subscription_description" id="subscription_description" value="<?php echo $subscription['fee_description']; ?>">
                            </div>
                            <?php
								$value=$this->db->select('count(id) as counts')->from('subscription_details')->where('subscription_id',$subscription['id'])->get()->row();
                            ?>
                            <div class="form-group">
                                <label class="d-block"><?php echo(!empty($subscriptions['lg_admin_subscription_status']))?($subscriptions['lg_admin_subscription_status']) : 'Subscription Status';  ?></label>
                                <label class="radio-inline">
                                    <input name="status" checked="checked" name="status" id="status1" value="1" type="radio" <?php echo $subscription['status']==1 ? "checked":""; ?>> <?php echo(!empty($subscriptions['lg_admin_active']))?($subscriptions['lg_admin_active']) : 'Active';  ?>
                                </label>
                                <?php
                                if ($value->counts==0 || $value->counts=='') { ?>
									<label class="radio-inline">
                                    <input name="status" type="radio" name="status" id="status2" value="0" <?php echo $subscription['status']==0 ? "checked":""; ?>> <?php echo(!empty($subscriptions['lg_admin_inactive']))?($subscriptions['lg_admin_inactive']) : 'InActive';  ?>
                                </label> 
                                <?php } ?>
                            </div>
                            <div class="mt-4">
                                <button class="btn btn-primary" type="submit"><?php echo(!empty($subscriptions['lg_admin_submit']))?($subscriptions['lg_admin_submit']) : 'Submit';  ?></button>	
                                <a href="<?php echo $base_url; ?>subscriptions" class="btn btn-cancel"><?php echo(!empty($subscriptions['lg_admin_cancel']))?($subscriptions['lg_admin_cancel']) : 'Cancel';  ?></a>
                            </div>
                        </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
