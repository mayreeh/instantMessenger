<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3 class="box-title">Sent SMS</h3>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Message</a></li>
        <li class="active">Message(s) Sent</li>
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

$success_message = $this->smsmodel->count_sent_success_message();
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
$success_not_message = $this->smsmodel->count_sent_not_success_message();
 ?>
<!-- Main content -->
<section class="content">
<div class="row">
<!-- Left col -->
<section class="col-lg-8 connectedSortable">
<div class="box box-success">
<div class="box-header with-border"></div>
<form class="form-inline" method="post" action="<?php echo base_url()?>index.php?home/sent_message/search">
<!-- Date and time range -->
<div class="form-group">
  <label></label>
  <div class="input-group">
    <button type="button" class="btn btn-default pull-right" id="daterange-btn">
      <span>
        <i class="fa fa-calendar"></i> Search By Dates
      </span>
      <i class="fa fa-caret-down"></i>
      <input type="hidden" class="form-control pull-right" name="searchdate" id="dte">
    </button>
  </div>
</div>
<div class="form-group">
<div class="input-group">
  <button type="submit" class="btn btn-info" id="newGroups-submit">
    <i class="fa fa-calendar"></i> Search
    </button>
  </div>
</div>
</form>
<br><br>
<hr/>
<?php if (!empty($results)) {?>
<h4>My Sent SMS(es)</h4>
  <table id="example1" class="table table-bordered table-striped">
    <tr>
      <th>Sn</th>
      <th>Status</th>
      <th>Detail</th>
      <th>Date</th>
    </tr>
    <?php $i = 1; foreach ($results as $row) { ?>
      <tr>
        <td><?php echo $i++;  ?></td>
        <td><?php echo $row['smsstatus'] ?></td>
        <td><?php echo $row['detail'] ?></td>
        <td><?php echo $row['date'] ?></td>
      </tr>
      <?php } ?>
    </table>
<?php } else { ?>
  <h3> No Messages Sent Within The time Range </h3>
<?php } ?>
<br><br>
<hr/>
<?php if (!empty($results_admin)) {?>
  <h4>Sent SMS(es) By Other Users Under Account</h4>
  <table id="example1" class="table table-bordered table-striped">
    <tr>
      <th>Sn</th>
      <th>Status</th>
      <th>Detail</th>
      <th>Date</th>
      <th>Sent By-:</th>
    </tr>
    <?php $i = 1; foreach ($results_admin as $row) { ?>
      <tr>
        <td><?php echo $i++;  ?></td>
        <td><?php echo $row['smsstatus'] ?></td>
        <td><?php echo $row['detail'] ?></td>
        <td><?php echo $row['date'] ?></td>
        <td><?php echo $row['username'] ?></td>
      </tr>
      <?php } ?>
    </table>
<?php } ?>
</div>
</section>
<section class="col-lg-4 connectedSortable">
<div class="info-box bg-red">
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
<!-- /.info-box -->
<div class="info-box bg-yellow">
<span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
<div class="info-box-content">
     <span class="info-box-text">Delivered Messages</span>
     <span class="info-box-number"><?php  if (!empty($success_message)) {
       echo $success_message[0]['total'];
     } else { echo "0"; } ?></span>
     <div class="progress">
       <div class="progress-bar" style="width: 50%"></div>
     </div>
         <span class="progress-description">
           Total Messages Delivered
         </span>
   </div>
</div>
<!-- /.info-box -->
<div class="info-box bg-aqua">
<span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
<div class="info-box-content">
     <span class="info-box-text">Draft Messages</span>
     <span class="info-box-number"><?php  if (!empty($success_not_message)) {
       echo $success_not_message[0]['total'];
     } else { echo "0"; } ?></span>
     <div class="progress">
       <div class="progress-bar" style="width: 50%"></div>
     </div>
         <span class="progress-description">
           Total Messages Not Delivered
         </span>
   </div>
</div>
<!-- /.info-box -->
</section>
</div>
</section>
</div>
