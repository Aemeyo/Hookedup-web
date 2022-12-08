<?php
if(!function_exists('settings')){
  
  function settings($val){
    $ci =& get_instance();
    $query = $ci->db->query("select * from system_settings");
    
    $settings = $query->result_array();
    
    $result=array();        
        
    if(!empty($settings)){
      foreach($settings as $datas){
        if($datas['key']=='currency_option'){
          $result['currency'] = $datas['value'];
        }
      }
    }
    
    if(!empty($result[$val])) {
      $results= $result[$val];
		}
		else {
      $results= 'INR';
	  }

    return $results;
 }

  function settingValue($key){
    if(!empty($key)){
      $ci =& get_instance();
      $settings = $ci->db->where('key=',$key)->get('system_settings')->row_array();
      if(!empty($settings)){
        return $settings['value'];
      }else{
        return "";
      }
    }
  }
  
  function currencyConverter($from, $to) {
    $url = 'https://free.currconv.com/api/v7/convert?q=' . $from . '_' . $to . ',' . $to . '_' . $from . '&compact=ultra&apiKey=de2f3dcf8b88d2d760d4';

    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    
    $headers = array();
    $headers[] = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.89 Safari/537.36';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
      echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    print_r($result);
  }
}

function removeTag($data){  
  foreach ($data as $key => $value) {
    if(!is_array($value)){
      $_POST[$key]=strip_tags($value);
    }
  }
  return $_POST;
}

if(!function_exists('language_file_create')){
    function language_file_create(){
        $ci =& get_instance();
        $language=$ci->db->where('status',1)->get('language')->result_array();
        if(!empty($language)){
            foreach ($language as $rows) {
                $path = APPPATH.'/language/'.strtolower($rows['language']);
                if(!is_dir($path)){
                  mkdir($path);         
                }
                $path = APPPATH.'/language/'.strtolower($rows['language']).'/';
                $myfile = fopen($path. "content_lang.php", "w"); 
                $txt ='<?php';
                $language_management=$ci->db->where('language',$rows['language_value'])->get('language_management')->result_array();
                if(!empty($language_management)){
                    foreach ($language_management as $lrows) {
                        $language_key_value='lang["'.$lrows['lang_key'].'"]="'.str_replace('"', '', $lrows['lang_value']).'";';
                        $txt .= "\r\n".$language_key_value;
                    }
                } else {
                    $lang_array = array(
                        'lang_key' => $lrows['lang_key'],
                        'lang_value' => $lrows['lang_value'],
                        'language' => $rows['language_value'],
                        'type' => 'admin'
                    );
                    //$ci->db->insert('language_management', $lang_array);
                    $language_management_english=$ci->db->where('language','en')->get('language_management')->result_array();
                    foreach ($language_management_english as $lrows) {

                        $language_key_value='lang["'.$lrows['lang_key'].'"]="'.str_replace('"', '', $lrows['lang_value']).'";';
                        $txt .= "\r\n".$language_key_value;
                    }
                }
                fwrite($myfile, $txt);
                $rewritedata = file_get_contents($path.'content_lang.php');
                $rewritedata = str_replace('lang', '$lang', $rewritedata);
                write_file($path.'content_lang.php', $rewritedata);
                fclose($myfile);
            } 
        }  
    }
}
?>