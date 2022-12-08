<?php 
$rating = $language_content;
?>
<div class="page-wrapper">
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title"><?php echo(!empty($rating['lg_admin_rating_type']))?($rating['lg_admin_rating_type']) : 'Reviews Type';  ?></h3>
				</div>
				<div class="col-auto text-right">
					<a href="<?php echo $base_url; ?>add-reviews-type" class="btn btn-primary add-button">
						<i class="fas fa-plus"></i>
					</a>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		
		
		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
                        <div class="table-responsive">
                            <table class="table custom-table m-b-0 ratingstype_table" >
                                <thead>
                                    <tr>
                                        <th><?php echo(!empty($rating['lg_admin_#']))?($rating['lg_admin_#']) : '#';  ?></th>
                                        <th><?php echo(!empty($rating['lg_admin_rating_type']))?($rating['lg_admin_rating_type']) : 'Rating Type';  ?></th>  
                                      
                                        <th><?php echo(!empty($rating['lg_admin_status']))?($rating['lg_admin_status']) : 'Status';  ?></th>

                                        <th class="text-right"><?php echo(!empty($rating['lg_admin_action']))?($rating['lg_admin_action']) : 'Action';  ?></th>
                                    	
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i=1;
                                    foreach ($list as $rows) {
										if($rows['status']==1) {
											$val='checked';
										}
										else {
											$val='';
										}
										$rate_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
										$this->db->where('rating_id', $rows['id']);
							            $this->db->where('lang_type', $rate_lang);
							            $ratings_name = $this->db->get('rating_type_lang')->row_array();
										echo'<tr>
									    <td>'.$i++.'</td>
										<td>'.$ratings_name['rating_name'].'</td>
										<td><div class="status-toggle">
										<input id="status_'.$rows['id'].'" class="check change_Status_rating" data-id="'.$rows['id'].'" type="checkbox" '.$val.'>
											<label for="status_'.$rows['id'].'" class="checktoggle">checkbox</label>
											</div> </td>
											<td class="text-right"><a href="'.base_url().'edit-reviews-type/'.$rows['id'].'" class="table-action-btn btn btn-sm bg-success-light mr-2"><i class="far fa-edit mr-1"></i> '.$rating['lg_admin_edit'].'</a>
																		</td>
																		</tr>'; 
									} ?>
                                </tbody>
                            </table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>