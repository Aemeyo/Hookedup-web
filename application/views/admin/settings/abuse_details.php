<?php 
$abuse = $language_content;

$user_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
$this->db->where('modules', 'user');
$this->db->where('name_id', $list[0]['report_user_id']);
$this->db->where('lang_type', $user_lang);
$user_name = $this->db->get('users_lang')->row_array();

$this->db->where('modules', 'provider');
$this->db->where('name_id', $list[0]['pro_id']);
$this->db->where('lang_type', $user_lang);
$pro_name = $this->db->get('users_lang')->row_array();
?>

<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="row">
			<div class="col-xl-8 offset-xl-2">
			
				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col-sm-6">
							<h3 class="page-title">Abuse Details</h3>
						</div>
						<div class="col-sm-6">
							<div class="text-right mb-3">
								<a href="<?php echo $base_url; ?>admin/abuse-reports" class="btn btn-primary"><?php echo(!empty($abuse['lg_admin_back']))?($abuse['lg_admin_back']) : 'Back';  ?></a>
							</div>
						</div>

					</div>
				</div>
				<!-- /Page Header -->
				
				<div class="card">
					<div class="card-body">
                        <div class="form-group">
							<h5><?php echo(!empty($abuse['lg_admin_provider_name']))?($abuse['lg_admin_provider_name']) : 'Name';  ?></h5>
							<label><?php echo $pro_name['name']; ?></label>
							
						</div>
						
						<div class="form-group">
							<h5><?php echo(!empty($abuse['lg_admin_username']))?($abuse['lg_admin_username']) : 'User name';  ?></h5>
							<label><?php echo $user_name['name']; ?></label>
							
						</div>
						
						<div class="form-group">
							<h5><?php echo(!empty($abuse['lg_admin_descriptions']))?($abuse['lg_admin_descriptions']) : 'descriptions';  ?></h5>
							<label><?php echo $list[0]['description']; ?></label>
							
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	