<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3>Group Data</h3>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Address Book</a></li>
        <li class="active">Group Data</li>
      </ol>
    </section>

		<!-- Main content -->
    <section class="content">

      <!-- general form elements -->
        <div class="box box-primary" >
          <div class="box-header with-border">
          </div>
      <div class="box-body">
							<div class="form-group">
								<label for="fullname">Groups</label>
								<div class="row">
									<div class="col-xs-8">
										<select name="group_id" class="form-control" onchange="get_group_contacts(this.value)" required>
											<?php foreach($this->groupmodel->getGroups() as $row):?>
												<option value="<?php echo $row['group_id']; ?>"><?php echo $row['groupname']; ?></option>
										 <?php endforeach;?>
											</select>
										</div>

									<div class="col-xs-4">
									</div>
								</div>
						  </div>
              <hr/>
<div id="contactlist_holder"></div>
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
