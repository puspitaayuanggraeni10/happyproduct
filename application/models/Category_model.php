<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {
  public function all(){
    return $this->db->order_by('name','ASC')->get('categories')->result();
  }
}
