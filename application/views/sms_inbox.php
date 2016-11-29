<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h3 class="box-title">Inbox</h3>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#"> Message</a></li>
      <li class="active">Inbox</li>
    </ol>
  </section>
<!-- Main content -->
<section class="content">
  <div class="box box-success">
    <div class="box-header with-border"></div>
    <?php echo $this->smsmodel->fetch_AT_sms(); ?>
    </div>
</section>

</div>
