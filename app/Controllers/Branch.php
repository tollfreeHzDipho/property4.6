<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BranchModel;

class Branch extends BaseController
{
    public $BranchModel;
    protected $data=[];
    protected $request;
    protected $validator;
    public function __construct() {      
      $this->BranchModel = new BranchModel();  
      $this->request=\Config\Services::request(); 
      $this->validator=\Config\Services::validation(); 
   }
    public function jsonList(){
        $this->data['data'] = $this->BranchModel->getBranch("b.status_id IN(1,4)");
        echo json_encode($this->data);
    }

     public function create(){
     
      $feedback['success'] = false;
       $this->validate([
        'branch_name' => 'required|htmlentities|trim',
        'branch_address' => 'trim|required|htmlentities',
         ]);    
         if($this->validator->run()===FALSE){
         $feedback['message'] = $this->validator->listErrors();       
             }else{ 
                if($this->request->getPost('id') !== NULL && is_numeric($this->request->getPost('id'))){
                   //editing existing item
                  if($this->BranchModel->updateBranch()){
                    $feedback['success'] = true;
                    $feedback['message'] = "Branch details successfully updated";
                  }else{
                    $feedback['message'] = "Branch details could not be updated";
                  }
                }else{
                  //adding a new user
                  $result = $this->BranchModel->setBranch();
                  if($result){
                    $feedback['success'] = true;
                    $feedback['message'] = "Branch details submitted";

                  }else{
                    $feedback['message'] = "There was a problem saving the Branch details, please contact IT support";

                  }
                }
            }
        echo json_encode($feedback);
    }
     public function change_status(){
        $response['success'] = FALSE;
        $response['message'] = "Branch not deactivated.";
      if($this->BranchModel->change_status($this->request->getPost('id'))){
        $response['success'] = TRUE;
        if($this->request->getPost('status_id')==1){
        $response['message'] = "Branch successfully Activated";
        } else {
        $response['message'] = "Branch successfully deactivated";          
        }
      }
      echo json_encode($response);
    }
    public function delete(){
      $response['message'] = "Branch could not be deleted, contact support.";
      $response['success'] = FALSE;
      if($this->BranchModel->delete_by_id($this->request->getPost('id'))){
        $response['success'] = TRUE;
        $response['message'] = "Branch successfully deleted.";
      }
      echo json_encode($response);
    }   
}
