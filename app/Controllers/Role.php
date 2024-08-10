<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RoleModel;
use CodeIgniter\HTTP\ResponseInterface;

class Role extends BaseController
{ 
    public $RoleModel;
    protected $data=[];
    protected $request;
    protected $validator;
    public function __construct() {      
      $this->RoleModel = new RoleModel();
      $this->validator=\Config\Services::validation(); 
      $this->request=\Config\Services::request(); 
   }
   public function jsonList(){
       $this->data['data'] = $this->RoleModel->getRoles("r.status_id IN(1,4)");
       echo json_encode($this->data);
   }
   
    public function create(){
     $validate=\Config\Services::validation();
     $feedback['success'] = false;
      $this->validate([
      'role_name' => 'trim|required|htmlentities',
      'description' => 'trim|required|htmlentities'
       ]);    
       if($this->validator->run()===FALSE){
       $feedback['message'] = $this->validator->listErrors();       
           }else{
               if($this->request->getPost('id') !== NULL && is_numeric($this->request->getPost('id'))){ //editing exsting item
               if($this->RoleModel->updateRoles()){
                   $feedback['success'] = true;
                   $feedback['message'] = "Role details successfully updated";
                 }else{
                   $feedback['message'] = "Role details could not be updated";
                 }
               }else{
                 //adding a new user                
                 if($this->RoleModel->setRoles()){
                   $feedback['success'] = true;
                   $feedback['message'] = "Role details submitted";
                 }else{
                   $feedback['message'] = "There was a problem saving the Role details, please contact IT support";

                 }
               }
           }
       echo json_encode($feedback);
   }

   public function delete(){
     $response['message'] = "Role could not be deleted, contact support.";
     $response['success'] = FALSE;
     if($this->RoleModel->delete_by_id($this->request->getPost('id'))){
       $response['success'] = TRUE;
       $response['message'] = "Role successfully deleted.";
     }
     echo json_encode($response);
   }

   public function change_status(){
       $response['success'] = FALSE;
       $response['message'] = "Role not deactivated.";
     if($this->RoleModel->change_status($this->request->getPost('id'))){
       $response['success'] = TRUE;
       if($this->request->getPost('status_id')==1){
       $response['message'] = "Role successfully Activated";
       } else {
       $response['message'] = "Role successfully deactivated";          
       }
     }
     echo json_encode($response);
   }
}
