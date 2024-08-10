<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Session\Session;
use App\Libraries\Helpers;

class Setting extends BaseController
{
    public $custom_helper;
    public function __construct() {  
        $this->custom_helper = new Helpers();
        if(empty(session())){
            redirect('login/3');    //route for login/auth/3
        } 
        $this->custom_helper->log_online_status_create(session()->get('id'));
    }

    public function index() {
        $this->data['title'] = $this->data['sub_title'] = "Organisation /Firm Setup";
        return view('settings/index', $this->data);       
    }
}
