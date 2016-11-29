<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Admin  Users   </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Superadmin</a></li>
        <li class="active">Manage Admin Users</li>
      </ol>
    </section>
  <!-- Main content -->
<section class="content" id="content">
  <div class="box box-success">
    <div class="box-header with-border">
    <div class="" style="float:right">
      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Add New User</button>
    </div>
  </div>
<table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Sn</th>
        <th>Fullname</th>
        <th>Username</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
        <?php $i = 1; foreach ($this->adminmodel->getUsers() as $users) { ?>
              <tr>
                <td><?php echo $i++;?></td>
                <td><?php echo $users['fullname'];?></td>
                <td><?php echo $users['username'];?></td>
                <td><?php echo $users['email'];?></td>
                <td>
                <div class="btn-group">
                     <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                         Action <span class="caret"></span>
                     </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                      <li class="divider"></li>
                      <li><a href="#" class="editAdminUser" data-id="<?php echo $users['user_id'] ?>" >	<i class="entypo-pencil"></i>Edit	</a></li>
                      <li><a href="#" class="delete" onclick="confirm_delete('<?php echo base_url();?>index.php?superadmin/users/delete/<?php echo $users['user_id'];?>');"  >	<i class="entypo-trash"></i>Delete	</a></li>
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

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" data-backdrop="static">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Manage Users</h4>
    </div>
    <div class="modal-body">
      <div class="box box-primary">
        <div class="box-header with-border">
        </div>
  <?php
    echo form_open('',array('role'=> "form" ,'id' => 'newAdminUser-form', 'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));
    ?>
   <div class="box-body">
            <div class="form-group">
              <label for="fullname">Fullname</label>
              <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter fullnames" required>
              <input type="hidden" class="form-control" id="user_id" name="user_id" >

            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
            </div>
            <div class="form-group">
              <label for="fullname">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" name = "submit" class="btn btn-primary" id ="newAdminUser-submit" value="Save Admin User">Save Admin User</button>
          </div>
        <?php echo form_close();?>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>

</div>
</div>
