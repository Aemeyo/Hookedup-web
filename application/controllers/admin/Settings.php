<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        error_reporting(0);
        $this->load->model('admin_model', 'admin');
        $this->load->model('service_model', 'service');
        $this->load->model('Api_model','api');
		$this->load->model('common_model','common_model');
        $this->load->model('language_model', 'language');
        $this->data['theme'] = 'admin';
        $this->data['model'] = 'settings';
        $this->data['base_url'] = base_url();
        $this->load->helper('user_timezone_helper');
        $this->load->helper('custom_language');
        /*$lang = !empty($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
        $this->data['language_content'] = get_admin_languages($lang);*/

        $langs = !empty($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
        $lang = $this->db->get_where('language', array('language_value'=>$langs))->row()->language;
        $this->data['language_content'] = $this->lang->load('content', strtolower($lang), true);
        $this->language = $this->lang->load('content', strtolower($lang), true);
        
        $this->data['user_role'] = $this->session->userdata('role');
        $this->data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $last_uri = end($this->uri->segment_array());
        $this->db->where('id', $last_uri);
        $pages_name = $this->db->get('page_content')->row();
        $this->db->where('modules', $pages_name->modules);
        $page_names = $this->db->get('home_settings')->result_array();
        $this->load->helper('ckeditor');

         $this->data['ckeditor_editor1'] = array
        (
            //id of the textarea being replaced by CKEditor
            'id'   => 'ck_editor_textarea_id',
            // CKEditor path from the folder on the root folder of CodeIgniter
            'path' => 'assets/js/ckeditor',
            // optional settings
            'config' => array
            (
                'toolbar' => "Full",
                'filebrowserBrowseUrl'      => base_url().'assets/js/ckfinder/ckfinder.html',
                'filebrowserImageBrowseUrl' => base_url().'assets/js/ckfinder/ckfinder.html?Type=Images',
                'filebrowserFlashBrowseUrl' => base_url().'assets/js/ckfinder/ckfinder.html?Type=Flash',
                'filebrowserUploadUrl'      => base_url().'assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                'filebrowserImageUploadUrl' => base_url().'assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                'filebrowserFlashUploadUrl' => base_url().'assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
            )
        );  

        $this->data['page_names'] = $page_names;
         $this->data['ckeditor_editor_2'] = array(
            'id'   => 'ck_editor_textarea_id2',
            'class'   => 'content-textarea',
            'path' => 'assets/js/ckeditor',
            'config' => array(
                'toolbar'                   => "Full",
                'filebrowserBrowseUrl'      => base_url() . 'assets/js/ckfinder/ckfinder.html',
                'filebrowserImageBrowseUrl' => base_url() . 'assets/js/ckfinder/ckfinder.html?Type=Images',
                'filebrowserFlashBrowseUrl' => base_url() . 'assets/js/ckfinder/ckfinder.html?Type=Flash',
                'filebrowserUploadUrl'      => base_url() . 'assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                'filebrowserImageUploadUrl' => base_url() . 'assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                'filebrowserFlashUploadUrl' => base_url() . 'assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
            )
        );

        $this->data['ckeditor_editor_1'] = array(
            'id'   => 'ck_editor_textarea_id1',
            'path' => 'assets/js/ckeditor',
            'config' => array(
                'toolbar'                   => "Full",
                'filebrowserBrowseUrl'      => base_url() . 'assets/js/ckfinder/ckfinder.html',
                'filebrowserImageBrowseUrl' => base_url() . 'assets/js/ckfinder/ckfinder.html?Type=Images',
                'filebrowserFlashBrowseUrl' => base_url() . 'assets/js/ckfinder/ckfinder.html?Type=Flash',
                'filebrowserUploadUrl'      => base_url() . 'assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                'filebrowserImageUploadUrl' => base_url() . 'assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                'filebrowserFlashUploadUrl' => base_url() . 'assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
            )
        );


        
    }
    
    public function aboutus($id) {

		$this->common_model->checkAdminUserPermission(24);
        $title = $this->input->post('page_title');
        $this->data['about_us'] = $this->admin->aboutussettings();
        if($this->input->post("form_submit") == true) {
            $this->common_model->checkAdminLogin();
                $post_data = $this->input->post();
                $query = $this->db->query("select * from language WHERE status = '1'");
                $languages = $query->result();
                foreach ($languages as $language) {
                    $about_val = array(
                        'modules' => 'about_us',
                        'title' => $this->input->post('page_title_' . $language->id, true),
                        'content' => $this->input->post('page_content_' . $language->id, true),
                        'lang_type' => $language->language_value
                    );
                    $this->db->where('modules', 'about_us');
                    $this->db->where('lang_type', $language->language_value);
                    $row = $this->db->get('home_settings')->row();
                    if (empty($row)) {
                        $this->db->insert('home_settings', $about_val);
                    } else {
                        $this->db->where('modules', 'about_us');
                        $this->db->where('lang_type', $language->language_value);
                        $this->db->update('home_settings', $about_val);
                    }

                 
                }
                $page_title = $this->db->get_where('page_content', array('id'=> 1))->row();
                if(empty($page_title)) {
                    $table_data['page_title'] = $this->input->post('page_title_28');
                    $slug = preg_replace('/[^A-Za-z0-9\-]/', '-', $post_data['page_title_28']);
                    $table_data['page_slug'] = strtolower($slug);
                    $table_data['page_content'] = $this->input->post('page_content_28');
                    $table_data['status'] = 1;
                    $table_data['created_datetime'] =date('Y-m-d H:i:s');
                    $this->db->insert('page_content', $table_data);
                } else {  
                    $where = array('id' => 1);
                    $table_data['page_title'] = $this->input->post('page_title_28');
                    $slug = preg_replace('/[^A-Za-z0-9\-]/', '-', $post_data['page_title_28']);
                    $table_data['page_slug'] = strtolower($slug);
                    $table_data['page_content'] = $this->input->post('page_content_28');
                    $table_data['updated_datetime'] = date('Y-m-d H:i:s');
                    $this->admin->update_data('page_content', $table_data, $where);
                }
               
                if($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success_message', 'About Us updated successfully');
                        redirect($_SERVER["HTTP_REFERER"]);
                } else {
                    $this->session->set_flashdata('error_message', 'Something went wront, Try again');
                    redirect($_SERVER["HTTP_REFERER"]);
                }
        }
        $this->data['pages']=$this->admin->getting_pages_list($id);
        $this->data['page'] = 'about-us';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    } 
     public function faq_delete() {
        $id = $this->input->post('id');
        $this->db->where('id',$id)->delete('faq');
        $result = $this->db->where('id',$id)->delete('faq');
          if($result){
           $this->session->set_flashdata('success_message', 'FAQ deleted successfully');
             redirect($_SERVER["HTTP_REFERER"]);
          }else{
           $this->session->set_flashdata('error_message', 'Something went wront, Try again');
           redirect($_SERVER["HTTP_REFERER"]);
          }
    }
    public function faq($id) {
        $this->common_model->checkAdminUserPermission(24);
        $titles = $this->input->post('page_title');
        $cont = $this->input->post('page_content'); 
        $faq_id = $this->input->post('faq_id'); 

        if($this->input->post("form_submit") == true) {
            $this->common_model->checkAdminLogin();
                foreach ($titles as $key => $value) {
                    $data = array(  
                        'page_title'     => $value,
                        'page_content'  => $cont[$key],  
                        'status'   =>1,  
                        'created_datetime' =>date('Y-m-d H:i:s') 
                        );  

                     if (empty($faq_id[$key])) {
                        
                        $this->db->insert('faq', $data);
                     }else {
                        $where = array('id'=> $faq_id[$key]);
                        $this->db->update('faq', $data ,$where);
                     }

                }
                if($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success_message', 'FAQ updated successfully');
                    redirect($_SERVER["HTTP_REFERER"]);
                } else {
                    $this->session->set_flashdata('error_message', 'Something went wront, Try again');
                    redirect($_SERVER["HTTP_REFERER"]);
                }
        }
               
        $this->data['pages']=$this->admin->getting_faq_list();
        $this->data['page'] = 'faq';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
            }
        
     public function cookie_policy($id) {
        $this->common_model->checkAdminUserPermission(24);
        $title = $this->input->post('page_title');
        $this->data['cookie_policy'] = $this->admin->cookie_policysettings();
        if($this->input->post("form_submit") == true) {
            $this->common_model->checkAdminLogin();
                $page_title = $this->db->get_where('page_content', array('id'=> 19))->row();

                $post_data = $this->input->post();
                $query = $this->db->query("select * from language WHERE status = '1'");
                $languages = $query->result();
                foreach ($languages as $language) {
                    $cookie_val = array(
                        'modules' => 'cookie_policy',
                        'title' => $this->input->post('page_title_' . $language->id, true),
                        'content' => $this->input->post('page_content_' . $language->id, true),
                        'lang_type' => $language->language_value
                    );
                    $this->db->where('modules', 'cookie_policy');
                    $this->db->where('lang_type', $language->language_value);
                    $row = $this->db->get('home_settings')->row();
                    if (empty($row)) {
                        $this->db->insert('home_settings', $cookie_val);
                    } else {
                        $this->db->where('modules', 'cookie_policy');
                        $this->db->where('lang_type', $language->language_value);
                        $this->db->update('home_settings', $cookie_val);
                    }
                }

                if(empty($page_title)) {
                    $table_data['page_title'] = $this->input->post('page_title_28');
                    $slug = preg_replace('/[^A-Za-z0-9\-]/', '-', $post_data['page_title_28']);
                    $table_data['page_slug'] = strtolower($slug);
                    $table_data['page_content'] = $this->input->post('page_content_28');
                    $table_data['status'] = 1;
                    $table_data['created_datetime'] =date('Y-m-d H:i:s');
                    $this->db->insert('page_content', $table_data);
                } else {  
                    $where = array('id' => 19);
                    $table_data['page_title'] = $this->input->post('page_title_28');
                    $slug = preg_replace('/[^A-Za-z0-9\-]/', '-', $post_data['page_title_28']);
                    $table_data['page_slug'] = strtolower($slug);
                    $table_data['page_content'] = $this->input->post('page_content_28');
                    $table_data['updated_datetime'] = date('Y-m-d H:i:s');
                    $this->admin->update_data('page_content', $table_data, $where);
                }
               
                if($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success_message', 'Cookie Policy updated successfully');
                    redirect($_SERVER["HTTP_REFERER"]);
                } else {
                    $this->session->set_flashdata('error_message', 'Something went wront, Try again');
                    redirect($_SERVER["HTTP_REFERER"]);
                }
        }
        $this->data['pages']=$this->admin->getting_pages_list($id);
        $this->data['page'] = 'cookie_policy';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    } 

    public function help($id) {
        $this->common_model->checkAdminUserPermission(24);
        $title = $this->input->post('page_title');
        $this->data['helps'] = $this->admin->helpsettings();
        if($this->input->post("form_submit") == true) {
            $this->common_model->checkAdminLogin();
                $page_title = $this->db->get_where('page_content', array('id'=> 14))->row();

                $post_data = $this->input->post();
                $query = $this->db->query("select * from language WHERE status = '1'");
                $languages = $query->result();
                foreach ($languages as $language) {
                    $help_val = array(
                        'modules' => 'help',
                        'title' => $this->input->post('page_title_' . $language->id, true),
                        'content' => $this->input->post('page_content_' . $language->id, true),
                        'lang_type' => $language->language_value
                    );
                    $this->db->where('modules', 'help');
                    $this->db->where('lang_type', $language->language_value);
                    $row = $this->db->get('home_settings')->row();
                    if (empty($row)) {
                        $this->db->insert('home_settings', $help_val);
                    } else {
                        $this->db->where('modules', 'help');
                        $this->db->where('lang_type', $language->language_value);
                        $this->db->update('home_settings', $help_val);
                    }
                }
                
                if(empty($page_title)) {
                    $table_data['page_title'] = $this->input->post('page_title_28');
                    $slug = preg_replace('/[^A-Za-z0-9\-]/', '-', $post_data['page_title_28']);
                    $table_data['page_slug'] = strtolower($slug);
                    $table_data['page_content'] = $this->input->post('page_content_28');
                    $table_data['status'] = 1;
                    $table_data['created_datetime'] =date('Y-m-d H:i:s');
                    $this->db->insert('page_content', $table_data);
                } else {  
                    $where = array('id' => 14);
                    $table_data['page_title'] = $this->input->post('page_title_28');
                    $slug = preg_replace('/[^A-Za-z0-9\-]/', '-', $post_data['page_title_28']);
                    $table_data['page_slug'] = strtolower($slug);
                    $table_data['page_content'] = $this->input->post('page_content_28');
                    $table_data['updated_datetime'] = date('Y-m-d H:i:s');
                    $this->admin->update_data('page_content', $table_data, $where);
                }
               
                if($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success_message', 'Help updated successfully');
                    redirect($_SERVER["HTTP_REFERER"]);
                } else {
                    $this->session->set_flashdata('error_message', 'Something went wront, Try again');
                    redirect($_SERVER["HTTP_REFERER"]);
                }
        }
        $this->data['pages']=$this->admin->getting_pages_list($id);
        $this->data['page'] = 'help';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    } 
    public function privacy_policy($id) {
        $this->common_model->checkAdminUserPermission(24);
        $title = $this->input->post('page_title');
        $this->data['privacy_policy'] = $this->admin->privacy_policysettings();
        if($this->input->post("form_submit") == true) {
            $this->common_model->checkAdminLogin();
                $page_title = $this->db->get_where('page_content', array('id'=> 15))->row();

                $post_data = $this->input->post();
                $query = $this->db->query("select * from language WHERE status = '1'");
                $languages = $query->result();
                foreach ($languages as $language) {
                    $privacy_val = array(
                        'modules' => 'privacy_policy',
                        'title' => $this->input->post('page_title_' . $language->id, true),
                        'content' => $this->input->post('page_content_' . $language->id, true),
                        'lang_type' => $language->language_value
                    );
                    $this->db->where('modules', 'privacy_policy');
                    $this->db->where('lang_type', $language->language_value);
                    $row = $this->db->get('home_settings')->row();
                    if (empty($row)) {
                        $this->db->insert('home_settings', $privacy_val);
                    } else {
                        $this->db->where('modules', 'privacy_policy');
                        $this->db->where('lang_type', $language->language_value);
                        $this->db->update('home_settings', $privacy_val);
                    }
                }
                
                if(empty($page_title)) {
                    $table_data['page_title'] = $this->input->post('page_title_28');
                    $slug = preg_replace('/[^A-Za-z0-9\-]/', '-', $post_data['page_title_28']);
                    $table_data['page_slug'] = strtolower($slug);
                    $table_data['page_content'] = $this->input->post('page_content_28');
                    $table_data['status'] = 1;
                    $table_data['created_datetime'] =date('Y-m-d H:i:s');
                    $this->db->insert('page_content', $table_data);
                } else {  
                    $where = array('id' => 15);
                    $table_data['page_title'] = $this->input->post('page_title_28');
                    $slug = preg_replace('/[^A-Za-z0-9\-]/', '-', $post_data['page_title_28']);
                    $table_data['page_slug'] = strtolower($slug);
                    $table_data['page_content'] = $this->input->post('page_content_28');
                    $table_data['updated_datetime'] = date('Y-m-d H:i:s');
                    $this->admin->update_data('page_content', $table_data, $where);
                }
               
                if($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success_message', 'Privacy Policy updated successfully');
                    redirect($_SERVER["HTTP_REFERER"]);
                } else {
                    $this->session->set_flashdata('error_message', 'Something went wront, Try again');
                    redirect($_SERVER["HTTP_REFERER"]);
                }
        }
        $this->data['pages']=$this->admin->getting_pages_list($id);
        $this->data['page'] = 'privacy_policy';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    } 
     public function terms_of_services($id) {
        $this->common_model->checkAdminUserPermission(24);
        $title = $this->input->post('page_title');
        $this->data['termconditions'] = $this->admin->termssettings();
        if($this->input->post("form_submit") == true) {
            $this->common_model->checkAdminLogin();
                $page_title = $this->db->get_where('page_content', array('id'=> 16))->row();

                $post_data = $this->input->post();
                $query = $this->db->query("select * from language WHERE status = '1'");
                $languages = $query->result();
                foreach ($languages as $language) {
                    $terms_val = array(
                        'modules' => 'terms_condition',
                        'title' => $this->input->post('page_title_' . $language->id, true),
                        'content' => $this->input->post('page_content_' . $language->id, true),
                        'lang_type' => $language->language_value
                    );
                    $this->db->where('modules', 'terms_condition');
                    $this->db->where('lang_type', $language->language_value);
                    $row = $this->db->get('home_settings')->row();
                    if (empty($row)) {
                        $this->db->insert('home_settings', $terms_val);
                    } else {
                        $this->db->where('modules', 'terms_condition');
                        $this->db->where('lang_type', $language->language_value);
                        $this->db->update('home_settings', $terms_val);
                    }
                }
                
                if(empty($page_title)) {
                    $table_data['page_title'] = $this->input->post('page_title_28');
                    $slug = preg_replace('/[^A-Za-z0-9\-]/', '-', $post_data['page_title_28']);
                    $table_data['page_slug'] = strtolower($slug);
                    $table_data['page_content'] = $this->input->post('page_content_28');
                    $table_data['status'] = 1;
                    $table_data['created_datetime'] =date('Y-m-d H:i:s');
                    $this->db->insert('page_content', $table_data);
                } else {  
                    $where = array('id' => 16);
                    $table_data['page_title'] = $this->input->post('page_title_28');
                    $slug = preg_replace('/[^A-Za-z0-9\-]/', '-', $post_data['page_title_28']);
                    $table_data['page_slug'] = strtolower($slug);
                    $table_data['page_content'] = $this->input->post('page_content_28');
                    $table_data['updated_datetime'] = date('Y-m-d H:i:s');
                    $this->admin->update_data('page_content', $table_data, $where);
                }
               
                if($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success_message', 'Terms Of Services updated successfully');
                    redirect($_SERVER["HTTP_REFERER"]);
                } else {
                    $this->session->set_flashdata('error_message', 'Something went wront, Try again');
                    redirect($_SERVER["HTTP_REFERER"]);
                }
        }
        $this->data['pages']=$this->admin->getting_pages_list($id);
        $this->data['page'] = 'terms_of_services';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    } 
    public function termconditions() {
		$this->common_model->checkAdminUserPermission(25);
        if ($this->input->post('form_submit')) {
            $this->load->library('upload');
            $data = $this->input->post();
				foreach ($data AS $key => $val) {

                    if ($key != 'form_submit') {
                        $this->db->where('key', $key);
                        $this->db->delete('system_settings');
                        $table_data['key'] = $key;
                        $table_data['value'] = $val;
                        $table_data['system'] = 1;
                        $table_data['groups'] = 'config';
                        $table_data['update_date'] = date('Y-m-d');
                        $table_data['status'] = 1;
                        $this->db->insert('system_settings', $table_data);
                    }
                }

		}
        $results = $this->admin->get_setting_list();

        foreach ($results AS $config) {
            $this->data[$config['key']] = $config['value'];
        }

        $this->data['page'] = 'termconditions';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }
    
    public function privacypolicy() {
		$this->common_model->checkAdminUserPermission(26);
        if ($this->input->post('form_submit')) {
            $this->load->library('upload');
            $data = $this->input->post();
				foreach ($data AS $key => $val) {

                    if ($key != 'form_submit') {
                        $this->db->where('key', $key);
                        $this->db->delete('system_settings');
                        $table_data['key'] = $key;
                        $table_data['value'] = $val;
                        $table_data['system'] = 1;
                        $table_data['groups'] = 'config';
                        $table_data['update_date'] = date('Y-m-d');
                        $table_data['status'] = 1;
                        $this->db->insert('system_settings', $table_data);
                    }
                }

		}
        $results = $this->admin->get_setting_list();

        foreach ($results AS $config) {
            $this->data[$config['key']] = $config['value'];
        }

        $this->data['page'] = 'privacypolicy';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }
	
	public function banner_image() 
    {
        $this->data['page'] = 'banner_image';	
        if ($this->input->post('form_submit')) {
            extract($_POST);
            $category = $this->input->post('category');
            $from_date = $this->input->post('from');
            $to_date = $this->input->post('to');
            $this->data['list'] = $this->admin->categories_list_filter($category, $from_date, $to_date);
        } else {
			$wr=array('id !'=>'');
            $this->data['list'] = $this->admin->GetBannerDet();
        }

        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }
	
	public function edit_banner($id) {
        $this->data['page'] = 'edit_banner';
        if ($this->input->post()) {
			$inp=$this->input->post();
			extract($_POST);
			if($this->input->post('bgimg_for')=='banner' || $this->input->post('bgimg_for')=='bottom_image1' || $this->input->post('bgimg_for')=='bottom_image2' || $this->input->post('bgimg_for')=='bottom_image3'){
				$data['banner_content'] = $this->input->post('banner_content');
				$data['banner_sub_content'] = $this->input->post('banner_sub_content');
				
				$this->load->library('common');
				$this->db->where('bgimg_id', $id);
				if ($this->db->update('bgimage', $data)) {
					$message = "<div class='alert alert-success text-center fade in' id='flash_succ_message'>Category Successfully updated.</div>";
				}
				$insert_id = $id;
				if($this->input->post('bgimg_for')=='banner' || $this->input->post('bgimg_for')=='bottom_image1' || $this->input->post('bgimg_for')=='bottom_image2' || $this->input->post('bgimg_for')=='bottom_image3')
				{
					if (isset($_FILES) && !empty($_FILES['upload_image']['name'])) {
						$av_file       = $_FILES['upload_image'];
						$src           = 'uploads/banners/' . $av_file['name'];
						$imageFileType = pathinfo($src, PATHINFO_EXTENSION);
						$image_name    = time() . '.' . $imageFileType;
						$src2          = 'uploads/banners/' . $image_name;
						$src3          = 'uploads/banners/' . $image_name;
						move_uploaded_file($av_file['tmp_name'], $src2);
						$this->db->query("UPDATE `bgimage` SET `upload_image` = '" . $src2 . "',`cropped_img` ='".$src2."' WHERE `bgimg_id` = '".$insert_id."' ");
					}
				}
				if($this->input->post('bgimg_for')=='banner'){
					$tile = 'Banner';
				}
				if($this->input->post('bgimg_for')=='bottom_image1'){
					$tile = 'Bottom Image-1';
				}
				if($this->input->post('bgimg_for')=='bottom_image2'){
					$tile = 'Bottom Image-2';
				}
				if($this->input->post('bgimg_for')=='bottom_image3'){
					$tile = 'Bottom Image-3';					
				}
				$this->session->set_flashdata('success_message', $tile.' Updated successfully');
			}
			redirect(base_url('admin/edit_banner/'.$id.''));
			
        } else {
			$wr=array('id !'=>'');
            $this->data['list'] = $this->admin->GetBannerDetId($id);
        }
		$this->data['id'] = $id;
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function index() {
		$this->common_model->checkAdminUserPermission(14);

        if ($this->input->post('form_submit')) {
            $this->load->library('upload');
            $data = $this->input->post();

            /*
             *  commision insert start vasanth
             */

            $admin_id = $this->session->userdata('admin_id');
            $commission = $this->input->post('commission');
            $CommInsert = [
                'admin_id' => $admin_id,
                'commission' => $commission,
            ];
            $where = [
                'status' => 1,
                'admin_id' => $admin_id,
            ];

            $AdminData = $this->admin->getSingleData('admin_commission', $where);

            if ($admin_id === $AdminData->admin_id) {

                $where = ['admin_id' => $admin_id];
                $this->admin->update_data('admin_commission', $CommInsert, $where);
            } else {
                $this->admin->update_data('admin_commission', $CommInsert);
            }

            /*
             *  commision insert end vasanth
             */
            if ($_FILES['banner_image']['name']) {
                $table_data1 = [];
                $configfile['upload_path'] = FCPATH . 'uploads/banner_img';
                $configfile['allowed_types'] = 'gif|jpg|jpeg|png';
                $configfile['overwrite'] = FALSE;
                $configfile['remove_spaces'] = TRUE;
                $file_name = $_FILES['banner_image']['name'];
                $configfile['file_name'] = time() . '_' . $file_name;
                $image_name = $configfile['file_name'];
                $image_url = 'uploads/logo/' . $image_name;
                $this->upload->initialize($configfile);
                if ($this->upload->do_upload('banner_image')) {
                    $img_uploadurl = 'uploads/banner_img' . $_FILES['banner_image']['name'];
                    $key = 'banner_image';
                    $val = 'uploads/banner_img/' . $image_name;
                    $this->db->where('key', $key);
                }
                $this->db->delete('system_settings');
                $table_data1['key'] = $key;
                $table_data1['value'] = $val;
                $table_data1['system'] = 1;
                $table_data1['groups'] = 'config';
                $table_data1['update_date'] = date('Y-m-d');
                $table_data1['status'] = 1;
                $this->db->insert('system_settings', $table_data1);
            }

            if ($_FILES['site_logo']['name']) {
                $table_data1 = [];
                $configfile['upload_path'] = FCPATH . 'uploads/logo';
                $configfile['allowed_types'] = 'gif|jpg|jpeg|png';
                $configfile['overwrite'] = FALSE;
                $configfile['remove_spaces'] = TRUE;
                $file_name = $_FILES['site_logo']['name'];
                $configfile['file_name'] = time() . '_' . $file_name;
                $image_name = $configfile['file_name'];
                $image_url = 'uploads/logo/' . $image_name;
                $this->upload->initialize($configfile);
                if ($this->upload->do_upload('site_logo')) {
                    $img_uploadurl = 'uploads/logo' . $_FILES['site_logo']['name'];
                    $key = 'logo_front';
                    $val = 'uploads/logo/' . $image_name;
                    $this->db->where('key', $key);
                }
                $this->db->delete('system_settings');
                $table_data1['key'] = $key;
                $table_data1['value'] = $val;
                $table_data1['system'] = 1;
                $table_data1['groups'] = 'config';
                $table_data1['update_date'] = date('Y-m-d');
                $table_data1['status'] = 1;
                $this->db->insert('system_settings', $table_data1);
            }
            if ($_FILES['favicon']['name']) {
                $img_uploadurl1 = '';
                $table_data2 = '';
                $table_data = [];
                $configfile['upload_path'] = FCPATH . 'uploads/logo';
                $configfile['allowed_types'] = 'png|ico';
                $configfile['overwrite'] = FALSE;
                $configfile['remove_spaces'] = TRUE;
                $file_name = $_FILES['favicon']['name'];
                $configfile['file_name'] = $file_name;
                $this->upload->initialize($configfile);
                if ($this->upload->do_upload('favicon')) {

                    $img_uploadurl1 = $_FILES['favicon']['name'];
                    $key = 'favicon';
                    $val = $img_uploadurl1;
                    $select_fav_icon = $this->db->query("SELECT * FROM `system_settings` WHERE `key` = '$key' ");
                    $fav_icon_result = $select_fav_icon->row_array();

                    if (count($fav_icon_result) > 0) {
                        $this->db->where('key', $key);
                        $this->db->update('system_settings', array('value' => $val));
                    } else {
                        $table_data['key'] = $key;
                        $table_data['value'] = $val;
                        $this->db->insert('system_settings', $table_data);
                    }
                    $error = '';
                } else {
                    $error = $this->upload->display_errors();
                }
            }
            if ($data) {
                $table_data = array();

                # stripe_option // 1 SandBox, 2 Live 
                # stripe_allow  // 1 Active, 2 Inactive  

                $live_publishable_key = $live_secret_key = $secret_key = $publishable_key = '';

                $query = $this->db->query("SELECT * FROM payment_gateways WHERE status = 1");
                $stripe_details = $query->result_array();
                if (!empty($stripe_details)) {
                    foreach ($stripe_details as $details) {
                        if (strtolower($details['gateway_name']) == 'stripe') {
                            if (strtolower($details['gateway_type']) == 'sandbox') {

                                $publishable_key = $details['api_key'];
                                $secret_key = $details['value'];
                            }
                            if (strtolower($details['gateway_type']) == 'live') {
                                $live_publishable_key = $details['api_key'];
                                $live_secret_key = $details['value'];
                            }
                        }
                    }
                }
                
                $braintree_merchant = $braintree_key = $braintree_publickey = $braintree_privatekey = $paypal_appid = $paypal_appkey = '';
$live_braintree_merchant = $live_braintree_key = $live_braintree_publickey = $live_braintree_privatekey = $live_paypal_appid = $live_paypal_appkey = '';
    $pdata['braintree_key'] = $this->input->post('braintree_key');
    $pdata['braintree_merchant'] = $this->input->post('braintree_merchant');
    $pdata['braintree_publickey'] = $this->input->post('braintree_publickey');
    $pdata['braintree_privatekey'] = $this->input->post('braintree_privatekey');
    $pdata['paypal_appid'] = $this->input->post('paypal_appid');
    $pdata['paypal_appkey'] = $this->input->post('paypal_appkey');
    $pdata['gateway_type'] = $this->input->post('paypal_gateway');
    if($_POST['paypal_gateway']=="sandbox"){
        $pid=1;
    }else{
        $pid=2;
    }
	$this->db->where('id',$pid);
	$this->db->update('paypal_payment_gateways',$pdata); 
	
  $query = $this->db->query("SELECT * FROM paypal_payment_gateways");
  $paypal_details = $query->result_array();
  if(!empty($paypal_details)){
    foreach ($paypal_details as $details) {      
        if(strtolower($details['gateway_type'])=='sandbox'){
		  $braintree_key = $details['braintree_key'];
		  $braintree_merchant = $details['braintree_merchant'];
		  $braintree_publickey = $details['braintree_publickey'];
		  $braintree_privatekey = $details['braintree_privatekey'];
		  $paypal_appid = $details['paypal_appid'];
		  $paypal_appkey = $details['paypal_appkey'];
        }else{
		  $live_braintree_key = $details['braintree_key'];
		  $live_braintree_merchant = $details['braintree_merchant'];
		  $live_braintree_publickey = $details['braintree_publickey'];
		  $live_braintree_privatekey = $details['braintree_privatekey'];
		  $live_paypal_appid = $details['paypal_appid'];
		  $live_paypal_appkey = $details['paypal_appkey'];
        }
    }
  } 
  $data['braintree_key']    = $braintree_key;
  $data['braintree_merchant']       = $braintree_merchant;
  $data['braintree_publickey'] = $braintree_publickey;
  $data['braintree_privatekey']    = $braintree_privatekey;
  $data['paypal_appid'] = $paypal_appid;
  $data['paypal_appkey']    = $paypal_appkey;
  
  $data['live_braintree_key']    = $live_braintree_key;
  $data['live_braintree_merchant']       = $live_braintree_merchant;
  $data['live_braintree_publickey'] = $live_braintree_publickey;
  $data['live_braintree_privatekey']    = $live_braintree_privatekey; 
  $data['live_paypal_appid'] = $live_paypal_appid;
  $data['live_paypal_appkey']    = $live_paypal_appkey;

                $data['publishable_key'] = $publishable_key;
                $data['secret_key'] = $secret_key;
                $data['live_publishable_key'] = $live_publishable_key;
                $data['live_secret_key'] = $live_secret_key;

                foreach ($data AS $key => $val) {
                    if ($key != 'form_submit') {
                        $this->db->where('key', $key);
                        $this->db->delete('system_settings');
                        $table_data['key'] = $key;
                        $table_data['value'] = $val;
                        $table_data['system'] = 1;
                        $table_data['groups'] = 'config';
                        $table_data['update_date'] = date('Y-m-d');
                        $table_data['status'] = 1;
                        $this->db->insert('system_settings', $table_data);
                    }
                }
            }
            $message = '';
            if (!empty($error)) {
                $this->session->set_flashdata('error_message', 'Something wrong, Please try again');
            } else {
                $this->session->set_flashdata('success_message', 'Settings updated successfully');
            }
            redirect(base_url('admin/settings'));
        }

        $results = $this->admin->get_setting_list();


        foreach ($results AS $config) {
            $this->data[$config['key']] = $config['value'];
        }

        $data['banner_image'] = $this->db->get_where('system_settings', array('key'=>'banner_image'))->row()->value;

        $this->data['page'] = 'index';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function emailsettings() {
        $this->common_model->checkAdminUserPermission(30);
		$this->common_model->checkAdminUserPermission(14);
        if ($this->input->post('form_submit')) {
            $this->common_model->checkAdminLogin();

            $this->load->library('upload');
            $data = $this->input->post();
            if ($data) {
                $table_data = array();
                foreach ($data AS $key => $val) {
                    if ($key != 'form_submit') {
                        $this->db->where('key', $key);
                        $this->db->delete('system_settings');
                        $table_data['key'] = $key;
                        $table_data['value'] = $val;
                        $table_data['system'] = 1;
                        $table_data['groups'] = 'config';
                        $table_data['update_date'] = date('Y-m-d');
                        $table_data['status'] = 1;
                        $this->db->insert('system_settings', $table_data);
                    }
                }
            }


            $message = 'Settings saved successfully';
            $this->session->set_flashdata('success_message', $message);
            redirect(base_url('admin/emailsettings'));
        }

        $results = $this->admin->get_setting_list();
        foreach ($results AS $config) {
            $this->data[$config['key']] = $config['value'];
        }

        $this->data['page'] = 'emailsettings';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }
	
	   public function googleplus_social_media() {
		$this->common_model->checkAdminUserPermission(14);
        if ($this->input->post('form_submit')) {


            $this->load->library('upload');
            $data = $this->input->post();
            if ($data) {
                $table_data = array();
                foreach ($data AS $key => $val) {
                    if ($key != 'form_submit') {
                        $this->db->where('key', $key);
                        $this->db->delete('system_settings');
                        $table_data['key'] = $key;
                        $table_data['value'] = $val;
                        $table_data['system'] = 1;
                        $table_data['groups'] = 'config';
                        $table_data['update_date'] = date('Y-m-d');
                        $table_data['status'] = 1;
                        $this->db->insert('system_settings', $table_data);
                    }
                }
            }


            $message = 'Settings saved successfully';
            $this->session->set_flashdata('success_message', $message);
            redirect(base_url('admin/googleplus_social_media'));
        }

        $results = $this->admin->get_setting_list();
        foreach ($results AS $config) {
            $this->data[$config['key']] = $config['value'];
        }

        $this->data['page'] = 'googleplus_social_media';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }
	
	
	public function twit_social_media() {
		$this->common_model->checkAdminUserPermission(14);
        if ($this->input->post('form_submit')) {


            $this->load->library('upload');
            $data = $this->input->post();
            if ($data) {
                $table_data = array();
                foreach ($data AS $key => $val) {
                    if ($key != 'form_submit') {
                        $this->db->where('key', $key);
                        $this->db->delete('system_settings');
                        $table_data['key'] = $key;
                        $table_data['value'] = $val;
                        $table_data['system'] = 1;
                        $table_data['groups'] = 'config';
                        $table_data['update_date'] = date('Y-m-d');
                        $table_data['status'] = 1;
                        $this->db->insert('system_settings', $table_data);
                    }
                }
            }


            $message = 'Settings saved successfully';
            $this->session->set_flashdata('success_message', $message);
            redirect(base_url('admin/twit_social_media'));
        }

        $results = $this->admin->get_setting_list();
        foreach ($results AS $config) {
            $this->data[$config['key']] = $config['value'];
        }

        $this->data['page'] = 'twit_social_media';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }
	
	
		public function fb_social_media() {
		$this->common_model->checkAdminUserPermission(14);
        if ($this->input->post('form_submit')) {


            $this->load->library('upload');
            $data = $this->input->post();
            if ($data) {
                $table_data = array();
                foreach ($data AS $key => $val) {
                    if ($key != 'form_submit') {
                        $this->db->where('key', $key);
                        $this->db->delete('system_settings');
                        $table_data['key'] = $key;
                        $table_data['value'] = $val;
                        $table_data['system'] = 1;
                        $table_data['groups'] = 'config';
                        $table_data['update_date'] = date('Y-m-d');
                        $table_data['status'] = 1;
                        $this->db->insert('system_settings', $table_data);
                    }
                }
            }


            $message = 'Settings saved successfully';
            $this->session->set_flashdata('success_message', $message);
            redirect(base_url('admin/fb_social_media'));
        }

        $results = $this->admin->get_setting_list();
        foreach ($results AS $config) {
            $this->data[$config['key']] = $config['value'];
        }

        $this->data['page'] = 'fb_social_media';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }
	
	public function smssettings() 
    {
		
        $this->common_model->checkAdminUserPermission(33);
        if ($this->input->post('form_submit')) {
            $this->common_model->checkAdminLogin();
            $data = $this->input->post();
            if ($data) {
                $table_data = array();
                if (isset($_POST['default_otp'])) {
                    $data['default_otp'] = 1;
                } else {
                    $data['default_otp'] = 0;
                }

                foreach ($data AS $key => $val) {
                    if ($key != 'form_submit') {
                        $this->db->where('key', $key);
                        $this->db->delete('system_settings');
                        $table_data['key'] = $key;
                        $table_data['value'] = $val;
                        $table_data['system'] = 1;
                        $table_data['groups'] = 'config';
                        $table_data['update_date'] = date('Y-m-d');
                        $table_data['status'] = 1;
                        $this->db->insert('system_settings', $table_data);
                    }
                }
            }

            $message = 'Settings saved successfully';
            $this->session->set_flashdata('success_message', $message);
            redirect(base_url('admin/sms-settings'));
        }

        $results = $this->admin->get_setting_list();
        foreach ($results AS $config) {
            $this->data[$config['key']] = $config['value'];
        }
        $this->data['page'] = 'smssettings';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }
    
	public function cod_payment_gateway(){ 
		$this->common_model->checkAdminUserPermission(14);  
        $id = settingValue('cod_option');

        if ($this->input->post('form_submit')) {
            $this->common_model->checkAdminLogin();
			$this->db->where('key', 'cod_option');
			$this->db->delete('system_settings');
			$table_data['key'] = 'cod_option';
			$table_data['value'] = !empty($this->input->post('cod_show'))?$this->input->post('cod_show'):0;;
			$table_data['system'] = 1;
			$table_data['groups'] = 'config';
			$table_data['update_date'] = date('Y-m-d');
			$table_data['status'] = 1;
			$this->db->insert('system_settings', $table_data);
			$message = 'COD status updated successfully';
            $this->session->set_flashdata('success_message', $message);
            redirect(base_url() . 'admin/cod-payment-gateway');
        }
        if (!empty($id)) {
            $this->data['list']['status'] = 1;
        } else {
            $this->data['list']['status'] = 0;
        }

        $this->data['page'] = 'cod_payment_gateway';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }
    public function stripe_payment_gateway() {
		$this->common_model->checkAdminUserPermission(14);  
        $id = settingValue('stripe_option');
        if (!empty($id)) {
            $this->data['list'] = $this->admin->edit_payment_gateway($id);
        } else {
            $this->data['list'] = [];
            $this->data['list']['id'] = '';
            $this->data['list']['gateway_type'] = '';
            $this->data['gateway_type'] = '';
        }
        $this->data['page'] = 'stripe_payment_gateway';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }
	
	 public function razorpay_payment_gateway() {
		 $this->common_model->checkAdminUserPermission(14);  
		 $id = settingValue('razor_option');

        if (!empty($id)) {
            $this->data['list'] = $this->admin->edit_razor_payment_gateway($id);
        } else {
            $this->data['list'] = [];
            $this->data['list']['id'] = '';
            $this->data['list']['gateway_type'] = '';
            $this->data['gateway_type'] = '';
        }

        $this->data['page'] = 'razorpay_payment_gateway';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }
	
	public function paypal_payment_gateway() {
        $id = settingValue('paypal_option');

		if (!empty($id)) {
            $this->data['list'] = $this->admin->edit_paypal_payment_gateway($id);
        } else {
            $this->data['list'] = [];
            $this->data['list']['id'] = '';
            $this->data['list']['gateway_type'] = '';
            $this->data['gateway_type'] = '';
        }

        $this->data['page'] = 'paypal_payment_gateway';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }
	
	public function paytabs_payment_gateway() {
		
		$this->data['list'] = $this->admin->edit_paytab_payment_gateway();
        $this->data['page'] = 'paytab_payment_gateway';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function payment_type() {
        if (!empty($_POST['type'])) {
            $result = $this->db->where('gateway_type=', $_POST['type'])->get('payment_gateways')->row_array();
            echo json_encode($result);
            exit;
        }
    }
	
	public function razor_payment_type() {
	if (!empty($_POST['type'])) {
		$result = $this->db->where('gateway_type=', $_POST['type'])->get('razorpay_gateway')->row_array();
		echo json_encode($result);
		exit;
	}
	}
	
	
	public function paypal_payment_type(){ 
	  if(!empty($_POST['type'])){
		$result=$this->db->where('gateway_type=',$_POST['type'])->get('paypal_payment_gateways')->row_array();
		echo json_encode($result);exit;
	  }
	}

    public function paystack_payment_type(){ 
        if(!empty($_POST['type'])){
            $result=$this->db->where('gateway_type=',$_POST['type'])->get('paystack_payment_gateways')->row_array();
            echo json_encode($result);exit;
        }
    }
    public function edit($id = NULL) {
       
		$this->common_model->checkAdminUserPermission(14);
        if ($this->input->post('form_submit')) {

          
            $this->common_model->checkAdminLogin();
            if ($_POST['gateway_type'] == "sandbox") {
                $id = 1;
            } else {
                $id = 2;
            }
            $data['gateway_name'] = $this->input->post('gateway_name');
            $data['gateway_type'] = $this->input->post('gateway_type');
            $data['api_key'] = $this->input->post('api_key');
            $data['value'] = $this->input->post('value');
            $data['status'] = !empty($this->input->post('stripe_show'))?$this->input->post('stripe_show'):0;
            $this->db->where('id', $id);
            if ($this->db->update('payment_gateways', $data)) {
                if ($this->input->post('gateway_type') == 'sandbox') {
                    $datass['publishable_key'] = $this->input->post('api_key');
                    $datass['secret_key'] = $this->input->post('value');
                    $data['stripe_show'] = !empty($this->input->post('stripe_show'))?$this->input->post('stripe_show'):0;
                } else {
                    $datass['live_publishable_key'] = $this->input->post('api_key');
                    $datass['live_secret_key'] = $this->input->post('value');
                    $data['stripe_show'] = !empty($this->input->post('stripe_show'))?$this->input->post('stripe_show'):0;
                }
                $stripe_option = settingValue('stripe_option');
                if (!empty($stripe_option)) {
                    $this->db->where('key', 'stripe_option')->update('system_settings', ['value' => $id]);
                } else {
                    $this->db->insert('system_settings', ['key' => 'stripe_option', 'value' => $id]);
                }

                foreach ($datass AS $key => $val) {
                    $this->db->where('key', $key);
                    $this->db->delete('system_settings');
                    $table_data['key'] = $key;
                    $table_data['value'] = $val;
                    $table_data['system'] = 1;
                    $table_data['groups'] = 'config';
                    $table_data['update_date'] = date('Y-m-d');
                    $table_data['status'] = 1;
                    $this->db->insert('system_settings', $table_data);
                }

                $message = 'Payment gateway edit successfully';
            }
            $this->session->set_flashdata('success_message', $message);
            redirect(base_url() . 'admin/stripe-payment-gateway');
        }

        $this->data['list'] = $this->admin->edit_payment_gateway($id);
        $this->data['page'] = 'stripe_payment_gateway_edit';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }
	
	
	    public function razor_edit($id = NULL) {
			$this->common_model->checkAdminUserPermission(14);
        if ($this->input->post('form_submit')) {
            $this->common_model->checkAdminLogin();
            if ($_POST['gateway_type'] == "sandbox") {
                $id = 1;
            } else {
                $id = 2;
            }
            $data['gateway_name'] = $this->input->post('gateway_name');
            $data['gateway_type'] = $this->input->post('gateway_type');
            $data['api_key'] = $this->input->post('api_key');
            $data['api_secret'] = $this->input->post('value');
            $data['razorpayx_acc_number'] = $this->input->post('razorpayx_acc_number');
            $data['status'] = !empty($this->input->post('razor_show'))?$this->input->post('razor_show'):0;
            $this->db->where('id', $id);
            if ($this->db->update('razorpay_gateway', $data)) {
                if ($this->input->post('gateway_type') == 'sandbox') {
                    $datass['razorpay_apikey'] = $this->input->post('api_key');
                    $datass['razorpay_secret_key'] = $this->input->post('value');
                    $datass['razorpayx_acc_number'] = $this->input->post('razorpayx_acc_number');
                } else {
                    $datass['live_razorpay_apikey'] = $this->input->post('api_key');
                    $datass['live_razorpay_secret_key'] = $this->input->post('value');
                    $datass['live_razorpayx_acc_number'] = $this->input->post('razorpayx_acc_number');
                }
                $razor_option = settingValue('razor_option');
				
                if (!empty($razor_option)) {
                    $this->db->where('key', 'razor_option')->update('system_settings', ['value' => $id]);
                } else {
                    $this->db->insert('system_settings', ['key' => 'razor_option', 'value' => $id]);
                }

                foreach ($datass AS $key => $val) {
                    $this->db->where('key', $key);
                    $this->db->delete('system_settings');
                    $table_data['key'] = $key;
                    $table_data['value'] = $val;
                    $table_data['system'] = 1;
                    $table_data['groups'] = 'config';
                    $table_data['update_date'] = date('Y-m-d');
                    $table_data['status'] = 1;
                    $this->db->insert('system_settings', $table_data);
                }

                $message = 'Payment gateway edit successfully';
            }
            $this->session->set_flashdata('success_message', $message);
            redirect(base_url() . 'admin/razorpay-payment-gateway');
        }

        $this->data['list'] = $this->admin->edit_payment_gateway($id);
        $this->data['page'] = 'razorpay_payment_gateway';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }
	
	   public function paypal_edit($id = NULL) {
		   $this->common_model->checkAdminUserPermission(14);
        if ($this->input->post('form_submit')) {
            $this->common_model->checkAdminLogin();
            if ($_POST['paypal_gateway'] == "sandbox") {
                $id = 1;
            } else {
                $id = 2;
            }

            $data['braintree_key'] = $this->input->post('braintree_key');
            $data['gateway_type'] = $this->input->post('paypal_gateway');
            $data['braintree_merchant'] = $this->input->post('braintree_merchant');
            $data['braintree_publickey'] = $this->input->post('braintree_publickey');
            $data['braintree_privatekey'] = $this->input->post('braintree_privatekey');
            $data['paypal_appid'] = $this->input->post('paypal_appid');
            $data['paypal_appkey'] = $this->input->post('paypal_appkey');
           $data['status'] = !empty($this->input->post('paypal_show'))?$this->input->post('paypal_show'):0;
            $this->db->where('id', $id);
            if ($this->db->update('paypal_payment_gateways', $data)) {
                if ($this->input->post('paypal_gateway') == 'sandbox') {
                    $datass['braintree_key'] = $this->input->post('braintree_key');
					$datass['gateway_type'] = $this->input->post('paypal_gateway');
					$datass['braintree_merchant'] = $this->input->post('braintree_merchant');
					$datass['braintree_publickey'] = $this->input->post('braintree_publickey');
					$datass['braintree_privatekey'] = $this->input->post('braintree_privatekey');
					$datass['paypal_appid'] = $this->input->post('paypal_appid');
					$datass['paypal_appkey'] = $this->input->post('paypal_appkey');
                } else {
                    $datass['braintree_key'] = $this->input->post('braintree_key');
					$datass['gateway_type'] = $this->input->post('paypal_gateway');
					$datass['braintree_merchant'] = $this->input->post('braintree_merchant');
					$datass['braintree_publickey'] = $this->input->post('braintree_publickey');
					$datass['braintree_privatekey'] = $this->input->post('braintree_privatekey');
					$datass['paypal_appid'] = $this->input->post('paypal_appid');
					$datass['paypal_appkey'] = $this->input->post('paypal_appkey');
                }
                $paypal_option = settingValue('paypal_option');
				
                if (!empty($paypal_option)) {
                    $this->db->where('key', 'paypal_option')->update('system_settings', ['value' => $id]);
                } else {
                    $this->db->insert('system_settings', ['key' => 'paypal_option', 'value' => $id]);
                }

                foreach ($datass AS $key => $val) {
                    $this->db->where('key', $key);
                    $this->db->delete('system_settings');
                    $table_data['key'] = $key;
                    $table_data['value'] = $val;
                    $table_data['system'] = 1;
                    $table_data['groups'] = 'config';
                    $table_data['update_date'] = date('Y-m-d');
                    $table_data['status'] = 1;
                    $this->db->insert('system_settings', $table_data);
                }

                $message = 'Payment gateway edit successfully';
            } else {
                if ($this->db->insert('paypal_payment_gateways', $data)) {
                if ($this->input->post('paypal_gateway') == 'sandbox') {
                    $datass['braintree_key'] = $this->input->post('braintree_key');
                    $datass['gateway_type'] = $this->input->post('paypal_gateway');
                    $datass['braintree_merchant'] = $this->input->post('braintree_merchant');
                    $datass['braintree_publickey'] = $this->input->post('braintree_publickey');
                    $datass['braintree_privatekey'] = $this->input->post('braintree_privatekey');
                    $datass['paypal_appid'] = $this->input->post('paypal_appid');
                    $datass['paypal_appkey'] = $this->input->post('paypal_appkey');
                } else {
                    $datass['braintree_key'] = $this->input->post('braintree_key');
                    $datass['gateway_type'] = $this->input->post('paypal_gateway');
                    $datass['braintree_merchant'] = $this->input->post('braintree_merchant');
                    $datass['braintree_publickey'] = $this->input->post('braintree_publickey');
                    $datass['braintree_privatekey'] = $this->input->post('braintree_privatekey');
                    $datass['paypal_appid'] = $this->input->post('paypal_appid');
                    $datass['paypal_appkey'] = $this->input->post('paypal_appkey');
                }
                $paypal_option = settingValue('paypal_option');
                
                if (!empty($paypal_option)) {
                    $this->db->where('key', 'paypal_option')->update('system_settings', ['value' => $id]);
                } else {
                    $this->db->insert('system_settings', ['key' => 'paypal_option', 'value' => $id]);
                }

                foreach ($datass AS $key => $val) {
                    $this->db->where('key', $key);
                    $this->db->delete('system_settings');
                    $table_data['key'] = $key;
                    $table_data['value'] = $val;
                    $table_data['system'] = 1;
                    $table_data['groups'] = 'config';
                    $table_data['update_date'] = date('Y-m-d');
                    $table_data['status'] = 1;
                    $this->db->insert('system_settings', $table_data);
                }

                $message = 'Payment gateway edit successfully';
            }
        }
            $this->session->set_flashdata('success_message', $message);
            redirect(base_url() . 'admin/paypal-payment-gateway');
        }

        $this->data['list'] = $this->admin->edit_payment_gateway($id);
        $this->data['page'] = 'paypal_payment_gateway';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }
	
	 public function paytab_edit($id = NULL) {
		 $this->common_model->checkAdminUserPermission(14);
        if ($this->input->post('form_submit')) {
            
			$id=1;
            $data['sandbox_email'] = $this->input->post('sandbox_email');
            $data['sandbox_secretkey'] = $this->input->post('sandbox_secretkey');
            $data['email'] = $this->input->post('email');
            $data['secretkey'] = $this->input->post('secretkey');
            $this->db->where('id', $id);
            if ($this->db->update('paytabs_details', $data)) {
               
                    $datass['sandbox_email'] = $this->input->post('sandbox_email');
					$datass['sandbox_secretkey'] = $this->input->post('sandbox_secretkey');
					$datass['email'] = $this->input->post('email');
					$datass['secretkey'] = $this->input->post('secretkey');
                
                $paytab_option = settingValue('paytab_option');
				
                if (!empty($paytab_option)) {
                    $this->db->where('key', 'paytab_option')->update('system_settings', ['value' => $id]);
                } else {
                    $this->db->insert('system_settings', ['key' => 'paytab_option', 'value' => $id]);
                }

                foreach ($datass AS $key => $val) {
                    $this->db->where('key', $key);
                    $this->db->delete('system_settings');
                    $table_data['key'] = $key;
                    $table_data['value'] = $val;
                    $table_data['system'] = 1;
                    $table_data['groups'] = 'config';
                    $table_data['update_date'] = date('Y-m-d');
                    $table_data['status'] = 1;
                    $this->db->insert('system_settings', $table_data);
                }

                $message = 'Payment gateway edit successfully';
            }
            $this->session->set_flashdata('success_message', $message);
            redirect(base_url() . 'admin/paytabs-payment-gateway');
        }

        $this->data['list'] = $this->admin->edit_payment_gateway($id);
        $this->data['page'] = 'paytab_payment_gateway';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }
	
	
	

    public function ThemeColorChange() {
        $this->common_model->checkAdminUserPermission(34);
        $this->data['page'] = 'theme_color';
        $this->data['Colorlist'] = $this->admin->ColorList();
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function ChangeColor() {
        $this->common_model->checkAdminLogin();
        $Postdata = $this->input->post();
        $ChangeColor = $Postdata['color'];

        if ($ChangeColor) {

            $whr = [
                'id' => $ChangeColor
            ];
            $color = [
                'status' => 1
            ];
            $query=$this->db->query("UPDATE theme_color_change SET status='0'");
            $updateColor = $this->admin->update_data('theme_color_change', $color, $whr);

            if ($updateColor) {
                $this->session->set_flashdata('success_message1', 'Color Change Suceessfully');
                redirect(base_url() . 'admin/theme-color');
            }
        } else {
            $this->session->set_flashdata('error_message1', 'Choose the Color');
            redirect(base_url() . 'admin/theme-color');
        }
    }

    public function paystack_payment_gateway() {
        $id = settingValue('paystack_option');
        if (!empty($id)) {
            $this->data['list'] = $this->admin->edit_paystack_payment_gateway($id);
        } else {
            $this->data['list'] = [];
            $this->data['list']['id'] = '';
            $this->data['list']['gateway_type'] = '';
            $this->data['gateway_type'] = '';
        }

        $this->data['page'] = 'paystack_payment_gateway';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function paysolution_payment_gateway() {
        if($this->input->post('form_submit') == 'submit') {
            $this->common_model->checkAdminLogin();
            $paymentdata = $this->input->post();
            $paymentdata['paysolution_show'] = $paymentdata['paysolution_show']?'1':'0';
            foreach ($paymentdata AS $key => $val) {
                $data['key'] = $key;
                $data['value'] = $val;
                $data['system'] = 1;
                $data['groups'] = 'config';
                $data['update_date'] = date('Y-m-d');
                $data['status'] = 1;
                $paysolution = $this->db->get_where('system_settings', array('key'=>$key))->row();
                if($key != 'form_submit') {
                    if($paysolution == '') {
                        $this->db->insert('system_settings', $data);
                    } else {
                        $this->db->where('key', $key)->update('system_settings', $data);
                    }
                }
            } 
            if($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success_message', 'Payment Settings Updated Succesfullly');
                redirect(base_url() . 'admin/paysolution-payment-gateway');
            } else {
                $this->session->set_flashdata('success_error', 'Something went wrong, try again');
                redirect(base_url() . 'admin/paysolution-payment-gateway');
            } 
        }
        $this->data['page'] = 'paysolution_payment_gateway';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function paystack_edit($id = NULL) {
            $this->common_model->checkAdminUserPermission(14);
        if ($this->input->post('form_submit')) {
            $this->common_model->checkAdminLogin();
            if ($_POST['gateway_type'] == "sandbox") {
                $id = 1;
            } else {
                $id = 2;
            }
            $data['gateway_name'] = $this->input->post('gateway_name');
            $data['gateway_type'] = $this->input->post('gateway_type');
            $data['api_key'] = $this->input->post('api_key');
            $data['value'] = $this->input->post('value');
            $data['status'] = !empty($this->input->post('paystack_show'))?$this->input->post('paystack_show'):0;
            $this->db->where('id', $id);
            if ($this->db->update('paystack_payment_gateways', $data)) {
                if ($this->input->post('gateway_type') == 'sandbox') {
                    $datass['paystack_apikey'] = $this->input->post('value');
                    $datass['paystack_secret_apikey'] = $this->input->post('api_key');
                    $datass['paystack_show'] = $this->input->post('paystack_show');
                } else {
                    $datass['live_paystack_apikey'] = $this->input->post('value');
                    $datass['live_paystack_secret_apikey'] = $this->input->post('api_key');
                    $datass['paystack_show'] = $this->input->post('paystack_show');
                }
                $paystack_option = settingValue('paystack_option');
                
                if (!empty($paystack_option)) {
                    $this->db->where('key', 'paystack_option')->update('system_settings', ['value' => $id]);
                } else {
                    $this->db->insert('system_settings', ['key' => 'paystack_option', 'value' => $id]);
                }

                foreach ($datass AS $key => $val) {
                    $this->db->where('key', $key);
                    $this->db->delete('system_settings');
                    $table_data['key'] = $key;
                    $table_data['value'] = $val;
                    $table_data['system'] = 1;
                    $table_data['groups'] = 'config';
                    $table_data['update_date'] = date('Y-m-d');
                    $table_data['status'] = 1;
                    $this->db->insert('system_settings', $table_data);
                }

                $message = 'Payment gateway edit successfully';
            }
            $this->session->set_flashdata('success_message', $message);
            redirect(base_url() . 'admin/paystack-payment-gateway');
        }

        $this->data['list'] = $this->admin->edit_paystack_payment_gateway($id);
        $this->data['page'] = 'paystack_payment_gateway';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    //App Section 
    public function appsection() {
        $data = $this->input->post();
        if ($this->input->post('form_submit')) {
            $this->common_model->checkAdminLogin();
                if ($data) {
                    if (isset($data['download_showhide'])) {
                        $data['download_showhide'] = 1;
                    } else {
                        $data['download_showhide'] = 0;
                    }
                    foreach ($data AS $key => $val) {
                        if ($key != 'form_submit') {
                            $this->db->where('key', $key);
                            $this->db->delete('system_settings');
                            $table_data['key'] = $key;
                            $table_data['value'] = $val;
                            $table_data['system'] = 1;
                            $table_data['groups'] = 'config';
                            $table_data['update_date'] = date('Y-m-d');
                            $table_data['status'] = 1;
                            $this->db->insert('system_settings', $table_data);
                        }
                    }
                     $this->session->set_flashdata('success_message', 'Popular Services Details updated successfully');
                redirect(base_url() . 'admin/pages');
                }
        }

        $this->data['appsection_showhide'] = settingValue('download_showhide');
        $this->data['app_store_link'] = settingValue('app_store_link');
        $this->data['play_store_link'] = settingValue('play_store_link');
        $this->data['page'] = 'appsection';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function systemSetting() {
        $this->common_model->checkAdminUserPermission(42);
        if($this->input->post('form_submit') == true) {
            $this->common_model->checkAdminLogin();
            $map_details = $this->db->get_where('system_settings', array('key'=>'map_key'))->row();
            $apikey_details = $this->db->get_where('system_settings', array('key'=>'firebase_server_key'))->row();

            if($this->input->post('map_key')) {
                if(empty($map_details)) {
                    $table_data['key'] = 'map_key';
                    $table_data['value'] = $this->input->post('map_key');
                    $table_data['system'] = 1;
                    $table_data['groups'] = 'config';
                    $table_data['update_date'] = date('Y-m-d');
                    $table_data['status'] = 1;
                    $this->db->insert('system_settings', $table_data);
                } else {
                    $where = array('key' => 'map_key');
                    $table_data['key'] = 'map_key';
                    $table_data['value'] = $this->input->post('map_key');
                    $table_data['system'] = 1;
                    $table_data['groups'] = 'config';
                    $table_data['update_date'] = date('Y-m-d');
                    $table_data['status'] = 1;
                    $this->admin->update_data('system_settings', $table_data, $where);
                }
            }
            if($this->input->post('firebase_server_key')) {
                if(empty($apikey_details)) {
                    $table_data['key'] = 'firebase_server_key';
                    $table_data['value'] = $this->input->post('firebase_server_key');
                    $table_data['system'] = 1;
                    $table_data['groups'] = 'config';
                    $table_data['update_date'] = date('Y-m-d');
                    $table_data['status'] = 1;
                    $this->db->insert('system_settings', $table_data);
                } else {
                    $where = array('key' => 'firebase_server_key');
                    $table_data['key'] = 'firebase_server_key';
                    $table_data['value'] = $this->input->post('firebase_server_key');
                    $table_data['system'] = 1;
                    $table_data['groups'] = 'config';
                    $table_data['update_date'] = date('Y-m-d');
                    $table_data['status'] = 1;
                    $this->admin->update_data('system_settings', $table_data, $where);
                }
            }
            $this->session->set_flashdata('success_message', 'Details updated successfully');
            redirect(base_url() . 'admin/system-settings');
        }
        $this->data['firebase_server_key'] = settingValue('firebase_server_key');
        $this->data['map_key'] = settingValue('map_key');
        $this->data['page'] = 'system_settings';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function localization() {
        $this->common_model->checkAdminUserPermission(28);
         $data = $this->input->post();

        if ($this->input->post('form_submit')) {
            $this->common_model->checkAdminLogin();
                foreach ($data AS $key => $val) {
                    if ($key != 'form_submit') {
                        $this->db->where('key', $key);
                        $this->db->delete('system_settings');
                        $table_data['key'] = $key;
                        $table_data['value'] = $val;
                        $table_data['system'] = 1;
                        $table_data['groups'] = 'config';
                        $table_data['update_date'] = date('Y-m-d');
                        $table_data['status'] = 1;
                        $this->db->insert('system_settings', $table_data);
                        
                    }
                }
             if($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success_message', 'Localization updated successfully');
                redirect($_SERVER["HTTP_REFERER"]);
            } else {
                $this->session->set_flashdata('error_message', 'Something went wront, Try again');
                redirect($_SERVER["HTTP_REFERER"]);
            }
            }
        $this->data['currency_symbol'] = currency_code_symbol();
        $this->data['page'] = 'localization';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }
    public function get_currnecy_symbol() {
        $code = $this->input->post('id');
        $result = currency_code_sign($code);
        echo $result;
    }

    //Update Social settings details
    public function socialSetting() {
        $this->common_model->checkAdminUserPermission(29);
        if($this->input->post('form_submit') == true) {
            $this->common_model->checkAdminLogin();
            $data = $this->input->post();
            $table_data = array();
            foreach ($data AS $key => $val) {
                if ($key != 'form_submit') {
                    $data_details = $this->db->get_where('system_settings', array('key'=>$key))->row();
                    $table_data = array(
                        'key' => $key,
                        'value' => $val,
                        'system' => 1,
                        'groups' => 'config',
                        'update_date' => date('Y-m-d'),
                        'status' => 1
                    );
                    if(empty($data_details)) {
                        $this->db->insert('system_settings', $table_data);
                    } else {
                        $where = array('key' => $key);
                        $this->db->update('system_settings', $table_data, $where);
                    }
                    
                }
            }
            $this->session->set_flashdata('success_message', 'Details updated successfully');
            redirect(base_url() . 'admin/social-settings');
        }
        $this->data['login_type'] = settingValue('login_type');
        $this->data['otp_by'] = settingValue('otp_by');
        $this->data['page'] = 'social_settings';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

     public function frontSetting() {
        $this->data['page'] = 'localization';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function footerSetting() {
        $this->common_model->checkAdminUserPermission(40);
        $this->data['category_widget'] = $this->admin->category_wid_list();
        $this->data['contact_widget'] = $this->admin->contact_wid_list();
        $this->data['social_widget'] = $this->admin->social_wid_list();
        $this->data['page'] = 'footerSetting';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function pages() {
        $this->common_model->checkAdminUserPermission(41);
        $this->data['pages'] = $this->db->get('page_content')->result();
        $this->data['page'] = 'pages';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    } 
    public function seoSetting() {
        $this->common_model->checkAdminUserPermission(32);
         if($this->input->post("form_submit") == true) {
            $this->common_model->checkAdminLogin();
            $data = $this->input->post();
            $query = $this->db->query("select * from language WHERE status = '1'");
            $languages = $query->result();
            foreach ($languages as $language) {
                $seo_val = array(
                    'meta_title' => $this->input->post('meta_title_' . $language->id, true),
                    'meta_keyword' => $this->input->post('meta_keyword_' . $language->id, true),
                    'meta_desc' => $this->input->post('meta_desc_' . $language->id, true),
                    'lang_type' => $language->language_value,
                    'modules' => 'seo',
                );
                $this->db->where('modules', 'seo');
                $this->db->where('lang_type', $language->language_value);
                $seo = $this->db->get('seo')->row();
                if (empty($seo)) {
                    $this->db->insert('seo', $seo_val);
                } else {
                    $this->db->where('modules', 'seo');
                    $this->db->where('lang_type', $language->language_value);
                    $this->db->update('seo', $seo_val);
                }

             
            }
            /*$table_data = array();
            foreach ($data AS $key => $val) {
                if ($key != 'form_submit') {
                    $data_details = $this->db->get_where('system_settings', array('key'=>$key))->row();
                    $table_data = array(
                        'key' => $key,
                        'value' => $val,
                        'system' => 1,
                        'groups' => 'config',
                        'update_date' => date('Y-m-d'),
                        'status' => 1
                    );
                    if(empty($data_details)) {
                        $this->db->insert('system_settings', $table_data);
                    } else {
                        $where = array('key' => $key);
                        $this->db->update('system_settings', $table_data, $where);
                    }
                    
                }
            }*/
            
            $this->session->set_flashdata('success_message', 'SEO Details updated successfully');
            redirect(base_url() . 'admin/seo-settings');
        }
        $results = $this->admin->get_setting_list();
        foreach ($results AS $config) {
            $this->data[$config['key']] = $config['value'];
        }
        $this->data['page'] = 'seo_settings';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }
    public function home_page() {
        $this->data['featured'] = $this->db->get_where('categories', array('is_featured'=>1, 'status'=>1))->result_array();
        $this->data['list'] = $this->admin->GetBannersettings();
        $this->data['service'] = $this->admin->Getpopularsettings();
        $this->data['lists'] = $this->admin->homebannersettings();
        $this->data['popular_search'] = $this->admin->homepopular_searchsettings();
        $this->data['featureds'] = $this->admin->homefeaturedsettings();
        $this->data['latest'] = $this->admin->homelatestsettings();
        $this->data['popular'] = $this->admin->homepopularsettings();
        $this->data['featured_ser'] = $this->admin->homefeatured_sersettings();
        $this->data['how_it_works'] = $this->admin->homehowsettings();
        $this->data['step_1'] = $this->admin->homestep1settings();
        $this->data['step_2'] = $this->admin->homestep2settings();
        $this->data['step_3'] = $this->admin->homestep3settings();
        $this->data['blogs'] = $this->admin->homeblogsettings();
        $this->data['download'] = $this->admin->homedownloadsettings();
        $this->data['page'] = 'home_page';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    } 

    public function bannersettings() {
        $this->common_model->checkAdminUserPermission(24);
        $title = $this->input->post('bgimg_for');
        if($this->input->post("form_submit") == true) {
            $this->common_model->checkAdminLogin();
                $post_data = $this->input->post();
                $lan_id = implode(',', $post_data['id']);
                $query = $this->db->query("select * from language WHERE status = '1'");
                $languages = $query->result();
                foreach ($languages as $language) {
                    $data = array(
                        'modules' => 'banner',
                        'title' => $this->input->post('banner_content_' . $language->id, true),
                        'content' => $this->input->post('banner_sub_content_' . $language->id, true),
                        'lang_type' => $language->language_value
                    );

                    $this->db->where('modules', 'banner');
                    $this->db->where('lang_type', $language->language_value);
                    $row = $this->db->get('home_settings')->row();
                    if (empty($row)) {
                        $this->db->insert('home_settings', $data);
                    } else {
                        $this->db->where('modules', 'banner');
                        $this->db->where('lang_type', $language->language_value);
                        $this->db->update('home_settings', $data);
                    }

                 
                }
                $banner_title = $this->db->get_where('bgimage', array('bgimg_id'=> 1))->row();
                $uploaded_file_name = '';
                if (isset($_FILES) && isset($_FILES['upload_image']['name']) && !empty($_FILES['upload_image']['name'])) {
                    $uploaded_file_name = $_FILES['upload_image']['name'];
                    $uploaded_file_name_arr = explode('.', $uploaded_file_name);
                    $filename = isset($uploaded_file_name_arr[0]) ? $uploaded_file_name_arr[0] : '';
                    $this->load->library('common');
                    $upload_sts = $this->common->global_file_upload('uploads/banners/', 'upload_image', time() . $filename);

                    if (isset($upload_sts['success']) && $upload_sts['success'] == 'y') {
                        $uploaded_file_name = $upload_sts['data']['file_name'];

                        if (!empty($uploaded_file_name)) {
                            $image_url = 'uploads/banners/' . $uploaded_file_name;                    }
                    }
                }else {
                    $image_url = $banner_title->upload_image;
                }
                $table_data = array(
                    'banner_settings' => ($post_data['banner_showhide'])?'1':'0',
                    'main_search' => ($post_data['main_showhide'])?'1':'0',
                    'popular_search' => ($post_data['popular_showhide'])?'1':'0',
                    'upload_image' => $image_url,
                    'popular_label' => $post_data['popular_label']
                );
                if(empty($banner_title)) {
                    $table_data['created_datetime'] =date('Y-m-d H:i:s');
                    $this->db->insert('bgimage', $table_data);
                } else {  
                    $where = array('bgimg_id' => 1);
                    $table_data['updated_datetime'] =date('Y-m-d H:i:s');
                    $this->admin->update_data('bgimage', $table_data, $where);
                }
                
                $this->session->set_flashdata('success_message', 'Bannersettings Details updated successfully');
                redirect(base_url() . 'settings/home-page/17');
        }
    }

    public function howitworks() {
        $data = $this->input->post();
        if ($this->input->post('form_submit')) {
            $this->common_model->checkAdminLogin();
                $post_data = $this->input->post();
                $lan_id = implode(',', $post_data['id']);
                $query = $this->db->query("select * from language WHERE status = '1'");
                $languages = $query->result();
                foreach ($languages as $language) {
                    $how_it = array(
                        'modules' => 'how_it_works',
                        'title' => $this->input->post('how_title_' . $language->id, true),
                        'content' => $this->input->post('how_content_' . $language->id, true),
                        'lang_type' => $language->language_value
                    );

                    $this->db->where('modules', 'how_it_works');
                    $this->db->where('lang_type', $language->language_value);
                    $row = $this->db->get('home_settings')->row();
                    if (empty($row)) {
                        $this->db->insert('home_settings', $how_it);
                    } else {
                        $this->db->where('modules', 'how_it_works');
                        $this->db->where('lang_type', $language->language_value);
                        $this->db->update('home_settings', $how_it);
                    }

                    $how_it_1 = array(
                        'modules' => 'step_1',
                        'title' => $this->input->post('how_title_1_' . $language->id, true),
                        'content' => $this->input->post('how_content_1_' . $language->id, true),
                        'lang_type' => $language->language_value
                    );

                    $this->db->where('modules', 'step_1');
                    $this->db->where('lang_type', $language->language_value);
                    $row = $this->db->get('home_settings')->row();
                    if (empty($row)) {
                        $this->db->insert('home_settings', $how_it_1);
                    } else {
                        $this->db->where('modules', 'step_1');
                        $this->db->where('lang_type', $language->language_value);
                        $this->db->update('home_settings', $how_it_1);
                    }

                    $how_it_2 = array(
                        'modules' => 'step_2',
                        'title' => $this->input->post('how_title_2_' . $language->id, true),
                        'content' => $this->input->post('how_content_2_' . $language->id, true),
                        'lang_type' => $language->language_value
                    );

                    $this->db->where('modules', 'step_2');
                    $this->db->where('lang_type', $language->language_value);
                    $row = $this->db->get('home_settings')->row();
                    if (empty($row)) {
                        $this->db->insert('home_settings', $how_it_2);
                    } else {
                        $this->db->where('modules', 'step_2');
                        $this->db->where('lang_type', $language->language_value);
                        $this->db->update('home_settings', $how_it_2);
                    }

                    $how_it_3 = array(
                        'modules' => 'step_3',
                        'title' => $this->input->post('how_title_3_' . $language->id, true),
                        'content' => $this->input->post('how_content_3_' . $language->id, true),
                        'lang_type' => $language->language_value
                    );

                    $this->db->where('modules', 'step_3');
                    $this->db->where('lang_type', $language->language_value);
                    $row = $this->db->get('home_settings')->row();
                    if (empty($row)) {
                        $this->db->insert('home_settings', $how_it_3);
                    } else {
                        $this->db->where('modules', 'step_3');
                        $this->db->where('lang_type', $language->language_value);
                        $this->db->update('home_settings', $how_it_3);
                    }

                 
                }


               if ($data) {
                    if (isset($data['how_showhide'])) {
                        $data['how_showhide'] = '1';
                    } else {
                        $data['how_showhide'] = '0';
                    }

                    $uploaded_file_name = '';
                    if (isset($_FILES) && isset($_FILES['how_title_img_1']['name']) && !empty($_FILES['how_title_img_1']['name'])) {
                        $uploaded_file_name = $_FILES['how_title_img_1']['name'];
                        $uploaded_file_name_arr = explode('.', $uploaded_file_name);
                        $filename = isset($uploaded_file_name_arr[0]) ? $uploaded_file_name_arr[0] : '';
                        $this->load->library('common');
                        $upload_sts = $this->common->global_file_upload('uploads/banners/', 'how_title_img_1', time() . $filename);

                        if (isset($upload_sts['success']) && $upload_sts['success'] == 'y') {
                            $uploaded_file_name = $upload_sts['data']['file_name'];

                            if (!empty($uploaded_file_name)) {
                                $image_url_1= 'uploads/banners/' . $uploaded_file_name;                    }
                        }
                    }
                    else {
                    $image_url_1 = settingValue('how_title_img_1');
                    }

                    $uploaded_file_name = '';
                    if (isset($_FILES) && isset($_FILES['how_title_img_2']['name']) && !empty($_FILES['how_title_img_2']['name'])) {
                        $uploaded_file_name = $_FILES['how_title_img_2']['name'];
                        $uploaded_file_name_arr = explode('.', $uploaded_file_name);
                        $filename = isset($uploaded_file_name_arr[0]) ? $uploaded_file_name_arr[0] : '';
                        $this->load->library('common');
                        $upload_sts = $this->common->global_file_upload('uploads/banners/', 'how_title_img_2', time() . $filename);

                        if (isset($upload_sts['success']) && $upload_sts['success'] == 'y') {
                            $uploaded_file_name = $upload_sts['data']['file_name'];

                            if (!empty($uploaded_file_name)) {
                                $image_url_2 = 'uploads/banners/' . $uploaded_file_name;                    }
                        }
                    }
                    else {
                    $image_url_2 =settingValue('how_title_img_2');
                    }


                    $uploaded_file_name = '';
                    if (isset($_FILES) && isset($_FILES['how_title_img_3']['name']) && !empty($_FILES['how_title_img_3']['name'])) {
                        $uploaded_file_name = $_FILES['how_title_img_3']['name'];
                        $uploaded_file_name_arr = explode('.', $uploaded_file_name);
                        $filename = isset($uploaded_file_name_arr[0]) ? $uploaded_file_name_arr[0] : '';

                        $this->load->library('common');
                        $upload_sts = $this->common->global_file_upload('uploads/banners/', 'how_title_img_3', time() . $filename);

                        if (isset($upload_sts['success']) && $upload_sts['success'] == 'y') {
                            $uploaded_file_name = $upload_sts['data']['file_name'];

                            if (!empty($uploaded_file_name)) {
                                $image_url_3 = 'uploads/banners/' . $uploaded_file_name;                    }
                        }
                    }
                    else {
                    $image_url_3 = settingValue('how_title_img_3');
                    }
                    $data['how_title_img_1'] = $image_url_1;
                    $data['how_title_img_2'] = $image_url_2;
                    $data['how_title_img_3'] = $image_url_3;
                    
                    foreach ($data AS $key => $val) {
                        if ($key != 'form_submit') {
                            $this->db->where('key', $key);
                            $this->db->delete('system_settings');
                            $table_data['key'] = $key;
                            $table_data['value'] = $val;
                            $table_data['system'] = 1;
                            $table_data['groups'] = 'config';
                            $table_data['update_date'] = date('Y-m-d');
                            $table_data['status'] = 1;
                            $this->db->insert('system_settings', $table_data);
                        }
                    }
                $this->session->set_flashdata('success_message', 'How It Works Details updated successfully');
                redirect(base_url() . 'settings/home-page/17');
                }
        }
    }

    public function popularservices() {
         $data = $this->input->post();
        if ($this->input->post('form_submit')) {
            $this->common_model->checkAdminLogin();
                $post_data = $this->input->post();
                $lan_id = implode(',', $post_data['id']);
                $query = $this->db->query("select * from language WHERE status = '1'");
                $languages = $query->result();
                foreach ($languages as $language) {
                    $pop = array(
                        'modules' => 'popular',
                        'title' => $this->input->post('title_services_' . $language->id, true),
                        'content' => $this->input->post('content_services_' . $language->id, true),
                        'lang_type' => $language->language_value
                    );
                    $this->db->where('modules', 'popular');
                    $this->db->where('lang_type', $language->language_value);
                    $row = $this->db->get('home_settings')->row();
                    if (empty($row)) {
                        $this->db->insert('home_settings', $pop);
                    } else {
                        $this->db->where('modules', 'popular');
                        $this->db->where('lang_type', $language->language_value);
                        $this->db->update('home_settings', $pop);
                    }

                 
                }



                if ($data) {
                    if (isset($data['popular_ser_showhide'])) {
                        $data['popular_ser_showhide'] = '1';
                    } else {
                        $data['popular_ser_showhide'] = '0';
                    }
                    foreach ($data AS $key => $val) {
                        if ($key != 'form_submit') {
                            $this->db->where('key', $key);
                            $this->db->delete('system_settings');
                            $table_data['key'] = $key;
                            $table_data['value'] = $val;
                            $table_data['system'] = 1;
                            $table_data['groups'] = 'config';
                            $table_data['update_date'] = date('Y-m-d');
                            $table_data['status'] = 1;
                            $this->db->insert('system_settings', $table_data);
                        }
                    }
                $this->session->set_flashdata('success_message', 'Popular Services Details updated successfully');
                redirect(base_url() . 'settings/home-page/17');
                }
        }
    }

    public function newestservices() {
         $data = $this->input->post();
        if ($this->input->post('form_submit')) {
            $this->common_model->checkAdminLogin();
                $post_data = $this->input->post();
                $lan_id = implode(',', $post_data['id']);
                $query = $this->db->query("select * from language WHERE status = '1'");
                $languages = $query->result();
                foreach ($languages as $language) {
                    $lat = array(
                        'modules' => 'latest',
                        'title' => $this->input->post('new_title_services_' . $language->id, true),
                        'content' => $this->input->post('new_content_services_' . $language->id, true),
                        'lang_type' => $language->language_value
                    );
                    $this->db->where('modules', 'latest');
                    $this->db->where('lang_type', $language->language_value);
                    $row = $this->db->get('home_settings')->row();
                    if (empty($row)) {
                        $this->db->insert('home_settings', $lat);
                    } else {
                        $this->db->where('modules', 'latest');
                        $this->db->where('lang_type', $language->language_value);
                        $this->db->update('home_settings', $lat);
                    }

                 
                }


                if ($data) {
                    if (isset($data['newest_ser_showhide'])) {
                        $data['newest_ser_showhide'] = '1';
                    } else {
                        $data['newest_ser_showhide'] = '0';
                    }
                    foreach ($data AS $key => $val) {
                        if ($key != 'form_submit') {
                            $this->db->where('key', $key);
                            $this->db->delete('system_settings');
                            $table_data['key'] = $key;
                            $table_data['value'] = $val;
                            $table_data['system'] = 1;
                            $table_data['groups'] = 'config';
                            $table_data['update_date'] = date('Y-m-d');
                            $table_data['status'] = 1;
                            $this->db->insert('system_settings', $table_data);
                        }
                    }
                    $this->session->set_flashdata('success_message', 'Popular Services Details updated successfully');
                    redirect(base_url() . 'settings/home-page/17');
                }
        }
    }


    public function topratingservices() {
         $data = $this->input->post();
        if ($this->input->post('form_submit')) {
            $this->common_model->checkAdminLogin();
                $post_data = $this->input->post();
                $lan_id = implode(',', $post_data['id']);
                $query = $this->db->query("select * from language WHERE status = '1'");
                $languages = $query->result();
                foreach ($languages as $language) {
                    $fea_ser = array(
                        'modules' => 'featured_services',
                        'title' => $this->input->post('rating_title_services_' . $language->id, true),
                        'content' => $this->input->post('rating_content_services_' . $language->id, true),
                        'lang_type' => $language->language_value
                    );
                    $this->db->where('modules', 'featured_services');
                    $this->db->where('lang_type', $language->language_value);
                    $row = $this->db->get('home_settings')->row();
                    if (empty($row)) {
                        $this->db->insert('home_settings', $fea_ser);
                    } else {
                        $this->db->where('modules', 'featured_services');
                        $this->db->where('lang_type', $language->language_value);
                        $this->db->update('home_settings', $fea_ser);
                    }

                 
                }
                if ($data) {
                    if (isset($data['top_rating_showhide'])) {
                        $data['top_rating_showhide'] = '1';
                    } else {
                        $data['top_rating_showhide'] = '0';
                    }
                    foreach ($data AS $key => $val) {
                        if ($key != 'form_submit') {
                            $this->db->where('key', $key);
                            $this->db->delete('system_settings');
                            $table_data['key'] = $key;
                            $table_data['value'] = $val;
                            $table_data['system'] = 1;
                            $table_data['groups'] = 'config';
                            $table_data['update_date'] = date('Y-m-d');
                            $table_data['status'] = 1;
                            $this->db->insert('system_settings', $table_data);
                        }
                    }
                    $this->session->set_flashdata('success_message', 'Featured Services Details updated successfully');
                    redirect(base_url() . 'settings/home-page/17');
                }
        }
    }


    public function download_sec() {
         $data = $this->input->post();
        if ($this->input->post('form_submit')) {
            $this->common_model->checkAdminLogin();
                $post_data = $this->input->post();
                $lan_id = implode(',', $post_data['id']);
                $query = $this->db->query("select * from language WHERE status = '1'");
                $languages = $query->result();
                foreach ($languages as $language) {
                    $down_sec = array(
                        'modules' => 'download_sec',
                        'title' => $this->input->post('download_title_' . $language->id, true),
                        'content' => $this->input->post('download_content_' . $language->id, true),
                        'lang_type' => $language->language_value
                    );
                    $this->db->where('modules', 'download_sec');
                    $this->db->where('lang_type', $language->language_value);
                    $row = $this->db->get('home_settings')->row();
                    if (empty($row)) {
                        $this->db->insert('home_settings', $down_sec);
                    } else {
                        $this->db->where('modules', 'download_sec');
                        $this->db->where('lang_type', $language->language_value);
                        $this->db->update('home_settings', $down_sec);
                    }

                 
                }
                
                if ($data) {
                    if (isset($data['download_showhide'])) {
                        $data['download_showhide'] = '1';
                    } else {
                        $data['download_showhide'] = '0';
                    }
                    $uploaded_file_name = '';
                    if (isset($_FILES) && isset($_FILES['app_store_img']['name']) && !empty($_FILES['app_store_img']['name'])) {
                        $uploaded_file_name = $_FILES['app_store_img']['name'];
                        $uploaded_file_name_arr = explode('.', $uploaded_file_name);
                        $filename = isset($uploaded_file_name_arr[0]) ? $uploaded_file_name_arr[0] : '';

                        $this->load->library('common');
                        $upload_sts = $this->common->global_file_upload('uploads/banners/', 'app_store_img', time() . $filename);

                        if (isset($upload_sts['success']) && $upload_sts['success'] == 'y') {
                            $uploaded_file_name = $upload_sts['data']['file_name'];

                            if (!empty($uploaded_file_name)) {
                                $app_store_img1 = 'uploads/banners/' . $uploaded_file_name;                    }
                        }
                    }
                    else {
                    $app_store_img1 = settingValue('app_store_img');
                    }
                    $uploaded_file_name = '';
                    if (isset($_FILES) && isset($_FILES['play_store_img']['name']) && !empty($_FILES['play_store_img']['name'])) {
                        $uploaded_file_name = $_FILES['play_store_img']['name'];
                        $uploaded_file_name_arr = explode('.', $uploaded_file_name);
                        $filename = isset($uploaded_file_name_arr[0]) ? $uploaded_file_name_arr[0] : '';

                        $this->load->library('common');
                        $upload_sts = $this->common->global_file_upload('uploads/banners/', 'play_store_img', time() . $filename);

                        if (isset($upload_sts['success']) && $upload_sts['success'] == 'y') {
                            $uploaded_file_name = $upload_sts['data']['file_name'];

                            if (!empty($uploaded_file_name)) {
                                $play_store_img1 = 'uploads/banners/' . $uploaded_file_name;                    }
                        }
                    } else {
                    $play_store_img1 =settingValue('play_store_img');
                    }
                    $data['play_store_img'] = $play_store_img1;
                    $data['app_store_img'] = $app_store_img1;
                     foreach ($data AS $key => $val) {
                        if ($key != 'form_submit') {
                            $this->db->where('key', $key);
                            $this->db->delete('system_settings');
                            $table_data['key'] = $key;
                            $table_data['value'] = $val;
                            $table_data['system'] = 1;
                            $table_data['groups'] = 'config';
                            $table_data['update_date'] = date('Y-m-d');
                            $table_data['status'] = 1;
                            $this->db->insert('system_settings', $table_data);
                        }
                    }
                $this->session->set_flashdata('success_message', 'Download Section Details updated successfully');
                redirect(base_url() . 'settings/home-page/17');
                }
        }
    }

    /*Blog Section Start*/
    public function blog_sec() {
         $data = $this->input->post();

        if ($this->input->post('form_submit')) {
            $this->common_model->checkAdminLogin();
                $post_data = $this->input->post();
                $lan_id = implode(',', $post_data['id']);
                $query = $this->db->query("select * from language WHERE status = '1'");
                $languages = $query->result();
                foreach ($languages as $language) {
                    $blog_val = array(
                        'modules' => 'blog',
                        'title' => $this->input->post('blog_title_' . $language->id, true),
                        'content' => $this->input->post('blog_content_' . $language->id, true),
                        'lang_type' => $language->language_value
                    );

                    $this->db->where('modules', 'blog');
                    $this->db->where('lang_type', $language->language_value);
                    $row = $this->db->get('home_settings')->row();
                    if (empty($row)) {
                        $this->db->insert('home_settings', $blog_val);
                    } else {
                        $this->db->where('modules', 'blog');
                        $this->db->where('lang_type', $language->language_value);
                        $this->db->update('home_settings', $blog_val);
                    }

                 
                }
                
                if ($data) {
                    if (isset($data['blog_showhide'])) {
                        $data['blog_showhide'] = '1';
                    } else {
                        $data['blog_showhide'] = '0';
                    }
                    $this->db->where('key', 'blog_showhide');
                    $this->db->delete('system_settings');
                    $table_data['key'] = 'blog_showhide';
                    $table_data['value'] = $data['blog_showhide'];
                    $table_data['system'] = 1;
                    $table_data['groups'] = 'config';
                    $table_data['update_date'] = date('Y-m-d');
                    $table_data['status'] = 1;
                    $this->db->insert('system_settings', $table_data);
                    $this->session->set_flashdata('success_message', 'Blog Section Details updated successfully');
                    redirect(base_url() . 'settings/home-page/17');
                }
        }
    }
    /*Blog Section End*/

     public function featured_categories() {
        $data = $this->input->post();
        //echo '<pre>'; print_r($data); exit;
        if ($this->input->post('form_submit')) {
            $this->common_model->checkAdminLogin();
            //if($this->data['status'] == 1) {
                $post_data = $this->input->post();
                $lan_id = implode(',', $post_data['id']);
                $query = $this->db->query("select * from language WHERE status = '1'");
                $languages = $query->result();
                foreach ($languages as $language) {
                    $val = array(
                        'modules' => 'featured',
                        'title' => $this->input->post('featured_title_' . $language->id, true),
                        'content' => $this->input->post('featured_content_' . $language->id, true),
                        'lang_type' => $language->language_value
                    );
                    $this->db->where('modules', 'featured');
                    $this->db->where('lang_type', $language->language_value);
                    $row = $this->db->get('home_settings')->row();
                    if (empty($row)) {
                        $this->db->insert('home_settings', $val);
                    } else {
                        $this->db->where('modules', 'featured');
                        $this->db->where('lang_type', $language->language_value);
                        $this->db->update('home_settings', $val);
                    }

                 
                }


                if ($data) {
                    if (isset($data['featured_showhide'])) {
                        $data['featured_showhide'] = '1';
                    } else {
                        $data['featured_showhide'] = '0';
                    }

                    $datas = array(
                        'featured_showhide' => $data['featured_showhide'],
                        'featured_title' => $data['featured_title'],
                        'featured_content' => $data['featured_content'],
                        'featured_categories' => $data['selected_categories1']
                    );
                    foreach ($datas AS $key => $val) {
                        $getdata = $this->db->get_where('system_settings', array('key' => $key))->row();
                        $table_data = array(
                            'key' => $key,
                            'value' => $val,
                            'system' => 1,
                            'groups' => 'config',
                            'update_date' => date('Y-m-d'),
                            'status' => 1
                        );
                        if(empty($getdata)) {
                            $this->db->insert('system_settings', $table_data);
                        } else {
                            $this->db->where('key',$key);
                            $this->db->update('system_settings',$table_data);
                        }
                    }

                $this->session->set_flashdata('success_message', 'Featured Categories Details updated successfully');
                redirect(base_url() . 'settings/home-page/17');
                }
        /*} else {
            $this->session->set_flashdata('error_message', 'Something went wrong, Try again');
            redirect(base_url() . 'settings/home-page/17');
        }*/
    }
}
    public function page_status(){
        $this->common_model->checkAdminLogin();
            $id=$this->input->post('status_id');
            $table_data['status'] =$this->input->post('status');
            $this->db->where('id',$id);
            if($this->db->update('page_content',$table_data)){ 
              echo "success";
            } else {
              echo "error";
            }
        
    }

    public function page_list_status(){
        if($this->session->userdata('role') != 1 && settingValue('demo_access') == 0) {
            echo "failure"; exit;
        } else {
            $id=$this->input->post('status_id');
            $table_data['visibility'] =$this->input->post('status');
            $this->db->where('id',$id);
            if($this->db->update('pages_list',$table_data)){ 
              echo "success";
            } else {
              echo "error";
            }
        }
        
    }

    public function analytics() {
        $this->common_model->checkAdminUserPermission(37);
        $data = $this->input->post();
        if ($this->input->post('form_submit')) {
            $this->common_model->checkAdminLogin();
          if ($data) {
                if (isset($data['analytics_showhide'])) {
                    $data['analytics_showhide'] = '1';
                } else {
                    $data['analytics_showhide'] = '0';
                }
                foreach ($data AS $key => $val) {
                    if ($key != 'form_submit') {
                        $this->db->where('key', $key);
                        $this->db->delete('system_settings');
                        $table_data['key'] = $key;
                        $table_data['value'] = $val;
                        $table_data['system'] = 1;
                        $table_data['groups'] = 'config';
                        $table_data['update_date'] = date('Y-m-d');
                        $table_data['status'] = 1;
                        $this->db->insert('system_settings', $table_data);
                    }
                }
            $this->session->set_flashdata('success_message', 'Google Analytics Details updated successfully');
            redirect(base_url() . 'admin/other-settings');
            }
        }
    }

    public function cookies() {
        $this->common_model->checkAdminUserPermission(37);
        $data = $this->input->post();
        if ($this->input->post('form_submit')) {
            $this->common_model->checkAdminLogin();
        $query = $this->db->query("select * from language WHERE status = '1'");
        $languages = $query->result();
        foreach ($languages as $language) {
            $datas = array(
                'lang_type' => $language->language_value,
                'modules' => 'cookie',
                'cookie_name' => $this->input->post('cookies_' . $language->id, true)
            );
            $lang_check = $this->admin->check_language($datas['modules'],$datas['lang_type']);
            if ($lang_check != ''){
                $this->db->where('id', $lang_check)->update('cookies', $datas);
            } else {
                $this->db->insert('cookies' ,$datas);
            }
        }
           if ($data) {
                if (isset($data['cookies_showhide'])) {
                    $data['cookies_showhide'] = '1';
                } else {
                    $data['cookies_showhide'] = '0';
                }
                foreach ($data AS $key => $val) {
                    if ($key != 'form_submit') {
                        $this->db->where('key', $key);
                        $this->db->delete('system_settings');
                        $table_data['key'] = $key;
                        $table_data['value'] = $val;
                        $table_data['system'] = 1;
                        $table_data['groups'] = 'config';
                        $table_data['update_date'] = date('Y-m-d');
                        $table_data['status'] = 1;
                        $this->db->insert('system_settings', $table_data);
                    }
                }
            $this->session->set_flashdata('success_message', 'Cookies Agreement Details updated successfully');
            redirect(base_url() . 'admin/other-settings');
            }
        }
    }

    public function socket() {
        $this->common_model->checkAdminUserPermission(38);
        $data = $this->input->post();
        if ($this->input->post('form_submit')) {
            $this->common_model->checkAdminLogin();
            if ($data) {
                if (isset($data['socket_showhide'])) {
                    $data['socket_showhide'] = '1';
                } else {
                    $data['socket_showhide'] = '0';
                }
                foreach ($data AS $key => $val) {
                    if ($key != 'form_submit') {
                        $this->db->where('key', $key);
                        $this->db->delete('system_settings');
                        $table_data['key'] = $key;
                        $table_data['value'] = $val;
                        $table_data['system'] = 1;
                        $table_data['groups'] = 'config';
                        $table_data['update_date'] = date('Y-m-d');
                        $table_data['status'] = 1;
                        $this->db->insert('system_settings', $table_data);
                    }
                }
            $this->session->set_flashdata('success_message', 'Socket Details updated successfully');
            redirect(base_url() . 'admin/chat-settings');
            }
        }
    }

     public function chat() {
        $this->common_model->checkAdminUserPermission(38);
        $data = $this->input->post();
        if ($this->input->post('form_submit')) {
            $this->common_model->checkAdminLogin();
            if ($data) {
                if (isset($data['chat_showhide'])) {
                    $data['chat_showhide'] = '1';
                } else {
                    $data['chat_showhide'] = '0';
                }
                foreach ($data AS $key => $val) {
                    if ($key != 'form_submit') {
                        $this->db->where('key', $key);
                        $this->db->delete('system_settings');
                        $table_data['key'] = $key;
                        $table_data['value'] = $val;
                        $table_data['system'] = 1;
                        $table_data['groups'] = 'config';
                        $table_data['update_date'] = date('Y-m-d');
                        $table_data['status'] = 1;
                        $this->db->insert('system_settings', $table_data);
                    }
                }
            $this->session->set_flashdata('success_message', 'Chat Details updated successfully');
            redirect(base_url() . 'admin/chat-settings');
            }
        }
    }


    public function midtrans_payment_gateway() {
		$this->common_model->checkAdminUserPermission(14);  
        $id = settingValue('stripe_option');
        // echo $id;
        // exit;
        if (!empty($id)) {
            $this->data['list'] = $this->admin->midtrans_payment_gateway($id);
           
        } else {
            $this->data['list'] = [];
            $this->data['list']['id'] = '';
            $this->data['list']['gateway_type'] = '';
            $this->data['gateway_type'] = '';
        }
        $this->data['page'] = 'midtrans_payment_gateway';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

     public function midtrans_edit($id = NULL) {
        $this->common_model->checkAdminUserPermission(14);
        $datas = $this->input->post();
        if ($this->input->post('form_submit')) {
            
            $this->common_model->checkAdminLogin();
            if ($datas) {
                if (isset($data['midtrans_showhide'])) {
                    $datass['midtrans_show'] = '1';
                } else {
                    $datass['midtrans_show'] = '0';
                }
                if ($_POST['gateway_type'] == "sandbox") {
                    $id = 1;
                } else {
                    $id = 2;
                }
                $data['gateway_name'] = $this->input->post('midtrans_gateway_name');
                $data['gateway_type'] = $this->input->post('gateway_type');
                $data['client_key'] = $this->input->post('client_key');
                $data['serverkey_key'] = $this->input->post('server_key');
                $data['merchant_id'] = $this->input->post('merchant_id');
                $data['status'] = !empty($this->input->post('midtrans_show'))?$this->input->post('midtrans_show'):0;
                $this->db->where('id', $id);
                if ($this->db->update('midtrans_gateway', $data)) {
                   
                    $datass['midtrans_show'] = $this->input->post('midtrans_show');
                    $datass['midtrans_option'] = $id;
                    if ($this->input->post('gateway_type') == 'sandbox') {
                        $datass['midtrans_secret_apikey'] = $this->input->post('client_key');
                        $datass['midtrans_secret_serverkey'] = $this->input->post('server_key');
                        $datass['midtrans_merchant_id'] = $this->input->post('merchant_id');
                    } else {
                        $datass['live_midtrans_secret_apikey'] = $this->input->post('client_key');
                        $datass['live_midtrans_secret_serverkey'] = $this->input->post('server_key');
                        $datass['midtrans_merchant_id'] = $this->input->post('merchant_id');
                    }
                    $midtrans_option = settingValue('midtrans_option');
                    
                    if (!empty($midtrans_option)) {
                        $this->db->where('key', 'midtrans_option')->update('system_settings', ['value' => $id]);
                    } else {
                        $this->db->insert('system_settings', ['key' => 'midtrans_option', 'value' => $id]);
                    }

                    foreach ($datass AS $key => $val) {
                        $this->db->where('key', $key);
                        $this->db->delete('system_settings');
                        $table_data['key'] = $key;
                        $table_data['value'] = $val;
                        $table_data['system'] = 1;
                        $table_data['groups'] = 'config';
                        $table_data['update_date'] = date('Y-m-d');
                        $table_data['status'] = 1;
                        $this->db->insert('system_settings', $table_data);
                    }

                    $this->session->set_flashdata('success_message', 'Payment Details updated successfully');
                    redirect(base_url() . 'admin/midtrans-payment-gateway');
                }
            
            }  
        }
        $id = settingValue('midtrans_option');
        if (!empty($id)) {
            $this->data['list'] = $this->admin->midtrans_payment_gateway($id);
        } else {
            $this->data['list'] = [];
            $this->data['list']['id'] = '';
            $this->data['list']['gateway_type'] = '';
            $this->data['gateway_type'] = '';
        }
        $this->data['page'] = 'midtrans_payment_gateway';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');

    }

    public function midtrans_payment_type(){ 
        if(!empty($this->input->post('type'))){
            $result=$this->db->where('gateway_type=',$this->input->post('type'))->get('midtrans_gateway')->row_array();
            echo json_encode($result);exit;
        }
    }

    public function midtrans_payout_gateway() {
        $this->common_model->checkAdminUserPermission(14);
        $datas = $this->input->post();
        if ($this->input->post('form_submit')) {
            if ($datas) {
                if ($_POST['midtrans_payout_option'] == "sandbox") {
                    $id = 1;
                } else {
                    $id = 2;
                }
                $data['gateway_name'] = 'midtrans';
                $data['gateway_type'] = $this->input->post('midtrans_payout_option');
                $data['client_key'] = $this->input->post('payout_client_key');
                $data['status'] = $id;
                $this->db->where('id', $id);
                if ($this->db->update('midtrans_payout_gateway', $data)) {
                   
                    $datass['midtrans_show'] = $this->input->post('midtrans_show');
                    $datass['midtrans_option'] = $id;
                    if ($this->input->post('midtrans_payout_option') == 'sandbox') {
                        $datass['midtrans_payout_apikey'] = $this->input->post('payout_client_key');
                        $datass['midtrans_payout_option'] =$_POST['midtrans_payout_option'];
                    } else {
                        $datass['live_midtrans_payout_apikey'] = $this->input->post('payout_client_key');
                    }
                    $midtrans_option = settingValue('midtrans_payout_option');
                    
                    if (!empty($midtrans_option)) {
                        $this->db->where('key', 'midtrans_payout_option')->update('system_settings', ['value' => $id]);
                    } else {
                        $this->db->insert('system_settings', ['key' => 'midtrans_payout_option', 'value' => $id]);
                    }

                    foreach ($datass AS $key => $val) {
                        $this->db->where('key', $key);
                        $this->db->delete('system_settings');
                        $table_data['key'] = $key;
                        $table_data['value'] = $val;
                        $table_data['system'] = 1;
                        $table_data['groups'] = 'config';
                        $table_data['update_date'] = date('Y-m-d');
                        $table_data['status'] = 1;
                        $this->db->insert('system_settings', $table_data);
                    }

                    $this->session->set_flashdata('success_message', 'Payment Details updated successfully');
                    redirect(base_url() . 'admin/midtrans_payout_gateway');
                }
            
            }  
        }
        $id = settingValue('midtrans_payout_option');
        if (!empty($id)) {
            $this->data['list'] = $this->admin->midtrans_payout_gateway($id);
           // echo '<pre>'; print_r($this->data['list']); exit;
        } else {
            $this->data['list'] = [];
            $this->data['list']['id'] = '';
            $this->data['list']['gateway_type'] = '';
            $this->data['gateway_type'] = '';
        }
        $this->data['page'] = 'midtrans_payout_gateway';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');

    }

    public function midtrans_payout_type(){ 
        if(!empty($this->input->post('type'))){
            $result=$this->db->where('gateway_type',$this->input->post('type'))->get('midtrans_payout_gateway')->row_array();
            echo json_encode($result);exit;
        }
    }

    /** [Currency Settings] */
    public function currencySettings() {
        $this->data['page'] = 'currency_settings';
        $this->data['lists'] = $this->admin->get_currency_config();
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
    }

    /** [Currency Create] */
    public function create_currency() {
        if ($this->input->post('form_submit')) {
            $this->common_model->checkAdminLogin();
            $table_data['currency_name'] = $this->input->post('currency_name');
            $table_data['currency_symbol'] = $this->input->post('currency_symbol');
            $table_data['currency_code'] = $this->input->post('currency_code');
            $table_data['rate'] = $this->input->post('rate');
            $table_data['status'] = $this->input->post('status');
            $table_data['created_at'] = date('Y-m-d');
            if ($this->db->insert('currency_rate', $table_data)) {
               $this->session->set_flashdata('success_message', 'Currency Added successfully');
                redirect(base_url('admin/' . 'currency-settings'));
            }
        }
        $this->data['page'] = 'create_currency';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    /** [Currency Edit] */
    public function currency_edit($cur_id) {
        if ($this->input->post('form_submit')) {
            $this->common_model->checkAdminLogin();
            
            $table_data['currency_name'] = $this->input->post('currency_name');
            $table_data['currency_symbol'] = $this->input->post('currency_symbol');
            $table_data['currency_code'] = $this->input->post('currency_code');
            $table_data['rate'] = $this->input->post('rate');
            $table_data['status'] = $this->input->post('status');
            $table_data['updated_at'] = date('Y-m-d');
            $this->db->update('currency_rate', $table_data, "id = " . $cur_id);
            $this->session->set_flashdata('success_message', 'Currency Updated successfully');
            redirect(base_url('admin/' . 'currency-settings'));
        }
        $this->data['currencylist'] = $this->admin->edit_currency_config($cur_id);
        $this->data['page'] = 'currency_edit';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
    }

    public function currency_delete($cur_id){
        
        $inp = $cur_id;
        $this->db->where('id',$inp);
        $this->db->set('delete_status',0);
        $this->db->update('currency_rate');
        $this->session->set_flashdata('success_message', 'Currency Deleted successfully');
        redirect(base_url('admin/' . 'currency-settings'));
    }

    public function pageslist() {
        $this->common_model->checkAdminUserPermission(41);
        $lang_id = $this->db->where('language_value',settingValue('language'))->get('language')->row()->id;
        $this->data['pages'] = $this->db->order_by('id', 'DESC')->where(array('delete_status'=>1, 'lang_id'=>$lang_id))->get('pages_list')->result_array();
        $this->data['page'] = 'pages_list';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function add_pages() {
        $this->common_model->checkAdminUserPermission(41);
        if ($this->input->post("form_submit") == true) {
            $this->common_model->checkAdminLogin();
                $table_data['title'] = $this->input->post('title');
                if (empty($this->input->post('pages_slug'))) {
                $slug = preg_replace('/[^A-Za-z0-9\-]/', '-', $table_data['title']);
                $table_data['slug'] = strtolower($slug);
                } else {
                    $table_data['slug'] = $this->input->post('pages_slug');
                }
                $table_data['description'] = $this->input->post('pages_desc');
                $table_data['keywords'] = $this->input->post('pages_key');
                $table_data['lang_id'] = $this->input->post('pages_lang');
                $table_data['location'] = $this->input->post('pages_loc');
                $table_data['visibility'] = $this->input->post('pages_visibility');
                $table_data['page_content'] = $this->input->post('content');
                $table_data['created_at'] =date('Y-m-d H:i:s');
                $this->db->insert('pages_list', $table_data);

                if($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success_message', 'Pages Added successfully');
                    redirect(base_url('admin/' . 'pages-list'));
                } else {
                    $this->session->set_flashdata('error_message', 'Something went wront, Try again');
                    redirect(base_url('admin/' . 'pages-list'));
                }
        }

        $this->data['page'] = 'add_pages';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function edit_pages($id) {
        if ($this->input->post("form_submit") == true) {
            $this->common_model->checkAdminLogin();
                $table_data['title'] = $this->input->post('title');
                if (empty($this->input->post('pages_slug'))) {
                $slug = preg_replace('/[^A-Za-z0-9\-]/', '-', $table_data['title']);
                $table_data['slug'] = strtolower($slug);
                } else {
                    $table_data['slug'] = $this->input->post('pages_slug');
                }
                $table_data['description'] = $this->input->post('pages_desc');
                $table_data['keywords'] = $this->input->post('pages_key');
                $table_data['lang_id'] = $this->input->post('pages_lang');
                $table_data['location'] = $this->input->post('pages_loc');
                $table_data['visibility'] = $this->input->post('pages_visibility');
                $table_data['page_content'] = $this->input->post('content');
                $table_data['created_at'] =date('Y-m-d H:i:s');
                $this->db->where('id', $id);
                $this->db->update('pages_list', $table_data);

                if($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success_message', 'Pages Updated successfully');
                    redirect(base_url('admin/' . 'pages-list'));
                } else {
                    $this->session->set_flashdata('error_message', 'Something went wront, Try again');
                    redirect(base_url('admin/' . 'pages-list'));
                }
        }

        $this->data['page'] = 'edit_pages';
        $this->data['pages_val'] = $this->admin->pages_details($id);
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    } 

    public function offline_payment() {   
      $this->common_model->checkAdminUserPermission(14);
      if ($this->input->post('form_submit')) {
        $this->common_model->checkAdminLogin();
        $data['bank_name']    = $this->input->post('bank_name');
        $data['holder_name'] = $this->input->post('holder_name');
        $data['account_num']            = $this->input->post('account_num');
        $data['ifsc_code']         = $this->input->post('ifsc_code');
        $data['branch_name']            = $this->input->post('branch_name');
        $data['upi_id']         = $this->input->post('upi_id');
        $data['status'] = !empty($this->input->post('offline_show'))?$this->input->post('offline_show'):0;
        $data['created_datetime'] =date('Y-m-d H:i:s');
        $data['updated_datetime'] =date('Y-m-d H:i:s');
        $query                    = $this->db->query("SELECT * FROM offline_payment");
        $results                   = $query->row_array();
        if (!empty($results)) {
            $this->db->where('id', '1');
            $this->db->update('offline_payment', $data);
        } else {
            $this->db->insert('offline_payment', $data);
        }   
        $this->session->set_flashdata('success_message', 'Offline Payment edit successfully');
        redirect(base_url() . 'admin/offlinepayment/');  
      }
      $this->data['page'] = 'offline_payment';
      $this->load->vars($this->data);
      $this->load->view($this->data['theme'] . '/template');
    } 

    public function offlinepaymentdetails() {
        $this->data['list'] = $this->admin->result_getall();
        $this->data['page'] = 'offline_payment_details';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function offline_status() {
        $this->common_model->checkAdminLogin();
        $id=$this->input->post('status_id');
        $table_data['paid_status'] =$this->input->post('status');
        $this->db->where('id',$id);
        if($this->db->update('subscription_details',$table_data)){ 
            echo "success";
        } else {
            echo "error";
        } 
    }

    public function pages_delete(){
        if($this->session->userdata('role') != 1 && settingValue('demo_access') == 0) {
            echo json_encode("failure"); exit;
        } else {
            $inp = $this->input->post();
            $this->db->where('id',$inp['id']);
            $this->db->set('delete_status',0);
            $this->db->update('pages_list');
            echo json_encode("success");
        }   
    }

    public function cache_settings() {
        $this->common_model->checkAdminUserPermission(38);
        $data = $this->input->post();

        if ($this->input->post('form_submit')) {
            $this->common_model->checkAdminLogin();
            if ($data) {
                if (isset($data['pro_cache_status'])) {
                    $data['pro_cache_status'] = '1';
                } else {
                    $data['pro_cache_status'] = '0';
                }
                if ($data['pro_cache_status'] == 1) {

                    $service_data = $this->db->query("SELECT * FROM `services` WHERE `status` =  1;")->result();
                    $data['service_data'] = $service_data;
                    $response = array();
                    $posts = array();
                    foreach ($service_data as $service) 
                    { 
                        $posts[] = array(
                            "id"                 =>  $service->id,
                            "user_id"                  =>  $service->user_id,
                            "service_title"            =>  $service->service_title,
                            "currency_code" =>  $service->currency_code,
                            "service_sub_title"                  =>  $service->service_sub_title,
                            "service_amount"                 =>  $service->service_amount,
                            "category"                  =>  $service->category,
                            "subcategory"            =>  $service->subcategory,
                            "about" =>  $service->about,
                            "service_offered"                  =>  $service->service_offered,
                            "service_location"                 =>  $service->service_location,
                            "service_latitude"                  =>  $service->service_latitude,
                            "service_longitude"            =>  $service->service_longitude,
                            "service_image" =>  $service->service_image,
                            "service_details_image"                  =>  $service->service_details_image,
                            "thumb_image"                 =>  $service->thumb_image,
                            "mobile_image"                  =>  $service->mobile_image,
                            "url"            =>  $service->url,
                            "status" =>  $service->status,
                            "total_views"                  =>  $service->total_views,
                            "rating"                 =>  $service->rating,
                            "rating_count"                  =>  $service->rating_count,
                            "admin_verification"            =>  $service->admin_verification,
                            "created_at" =>  $service->created_at,
                            "updated_at"                  =>  $service->updated_at,
                            "deleted_reason" =>  $service->deleted_reason,
                            "created_by"                  =>  $service->created_by
                        );
                    } 
                    $response['posts'] = $posts;

                    echo json_encode($response,TRUE);
                    if(!is_dir('application/cache')) {
                    mkdir('./application/cache', 0777, TRUE);
                    }
                    $fp = fopen('./application/cache/service_array.json', 'w');
                    fwrite($fp, json_encode($response));

                    fclose($fp);

                }
                foreach ($data AS $key => $val) {
                    if ($key != 'form_submit') {
                        $this->db->where('key', $key);
                        $this->db->delete('system_settings');
                        $table_data['key'] = $key;
                        $table_data['value'] = $val;
                        $table_data['system'] = 1;
                        $table_data['groups'] = 'config';
                        $table_data['update_date'] = date('Y-m-d');
                        $table_data['status'] = 1;
                        $this->db->insert('system_settings', $table_data);
                    }
                }
            $this->session->set_flashdata('success_message', 'Service Cache Details updated successfully');
            redirect(base_url() . 'admin/cache-settings');
            }
        }

        $this->data['page'] = 'cache_system';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function static_cache_system() {
        $this->common_model->checkAdminUserPermission(38);
        $data = $this->input->post();

        if ($this->input->post('form_submit')) {
            $this->common_model->checkAdminLogin();
            if ($data) {
                if (isset($data['static_content_cache_system'])) {
                    $data['static_content_cache_system'] = '1';
                } else {
                    $data['static_content_cache_system'] = '0';
                }

                if ($data['static_content_cache_system'] == 1) {

                    $language_data = $this->db->query("SELECT * FROM `language_management` WHERE `language` =  'en';")->result();
                    $data['language_data'] = $language_data;
                    $response = array();
                    $posts = array();
                    foreach ($language_data as $language) 
                    { 
                        $posts[] = array(
                            "id"                 =>  $language->sno,
                            "lang_key"                  =>  $language->lang_key,
                            "lang_value"            =>  $language->lang_value,
                            "language" =>  $language->language,
                            "type"                  =>  $language->type
                        );
                    } 
                    $response['posts'] = $posts;

                    echo json_encode($response,TRUE);
                    if(!is_dir('application/cache')) {
                    mkdir('./application/cache', 0777, TRUE);
                    }
                    $fp = fopen('./application/cache/lang_array.json', 'w');
                    fwrite($fp, json_encode($response));

                    fclose($fp);


                    $app_language_data = $this->db->query("SELECT * FROM `app_language_management` WHERE `language` =  'en';")->result();
                    $data['app_language_data'] = $app_language_data;
                    $response = array();
                    $posts = array();
                    foreach ($app_language_data as $app_language) 
                    { 
                        $posts[] = array(
                            "id"                 =>  $app_language->sno,
                            "page_key"                  =>  $app_language->page_key,
                            "lang_key"            =>  $app_language->lang_key,
                            "lang_value" =>  $app_language->lang_value,
                            "placeholder"                  =>  $app_language->placeholder,
                            "validation1"                 =>  $app_language->validation1,
                            "validation2"                  =>  $app_language->validation2,
                            "validation3"            =>  $app_language->validation3,
                            "type" =>  $app_language->type,
                            "language"                  =>  $app_language->language
                        );
                    } 
                    $response['posts'] = $posts;

                    echo json_encode($response,TRUE);
                    if(!is_dir('application/cache')) {
                    mkdir('./application/cache', 0777, TRUE);
                    }
                    $fp = fopen('./application/cache/applang_array.json', 'w');
                    fwrite($fp, json_encode($response));

                    fclose($fp);

                }

                foreach ($data AS $key => $val) {
                    if ($key != 'form_submit') {
                        $this->db->where('key', $key);
                        $this->db->delete('system_settings');
                        $table_data['key'] = $key;
                        $table_data['value'] = $val;
                        $table_data['system'] = 1;
                        $table_data['groups'] = 'config';
                        $table_data['update_date'] = date('Y-m-d');
                        $table_data['status'] = 1;
                        $this->db->insert('system_settings', $table_data);
                    }
                }
            $this->session->set_flashdata('success_message', 'Product Cache Details updated successfully');
            redirect(base_url() . 'admin/cache-settings');
            }
        }
    }

    public function abuse_reports() {
        $this->data['list'] = $this->admin->abuse_reports();
        $this->data['page'] = 'abuse_reports';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function abuse_details($id) {
      $this->data['page'] = 'abuse_details';
      $this->data['list'] = $this->admin->abuse_reports_list($id);
      $this->load->vars($this->data);
      $this->load->view($this->data['theme'].'/template');
    }

    public function refund_request_status() {
        $this->common_model->checkAdminLogin();
        $id=$this->input->post('status_id');
        $refund_details=$this->db->where('id',$id)->get('refund_request')->row_array();
        
        $wallet_pro_details=$this->db->where('wallet_amt >',$refund_details['amount'])->where('user_provider_id',$refund_details['provider_id'])->where('type',1)->get('wallet_table')->row_array();
        if (!empty($wallet_pro_details)) {

        if ($this->input->post('status') == 1) {
              
        $pro_amount = $wallet_pro_details['wallet_amt'] - $refund_details['amount'];

        $this->db->where_in('id',$wallet_pro_details['id']);
        $this->db->set('wallet_amt', $pro_amount);
        $this->db->set('updated_on', date('Y-m-d H:i:s'));
        $this->db->update('wallet_table');
        $wallet_user_details=$this->db->where('user_provider_id',$refund_details['user_id'])->where('type',2)->get('wallet_table')->row_array();
        $user_amount = $wallet_user_details['wallet_amt'] + $refund_details['amount'];

        $this->db->where_in('id',$wallet_user_details['id']);
        $this->db->set('wallet_amt', $user_amount);
        $this->db->set('updated_on', date('Y-m-d H:i:s'));
        $this->db->update('wallet_table');

        $token=$this->session->userdata('chat_token');
        $this->send_push_notification($token,$refund_details['user_id'],2,'  <b>Refundable</b> Amount is added to your wallet successfully.');

        $provider_details=$this->db->where('id',$refund_details['provider_id'])->get('providers')->row_array();
        $history_pay_pro['token']=$provider_details['token'];
        $history_pay_pro['user_provider_id']=$refund_details['provider_id'];
        $history_pay_pro['currency_code']=$provider_details['currency_code'];
        $history_pay_pro['type']='1';
        $history_pay_pro['transaction_id']='0';
        $history_pay_pro['paid_status']='Refund';
        $history_pay_pro['cust_id']='self';
        $history_pay_pro['avail_wallet']=$pro_amount;
        $history_pay_user['fee_amt']=$pro_amount;
        $history_pay_pro['tokenid']=$provider_details['token'];
        $history_pay_pro['current_wallet']=$wallet_pro_details['wallet_amt'];
        $history_pay_pro['credit_wallet'] = 0;
        $history_pay_pro['debit_wallet'] = $refund_details['amount'];
        $history_pay_pro['reason']='Refund Request Amount';
        $history_pay_pro['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('wallet_transaction_history',$history_pay_pro);

        $user_details=$this->db->where('id',$refund_details['user_id'])->get('users')->row_array();
        $history_pay_user['token']=$user_details['token'];
        $history_pay_user['user_provider_id']=$refund_details['user_id'];
        $history_pay_user['currency_code']=$user_details['currency_code'];
        $history_pay_user['type']='2';
        $history_pay_user['transaction_id']='0';
        $history_pay_user['paid_status']='Refund';
        $history_pay_user['cust_id']='self';
        $history_pay_user['fee_amt']=$user_amount;
        $history_pay_user['avail_wallet']=$user_amount;
        $history_pay_user['tokenid']=$user_details['token'];
        $history_pay_user['current_wallet']=$wallet_user_details['wallet_amt'];
        $history_pay_user['credit_wallet'] = $refund_details['amount'];
        $history_pay_user['debit_wallet'] = 0;
        $history_pay_user['reason']='Refund Request Amount';
        $history_pay_user['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('wallet_transaction_history',$history_pay_user);

        $this->db->where_in('id',$refund_details['booking_id']);
        $this->db->set('status', 10);
        $this->db->set('updated_on', date('Y-m-d H:i:s'));
        $this->db->update('book_service');
     
       }

       if($this->input->post('status') == 2) {
        $user_details=$this->db->where('id',$refund_details['user_id'])->get('users')->row_array();
        $history_pay_user['token']=$user_details['token'];
        $history_pay_user['user_provider_id']=$refund_details['user_id'];
        $history_pay_user['currency_code']=$user_details['currency_code'];
        $history_pay_user['type']='2';
        $history_pay_user['transaction_id']='0';
        $history_pay_user['paid_status']='Refund';
        $history_pay_user['cust_id']='self';
        $history_pay_user['fee_amt']=$user_amount;
        $history_pay_user['avail_wallet']=$user_amount;
        $history_pay_user['tokenid']=$user_details['token'];
        $history_pay_user['current_wallet']=$wallet_user_details['wallet_amt'];
        $history_pay_user['credit_wallet'] = $refund_details['amount'];
        $history_pay_user['debit_wallet'] = 0;
        $history_pay_user['reason']='Refund Request Amount';
        $history_pay_user['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('wallet_transaction_history',$history_pay_user);

        $this->db->where_in('id',$refund_details['booking_id']);
        $this->db->set('status', 11);
        $this->db->set('updated_on', date('Y-m-d H:i:s'));
        $this->db->update('book_service');

        $token=$this->session->userdata('chat_token');
        $this->send_push_notification($token,$refund_details['user_id'],2,'Admin Cancelled Your Refund Request.');
       }
      
      $table_data['status'] =$this->input->post('status');
      $this->db->where('id',$id);
      if($this->db->update('refund_request',$table_data)){ 
        echo 1;
      } else {
        echo "error";
      }
      } else {
           echo "error";
        }
      }

    public function clear_all_cache()
    {
        $this->common_model->checkAdminLogin();
        $CI =& get_instance();
        $path = $CI->config->item('cache_path');

        $cache_path = ($path == '') ? APPPATH.'cache/' : $path;

        $handle = opendir($cache_path);
        while (($file = readdir($handle))!== FALSE) 
        {
            //Leave the directory protection alone
            if ($file != '.htaccess' && $file != 'index.html')
            {
               @unlink($cache_path.'/'.$file);
            }
        }
        closedir($handle);  
        $this->session->set_flashdata('success_message', 'Caches Cleared successfully');
        redirect(base_url() . 'admin/cache-settings');     
    }


    public function serviceSettings() {
        $data = $this->input->post();
        if ($this->input->post('form_submit')) {
            $this->common_model->checkAdminLogin();
            if (isset($data['review_showhide'])) {
                $data['review_showhide'] = 1;
            } else {
                $reviews = $this->db->get_where('system_settings', array('key'=>'review_showhide'))->row()->value;
                $data['review_showhide'] = (isset($data['review_showhide']))?$reviews:0;
            }

            if (isset($data['booking_showhide'])) {
                $data['booking_showhide'] = 1;
            } else {
                $booking = $this->db->get_where('system_settings', array('key'=>'booking_showhide'))->row()->value;
                $data['booking_showhide'] = (isset($data['booking_showhide']))?$booking:0;
            }

            if (isset($data['service_offered_showhide'])) {
                $data['service_offered_showhide'] = 1;
            } else {
                $service_offered = $this->db->get_where('system_settings', array('key'=>'service_offered_showhide'))->row()->value;
                $data['service_offered_showhide'] = (isset($data['service_offered_showhide']))?$service_offered:0;
            }

            if (isset($data['service_availability_showhide'])) {
                $data['service_availability_showhide'] = 1;
            } else {
                $service_availability = $this->db->get_where('system_settings', array('key'=>'service_availability_showhide'))->row()->value;
                $data['service_availability_showhide'] = (isset($data['service_availability_showhide']))?$service_availability:0;
            }

            if (isset($data['provider_email_showhide'])) {
                $data['provider_email_showhide'] = 1;
            } else {
                $provider_email = $this->db->get_where('system_settings', array('key'=>'provider_email_showhide'))->row()->value;
                $data['provider_email_showhide'] = (isset($data['provider_email_showhide']))?$provider_email:0;
            }

            if (isset($data['provider_mobileno_showhide'])) {
                $data['provider_mobileno_showhide'] = 1;
            } else {
                $provider_mobileno = $this->db->get_where('system_settings', array('key'=>'provider_mobileno_showhide'))->row()->value;
                $data['provider_mobileno_showhide'] = (isset($data['provider_mobileno_showhide']))?$provider_mobileno:0;
            }

            if (isset($data['provider_status_showhide'])) {
                $data['provider_status_showhide'] = 1;
            } else {
                $provider_status = $this->db->get_where('system_settings', array('key'=>'provider_status_showhide'))->row()->value;
                $data['provider_status_showhide'] = (isset($data['provider_status_showhide']))?$provider_status:0;
            }
            
            if ($data['service_offered_showhide'] == 1) {
                $data['service_offered_showhide'] = 1;
            } else {
                $service_offered = $this->db->get_where('system_settings', array('key'=>'service_offered_showhide'))->row()->value;
                if($data['service_offered_showhide'] == 0) {
                    $data['service_offered_showhide'] = 0;
                }
                $data['service_offered_showhide'] = (isset($data['service_offered_showhide']))?$data['service_offered_showhide']:$service_offered;
            }
            //echo '<pre>'; print_r($data); exit;
            foreach ($data AS $key => $val) {
                if ($key != 'form_submit') {
                    $this->db->where('key', $key);
                    $this->db->delete('system_settings');
                    $table_data['key'] = $key;
                    $table_data['value'] = $val;
                    $table_data['system'] = 1;
                    $table_data['groups'] = 'config';
                    $table_data['update_date'] = date('Y-m-d');
                    $table_data['status'] = 1;
                    $exists_data = $this->db->get_where('system_settings', array('key'=>$key))->row();

                    if(!$exists_data) {
                        $this->db->insert('system_settings', $table_data);
                    } else {
                        $this->db->where('key', $key);
                        $this->db->update('system_settings', $table_data);
                    }
                }
            }

            if($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success_message', 'Service details updated successfully');
                redirect($_SERVER["HTTP_REFERER"]);
            } else {
                $this->session->set_flashdata('error_message', 'Something went wront, Try again');
                redirect($_SERVER["HTTP_REFERER"]);
            }
        } else {
            $this->data['page'] = 'service_settings';
            $this->load->vars($this->data);
            $this->load->view($this->data['theme'].'/template');
        }
    }

    public function subscriptions_lists()
    {
        $this->common_model->checkAdminUserPermission(12);
        extract($_POST);     

        if ($this->input->post('form_submit')) 
        {  
            $username = $this->input->post('username');   
            $from = $this->input->post('from');
            $to = $this->input->post('to');   
            $this->data['lists'] =$this->service->subscriptionlist_filter($username,$from,$to);
        }
        else
        {     
            $this->data['lists'] = $this->service->subscriptionlist();
        }
        $this->data['page'] = 'subscriptions_lists';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
    }

    public function send_push_notification($token, $user_id, $type, $msg) {
        //$data = $this->api->get_book_info($service_id);
        //if (!empty($data)) {
            if ($type == 1) {
                $device_tokens = $this->api->get_device_info_multiple($user_id, 1);
            } else {
                $device_tokens = $this->api->get_device_info_multiple($user_id, 2);
            }
            if ($type == 2) {
                $user_info = $this->api->get_user_info($user_id, $type);
            } else {
                $user_info = $this->api->get_user_info($user_id, $type);
            }



            /* insert notification */
            $msg = ucfirst(strtolower($msg));
            if (!empty($user_info['token'])) {
                $this->api->insert_notification($token, $user_info['token'], $msg);
            }

            $title = 'Admin Notification'; //$data['service_title'];


            if (!empty($device_tokens)) {
                foreach ($device_tokens as $key => $device) {
                    if (!empty($device['device_type']) && !empty($device['device_id'])) {

                        if (strtolower($device['device_type']) == 'android') {

                            $notify_structure = array(
                                'title' => $title,
                                'message' => $msg,
                                'image' => 'test22',
                                'action' => 'test222',
                                'action_destination' => 'test222',
                            );

                            sendFCMMessage($notify_structure, $device['device_id']);
                        }

                        if (strtolower($device['device_type'] == 'ios')) {
                            $notify_structure = array(
                                'title' => $title,
                                'message' => $msg,
                                'alert' => $msg,
                                'sound' => 'default',
                                'badge' => 0,
                            );


                            sendApnsMessage($notify_structure, $device['device_id']);
                        }
                    }
                }
            }


            /* apns push notification */
        /*} else {
            $this->token_error();
        }*/
    }

}

    