<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sms extends CI_Controller {

	function __construct()
  {
      parent::__construct();
      if(empty($this->session->userdata('user_id'))){
         redirect(base_url() . 'index.php?login', 'refresh');
      }
  }

	public function index()
	{
    	$this->load->template('admin/sms_settings');
	}

//MANAGE SMS  SETTINGS
public function sms()
	{
		$this->load->template('admin/sms_settings');
	}

	//Africastalking
public function sms_AT_gateway()
	{
		$data['username']   = $this->input->post('username');
		$data['provider']    = "AT";
		$data['apikey']       = $this->input->post('apikey');
		/*if ($this->input->post('id') == '') {
			$this->db->insert('sms_settings', $data);
			$this->session->set_flashdata('message' , 'Data_added_successfully');
	 }*/
	 if($this->input->post('id') !== '')
	 {
		 $this->db->where('id', $this->input->post('id'));
		 $this->db->update('sms_settings' , $data);
		 $this->session->set_flashdata('message' , 'Data_added_Updated');
	 }
		$this->load->template('admin/sms');
	}

	//MANAGE SMS SETTINGS
	/*****SMS SETTINGS*********/
public function sms_settings($param1 = '' , $param2 = '')
    {
        //if ($this->session->userdata('accoun') != 1)
         	//redirect(base_url() . 'index.php?admin/sms', 'refresh');
        if ($param1 == 'clickatell') {

            $data['description'] = $this->input->post('clickatell_user');
            $this->db->where('type' , 'clickatell_user');
            $this->db->update('system_settings' , $data);


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
}
