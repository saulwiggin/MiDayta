<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>My Data - A Cloud Platform for your Industrial IOT devices</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="My Data gives you access to your personal indsutrial data.
  You might operate a fleet of lorries or a factory which requires monitoring and automation.
  My Data can give you up to date, real-time monitoring of critical processes which directly impact your revenue stream.
  My Data gives you email and SMS alerts for these critical processes and also constantly accessable information. ">
  <meta name="keywords" content="gsm, dashboard, threshold, digital, sign, My-Data.me,industrial data, monitoring, automation, control, cybersecurity, critical processes, alarms, SMS, email, accessable information, iot, iiot">
  <meta name="author" content="Saul Wiggin">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
  body {
      font: 400 15px Lato, sans-serif;
      line-height: 1.8;
      color: #818181;
  }
  h2 {
      font-size: 24px;
      text-transform: uppercase;
      color: #303030;
      font-weight: 600;
      margin-bottom: 30px;
  }
  h4 {
      font-size: 19px;
      line-height: 1.375em;
      color: #303030;
      font-weight: 400;
      margin-bottom: 30px;
  }
  .jumbotron {
      background-position: center;
      background-image:url("stock-illustration-4543850-three-abstract-header-footer-images.jpg");
      background-color: #f4511e;
      color: #fff;
      padding: 100px 25px;
      font-family: Montserrat, sans-serif;
  }
  .container-fluid {
      padding: 60px 50px;
  }
  .bg-grey {
      background-color: #f6f6f6;
  }
  .logo-small {
      color: #f4511e;
      font-size: 50px;
  }
  .logo {
      color: #f4511e;
      font-size: 200px;
  }
  .thumbnail {
      padding: 0 0 15px 0;
      border: none;
      border-radius: 0;
  }
  .thumbnail img {
      width: 100%;
      height: 100%;
      margin-bottom: 10px;
  }
  .carousel-control.right, .carousel-control.left {
      background-image: none;
      color: #f4511e;
  }
  .carousel-indicators li {
      border-color: #f4511e;
  }
  .carousel-indicators li.active {
      background-color: #f4511e;
  }
  .item h4 {
      font-size: 19px;
      line-height: 1.375em;
      font-weight: 400;
      font-style: italic;
      margin: 70px 0;
  }
  .item span {
      font-style: normal;
  }
  .panel {
      border: 1px solid #f4511e;
      border-radius:0 !important;
      transition: box-shadow 0.5s;
  }
  .panel:hover {
      box-shadow: 5px 0px 40px rgba(0,0,0, .2);
  }
  .panel-footer .btn:hover {
      border: 1px solid #f4511e;
      background-color: #fff !important;
      color: #f4511e;
  }
  .panel-heading {
      color: #fff !important;
      background-color: #f4511e !important;
      padding: 25px;
      border-bottom: 1px solid transparent;
      border-top-left-radius: 0px;
      border-top-right-radius: 0px;
      border-bottom-left-radius: 0px;
      border-bottom-right-radius: 0px;
  }
  .panel-footer {
      background-color: white !important;
  }
  .panel-footer h3 {
      font-size: 32px;
  }
  .panel-footer h4 {
      color: #aaa;
      font-size: 14px;
  }
  .panel-footer .btn {
      margin: 15px 0;
      background-color: #f4511e;
      color: #fff;
  }
  .navbar {
      margin-bottom: 0;
      background-color: #f4511e;
      z-index: 9999;
      border: 0;
      font-size: 12px !important;
      line-height: 1.42857143 !important;
      letter-spacing: 4px;
      border-radius: 0;
      font-family: Montserrat, sans-serif;
  }
  .navbar li a, .navbar .navbar-brand {
      color: #fff !important;
  }
  .navbar-nav li a:hover, .navbar-nav li.active a {
      color: #f4511e !important;
      background-color: #fff !important;
  }
  .navbar-default .navbar-toggle {
      border-color: transparent;
      color: #fff !important;
  }
  footer .glyphicon {
      font-size: 20px;
      margin-bottom: 20px;
      color: #f4511e;
  }
  .slideanim {visibility:hidden;}
  .slide {
      animation-name: slide;
      -webkit-animation-name: slide;
      animation-duration: 1s;
      -webkit-animation-duration: 1s;
      visibility: visible;
  }
  @keyframes slide {
    0% {
      opacity: 0;
      -webkit-transform: translateY(70%);
    }
    100% {
      opacity: 1;
      -webkit-transform: translateY(0%);
    }
  }
  @-webkit-keyframes slide {
    0% {
      opacity: 0;
      -webkit-transform: translateY(70%);
    }
    100% {
      opacity: 1;
      -webkit-transform: translateY(0%);
    }
  }
  @media screen and (max-width: 768px) {
    .col-sm-4 {
      text-align: center;
      margin: 25px 0;
    }
    .btn-lg {
        width: 100%;
        margin-bottom: 35px;
    }
  }
  @media screen and (max-width: 480px) {
    .logo {
        font-size: 150px;
    }
  }
  </style>
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T6BWRVW"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-56127953-2', 'auto');
  ga('require', 'GTM-W3KFLV2');
  ga('send', 'pageview');
</script>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>

      </button>
<!--       <a class="navbar-brand" href="#myPage">Logo</a>
 -->    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#about">ABOUT</a></li>
        <li><a href="#services">SERVICES</a></li>
<!--         <li><a href="#portfolio">PORTFOLIO</a></li>
 -->        <li><a href="#pricing">PRICING</a></li>
        <li><a href="#contact">CONTACT</a></li>
       <li><a onclick='page_redirect()' href="#">LOGIN</a></li>
      </ul>
    </div>
  </div>
</nav>

<script>
function page_redirect(){
  location.replace("index.php/home/index/saul");
}
</script>

<div class="jumbotron text-center">
  <h1>My Data</h1>
  <p>A Cloud Dashboard for your Radio Telemetry Devices</p>
  <!--<form class="form-inline">-->
  <!--  <input type="email" class="form-control" size="50" placeholder="Email Address" required>-->
  <!--  <button type="button" class="btn btn-danger">Subscribe</button>-->
  <!--</form>-->
</div>

<!-- Container (About Section) -->
<div id="about" class="container-fluid">
  <div class="row">
    <div class="col-sm-8">
      <h2>About My Data</h2>
      <a href="https://twitter.com/mydatame?ref_src=twsrc%5Etfw" class="twitter-follow-button" data-show-count="false">Follow @mydatame</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
      <br>
      <!--<h4>Your subscription to My Data can be used along with the dataloggers below to receive multiple sensor data from your areas in your production plant, for monitoring time variable signs and for use in conjuction with GPRS mobile to receive SMS messages and emails when alarms are breached. -->
	        <p>My Data specializes in real time control of critical processes using low power radio. The X9100 uses the GSM network to transmit analogue, pulse counter, digital inputs and digital output information. My Data is a cloud platform which receives this data, displays it on a dashboard and allows the user to configure thresholds to trigger email alarms.
	</p>
	<h3> Applications </h3>
	<ul>
		<li>Factory Automation</li>
		<li>Process Control</li>
		<li>Water Treatment</li>
		<li>Agriculture</li>
		<li>Transport</li>
		<li>Security</li>
	</ul>
      <br><button class="btn btn-default btn-lg"><a href="#contact">Get in Touch</a></button>
    </div>
    <div class="col-sm-4 panel panel-body">
      <div class="thumbnail">
      	<img alt='a picture of an X9102'style='border:black;' height=400 src='<?php echo base_url('assets/pictures/X9102 copy.jpg');?>'> </img>
        <!--<span class="glyphicon glyphicon-signal logo"></span>-->
      </div>
    </div>
  </div>
</div>

<div class="container-fluid bg-grey">
  <div class="row">
    <div class="col-sm-4">
      <!--<span class="glyphicon glyphicon-globe logo slideanim"></span>-->
<!--       	<img style='border:black;margin-left:-20px;'src='stock-photo-68133885-running-on-the-beach.jpg'> </img>
 -->    </div>
    <div class="col-sm-8">
      <h2>Overview</h2><br>
      <h3><strong>MISSION:</strong> We Deliver Real Telemetry Solutions for Real Applications.</h3><br>
      <p><strong>ABOUT US:</strong> We provide devices which you can use to gather telemetry data (pulse counters, digital and analogue) from your industrial process. We offer a personalised approach to guide you through setting up your equipment. The system is easy to configure and can get you reporting data to a website or mobile app quickly. We provide a reporting and dashboard tool. Email and SMS alerts can be configured for critical thresholds.</p>
    </div>
  </div>
</div>

<!-- Container (Services Section) -->
<div id="services" class="container-fluid text-center">
  <h2>SERVICES</h2>
  <h3>What we offer</h3>
  <br>
  <div class="row slideanim">
    <div class="col-sm-4">
      <!--<span class="glyphicon glyphicon-off logo-small"></span>-->
	    <img alt='an image of an email being sent' style='height:200px;'src='<?php echo base_url('assets/pictures/email.jpg');?>'></img>
      <h3>Email Alert</h3>
      <p>

	</p>
    </div>
    <div class="col-sm-4">
	   <img alt='an image of a computer dashboard with charts and dials' style='height:200px;width:400px'src='<?php echo base_url('assets/pictures/computer.jpg');?>'></img>
      <!--<span class="glyphicon glyphicon-heart logo-small"></span>-->
      <h3>Web Dashboard</h3>
      <p> </p>
    </div>
    <div class="col-sm-4">
      <!--<span class="glyphicon glyphicon-lock logo-small"></span>-->
	   <img alt='a picture of the mobile application of My Data' style='height:200px;width:400px'src='<?php echo base_url('assets/pictures/mobile.jpg');?>'></img>
      <h3>Mobile App</h3>
      <p>  </p>
    </div>
  </div>
  <!--<br><br>-->
  <!--<div class="row slideanim">-->
  <!--  <div class="col-sm-4">-->
  <!--    <span class="glyphicon glyphicon-leaf logo-small"></span>-->
  <!--    <h4>GREEN</h4>-->
  <!--    <p> Low Power Radio Association</p>-->
  <!--  </div>-->
  <!--  <div class="col-sm-4">-->
  <!--    <span class="glyphicon glyphicon-certificate logo-small"></span>-->
  <!--    <h4>CERTIFIED</h4>-->
  <!--    <p> the Institute of Measurement and Control</p>-->
  <!--  </div>-->
  <!--  <div class="col-sm-4">-->
  <!--    <span class="glyphicon glyphicon-wrench logo-small"></span>-->
  <!--    <h4 style="color:#303030;">HARD WORK</h4>-->
  <!--    <p>High Data, Alarms, Communications</p>-->
  <!--  </div>-->
  <!--</div>-->
</div>

<!-- Container (Services Section) -->
<div id="services" class="container-fluid text-center">
  <h2>Hardware</h2>
  <h3>Radio Frequency and GSM Communications</h3>
  <br>
  <div class="row slideanim">
    <div class="col-sm-4">
      <!--<span class="glyphicon glyphicon-off logo-small"></span>-->
	    <img alt='an image of an email being sent' style='height:200px;'src='<?php echo base_url('assets/pictures/x8200.jpg');?>'></img>
      <h3>X8200</h3>
      <p> This is a long range radio transmission device allowing data to be transmitted through long distances on site.

	</p>
    </div>
    <div class="col-sm-4">
	   <img alt='an image of a computer dashboard with charts and dials' style='height:200px;width:400px'src='<?php echo base_url('assets/pictures/x9100.jpg');?>'></img>
      <!--<span class="glyphicon glyphicon-heart logo-small"></span>-->
      <h3>X9100</h3>
      <p> This is a standard GSM module. This allows the user to transmit counter, analogue and digital information to a website or sms through the mobile phone network. </p>
    </div>
    <div class="col-sm-4">
      <!--<span class="glyphicon glyphicon-lock logo-small"></span>-->
	   <img alt='a picture of the mobile application of My Data' style='height:200px;width:400px'src='<?php echo base_url('assets/pictures/x9500.jpeg');?>'></img>
      <h3>X9500</h3>
      <p> The X9500 is an enclosed, bespoke system designed to control a set of traffic lights and transmit that information back to a website. </p>
    </div>
  </div>

<!-- <!--  <!--Container (Portfolio Section) -->
<div id="portfolio" class="container-fluid text-center bg-grey">
 <h2>Clients</h2><br>
 <h3></h3>
 <div class="row text-center slideanim">
   <div class="col-sm-4">
     <div class="thumbnail">
       <img alt='the logo for the customer Chemson' src="<?php echo base_url('assets/pictures/Chemson.jpg');?>" alt="Chemson" style='height:100px;width:400px'>
       <p><strong>Chemson</strong></p>
        <p>Chemson came to us with a requirement for a set of radio modems to monitor the temperature in there factory.</p>
      </div>
   </div>
    <div class="col-sm-4">
     <div class="thumbnail">
        <img alt='The logo for the client Celtic' src="<?php echo base_url('assets/pictures/celtic-technologies.gif');?>" alt="celtic-technologies" style='height:200px;width:400px'>
        <p><strong>Celtic</strong></p>
        <p>Celtic is a land remediation contractor who placed an order for on site monitoring with antennas to transmit a signal greater than 3 km. We equiped them with a website which allowed them to monitor key industria processes on there site.</p>
      </div>
    </div>
    <div class="col-sm-4">
     <div class="thumbnail">
        <img alt=' a logo for the client briggs marine'src="<?php echo base_url('assets/pictures/Briggs.jpg');?>" alt="Briggs" style='height:200px;width:400px'>
        <p><strong>Briggs Marine</strong></p>
       <p>Briggs Marine are an Established Marine Engineering Company and we helped them in controlling and monitoring a set of harbour lights</p>
    </div>
   </div>
 </div><br>

 <!--  <h2>What our customers say</h2>
  <div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
    <!-- Indicators -->
  <!--   <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol> -->

    <!-- Wrapper for slides -->
    <!-- <div class="carousel-inner" role="listbox">
      <div class="item active">
        <h4>"Excellent technical know how and a personal service!"<br><span style="font-style:normal;">Michael Roe, Vice President, Power House</span></h4>
      </div>
      <div class="item">
        <h4>"One word... Incredible Technical Expertese!!"<br><span style="font-style:normal;">John Barrow, Salesman, Celtic Technolgies</span></h4>
      </div>
      <div class="item">
        <h4>"I will be coming back!"<br><span style="font-style:normal;">Damian Smith, Founder, Renewable Energies Technologies</span></h4>
      </div>
    </div> -->

    <!-- Left and right controls -->
   <!-- <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div> -->

<!-- Container (Pricing Section) -->
<div id="pricing" class="container-fluid">
  <div class="text-center">
    <h2>Choose your coverage</h2>
    <h3></h3>
  </div>
  <div class="row slideanim">
    <div class="col-sm-4 col-xs-12">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <h1>Basic</h1>
        </div>
        <div class="panel-body">
          <p><strong></strong> Din Rail mounted</p>
          <p><strong></strong> Battery pack optional</p>
          <p><strong></strong> Low power mode</p>
          <p><strong>8</strong> Din</p>
          <p><strong>2</strong> Relays</p>
          <p>Sim Card included</p>
          <p></p>
        </div>
        <div class="panel-footer">
          <!-- <div id="paypal-button-container"></div> -->
          <button class="btn btn-lg"><a href="#contact">Contact Us</a></button>
        </div>
      </div>
    </div>
    <div class="col-sm-4 col-xs-12">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <h1>Advanced</h1>
        </div>
        <div class="panel-body">
          <p><strong></strong> Solar Powered Optional</p>
          <p><strong></strong> LCD Display Optional</p>
          <p><strong></strong> Low Power Mode</p>
          <p><strong>8</strong> Digitals</p>
          <p><strong>4</strong> Pulse Counters</p>
         <p><strong>4</strong> Analogues</p>
        </div>
        <div class="panel-footer">
         <!--  <div id="paypal-button-container"></div> -->
          <button class="btn btn-lg"><a href="#contact">Contact Us</a></button>
        </div>
      </div>
    </div>
    <div class="col-sm-4 col-xs-12">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <h1>Complete</h1>
        </div>
        <div class="panel-body">
          <p><strong></strong> Email Alerts</p>
          <p><strong></strong> Dashboard</p>
          <p><strong></strong> Configure thresholds</p>
          <p><strong></strong> Mobile App (Android or IOS)</p>
          <p>Encrypted Login</p>
          <p>Cloud Storage</p>
        </div>
        <div class="panel-footer">
          <button class="btn btn-lg"><a href="#contact">Sign Up</a></button>
         <script src="https://www.paypalobjects.com/api/checkout.js"></script>
         <!--  <div id="paypal-button-container"></div> -->
          <script>

              // Render the PayPal button

              paypal.Button.render({

                  // Set your environment

                  env: 'sandbox', // sandbox | production

                  // Specify the style of the button

                  style: {
                      label: 'buynow',
                      fundingicons: true, // optional
                      branding: true, // optional
                      size:  'small', // small | medium | large | responsive
                      shape: 'rect',   // pill | rect
                      color: 'gold'   // gold | blue | silve | black
                  },

                  // PayPal Client IDs - replace with your own
                  // Create a PayPal app: https://developer.paypal.com/developer/applications/create

                  client: {
                      sandbox:    'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
                      production: '<insert production client id>'
                  },

                  // Wait for the PayPal button to be clicked

                  payment: function(data, actions) {
                      return actions.payment.create({
                          transactions: [
                              {
                                  amount: { total: '199.99', currency: 'GBP' }
                              }
                          ]
                      });
                  },

                  // Wait for the payment to be authorized by the customer

                  onAuthorize: function(data, actions) {
                      return actions.payment.execute().then(function() {
                          window.alert('Payment Complete!');
                      });
                  }

              }, '#paypal-button-container');

          </script>

        </div>
      </div>
    </div>
  </div>
</div>

<!-- Container (Contact Section) -->
<div id="contact" class="container-fluid bg-grey">
  <h2 class="text-center">CONTACT</h2>
  <div class="row">
    <div class="col-sm-5">
      <p>Contact us and well get back to you within 24 hours.</p>
      <p><span class="glyphicon glyphicon-map-marker"></span> Warwick, UK</p>
      <p><span class="glyphicon glyphicon-phone"></span> +44 01455 233616</p>
      <p><span class="glyphicon glyphicon-envelope"></span> sales@radiotelemetry.com</p>
    </div>
    <div class="col-sm-7 slideanim">
      <form action="mailto:sales@radiotelemetry.com" method="post" enctype="text/plain">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-default pull-right" type="submit">Send</button>
        </div>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- <div id="googleMap" style="height:400px;width:100%;"></div>
 -->
<!-- Add Google Maps -->
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script>
var myCenter = new google.maps.LatLng(52.5368384,-1.348366599999963);

function initialize() {
var mapProp = {
  center:myCenter,
  zoom:16,
  scrollwheel:false,
  draggable:false,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };

var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

var marker = new google.maps.Marker({
  position:myCenter,
  });

marker.setMap(map);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>

<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <!-- Site footer -->
      <!-- <div class="footer nav-collapse">
        <div class='row'>
          <div class='col-lg-2'>
            <address>
              <strong>Contact</strong><br>
              <strong>Saul Joseph Wiggin</strong><br>
              Unit 16, Sapcote Road Industrial Estate<br>
              Hinckley, UK, LE102AU<br>
             <abbr title="Phone">T:</abbr> 01455233616 <br>
            <a>E:sales@radiotelemetry.co.uk</a>
          </address>
        </div>
        <div class='col-lg-2'>
          <a href=''>
        </div>
      </div>
    </div> -->

<!--   <p>Bootstrap Theme Made By <a href="http://www.w3schools.com" title="Visit w3schools">www.w3schools.com</a></p>
 --></footer>

<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

    // Prevent default anchor click behavior
    event.preventDefault();

    // Store hash
    var hash = this.hash;

    // Using jQuery's animate() method to add smooth page scroll
    // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
    $('html, body').animate({
      scrollTop: $(hash).offset().top
    }, 900, function(){

      // Add hash (#) to URL when done scrolling (default click behavior)
      window.location.hash = hash;
    });
  });

  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})
</script>

</body>

</html>
