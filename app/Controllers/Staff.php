<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StaffModel;
use App\Models\BranchModel;
use App\Models\ContactModel;
use App\Models\ProfilePicModel;
use App\Models\RoleModel;
use App\Libraries\Helpers;

class Staff extends BaseController
{
    public $BranchModel;
    public $StaffModel;
    public $ContactModel;
    public $ProfilePicModel;
    public $RoleModel;
    public $session;
    public $data = [];
    public $custom_helper;
    public function __construct()
    {
        $this->ContactModel = new ContactModel();
        $this->StaffModel = new StaffModel();
        $this->BranchModel = new BranchModel();
        $this->RoleModel = new RoleModel();
        $this->ProfilePicModel = new ProfilePicModel();
        $this->custom_helper = new Helpers();
        $this->request=\Config\Services::request(); 
        $this->validator=\Config\Services::validation();  
        if (empty(session())) {
            redirect('login/3');    //route for login/auth/3
        }
        $this->custom_helper->log_online_status_create(session()->get('id'));
    }

    public function index()
    {
        $this->data['branches'] = $this->BranchModel->getBranch();
        $this->data['roles'] = $this->RoleModel->getRoles('status_id=1');
        // Load a view in the content partial
        return view('users/staff/index', $this->data);
    }

    public function jsonList()
    {
        $this->data['data'] = $this->StaffModel->getStaff("u.status_id=" . $this->request->getPost('status_id'));
        echo json_encode($this->data);
    }

    public function create()
    {

        $feedback['success'] = false;
        $rules = [
            'first_name' => [
                'label'  => 'First Name',
                'rules'  => 'trim|required|htmlentities',
                'errors' => [
                    'required' => '{field} is required',
                ],
            ],
            'last_name' => [
                'label'  => 'Last Name',
                'rules'  => 'trim|required|htmlentities',
                'errors' => [
                    'required' => '{field} is required',
                ],
            ],
            'salutation' => [
                'label'  => 'Salutation',
                'rules'  => 'trim|htmlentities',
                'errors' => [
                    'required' => '{field} is should be text',
                ],
            ], 
            'gender' => [
                'label'  => 'Gender',
                'rules'  => 'trim|htmlentities|required',
                'errors' => [
                    'required' => '{field} is required',
                ],
            ],
            'branch_id' => [
                'label'  => 'Branch ',
                'rules'  => 'trim|htmlentities|required',
                'errors' => [
                    'required' => 'Please select {field}',
                ],
            ]
        ];
        if ($this->request->getPost('id') == NULL) {
            $rules['email'] = [
                'label' => 'Email',
                'rules' => 'trim|valid_email|required|is_unique[users.email]',
                array('required' => '%s is required', 'valid_email' => '%s is invalid', 'is_unique' => 'This %s address already belongs to another account, please contact your administrator for assistance. Do not create the same user with an another email address')
            ];
        }
        $feedback['success'] = false;

        if (!$this->validate($rules)) {
            $feedback['message'] = $this->validator->listErrors();   
        } else {
            if ($this->request->getPost('id') !== NULL && is_numeric($this->request->getPost('id'))) {
                //editing exsting item
                if ($this->StaffModel->updateStaff()) {
                    $feedback['success'] = true;
                    $feedback['message'] = "User Details successfully updated";
                    $feedback['user'] = $this->StaffModel->getStaff($this->request->getPost('id'));
                } else {
                    $feedback['message'] = "There was a problem updating the user data, please try again";
                }
            } else {
                $passcode = $this->generateRandomString();
                if ($this->StaffModel->setStaff($passcode)) {
                    // SEND email
                    $username = $this->request->getPost("email");
                    $hello = $this->request->getPost('first_name');
                    $subject = 'LOGIN DETAILS';
                    $send_to_list = array($this->request->getPost('email'));
                    $message = '<tr bgcolor="#17a2b8">
                  <td >
                      <h1><center> DOTCOM VALUES </center></h1>
                  </td>
                  </tr>
                  <tr>
                      <td class="content-block">
                          <h3>Hello ' . $hello . ',</h3>
                      </td>
                  </tr><tr>
                    <td class="content-block">
                    Please use the following details to login and activate your account <br> <b> USERNAME : </b> ' . $username . ' <br><b>PASSWORD : </b> ' . $passcode . '
                        </td>
                    </tr>
                    <tr>
                        <td class="content-block">
                            This is a system generated password, please login and go to <b>My Profile</b> to change your password. <br>
                            <font color="brown"><b>NOTE: </b>Copying and pasting the password not recommended.</font>
                        </td>
                    </tr>
                    <tr>
                        <td class="content-block">
                            Click the button below to access the login page
                        </td>
                    </tr>
                    <tr>
                        <td class="content-block aligncenter">
                            <a target="_blank" href="https://www.dotcomvalues.org/" class="btn-info">Go to Login Page</a>
                        </td>
                    </tr>';

                    $feedback['success'] = true;
                    if ($this->custom_helper->send_email($send_to_list, $subject, $message)) {
                        $feedback['message'] = "User Details successfully Added";
                    } else {
                        $feedback['message'] = "User registered but email not sent, check email address or go to user details and set temporary password";
                    }
                } else {
                    $feedback['message'] = "There was a problem adding the user data, please try again";
                }
            }
        }

        echo json_encode($feedback);
    }
    
     public function view($id) {
        $this->data['branches'] = $this->BranchModel->getBranch();
        $this->data['user'] = $this->StaffModel->getStaff($id);
        $this->data['contact_types'] = $this->ContactModel->get_contact_type();
        $this->data['roles'] = $this->RoleModel->getRoles('status_id=1');  
     
        // Load a view in the content partial
        return view('users/staff/view',$this->data);          
    }
    
   public function delete(){
      $response['message'] = "User could not be deleted, contact support.";
      $response['success'] = FALSE;
      if($this->StaffModel->delete_by_id($this->request->getPost('id'))){
        $response['success'] = TRUE;
        $response['message'] = "User successfully deleted.";
      }
      echo json_encode($response);
    }

    public function change_status(){
        $response['success'] = FALSE;
        $response['message'] = "User not deactivated.";
      if($this->StaffModel->change_status_by_id($this->request->getPost('id'))){
        $response['success'] = TRUE;
        $response['message'] = "User successfully deactivated, can not access the system";
      }
      echo json_encode($response);
    }

    
  public function add_profile_pic()
    {
        $feedback['msg'] = '';
        $feedback['success'] = 'false';
        $current_foto =$this->session->get('photo');         
        $user_id = $this->request->getPost('i_d');
        $surname = $this->request->getPost('user_name');     
        $imagery = $_POST['image']; 

        if(!empty($imagery)){
            $data2 = $imagery;
            list($type, $data2) = explode(';', $data2);
            list(, $data2) = explode(',', $data2);
            $data2 = base64_decode($data2);

            $mypath = './public/uploads/profile_pics/';
            if (!is_dir($mypath)) {
                mkdir('./' . $mypath, 0755, true);
            }

            $db_img_link = $surname . time() . rand(1000, 9999) . '.jpg';
            $path_folder = $mypath . $db_img_link;
         
            if (file_put_contents($path_folder, $data2)) {
                $photo = array(
                    'photo' => $db_img_link,
                    'modified_by' => $this->session->get('id')
                );
                           //remove the current photo
                $existing_photo=$this->ProfilePicModel->find($user_id);                
                if (isset($existing_photo['photo'])&&($existing_photo['photo']!='')) { 
                    $filename = "./public/uploads/profile_pics/" . $current_foto;
                    if (file_exists($filename)) {
                        unlink($filename);
                    }
                }
                if ($this->ProfilePicModel->update($user_id, $photo)) {
                   
                    $this->session->set('photo',$db_img_link);
                     $feedback['msg']="Updated successfully";
			         $feedback['success']='true';
                 } else {
                     $feedback['msg']="OOPS! Please try again!!";
                } 
            }
        } else {
            $feedback['msg']="OOPS! Please select a photo!!";
        }
        echo json_encode($feedback);   
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
}
