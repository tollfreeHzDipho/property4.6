<?php

namespace App\Models;

use CodeIgniter\Model;

class PropertyModel extends Model
{
    protected $table            = 'property';
    protected $primaryKey       = 'id';
    protected $db;
    protected $request;

    public function __construct() {      
       
        $this->db = \Config\Database::connect();
        $this->request = \Config\Services::request();
    }
    public function get_distinct($filter = FALSE) { //per district
        $sub_query= '';
        if ($filter === false) {
           $sub_query= '';
        }else{
            $sub_query= ' WHERE '.$filter.' ';
        }
        $query = $this->db->query('SELECT * from(SELECT district_id, count(*) as count from property group by district_id) d1 left join district on district_id=district.id ORDER BY d1.count desc limit 15' );
       
         return $query->getResultArray();
    }
    public function get_per_entrant($filter) {  //prop per user
        $query = $this->db->query('SELECT users.id,users.salutation,users.first_name,users.initials,users.photo,users.last_name,users.other_names,d1.created_by,d1.date_created,d1.count from(SELECT property.created_by,property.date_created, count(id) as count from property '.$filter.' group by property.created_by) d1 left join users on d1.created_by=users.id');
       //print_r($this->db->last_query()); die;
         return $query->getResultArray();
    }

    public function get_per_user($filter = FALSE) {  //prop per user
        $sub_query= '';
        if ($filter === false) {
           $sub_query= '';
        }else{
            $sub_query= ' WHERE '.$filter.' ';
        }
        $query = $this->db->query('SELECT users.salutation,users.first_name,users.initials,users.photo,users.last_name,users.other_names,d1.valuer_id,d1.date_of_val,d1.date_created,d1.count from(SELECT property.valuer_id,property.date_of_val,property.date_created, count(*) as count from property group by valuer_id) d1 left join users on valuer_id=users.id ORDER BY  d1.count DESC');
       
         return $query->getResultArray();
    }
    public function get_per_month($filter = FALSE) {  //prop per user
       
        $query = $this->db->query('SELECT d1.month,d1.count from(SELECT MONTH(date_of_val) as month, count(*) as count from property WHERE YEAR(date_of_val)='.$filter.' group by MONTH(date_of_val)) d1');
       
         return $query->getResultArray();
    }
    public function getProperty($filter = FALSE) {
        $builder=$this->db->table('property p');
        $builder->select('p.id,tenure,property_address,north,east,date_of_val,acreage,rate_per_acre,property_value,serial_no, bank_option,user_status,user_option,p.notes,town_id,village_id,p.date_created,p.zone,p.c_east,p.c_north,p.category_id,p.date_modified,uv.salutation as valuer_salutation,uv.first_name as valuer_firstname,uv.last_name as valuer_lastname,uv.other_names as valuer_othernames,uv.initials as valuer_initials,uc.salutation as created_salutation,uc.first_name as created_first_name,uc.last_name as created_last_name,uc.other_names as created_other_names,um.salutation as modified_salutation,um.first_name as modified_firstname,um.last_name as modified_lastname,um.other_names as modified_othernames, bank_id,b. bank_name,district_id,d.district_name,p.firm_id,firm_name,status_name,p.status_id,valuer_id');     
        $builder->join(' banks b', 'b.id=p. bank_id', 'left');
        $builder->join('users uv', 'uv.id=p.valuer_id', 'left');
        $builder->join('district d', 'd.id=p.district_id', 'left');
        $builder->join('firms frm', 'frm.id=p.firm_id', 'left');
        $builder->join('users uc', 'uc.id=p.created_by', 'left');
        $builder->join('users um', 'um.id=p.modified_by', 'left');
        $builder->join('status st', 'st.id=p.status_id', 'left');

        $builder->orderBy('p.id DESC');
        if ($filter === FALSE) {
            $query = $builder->get();
            return $query->getResultArray();
        } else {
            if (is_numeric($filter)) {
                $builder->where('p.id=' . $filter);
                $query = $builder->get();
                return $query->getRowArray();
            } else {
                $builder->where($filter);
                $query = $builder->get();
               //print_r($this->db->last_query());die;
                return $query->getResultArray();
            }
        }
    }

     public function setProperty($serial_no) {
            $data = $this->request->getPost(NULL, FILTER_SANITIZE_SPECIAL_CHARS,FILTER_FLAG_ENCODE_HIGH);
            unset($data['id'],$data['tbl']);
           if($this->request->getPost(' bank_id')=="9999"){
            $data[' bank_option'] = $this->request->getPost(' bank_option');
            }
            $data['status_id'] = 1;
            $data['serial_no'] = $serial_no;
            $data['created_by'] =$_SESSION['id'];
            $builder=$this->db->table('property');
            $query = $builder->insert($data);
            if ($query) {
                return true;
            } else {
                return false;
            }
    }

    public function updateProperty() {
        $data = $this->request->getPost(NULL, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        unset($data['id'], $data['tbl']);
        if ($this->request->getPost(' bank_id') == "9999") {
            $data['bank_option'] = $this->request->getPost(' bank_option');
        }
      
        $data['modified_by'] = $_SESSION['id'];
        $builder = $this->db->table('property');
        $builder->where('id', $this->request->getPost('id'));
        $query = $builder->update($data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
 
    public function change_status($id = false) {

        $data = array('status_id' =>$this->request->getPost('status_id'));       
        $builder=$this->db->table('property');
        $builder->where('id', $id);
        $query = $builder->update($data);
        if ($query) {
            return true;
        } else {
            return false;
        }
        
    }

    public function delete_by_id($id = false) {

        $data = array('status_id' =>'8');
        $builder=$this->db->table('property');
            $builder->where('id', $id);
            $query = $builder->update($data);
            if ($query) {
                return true;
            } else {
                return false;
            }
    }
}
