<div class="page-wrapper">
    <div class="content container-fluid">
    
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title"><?php echo(!empty($booking['lg_comments_list']))?($booking['lg_comments_list']) : 'Comments List';  ?></h3>
                </div>
                <div class="col-auto text-right">
                    <a class="btn btn-white filter-btn mr-3" href="javascript:void(0);" id="filter_search">
                        <i class="fas fa-filter"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <!-- Search Filter -->
		<form action="<?php echo base_url()?>admin/blog-comments" method="post" id="filter_inputs">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
    
			<div class="card filter-card">
				<div class="card-body pb-0">
					<div class="row filter-row">
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($booking['lg_admin_user_name']))?($booking['lg_admin_user_name']) : 'User Name';  ?></label>
								<select class="form-control" name="user_id">
									<option value="">
                                        <?php echo(!empty($booking['lg_admin_select_user']))?($review_report['lg_admin_select_user']) : 'Select User';  ?>
                                    </option>
									<?php
                                        
                                        foreach ($user_list as $pro) { 
                                            
										$user_lang = ($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
				                        $this->db->where('modules', 'user');
				                        if (!empty($pro['id'])) {
				                        $this->db->where('name_id', $pro['id']);
				                        }
				                        $this->db->where('lang_type', $user_lang);
				                        $lang_user = $this->db->get('users_lang')->row_array();
                                       
									?>
									<option value="<?=$pro['id']?>"><?php echo ucfirst( $pro['name']);?></option>
									<?php  } ?>
								</select>
							</div>
						</div>
						<!-- <div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($booking['lg_admin_comments']))?($booking['lg_admin_comments']) : 'Comments';  ?></label>
								<select class="form-control" name="comment_id">
									<option value=""><?php echo(!empty($booking['lg_admin_select_comments']))?($booking['lg_admin_select_comments']) : 'Select Comments';  ?></option>
									<?php foreach ($comments as $com) { ?>
									<option value="<?=$com['id']?>"><?php echo $com['comment']?></option>
									<?php } ?>
								</select>
							</div>
						</div> -->
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($booking['lg_admin_from_date']))?($booking['lg_admin_from_date']) : 'From Date';  ?></label>
								<div class="cal-icon">
									<input class="form-control start_date" type="text" name="from">
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label><?php echo(!empty($booking['lg_admin_to_date']))?($booking['lg_admin_to_date']) : 'To Date';  ?></label>
								<div class="cal-icon">
									<input class="form-control end_date" type="text" name="to">
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<button class="btn btn-primary btn-block" name="form_submit" value="submit" type="submit"><?php echo(!empty($booking['lg_admin_submit']))?($booking['lg_admin_submit']) : 'Submit';  ?></button>
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
                        <div class="table-responsive total-booking-report">
                            <table class="table table-hover table-center mb-0 blogcategories_table">
                                <thead>
                                    <tr>
                                        <th><?php echo(!empty($booking['lg_admin_#']))?($booking['lg_admin_#']) : '#';  ?></th>
                                        <th><?php echo(!empty($booking['lg_name']))?($booking['lg_name']) : 'Name';  ?></th>
                                        <th><?php echo(!empty($booking['lg_email']))?($booking['lg_email']) : 'Email';  ?></th>
                                        <th><?php echo(!empty($booking['lg_comments']))?($booking['lg_comments']) : 'Comments';  ?></th>
                                        <th><?php echo(!empty($booking['lg_created_at']))?($booking['lg_created_at']) : 'Created At';  ?></th>
                                        <th><?php echo(!empty($booking['lg_admin_action']))?($booking['lg_admin_action']) : 'Action';  ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(!empty($list)) {

                                    $i=1;
                                    foreach ($list as $rows) {
                                    $badge='';
                                    if ($rows['status']==1) {
                                        $badge='Approved';
                                        $color='green';
                                        $status = $badge;
                                    }
                                    if ($rows['status']==2) {
                                        $badge='Deleted';
                                        $color='danger';
                                        $status = $badge;
                                    } 
                                    if ($rows['status']==3) {
                                        $badge='Rejected';
                                        $color='danger';
                                        $status = $badge;
                                    }
                                    ?>
                                    
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $rows['name']; ?></td>
                                        <td><?php echo $rows['email']; ?></td>
                                        <td><?php echo wordwrap($rows['comment'], 60, '<br />', true);?></td>
                                        <td><?php echo $rows['created_at']; ?></td>
                                        <td> 
                                            <?php if($rows['status'] == 0) { ?>
                                                <select class="form-control commentstatus" name="comment_status" data-id="<?php echo $rows['id']; ?>">
                                                    <option value="">Select Status</option>
                                                    <option value="1">Approved</option>
                                                    <option value="3">Rejected</option>
                                                </select>
                                            <?php } else {  
                                                echo $status; 
                                            } ?>
                                        </td>
                                    </tr>
                                    <?php } 
                                    } else {
                                    ?>
                                    <tr>
                                        <td colspan="9">
                                            <div class="text-center text-muted"><?php echo(!empty($booking['lg_admin_no_records_found']))?($booking['lg_admin_no_records_found']) : 'No Records Found';  ?></div>
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