<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filemodel extends CI_Model{
  function __construct() {
		parent::__construct();
}

//MANAGE ADIMIN USERS
public function getFiles()
{
  $query = $this->db->get_where('file' ,  array('account_id' => $this->session->userdata('user_id') ));
  return $query->result_array();
}


}
