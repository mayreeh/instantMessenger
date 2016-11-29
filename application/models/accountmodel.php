<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accountmodel extends CI_Model{
  function __construct() {
		parent::__construct();
}

//MANAGE ADIMIN USERS
public function getUsers()
{
  $query = $this->db->get('account');
  return $query->result_array();
}
public function getUserById($id)
{
  $query = $this->db->get_where('account' , array('account_id' => $id));
  return $query->result_array();
}
//mini account
public function getMiniUserById($id)
{
  $query = $this->db->get_where('mini_account' , array('mini_account_id' => $id));
  return $query->result_array();
}

public function getMiniUsersById()
{
  $query = $this->db->get_where('mini_account' , array('account_id' => $this->session->userdata('user_id')));
  return $query->result_array();
}

public function getUserByPasswordId($password)
{
  $query = $this->db->get_where('account' , array('account_id' => $this->session->userdata('user_id') , 'password' => sha1($password)));
  return $query->result_array();
}

}
