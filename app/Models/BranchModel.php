<?php

namespace App\Models;

use CodeIgniter\Model;

class BranchModel extends Model
{
    protected $table            = 'branches';
    protected $primaryKey       = 'id';
    protected $request;
    protected $db;

    public function __construct(){
        $this->request=\Config\Services::request();
        $this->db=\Config\Database::connect();
    }
    public function getBranch($filter = FALSE) {
        $builder= $this->db->table('branches b');
        $builder->select('b.id,branch_name,branch_address,b.status_id,status_name');
        $builder->join('status st', 'st.id=b.status_id', 'left');
        if ($filter === FALSE) {
            $query = $builder->get();
            return (isset($query))?$query->getResultArray():"";
        } else {
            if (is_numeric($filter)) {
                $builder->where('branches.id=' . $filter);
                $query = $builder->get();
                return (isset($query))?$query->getRowArray():"";
            } else {
                $builder->where($filter);
                $query = $builder->get();
                return (isset($query))?$query->getResultArray():"";
            }
        }
    }

    public function setBranch() {
       
        $data = $this->request->getPost(NULL, FILTER_SANITIZE_SPECIAL_CHARS,FILTER_FLAG_ENCODE_HIGH);
        unset($data['id']);
        $data['status_id'] = '1';
        $data['firm_id'] = $_SESSION['firm_id'];
        $data['date_created'] = time();
        $data['created_by'] = $_SESSION['id'];
        $builder= $this->db->table('branches');
        $query = $builder->insert( $data);
        return $query;
    }

    public function updateBranch() {
        $id=$this->request->getPost('id');
        $data = $this->request->getPost(NULL, FILTER_SANITIZE_SPECIAL_CHARS,FILTER_FLAG_ENCODE_HIGH);
        unset($data['id']);
        $data['modified_by'] = $_SESSION['id'];
        $builder= $this->db->table('branches');
        $builder->where('id', $this->request->getPost('id'));
        return $builder->update($data);
        
    }

    public function change_status($id = false) {
        $data = array('status_id' =>$this->request->getPost('status_id'));
        $builder= $this->db->table('branches');
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
        $builder= $this->db->table('branches');
            $builder->where('id', $id);
            $query = $builder->update($data);
            if ($query) {
                return true;
            } else {
                return false;
            }
    }
}
