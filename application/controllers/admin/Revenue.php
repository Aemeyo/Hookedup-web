<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Revenue extends CI_Controller {

    public $data;

    public function __construct() {

        parent::__construct();
        $this->load->helper('form');
        
        $this->load->model('admin_model', 'admin');
		$this->load->model('common_model','common_model');
        $this->data['theme'] = 'admin';
        $this->data['model'] = 'revenue';
        $this->data['base_url'] = base_url();
        $this->load->helper('custom_language');
        /*$lang = !empty($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
        $this->data['language_content'] = get_admin_languages($lang);*/

         //Get Language Keywords from content lang file
        $langs = !empty($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
        $lang = $this->db->get_where('language', array('language_value'=>$langs))->row()->language;
        $this->data['language_content'] = $this->lang->load('content', strtolower($lang), true);
        $this->language = $this->lang->load('content', strtolower($lang), true);
        
        $this->session->keep_flashdata('error_message');
        $this->session->keep_flashdata('success_message');
        $this->load->helper('user_timezone_helper');
        $this->data['user_role'] = $this->session->userdata('role');
    }

    public function index() 
    {        
		$this->common_model->checkAdminUserPermission(11);        
        if($this->input->post('form_submit')) {  
            $this->common_model->checkAdminLogin();          
            $provider_name = $this->input->post('provider_name');
            $date = $this->input->post('date');            
            $this->data['list'] = $this->admin->Revenue_list($provider_name, $date);

        } else { 
            $this->data['list'] = $this->admin->Revenue_list();
        }
        $this->data['page'] = 'revenue_list';
        $this->data['provider_list'] = $this->db->select('id,name')->get('providers')->result_array();
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function revenue_list() {
      $lists = $this->admin->Revenue_list();
      $data = array();
      $_POST['draw'] = 1;
      $no = isset($_POST['start']);
      foreach ($lists as $template) {
        $no++;
        $row    = array();
        $row[]  = $no;
        $row[]  = $template['date'];
        $row[]  = $template['provider'];
        $row[]  = $template['user'];
        $row[]  = $template['amount'];
        $row[]  = $template['commission'];
        $row[]  = "Completed";
        
        $data[] = $row; 
      }

      $output = array(
                  "draw" => isset($_POST['draw']),
                  "recordsTotal" => $this->admin->revenue_list_all(),
                  "recordsFiltered" => $this->admin->revenue_list_filtered(),
                  "data" => $data,
                );
      echo json_encode($output); 


  }

}
