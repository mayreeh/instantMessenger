<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Send Group Message</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Group Message</a></li>
        <li class="active">Send Sms</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
     <section class="col-lg-7 connectedSortable">
      <!-- general form elements -->
        <div class="box box-primary" >
          <div class="box-header with-border">
            <h3 class="box-title">Send Message</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" id="smsGroup-form">
            <div class="box-body">
              <div class="form-group">
                <label for="fullname">Select Group</label>
                <select name="group_id" class="form-control" onchange="get_group_contacts(this.value)" required>
                  <?php foreach($this->groupmodel->getGroups() as $row):?>
                    <option value="<?php echo $row['group_id']; ?>"><?php echo $row['groupname']; ?></option>
                 <?php endforeach;?>
                </select>
             </div>
              <div class="form-group">
                <label for="Apikey">Message</label>
                <p class="text-primary">(1 Message has 160 characters)</p>
                <br>
                <p class="text-primary">Dear [names]</p>
                <textarea class="form-control" name="message" id="message"></textarea>
                <h6 class="pull-right" id="count_message"></h6>
              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-primary" id="smsGroup-submit">Send Message</button>
            </div>
          </form>
        </div>
</section>
<!--left Colum-->
<section class="col-lg-5 connectedSortable">
<div class="box box-primary ">
<div class="box-header with-border">  <h4>Group ContactList</h4> </div>
    <div class="box-body border-radius-none">

        <div class="box box-success">
          <div id="contactlist_holder"></div>
        </div>
		</div>
    <!-- /.box-body -->
  </div>
<!-- /.box -->
</section>
<!-- /.left Colum-->
</div>
</section>
</div>
