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
			<li class="nav-item ">
				<a class="nav-link" href="<?php echo base_url() . 'admin/razorpay-payment-gateway'; ?>"><?php echo(!empty($admin_settings['lg_admin_razorpay']))?($admin_settings['lg_admin_razorpay']) : 'Razorpay';  ?> </a>
			</li>
			<li class="nav-item active">
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
				<form action="<?php echo base_url() . 'admin/settings/paypal_edit/' . $list['id']; ?>" method="post">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col">
									<h4 class="card-title"><?php echo(!empty($admin_settings['lg_admin_paypal']))?($admin_settings['lg_admin_paypal']) : 'PayPal';  ?></h4>
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
								</div>
								<div class="col-auto">
									<div class="status-toggle">
										<input class="check" name="paypal_show" type="checkbox"   value="1" id="switch" <?php if($list['status']== 1) { ?>checked <?php } ?>>
										<label for="switch" class="checktoggle">checkbox</label>
									</div>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label><?php echo(!empty($admin_settings['lg_admin_paypalgateway']))?($admin_settings['lg_admin_paypalgateway']) : 'Paypal Gateway';  ?></label>
								<div>
									<div class="custom-control custom-radio custom-control-inline">
										<input class="custom-control-input paypal_payment" id="paypal_sandbox" type="radio" required="" name="paypal_gateway" value="sandbox" <?= ($list['gateway_type'] == "sandbox") ? 'checked' : '' ?>>
										<label class="custom-control-label" for="paypal_sandbox"><?php echo(!empty($admin_settings['lg_admin_sandbox']))?($admin_settings['lg_admin_sandbox']) : 'Sandbox';  ?></label>
									</div>
									<div class="custom-control custom-radio custom-control-inline">
										<input class="custom-control-input paypal_payment" id="live_paypal" type="radio" required="" name="paypal_gateway" value="production" <?= ($list['gateway_type'] == "production") ? 'checked' : '' ?>>
									<label class="custom-control-label" for="live_paypal"><?php echo(!empty($admin_settings['lg_admin_live']))?($admin_settings['lg_admin_live']) : 'Live';  ?></label>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label><?php echo(!empty($admin_settings['lg_admin_braintree_tokenization']))?($admin_settings['lg_admin_braintree_tokenization']) : 'Braintree Tokenization key';  ?></label>
								<input class="form-control" type="text" name="braintree_key" id="braintree_key" value="<?php if (!empty($list['braintree_key'])) {echo $list['braintree_key'];} ?>" >
							</div>
							<div class="form-group">
								<label><?php echo(!empty($admin_settings['lg_admin_braintree_merchant']))?($admin_settings['lg_admin_braintree_merchant']) : 'Braintree Merchant ID';  ?></label>
								<input class="form-control" type="text" name="braintree_merchant" id="braintree_merchant" value="<?php if (!empty($list['braintree_merchant'])) {echo $list['braintree_merchant'];} ?>" >
							</div>
							<div class="form-group">
									<label><?php echo(!empty($admin_settings['lg_admin_braintree_publickey']))?($admin_settings['lg_admin_braintree_publickey']) : 'Braintree Public key';  ?></label>
								<input class="form-control" type="text" name="braintree_publickey" id="braintree_publickey" value="<?php if (!empty($list['braintree_publickey'])) {echo $list['braintree_publickey'];} ?>" >
							</div>
							<div class="form-group">
									<label><?php echo(!empty($admin_settings['lg_admin_braintree_privatekey']))?($admin_settings['lg_admin_braintree_privatekey']) : 'Braintree Private key';  ?></label>
								<input class="form-control" type="text" name="braintree_privatekey" id="braintree_privatekey" value="<?php if (!empty($list['braintree_privatekey'])) {echo $list['braintree_privatekey'];} ?>" >
							</div>
							<div class="form-group">
									<label><?php echo(!empty($admin_settings['lg_admin_paypal_appid']))?($admin_settings['lg_admin_paypal_appid']) : 'Paypal APP ID';  ?></label>
								<input class="form-control" type="text" name="paypal_appid" id="paypal_appid" value="<?php if (!empty($list['paypal_appid'])) {echo $list['paypal_appid'];} ?>">
							</div>
							<div class="form-group">
									<label><?php echo(!empty($admin_settings['lg_admin_paypal_secretkey']))?($admin_settings['lg_admin_paypal_secretkey']) : 'Paypal Secret Key';  ?></label>
								<input class="form-control" type="text" name="paypal_appkey" id="paypal_appkey" value="<?php if (!empty($list['paypal_appkey'])) {echo $list['paypal_appkey'];} ?>" >
							</div>
                            <div class="mt-4">
								<button class="btn btn-primary" name="form_submit" value="submit" type="submit"><?php echo(!empty($admin_settings['lg_admin_submit']))?($admin_settings['lg_admin_submit']) : 'Submit';  ?></button>
                                <a href="<?php echo base_url() . 'admin/paypal-payment-gateway' ?>" class="btn btn-cancel m-l-5"><?php echo(!empty($admin_settings['lg_admin_cancel']))?($admin_settings['lg_admin_cancel']) : 'Cancel';  ?></a>
                            </div>
						</div>
					</div>
				</form>
            </div>
        </div>
    </div>
</div>
