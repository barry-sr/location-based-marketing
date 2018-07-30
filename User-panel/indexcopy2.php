<!DOCTYPE html>
<html>
<?php
include('../src/session.php');
if (!($_SESSION['logged_in']))
   {
      header('Location: login.html');
      // Immediately exit and send response to the client and do not go furthur in whatever script it is part of.
      exit();
   }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Kode is a Premium Bootstrap Admin Template, It's responsive, clean coded and mobile friendly">
  <meta name="keywords" content="bootstrap, admin, dashboard, flat admin template, responsive," />
  <title>Plot User-Panel</title>

  <!-- ========== Css Files ========== -->
  <link href="css/root.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
  </head>
  <body onload="myFunction()">
  <!-- Start Page Loading -->
  <div class="loading"><img src="img/loading.gif" alt="loading-img"></div>
  <!-- End Page Loading -->
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
  <!-- START TOP -->
  <div id="top" class="clearfix">

    <!-- Start App Logo -->
    <div class="applogo">
      <a href="index.php" class="logo">Plot</a>
    </div>
    <!-- End App Logo -->

    <!-- Start Sidebar Show Hide Button -->
    <a href="#" class="sidebar-open-button"><i class="fa fa-bars"></i></a>
    <a href="#" class="sidebar-open-button-mobile"><i class="fa fa-bars"></i></a>
    <!-- End Sidebar Show Hide Button -->

    <!-- Start Searchbox -->
   <!--  <form class="searchform">
      <input type="text" class="searchbox" id="searchbox" placeholder="Search">
      <span class="searchbutton"><i class="fa fa-search"></i></span>
    </form> -->
    <!-- End Searchbox -->

    <!-- Start Top Menu -->
    <!-- <ul class="topmenu">
      <li><a href="#">Files</a></li>
      <li><a href="#">Authors</a></li>
      <li class="dropdown">
        <a href="#" data-toggle="dropdown" class="dropdown-toggle">My Files <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Videos</a></li>
          <li><a href="#">Pictures</a></li>
          <li><a href="#">Blog Posts</a></li>
        </ul>
      </li>
    </ul> -->
    <!-- End Top Menu -->

    <!-- Start Sidepanel Show-Hide Button -->
    <!-- <a href="#sidepanel" class="sidepanel-open-button"><i class="fa fa-outdent"></i></a> -->
    <!-- End Sidepanel Show-Hide Button -->

    <!-- Start Top Right -->
    <ul class="top-right">

  <!--   <li class="dropdown link">
      <a href="#" data-toggle="dropdown" class="dropdown-toggle hdbutton">Create New <span class="caret"></span></a>
        <ul class="dropdown-menu dropdown-menu-list">
          <li><a href="#"><i class="fa falist fa-paper-plane-o"></i>Product or Item</a></li>
          <li><a href="#"><i class="fa falist fa-font"></i>Blog Post</a></li>
          <li><a href="#"><i class="fa falist fa-file-image-o"></i>Image Gallery</a></li>
          <li><a href="#"><i class="fa falist fa-file-video-o"></i>Video Gallery</a></li>
        </ul>
    </li>

    <li class="link">
      <a href="#" class="notifications">6</a>
    </li> -->

    <li class="dropdown link">
      <a href="#" data-toggle="dropdown" class="dropdown-toggle profilebox"><img src="img/profileimg.png" alt="img"><b><?php echo $_SESSION["username"]; ?></b><span class="caret"></span></a>
        <ul class="dropdown-menu dropdown-menu-list dropdown-menu-right">
          <li role="presentation" class="dropdown-header">Profile</li>
          <!-- <li><a href="#"><i class="fa falist fa-inbox"></i>Inbox<span class="badge label-danger">4</span></a></li>
          <li><a href="#"><i class="fa falist fa-file-o"></i>Files</a></li>
          <li><a href="#"><i class="fa falist fa-wrench"></i>Settings</a></li>
          <li class="divider"></li>
          <li><a href="#"><i class="fa falist fa-lock"></i> Lockscreen</a></li> -->
          <li><a href="../src/logout.php"><i class="fa falist fa-power-off"></i> Logout</a></li>
        </ul>
    </li>

    </ul>
    <!-- End Top Right -->

  </div>
  <!-- END TOP -->
 <!-- //////////////////////////////////////////////////////////////////////////// --> 


<!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START SIDEBAR -->
<div class="sidebar clearfix">

<ul class="sidebar-panel nav">
  <li class="sidetitle">MAIN</li>
  <li><a href="index.php"><span class="icon color5"><i class="fa fa-home"></i></span>Dashboard<span class="label label-default"></span></a></li>
  <!-- <li><a href="mailbox.html"><span class="icon color6"><i class="fa fa-envelope-o"></i></span>Mailbox<span class="label label-default">19</span></a></li> -->
  <li><a href="#"><span class="icon color7"><i class="fa fa-location-arrow"></i></span>Create Geofence<span class="caret"></span></a>
    <ul>
      <li><a href="circle.php">Circle</a></li>
      <li><a href="tabs.html">Polygon</a></li>
    <!--   <li><a href="buttons.html">Buttons</a></li>
      <li><a href="panels.html">Panels</a></li>
      <li><a href="notifications.html">Notifications</a></li>
      <li><a href="modal-boxes.html">Modal Boxes</a></li>
      <li><a href="progress-bars.html">Progress Bars</a></li>
      <li><a href="others.html">Others<span class="label label-danger">NEW</span></a></li> -->
    </ul>
  </li>
  <!-- <li><a href="charts.html"><span class="icon color8"><i class="fa fa-bar-chart"></i></span>Charts</a></li>
  <li><a href="#"><span class="icon color9"><i class="fa fa-th"></i></span>Tables<span class="caret"></span></a>
    <ul>
      <li><a href="basic-table.html">Basic Tables</a></li>
      <li><a href="data-table.html">Data Tables</a></li>
    </ul>
  </li>
  <li><a href="#"><span class="icon color10"><i class="fa fa-check-square-o"></i></span>Forms<span class="caret"></span></a>
    <ul>
      <li><a href="form-elements.html">Form Elements</a></li>
      <li><a href="layouts.html">Form Layouts</a></li>
      <li><a href="text-editors.html">Text Editors</a></li>
    </ul>
  </li>
  <li><a href="widgets.html"><span class="icon color11"><i class="fa fa-diamond"></i></span>Widgets</a></li>
  <li><a href="calendar.html"><span class="icon color8"><i class="fa fa-calendar-o"></i></span>Calendar<span class="label label-danger">NEW</span></a></li>
  <li><a href="typography.html"><span class="icon color12"><i class="fa fa-font"></i></span>Typography</a></li>
  <li><a href="#"><span class="icon color14"><i class="fa fa-paper-plane-o"></i></span>Extra Pages<span class="caret"></span></a>
    <ul>
      <li><a href="social-profile.html">Social Profile</a></li>
      <li><a href="invoice.html">Invoice<span class="label label-danger">NEW</span></a></li>
      <li><a href="login.html">Login Page</a></li>
      <li><a href="register.html">Register</a></li>
      <li><a href="forgot-password.html">Forgot Password</a></li>
      <li><a href="lockscreen.html">Lockscreen</a></li>
      <li><a href="blank.html">Blank Page</a></li>
      <li><a href="contact.html">Contact</a></li>
      <li><a href="404.html">404 Page</a></li>
      <li><a href="500.html">500 Page</a></li>
    </ul>
  </li> -->
</ul>

<!-- <ul class="sidebar-panel nav">
  <li class="sidetitle">MORE</li>
  <li><a href="grid.html"><span class="icon color15"><i class="fa fa-columns"></i></span>Grid System</a></li>
  <li><a href="maps.html"><span class="icon color7"><i class="fa fa-map-marker"></i></span>Maps</a></li>
  <li><a href="customizable.html"><span class="icon color10"><i class="fa fa-lightbulb-o"></i></span>Customizable</a></li>
  <li><a href="helper-classes.html"><span class="icon color8"><i class="fa fa-code"></i></span>Helper Classes</a></li>
  <li><a href="changelogs.html"><span class="icon color12"><i class="fa fa-file-text-o"></i></span>Changelogs</a></li>
</ul> -->

<!-- <div class="sidebar-plan">
  Pro Plan<a href="#" class="link">Upgrade</a>
  <div class="progress">
  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
  </div>
</div>
<span class="space">42 GB / 100 GB</span>
</div> -->

</div>
<!-- END SIDEBAR -->
<!-- //////////////////////////////////////////////////////////////////////////// --> 

 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<div class="content">
   <div class="row  circle-padding">
    <!-- map section -->
    <p style="background-color: #FF8C00; color:#FFFFFF; height: 30px; width: 1000px; padding-left: 10px; font-size: 14px; font-weight: bold; padding-top: 5px;">Geofences on map</p>
    <div class="col-lg-8" id="map" style="height: 640px; width: 1000px; margin-top: -10px;">
    </div>
    <!-- list of geofences -->
    <a href="#" data-toggle="modal" data-target="#allGeofencesModal">
    <div class="col-sm-2">
      <div class="n-geofence">
        <h># of geofene</h><br>
        <span id=Nogeofence></span>
      </div>
      </a>
      <!-- end of lists of all goefences -->
     
     <!-- Modal -->
          <div class="modal fade" id="allGeofencesModal" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Details of All Geofences</h4>
                </div>
                <div class="modal-body">

      <table id="allGoedetailstable" class="display" data-order='[[ 1, "asc" ]]'>
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Remaining Active Days</th>
            </tr>
        </thead>
        <tbody>
          <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Remaining Active Days</th>
            </tr>
        </tbody>
        <tfoot>
          <tr>
                <th colspan="4" style="text-align:right">Total:</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
                </div>
                <div class="modal-footer">
                  
                </div>
              </div>
              
            </div>
          </div>
          <!-- end of modal -->

      <div class="ac-geofence">
        <h># of active geofene</h><br>
        <span id=Noactivegeofence></span>
      </div>
      <div class="userin-geofence">
        <h># of user entered Ac-geofene</h><br>
        <span id=NoUsersEnteredactivegeofence></span>
      </div>
    </div>    
</div>
<!-- End Content -->
 <!-- //////////////////////////////////////////////////////////////////////////// --> 


<!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START SIDEPANEL -->
<div role="tabpanel" class="sidepanel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#today" aria-controls="today" role="tab" data-toggle="tab">TODAY</a></li>
    <li role="presentation"><a href="#tasks" aria-controls="tasks" role="tab" data-toggle="tab">TASKS</a></li>
    <li role="presentation"><a href="#chat" aria-controls="chat" role="tab" data-toggle="tab">CHAT</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">

    <!-- Start Today -->
    <div role="tabpanel" class="tab-pane active" id="today">

      <div class="sidepanel-m-title">
        Today
        <span class="left-icon"><a href="#"><i class="fa fa-refresh"></i></a></span>
        <span class="right-icon"><a href="#"><i class="fa fa-file-o"></i></a></span>
      </div>

      <div class="gn-title">NEW</div>

      <ul class="list-w-title">
        <li>
          <a href="#">
            <span class="label label-danger">ORDER</span>
            <span class="date">9 hours ago</span>
            <h4>New Jacket 2.0</h4>
            Etiam auctor porta augue sit amet facilisis. Sed libero nisi, scelerisque.
          </a>
        </li>
        <li>
          <a href="#">
            <span class="label label-success">COMMENT</span>
            <span class="date">14 hours ago</span>
            <h4>Bill Jackson</h4>
            Etiam auctor porta augue sit amet facilisis. Sed libero nisi, scelerisque.
          </a>
        </li>
        <li>
          <a href="#">
            <span class="label label-info">MEETING</span>
            <span class="date">at 2:30 PM</span>
            <h4>Developer Team</h4>
            Etiam auctor porta augue sit amet facilisis. Sed libero nisi, scelerisque.
          </a>
        </li>
        <li>
          <a href="#">
            <span class="label label-warning">EVENT</span>
            <span class="date">3 days left</span>
            <h4>Birthday Party</h4>
            Etiam auctor porta augue sit amet facilisis. Sed libero nisi, scelerisque.
          </a>
        </li>
      </ul>

    </div>
    <!-- End Today -->

    <!-- Start Tasks -->
    <div role="tabpanel" class="tab-pane" id="tasks">

      <div class="sidepanel-m-title">
        To-do List
        <span class="left-icon"><a href="#"><i class="fa fa-pencil"></i></a></span>
        <span class="right-icon"><a href="#"><i class="fa fa-trash"></i></a></span>
      </div>

      <div class="gn-title">TODAY</div>

      <ul class="todo-list">
        <li class="checkbox checkbox-primary">
          <input id="checkboxside1" type="checkbox"><label for="checkboxside1">Add new products</label>
        </li>
        
        <li class="checkbox checkbox-primary">
          <input id="checkboxside2" type="checkbox"><label for="checkboxside2"><b>May 12, 6:30 pm</b> Meeting with Team</label>
        </li>
        
        <li class="checkbox checkbox-warning">
          <input id="checkboxside3" type="checkbox"><label for="checkboxside3">Design Facebook page</label>
        </li>
        
        <li class="checkbox checkbox-info">
          <input id="checkboxside4" type="checkbox"><label for="checkboxside4">Send Invoice to customers</label>
        </li>
        
        <li class="checkbox checkbox-danger">
          <input id="checkboxside5" type="checkbox"><label for="checkboxside5">Meeting with developer team</label>
        </li>
      </ul>

      <div class="gn-title">TOMORROW</div>
      <ul class="todo-list">
        <li class="checkbox checkbox-warning">
          <input id="checkboxside6" type="checkbox"><label for="checkboxside6">Redesign our company blog</label>
        </li>
        
        <li class="checkbox checkbox-success">
          <input id="checkboxside7" type="checkbox"><label for="checkboxside7">Finish client work</label>
        </li>
        
        <li class="checkbox checkbox-info">
          <input id="checkboxside8" type="checkbox"><label for="checkboxside8">Call Johnny from Developer Team</label>
        </li>

      </ul>
    </div>    
    <!-- End Tasks -->

    <!-- Start Chat -->
    <div role="tabpanel" class="tab-pane" id="chat">

      <div class="sidepanel-m-title">
        Friend List
        <span class="left-icon"><a href="#"><i class="fa fa-pencil"></i></a></span>
        <span class="right-icon"><a href="#"><i class="fa fa-trash"></i></a></span>
      </div>

      <div class="gn-title">ONLINE MEMBERS (3)</div>
      <ul class="group">
        <li class="member"><a href="#"><img src="img/profileimg.png" alt="img"><b>Allice Mingham</b>Los Angeles</a><span class="status online"></span></li>
        <li class="member"><a href="#"><img src="img/profileimg2.png" alt="img"><b>James Throwing</b>Las Vegas</a><span class="status busy"></span></li>
        <li class="member"><a href="#"><img src="img/profileimg3.png" alt="img"><b>Fred Stonefield</b>New York</a><span class="status away"></span></li>
        <li class="member"><a href="#"><img src="img/profileimg4.png" alt="img"><b>Chris M. Johnson</b>California</a><span class="status online"></span></li>
      </ul>

      <div class="gn-title">OFFLINE MEMBERS (8)</div>
     <ul class="group">
        <li class="member"><a href="#"><img src="img/profileimg5.png" alt="img"><b>Allice Mingham</b>Los Angeles</a><span class="status offline"></span></li>
        <li class="member"><a href="#"><img src="img/profileimg6.png" alt="img"><b>James Throwing</b>Las Vegas</a><span class="status offline"></span></li>
      </ul>

      <form class="search">
        <input type="text" class="form-control" placeholder="Search a Friend...">
      </form>
    </div>
    <!-- End Chat -->

  </div>

</div>
<!-- END SIDEPANEL -->
<!-- //////////////////////////////////////////////////////////////////////////// --> 


<!-- ================================================
jQuery Library
================================================ -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.1.0.js"></script> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
<!-- ================================================
Bootstrap Core JavaScript File
================================================ -->
<script src="js/bootstrap/bootstrap.min.js"></script>

<!-- ================================================
Plugin.js - Some Specific JS codes for Plugin Settings
================================================ -->
<script type="text/javascript" src="js/plugins.js"></script>

<!-- ================================================
Bootstrap Select
================================================ -->
<script type="text/javascript" src="js/bootstrap-select/bootstrap-select.js"></script>

<!-- ================================================
Bootstrap Toggle
================================================ -->
<script type="text/javascript" src="js/bootstrap-toggle/bootstrap-toggle.min.js"></script>

<!-- ================================================
Bootstrap WYSIHTML5
================================================ -->
<!-- main file -->
<script type="text/javascript" src="js/bootstrap-wysihtml5/wysihtml5-0.3.0.min.js"></script>
<!-- bootstrap file -->
<script type="text/javascript" src="js/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>

<!-- ================================================
Summernote
================================================ -->
<!-- <script type="text/javascript" src="js/summernote/summernote.min.js"></script> -->

<!-- ================================================
Flot Chart
================================================ -->
<!-- main file -->
<!-- <script type="text/javascript" src="js/flot-chart/flot-chart.js"></script> -->
<!-- time.js -->
<!-- <script type="text/javascript" src="js/flot-chart/flot-chart-time.js"></script> -->
<!-- stack.js -->
<!-- <script type="text/javascript" src="js/flot-chart/flot-chart-stack.js"></script> -->
<!-- pie.js -->
<!-- <script type="text/javascript" src="js/flot-chart/flot-chart-pie.js"></script> -->
<!-- demo codes -->
<!-- <script type="text/javascript" src="js/flot-chart/flot-chart-plugin.js"></script> -->

<!-- ================================================
Chartist
================================================ -->
<!-- main file -->
<!-- <script type="text/javascript" src="js/chartist/chartist.js"></script> -->
<!-- demo codes -->
<!-- <script type="text/javascript" src="js/chartist/chartist-plugin.js"></script>
 -->
<!-- ================================================
Easy Pie Chart
================================================ -->
<!-- main file -->
<!-- <script type="text/javascript" src="js/easypiechart/easypiechart.js"></script> -->
<!-- demo codes -->
<!-- <script type="text/javascript" src="js/easypiechart/easypiechart-plugin.js"></script> -->

<!-- ================================================
Sparkline
================================================ -->
<!-- main file -->
<!-- <script type="text/javascript" src="js/sparkline/sparkline.js"></script> -->
<!-- demo codes -->
<!-- <script type="text/javascript" src="js/sparkline/sparkline-plugin.js"></script> -->

<!-- ================================================
Rickshaw
================================================ -->
<!-- d3 -->
<!-- <script src="js/rickshaw/d3.v3.js"></script> -->
<!-- main file -->
<!-- <script src="js/rickshaw/rickshaw.js"></script> -->
<!-- demo codes -->
<!-- <script src="js/rickshaw/rickshaw-plugin.js"></script> -->

<!-- ================================================
Data Tables
================================================ -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
<!-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.colVis.min.js"></script> -->

<!-- ================================================
Sweet Alert
================================================ -->
<!-- <script src="js/sweet-alert/sweet-alert.min.js"></script> -->

<!-- ================================================
Kode Alert
================================================ -->
<!-- <script src="js/kode-alert/main.js"></script> -->

<!-- ================================================
Gmaps
================================================ -->
<!-- google maps api -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMMYiE-JJBJGtUNxzSXtcQPCcLp-cDgKE&libraries=places&callback=initMap"
    async defer></script>
<!-- main file -->
<!-- <script src="js/gmaps/gmaps.js"></script> -->
<!-- demo codes -->
<!-- <script src="js/gmaps/gmaps-plugin.js"></script> -->

<!-- ================================================
jQuery UI
================================================ -->
<script type="text/javascript" src="js/jquery-ui/jquery-ui.min.js"></script>
<!-- ================================================
Moment.js
================================================ -->
<!-- <script type="text/javascript" src="js/moment/moment.min.js"></script> -->

<!-- ================================================
Full Calendar
================================================ -->
<!-- <script type="text/javascript" src="js/full-calendar/fullcalendar.js"></script> -->

<!-- ================================================
Bootstrap Date Range Picker
================================================ -->
<!-- <script type="text/javascript" src="js/date-range-picker/daterangepicker.js"></script> -->

<!-- google map api   -->
<script>
//users data obtained from the session
var username="<?php echo $_SESSION["username"]; ?>";


//google map function
var map;
var polygon;
var Circle;

function initMap () {
     map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 3.1390, lng: 101.6869},
    zoom: 10
  });
  
}

function myRendermap(){

    $.ajax({
      method: 'POST',
      url: 'http://210.19.254.111/project/activeGeofences.php',
      data: jQuery.param({username: username})
    })
    .done(function(data){
      // console.log(data);
      if(data==="No data"){
        $('#activegoelist').text('No Active Geofence');
      } 
      else{
            if(Circle == null || Circle ==""){     
               var markerNodes = data.documentElement.getElementsByTagName("marker");
               //empty the map first 
               //console.log(data);
               for (var i = 0; i < markerNodes.length; i++) {
                  var latlng = new google.maps.LatLng(parseFloat(markerNodes[i].getAttribute("lat")), parseFloat(markerNodes[i].getAttribute("lng")));
                  var radius= markerNodes[i].getAttribute("radius");
                   //circle
                    Circle = new google.maps.Circle({
                    strokeColor: '#FF0000',
                    strokeOpacity: 0.8,
                    strokeWeight: 3,
                    fillColor: '#FF0000',
                    fillOpacity: 0.35,
                    map: map,
                    center: latlng,
                    radius: radius * 1000
                  });
               }//for loop end here
              Circle.setMap(map);
            } else{
              //console.log('nit');
                Circle.setMap(null);
                var markerNodes = data.documentElement.getElementsByTagName("marker");
               //empty the map first 
               for (var i = 0; i < markerNodes.length; i++) {
                  var latlng = new google.maps.LatLng(parseFloat(markerNodes[i].getAttribute("lat")), parseFloat(markerNodes[i].getAttribute("lng")));
                  var radius= markerNodes[i].getAttribute("radius");
                   //circle
                    Circle = new google.maps.Circle({
                    strokeColor: '#FF0000',
                    strokeOpacity: 0.8,
                    strokeWeight: 3,
                    fillColor: '#FF0000',
                    fillOpacity: 0.35,
                    map: map,
                    center: latlng,
                    radius: radius * 1000
                  });
               }//for loop end here
              Circle.setMap(map);
            }
        }
  });  


//render the map with polygon upon ajax success 
$.ajax({
      method: 'POST',
      url: 'http://210.19.254.111/project/activeGeofencesPoly.php',
      data: jQuery.param({username: username})
    })
    .done(function(data){
    if(data==="No data"){
        $('#activegoelist').text('No Active Geofence');
      } else {
        if(polygon == null || polygon ==""){
        var d= JSON.parse(data);
        for (i = 0; i < d.length; i++) {
              var tmp = parsePolyStrings(d[i]);
                if (tmp.length) {
                    polygon = new google.maps.Polygon({
                        paths : tmp,
                        strokeColor : '#00ff00',
                        strokeOpacity : 0.8,
                        strokeWeight : 2,
                        fillColor : '#00ff00',
                        fillOpacity : 0.35
                    });
                    polygon.setMap(map);
                }
            } 
        } else{
          polygon.setMap(null);
          var d= JSON.parse(data);
          for (i = 0; i < d.length; i++) {
                var tmp = parsePolyStrings(d[i]);
                  if (tmp.length) {
                      polygon = new google.maps.Polygon({
                          paths : tmp,
                          strokeColor : '#00ff00',
                          strokeOpacity : 0.8,
                          strokeWeight : 2,
                          fillColor : '#00ff00',
                          fillOpacity : 0.35
                      });
                      polygon.setMap(map);
                  }
             }
          }
      }   
});

//to parse the polygon data
function parsePolyStrings(ps) {
    var i, j, lat, lng, tmp, tmpArr,
        arr = [],
        //match '(' and ')' plus contents between them which contain anything other than '(' or ')'
        m = ps.match(/\([^\(\)]+\)/g);
    if (m !== null) {
        for (i = 0; i < m.length; i++) {
            //match all numeric strings
            tmp = m[i].match(/-?\d+\.?\d*/g);
            if (tmp !== null) {
                //convert all the coordinate sets in tmp from strings to Numbers and convert to LatLng objects
                for (j = 0, tmpArr = []; j < tmp.length; j+=2) {
                    lat = Number(tmp[j]);
                    lng = Number(tmp[j + 1]);
                    tmpArr.push(new google.maps.LatLng(lat, lng));
                }
                arr.push(tmpArr);
            }
        }
    }
    //array of arrays of LatLng objects, or empty array
    return arr;
}
}


$(window).ready(function() {

setInterval(()=>{
    //get  total number of geofences
$.ajax({
      method: 'POST',
      url: 'http://210.19.254.111/project/Totalnogeofences.php',
      data: jQuery.param({username: username})
    })
    .done(function(data){
      if(data ==="Could not successfully run query"){
        $('#Nogeofence').text('error');
      } else{
        $('#Nogeofence').text(data);  
      }
      
}); 
   

//get total number of active geofences
$.ajax({
      method: 'POST',
      url: 'http://210.19.254.111/project/Totalnoactivegeofences.php',
      data: jQuery.param({username: username})
    })
    .done(function(data){
      if(data === "Could not successfully run the query"){
        $('#Noactivegeofence').text('error');
      } else {
        $('#Noactivegeofence').text(data);
      }
      
}); 

//get number of users who entered the active geofences
$.ajax({
      method: 'POST',
      url: 'http://210.19.254.111/project/NoUsersEnteredActiveGeofences.php',
      data: jQuery.param({username: username})
    })
    .done(function(data){
      if(data ==="Could not successfully run query"){
        $('#NoUsersEnteredactivegeofence').text('error'); 
      } else{
        $('#NoUsersEnteredactivegeofence').text(data);
      }
      
});
// console.log('trigered'); 
}, 3000);

// details of all geofences modal
$('#allGeofencesModal').on('show.bs.modal', function (e) {
  var table =$('#allGoedetailstable').DataTable({
               "autoWidth": true,
               "processing": true,
               "serverSide": false,
               "responsive": true,
               "destroy": true,
               "ajax":{
                  "url": "http://210.19.254.111/Project/detailsofAllGeofences.php",
                  "type": "POST",
                  "data": {
                     "username": username
                  },
                  dataSrc: ""
               },
               "columns": [
                   {"data": "id"},
                   {"data": "title"},
                   {"data": "type"},
                   {"data": "age"},
                   {"data": "gender"},
                   {"data": "startDateTime"},
                   {"data": "endDateTime"},
                   {"defaultContent": "<button class='btn delete btn-default btn-sm'>Delete</button>"} 
               ],

               "searching": true,
               "paging": true,
               "Info": true,
               "language": {
                    "emptyTable":     "No geofence"
                  }
          });      

//delete geofence from the table 
// Handle click on "View" button
$('#allGoedetailstable tbody').on('click', '.delete', function (e) {
   var data = table.row( $(this).parents('tr') ).data();
   console.log(data);
    if(data.type ==="Circle"){
    $.ajax({
        method: 'POST',
        url: 'http://210.19.254.111/project/deleteCircleGeo.php',
        data: jQuery.param({id: data.id})
      })
      .done(function(data){
        if(data === "Record deleted successfully"){
          table.ajax.reload();
           
        }
        else {
           // preventDefault();
           alert('error', data);
           console.log('error', data);
        }
     });
  } else{
     $.ajax({
        method: 'POST',
        url: 'http://210.19.254.111/project/deletePolygonGeo.php',
        data: jQuery.param({id: data.id})
      })
      .done(function(data){
        if(data === "Record deleted successfully"){
          table.ajax.reload();
        }
        else {
           // preventDefault();
           alert('error', data);
           console.log('error', data);
        }
     });
  }  
   
});  


});


// details of active geofences
$('#allAcgeofencesModal').on('show.bs.modal', function (e) {
var table = $('#allActiveGoedetailstable').DataTable({
               "autoWidth": true,
               "processing": true,
               "serverSide": false,
               "responsive": true,
               "destroy": true,
               "ajax":{
                  "url": "http://210.19.254.111/Project/detailsofAllActiveGeofences.php",
                  "type": "POST",
                  "data": {
                     "username": username
                  },
                  dataSrc: ""
               },
               "columns": [
                   {"data": "id"},
                   {"data": "title"},
                   {"data": "type"},
                   {"data": "age"},
                   {"data": "gender"},
                   {"data": "days"},
                   {"data": null,
                    render:function (data, type, row, meta) {
                          if (row.status ==="Active") {
                              return "<button class='btn pause btn-default btn-sm'>Pause</button>";
                          } else {
                            return "<button class='btn pause btn-info btn-sm'>Active</button>";
                          }
                          
                      }
                 }                  
               ],
               "searching": true,
               "paging": true,
               "Info": true,
               "language": {
                    "emptyTable":     "No active geofence"
                  }
          }); 

         // Handle click on "View" button
         $('#allActiveGoedetailstable tbody').on('click', '.pause', function (e) {
             var data = table.row( $(this).parents('tr') ).data();
              if(data.type ==="Circle"){
              $.ajax({
                  method: 'POST',
                  url: 'http://210.19.254.111/project/pauseActiveGeofenceTypeCircle.php',
                  data: jQuery.param({id: data.id})
                })
                .done(function(data){
                  if(data === "Record updated successfully"){
                    table.ajax.reload();
                     
                  }
                  else {
                     // preventDefault();
                     console.log('error', data);
                  }
               });
            } else{
               $.ajax({
                  method: 'POST',
                  url: 'http://210.19.254.111/project/pauseActiveGeofenceTypePolygon.php',
                  data: jQuery.param({id: data.id})
                })
                .done(function(data){
                  if(data === "Record updated successfully"){
                    table.ajax.reload();
                  }
                  else {
                     // preventDefault();
                     console.log('error', data);
                  }
               });
            }  
             
         });   

});

//details of users who are in the geofences
$('#detailofUsersinsideGeoModal').on('show.bs.modal', function (e) {
           $('#detailsofUsersinsideGeoTable').dataTable({
               "autoWidth": true,
               "processing": true,
               "serverSide": false,
               "responsive": true,
               "destroy": true,
               "ajax":{
                  "url": "http://210.19.254.111/Project/detailsofAllUsersInsideActiveGeo.php",
                  "type": "POST",
                  "data": {
                     "username": username
                  },
                  dataSrc: ""
               },
               "columns": [
                   {"data": "geofence_id"},
                   {"data": "creator"},
                   {"data": "type"},
                   {"data": "id"},
                   {"data": "dateTime"}                
               ],
               "searching": true,
               "paging": true,
               "Info": true,
               "language": {
                    "emptyTable":     "No user inside geofences"
                  }
          });      
       });


});


</script>

</body>
</html>