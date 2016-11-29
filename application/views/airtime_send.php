<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3>Send Airtime </h3>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Airtime</a></li>
        <li class="active">Send Airtime</li>
      </ol>
    </section>

		<!-- Main content -->
    <section class="content">
      <div class="row">
     <!-- Left col -->
     <section class="col-lg-10 connectedSortable">
      <!-- general form elements -->
        <div class="box box-primary" >
          <div class="box-header with-border">
          </div>
  <?php echo form_open(base_url() .'index.php?airtime/home/send',array('class' => 'form-horizontal validate', 'id' => 'sendAirtime-form', 'style' => 'margin-left:7px;;'));?>
        <div class="box-body">
				  <hr/><br/>
              <div class="form-group">
                <label for="fullname">Send Airtime</label>
                <div id="POItablediv">
                  <table id="POITable" class="example" border="0" width=100%>
                      <tr>
                          <td>Sn</td>
                          <td>Phone Number</td>
                          <td>Amount</td>
                          <td>Delete?</td>
                          <td>Add</td>
                      </tr>
                      <tr>
                        <td>1</td>
                        <td><input class="form-control" type="text" name="phonenumber[]" placeholeder = "Phone Number" required/></td>
                        <td><input class="form-control" type="text" name="amount[]" placeholeder = "Amount"  required /></td>
                        <td><button type="button" id="delPOIbutton" value="Delete" onclick="deleteRow(this)"><i class="fa fa-times" ></i></button></td>
                        <td><button type="button"  id="addmorePOIbutton" title="Add Row" onclick="insRow()"><i class="fa fa-plus" ></i></button>
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td><input class="form-control" type="text" name="phonenumber[]" placeholeder = "Phone Number" required/></td>
                        <td><input class="form-control" type="text" name="amount[]" placeholeder = "Amount"  required /></td>
                        <td><button type="button" id="delPOIbutton" value="Delete" onclick="deleteRow(this)"><i class="fa fa-times" ></i></button></td>
                        <td><button type="button"  id="addmorePOIbutton" title="Add Row" onclick="insRow()"><i class="fa fa-plus" ></i></button>
                        </td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td><input class="form-control" type="text" name="phonenumber[]" placeholeder = "Phone Number" required/></td>
                        <td><input class="form-control" type="text" name="amount[]" placeholeder = "Amount"  required /></td>
                        <td><button type="button" id="delPOIbutton" value="Delete" onclick="deleteRow(this)"><i class="fa fa-times" ></i></button></td>
                        <td><button type="button"  id="addmorePOIbutton" title="Add Row" onclick="insRow()"><i class="fa fa-plus" ></i></button>
                        </td>
                      </tr>
                  </table>
                </div>
            </div>
            <!-- /.box-body -->
         <div class="box-footer">
					   <button type="submit" class="btn btn-primary" id = "sendAirtime-submit">Send Airtime</button>
            </div>
        <?php echo form_close();?>
        </div>
      </section>
<!--left Colum-->
<section class="col-lg-2 connectedSortable">

<!-- /.box -->
</section>
<!-- /.left Colum-->
</div>
</section>
</div>
