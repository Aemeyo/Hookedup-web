<?php
    $query = $this->db->query("select * from system_settings WHERE status = 1");
    $result = $query->result_array();
    $this->website_name = '';
    $website_logo_front ='assets/img/logo.png';
    $this->db->where('modules', 'website');
    $this->db->where('lang_type', $this->session->userdata('lang'));
    $lang_website_check = $this->db->get('cookies')->row_array();
    if(!empty($result)) {
		foreach($result as $data){
			if($data['key'] == 'website_name'){
				$this->website_name = $lang_website_check['cookie_name'];
			}
			if($data['key'] == 'logo_front'){
				$website_logo_front =  $data['value'];
			}
		}
    }
    $Login = $language_content;
?>

<div class="login-page">
	<div class="login-body container">
		<div class="loginbox">
			<div class="login-right-wrap">
				<div class="account-header">
					<div class="account-logo text-center mb-4">
						<a href="<?php echo $base_url."admin"; ?>">
							<img src="<?php echo $base_url.$website_logo_front; ?>" alt="" class="img-fluid">
						</a>
					</div>
				</div>
				<div class="login-header">
					<h3><?php echo(!empty($Login['lg_admin_forgot_password']))?($Login['lg_admin_forgot_password']) : 'Forgot Password';  ?> <span><?php echo $this->website_name;?></span></h3>
					<p class="text-muted"><?php echo(!empty($Login['lg_admin_access_ourdashboard']))?($Login['lg_admin_access_ourdashboard']) : 'Access to our dashboard';  ?></p>
				</div>

				<?php if($this->session->flashdata('error_message')) {  ?>
				<div class="alert alert-danger text-center " id="flash_error_message"><?php echo $this->session->flashdata('error_message');?></div>
				<?php $this->session->unset_userdata('error_message');
				} ?>
				<?php if($this->session->flashdata('success_message')) {  ?>
				<div class="alert alert-success text-center" id="flash_succ_message"><?php echo $this->session->flashdata('success_message');?></div>
				<?php $this->session->unset_userdata('success_message');
				} ?>
				<form id="forgotpwdadmin" action="<?php echo $base_url; ?>/forgot_password" method="POST">
                   <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
					<div class="form-group">
						<label class="control-label"><?php echo(!empty($Login['lg_admin_email_id']))?($Login['lg_admin_email_id']) : 'Email ID';  ?></label>
						<input class="form-control" type="text" name="email" id="email" placeholder="Enter your Email ID">
						
						<span id="err_frpwd" ></span>
					</div>
					<div class="text-center">
						<button class="btn btn-primary btn-block account-btn" id="forgetpwdSubmit" type="submit"><?php echo(!empty($Login['lg_admin_submit']))?($Login['lg_admin_submit']) : 'Submit';  ?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>