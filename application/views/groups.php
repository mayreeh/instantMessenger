<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3>Contact Groups   </h3>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Address Book</a></li>
        <li class="active">Manage Groups</li>
      </ol>
    </section>
  <!-- Main content -->
<section class="content" id="content">
  <div class="box box-success">
    <div class="box-header with-border">
    <div class="" style="float:right">
      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#groupsModal">Add New Group</button>
    </div>
  </div>
<table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Sn</th>
        <th>Group</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
        <?php $i = 1; foreach ($this->groupmodel->getGroups() as $row) { ?>
              <tr>
                <td><?php echo $i++;?></td>
                <td><?php echo $row['groupname'];?></td>
                <td>
                <div class="btn-group">
                     <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                         Action <span class="caret"></span>
                     </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                      <li class="divider"></li>
                      <li><a href="#" class="editGroup" data-id="<?php echo $row['group_id'] ?>" >	<i class="entypo-pencil"></i>Edit	</a></li>
                      <li><a href="#" class="delete" onclick="confirm_delete('<?php echo base_url();?>index.php?home/groups/delete/<?php echo $row['group_id'];?>');"  >	<i class="entypo-trash"></i>Delete	</a></li>
                      </ul>
                   </div>
                </td>
              </tr>
              <?php } ?>
        </tbody>
        </table>
      </div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!--MODALS--------------------------------->
<!-- Group Modal -->
<div id="groupsModal" class="modal fade" role="dialog" data-backdrop="static">
<div class="modal-dialog">
<!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Add New Group</h4>
    </div>
    <div class="modal-body">
			<?php
			echo form_open('',array('role'=> "form" ,'id' => 'newGroups-form', 'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));
				?>
		<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Group Name</label>
					<div class="col-sm-5">
            <input type="hidden" name="group_id" id="group_id">
						<input type="text" class="form-control" name="groupname" data-validate="required" data-message-required="Value Required" value="" autofocus required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-info" id="newGroups-submit">Save</button>
		      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		    </div>
				<?php echo form_close();?>
    </div>
  </div>
</div>
</div>
