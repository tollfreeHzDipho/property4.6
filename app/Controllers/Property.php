<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\Helpers;
use App\Models\PropertyModel;
use App\Models\StaffModel;
use App\Models\DistrictModel;
use App\Models\BankModel;
use App\Models\FirmModel;


class Property extends BaseController
{
    public $DistrictModel;
    public $StaffModel;
    public $BankModel;
    public $PropertyModel;
    public $FirmModel;
    public $session;
    public $data;
    public $custom_helper;


    function __construct()
    {
        $this->PropertyModel = new PropertyModel();
        $this->DistrictModel = new DistrictModel();
        $this->BankModel = new BankModel();
        $this->StaffModel = new StaffModel();
        $this->FirmModel = new FirmModel();
        $this->custom_helper = new Helpers();
    }

    public function jsonList()
    {
        $this->data['data'] = $this->PropertyModel->getProperty("p.status_id=" . $this->request->getVar('status_id'));
        echo json_encode($this->data);
    }
    public function prop_per_user()
    {
        $this->data['data'] = $this->PropertyModel->get_per_user("p.status_id=" . $this->request->getVar('status_id'));
        echo json_encode($this->data);
    }

    public function prop_per_entrant()
    {
        $this->data['this_week'] = $this->PropertyModel->get_per_entrant(" WHERE (date_created BETWEEN '" . date('Y-m-d', strtotime('this week monday')) . "' AND '" . date('Y-m-d', strtotime('this week sunday')) . "')");

        echo json_encode($this->data);
    }
     public function jsonListMapDetails()
    {
        $this->data['data'] = $this->PropertyModel->getProperty("p.status_id=" . $this->request->getVar('status_id'));

        echo json_encode($this->data);
    }
    public function index()
    {

        $this->data['properties'] = $this->PropertyModel->getProperty();
        $this->data['districts'] = $this->DistrictModel->get()->getResultArray();
        $this->data['banks'] = $this->BankModel->get()->getResultArray();
        $this->data['firms'] = $this->FirmModel->get()->getResultArray();
        $this->data['valuers'] = $this->StaffModel->get_valued_by();
        //print_r($this->data['valuers']); die();

        // Load a view in the content partial
        return view('property/index', $this->data);
    }

    public function create()
    {
        $rules = [
            'tenure' => 'required',
            'date_of_val' => 'required',
            'acreage' => 'required',
            'property_value' => 'required',
            'district_id' => 'required',
            'user_status' => 'required',
        ];
        if (isset($_POST['zone']) && $_POST['zone'] != "") {
            $rules['zone'] = 'required';
        }
        /*  if($_POST['north']!=="" && $_POST['east']!==""){
            $rules['convnorth']='required'; 
            $rules['conveast']='required';          
        }    */
        if ($_POST['north'] !== "") {
            $rules['north'] = 'required';
        }
        if ($_POST['east'] !== "") {
            $rules['east'] = 'required';
        }
        if ($_POST['user_status'] == "Other") {
            $rules['user_option'] = 'required';
        }
        if ($_POST['bank_id'] == "9999") {
            $rules['bank_id'] = 'required';
        }

        $feedback['success'] = false;
        if (!$this->validate($rules)) {
            $feedback['message'] = $this->validator->listErrors();
        } else {
            if (isset($_POST['id']) && is_numeric($_POST['id'])) {
                if ($this->PropertyModel->updateProperty()) {
                    $feedback['success'] = true;
                    $feedback['message'] = "Property successfully updated";
                } else {
                    $feedback['message'] = "There was a problem updating the Property";
                }
            } else {

                $serial_no = $this->generate_serial_no();
                if (isset($serial_no) && $serial_no!='') {
                    if ($this->PropertyModel->setProperty($serial_no)) {
                        $feedback['success'] = true;
                        $feedback['message'] = "Property successfully saved";
                    } else {
                        $feedback['message'] = "Database Error: Property Not saved";
                    }
                } else {
                    $feedback['message'] = "Serial number not properly formed. \n Firm may not be set";
                }
            }
        }
        echo json_encode($feedback);
    }

    public function view($id)
    {
        $this->data['property'] = $this->PropertyModel->getProperty($id);
        if (empty($this->data['property'])) {
            // show_404();
        }
        $this->data['properties'] = $this->PropertyModel->getProperty();
        $this->data['districts'] = $this->DistrictModel->get()->getResultArray();
        $this->data['banks'] = $this->BankModel->get()->getResultArray();
        $this->data['firms'] = $this->FirmModel->get()->getResultArray();
        $this->data['valuers'] = $this->StaffModel->get_valued_by();
        $this->data['title'] = "";
        $this->data['sub_title'] = "";

        echo view('property/details', $this->data);
        // Publish the template

    }
  public function propertyDetails($id)
    {
        $this->data['property'] = $this->PropertyModel->getProperty($id);
        if (empty($this->data['property'])) {
            // show_404();
        }
      /* $this->data['properties'] = $this->PropertyModel->getProperty();
        $this->data['districts'] = $this->DistrictModel->get()->getResultArray();
        $this->data['banks'] = $this->BankModel->get()->getResultArray();
        $this->data['firms'] = $this->FirmModel->get()->getResultArray();
        $this->data['valuers'] = $this->StaffModel->get_valued_by(); */
        $this->data['title'] = "Property Details";
        $this->data['sub_title'] = "";

        echo view('property/details2', $this->data);        

    }

    function generate_serial_no()
    {
        $row = $this->FirmModel->where('id', $_SESSION['firm_id'])->first();
        if (isset($row['id'])) {
            $org_id = $row['id'];
            $counter =  $row['counter'];
            if ($counter == 9999) {
                $counter = 0;
                $serial_no = $org_id . date('ym') . sprintf("%04d", $counter + 1);
            } else {
                $serial_no = $org_id . date('ym') . sprintf("%04d", $counter + 1);
            }
            $db = \Config\Database::connect();
            $builder = $db->table('firms');
            $builder->where('id', $org_id);
            $upd = $builder->update(["counter" => $counter + 1]);
            if ($upd) {
                return $serial_no;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
   
    public function delete(){
        $response['message'] = "Property could not be deleted, contact support.";
        $response['success'] = FALSE;
        if($this->PropertyModel->delete_by_id($this->request->getPost('id'))){
          $response['success'] = TRUE;
          $response['message'] = "Property successfully deleted.";
        }
        echo json_encode($response);
      }
  
      public function change_status(){
          $response['success'] = FALSE;
          $response['message'] = "Property not deactivated.";
        if($this->PropertyModel->change_status($this->request->getPost('id'))){
          $response['success'] = TRUE;
          if($this->request->getPost('status_id')==1){
            $response['message'] = "Property successfully Activated";
            } else {
            $response['message'] = "Property successfully deactivated";          
            }
        }
        echo json_encode($response);
      }
}
