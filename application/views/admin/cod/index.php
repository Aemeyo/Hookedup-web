<?php 
$cod = $language_content;
?>
<div class="page-wrapper">
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title"><?php echo(!empty($cod['lg_admin_cash_on_delivery']))?($cod['lg_admin_cash_on_delivery']) : 'Cash On Delivery';  ?></h3>
				</div>
				<div class="col-auto text-right d-none">
					<div class="col-sm-4 text-right m-b-20">
						<a href="<?php echo base_url().$theme . '/' . $model . '/create'; ?>" class="btn btn-primary add-button"><i class="fas fa-plus"></i></a>
					</div>
				
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		<?php
			if ($this->session->userdata('message')) {
				echo $this->session->userdata('message');
			}
			?>
		<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped table-actions-bar m-b-0 categories_table">
							<thead>
								<tr>
									<th><?php echo(!empty($cod['lg_admin_#']))?($cod['lg_admin_#']) : '#';  ?></th>
									<th><?php echo(!empty($cod['lg_admin_title']))?($cod['lg_admin_title']) : 'Title';  ?></th>
									<th><?php echo(!empty($cod['lg_admin_username']))?($cod['lg_admin_username']) : 'Usernames';  ?></th>
									<th><?php echo(!empty($cod['lg_admin_provider']))?($cod['lg_admin_provider']) : 'Provider';  ?></th>
									<th><?php echo(!empty($cod['lg_admin_amount']))?($cod['lg_admin_amount']) : 'Amount';  ?></th>
									<th><?php echo(!empty($cod['lg_admin_status']))?($cod['lg_admin_status']) : 'Status';  ?></th>
									<th><?php echo(!empty($cod['lg_admin_service_status']))?($cod['lg_admin_service_status']) : 'Service Status';  ?></th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (!empty($lists)) {
									$sno = 0;
									foreach ($lists as $row) {
										$badge='';
										if ($row['status']==0) {
											$badge='UnPaid';
											$color='danger';
										}
										if ($row['status']==1) {
											$badge='Paid';
											$color='success';
										}
										 $boorows = $this->db->where('id',$row['id'])->from('book_service')->get()->row_array();
										$bstatus = '';
										if($boorows['status'] == 1) {
                                            $bstatus = 'Pending';
										}
										elseif($boorows['status'] == 2) {
                                            $bstatus = 'Inprogress';
										}
										elseif($boorows['status'] == 3) {
                                            $bstatus = 'Complete Request to User';
										}
										elseif($boorows['status'] == 5&&empty($boorows['reject_paid_token'])) {
                                            $bstatus = 'Rejected by User';
										}
										elseif($boorows['status'] == 6) {
                                            $bstatus = 'Payment Completed';
										}
										elseif($boorows['status'] == 7&&empty($boorows['reject_paid_token'])) {
                                            $bstatus = 'Cancelled by Provider';
										} else if($boorows['status'] == 8) {
											$bstatus = 'Payment Completed';
										}

										$user_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
		                                $this->db->where('modules', 'user');
				                        if(!empty($rows['user_id'])){
				                        $this->db->where('name_id', $row['user_id']);
				                        }
				                        $this->db->where('lang_type', $user_lang);
				                        $lang_user = $this->db->get('users_lang')->row_array();

				                        $this->db->where('modules', 'provider');
				                        if(!empty($row['provider_id'])){
				                        $this->db->where('name_id', $row['provider_id']);
				                        }
				                        $this->db->where('lang_type', $user_lang);
				                        $lang_pro = $this->db->get('users_lang')->row_array();		

				                        $this->db->where('service_id', $row['service_id']);
                                    	$this->db->where('lang_type', $user_lang);
                                    	$service_name = $this->db->get('service_lang')->row_array();
                                    	$user_name = (!empty($lang_user['name'])) ? $lang_user['name'] : $row['username'];
                                    	$pro_name = (!empty($lang_pro['name'])) ? $lang_pro['name'] : $row['providername'];
				                        ?>
										<tr>
											<td> <?php echo ++$sno; ?></td>
											<td> <?php echo $service_name['service_name']; ?></td>
											<td> <?php echo $user_name; ?></td>
											<td> <?php echo $pro_name; ?></td>
											<td> <?php echo currency_conversion($row['currency_code']).$row['amount']; ?></td>
											<td> <?php echo '<label class="badge badge-'.$color.'">'.ucfirst($badge).'</lable>'; ?></td>
											<td><?php echo $bstatus;?></td>
										</tr>
									<?php
									}
								} else {
									?>
									<tr>
										<td colspan="7">
											<p class="text-center mb-0"><?php echo(!empty($cod['lg_admin_no_records_found']))?($cod['lg_admin_no_records_found']) : 'No Records Found';  ?></p>
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
</div>