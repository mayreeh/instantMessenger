<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminmodel extends CI_Model{
  function __construct() {
		parent::__construct();
}

//MANAGE ADIMIN USERS
public function getUsers()
{
  $query = $this->db->get('admin');
  return $query->result_array();
}
public function getUserById($user_id)
{
  $query = $this->db->get_where('admin' , array('user_id' => $user_id));
  return $query->result_array();
}

}
