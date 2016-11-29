<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contactlistmodel extends CI_Model{
  function __construct() {
		parent::__construct();
}


public function countContactsByGroups()
{
  $this->db->select('groupname , COUNT(phonenumber) as total');
	$this->db->from('contactlist c');
	$this->db->join('groups g' , 'c.group_id = g.group_id');
  $this->db->where('c.account_id',$this->session->userdata('user_id') );
	$this->db->group_by('groupname');
  $query = $this->db->get();
	return $query->result_array();
}


public function getContactsByGroup($group_id)
{
  $this->db->select('*');
	$this->db->from('contactlist c');
	$this->db->join('groups g' , 'c.group_id = g.group_id');
	$this->db->where('c.group_id',$group_id);
  $this->db->where('c.account_id',$this->session->userdata('user_id'));
  $query = $this->db->get();
	return $query->result_array();
}


public function getContactsByAccount()
{
  $this->db->select('*');
	$this->db->from('contactlist c');
	$this->db->join('groups g' , 'c.group_id = g.group_id');
  $this->db->where('c.account_id',$this->session->userdata('user_id'));
  $query = $this->db->get();
	return $query->result_array();
}


}
