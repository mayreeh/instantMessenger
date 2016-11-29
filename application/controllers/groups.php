<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends CI_Controller {

	function __construct()
  {
      parent::__construct();
      if(empty($this->session->userdata('user_id'))){
         redirect(base_url() . 'index.php?login', 'refresh');
      }
  }


	public function index()
	{
    $this->load->template('groups');
	}


  public function group_add($param1='',$param2='')
  {
    if ($param1 == "create") {
      $data['groupname'] = $this->input->post('groupname');
      $data['account_id'] = $this->session->userdata('user_id');
      $this->db->insert('groups' , $data);
      $this->session->set_flashdata('message' , 'Data_added_Successfully');
      redirect(base_url() . 'index.php?groups/', 'refresh');
    }
    if ($param1 == 'edit') {
        $this->db->where('group_id', $param2);
        $this->db->update('groups',$data);
        $this->session->set_flashdata('flash_message' , 'data_deleted');
        redirect(base_url() . 'index.php?groups/', 'refresh');
    }
    if ($param1 == 'delete') {
        $this->db->where('group_id', $param2);
        $this->db->delete('groups');
        $this->session->set_flashdata('flash_message' , 'data_deleted');
        redirect(base_url() . 'index.php?groups/', 'refresh');
    }
    $this->load->template('groups');
  }


//MANAGE SENDING GROUP MESSAGE
public function sms_group($param1 = '', $param2 = '')
	{
		if ($param1 == 'send_sms')
		{
			$contacts =	$this->contactlistmodel->getContactsByGroup($this->input->post('group_id'));
			$message = $this->input->post('message');
			 if ($contacts !== "") {
				 foreach ($contacts as $row) {
					  $messages = "Dear ". $row['names'] . $message;
						$phone = $this->smsmodel->standardizePhoneNumber($row['phonenumber']);
				 		$results = $this->smsmodel->send_sms($messages , $phone);
				 }
				 	redirect(base_url() . 'index.php?groups/sms_group/', 'refresh');
				}
		}
		$this->load->template('sms_group');
	}

}
