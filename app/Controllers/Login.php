<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    public $UserModel;
    public $session;
    public function __construct()
    {
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        if (!empty($this->session->get('id'))) {           
           return route_to('dashboard');
        } else {
            return view('users/login');
        }
    }
    public function auth($msg_type = false)
    {
        $rules =
            [
                'password' => [
                    'label'  => 'Password',
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => 'Please set your %s.',
                        'min_length[8]' => '{field} must be alteast 8 Characters',
                    ],
                ],
                'username' => [
                    'label'  => 'Username',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => '{field} is required'
                    ],
                ],
            ];
        if ($msg_type == 1) {
            $this->session->setFlashdata('message', '<div class="alert alert-success text-center alert-dismissable">Successfully Logged out <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div>');
        } elseif ($msg_type == 2) {
            $this->session->setFlashdata('message', '<div class="alert alert-warning text-center alert-dismissable">Logged out due to inactivity, login again <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div>');
        } elseif ($msg_type == 3) {
            $this->session->setFlashdata('message', '<div class="alert alert-primary text-center alert-dismissable">Please login to access this resource. <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div>');
        } elseif ($msg_type == 4) {
            $this->session->setFlashdata('message', '<div class="alert alert-primary text-center alert-dismissable">You do not have sufficient privileges.<br/>Please contact the administrator first. <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div>');
        }
        if (!$this->validate($rules)) {          
            return view('users/login');
        } else {
            $this->data['userdata'] = $this->UserModel->login();
            if (empty($this->data['userdata'])) {
                $this->session->setFlashdata('message', '<div class="alert alert-danger text-center alert-dismissable">Incorrect Username or Password ! <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div>');
                return view('users/login', $this->data);
            } else { 
                if (($this->data['userdata']['status_id'] == 1) || ($this->data['userdata']['status_id'] == 9)) { 
                  // $salt = $this->data['userdata']['salt'];
                    $password = $this->request->getVar('password');
                    $db_encrypted_password = $this->data['userdata']['password'];
                    if (password_verify($password, $db_encrypted_password)) {
                       
                      /*   $hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
                        if (password_needs_rehash($hash, PASSWORD_DEFAULT, ['cost' => 12])) {
                            // Recalculate a new password_hash() and overwrite the one we stored previously
                            $this->UserModel->update_pass($this->data['userdata']['id']);
                        } */
                        // Add user data in session
                        $userdata = array(
                            'id' => $this->data['userdata']['id'],
                            'salutation' => $this->data['userdata']['salutation'],
                            'first_name' => $this->data['userdata']['first_name'],
                            'last_name' => $this->data['userdata']['last_name'],
                            'other_names' => $this->data['userdata']['other_names'],
                            'gender' => $this->data['userdata']['gender'],
                            'email' => $this->data['userdata']['email'],
                            'photo' => $this->data['userdata']['photo'],
                            'branch_name' => $this->data['userdata']['branch_name'],
                            'role_id' => $this->data['userdata']['role_id'],
                            'role_name' => $this->data['userdata']['role_name'],
                            'mobile_number' => $this->data['userdata']['mobile_number'],
                            'curr_interface' => "staff",
                            'firm_id' => $this->data['userdata']['firm_id'],
                            'firm_name' => $this->data['userdata']['firm_name']
                        );
                        $this->session->set($userdata);                        
                      //  $this->log_online_status_create1($this->data['userdata']['id']);
                      return redirect()->to('dashboard');
                    } else {
                        $this->session->setFlashdata('message', '<div class="alert alert-danger text-center">Incorrect Username or Password !!</div>');
                        return view('users/login', $this->data);
                    }
                } else {
                    $this->session->setFlashdata('message', '<div class="alert alert-danger text-center alert-dismissable">Access Denied !<br/>Please contact the administrator .  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div>');
                    return view('users/login', $this->data);
                }
            }
        }
    }
    public function logout($msg_type = 1)
    {

        $dataArray = array(
            "last_seen" => time(),
            'status' => '0'
        );
        //Update table for last seen 
        //$this->UserModel->update_session($this->session->get('id'), $dataArray);
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
    public function jsonList() {
        $datas = $this->UserModel->get_session_log();
        echo json_encode($datas);
    }
/* 
    function log_online_status_create1($id){
        $this->data['sessions'] = $this->UserModel->get_session_log($id);
        //print_r($this->data['sessions']).die;
        if (count($this->data['sessions']) >= 1) {

            //update
            $data = array('TIME'=>time(),
                        'STATUS'=>1,
                        'LASTSEEN'=>time()
                    );
            $this->UserModel->update_session($id, $data);
        } else {
            //insert
            $data = array('TIME'=>time(),
                        'status_id'=>$this->session->userdata('id'),
                        'STATUS'=>1,
                        "LASTSEEN"=>time()
                        );
            $this->UserModel->insert_session($data);
        }
    }
   
    
    public function checkmail(){
         $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('email', 'Email', 'trim|required', array('required' => ' %s address is required.'));
         $feedback['success'] = false;
        if($this->form_validation->run() == FALSE)
        {
            $feedback['message'] = validation_errors('<li>', '</li>');
         }else{

         $data = array(
            'email' => $this->request->getVar('email')
            );
            $res = $this->UserModel->check_user($data['email']);

            if(!empty($res))
            {
            if($this->sendpasscode($res['email'],$this->generateRandomString())){
              $feedback['success'] = true;
              $feedback['message'] = "We have sent you a link to reset your password, please check your Email";
            } else{
               $feedback['message'] = "There was a problem sending the email, please try again";
            }
            } else {
               $feedback['message'] = "Your email does not match any account, Try the email you used to create this Account";
            } 
           
       }
       echo json_encode($feedback);
    }

    
    public function set_password(){
     $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
       $this->form_validation->set_rules('pass', 'Password', 'trim|required|min_length[6]', array('required' => 'Please set your %s.','min_length[6]'=>'%s must be alteast 6 Characters'));
       $this->form_validation->set_rules('repass', 'Confirm Password', 'trim|required|matches[pass]', array('required' => 'Please confirm your password.',' matches[pass]'=>'%s does not match'));
        $f_email=$_GET['f_e'];
        $f_code=$_GET['r_c'];
        $user =$this->UserModel->fetch_user_id($f_email,$f_code);
         if(!empty($user)){
             
        if($this->form_validation->run() == FALSE)
         {
        echo view('users/reset_pass');
         }else{
           
         $id=$user['id'];
            $rawpassword = $this->request->getVar('repass');
            $options = [
                'cost' => 12,
            ];
            $password =password_hash($rawpassword, PASSWORD_BCRYPT, $options);
           $data = array(
            'F_EMAIL' => NULL,
            'F_CODE' => NULL,
            'PASSWORD' => $password
            );
            $this->db->where('id',$id);
            if($this->db->update('users',$data))
            {
                 $this->session->set_flashdata('message','<div class="alert alert-success text-center">Successful ! Login with the new password now </div>');
              echo view('users/login');
                
            } else{
                 $this->session->set_flashdata('rpass2','<div class="alert alert-warning text-center">Failed, Try again</div>');
              echo view('users/reset_pass');
               
            } 
           
       }
         
    } else {
         $this->session->set_flashdata('rpass2','<div class="alert alert-danger text-center">The Link has already been used by you </div>');
               echo view('users/reset_pass');
    }
    }
    
    function sendpasscode($Q_email,$emailcode){


       $code_to_email=md5($emailcode);
       $encode_mail =md5($Q_email); 
         
         $data = array(
        'F_CODE' => $code_to_email,
        'F_EMAIL' => $encode_mail,
         );
        
    $subject='FORGOT PASSWORD REQUEST';
    $send_to_list = array($this->request->getVar('email'));
    $message ='<tr bgcolor="#890606">
            <td >
                <h1><center>RESET PASSWORD</center></h1>
            </td>
        </tr>
        <tr>
            <td class="content-block">
                <h3>Hello '.$Q_email.',</h3>
            </td>
        </tr>
     <tr>
        <td class="content-block">
        You have requested a password reset, please follow the link below to reset your password.
            </td>
        </tr>
        <tr>
            <td class="content-block">
               Please ignore this email if you did not request a password change.
            </td>
        </tr>
       
        <tr>
            <td class="content-block aligncenter">
                <a target="_blank" href="https://www.dotcomvalues.org/login/set_password?r_c='.$code_to_email.'&f_e='.$encode_mail.'" class="btn-info">Reset password</a>
            </td>
        </tr>
        <tr>
            <td class="content-block ">
                 OR copy this link and paste in your browser https://www.dotcomvalues.org/login/set_password?r_c='.$code_to_email.'&f_e='.$encode_mail.'
            <p>With Regards</p>
            <p>EACSV SYSTEM ADMIN</p>
            </td>
        </tr>';
       if($this->helpers->send_email($send_to_list,$subject,$message)){
        if($this->UserModel->update_user_table($Q_email,$data)){
            return true;
        } 
        } else{
          return false;
        }
    }


    function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
   */
    
}
