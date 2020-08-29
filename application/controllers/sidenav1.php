<div id="wrapper" class='toggled'>
        <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top">
              <div class="container-fluid">
                <div class="navbar-header">
                  <a class="navbar-brand" href="#">My Data</a>
                  <img style='display:none;'class="navbar" height=20 src="<?php echo base_url('assets/pictures/iStock_000028650530_Small.jpg');?>">
                </div>
                <ul class="nav navbar-nav">
                  <li class="active"><a style='font-size:12px;' href='<?php echo base_url('Home');?>'>Home</a></li>
                </ul>
                <ul class="nav navbar-nav">
                  <li class="active"><a style='font-size:12px;' href='<?php echo base_url('Home');?>'>About Us</a></li>
                </ul>
                <ul class='nav navbar-nav navbar-right'>
                  <li >
                    <a class="btn btn-default btn-sm" href="<?php echo base_url('devices');?>" style='font-size:12px;float:right;colour:red'>
                        <span class='glyphicon glyphicon-user'>Profile</span>
                    </a>
                  </li>
                  <li>
                    <a class="btn btn-default btn-sm" href="<?php echo base_url('User/logout');?>" style='font-size:12px;float:right;colour:red'>
                        <span class='glyphicon glyphicon-log-in'>Logout</span>
                    </a>
                  </li>
                </ul>
              </div>
            </nav>
            <!-- /.navbar-top-links -->
        <!-- Sidebar -->
        <div id="sidebar-wrapper" style='top:60px;'>
            <ul class="sidebar-nav" id='slide-out'>
                 <li><div class="user-view">
                      <div class="background">
                        <img style='margin:10px;'width=180 class="circle" src="<?php echo base_url('/Uploads/'.$user[0]['company_logo'].'');?>">
                      </div>
                      <a href="#!user"></a>
                      <a href="#!name"><span class="white-text name"><?php echo $user[0]['companyname'];?></span></a>
                      <a href="#!email"><span class="white-text email"><?php echo $user[0]['email'];?></span></a>
                    </div>
                </li>
                <li>
                    <a href="<?php echo base_url('/home');?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo base_url('/raw_message_data');?>">Raw Data</a>
                </li>
                <li>
                    <a href="<?php echo base_url('/counters');?>">Counters</a>
                </li>
                <!-- <li class="no-padding">
                <ul class="collapsible collapsible-accordion" style='border-top:0;border-right:0;border-left:0;'>
                  <li>
                    <a class="collapsible-header" style='border-bottom:0; background-color:0;padding:0;margin-top:14px;'>Analogues  <span class="caret"></span></a>
                    <div class="collapsible-body">
                      <ul>
                        <li><a href="<?php echo base_url('/analogue');?>">Dashboard</a></li>
                        <li><a href="<?php echo base_url('/analogue_config');?>">Configuration</a></li>
                      </ul>
                    </div>
                  </li>
                </ul>
              </li> -->
                 <li>
                    <a href="<?php echo base_url('/analogue');?>">Analogues</a>
                </li>
                <li>
                    <a href="<?php echo base_url('/digital_inputs');?>">Digital Inputs</a>
                </li>
                <li>
                    <a href="<?php echo base_url('/digital_outputs');?>">Control Outputs</a>
                </li>
              <!--   <li>
                    <a href="<?php echo base_url('devices');?>">Configure Devices</a>
                </li> -->
                <li class="no-padding" style='margin-bottom:70px;'>
                <ul class="collapsible collapsible-accordion" style='border-top:0;border-right:0;border-left:0;'>
                  <li>
                    <a class="collapsible-header" style='border-bottom:0; background-color:0;padding:0;margin-top:14px; margin-bottom:20px;'>Critical Alarms<span class="caret"></span></a>
                    <div class="collapsible-body"style='padding:5px;'>
                      <ul>
                       <li>
                          <a href="<?php echo base_url('/email');?>"><span class="fa fa-envelope-open"></span>Email</a>
                      </li>
                        <li><a href="<?php echo base_url('alarm_log');?>">Emails Sent</a></li>
                        <li><a style='margin-bottom:40px;'href="<?php echo base_url('reporting');?>">Report</a></li>
                      </ul>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <script src="<?php echo base_url('assets/javascript/Angular/sidenav.js');?>"></script>

        <!-- Page Content -->
        <div class='page_content_wrapper' style='margin-top:70px;'>