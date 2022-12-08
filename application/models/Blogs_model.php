<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blogs_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function get_comments()
    {
        $value=$this->db->select('*')->
                        from('blog_comments')->
                       	where('status!=', 2)->
                        order_by('id','DESC')->
                        get()->result_array();
        return $value;            
    }

	public function get_comments_filter($user,$from,$to){
		
			if(!empty($from_date)) {
				$from_date=date("Y-m-d", strtotime($from_date));
			}else{
				$from_date='';
			}
			if(!empty($to_date)) {
				$to_date=date("Y-m-d", strtotime($to_date));
			}else{
				$to_date='';
			}
			$this->db->select('*');
			$this->db->from('blog_comments');
			if(!empty($from_date)){
				$this->db->where('date(created_at) >=',$from_date);
			}
			if(!empty($to_date)){
				$this->db->where('date(created_at) <=',$to_date);
			}
			if(!empty($user)){
			$this->db->where('user_id',$user);
			}
			
			$this->db->where('status',1);
			return $this->db->get()->result_array();


    }
}