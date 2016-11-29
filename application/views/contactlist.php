<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3><?php echo $page_heading; ?> </h3>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Address Book</a></li>
        <li class="active">Contact List</li>
      </ol>
    </section>

		<!-- Main content -->
    <section class="content">
      <div class="row">
     <!-- Left col -->
     <section class="col-lg-7 connectedSortable">
      <!-- general form elements -->
        <div class="box box-primary" >
          <div class="box-header with-border">
          </div>
  <?php echo form_open(base_url() .'index.php?home/contactlist/create',array('class' => 'form-horizontal validate', 'id' => 'newContactList-form', 'style' => 'margin-left:7px;;'));?>
            <div class="box-body">
							<div class="form-group">
								<label for="fullname">Group</label>
								<div class="row">
									<div class="col-xs-8">
										<select name="group_id" class="form-control" onchange="get_group_contacts(this.value)" required>
											<?php foreach($this->groupmodel->getGroups() as $row):?>
												<option value="<?php echo $row['group_id']; ?>"><?php echo $row['groupname']; ?></option>
										 <?php endforeach;?>
											</select>
										</div>

									<div class="col-xs-4">
										<button type="button" class="btn btn-default btn-info" data-toggle="modal" data-target="#groupModal">Add Group</button>
									</div>
								</div>
						  </div>
              <hr/><br/>
              <div class="form-group">
                <label for="fullname">Contacts Details</label>
                <div id="POItablediv">
                  <table id="POITable" class="example" border="0">
                      <tr>
                          <td>Sn</td>
                          <td> Contact Name</td>
                          <td>Phone Number</td>
                          <td>Delete?</td>
                          <td>Add</td>
                      </tr>
                      <tr>
                        <td>1</td>
                        <td><input class="form-control" type="text" name="names[]" placeholeder = "Contact Names" required/></td>
                        <td><input class="form-control" type="text" name="phonenumber[]" placeholeder = "Phone Number"  required /></td>
                        <td><button type="button" id="delPOIbutton" value="Delete" onclick="deleteRow(this)"><i class="fa fa-times" ></i></button></td>
                        <td><button type="button"  id="addmorePOIbutton" title="Add Row" onclick="insRow()"><i class="fa fa-plus" ></i></button>
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td><input class="form-control" type="text" name="names[]" /></td>
                        <td><input class="form-control" type="text" name="phonenumber[]"  /></td>
                        <td><button type="button" id="delPOIbutton" value="Delete" onclick="deleteRow(this)"><i class="fa fa-times" ></i></button></td>
                        <td><button type="button"  id="addmorePOIbutton" title="Add Row" onclick="insRow()"><i class="fa fa-plus" ></i></button>
                        </td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td><input class="form-control" type="text" name="names[]" /></td>
                        <td><input class="form-control" type="text" name="phonenumber[]"  /></td>
                        <td><button type="button" id="delPOIbutton" value="Delete" onclick="deleteRow(this)"><i class="fa fa-times" ></i></button></td>
                        <td><button type="button"  id="addmorePOIbutton" title="Add Row" onclick="insRow()"><i class="fa fa-plus" ></i></button>
                        </td>
                      </tr>
                  </table>
                </div>
            </div>
            <!-- /.box-body -->
         <div class="box-footer">
					   <button type="submit" class="btn btn-primary" id = "newContactList-submit">Save Contact(s)</button>
            </div>
        <?php echo form_close();?>
        </div>
      </section>
<!--left Colum-->
<section class="col-lg-5 connectedSortable">
  <div class="box box-primary ">
  <div class="box-header with-border"></div>
      <div class="box-body border-radius-none">
        <div id="contactlist_holder"></div>

      </div>
      <!-- /.box-body -->
</div>

<div class="box box-primary ">
<div class="box-header with-border">  <h4>Group Contacts</h4> </div>
    <div class="box-body border-radius-none">

        <div class="box box-success">
          <ul class="todo-list">
            <?php foreach ($this->contactlistmodel->countContactsByGroups() as $row) {?>
            <li>
                <span class="handle">
                  <i class="fa fa-ellipsis-v"></i>
                  <i class="fa fa-ellipsis-v"></i>
                </span>
                 <input type="checkbox" value="">
                 <span class="text"><?php  echo $row['groupname']; ?></span>
                 <small class="label <?php if($row['total'] % 2 == 0) {?>label-danger<?php } else {?>label-info<?php } ?>"><?php  echo $row['total'] . " Contacts"; ?></small>
              </li>
              <?php } ?>
              </ul>
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

<!--MODALS--------------------------------->
<!-- Group Modal -->
<div id="groupModal" class="modal fade" role="dialog" data-backdrop="static">
<div class="modal-dialog">
<!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Add New Group</h4>
    </div>
    <div class="modal-body">
			<?php
			echo form_open('',array('role'=> "form" ,'id' => 'newGroup-form', 'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));
				?>
		<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Group Name</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="groupname" data-validate="required" data-message-required="Value Required" value="" autofocus required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-info" id="newGroup-submit">Save</button>
		      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		    </div>
				<?php echo form_close();?>
    </div>
  </div>
</div>
</div>
