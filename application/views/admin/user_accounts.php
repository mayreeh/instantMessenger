<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
  <h3>Manage User Accounts</h3>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Admin</a></li>
        <li class="active">Manage User Accounts</li>
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
        <?php $i = 1; foreach ($this->accountmodel->getUsers() as $users) { ?>
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
                      <li><a href="#" class="editAccountUser" data-id="<?php echo $users['account_id'] ?>" >	<i class="entypo-pencil"></i>Edit	</a></li>
                      <li><a href="#" class="delete" onclick="confirm_delete('<?php echo base_url();?>index.php?superadmin/users_accounts/delete/<?php echo $users['account_id'];?>');"  >	<i class="entypo-trash"></i>Delete	</a></li>
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
        <!-- /.box-header -->
        <!-- form start -->
    <?php
    echo form_open('',array('role'=> "form" ,'id' => 'newAccountUser-form', 'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));
    ?>
   <div class="box-body">
            <div class="form-group">
              <label for="fullname">Fullname</label>
              <input type="hidden" class="form-control" id="account_id" name="account_id" >
              <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter fullnames" required>
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
            <button type="submit" name = "submit" class="btn btn-primary" id ="newAccountUser-submit" value="Save Admin User">Save Account User</button>
          </div>
        </form>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>

</div>
</div>
