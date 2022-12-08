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
							<h3 class="page-title"><?php echo(!empty($subscriptions['lg_admin_add_subscription']))?($subscriptions['lg_admin_add_subscription']) : 'Add Subscription';  ?></h3>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				
				<div class="card">
					<div class="card-body">
                        <form id="addSubscription" method="post" action="<?php echo base_url()?>admin/service/save_subscription">
                        	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                        	<?php foreach ($lang_test as $langval) { ?>
                            <div class="form-group">
                                <label><?php echo(!empty($subscriptions['lg_admin_subscription_name']))?($subscriptions['lg_admin_subscription_name']) : 'Subscription Name';  ?>(<?php echo $langval->language; ?>)</label>
                                <input class="form-control" type="text" placeholder="Free Trial" name="subscription_name_<?php echo $langval->id; ?>" id="subscription_name">
                            </div>
                        	<?php } ?>
                            <div class="form-group">
                                <label><?php echo(!empty($subscriptions['lg_admin_subscription_amount']))?($subscriptions['lg_admin_subscription_amount']) : 'Subscription Amount';  ?></label>
                                <input class="form-control sub-amount" type="number" step="0.01" min="0" name="amount" id="amount">
                            </div>
                            <div class="form-group">
                                <label><?php echo(!empty($subscriptions['lg_admin_subscription_durations']))?($subscriptions['lg_admin_subscription_durations']) : 'Subscription Durations';  ?></label>
								<select class="form-control select" name="duration" id="duration">
									<option value=""><?php echo(!empty($subscriptions['lg_admin_select_duration']))?($subscriptions['lg_admin_select_duration']) : 'Select Duration';  ?></option>
									<option value="0"><?php echo(!empty($subscriptions['lg_admin_one_day']))?($subscriptions['lg_admin_one_day']) : 'One Day';  ?></option>
									<option value="1"><?php echo(!empty($subscriptions['lg_admin_one_month']))?($subscriptions['lg_admin_one_month']) : 'One Month';  ?></option>
									<option value="3"><?php echo(!empty($subscriptions['lg_admin_3_months']))?($subscriptions['lg_admin_3_months']) : '3 Months';  ?></option>
									<option value="6"><?php echo(!empty($subscriptions['lg_admin_6_months']))?($subscriptions['lg_admin_6_months']) : '6 Months';  ?></option>
									<option value="12"><?php echo(!empty($subscriptions['lg_admin_one_year']))?($subscriptions['lg_admin_one_year']) : 'One Year';  ?></option>
									<option value="24"><?php echo(!empty($subscriptions['lg_admin_2_years']))?($subscriptions['lg_admin_2_years']) : '2 Years';  ?></option>
								</select>
                                <input type="hidden" name="subscription_description" id="subscription_description" value="">
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