<?php

namespace App\Models;

use CodeIgniter\Model;

class StaffModel extends Model
{
    protected $table = 'users';    
    protected $primaryKey = 'id'; 
    protected $db;
    private $single_contact;

    public function __construct() {      
       
        $this->db = \Config\Database::connect();
        $this->request = \Config\Services::request();
        $this->single_contact = "(SELECT `USER_ID`, `mobile_number` FROM `contact` WHERE `id` in (SELECT MAX(`id`) from `contact` GROUP BY `USER_ID`))";
    }

    // This method displays staff data from the database     
    public function getStaff($filter = false) {
        $builder= $this->db->table('users u');
        $builder->select('u.id,u.salutation,u.first_name,u.photo,u.pass_check as check,u.last_name,u.other_names,u.gender,u.email,u.status_id,u.role_id,r.role_name,u.date_created,u.initials,u.comment,st.status_name,u.branch_id,cr.first_name as createdby_firstname,cr.last_name as createdby_lastname,md.first_name as modifiedby_firstname,md.last_name as modifiedby_lastname,u.date_created,u.date_modified,u.firm_id,frm.firm_name,c.mobile_number,b.branch_name');
        $builder->join('users cr', 'cr.id=u.created_by', 'left');
        $builder->join('users md', 'md.id=u.modified_by', 'left');
        $builder->join('roles r', 'u.role_id=r.id','left');
        $builder->join('status st', 'st.id=u.status_id', 'left');
        $builder->join('firms frm', 'frm.id = u.firm_id', 'left');
        $builder->join('branches b', 'b.id = u.branch_id', 'left');
        $builder->join("$this->single_contact c", "c.user_id = u.id", "left");
        $builder->where('u.status_id!=9');
        $builder->orderBy('u.id DESC');
        if ($filter === FALSE) {
            $query = $builder->get();
            return (isset($query))?$query->getResultArray():"";
        } else {
            if (is_numeric($filter)) {
                 $builder->where('u.id=' . $filter);
                $query = $builder->get();
                return (isset($query))?$query->getRowArray():"";
            } else {
                 $builder->where($filter);
                $query = $builder->get();
                //print_r($this->db->last_query());die;
                return (isset($query))?$query->getResultArray():"";
            }
        }
    }
    public function get_valued_by($filter = FALSE) {
        $builder = $this->db->table('users');
        $builder->select('id,first_name,last_name,other_names,salutation,initials');       
        $builder->where('users.status_id in (1,4)');
        if ($filter === false) {
            $query = $builder->get();

            return $query->getResultArray();
        } else {
            if (is_numeric($filter)) {
                 $builder->where('users.id=' . $filter);
                $query = $builder->get('', 1);
                return $query->getRowArray();
            } else {
                 $builder->where($filter);
                $query = $builder->get();
                return $query->getResultArray();
            }
        }
    }

   public function setStaff($passcode) {
        $data = $this->request->getPost(NULL, FILTER_SANITIZE_SPECIAL_CHARS,FILTER_FLAG_ENCODE_HIGH);
        unset($data['id'], $data['tbl']);
        if(!empty($passcode)){
            $rawpassword = $passcode;
            $options = [
                'cost' => 12,
            ];
            $password =password_hash($rawpassword, PASSWORD_BCRYPT, $options);
            $data['password'] =  $password;
        }
        $data['created_by'] = $_SESSION['id'];
        $builder=$this->db->table('users');
       $query= $builder->insert( $data);
        return $query;
    }

    public function updateStaff() {
        $id = $this->request->getPost('id');
        $data = $this->request->getPost(NULL, FILTER_SANITIZE_SPECIAL_CHARS,FILTER_FLAG_ENCODE_HIGH);
        unset($data['id'], $data['tbl']);
        $data['modified_by'] = $_SESSION['id'];

        if (is_numeric($id)) {
             $builder=$this->db->table('users');
             $builder->where('id', $id);
            return $builder->update( $data);
        } else {
            return false;
        }
    }
   /* 
    //Get registered by
    public function get_valued_by($filter = FALSE) {
        $this->db->select('id,first_name,last_name,other_names,SALUTATION,initials');
        $query = $this->db->from('users');
         $builder->where('users.STATUS_ID IN (1,4)');
        if ($filter === FALSE) {
            $query = $builder->get();
            return $query->getResultArray();
        } else {
            if (is_numeric($filter)) {
                 $builder->where('users.id=' . $filter);
                $query = $builder->get('', 1);
                return $query->getRowArray();
            } else {
                 $builder->where($filter);
                $query = $builder->get();
                return $query->getResultArray();
            }
        }
    }

    
      /**
     * This method deactivate staff data from the database
     */
    /*public function change_status_by_id($id = false) {

            $data = array('STATUS_ID' =>$this->request->getPost('status_id'));
             $builder->where('id', $id);
            $query = $this->db->update('users',$data);
            if ($query) {
                return true;
            } else {
                return false;
            }
        
    }

    public function delete_by_id($id = false) {

           $data = array('STATUS_ID' =>'8');
             $builder->where('id', $id);
            $query = $this->db->update('users',$data);
            if ($query) {
                return true;
            } else {
                return false;
            }
    }
*/
}
