<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ContactModel;
use App\Models\UserModel;

class Contact extends BaseController
{
    
    public $session;
    public $request;
    public $validator;
    public $ContactModel,$UserModel;
    public $data = [];
    public function __construct() {
        $this->request=\Config\Services::request(); 
        $this->validator=\Config\Services::validation();  
        $this->ContactModel = new ContactModel();  
        $this->UserModel = new UserModel();  
    }
       public function jsonList(){
           $this->data['data'] = $this->ContactModel->getContact($this->request->getPost('user_id') );
           echo json_encode($this->data);
       }
   
   #user_id, mobile_number, contact_type_id, date_created, date_modified, created_by, modified_by
       public function create(){        
       
        $feedback['success'] = false;
        $rules = [
            'mobile_number' => 'trim|required',
            'contact_type_id' => 'trim|required'
        ];    
         if(!$this->validate($rules) && $this->check_phone_number($this->request->getPost('contact_type_id'))){
          $feedback['message'] = $this->validator->listErrors();  
               }else{
                   if($this->request->getPost('id') !== NULL && is_numeric($this->request->getPost('id'))){ //editing contact
                       
                       if($this->ContactModel->update_contact()){
                             $feedback['success'] = true;
                             $feedback['message'] = "Contact Details successfully updated";
                           }else{
                             $feedback['message'] = "There was a problem updating the contact data, please try again";
                           }
                   }else{
                       //adding a new item
                           if($this->ContactModel->add_contact()){
                             $feedback['success'] = true;
                             $feedback['message'] = "Contact has been successfully Added";
                           }else{
                             $feedback['message'] = "There was a problem saving the contact data, please try again";
                           }
                   }
               }
           echo json_encode($feedback);
       }
   
       function check_phone_number($phone_number) {
           $existing_number = $this->ContactModel->validate_contact($phone_number);           
           return $existing_number;
       }
       public function delete(){
         $response['message'] = "Data could not be deleted, contact support.";
         $response['success'] = FALSE;
         if($this->ContactModel->delete_by_id()){
           $response['success'] = TRUE;
           $response['message'] = "Data successfully deleted.";
         }
         echo json_encode($response);
       }
   
}
