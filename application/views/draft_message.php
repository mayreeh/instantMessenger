<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3 class="box-title">Draft Messages(Not Delivered)</h3>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Draft Messages</li>
      </ol>
    </section>

<!-- Main content -->
<section class="content">
  <section class="col-lg-7 connectedSortable">
     <!-- Left col -->
  <table id="example1" class="table table-bordered table-striped">
      <tr>
        <th>Sn</th>
        <th>Phone</th>
        <th>Message</th>
        <th>Status</th>
      </tr>
      <?php $i = 1; foreach ($this->smsmodel->get_sent_not_success_message() as $row) {?>
        <tr>
          <td><?php echo $i++; ?> </td>
          <td><?php echo $row['phonenumber']; ?></td>
          <td><?php echo $row['message_id']; ?></td>
          <td><?php echo $row['phonenumber']; ?></td>
          <td><?php echo $row['smsstatus']; ?></td>
        </tr>
      <?php } ?>
    </table>
    </section>
<section class="col-lg-5 connectedSortable">
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
</section>
</div>
