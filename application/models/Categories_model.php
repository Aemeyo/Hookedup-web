<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Categories_model extends CI_Model
{

	 function __construct() { 
        // Set table name 
        $this->table = 'categories'; 
    } 
     
    
    function get_category($params = array()){ 
        $this->db->select('c.id,c.category_name,c.category_image,c.category_slug, (SELECT COUNT(s.id) FROM services AS s LEFT JOIN `subscription_details` as `sd` ON `sd`.`subscriber_id`=`s`.`user_id` WHERE s.category=c.id AND s.status=1 AND sd.expiry_date_time >="'.date('Y-m-d').'" ) AS category_count');
               $this->db->from('categories c');
               $this->db->where('c.status',1);
               $this->db->order_by('category_count','DESC');
         
        if(array_key_exists("where", $params)){ 
            foreach($params['where'] as $key => $val){ 
                $this->db->where($key, $val); 
            } 
        } 
         
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
            $result = $this->db->count_all_results(); 
        }else{ 
            if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
                if(!empty($params['id'])){ 
                    $this->db->where('id', $params['id']); 
                } 
                $query = $this->db->get(); 
                $result = $query->row_array(); 
            }else{ 
               
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $this->db->limit($params['limit'],$params['start']); 
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $this->db->limit($params['limit']); 
                } 
                 
                $query = $this->db->get(); 
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
                //echo $this->db->last_query(); exit;
            } 
        } 
         
        // Return fetched data 
        return $result; 
    }
	public function get_category_name($id)
	{
		return $this->db->select('category_name,id')->where('id',$id)->get('categories')->row();
	}
    function get_subcategory($params = array()){ 
        $lang = ($this->session->userdata('user_select_language'))?$this->session->userdata('user_select_language'):'en';

        $this->db->select('c.id,sl.subcategory_name,c.category,c.subcategory_image,c.subcategory_slug, (SELECT COUNT(s.id) FROM services AS s LEFT JOIN `subscription_details` as `sd` ON `sd`.`subscriber_id`=`s`.`user_id` WHERE s.subcategory=c.id AND s.status=1 AND sd.expiry_date_time >="'.date('Y-m-d').'" ) AS category_count');
               $this->db->from('subcategories c');
               $this->db->join('subcategories_lang sl', 'sl.subcategory_id = c.id', 'left');
               $this->db->where('c.status',1);
               $this->db->where('sl.lang_type', $lang);
               $this->db->order_by('category_count','DESC');
         
        if(array_key_exists("where", $params)){ 
            foreach($params['where'] as $key => $val){ 
                $this->db->where($key, $val); 
            } 
        }
         
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
            $result = $this->db->count_all_results(); 
        }else{ 
            if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
                if(!empty($params['id'])){ 
                    $this->db->where('id', $params['id']); 
                } 
                $query = $this->db->get(); 
                $result = $query->row_array(); 
            }else{ 
               
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $this->db->limit($params['limit'],$params['start']); 
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $this->db->limit($params['limit']); 
                } 
                 
                $query = $this->db->get(); 
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
            } 
        }
         
        // Return fetched data 
        return $result; 
    }

    public function get_subcategory_data($params = array()){ 
        
        $lang = ($this->session->userdata('user_select_language'))?$this->session->userdata('user_select_language'):'en';

        $this->db->select('c.id,sl.subcategory_name,c.category,c.subcategory_image,c.subcategory_slug, (SELECT COUNT(s.id) FROM services AS s LEFT JOIN `subscription_details` as `sd` ON `sd`.`subscriber_id`=`s`.`user_id` WHERE s.subcategory=c.id AND s.status=1 AND sd.expiry_date_time >="'.date('Y-m-d').'" ) AS category_count');
               $this->db->from('subcategories c');
               $this->db->join('subcategories_lang sl', 'sl.subcategory_id = c.id', 'left');
               $this->db->where('c.status',1);
               $this->db->where('sl.lang_type', $lang);
               $this->db->order_by('category_count','DESC');
         
        if(array_key_exists("where", $params)){ 
            foreach($params['where'] as $key => $val){ 
                $this->db->where($key, $val); 
            } 
        }
         
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
            $result = $this->db->count_all_results(); 
        }else{ 
            if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
                if(!empty($params['id'])){ 
                    $this->db->where('c.id', $params['id']); 
                } 
                $query = $this->db->get(); 
                $result = $query->row_array(); 
            }else{ 
               
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $this->db->limit($params['limit'],$params['start']); 
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $this->db->limit($params['limit']); 
                } 
                 
                $query = $this->db->get(); 
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
            } 
        }
         
        // Return fetched data 
        return $result; 
    } 
		
}
?>
