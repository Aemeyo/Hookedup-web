<?php
$category = $this->db->where('status',1)->get('categories')->result_array();
$subcategory = $this->db->where('status',1)->get('subcategories')->result_array();
$subcategories = $language_content;
?>
<div class="page-wrapper">
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title"><?php echo(!empty($subcategories['lg_admin_sub_categories']))?($subcategories['lg_admin_sub_categories']) : 'Sub Categories';  ?></h3>
				</div>
				<div class="col-auto text-right">
					<a href="<?php echo $base_url; ?>subcategories" class="btn btn-primary add-button"><i class="fas fa-sync"></i></a>
					<a class="btn btn-white filter-btn mr-3" href="javascript:void(0);" id="filter_search">
						<i class="fas fa-filter"></i>
					</a>

					<a href="<?php echo $base_url; ?>add-subcategory" class="btn btn-primary add-button">
						<i class="fas fa-plus"></i>
					</a>
				
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		
		<!-- Search Filter -->
		<form action="<?php echo base_url()?>admin/categories/subcategories" method="post" id="filter_inputs">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
    
			<div class="card filter-card">
				<div class="card-body pb-0">
					<div class="row filter-row">
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($subcategories['lg_admin_category']))?($subcategories['lg_admin_category']) : 'Category';  ?></label>
								<select class="form-control" name="category" id="main_category">
									<option value=""><?php echo(!empty($subcategories['lg_admin_select_category']))?($subcategories['lg_admin_select_category']) : 'Select Category';  ?></option>
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
								<label><?php echo(!empty($subcategories['lg_admin_sub_category']))?($subcategories['lg_admin_sub_category']) : 'Sub Category';  ?></label>
								<select class="form-control" name="subcategory" id="service_subcategory">
									<option value=""><?php echo(!empty($subcategories['lg_admin_select_subcategory']))?($subcategories['lg_admin_select_subcategory']) : 'Select subcategory';  ?></option>
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
								<label><?php echo(!empty($subcategories['lg_admin_from_date']))?($subcategories['lg_admin_from_date']) : 'From Date';  ?></label>
								<div class="cal-icon">
									<input class="form-control start_date" type="text" name="from">
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($subcategories['lg_admin_to_date']))?($subcategories['lg_admin_to_date']) : 'To Date';  ?></label>
								<div class="cal-icon">
									<input class="form-control end_date" type="text" name="to">
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<button class="btn btn-primary btn-block" name="form_submit" value="submit" type="submit"><?php echo(!empty($subcategories['lg_admin_submit']))?($subcategories['lg_admin_submit']) : 'Submit';  ?></button>
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
							<table class="table table-hover table-center mb-0 categories_table" >
								<thead>
									<tr>
										<th><?php echo(!empty($subcategories['lg_admin_#']))?($subcategories['lg_admin_#']) : '#';  ?></th>
										<th><?php echo(!empty($subcategories['lg_admin_sub_category']))?($subcategories['lg_admin_sub_category']) : 'Sub Category';  ?></th>
										<th><?php echo(!empty($subcategories['lg_admin_subcategory_slug']))?($subcategories['lg_admin_subcategory_slug']) : 'Sub Category Slug';  ?></th>
										<th><?php echo(!empty($subcategories['lg_admin_category']))?($subcategories['lg_admin_category']) : 'Category';  ?></th>
										<th><?php echo(!empty($subcategories['lg_admin_date']))?($subcategories['lg_admin_date']) : 'Date';  ?></th>
										
										<th class="text-right"><?php echo(!empty($subcategories['lg_admin_action']))?($subcategories['lg_admin_action']) : 'Action';  ?></th>
									   
									</tr>
								</thead>
								<tbody>
								<?php
								if(!empty($list)) {
									$i=1;
								foreach ($list as $rows) {
								if($rows['status']==1) {
									$val='checked';
								}
								else {
									$val='';
								}
								if(!empty($rows['created_at'])){
									$date=date(settingValue('date_format'), strtotime($rows['created_at']));
								}else{
									$date='-';
								}
								$cat_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
								$this->db->where('category_id', $rows['category']);
					            $this->db->where('lang_type', $cat_lang);
							    $cat_name = $this->db->get('categories_lang')->row_array();

								$subcat_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
								$this->db->where('subcategory_id', $rows['id']);
					            $this->db->where('lang_type', $subcat_lang);
					            $subcat_name = $this->db->get('subcategories_lang')->row();
					            
								if($rows['subcategory_image'] != '' && (@getimagesize(base_url().$rows['subcategory_image']))){
									$sub_img='<img class="avatar-sm rounded mr-1" src="'.base_url().$rows['subcategory_image'].'"> '.$subcat_name->subcategory_name.'';
								}else{
									$sub_img='<img class="avatar-sm rounded mr-1" src="'.base_url().'assets/img/service-placeholder.jpg'.'"> '.$subcat_name->subcategory_name.'';
								}
								 
								echo'<tr>
								<td>'.$i++.'</td>
								<td>'.$sub_img.'</td>
								<td>'.$rows['subcategory_slug'].'</td>
								<td>'.$cat_name['category_name'].'</td>
								<td>'.$date.'</td>
								<td class="text-right"><a href="'.base_url().'edit-subcategory/'.$rows['id'].'" class="btn btn-sm bg-success-light mr-2"><i class="far fa-edit mr-1"></i>'.$subcategories['lg_admin_edit'].'</a>
									<a href="javascript:;" class="on-default remove-row btn btn-sm bg-danger-light mr-2 delete_subcategories" id="Onremove_'.$rows['id'].'" data-id="'.$rows['id'].'"><i class="far fa-trash-alt mr-1"></i> '.$subcategories['lg_admin_delete'].'</a>
									</td>
								</tr>';
							
								}
								}
								else
								{
								echo '<tr><td colspan="5"><div class="text-center text-muted">No records found</div></td></tr>';
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