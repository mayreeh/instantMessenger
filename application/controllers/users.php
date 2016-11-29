<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

  function __construct()
  {
      parent::__construct();
      if(empty($this->session->userdata('user_id'))){
         redirect(base_url() . 'index.php?login', 'refresh');
      }
  }


public function index()
{
  $this->load->template('users');
}


//MANAGE USER ACCOUNTS
public function users_accounts($param1 ='',$param2='',$param3='')
	{
		$data['fullname']        = $this->input->post('fullname');
		$data['username']       = $this->input->post('username');
		$data['email']       = $this->input->post('email');
		$data['password']    = sha1($this->input->post('password'));
    $data['country']     = $this->input->post('country');
		$data['level'] = 0;
		//update account

		$dataacc['fullname']     = $this->input->post('fullname');
		$dataacc['username']     = $this->input->post('username');
		$dataacc['email']       = $this->input->post('email');
    $dataacc['country']     = $this->input->post('country');
		$dataacc['password']    = sha1($this->input->post('password'));
		$dataacc['account_id']    = $this->session->userdata('user_id');
		if ($param1 == 'create' && $this->input->post('account_id') == '') {
      $username_check = $this->db->get_where('account', array('username' => $this->input->post('username')))->result_array();
      $email_check = $this->db->get_where('account', array('email' => $this->input->post('email')))->result_array();
      if (!empty($email_check)) {
        $this->session->set_flashdata('message', 'Email Already registered');
        redirect(base_url() . 'index.php?users/users_accounts/', 'refresh');
        }
      if (!empty($username_check)) {
        $this->session->set_flashdata('message', 'Username Taken , Kindly choose another username');
        redirect(base_url() . 'index.php?users/users_accounts/', 'refresh');
      }
      if (empty($username_check) && empty($email_check)) {
  			$this->db->insert('mini_account', $dataacc);
  			$this->db->insert('account', $data);
  		  //$this->load->emailmodel->account_opening_email('adminuser', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
  			$this->session->set_flashdata('message' , 'Data_added_successfully');
        redirect(base_url() . 'index.php?users/users_accounts/', 'refresh');
        } else {
          $this->session->set_flashdata('message', 'Email or Username Already Exists');
          redirect(base_url() . 'index.php?login/', 'refresh');
        }
	 }
	 if($param1 == 'create' && $this->input->post('account_id') !== '' && $this->input->post('mini_account') !== '')
	 {
     if (!empty($email_check)) {
       $this->session->set_flashdata('message', 'Email Already registered');
       redirect(base_url() . 'index.php?users/users_accounts/', 'refresh');
       }
     if (!empty($username_check)) {
       $this->session->set_flashdata('message', 'Username Taken , Kindly choose another username');
       redirect(base_url() . 'index.php?users/users_accounts/', 'refresh');
     }
       if (empty($username_check) && empty($email_check)) {
      		 $this->db->where('account_id', $this->input->post('account_id'));
        	 $this->db->update('account' , $data);

      		 $this->db->where('mini_account_id', $this->input->post('mini_account_id'));
        	 $this->db->update('mini_account' , $dataacc);
      		 $this->session->set_flashdata('message' , 'Data_added_Updated');
          redirect(base_url() . 'index.php?users/users_accounts/', 'refresh');
          } else {
          $this->session->set_flashdata('message', 'Email or Username Already Exists');
          redirect(base_url() . 'index.php?login/', 'refresh');
          }
	 }
	 if ($param1 == 'delete') {
			$this->db->where('mini_account_id', $param2);
		  $this->db->delete('mini_account');
			$this->db->where('account_id', $param3);
			$this->db->delete('account');
			 $this->session->set_flashdata('flash_message' , 'data_deleted');
       redirect(base_url() . 'index.php?users/users_accounts/', 'refresh');
		 }
		$this->load->template('users');
}


public function getAccountUserById($id)
{
	foreach ($this->accountmodel->getMiniUserById($id) as $users) {
					echo json_encode(array('success' => true,
					    'account_id' => $users['account_id'],
							'mini_account_id' => $users['mini_account_id'],
							'fullname' => $users['fullname'],
							'email' => $users['email'],
							'username' => $users['username'],
							"password" =>  sha1($users['password'])
					));
			}
}




}
