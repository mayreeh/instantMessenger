<!DOCTYPE html>
<html lang="en" class="full">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Instant Messenger</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body{
      background: black;
      height: 100%;
      min-height: 500px;
    }
  .full  {
   background:url('assets/dist/img/bg/computer.jpg');
    opacity:0.83;
     }

  </style>
</head>
<body>
  <nav class="navbar  navbar-dark bg-primary  ">
   <div class="container-fluid">
     <div class="navbar-header">
       <a class="navbar-brand" href="#">Instant Messenger</a>
     </div>
     <ul class="nav navbar-nav navbar-right" >
       <li><a data-toggle="tab" href="#home"><span class="glyphicon glyphicon-user"></span> New User ? Sign Up</a></li>
       <li><a data-toggle="tab" href="#login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
     </ul>
   </div>
 </nav>
<div class="container-fluid">
  <div class="col-md-7" style="background:url('assets/dist/img/bg/map2.png');min-height:588px; ">
  </div>
<div class="col-md-5" style="background-color:transparent; color:white">
    <ul class="nav nav-tabs" style="background-color:white; color:gray">
      <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
      <li><a data-toggle="tab" href="#create">Create Account</a></li>
      <li><a data-toggle="tab" href="#login">Login</a></li>
   </ul>
   <br>
<div class="tab-content" >
<?php if (!empty($this->session->flashdata('message'))) {?>
<h4 class="alert alert-danger" style="height:40px; font-size:14px; color:red" >
<?php echo $this->session->flashdata('message'); ?>
</h4>
<?php } ?>
    <div id="home" class="tab-pane fade in active">
      <h4>Instant Messaging Across Africa</h4>
      <hr/>
      <ul>
      <li><h4>Create account and get control your messaging</h4></li>
      <li><h4>100% High Delivery to all Mobile Operators</h4></li>
      <li><h4>Communicate Instant with your group of contacts</h4></li>
      <li><h4>Send Single Message Instantly</h4></li>
      <li><h4>Send Bulk SMS to your groups</h4></li>
      <li><h4>Send Bulk SMS By File Upload</h4></li>
    </ul>
      <hr/>
      <h4>Instant Messaging Across Africa</h4>
      <hr/>
    </div>
  <div id="create" class="tab-pane fade">
    <div class="register-box">
      <div class="register-box-body">
        <p class="login-box-msg">Register a new account</p>

        <form action="<?php echo base_url() ?>index.php?/login/create_account" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="fullname" placeholder="Fullname">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="username" placeholder="Username">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="email" class="form-control" name="email" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="retypepassword"  placeholder="Retype password">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <select  class="form-control"  name="country">
              <option value = "254">Kenya</option>
            </select>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> I agree to the <a href="#">terms</a>
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
     </div>
      <!-- /.form-box -->
    </div>
    <!-- /.register-box -->
  </div>
  <div id="login" class="tab-pane fade">
    <div class="login-box">
      <div class="login-box-body">
        <p class="login-box-msg">Login</p>

        <form action="<?php echo base_url()  ?>index.php?login/login_ajax" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="username" placeholder="Username">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">LOGIN</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
     </div>
      <!-- /.form-box -->
    </div>
    <!-- /.Login-box -->

  </div>
</div>
</div>

<!--/Container -->

</div>
<nav class="navbar navbar-dark bg-primary navbar-fixed-bottom">
 <div class="container-fluid">
   <div class="navbar-header">
     <a class="navbar-brand" href="#">WebSiteName</a>
   </div>
 </div>
</nav>
<!-- jQuery -->
<script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
