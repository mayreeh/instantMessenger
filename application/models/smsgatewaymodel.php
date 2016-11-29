<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Smsgatewaymodel extends CI_Model{
  function __construct() {
		parent::__construct();
}

//MANAGE AfricasTalking Gateway
public function getATApi()
{
  $query = $this->db->get_where('sms_settings',array('provider' => "AT"));
  return $query->result_array();
}
public function getUserById($user_id)
{
  $query = $this->db->get_where('admin' , array('user_id' => $user_id));
  return $query->result_array();
}

}
