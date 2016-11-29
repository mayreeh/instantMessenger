<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Send Message From Contact List </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Superadmin</a></li>
        <li class="active">Send Sms</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- general form elements -->
        <div class="box box-primary" >
          <div class="box-header with-border">
            <h3 class="box-title">Send Message</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form">
            <div class="box-body">
              <div class="form-group">
                <label for="fullname">Phone Number(s)</label>
                <p class="text-primary">
                  (To add Multiple Numbers add the phonenumber and click Enter or comma(,) to allow multiple adding)
                  </p>
                <input type="text" class="form-control" data-role="tagsinput"  id="ms1" name="phonenumber" placeholder="Enter AT Username">
             </div>
              <div class="form-group">
                <label for="Apikey">Message</label>
                <p class="text-primary">(1 Message has 160 characters)</p>
                <textarea class="form-control" name="message" id="message"></textarea>
                <h6 class="pull-right" id="count_message"></h6>
              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Send Message</button>
            </div>
          </form>
        </div>
      </section>
    </div>
