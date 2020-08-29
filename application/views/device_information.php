<!-- header -->
<div class="row" style='margin:10px'>
    <div class="col s12 m6" style='width:100%'>
        <div class="card-panel teal">
            <div class="card-content white-text">
              <span class="card-title"><h2 style='font-family: Aldrich; margin:10px; text-decoration:underline';>Device Information</h2></span>
              <p>Use this panel as a base. From here you can look at critical information and act upon it quickly!</p>
            </div>
        </div>
    </div>
</div>
<?php   //  print_r($this->session->userdata);  ?>
<!-- Devices Information -->
<div class='wrapper_devices container-fluid' ng-controller='home'>
    <div class="row">
        <div class="col-lg-6" style='margin-left:10px;margin-right:20px;'>
            <!-- /.panel -->
            <?php $number_of_dataloggers = count($datalogger); ?>
            <div class="panel panel-default" style='width:98%'>
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Devices Information
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" style='height:20px;'>
                                Devices
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <?php foreach($datalogger as $device){
                                    echo "<li><a style='margin:15px;' class='waves-effect waves-light btn' href='#''>".$device['machine_name']."</a></li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
				    <h3 style=""class="datalog"></h3>
				    <?php $last = count($messages)-1;?>
            <?php print_r($user_id); ?>
                    <div class='table-responsive'>
					    <table class="table" class='table table-bordered table-hover table-striped'>
					     <tr class="datalog">
					         <td class="datalog"><b>Location:</b><br> <?php echo $datalogger[0]['location'] ?></td>
					     </tr>
					      <tr class="datalog">
					        <td class="datalog"><b>Machine Name:</b><br> <?php echo $datalogger[0]['machine_name'] ?></td>
					      </tr>
					      <tr class="datalog">
					        <td class="datalog"><b>Contact number:</b><br> <?php echo $datalogger[0]['phone'] ?></td>
					      </tr>
					      <tr class="datalog">
					    <td class="datalog"><b>Last Signal Strength:</b><br> <?php echo $messages[0]['signal_strength']?></td>
					      </tr>
					      <tr class="datalog">
					    <td class="datalog"><b>Last Sender ID:</b><br> <?php echo $messages[0]['sender_id']?></td>
					      </tr>
					      <tr class="datalog">
					    <td class="datalog"><b>Last Message: </b><br><span id='datetime'><?php echo gmdate("Y-m-d H:i:s", $messages[$last]['datetime']);?></span></td>
					      </tr>
					    </table>
					 </div>
                </div>
            </div>
        </div>
                <!-- new panel - right adjusted -->
                <div class='col-lg-6' style='width:auto'>
                    <div class='panel panel-default'>
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Location 
                        </div>
                        <div class="panel-body">
                              <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDm1xhGU9lTxCuGU7IjdgEAJByXQ17CeTs&callback=initMap&address=1600+Amphitheatre+Parkway,+Mountain+View,+CA"
                             async defer></script>
                            <div id="map" style='height:200px;width:200px'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
            <!-- /.row -->
            <div class='row'>
                <div class='col-lg-12' style='width:98%; margin:20px;'>
                     <div class='panel panel-default'>
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Navigation 
                        </div>
                        <div class="panel-body">
                            <div id="myCarousel" class="carousel slide" data-ride="carousel" style='height:auto'>
                              <!-- Indicators -->
                              <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                                <li data-target="#myCarousel" data-slide-to="3"></li>
                              </ol>
                              <!-- Wrapper for slides -->
                              <div class="carousel-inner">
                                <div class="item active">
                                  <img style = 'wdith:50%;margin:auto;'src="<?php echo base_url('assets/pictures/scada_alarm.jpg')?>">
                                  <div class="carousel-caption">
                                    <a href='<?php echo base_url('alarm_log');?>'>Alarms</a>
                                  </div>
                                </div>
                                <div class="item">
                                  <img style = 'wdith:50%;margin:auto;' src="<?php echo base_url('assets/pictures/email.jpg')?>" >
                                  <div class="carousel-caption">
                                    <a href='<?php echo base_url('email');?>'>Email's Sent</a>
                                  </div>
                                </div>
                                <div class="item">
                                  <img style = 'wdith:50%;margin:auto;'  src="<?php echo base_url('assets/pictures/analysis.jpg')?>" >
                                  <div class="carousel-caption">
                                    <a href='<?php echo base_url('overall_current_status');?>'>Analysis</a>
                                  </div>
                                </div>
                               <div class="item">
                                  <img style = 'wdith:50%;margin:auto;'  src="<?php echo base_url('assets/pictures/reporting.jpg')?>" >
                                  <div class="carousel-caption">
                                    <a href='<?php echo base_url('reporting');?>' >Reporting</a>
                                  </div>
                                </div>
                              </div>
                              <!-- Left and right controls -->
                              <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                <span class="sr-only">Previous</span>
                              </a>
                              <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                <span class="sr-only">Next</span>
                              </a>
                    </div>
                </div>
            </div>
             <input style='visibility:hidden;display:hidden' name = 'useridhidden'id='useridhidden'type='text'></input>
             <input style='visibility:hidden;display:hidden' name = 'senderidhidden'id='senderidhidden'type='text'></input>
        </div>
        <!-- /.panel-body -->
    </div>
    <script src="<?php echo base_url('assets/javascript/Angular/home.js');?>"></script>
</div>
<!-- /#page-content-wrapper -->
