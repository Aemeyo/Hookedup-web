<?php 
$user_id = $this->uri->segment('2');
$user_details = $this->db->where('user_id',$user_id)->get('administrators')->row_array();

$this->db->select('tab_2.module_name')->from('admin_access tab_1');
$access_result_data=$this->db->where('tab_1.admin_id',$user_id)->where('tab_1.access',1)->join('admin_modules tab_2','tab_2.id=tab_1.module_id','INNER')->get()->result_array();

$access_result_data_array = array_column($access_result_data, 'module_name');
$access_result_data_details = implode(", ",$access_result_data_array);
$adminuser = $language_content;
?>
<div class="page-wrapper">
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title"><?php echo(!empty($adminuser['lg_admin_adminusers_details']))?($adminuser['lg_admin_adminusers_details']) : 'AdminUsers Details';  ?></h3>
				</div>
				<div class="text-right mb-3">
					<a href="<?php echo base_url()?>adminusers" class="btn btn-primary float-end"><?php echo(!empty($adminuser['lg_admin_back']))?($adminuser['lg_admin_back']) : 'Back';  ?></a>		
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		
		<div class="row">
			<div class="col-lg-4">
				<div class="card">
					<div class="card-body text-center">
						<?php if($user_details['profile_img'] != '')
						{?>
						<img class="rounded-circle img-fluid mb-3" alt="User Image" src="<?php echo $base_url.$user_details['profile_img'] ?>">
						<?php } else { ?>
						<img class="rounded-circle img-fluid mb-3" alt="User Image" src="<?php echo $base_url?>assets/img/user.jpg">
						<?php } ?>
					</div>
				</div>
			</div>
			
			<div class="col-lg-8">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title d-flex justify-content-between">
							<span><?php echo(!empty($adminuser['lg_admin_personal_details']))?($adminuser['lg_admin_personal_details']) : 'Personal Details';  ?></span>
						</h5>
						<div class="row">
							<p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3"><?php echo(!empty($adminuser['lg_admin_name']))?($adminuser['lg_admin_name']) : 'Name';  ?></p>
							<?php 
								$user_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
		                        $this->db->where('modules', 'admin');
		                        $this->db->where('name_id', $user_details['user_id']);
		                        $this->db->where('lang_type', $user_lang);
		                        $lang_admin = $this->db->get('users_lang')->row_array();
							?>
							<p class="col-sm-9"><?php echo $lang_admin['name']?></p>
						</div>
						<div class="row">
							<p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3"><?php echo(!empty($adminuser['lg_admin_user_name']))?($adminuser['lg_admin_user_name']) : 'Username';  ?></p>
							<p class="col-sm-9"><?php echo $user_details['username']?></p>
						</div>
						<div class="row">
							<p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3"><?php echo(!empty($adminuser['lg_admin_access_modules']))?($adminuser['lg_admin_access_modules']) : 'Access Modules';  ?></p>
							<p class="col-sm-9"><?php echo $access_result_data_details?></p>
						</div>
					</div>
				</div>                      
			</div>
		</div>
	</div>
</div>