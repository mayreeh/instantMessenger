<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {


  function __construct()
  {
      parent::__construct();
  }

	public function index()
	{
    if(empty($this->session->userdata('user_id'))){
      $this->load->view('login');
    } else {
        $this->load->template('page');
    }

	}

public function login_ajax() {
         $response = array();

         //Recieving post input of email, password from ajax request
        // $email = $_POST["email"];
         $username = $_POST["username"];
         $password = sha1($_POST["password"]);
         $response['submitted_data'] = $_POST;

         //Validating login
         $login_status = $this->validate_login($username, $password);
         $response['login_status'] = $login_status;
         if ($login_status == 'success') {
             $response['redirect_url'] = '';
             if ($this->session->userdata('admin_login') == 1)
                 redirect(base_url() . 'index.php?superadmin/', 'refresh');

             if ($this->session->userdata('account_login') == 1)
                 redirect(base_url() . 'index.php?home/', 'refresh');
         }

         //Replying ajax request with validation response
        $r =     json_encode($response['login_status']);
        $this->session->set_flashdata('message', $r);


     }

  //Validating login
  public function validate_login($username = '', $password = '') {
    $credential = array('username' => $username, 'password' => $password);
  // Checking login credential for admin
    $query = $this->db->get_where('admin', $credential);
    if ($query->num_rows() > 0) {
        $row = $query->row();
        $this->session->set_userdata('admin_login', '1');
        $this->session->set_userdata('admin_id', $row->admin_id);
        $this->session->set_userdata('login_user_id', $row->admin_id);
        $this->session->set_userdata('name', $row->fullname);
        $this->session->set_userdata('username', $row->username);
        $this->session->set_userdata('email', $row->email);
      $this->session->set_userdata('login_type', 'admin');
        return 'success';
    }

    // Checking login credential for users
    $query = $this->db->get_where('account', $credential);
    if ($query->num_rows() > 0) {
        $row = $query->row();
        $this->session->set_userdata('account_login', '1');
        $this->session->set_userdata('user_id', $row->account_id);
        $this->session->set_userdata('login_user_id', $row->account_id);
        $this->session->set_userdata('name', $row->fullname);
        $this->session->set_userdata('username', $row->username);
        $this->session->set_userdata('country', $row->country);
        $this->session->set_userdata('level', $row->level);
        $this->session->set_userdata('email', $row->email);
        $this->session->set_userdata('login_type', 'account');
        return 'success';
    }
    return 'invalid';
  }

  /*     * *****CREATE ACCOUNT  FUNCTION ****** */
  function create_account()
  {
    $data['fullname']     = $this->input->post('fullname');
    $data['username']     = $this->input->post('username');
    $data['email']       = $this->input->post('email');
    $data['country']       = $this->input->post('country');
    $data['password']    = sha1($this->input->post('password'));
    $username_check = $this->db->get_where('account', array('username' => $this->input->post('username')))->result_array();
    $email_check = $this->db->get_where('account', array('email' => $this->input->post('email')))->result_array();
    if (!empty($email_check)) {
      $this->session->set_flashdata('message', 'Email Already registered');
      redirect(base_url() . 'index.php?login/', 'refresh');
      }
    if (!empty($username_check)) {
      $this->session->set_flashdata('message', 'Username Taken , Kindly choose another username');
      redirect(base_url() . 'index.php?login/', 'refresh');
    }
    if (empty($username_check) && empty($email_check)) {
    $this->db->insert('account', $data);
    $id = $this->db->insert_id();
    $this->db->insert('sms_settings', array('account_id'=>$id,'username'=>'instantmessenger','apikey'=> 'e5c4e81261b1e3e88b6913118168f91411c7f2008ba2453c5d8d084c3988b75f'));
    $query = $this->db->get_where('account', array('account_id' => $id));
      if ($query->num_rows() > 0) {
          $row = $query->row();
          $this->session->set_userdata('account_login', '1');
          $this->session->set_userdata('user_id', $row->account_id);
          $this->session->set_userdata('login_user_id', $row->account_id);
          $this->session->set_userdata('name', $row->fullname);
          $this->session->set_userdata('username', $row->username);
          $this->session->set_userdata('country', $row->country);
          $this->session->set_userdata('level', $row->level);
          $this->session->set_userdata('email', $row->email);
          $this->session->set_userdata('login_type', 'account');
         redirect(base_url() . 'index.php?home/', 'refresh');
        } else{
          $this->session->set_flashdata('message', 'Try Again');
          redirect(base_url() . 'index.php?login/', 'refresh');
        }
      } else {
        $this->session->set_flashdata('message', 'Email or Username Already Exists');
        redirect(base_url() . 'index.php?login/', 'refresh');
      }

  }

/** *****LOGOUT FUNCTION ****** */
function logout() {
   $user_data = $this->session->all_userdata();
     foreach ($user_data as $key => $value) {
         if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
             $this->session->unset_userdata($key);
         }
     }
     $this->session->sess_destroy();
     $this->session->set_flashdata('logout_notification', 'logged_out');
     redirect(base_url(), 'refresh');
 }

 public function changePassword()
 {
 	$checkUser = $this->accountmodel->getUserByPasswordId($this->input->post('oldpassword'));
 	if (!empty($checkUser)) {
 		$this->db->where('account_id', $this->session->userdata('user_id') );
 		$q = $this->db->update('account', array('password' => sha1($this->input->post('password'))));
 			if ($q) {
 			 	echo "Password Successfully Changed";
 				} else {
 					"Sorry Try again";
 				}
 	} else {
 		echo "Wrong Password";
 	}
}


}
