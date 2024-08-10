<?php

namespace App\Models;

use CodeIgniter\Model;

class DistrictModel extends Model
{
    protected $table            = 'district';
    protected $primaryKey       = 'id';
    protected $request;
    protected $db;

    public function __construct(){
        $this->request=\Config\Services::request();
        $this->db=\Config\Database::connect();
    }
    public function getDistrict($filter = FALSE) {
        $builder= $this->db->table('district d');
        $builder->select('d.id,district_name,d.status_id,status_name');         
        $builder->join('status st', 'st.id=d.status_id', 'left');
        if ($filter === FALSE) {
            $query = $builder->get();
            return $query->getResultArray();
        } else {
            if (is_numeric($filter)) {
              $builder->where('district.id=' . $filter);
                $query = $builder->get();
                return $query->getRowArray();
            } else {
              $builder->where($filter);
                $query = $builder->get();
                return $query->getResultArray();
            }
        }
    }

    public function setDistrict() {
        $data = $this->request->getPost(NULL, FILTER_SANITIZE_SPECIAL_CHARS,FILTER_FLAG_ENCODE_HIGH);
        unset($data['id']);
        $data['status_id'] = '1';
        $data['created_by'] = $_SESSION['id'];
        $builder= $this->db->table('district');
        $query=$builder->insert($data);
        return $query;
    }

    public function updateDistrict() {
        $id=$this->request->getPost('id');
        $data = $this->request->getPost(NULL, FILTER_SANITIZE_SPECIAL_CHARS,FILTER_FLAG_ENCODE_HIGH);
        unset($data['id']);
        $data['status_id'] = '1';
        $data['modified_by'] = $_SESSION['id'];
        $builder= $this->db->table('district');
        $builder->where('id', $this->request->getPost('id'));
          $query = $builder->update($data);
          return $query;
    }

    public function change_status($id = false) {
        $data = array('status_id' =>$this->request->getPost('status_id'));
        $builder= $this->db->table('district');
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
        $builder= $this->db->table('district d');
          $builder->where('id', $id);
            $query = $builder->update($data);
            if ($query) {
                return true;
            } else {
                return false;
            }
    }
}
