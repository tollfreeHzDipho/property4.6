<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{  
    public $db;
    public $request;
    protected $table  = 'users';    
    protected $primaryKey = 'id'; 
    function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->request = \Config\Services::request();
    }
    // login the user
    
   public function login() {
     
        $builder=$this->db->table('users');
        $builder->select('users.id,salutation,first_name,photo,last_name,other_names,password,gender,email,users.status_id,users.firm_id,f.firm_name,users.role_id,r.role_name,c.mobile_number,branch_id,b.branch_name');
        $builder->join('firms f', 'users.firm_id=f.id','left');
        $builder->join('roles r', 'role_id=r.id','left');
        $builder->join('branches b', 'b.id = branch_id', 'left');
        $builder->join('contact c', 'c.user_id=users.id', 'left');
        $builder->where('email', $this->request->getVar('username'));
        $builder->where('email', $this->request->getVar('username'));
        $builder->orWhere('c.mobile_number', $this->request->getVar('username'));       
        if ($query = $builder->get()) {
			return $query->getRowArray();
		} else {
			return false;
		}
    }
   
    public function get_session_log($filter=FALSE) { 
        $builder=$this->db->table('session_log s');
        $builder->select('s.*,u.id as user_id,u.salutation,u.first_name,u.PHOTO,u.last_name,u.other_names,u.firm_id');     
        $builder->join('users u', 's.user_id=u.id', 'left');
        $builder->orderBy("s.last_seen","desc");
        if ($filter === FALSE) {
        $builder->where('u.status_id!=9');
            $query = $builder->get();
            return $query->getResultArray();
        } else {
            if (is_numeric($filter)) {
                $builder->where('s.user_id=' . $filter);
                $query = $builder->get();
                return $query->getRowArray();
            } else {
                $builder->where($filter);
                $query = $builder->get();
                return $query->getResultArray();
            }
        }
    }
    /*
     public function get_by_uname_email($uname_email = FALSE) {
         $builder=$this->db->table('users');
         $uname_email1 = $uname_email ? $uname_email : $this->request->getVar('uname_email');
        $builder->where("status", 1);
        $builder->where("username", $uname_email1);
        $builder->or_where("email", $uname_email1);
        $builder->or_where("email2", $uname_email1);
        $query = $builder->get();
        return (isset($query))?$query->getRowArray():"";
    }
  */
    /**
     * This method updates staff data in the database
     */
   /*  public function update_user() {
        $id = $this->request->getVar('user_id');
        $data = $this->request->getPost(NULL, FILTER_SANITIZE_SPECIAL_CHARS,FILTER_FLAG_ENCODE_HIGH);
       // Date Registered
        if (isset($data['date_registered']) && $data['date_registered'] != '') {
            $registration_date = explode('-', $data['date_registered'], 3);
            $data['date_registered'] = count($registration_date) === 3 ? ($registration_date[2] . "-" . $registration_date[1] . "-" . $registration_date[0]) : null;
        }

       // Date of Birth
        $date_of_birth = explode('-', $data['date_of_birth'], 3);
        $data['date_of_birth'] = count($date_of_birth) === 3 ? ($date_of_birth[2] . "-" . $date_of_birth[1] . "-" . $date_of_birth[0]) : null;

       // Unsetting the values
        unset($data['id'], $data['user_id'],$data['occupation'],$data['confirmpassword'],$data['password'],$data['spouse_name'],$data['subscription_plan_id'], $data['position_id'],$data['mobile_number']);
        $data['modified_by'] = $_SESSION['staff_id'];
        $builder->where('id', $id);
        $query = $builder->update('users', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function change_status() {

        $data = array(
            'status_id' => $this->request->getVar('status') !== NULL ? $this->request->getVar('status') : 0,
            'modified_by' => $_SESSION['user_id']
        );
        $builder->where('users.id', $this->request->getVar('user_id') !== NULL ? $this->request->getVar('user_id') : $_SESSION['user_id']);
        return $builder->update('users', $data);
    }

    public function delete($user_id) {
        $builder->where('id', $user_id);
        return $builder->delete('users');
    }

      public function check_user($email)
      {
      
     $builder=$this->db->table('users');
      $builder->select('*');
       $builder->where('users.email',$email);     
          if($query=$builder->get())
          {
              return $query->getRowArray();
          }
          else{
            return false;
          }
      }
      
      public function fetch_user_id($f_email,$f_code)
      {
     $builder=$this->db->table('users');
       $builder->select('*');
      $builder->where('F_EMAIL',$f_email);
      $builder->where('F_CODE',$f_code);

      if($query=$builder->get())
      {
          return $query->getRowArray();
      }
      else{
        return false;
      }      
      }
       
      public function check_user_approved($email)
      {
       
     $builder=$this->db->table('users');
     $builder->select('*');
       $builder->join('pathway','users.PATH_ID=pathway.PATH_ID','LEFT');
       $builder->join('registration','users.UNIQUE_ID=registration.UNIQUE_ID','LEFT');
       $builder->join('srb_registration','users.UNIQUE_ID=srb_registration.UNIQUE_ID','LEFT');
       $builder->where('users.email',$email);
       $builder->where('users.user_status','Active');
     
     

      if($query=$builder->get())
      {
          return $query->getRowArray();
      }
      else{
        return false;
      }
      
      }
      
      
      public function check_activate($f_email,$f_code)
      {
     $builder=$this->db->table('users');
       $builder->select('*');
       $builder->where('F_EMAIL',$f_email);
       $builder->where('F_CODE',$f_code);

      if($query=$builder->get())
      {
          return $query->getRowArray();
      }
      else{
        return false;
      }
      
      }
      
      
    public function update_user_table($Q_email,$data)
    {   
         
          $builder->where('email',$Q_email);
          return $builder->update('users',$data); 
         
    }
*/
    public function insert_session($data) {
      $builder=$this->db->table('session_log');
      $ss= $builder->insert($data);
        if($ss){
            return true;
        }else{
            return false;
        }
    } 
    public function update_session($id,$data) {
      
        if (is_numeric($id)) {
            $builder=$this->db->table('session_log');
            $builder->where('user_id', $id);
             if($builder->update($data)){
                 return true; 
             }else{
                return false;
             }
        } else {
            return false;
        }
    } 
}

