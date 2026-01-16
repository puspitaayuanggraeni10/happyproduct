<?php 
class User_model extends CI_Model {

  public function __construct(){
    parent::__construct();
  }

  var $table = 'user';
  var $tableModal = 'modal';
  public function find($filter=[]){
    $this->db->where($filter);    
    $query = $this->db->get($this->table);
    return $query->row();
  }

  public function check_login($username, $password)
  {
    return $this->db
      ->where('username', $username)
      ->where('password', md5($password))
      ->get($this->table)
      ->row();
  }

}