<?php 
$admin_settings = $language_content;
?>
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title"><?php echo(!empty($admin_settings['lg_admin_paymentsettings']))?($admin_settings['lg_admin_paymentsettings']) : 'Payment Settings';  ?></h3>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

		<ul class="nav nav-tabs menu-tabs">
			<li class="nav-item ">
				<a class="nav-link" href="<?php echo base_url() . 'admin/stripe-payment-gateway'; ?>"><?php echo(!empty($admin_settings['lg_admin_stripe']))?($admin_settings['lg_admin_stripe']) : 'Stripe';  ?></a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" href="<?php echo base_url() . 'admin/razorpay-payment-gateway'; ?>"><?php echo(!empty($admin_settings['lg_admin_razorpay']))?($admin_settings['lg_admin_razorpay']) : 'Razorpay';  ?> </a>
			</li>
			<li class="nav-item ">
				<a class="nav-link" href="<?php echo base_url() . 'admin/paypal-payment-gateway'; ?>"><?php echo(!empty($admin_settings['lg_admin_paypal']))?($admin_settings['lg_admin_paypal']) : 'PayPal';  ?></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url() . 'admin/paystack-payment-gateway'; ?>"><?php echo(!empty($admin_settings['lg_admin_paystack']))?($admin_settings['lg_admin_paystack']) : 'Paystack';  ?></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url() . 'admin/paysolution-payment-gateway'; ?>"><?php echo(!empty($admin_settings['lg_admin_paysolution']))?($admin_settings['lg_admin_paysolution']) : 'Paysolution';  ?></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url() . 'admin/offlinepayment'; ?>">Bank Transfer</a>
			</li>
            <li class="nav-item">
				<a class="nav-link" href="<?php echo base_url() . 'admin/midtrans-payment-gateway'; ?>">Midtrans</a>
			</li>
            <li class="nav-item d-none">
				<a class="nav-link" href="<?php echo base_url() . 'admin/midtrans_payout_gateway'; ?>">Midtrans Payout</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url() . 'admin/cod-payment-gateway'; ?>"><?php echo(!empty($admin_settings['lg_admin_cod']))?($admin_settings['lg_admin_cod']) : 'COD';  ?></a>
			</li>
		</ul>

        <div class="row">
            <div class="col-lg-8">
				<form action="<?php echo base_url() . 'admin/settings/razor_edit/' . $list['id']; ?>" method="post">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col">
									<h4 class="card-title"><?php echo(!empty($admin_settings['lg_admin_razorpay']))?($admin_settings['lg_admin_razorpay']) : 'Razorpay';  ?></h4>
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
								</div>
								<div class="col-auto">
									<div class="status-toggle">
										<input class="check" name="razor_show" type="checkbox"   value="1" id="switch" <?php if($list['status']== 1) { ?>checked <?php } ?>>
										<label for="switch" class="checktoggle">checkbox</label>
									</div>
								</div>
							</div>
						</div> 
						<div class="card-body">
                            <div class="form-group">
                                <label><?php echo(!empty($admin_settings['lg_admin_razorpayoption']))?($admin_settings['lg_admin_razorpayoption']) : 'Razorpay Option';  ?></label>
                                <div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input razorpay_stripe_payment" id="sandbox" name="gateway_type" value="sandbox" type="radio" <?= ($list['gateway_type'] == "sandbox") ? 'checked' : '' ?> >
                                        <label class="custom-control-label" for="sandbox"><?php echo(!empty($admin_settings['lg_admin_sandbox']))?($admin_settings['lg_admin_sandbox']) : 'Sandbox';  ?></label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input razorpay_stripe_payment" id="livepaypal" name="gateway_type" value="live" type="radio"  <?= ($list['gateway_type'] == "live") ? 'checked' : '' ?> >
                                        <label class="custom-control-label" for="livepaypal"><?php echo(!empty($admin_settings['lg_admin_live']))?($admin_settings['lg_admin_live']) : 'Live';  ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><?php echo(!empty($admin_settings['lg_admin_gatewayname']))?($admin_settings['lg_admin_gatewayname']) : 'Gateway Name';  ?></label>
                                <input  type="text" id="gateway_name" name="gateway_name"  value="<?php if (!empty($list['gateway_name'])) {echo $list['gateway_name'];} ?>" class="form-control" placeholder="Gateway Name">
                            </div>
                            <div class="form-group">
                                <label><?php echo(!empty($admin_settings['lg_admin_apikey']))?($admin_settings['lg_admin_apikey']) : 'API Key';  ?></label>
                                <input type="text" id="api_key" name="api_key" value="<?php if (!empty($list['api_key'])) {echo $list['api_key'];} ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label><?php echo(!empty($admin_settings['lg_admin_restkey']))?($admin_settings['lg_admin_restkey']) : 'Rest Key';  ?></label>
                                <input type="text" id="value" name="value" value="<?php if (!empty($list['api_secret'])) {echo $list['api_secret'];} ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>RazorpayX Account number</label>
                                <input type="text" id="razorpayx_acc_number" name="razorpayx_acc_number" value="<?php if (!empty($list['razorpayx_acc_number'])) {echo $list['razorpayx_acc_number'];} ?>" class="form-control">
                            </div>
                            <div class="mt-4">
								<button class="btn btn-primary" name="form_submit" value="submit" type="submit"><?php echo(!empty($admin_settings['lg_admin_submit']))?($admin_settings['lg_admin_submit']) : 'Submit';  ?></button>
                                <a href="<?php echo base_url() . 'admin/razorpay-payment-gateway' ?>" class="btn btn-cancel m-l-5"><?php echo(!empty($admin_settings['lg_admin_cancel']))?($admin_settings['lg_admin_cancel']) : 'Cancel';  ?></a>
                            </div>
						</div>
					</div>
				</form>
            </div>
        </div>
    </div>
</div>
