<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3 class="box-title">Send Single Message</h3>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Send Message</a></li>
        <li class="active">By Single Message</li>
      </ol>
    </section>
    <?php
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
    $balance = '';
    if ($active_sms_service == 1):
      $username    = $this->db->get_where('sms_settings', array('account_id' => $account_id))->row()->username;
      $apikey     = $this->db->get_where('sms_settings', array('account_id' =>$account_id))->row()->apikey;
        if ($username == '' || $apikey == '') {
          $balance = "SMS SETTINGS NOT CONFIGURED";
        } else {
          $this->load->library('AfricasTalkingGateway');
          $gateway    = new AfricasTalkingGateway($username, $apikey);
          $data = $gateway->getUserData();
          $balance = $data->balance;
        }
    endif;

     ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
     <!-- Left col -->
     <section class="col-lg-7 connectedSortable">
      <!-- general form elements -->
        <div class="box box-primary" >
          <div class="box-header with-border">
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" id="singleMessage-form" method="post" action="<?php echo base_url(); ?>index.php?home/single_message/send_sms">
            <div class="box-body">
              <!--<div class="form-group">
                <label for="fullname">From</label>
                  <input type="text" class="form-control" data-role="tagsinput"  id="from" name="from" placeholder="Enter From Who">
             </div>-->
              <div class="form-group">
                <label for="fullname">To <br>Phone Number(s)</label>
                <p class="text-primary">
                  (To add Multiple Numbers add the phonenumber and click Enter or comma(,) to allow multiple phone numbers)
                  </p>
                <input type="text" class="form-control" data-role="tagsinput"  id="ms1" name="phonenumber" placeholder="Enter PhoneNumber(s)" required>
             </div>
              <div class="form-group">
                <label for="Apikey">Message</label>
                <p class="text-primary">(1 Message has 160 characters)</p>
                <textarea class="form-control" name="message" id="message" required></textarea>
                <h6 class="pull-right" id="count_message"></h6>
              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-primary" id="singleMessage-submit">Send Message</button>
            </div>
          </form>
        </div>
      </section>
<section class="col-lg-5 connectedSortable">
  <div class="info-box bg-aqua">
  <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
  <div class="info-box-content">
       <span class="info-box-text">Account Balance</span>
       <span class="info-box-number"><?php echo $balance;  ?></span>
       <div class="progress">
         <div class="progress-bar" style="width: 50%"></div>
       </div>
           <span class="progress-description">
             Total Account Balance
           </span>
     </div>
  </div>
  </section>
   </div>
  </section>
  </div>
