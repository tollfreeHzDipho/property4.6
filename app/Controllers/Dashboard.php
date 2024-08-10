<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use App\Models\ContactModel;
use App\Models\PropertyModel;
use App\Models\StaffModel;

class Dashboard extends BaseController
{
    public $UserModel;
    public $ContactModel;
    public $PropertyModel;
    public $StaffModel;
    public $session;
    protected $data;
 
    function __construct(){
        $this->UserModel = new UserModel();
        $this->ContactModel = new ContactModel();
        $this->PropertyModel = new PropertyModel();
        $this->StaffModel = new StaffModel();
    }

    public function index()
    {
        
        $this->data['properties'] =  $this->PropertyModel->getProperty();
        $xx=array();
         for($i=1;$i<=12;$i++){ //props this year
              $this->data[$i] =  $this->PropertyModel->getProperty("MONTH(`date_of_val`) =".$i." AND YEAR(`date_of_val`) = ".date("Y"));
                $xx[$i]=count( $this->data[$i]);
         }
        $this->data['month']=$xx;
        $this->data['monthly'] = $this->PropertyModel->get_per_month(date('Y'));
        $no_cord =  $this->PropertyModel->getProperty('(north IS NULL OR north = "") OR (east IS NULL OR east ="") ');
        $this->data['properties_nocord']=count($no_cord);
        $this->data['properties_cord'] =count($this->data['properties'])-$this->data['properties_nocord'];

        $this->data['per_dist'] =  $this->PropertyModel->get_distinct();
      
        $this->data['user'] = $this->StaffModel->getStaff();
        $this->data['valuers'] = $this->StaffModel->get_valued_by();
        //print_r($this->data).die;
        // Load a view in the content partial
        return view('dashboard', $this->data);
      
		
    }
}
