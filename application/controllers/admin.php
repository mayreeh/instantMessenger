<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
  {
      parent::__construct();
      if(empty($this->session->userdata('user_id'))){
         redirect(base_url() . 'index.php?login', 'refresh');
      }
  }


	public function index()
	{
		$this->load->template('welcome_message');
	}
//MANAGE ADMIN USERS//
	public function users($param1 ='',$param2="")
	{
		$data['fullname']        = $this->input->post('fullname');
		$data['username']       = $this->input->post('username');
		$data['email']       = $this->input->post('email');
		$data['password']    = sha1($this->input->post('password'));
		if ($param1 == 'create') {
			$this->db->insert('admin', $data);
			$this->session->set_flashdata('message' , 'Data_added_successfully');
	 }
	 if($this->input->post('user_id') !== '')
	 {
		 $this->db->where('user_id', $this->input->post('user_id'));
  	 $this->db->update('admin' , $data);
		 $this->session->set_flashdata('message' , 'Data_added_Updated');
	 }
	 if ($param1 == 'delete') {
			 $this->db->where('user_id', $param2);
			 $this->db->delete('admin');
			 $this->session->set_flashdata('flash_message' , 'data_deleted');
		 }
		$this->load->template('admin/admin_users');
	}

public function getUserById($id)
{
	foreach ($this->adminmodel->getUserById($id) as $users) {
					echo json_encode(array('success' => true,
					    'user_id' => $users['user_id'],
							'fullname' => $users['fullname'],
							'email' => $users['email'],
							'username' => $users['username'],
							"password" =>  sha1($users['password'])
					));
			}
}

//MANAGE USER ACCOUNTS
public function users_accounts($param1 ='',$param2='')
	{
		$data['fullname']        = $this->input->post('fullname');
		$data['username']       = $this->input->post('username');
		$data['email']       = $this->input->post('email');
		$data['password']    = sha1($this->input->post('password'));
		if ($param1 == 'create' && $this->input->post('account_id') == '') {
			$this->db->insert('account', $data);
					$account_id = $this->db->insert_id();
					$transact_data['code'] = "FREE";
					$transact_data['amount'] = 5;
					$transact_data['account_id'] = $account_id;
					$this->db->insert('sms_transactions', $transact_data);
				$this->load->emailmodel->account_opening_email('adminuser', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
			$this->session->set_flashdata('message' , 'Data_added_successfully');
	 }
	 if($param1 == 'create' && $this->input->post('account_id') !== '')
	 {
		 $this->db->where('account_id', $this->input->post('account_id'));
  	 $this->db->update('account' , $data);
		 $this->session->set_flashdata('message' , 'Data_added_Updated');
	 }
	 if ($param1 == 'delete') {
			 $this->db->where('account_id', $param2);
			 $this->db->delete('account');
			 $this->session->set_flashdata('flash_message' , 'data_deleted');
		 }
		$this->load->template('admin/user_accounts');
}

public function getAccountUserById($id)
{
	foreach ($this->accountmodel->getUserById($id) as $users) {
					echo json_encode(array('success' => true,
					    'account_id' => $users['account_id'],
							'fullname' => $users['fullname'],
							'email' => $users['email'],
							'username' => $users['username'],
							"password" =>  sha1($users['password'])
					));
			}
}

//MANAGE SMS  SETTINGS
public function sms()
	{
		$this->load->template('admin/sms_settings');
	}

//Africastalking
public function sms_AT($param1 = '' , $param2 = '')
	{
		if ($param1 == 'create') {
			$data['username']   = $this->input->post('username');
		  $data['apikey']       = $this->input->post('apikey');
			$data['account_id'] = $this->session->userdata('user_id');
			$check_sms = $this->db->get_where('sms_settings',array('account_id'=> $this->session->userdata('user_id')))->result_array();
				if (empty($check_sms)) {
					$this->db->insert('sms_settings',$data);
					$this->session->set_flashdata('flash_message' , 'data_saved');
					redirect(base_url() . 'index.php?admin/sms_AT', 'refresh');
				}  else {
					$dataAT['username']   = $this->input->post('AfricasTalking_username');
					$dataAT['apikey']       = $this->input->post('AfricasTalking_api_id');
					$this->db->where('account_id' , $this->session->userdata('user_id'));
					$this->db->update('sms_settings',$dataAT);
					$this->session->set_flashdata('flash_message' , 'data_updated');
					redirect(base_url() . 'index.php?admin/sms_AT', 'refresh');
				}
			$this->session->set_flashdata('flash_message' , 'Invalid');
	 	redirect(base_url() . 'index.php?admin/sms_AT', 'refresh');
		}
		if ($param1 == 'active_service') {
			$check_sms = $this->db->get_where('sms_settings',array('account_id'=> $this->session->userdata('user_id')))->result_array();
			if (!empty($check_sms)) {
				$data_active['active'] = $this->input->post('active_sms_service');
				$this->db->where('account_id' , $this->session->userdata('user_id'));
				$this->db->update('sms_settings',$data_active);
				$this->session->set_flashdata('flash_message' , 'Updated Successfully');
			redirect(base_url() . 'index.php?admin/sms_AT', 'refresh');
			}
			$this->session->set_flashdata('flash_message' , 'Invalid');
		 redirect(base_url() . 'index.php?admin/sms_AT', 'refresh');
		}
		$this->load->template('admin/AT_sms_settings');
	}

//MANAGE SMS SETTINGS
/*****SMS SETTINGS*********/
public function sms_settings($param1 = '' , $param2 = '')
    {
        //if ($this->session->userdata('admin_login') != 1)
         	//redirect(base_url() . 'index.php?admin/sms', 'refresh');
        if ($param1 == 'clickatell') {

            $data['description'] = $this->input->post('clickatell_user');
            $this->db->where('type' , 'clickatell_user');
            $this->db->update('system_settings' , $data);

            $data['description'] = $this->input->post('clickatell_password');
            $this->db->where('type' , 'clickatell_password');
            $this->db->update('system_settings' , $data);

            $data['description'] = $this->input->post('clickatell_api_id');
            $this->db->where('type' , 'clickatell_api_id');
            $this->db->update('system_settings' , $data);

            $this->session->set_flashdata('flash_message' , 'data_updated');
              redirect(base_url() . 'index.php?admin/sms', 'refresh');
        }

        if ($param1 == 'twilio') {

            $data['description'] = $this->input->post('twilio_account_sid');
            $this->db->where('type' , 'twilio_account_sid');
            $this->db->update('system_settings' , $data);

            $data['description'] = $this->input->post('twilio_auth_token');
            $this->db->where('type' , 'twilio_auth_token');
            $this->db->update('system_settings' , $data);

            $data['description'] = $this->input->post('twilio_sender_phone_number');
            $this->db->where('type' , 'twilio_sender_phone_number');
            $this->db->update('system_settings' , $data);

            $this->session->set_flashdata('flash_message' , 'data_updated');
              redirect(base_url() . 'index.php?admin/sms', 'refresh');
        }
        if ($param1 == 'AT') {
            $data['description'] = $this->input->post('AfricasTalking_username');
            $this->db->where('type' , 'AfricasTalking_username');
            $this->db->update('system_settings' , $data);


            $data['description'] = $this->input->post('AfricasTalking_api_id');
            $this->db->where('type' , 'AfricasTalking_api_id');
            $this->db->update('system_settings' , $data);

            $this->session->set_flashdata('flash_message' , 'data_updated');
         redirect(base_url() . 'index.php?admin/sms', 'refresh');
        }

        if ($param1 == 'active_service') {

            $data['description'] = $this->input->post('active_sms_service');
            $this->db->where('type' , 'active_sms_service');
            $this->db->update('system_settings' , $data);

            $this->session->set_flashdata('flash_message' , 'data_updated');
            redirect(base_url() . 'index.php?admin/sms', 'refresh');
        }

        $page_data['page_name']  = 'sms_settings';
        $page_data['page_title'] = 'sms_settings';
        $page_data['settings']   = $this->db->get('system_settings')->result_array();
       $this->load->template('admin/sms_settings', $page_data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
