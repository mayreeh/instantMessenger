<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Airtime extends CI_Controller {

	function __construct()
  {
      parent::__construct();
      if(empty($this->session->userdata('user_id'))){
         redirect(base_url() . 'index.php?login', 'refresh');
      }
  }

public function index($param1 = '')
{
  $this->load->template('airtime_send');
}

public function home($param1 = '')
{
  if ($param1 == 'send') {
    $phonenumber = $this->input->post('phonenumber');
    $amount = $this->input->post('amount');
     $contact_entries = sizeof($phonenumber);
     for($i = 0; $i < $contact_entries; $i++) {
       $data['phonenumber'] = 'KES '.$phonenumber[$i];
       $data['amount'] = $amount[$i];

       if($data['phonenumber'] == '' || $data['amount'] == '')
             continue;
          echo $this->smsmodel->send_airtime($data);
      }
    redirect(base_url() . 'index.php?airtime', 'refresh');
  }
 redirect(base_url() . 'index.php?airtime', 'refresh');
}

}
