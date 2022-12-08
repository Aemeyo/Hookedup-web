<?php
class Country_code_config extends CI_Controller
{
    public $data;

    public function __construct()
    {
        parent::__construct();
        error_reporting(0);
        $this->data['theme']  = 'admin';
        $this->data['model'] = 'country_code_config';
        $this->load->model('admin_model');
        $this->data['base_url'] = base_url();
        $this->data['admin_id'] = $this->session->userdata('id');
        $this->data['user_role'] = !empty($this->session->userdata('role')) ? $this->session->userdata('role') : 0;
        $this->load->helper('custom_language');
        $this->load->model('common_model');
        /*$lang = !empty($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
        $this->data['language_content'] = get_admin_languages($lang);*/

         //Get Language Keywords from content lang file
        $langs = !empty($this->session->userdata('lang'))?$this->session->userdata('lang'):'en';
        $lang = $this->db->get_where('language', array('language_value'=>$langs))->row()->language;
        $this->data['language_content'] = $this->lang->load('content', strtolower($lang), true);
        $this->language = $this->lang->load('content', strtolower($lang), true);
    }
    
    public function index($offset = 0)
    {
        $this->data['page'] = 'index';
        $this->data['lists'] = $this->admin_model->get_country_code_config();
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function create()
    {
        if ($this->input->post('form_submit')) {
            $this->common_model->checkAdminLogin();
            $country_code               = $this->input->post('country_code');
            $country_id               = $this->input->post('country_id');
            $country_name               = $this->input->post('country_name');
            $table_data['country_code'] = $country_code;
            $table_data['country_id'] = $country_id;
            $table_data['country_name'] = $country_name;
            $table_data['status'] = 1;
            if ($this->db->insert('country_table', $table_data)) {
                $message = '<div class="alert alert-success text-center fade in" id="flash_succ_message">Country code added successfully. </div>';
                $this->session->set_flashdata('message', $message);
                redirect(base_url('admin/country-code-config'));
            }
        }
        $this->data['page'] = 'create';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }
    public function edit($cls_id) {
        $current_date = date('Y-m-d H:i:s');
        if (!empty($cls_id)) {
            if ($this->input->post('form_submit')) {
                $this->common_model->checkAdminLogin();
                    $country_code               = $this->input->post('country_code');
                    $country_id               = $this->input->post('country_id');
                    $country_name               = $this->input->post('country_name');
                    $table_data['country_code'] = $country_code;
                    $table_data['country_id'] = $country_id;
                    $table_data['country_name'] = $country_name;
                    $table_data['status'] = 1;
                        $this->db->update('country_table', $table_data, "id = " . $cls_id);
                        $message = '<div class="alert alert-success text-center fade in" id="flash_succ_message">Country code Updated successfully. </div>';
                        $this->session->set_flashdata('message', $message);
                        redirect(base_url('admin/country-code-config'));
            }
            $this->data['datalist'] = $this->admin_model->edit_country_code_config($cls_id);
            $this->data['page']     = 'edit';
            $this->load->vars($this->data);
            $this->load->view($this->data['theme'] . '/template');
        } else {
            redirect(base_url('admin/country-code-config'));
        }
    }
    public function delete_country_code_config()
    {
        $this->common_model->checkAdminLogin();
        $id = $this->input->post('tbl_id');
        if (!empty($id)) {
            $this->db->delete('country_table', array(
                'id' => $id
            ));
            $message = '<div class="alert alert-success text-center fade in" id="flash_succ_message">Country code deleted successfully. </div>';
            echo 1;
        }
        $this->session->set_flashdata('message', $message);
    }
}
