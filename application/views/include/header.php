<body class="hold-transition skin-blue sidebar-mini">
<?php
$r = array();
foreach ($this->contactlistmodel->getContactsByAccount() as $row) {
	array_push($r , $row['phonenumber']);
}
$totallist = '';
foreach ($r as $key => $value) {
 $totallist = $totallist . ',' . $value;
}


$balance = '';
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
if ($active_sms_service == 1):
  $username    = $this->db->get_where('sms_settings', array('account_id' => $account_id))->row()->username;
  $apikey     = $this->db->get_where('sms_settings', array('account_id' => $account_id))->row()->apikey;
    if ($username == '' || $apikey == '') {
      $balance = "SMS SETTINGS NOT CONFIGURED - CONFIGURE AT SMS SETTINGS MENU";
    } else {
      $this->load->library('AfricasTalkingGateway');
      $gateway    = new AfricasTalkingGateway($username, $apikey);

      $data = $gateway->getUserData();
      $balance = $data->balance;
    }
endif;
?>
<script type="text/javascript">
var base_url = "<?php echo base_url(); ?>index.php?";
var contactlistPhones = "<?php echo $totallist;  ?>"
</script>
<!-- Site wrapper -->
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <?php
        $system_name	=	$this->db->get_where('system_settings' , array('type'=>'system_name'))->row()->description;
        $system_title	=	$this->db->get_where('system_settings' , array('type'=>'system_title'))->row()->description;
      ?>
      <span class="logo-lg"><b><?php echo $system_title ?></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li><span class="label label-warning"><?php echo "Balance : " .$balance; ?></span></li>
          <!-- Notifications: style can be found in dropdown.less -->


          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url(); ?>assets/dist/img/avatar-12.png" class="user-image" alt="">
              <span class="hidden-xs"><?php echo $this->session->userdata('username'); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p><?php echo $this->session->userdata('username'); ?>
                  <small><?php echo $this->session->userdata('fullname'); ?></small>
                </p>
              </li>
            <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                	<a href="#"class="btn btn-default btn-flat"  data-toggle="modal" data-target="#passwordModal">
											 <span>Change Password</span>
									 </a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url(); ?>index.php?login/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
					-->
        </ul>
      </div>
    </nav>
  </header>
	<!-- Change Password Form -->
      <div id="passwordModal" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Change Password</h4>
            </div>
            <div class="modal-body">
              <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                  <div class="x_content">
                    <br />
                    <form id="changePassword-form" data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Username
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name = "username" value="<?php echo $this->session->userdata('username'); ?>" readonly class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Old Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  name="oldpassword" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">New Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="password" placeholder="Password" id="password" onchange = "validatePassword()" name = "password" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="password" placeholder="Confirm Password" onkeyup = "validatePassword()" id="confirm_password" name = "confirm_password" required>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="reset" class="btn btn-primary">Reset</button>
                          <button type="submit" class="btn btn-success" id="changePassword-submit">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

<script>
var password = document.getElementById("password")
			, confirm_password = document.getElementById("confirm_password");

function validatePassword(){
			if(password.value != confirm_password.value) {
				confirm_password.setCustomValidity("Passwords Don't Match");
			} else {
				confirm_password.setCustomValidity('');
			}
		}
password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>
