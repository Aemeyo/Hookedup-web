<?php
	$category = $this->db->where('status',1)->get('categories')->result_array();
	$subcategory = $this->db->where('status',1)->get('subcategories')->result_array();
	$services = $this->db->get('services')->result_array();
	$service_list = $language_content;

?>
<div class="page-wrapper">
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title"><?php echo(!empty($service_list['lg_admin_services']))?($service_list['lg_admin_services']) : 'Services';  ?></h3>
				</div>
				<div class="col-auto text-right">
					<a href="<?php echo $base_url; ?>service-list" class="btn btn-primary add-button"><i class="fas fa-sync"></i></a>
					<a class="btn btn-white filter-btn mr-3" href="javascript:void(0);" id="filter_search">
						<i class="fas fa-filter"></i>
					</a>
					<a href="<?php echo $base_url; ?>admin/add-service" class="btn btn-primary add-button"><i class="fas fa-plus"></i></a>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		
		<!-- Search Filter -->
		<form action="<?php echo base_url()?>service-list" method="post" id="filter_inputs">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
    
			<div class="card filter-card">
				<div class="card-body pb-0">
					<div class="row filter-row">
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($service_list['lg_admin_category']))?($service_list['lg_admin_category']) : 'Category';  ?></label>
								<select class="form-control" name="category" id="service_category">
									<option value=""><?php echo(!empty($service_list['lg_admin_select_category']))?($service_list['lg_admin_select_category']) : 'Select category';  ?></option>
									<?php foreach ($category as $cat) { 
										$cat_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
										$this->db->where('category_id', $cat['id']);
							            $this->db->where('lang_type', $cat_lang);
							            $cat_name = $this->db->get('categories_lang')->row_array();
									?>
									<option value="<?=$cat['id']?>"><?php echo $cat_name['category_name']?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($service_list['lg_admin_sub_category']))?($service_list['lg_admin_sub_category']) : 'Sub Category';  ?></label>
								<select class="form-control" name="subcategory" id="service_subcategory">
									<option value=""><?php echo(!empty($service_list['lg_admin_select_subcategory']))?($service_list['lg_admin_select_subcategory']) : 'Select subcategory';  ?></option>
									<?php foreach ($subcategory as $sub_category) { 
										$subcat_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
										$this->db->where('subcategory_id', $sub_category['id']);
							            $this->db->where('lang_type', $subcat_lang);
							            $subcat_name = $this->db->get('subcategories_lang')->row_array();
									?>
									<option value="<?=$sub_category['id']?>"><?php echo $subcat_name['subcategory_name']?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($service_list['lg_admin_service_title']))?($service_list['lg_admin_service_title']) : 'Service Title';  ?></label>
								<select class="form-control" name="service_title" id="service_title">
									<option value=""><?php echo(!empty($service_list['lg_admin_select_service']))?($service_list['lg_admin_select_service']) : 'Select Service';  ?></option>
									<?php foreach ($services as $pro) { 
										$ser_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
	                                    $this->db->where('service_id', $pro['id']);
	                                    $this->db->where('lang_type', $ser_lang);
	                                    $service_name = $this->db->get('service_lang')->row_array();
									?>
									<option value="<?=$pro['id']?>"><?php echo $service_name['service_name']?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($service_list['lg_admin_from_date']))?($service_list['lg_admin_from_date']) : 'From Date';  ?></label>
								<div class="cal-icon">
									<input class="form-control start_date" type="text" name="from">
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($service_list['lg_admin_to_date']))?($service_list['lg_admin_to_date']) : 'To Date';  ?></label>
								<div class="cal-icon">
									<input class="form-control end_date" type="text" name="to">
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<button class="btn btn-primary btn-block" name="form_submit" value="submit" type="submit"><?php echo(!empty($service_list['lg_admin_submit']))?($service_list['lg_admin_submit']) : 'Submit';  ?></button>
							</div>
						</div>
					</div>

				</div>
			</div>
		</form>
		<!-- /Search Filter -->
		<div class="status-toggle mb-3 d-flex">
			<label class="mr-2"><?php echo(!empty($service_list['lg_admin_auto_approval']))?($service_list['lg_admin_auto_approval']) : 'Auto Approval';  ?></label>
			<input id="auto_approval" class="check change_auto_approval_status" type="checkbox"<?php echo (settingValue('auto_approval') == 1)?'checked':''; ?>>
			<label for="auto_approval" class="checktoggle">checkbox</label>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover table-center mb-0 service_table">
                                <thead>
                                    <tr>
                                        <th><?php echo(!empty($service_list['lg_admin_#']))?($service_list['lg_admin_#']) : '#';  ?></th>
                                        <th><?php echo(!empty($service_list['lg_admin_services']))?($service_list['lg_admin_services']) : 'Services';  ?></th>
                                        <th><?php echo(!empty($service_list['lg_admin_category']))?($service_list['lg_admin_category']) : 'Category';  ?></th>
                                        <th><?php echo(!empty($service_list['lg_admin_sub_category']))?($service_list['lg_admin_sub_category']) : 'Sub Category';  ?></th>
                                        <th><?php echo(!empty($service_list['lg_admin_amount']))?($service_list['lg_admin_amount']) : 'Amount';  ?></th>
                                        <th><?php echo(!empty($service_list['lg_admin_date']))?($service_list['lg_admin_date']) : 'Date';  ?></th>
                                        <th><?php echo(!empty($service_list['lg_admin_status']))?($service_list['lg_admin_status']) : 'Status';  ?></th>
                                        <th>CreatedBy</th>
                                        <th><?php echo(!empty($service_list['lg_admin_action']))?($service_list['lg_admin_action']) : 'Action';  ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(!empty($list)) {
									$i=1;
									foreach ($list as $rows) {
									$ser_image='';
									$service_img=$this->db->where('service_id',$rows['id'])->get('services_image')->row();
									if(!empty($service_img->service_image)){
										$ser_image=$service_img->service_image;
									}
									
									$avail=$this->service->check_booking_list($rows['id']);
									if($avail==0){
                                        $attr='';
                                        $tag='';
									}else{
                                        $attr='disabled';
                                        $tag='data-toggle="tooltip" title="Some One was Booked The Service So You Cannot Modified It ..!"';
									}
									if(!empty($rows['created_at'])){
										$date=date(settingValue('date_format'), strtotime($rows['created_at']));
									}else{
										$date='-';
									}


									if($rows['status']==1) {
									
										$val='checked';
									}
									else {
										$val='';
									}

									$user_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
			                        $this->db->where('category_id', $rows['category']);
			                        $this->db->where('lang_type', $user_lang);
			                        $cat_name = $this->db->get('categories_lang')->row_array();

			                        $this->db->where('subcategory_id', $rows['subcategory']);
			                        $this->db->where('lang_type', $user_lang);
			                        $subcat_name = $this->db->get('subcategories_lang')->row_array();	

                                    $this->db->where('service_id', $rows['id']);
                                    $this->db->where('lang_type', $user_lang);
                                    $service_name = $this->db->get('service_lang')->row_array();
                                    
									if($user_role==1){
									echo'<tr>
                                        <td>'.$i++.'</td>
                                        <td><a href="'.base_url().'service-details/'.$rows['id'].'"><img class="rounded service-img mr-1" src="'.base_url().$ser_image.'" alt=""> '.$service_name['service_name'].'</a></td>                                       
                                        <td>'.$cat_name['category_name'].'</td>
                                        <td>'.$subcat_name['subcategory_name'].'</td>
                                        <td>'.currency_code_sign(settings('currency')).''.$rows['service_amount'].'</td>
                                        <td>'.$date.'</td>
                                        <td>
											<div '.$tag.'>
												<div class="status-toggle">
													<input id="status_'.$rows['id'].'" class="check change_Status_Service" data-id="'.$rows['id'].'" type="checkbox" '.$val.'>
													<label for="status_'.$rows['id'].'" class="checktoggle">checkbox</label>
												</div>
											</div>
                                        </td>
                                        <td>'.$rows['created_by'].'</td>
										<td> 
											<a href="'.base_url().'service-edit/'.$rows['id'].'" class="btn btn-sm bg-success-light mr-2">
												<i class="far fa-edit mr-1"></i> '.$service_list['lg_admin_edit'].'
											</a>
											<a href="'.base_url().'service-details/'.$rows['id'].'" class="btn btn-sm bg-info-light">
												<i class="far fa-eye mr-1"></i> '.$service_list['lg_admin_view'].'
											</a>
											<a href="javascript:;" class="on-default remove-row btn btn-sm bg-danger-light mr-2 delete_services" id="Onremove_'.$rows['id'].'" data-id="'.$rows['id'].'"><i class="far fa-trash-alt mr-1"></i> '.$service_list['lg_admin_delete'].'</a></td>
										</td>
									</tr>';
								}else{
										echo'<tr>
                                        <td>'.$i++.'</td>
                                        <td><a href="'.base_url().'service-details/'.$rows['id'].'"><img class="rounded service-img mr-1" src="'.base_url().$ser_image.'" alt=""> '.$rows['service_title'].'</a></td>                                       
                                        <td>'.$rows['category_name'].'</td>
                                        <td>'.$rows['subcategory_name'].'</td>
                                        <td>$'.$rows['service_amount'].'</td>
                                        <td>'.$date.'</td>
                                        <td>
											<div '.$tag.'>
												<div class="status-toggle">
													<input id="status_'.$rows['id'].'" class="check change_Status_Service" data-id="'.$rows['id'].'" type="checkbox" '.$val.'>
													<label for="status_'.$rows['id'].'" class="checktoggle">checkbox</label>
												</div>
											</div>
                                        </td>
                                        <td>'.$rows['created_by'].'</td>
										<td> 
											<a href="'.base_url().'service-details/'.$rows['id'].'" class="btn btn-sm bg-info-light">
												<i class="far fa-eye mr-1"></i> '.$service_list['lg_admin_view'].'
											</a>
										</td>
									</tr>';
								}
									} } else {
                                    ?>
									<tr>
										<td colspan="9">
											<div class="text-center text-muted"><?php echo(!empty($service_list['lg_admin_no_records_found']))?($service_list['lg_admin_no_records_found']) : 'No Records Found';  ?></div>
										</td>
									</tr>
									<?php } ?>
                                </tbody>
                            </table>
						</div> 
					</div> 
				</div>
			</div>
		</div>
	</div>
</div>