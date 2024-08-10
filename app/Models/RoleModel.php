<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table            = 'roles';
    protected $primaryKey       = 'id';
    protected $request;
    protected $db;

    public function __construct(){
        $this->request=\Config\Services::request();
        $this->db=\Config\Database::connect();
    }

    public function getRoles($filter = FALSE) {  
        $builder=$this->db->table('roles r');
        $builder->select('r.id,role_name,description,r.status_id,status_name');
      
        $builder->join('status st', 'st.id=r.status_id', 'left');
        if ($filter === FALSE) {
            $query = $builder->get();
            return $query->getResultArray();
        } else {
            if (is_numeric($filter)) {
                $builder->where('roles.id=' . $filter);
                $query = $builder->get();
                return $query->getRowArray();
            } else {
                $builder->where($filter);
                $query = $builder->get();
                return $query->getResultArray();
            }
        }
    }

    public function setRoles() {
        $data = $this->request->getPost(NULL, FILTER_SANITIZE_SPECIAL_CHARS,FILTER_FLAG_ENCODE_HIGH);
        $builder=$this->db->table('roles');
        unset($data['id']);
        $data['status_id'] = '1';
        $data['firm_id'] = isset($_SESSION['firm_id'])?$_SESSION['firm_id']:1;
        $data['date_created'] = time();
        $data['created_by'] = $_SESSION['id'];
        $query =  $builder->insert($data);
         if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function updateRoles() {
        $id=$this->request->getPost('id');
        $data = $this->request->getPost(NULL, FILTER_SANITIZE_SPECIAL_CHARS,FILTER_FLAG_ENCODE_HIGH);
        unset($data['id']);
        $data['modified_by'] = $_SESSION['id'];
        $builder=$this->db->table('roles');
        $builder->where('id', $this->request->getPost('id'));
        return $builder->update($data);
    }
    public function change_status($id = false) {
        $data = array('status_id' =>$this->request->getPost('status_id'));        
        $builder=$this->db->table('roles');
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
        $builder=$this->db->table('roles');
            $builder->where('id', $id);
            $query = $builder->update($data);
            if ($query) {
                return true;
            } else {
                return false;
            }
    }

}
