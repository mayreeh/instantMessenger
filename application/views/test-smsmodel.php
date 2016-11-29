<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Smsmodel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //COMMON FUNCTION FOR SENDING SMS
    function send_sms($message = '' , $reciever_phone = '')
    {
      /*$active_sms_service = $this->db->get_where('system_settings' , array(
           'type' => 'active_sms_service', 'account_id' =>  $this->session->userdata('user_id')
       ))->row()->description;
       */
       if ($this->session->userdata('level') == 0) {
       	$account_id =  $this->db->get_where('mini_account' , array(
       							'username' => $this->session->userdata('username'),
       							'email' => $this->session->userdata('email'),
       						))->row()->account_id;
         $active_sms_service = $this->db->get_where('sms_settings' , array(
       		'account_id' => $account_id
       		))->row()->active;
       } else {
       	$active_sms_service = $this->db->get_where('sms_settings' , array(
       		'account_id' => $this->session->userdata('user_id')
       		))->row()->active;
       		$account_id = $this->session->userdata('user_id');
       }
        if ($active_sms_service == '' || $active_sms_service == 0)
            return;
        if ($active_sms_service == 'clickatell') {
            $this->send_sms_via_clickatell($message , $reciever_phone );
        }
        if ($active_sms_service == 'twilio') {
            $this->send_sms_via_twilio($message , $reciever_phone );
        }
        if ($active_sms_service == 1) {
            $this->send_sms_via_AT($reciever_phone,$message);
        }
    }

    // SEND SMS VIA CLICKATELL API
    function send_sms_via_clickatell($message = '' , $reciever_phone = '') {

        $clickatell_user       = $this->db->get_where('system_settings', array('type' => 'clickatell_user'))->row()->description;
        $clickatell_password   = $this->db->get_where('system_settings', array('type' => 'clickatell_password'))->row()->description;
        $clickatell_api_id     = $this->db->get_where('system_settings', array('type' => 'clickatell_api_id'))->row()->description;
        $clickatell_baseurl    = "http://api.clickatell.com";

        $text   = urlencode($message);
        $to     = $reciever_phone;

        // auth call
        $url = "$clickatell_baseurl/http/auth?user=$clickatell_user&password=$clickatell_password&api_id=$clickatell_api_id";

        // do auth call
        $ret = file($url);

        // explode our response. return string is on first line of the data returned
        $sess = explode(":",$ret[0]);
        print_r($sess);echo '<br>';
        if ($sess[0] == "OK") {

            $sess_id = trim($sess[1]); // remove any whitespace
            $url = "$clickatell_baseurl/http/sendmsg?session_id=$sess_id&to=$to&text=$text";

            // do sendmsg call
            $ret = file($url);
            $send = explode(":",$ret[0]);
            print_r($send);echo '<br>';
            if ($send[0] == "ID") {
                echo "successnmessage ID: ". $send[1];
            } else {
                echo "send message failed";
            }
        } else {
            echo "Authentication failure: ". $ret[0];
        }
    }


    // SEND SMS VIA TWILIO API
    function send_sms_via_twilio($message = '' , $reciever_phone = '') {

        // LOAD TWILIO LIBRARY
        require_once(APPPATH . 'libraries/twilio_library/Twilio.php');


        $account_sid    = $this->db->get_where('system_settings', array('type' => 'twilio_account_sid'))->row()->description;
        $auth_token     = $this->db->get_where('system_settings', array('type' => 'twilio_auth_token'))->row()->description;
        $client         = new Services_Twilio($account_sid, $auth_token);

        $client->account->messages->create(array(
            'To'        => $reciever_phone,
            'From'      => $this->db->get_where('system_settings', array('type' => 'twilio_sender_phone_number'))->row()->description,
            'Body'      => $message
        ));

    }

    // SEND SMS VIA TWILIO API
    function send_sms_via_AT($reciever_phone = '' , $message = '') {
      if ($this->session->userdata('level') == 0) {
      	$account_id =  $this->db->get_where('mini_account' , array(
      							'username' => $this->session->userdata('username'),
      							'email' => $this->session->userdata('email'),
      						))->row()->account_id;
        $active_sms_service = $this->db->get_where('sms_settings' , array(
      		'account_id' => $account_id
      		))->row()->active;
      } else {
      	$active_sms_service = $this->db->get_where('sms_settings' , array(
      		'account_id' => $this->session->userdata('user_id')
      		))->row()->active;
      		$account_id = $this->session->userdata('user_id');
      }

        $this->load->library('AfricasTalkingGateway');
          $username    = $this->db->get_where('sms_settings', array('account_id' => $account_id))->row()->username;
          $apikey     = $this->db->get_where('sms_settings', array('account_id' => $account_id))->row()->apikey;
        $gateway    = new AfricasTalkingGateway($username, $apikey);

        $recipients = $this->standardizePhoneNumber($reciever_phone);
        try
            {
              $results = $gateway->sendMessage($reciever_phone, $message);

              foreach($results as $result) {
                $data['phonenumber'] = $result->number;
                $data['message_id'] = $result->messageId;
                $data['detail'] = $result->messageId;
                $data['account_id'] = $this->session->userdata('user_id');
                $data['smsstatus'] = $result->status;
                $data['cost'] = $result->cost;
                $this->db->insert('sms_sent',$data);
                $id = $this->db->insert_id();
              //  echo $id;
              }
            }
            catch ( AfricasTalkingGatewayException $e )
            {
              echo "Encountered an error while sending: ".$e->getMessage();
            }
  }

   function standardizePhoneNumber($phoneNumber, $countryCode = "   254")
    {
        $length = strlen($countryCode);

        $return = "";

        if(strlen($phoneNumber) == 13 && substr($phoneNumber, 0, 3) == "+25")

            $return .= $phoneNumber;

        else if(strlen($phoneNumber) == 12 && substr($phoneNumber, 0, 3) == "254")

            $return .= "+". $phoneNumber;

        else if(strlen($phoneNumber) == 10 && substr($phoneNumber, 0, 2) == "07")

            $return .= "+254" . substr($phoneNumber, 1);

        else if(strlen($phoneNumber) == 9 && substr($phoneNumber, 0, 1) == "7")

            $return .= "+254" . $phoneNumber;

        else

            $return .= $phoneNumber;

        return $return;
    }

    public function count_sent_message()
    {
      if ($this->session->userdata('level') == 1) {
        $this->db->select('smsstatus , COUNT(smsstatus) as total');
        $this->db->from('sms_sent sm');
        $this->db->join('account a' , 'a.account_id = sm.account_id');
        $this->db->join('mini_account mn' , 'mn.email = a.email');
        $this->db->group_by('smsstatus');
        $this->db->where('mn.account_id' , $this->session->userdata('user_id'));
        $query = $this->db->get();
        return $query->result_array();

      } else {
        $this->db->select('smsstatus , COUNT(smsstatus) as total');
        $this->db->from('sms_sent');
        $this->db->group_by('smsstatus');
        $this->db->where('account_id' , $this->session->userdata('user_id'));
        $query = $this->db->get();
        return $query->result_array();
      }
    }

    public function count_sent_success_message()
    {
    if ($this->session->userdata('level') == 1) {
      $this->db->select('COUNT(smsstatus) as total');
      $this->db->from('sms_sent sm');
      $this->db->join('account a' , 'a.account_id = sm.account_id');
      $this->db->join('mini_account mn' , 'mn.email = a.email');
      $this->db->group_by('smsstatus');
      $this->db->where('mn.account_id' , $this->session->userdata('user_id'));
      $this->db->where('smsstatus' , "Success");
      $query = $this->db->get();
      return $query->result_array();

    }else {
      $this->db->select('COUNT(smsstatus) as total');
      $this->db->from('sms_sent');
      $this->db->group_by('smsstatus');
      $this->db->where('account_id' , $this->session->userdata('user_id'));
      $this->db->where('smsstatus' , "Success");
      $query = $this->db->get();
      return $query->result_array();
     }
    }

    public function count_sent_not_success_message()
    {
      if ($this->session->userdata('level') == 1) {
        $this->db->select('COUNT(smsstatus) as total');
        $this->db->from('sms_sent sm');
        $this->db->join('account a' , 'a.account_id = sm.account_id');
        $this->db->join('mini_account mn' , 'mn.email = a.email');
        $this->db->group_by('smsstatus');
        $this->db->where('mn.account_id' , $this->session->userdata('user_id'));
        $this->db->where('smsstatus != ', "Success");
        $query = $this->db->get();
        return $query->result_array();
      } else {
      $id = $this->session->userdata('user_id');
      $query = $this->db->query("select COUNT(smsstatus) as total
      from sms_sent where smsstatus != 'Success' and account_id = $id");
      return $query->result_array();
    }
    }

    public function get_sent_success_message()
    {
      if ($this->session->userdata('level') == 1) {
        $this->db->select('*');
        $this->db->from('sms_sent sm');
        $this->db->join('account a' , 'a.account_id = sm.account_id');
        $this->db->join('mini_account mn' , 'mn.email = a.email');
        $this->db->where('mn.account_id' , $this->session->userdata('user_id'));
        //$this->db->where('smsstatus', "Success");
        $query = $this->db->get();
        return $query->result_array();
      } else {
      $query = $this->db->get_where('sms_sent', array('account_id' => $this->session->userdata('user_id')));
      return $query->result_array();
     }
    }



}
?>

<!-- jQuery 2.2.3 -->
<script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<!-- bootstrap time picker -->
<script src="assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="assets/plugins/datepicker/bootstrap-datepicker.js"></script>

<!-- DataTables -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
<script src="assets/dist/js/taginput.js"></script>
