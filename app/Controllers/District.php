<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DistrictModel;

class District extends BaseController
{
  
  protected $request;
  protected $validator;
  public $DistrictModel;

    public function __construct() {      
      $this->DistrictModel = new DistrictModel();
      $this->request=\Config\Services::request(); 
      $this->validator=\Config\Services::validation(); 
     }
    public function jsonList(){
      $this->data['data'] = $this->DistrictModel->getDistrict("d.status_id IN(0,1,4)");
      echo json_encode($this->data);
    }
    public function create(){   
      $feedback['success'] = false;
      $this->validate([
        'district_name' => 'trim|required|htmlentities',
         ]);    
         if($this->validator->run()===FALSE){
         $feedback['message'] = $this->validator->listErrors();       
             }else{           
                if($this->request->getPost('id') !== NULL && is_numeric($this->request->getPost('id'))){
                  //editing existing item
                  if($this->DistrictModel->updateDistrict()){
                    $feedback['success'] = true;
                    $feedback['message'] = "District details successfully updated";
                  }else{
                    $feedback['message'] = "District details could not be updated";
                  }
                }else{
                  //adding a new user
                  $result = $this->DistrictModel->setDistrict();
                  if($result){
                    $feedback['success'] = true;
                    $feedback['message'] = "District details submitted";
                  }else{
                    $feedback['message'] = "There was a problem saving the District details, please contact IT support";
                  }
                }
            }
        echo json_encode($feedback);
    }
    public function delete(){
      $response['message'] = "District could not be deleted, contact support.";
      $response['success'] = FALSE;
      if($this->DistrictModel->delete_by_id($this->request->getPost('id'))){
        $response['success'] = TRUE;
        $response['message'] = "District successfully deleted.";
      }
      echo json_encode($response);
    }
    public function change_status(){
        $response['success'] = FALSE;
        $response['message'] = "District not deactivated.";
        if($this->DistrictModel->change_status($this->request->getPost('id'))){
         $response['success'] = TRUE;
        if($this->request->getPost('status_id')==1){
         $response['message'] = "District successfully Activated";
        } else {
        $response['message'] = "District successfully deactivated";          
        }
      }
      echo json_encode($response);
    }
}
