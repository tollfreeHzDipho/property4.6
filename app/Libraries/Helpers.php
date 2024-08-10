<?php

namespace App\Libraries;

use App\Models\UserModel;

class Helpers
{

    public $UserModel;

    public function __construct()
    {
       
        $this->email = \Config\Services::email();
        $this->UserModel = new UserModel();
    }
       function log_online_status_create($id){
        $data = array('time'=>time(),
                    'status'=>1,
                    'last_seen'=>time()
                );
        $this->UserModel->update_session($id, $data);
       }
   
    public function yr_transformer($form_date) {
        $exploded_date = explode('-', $form_date, 3);
        $new_date = count($exploded_date) === 3 ? ($exploded_date[2] . "-" . $exploded_date[1] . "-" . $exploded_date[0]) : null;
        return preg_replace("/^19/", "20", $new_date);
    }
/*
    public function upload_file($location, $max_size = 1024, $allowed_types = "gif|jpg|jpeg|png|pdf") {
        $config['upload_path'] = APPPATH . "../public/uploads/$location/";
        $config['allowed_types'] = $allowed_types;
        $config['max_size'] = $max_size;
        $config['max_filename'] = 120;
        $config['overwrite'] = true;
        $config['file_ext_tolower'] = true;
        $config['file_name'] = $_FILES['file_attachment']['name'];

        //$upload_feedback = [];
        $this->CI->load->library('upload', $config);
        //if the folder doesn't exist
        if (!is_dir($config["upload_path"])) {
            mkdir($config["upload_path"], 0777, true);
        }
        if (!$this->CI->upload->do_upload('file_attachment')) {
            //$upload_feedback['error'] = array('error' => $this->upload->display_errors());
            //return false;
        } else {
            return $this->CI->upload->data('file_name');
        }
    }
    */
    public function send_email($send_to_list,$subject,$message){
        //Recreate this emil function 
        return true;
    } 

}
