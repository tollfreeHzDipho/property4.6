<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BankModel;


class Bank extends BaseController
{ 
    public $session;
    public $request;
    public $validator;
    public $data = [];
    public $BankModel;

    public function __construct() {      
      $this->BankModel = new BankModel();  
      $this->request=\Config\Services::request(); 
      $this->validator=\Config\Services::validation();  
   }

    public function jsonList(){
        $this->data['data'] = $this->BankModel->getBank("b.status_id IN(0,1,4)");
        echo json_encode($this->data);
    }
     public function create(){          
      $feedback['success'] = false;
      $rules =['bank_name' => 'trim|required|htmlentities'];    
         if(!$this->validate($rules)){
          $feedback['message'] = $this->validator->listErrors();  
             }else{
                if($this->request->getPost('id') !== NULL && is_numeric($this->request->getPost('id'))){ //editing exsting item

                  if($this->BankModel->updateBank()){
                    $feedback['success'] = true;
                    $feedback['message'] = "Bank details successfully updated";
                  }else{
                    $feedback['message'] = "Bank details could not be updated";
                  }
                }else{
                  //adding a new user
                  $result = $this->BankModel->setBank();
                  if($result){
                    $feedback['success'] = true;
                    $feedback['message'] = "Bank details submitted";

                  }else{
                    $feedback['message'] = "There was a problem saving the Bank details, please contact IT support";

                  }
                }
            }
        echo json_encode($feedback);
    }
    public function delete(){
      $response['message'] = "Bank could not be deleted, contact support.";
      $response['success'] = FALSE;
      if($this->BankModel->delete_by_id($this->request->getPost('id'))){
        $response['success'] = TRUE;
        $response['message'] = "Bank successfully deleted.";
      }
      echo json_encode($response);
    }

    public function change_status(){
        $response['success'] = FALSE;
        $response['message'] = "Bank not deactivated.";
      if($this->BankModel->change_status($this->request->getPost('id'))){
        $response['success'] = TRUE;
        if($this->request->getPost('status_id')==1){
        $response['message'] = "Bank successfully Activated";
        } else {
        $response['message'] = "Bank successfully deactivated";          
        }
      }
      echo json_encode($response);
    }
}
