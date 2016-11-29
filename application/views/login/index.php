<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Instant Messenger</title>

    <!-- Bootstrap Core CSS -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
     <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
  <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top topnav" role="navigation">
        <div class="container topnav">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand topnav" href="#">Start Bootstrap</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#about">About</a>
                    </li>
                    <li>
                        <a href="#services">Services</a>
                    </li>
                    <li>
                        <a href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


    <!-- Header -->
    <a name="about"></a>
    <div class="intro-header">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message" style="background:url('')">
                      <div class="row">
                          <div class="col-md-7">
                          <div class="row">
                            <div class="col-md-11">
                                <img class="img-responsive" src="<?php echo base_url() ?>assets/dist/img/bg/linked.png"/>
                                <h1>Connect with messaging</h1>
                                <h3>Connect with your con</h3>
                              </div>
                              <div class="col-md-1">

                                </div>
                            </div>
                          </div>
                          <div class="col-md-5">
                            <ul class="nav nav-tabs" style="background-color:lightblue;">
                                <li><a class="active" data-toggle="tab" href="#login">LOGIN</a></li>
                               <li ><a data-toggle="tab" href="#create">CREATE ACCOUNT</a></li>
                            </ul>
                            <div class="tab-content"  style="background-color:white; color:gray">
                              <h1>Connect with messaging</h1>
                              <h3>A Template by Start Bootstrap</h3>

                              <div id="create" class="tab-pane fade in active" >
                                <div class="login-box">
                                <!-- /.login-logo -->
                                  <div class="login-box-body">
                                    <p class="login-box-msg">Sign in to start your session</p>

                                    <form action="../../index2.html" method="post">
                                      <div class="form-group has-feedback">
                                        <input type="email" class="form-control" placeholder="Email">
                                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                      </div>
                                      <div class="form-group has-feedback">
                                        <input type="password" class="form-control" placeholder="Password">
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                      </div>
                                      <div class="row">
                                        <div class="col-xs-8">
                                          <div class="checkbox icheck">
                                            <label>
                                              <input type="checkbox"> Remember Me
                                            </label>
                                          </div>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-xs-4">
                                          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                                        </div>
                                        <!-- /.col -->
                                      </div>
                                    </form>
                                  <a href="#">I forgot my password</a><br>

                                  </div>
                                  <!-- /.login-box-body -->
                                </div>
                                <!-- /.login-box -->
                              </div>
                              <div id="login" class="tab-pane fade">
                                <div class="register-box">
                                  <div class="register-box-body">
                                    <p class="login-box-msg">Register a new membership</p>

                                    <form action="../../index.html" method="post">
                                      <div class="form-group has-feedback">
                                        <input type="text" class="form-control" placeholder="Full name">
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                      </div>
                                      <div class="form-group has-feedback">
                                        <input type="email" class="form-control" placeholder="Email">
                                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                      </div>
                                      <div class="form-group has-feedback">
                                        <input type="password" class="form-control" placeholder="Password">
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                      </div>
                                      <div class="form-group has-feedback">
                                        <input type="password" class="form-control" placeholder="Retype password">
                                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
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

                                    <div class="social-auth-links text-center">
                                      <p>- OR -</p>
                                      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
                                        Facebook</a>
                                      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
                                        Google+</a>
                                    </div>

                                    <a href="login.html" class="text-center">I already have a membership</a>
                                  </div>
                                  <!-- /.form-box -->
                                </div>
                                <!-- /.register-box -->
                              </div>
                            </div>
                          </div>
                        </div>
                        <hr class="intro-divider">
                        <ul class="list-inline intro-social-buttons">
                            <li>
                                <a href="https://twitter.com/SBootstrap" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                            </li>
                            <li>
                                <a href="https://github.com/IronSummitMedia/startbootstrap" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
                            </li>
                            <li>
                                <a href="#" class="btn btn-default btn-lg"><i class="fa fa-linkedin fa-fw"></i> <span class="network-name">Linkedin</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.intro-header -->

    <!-- Page Content -->

	<a  name="services"></a>
    <div class="content-section-a">

        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Death to the Stock Photo:<br>Special Thanks</h2>
                    <p class="lead">A special thanks to <a target="_blank" href="http://join.deathtothestockphoto.com/">Death to the Stock Photo</a> for providing the photographs that you see in this template. Visit their website to become a member.</p>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="img/ipad.png" alt="">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-a -->

    <div class="content-section-b">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">3D Device Mockups<br>by PSDCovers</h2>
                    <p class="lead">Turn your 2D designs into high quality, 3D product shots in seconds using free Photoshop actions by <a target="_blank" href="http://www.psdcovers.com/">PSDCovers</a>! Visit their website to download some of their awesome, free photoshop actions!</p>
                </div>
                <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                    <img class="img-responsive" src="img/dog.png" alt="">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-b -->

    <div class="content-section-a">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Google Web Fonts and<br>Font Awesome Icons</h2>
                    <p class="lead">This template features the 'Lato' font, part of the <a target="_blank" href="http://www.google.com/fonts">Google Web Font library</a>, as well as <a target="_blank" href="http://fontawesome.io">icons from Font Awesome</a>.</p>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="img/phones.png" alt="">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-a -->

	<a  name="contact"></a>
    <div class="banner">

        <div class="container">

            <div class="row">
                <div class="col-lg-6">
                    <h2>Connect to Start Bootstrap:</h2>
                </div>
                <div class="col-lg-6">
                    <ul class="list-inline banner-social-buttons">
                        <li>
                            <a href="https://twitter.com/SBootstrap" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                        </li>
                        <li>
                            <a href="https://github.com/IronSummitMedia/startbootstrap" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
                        </li>
                        <li>
                            <a href="#" class="btn btn-default btn-lg"><i class="fa fa-linkedin fa-fw"></i> <span class="network-name">Linkedin</span></a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.banner -->

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-inline">
                        <li>
                            <a href="#">Home</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#about">About</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#services">Services</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#contact">Contact</a>
                        </li>
                    </ul>
                    <p class="copyright text-muted small">Copyright &copy; Your Company 2014. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
