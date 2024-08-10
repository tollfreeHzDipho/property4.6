<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactModel extends Model
{
  protected $table = 'contact';
  protected $primaryKey = 'id';
  public $db;
  public $request;

  function __construct()
  {

    $this->db = \Config\Database::connect();
    $this->request = \Config\Services::request();
  }

  public function getContact($user_id = false)
  {
    $builder =  $this->db->table('contact');
    $builder->where('user_id', $user_id);
    $builder->select('contact.*, contact_type');
    $builder->join('contact_type', "contact_type_id=contact_type.id");
    $query =  $builder->get();
    return (isset($query)) ? $query->getResultArray() : "";
  }

  // contact_type dropdown         
  public  function  get_contact_type($filter = FALSE)
  {
    $builder =  $this->db->table('contact_type');
    $builder->select('*');
    $q =  $builder->get();
    $response = $q->getResultArray();
    return $response;
  }

  #user_id, mobile_number, contact_type_id, date_created, date_modified, created_by, modified_by
  public function add_contact($user_id = false)
  {
    if ($user_id == false) {
      $user_id = $this->request->getPost('user_id');
      $contact_type_id = $this->request->getPost('contact_type_id');
    } else {
      $contact_type_id = 1;
    }
    $data = array(
      'user_id' => $user_id,
      'mobile_number' => $this->request->getPost('mobile_number'),
      'contact_type_id' => $contact_type_id,
      'date_created' => time(),
      'modified_by' => $_SESSION['id']
    );
    $builder =  $this->db->table('contact');
    $query = $builder->insert($data);
    return  $query;
  }

  public function validate_contact($mobile_number)
  {
    $user_id = $this->request->getPost('user_id');
    $id = $this->request->getPost('id');
    $mobile_number1 = substr($mobile_number, -9);
    $builder =  $this->db->table('contact');
    if ($id === NULL || empty($id)) {
      $query_result =  $builder
        ->limit(1)
        ->like('mobile_number', $mobile_number1, 'before')
        ->get();
      return (isset($query_result)) ? TRUE : FALSE;
    } else {
      $query_result =  $builder
        ->limit(1)
        ->where('user_id=', $user_id)
        ->like('mobile_number', $mobile_number1, 'before')
        ->get();
      return (isset($query_result)) ? TRUE : FALSE;
    }
  }

  public function update_contact()
  {
    $data = array(
      'mobile_number' => $this->request->getPost('mobile_number'),
      'contact_type_id' => $this->request->getPost('contact_type_id'),
      'date_modified' => time(),
      'modified_by' => $_SESSION['id']
    );
    $builder =  $this->db->table('contact');
    $id = $this->request->getPost('id');
    $builder->where('id', $id);
    $query =  $builder->update($data);
    if ($query) {
      return true;
    } else {
      return false;
    }
  }

  public function delete_by_id()
  {
    $contact_id = $this->request->getPost('id');
    $builder =  $this->db->table('contact');
    $builder->where('id', $contact_id);
    $query =  $builder->delete();
    if ($query) {
      return true;
    } else {
      return false;
    }
  }
}
