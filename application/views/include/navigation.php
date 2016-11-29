<!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar" >
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar"  >
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="assets/dist/img/avatar-12.png" class="img-circle" alt="">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('username'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="post" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="button" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" >
        <li class="header">Welcome</li>
        <li class="treeview">
          <a href="javascript:void" onclick="window.location.href ='<?php echo base_url() ?>index.php?home/'">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
     <?php if ($this->session->userdata('level') == 1) { ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Manage Users</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!--<li><a href="javascript:void" onclick="window.location.href ='<?php echo base_url() ?>index.php?admin/users/'"><i class="fa fa-circle-o"></i> Admin Users</a></li>-->
            <li><a href="javascript:void" onclick="window.location.href ='<?php echo base_url() ?>index.php?users/users_accounts/'"><i class="fa fa-circle-o"></i> User Accounts</a></li>
          </ul>
        </li>
        <?php } ?>
        <?php if ($this->session->userdata('level') == 11) { ?>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-files-o"></i>
              <span>SUPER-SMS Settings</span>
              <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="javascript:void" onclick="window.location.href ='<?php echo base_url() ?>index.php?admin/sms_settings/'"><i class="fa fa-circle-o"></i>Sms Settings</a></li>
            </ul>
         </li>
    <?php } ?>
    <?php if ($this->session->userdata('level') == 1) { ?>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-files-o"></i>
          <span>SMS Settings</span>
          <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="javascript:void" onclick="window.location.href ='<?php echo base_url() ?>index.php?admin/sms_AT/'"><i class="fa fa-circle-o"></i>AfricasTalking Gateway</a></li>
        </ul>
     </li>
     <?php } ?>
      <li class="treeview">
          <a href="#">  <i class="fa fa-envelope"></i>Messaging
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li>
              <a href="#"><i class="fa fa-circle-o"></i> Send SMS
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="javascript:void" onclick="window.location.href ='<?php echo base_url() ?>index.php?home/single_message/'"><i class="fa fa-circle-o"></i> Single Message</a></li>
                <li><a href="javascript:void" onclick="window.location.href ='<?php echo base_url() ?>index.php?home/sms_file/'"><i class="fa fa-circle-o"></i> By File</a></li>
                <li><a href="javascript:void" onclick="window.location.href ='<?php echo base_url() ?>index.php?home/sms_contact/'"><i class="fa fa-circle-o"></i> By Contact</a></li>
                <li><a href="javascript:void" onclick="window.location.href ='<?php echo base_url() ?>index.php?groups/sms_group/'"><i class="fa fa-circle-o"></i> By Group</a></li>
              </ul>
            </li>
            <li><a href="javascript:void" onclick="window.location.href ='<?php echo base_url() ?>index.php?home/sent_message/'"><i class="fa fa-circle-o"></i> Sent Messages</a></li>
            <li><a href="javascript:void" onclick="window.location.href ='<?php echo base_url() ?>index.php?home/draft_message/'"><i class="fa fa-circle-o"></i> Draft Message</a></li>
            <li><a href="javascript:void" onclick="window.location.href ='<?php echo base_url() ?>index.php?home/sms_inbox/'"><i class="fa fa-circle-o"></i> Inbox</a></li>

            </ul>
      </li>
      <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Address Book</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="javascript:void" onclick="window.location.href ='<?php echo base_url() ?>index.php?home/contactlist/'"><i class="fa fa-circle-o"></i> Contact List</a></li>
              <li><a href="javascript:void" onclick="window.location.href ='<?php echo base_url() ?>index.php?home/groups/'"><i class="fa fa-circle-o"></i> Groups</a></li>
              <li><a href="javascript:void" onclick="window.location.href ='<?php echo base_url() ?>index.php?home/group_data/'"><i class="fa fa-circle-o"></i> Group Data</a></li>
          </ul>
        </li>
      <!--  <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Airtime</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="javascript:void" onclick=""><i class="fa fa-circle-o"></i>Send Airtime</a></li>
            <li><a href="javascript:void" onclick=""><i class="fa fa-circle-o"></i>Airtime Status</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Transaction History</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Delivery Status</a></li>
          </ul>
        </li>-->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Support/Help</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i>Contact - 0720-165-089</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
