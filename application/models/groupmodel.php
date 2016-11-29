<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groupmodel extends CI_Model{
  function __construct() {
		parent::__construct();
}


public function getGroups()
{
  $query = $this->db->get_where('groups' , array('account_id' => $this->session->userdata('user_id') ));
  return $query->result_array();
}

public function getGroupById($id)
{
  $query = $this->db->get_where('groups' , array('group_id' => $id));
  return $query->result_array();
}


}
