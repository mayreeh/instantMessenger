<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Send Message(s) From File </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Superadmin</a></li>
        <li class="active">Send Sms</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-success">
        <div class="box-header with-border">
          <!--modal -->
          <!-- Trigger the modal with a button -->
          <div class="" style="float:right">
              <button href="javascript:void"  class="btn btn-info btn-sm" onclick="window.location.href ='<?php echo base_url() ?>uploads/template/contacts-file-template.csv'">Download Template</button>
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Upload Excel File</button>
          </div>
        </div>
<table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Sn</th>
        <th>Description</th>
        <th>Filename</th>
        <th>Date Uploaded</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
        <?php $i = 1; foreach ($this->filemodel->getFiles() as $row) { ?>
          <tr>
                <td><?php echo $i++; ?> </td>
                <td><?php echo $row['description']  ?></td>
                <td><?php echo $row['filename']  ?></td>
                <td><?php echo $row['date']  ?></td>
                <td>
                <div class="btn-group">
                     <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                         Action <span class="caret"></span>
                     </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                      <li class="divider"></li>
                      <li><a href="#" class="viewFileContacts" data-id="<?php echo $row['file_id'] ?>" >	<i class="entypo-pencil"></i>View Data	</a></li>
                      <li><a href="#" class="fileSendSms" data-id="<?php echo $row['file_id'] ?>" >	<i class="entypo-pencil"></i>Send SMS	</a></li>
                      <li><a href="#" onclick="confirm_delete('<?php echo base_url();?>index.php?home/sms_file/delete/<?php echo $row['file_id'];?>');" >	<i class="entypo-trash"></i>Delete	</a></li>
                      </ul>
                   </div>
                </td>
              </tr>
              <?php } ?>
        </tbody>
      </table>
      </div>
      </section>
    </div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" data-backdrop="static">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Upload Contacts By File</h4>
    </div>
    <div class="modal-body">
      <div class="box box-primary" >
          <div class="box-header with-border">
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url() ?>index.php?home/sms_file/upload_file">
            <div class="box-body">
              <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <input type="file" id="fileToUpload" name="fileToUpload" required>

                <p class="help-block">Only CSV/Excel Allowed -Download sample template</p>
              </div>
              <div class="form-group">
                <label for="exampleInputFile">File Description</label>
                <input type="text" id="description" name="description" class="form-control" required>
              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Upload</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- View Data Modal -->
<div id="dataModal" class="modal fade" role="dialog" data-backdrop="static">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title"> Contact Details</h4>
    </div>
    <div class="modal-body">
      <div class="box box-primary" >
          <div class="box-header with-border">
          </div>
          <div id="contactFileList"></div>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- SEnd Sms Modal -->
<div id="fileSendSmsModal" class="modal fade" role="dialog" data-backdrop="static">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title"> Contact Details</h4>
    </div>
    <div class="modal-body">
      <div class="box box-primary" >
          <div class="box-header with-border">
          </div>
          <form role="form" id="fileSendSms-form">
            <div class="box-body">
              <input type="text"   id="file_id" name="file_id">
              <div class="form-group">
                <label for="Apikey">Message</label>
                  <p class="text-primary">Dear [name]</p>
                  <br><br>
                <p class="text-primary">(1 Message has 160 characters)</p>
                <textarea class="form-control" name="message" id="message"></textarea>
                <h6 class="pull-right" id="count_message"></h6>
              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-primary" id="fileSendSms-submit">Send Message</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
