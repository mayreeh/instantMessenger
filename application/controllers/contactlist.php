<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contactlist extends CI_Controller {

	function __construct()
  {
      parent::__construct();
      if(empty($this->session->userdata('user_id'))){
         redirect(base_url() . 'index.php?login', 'refresh');
      }
  }


	public function index()
	{
    $this->load->template('contactlist');
	}


public function contactlist_add($param1='',$param2='')
{
  if ($param1 == "create") {
    $group_id = $this->input->post('group_id');
    $account_id = 1;
    $phonenumber = $this->input->post('phonenumber');
    $names = $this->input->post('names');

     $contact_entries = sizeof($names);
     for($i = 0; $i < $contact_entries; $i++) {
       $data['group_id'] = $group_id;
       $data['account_id'] = 1;
       $data['phonenumber'] = $phonenumber[$i];
       $data['names'] = $names[$i];

       if($data['phonenumber'] == '' || $data['names'] == '' || $data['group_id'] == '')
             continue;
          $this->db->insert('contactlist' , $data);
      }
  $this->session->set_flashdata('message' , 'Data_added_Successfully');
  }
  if ($param1 == 'delete') {
      $this->db->where('user_id', $param2);
      $this->db->delete('admin');
      $this->session->set_flashdata('flash_message' , 'data_deleted');
    }
  $page_data['page_heading']  = 'Contact List';
  $this->load->template('contactlist', $page_data);
}

public function contact_groups($param1='',$param2='')
{
  if ($param1 == "create") {
    $data['groupname'] = $this->input->post('groupname');
    $this->db->insert('groups' , $data);
    $this->session->set_flashdata('message' , 'Data_added_Successfully');
  }
  if ($param1 == 'edit') {
      $this->db->where('group_id', $param2);
      $this->db->update('groups',$data);
      $this->session->set_flashdata('flash_message' , 'data_deleted');
  }
  if ($param1 == 'delete') {
      $this->db->where('group_id', $param2);
      $this->db->delete('groups');
      $this->session->set_flashdata('flash_message' , 'data_deleted');
  }
  $page_data['page_heading']  = 'Contact List';
  $this->load->template('contactlist', $page_data);
}

public function get_group_contacts($group_id)
 {
   $sections = $this->db->get_where('contactlist' , array(
       'group_id' => $group_id
   ))->result_array();
   if ($sections !== '') {
     echo "<h5>Contacts In Address Book</h5>";
       $i = 1; foreach ($sections as $row) {
           echo '<p>' .$i++ . ' : ' . $row['names'] . ' - ' . $row['phonenumber'] . '</p>';
       }
   } else {
     echo "No Contact Saved within the group selected";
   }

 }



}
