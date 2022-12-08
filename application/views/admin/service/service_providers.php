<?php
   $user_details = $this->db->get('providers')->result_array();
   $service_providers = $language_content;
?>
<div class="page-wrapper">
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title"><?php echo(!empty($service_providers['lg_admin_service_providers']))?($service_providers['lg_admin_service_providers']) : 'Service Providers';  ?></h3>
				</div>
				<div class="col-auto text-right">
					<a class="btn btn-white filter-btn mr-3" href="javascript:void(0);" id="filter_search">
						<i class="fas fa-filter"></i>
					</a>
					<a href="<?php echo base_url().'providers/edit/'; ?>" class="btn btn-primary add-button"><i class="fas fa-plus"></i></a>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		
		<!-- Search Filter -->
		<form action="<?php echo base_url()?>admin/service/provider_list" method="post" id="filter_inputs">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
    

			<div class="card filter-card">
				<div class="card-body pb-0">
					<div class="row filter-row">
					
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($service_providers['lg_admin_provider_name']))?($service_providers['lg_admin_provider_name']) : 'Provider Name';  ?></label>
								<select class="form-control" name="username">
									<option value="">Select provider name</option>
									<?php foreach ($user_details as $user) { 
										$pro_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
										$this->db->where('modules', 'provider');
										if (!empty($user['id'])) {
								        $this->db->where('name_id', $user['id']);
								        }
								        $this->db->where('lang_type', $pro_lang);
								        $pro_name = $this->db->get('users_lang')->row_array();
									?>
									<option value="<?=$user['name']?>"><?php echo $pro_name['name']?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($service_providers['lg_admin_email']))?($service_providers['lg_admin_email']) : 'Email';  ?></label>
								<select class="form-control" name="email">
									<option value=""><?php echo(!empty($service_providers['lg_admin_select_email']))?($service_providers['lg_admin_select_email']) : 'Select Email';  ?></option>
									<?php foreach ($user_details as $user) { ?>
									<option value="<?=$user['email']?>"><?php echo $user['email']?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($service_providers['lg_admin_from_date']))?($service_providers['lg_admin_from_date']) : 'From Date';  ?></label>
								<div class="cal-icon">
									<input class="form-control start_date" type="text" name="from">
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($service_providers['lg_admin_to_date']))?($service_providers['lg_admin_to_date']) : 'To Date';  ?></label>
								<div class="cal-icon">
									<input class="form-control end_date" type="text" name="to">
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<button class="btn btn-primary btn-block" name="form_submit" value="submit" type="submit"><?php echo(!empty($service_providers['lg_admin_submit']))?($service_providers['lg_admin_submit']) : 'Submit';  ?></button>
							</div>
						</div>
					</div>

				</div>
			</div>
		</form>
		<!-- /Search Filter -->
		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
                        <div class="table-responsive">
                            <table class="table custom-table mb-0 w-100 providers_table" id="providers_table">
                                <thead>
                                    <tr>
                                        <th><?php echo(!empty($service_providers['lg_admin_#']))?($service_providers['lg_admin_#']) : '#';  ?></th>
                                        <th><?php echo(!empty($service_providers['lg_admin_provider_name']))?($service_providers['lg_admin_provider_name']) : 'Provider Name';  ?></th>
                                        <th><?php echo(!empty($service_providers['lg_admin_contact_no']))?($service_providers['lg_admin_contact_no']) : 'Contact No';  ?></th>
                                        <th><?php echo(!empty($service_providers['lg_admin_email']))?($service_providers['lg_admin_email']) : 'Email';  ?></th>
                                        <th><?php echo(!empty($service_providers['lg_admin_reg_date']))?($service_providers['lg_admin_reg_date']) : 'Reg Date';  ?></th>
										<th><?php echo(!empty($service_providers['lg_admin_subscription']))?($service_providers['lg_admin_subscription']) : 'Subscription';  ?></th>
										<th><?php echo(!empty($service_providers['lg_admin_status']))?($service_providers['lg_admin_status']) : 'Status';  ?></th>
                                    	<th><?php echo(!empty($service_providers['lg_admin_action']))?($service_providers['lg_admin_action']) : 'Action';  ?></th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
									if(!empty($lists)) {

									$i=1;
									foreach ($lists as $rows) {
										if($rows['status']==1) {
											$val='checked';
											$tag='data-toggle="tooltip" title="Click to Deactivate Provider ..!"';
										}
										else {
											$val='';
											$tag='data-toggle="tooltip" title="Click to Activate Provider ..!"';
										}
										$profile_img = $rows['profile_img'];

										$avail=$this->service->check_booking_list($rows['id']);
										if($avail==0){
	                                        $attr='';
	                                        $tag='';
										}else{
	                                        $attr='disabled';
	                                        $tag='data-toggle="tooltip" title="Some One was Booked The Service So You Cannot Modified It ..!"';
										}
										if(empty($profile_img)){
											$profile_img ='assets/img/user.jpg';
										}
										if(!empty($rows->created_at)){
                                            $date=date('d-m-Y',strtotime($rows->created_at));
										}else{
                                            $date='-';
										}
										
										echo'<tr>
											<td>'.$i++.'</td>
											<td><h2 class="table-avatar"><a href="#" class="avatar avatar-sm mr-2"> <img class="avatar-img rounded-circle" src="'.base_url().$profile_img.'"></a>
											<a href="'.base_url().'user-details/'.$rows['id'].'">'.str_replace('-', ' ', $rows['name']).'</a></h2></td>
											<td>'.$rows['mobileno'].'</td>
											<td>'.$rows['email'].'</td>
											<td>'.$date.'</td>
											<td>'.$rows['subscription_name'].'</td>
											<td>
											<div '.$tag.'>
												<div class="status-toggle mb-2">
													<input '.$attr.' disabled id="status_'.$rows['id'].'" class="check change_Status_provider1" data-id="'.$rows['id'].' type="checkbox" '.$val.'>
													<label for="status_'.$rows['id'].'" class="checktoggle">checkbox</label>
												</div>
											</div>
                                            </td>
                                            <td>
											<a href="javascript:;" class="on-default remove-row btn btn-sm bg-danger-light mr-2 delete_provider_data" id="Onremove_'.$rows['id'].'" data-id="'.$rows['id'].'"><i class="far fa-trash-alt mr-1"></i> Delete</a>
											</td>
										</tr>';
									}
                                    }
                                    else {
                                      echo '<tr><td colspan="6"><div class="text-center text-muted">No records found</div></td></tr>';
                                    }
									?>
                                </tbody>
                            </table>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>