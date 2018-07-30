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

define("servername", "localhost");
define("dbusername", "root");
define("dbpassword", "");
define("dbname", "mydb");

$conn = new mysqli(servername, dbusername, dbpassword, dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT id, category FROM categories";
$result = $conn->query($query) or die("failed to get data: " . mysqli_error());
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
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
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
      <li><a href="polygon.php">Polygon</a></li>
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
      <div class="col-lg-9">
          <div class="row" id="map" style=" height: 675px;"></div>
      </div>
      <div class="col-lg-3" style="background-color: white;">
            <form action="javascript:true;" name="form" method="POST">
                <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" required>
                <label for="description">Description:</label>
                <textarea class="form-control" rows="2" maxlength="1000" id="description" required></textarea>

                <div class="row">
                  <div class="col-lg-7">
                    <label for="startDate">Start Date:</label>
                    <input type='date' class="form-control" id='startDate' required/>
                  </div>
                  <div class="col-lg-5">
                     <label for="startTime">Start Time:</label>
                     <input type='time' class="form-control" id='startTime' required/>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-7">
                    <label for="endDate">End Date:</label>
                    <input type='date' class="form-control" id='endDate' required/>
                  </div>
                  <div class="col-lg-5">
                     <label for="endTime">End Time:</label>
                     <input type='time' class="form-control" id='endTime' required/>
                  </div>
                </div>

                <br>
                <label for="email">Email:</label>
                <input type='email' class="form-control" id='email' required/>
                <br>
                <div class="radio radio-info radio-inline">
                   <input type="radio" id="inlineRadio1" value="M" name="gender" checked>
                   <label for="inlineRadio1">Male </label>
                </div>
                <div class="radio radio-inline">
                   <input type="radio" id="inlineRadio2" value="F" name="gender">
                   <label for="inlineRadio2">Female </label>
                </div> 
                </div>

                <div class="form-group">
                  <div>
                  <label for="age">Age</label>
                  </div>
                  <div class="row">
                  <div class="col-lg-7">
                  <input type='number' class="form-control form-control-sm" placeholder="From" id='ageFrom' min="0" max="100"  required/>
                  </div> 
                  <div class="col-lg-5">
                  <input type="number" class="form-control form-control-sm" placeholder="To" id='ageTo' min="0" max="100" required>
                  </div>
                  </div>
                </div>
               <div class="form-group">
                <select id="categories" class="selectpicker" multiple title="Choose Category" required="required">
                    <?php 
                         while ($row = $result->fetch_assoc())
                        {
                         echo "<option value=".$row['id'].">".$row['category']."</option>";
                        }
                    ?> 
                </select>
              </div>
              <div class="form-group">
                <label>Draw Circle</label>
                <input class="form-control" type="text" id="address" placeholder="address" autocomplete="off" onblur="myFunction()"  required>
                <br>
                <input class="form-control" type="number" id="radius" placeholder="radius" required><br>
                <input class="btn btn-primary draw" id="draw" type="button" value="draw">
                <input class="btn btn-success save" type="submit" value="save"><br>
                </div>
            </form>
      </div>
</div>



<!-- start here  -->
<!-- <div class="content" style="height: 600px;">
  <div class="row">
      <div class="col-lg-9 col-md-8 col-sm-6" style="background-color: red; height: 500px;" id="map"></div>
      <div class="col-lg-3 col-md-4 col-sm-6 col-width" id="inputfield" style="background-color: orange; height: 50px;"> -->
            <!-- <div class="col-sm-2"> -->
            <!-- <form action="javascript:true;" name="form" method="POST">
                <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" required>
                <label for="description">Description:</label>
                <textarea class="form-control" rows="2" maxlength="1000" id="description" required></textarea>
                <label for="startDate">Start Date & Time:</label>
                <input type='datetime-local' class="form-control" id='startDate' required/>
                <label for="endDate">End Date & Time:</label>
                <input type='datetime-local' class="form-control" id='endDate' required/>
                <br>
                <label for="email">Email:</label>
                <input type='email' class="form-control" id='email' required/>
                <br>
                <div class="radio radio-info radio-inline">
                   <input type="radio" id="inlineRadio1" value="M" name="gender" checked>
                   <label for="inlineRadio1">Male </label>
                </div>
                <div class="radio radio-inline">
                   <input type="radio" id="inlineRadio2" value="F" name="gender">
                   <label for="inlineRadio2">Female </label>
                </div> 
                </div>

                <div class="form-group">
                  <div>
                  <label for="age">Age</label>
                  </div>
                  <div class="row">
                  <div class="col-lg-7">
                  <input type='number' class="form-control form-control-sm" placeholder="From" id='ageFrom' min="0" max="100"  required/>
                  </div> 
                  <div class="col-lg-5">
                  <input type="number" class="form-control form-control-sm" placeholder="To" id='ageTo' min="0" max="100" required>
                  </div>
                  </div>
                </div>

              <div class="form-group">
                <label>Draw Circle</label>
                <input class="form-control" type="text" id="address" placeholder="address" autocomplete="off" required>
                <br>
                <input class="form-control" type="number" id="radius" placeholder="radius" required><br>
                <input class="btn btn-primary draw" id="draw" type="button" value="draw">
                <input class="btn btn-success save" type="submit" value="save"><br>
                </div>
            </form> -->
     <!--      </div> 
      </div>
  </div>
</div> -->

<!-- end here  -->

<!-- <div class="content">
   <div class="row  circle-padding"> -->
    <!-- map section -->
    <!-- <div class="col-lg-3 mapStyle"  id="map" style="height: 673px; width: 1000px;"></div> -->
          <!-- input section -->
          <!-- <div class="col-sm-2">
            <form action="javascript:true;" name="form" method="POST"> -->
              <!--   <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" required>
                <label for="description">Description:</label>
                <textarea class="form-control" rows="2" maxlength="1000" id="description" required></textarea>
                <label for="startDate">Start Date & Time:</label>
                <input type='datetime-local' class="form-control" id='startDate' required/>
                <label for="endDate">End Date & Time:</label>
                <input type='datetime-local' class="form-control" id='endDate' required/> -->
                <!-- <br> -->
               <!--  <label for="email">Email:</label>
                <input type='email' class="form-control" id='email' required/>
                <br>
                <div class="radio radio-info radio-inline">
                   <input type="radio" id="inlineRadio1" value="M" name="gender" checked>
                   <label for="inlineRadio1">Male </label>
                </div>
                <div class="radio radio-inline">
                   <input type="radio" id="inlineRadio2" value="F" name="gender">
                   <label for="inlineRadio2">Female </label>
                </div> 
                </div>

                <div class="form-group">
                  <div>
                  <label for="age">Age</label>
                  </div>
                  <div class="row">
                  <div class="col-lg-7">
                  <input type='number' class="form-control form-control-sm" placeholder="From" id='ageFrom' min="0" max="100"  required/>
                  </div> 
                  <div class="col-lg-5">
                  <input type="number" class="form-control form-control-sm" placeholder="To" id='ageTo' min="0" max="100" required>
                  </div>
                  </div>
                </div> -->
<!-- 
              <div class="form-group">
                <label>Draw Circle</label>
                <input class="form-control" type="text" id="address" placeholder="address" autocomplete="off" required>
                <br>
                <input class="form-control" type="number" id="radius" placeholder="radius" required><br>
                <input class="btn btn-primary draw" id="draw" type="button" value="draw">
                <input class="btn btn-success save" type="submit" value="save"><br>
                </div>
            </form>
          </div>  -->
       <!-- </div>     -->
<!-- </div> --> 
<!-- End Content -->
 <!-- //////////////////////////////////////////////////////////////////////////// --> 

<!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START SIDEPANEL -->
<!-- <div role="tabpanel" class="sidepanel">-->

  <!-- Nav tabs -->
 <!--  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#today" aria-controls="today" role="tab" data-toggle="tab">TODAY</a></li>
    <li role="presentation"><a href="#tasks" aria-controls="tasks" role="tab" data-toggle="tab">TASKS</a></li>
    <li role="presentation"><a href="#chat" aria-controls="chat" role="tab" data-toggle="tab">CHAT</a></li>
  </ul> -->

  <!-- Tab panes -->
  <!-- <div class="tab-content"> -->

    <!-- Start Today -->
  <!--   <div role="tabpanel" class="tab-pane active" id="today">

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

    </div> -->
    <!-- End Today -->

    <!-- Start Tasks -->
   <!--  <div role="tabpanel" class="tab-pane" id="tasks">

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
    </div>  -->   
    <!-- End Tasks -->

    <!-- Start Chat -->
  <!--   <div role="tabpanel" class="tab-pane" id="chat">

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
    </div> -->
    <!-- End Chat -->

  <!-- </div>

</div> -->
<!-- END SIDEPANEL -->
<!-- //////////////////////////////////////////////////////////////////////////// --> 


<!-- ================================================
jQuery Library
================================================ -->
<script type="text/javascript" src="js/jquery.min.js"></script>

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
<script type="text/javascript" src="js/summernote/summernote.min.js"></script>

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
<!-- <script type="text/javascript" src="js/chartist/chartist-plugin.js"></script> -->

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
<script src="js/datatables/datatables.min.js"></script>

<!-- ================================================
Sweet Alert
================================================ -->
<script src="js/sweet-alert/sweet-alert.min.js"></script>

<!-- ================================================
Kode Alert
================================================ -->
<script src="js/kode-alert/main.js"></script>

<!-- ================================================
Gmaps
================================================ -->
<!-- google maps api -->
<!-- <script src="http://maps.google.com/maps/api/js?sensor=true"></script> -->
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
// data obtained from the session
var username="<?php echo $_SESSION["username"]; ?>";
// var category="<?php $row = $result->fetch_assoc(); echo $row["category"];?>";
// console.log(category);
// var age="<?php echo $_SESSION["age"]; ?>";
// var gender="<?php echo $_SESSION["gender"]; ?>";
// console.log(username, age, gender);

//map function
var  map;
var circle;
var marker;
function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 3.1390, lng: 101.6869},
    zoom: 9
  });
  var address = document.getElementById("address");
  var autocomplete = new google.maps.places.Autocomplete(address);
}

function myFunction(){ 

      //zoom the map to the marker 
      var address = document.getElementById("address").value;
      var geocoder = new google.maps.Geocoder();
      var location;
      geocoder.geocode({ 'address': address}, function(results, status){
        if (status == google.maps.GeocoderStatus.OK) { 
            //check wether the circle is drawn already
            location = results[0].geometry.location;
            if(marker == null || marker ==""){
                 //marker       
                 marker = new google.maps.Marker({
                    map: map,
                    draggable: true,
                    position: results[0].geometry.location
                 });
                    // marker.setMap(map);
                    map.setZoom(18);
                    map.panTo(marker.position);
    
            } 
              else {
                 //remove the marker and the circle
                 marker.setMap(null);
                 if(circle){
                   circle.setMap(null); 
                 }
                 
                 //draw again the marker 
                 marker = new google.maps.Marker({
                    map: map,
                    draggable: true,
                    position: results[0].geometry.location
                 });
                    // marker.setMap(map);
                    map.setZoom(18);
                    map.panTo(marker.position);
            }         
                
        } else {
         alert("error: " + status);
      }
    });

    //function to draw the circle on the map
    $('#draw').click(function(e){
      // var address = document.getElementById("address").value; 
      // console.log(address);
      var radius= Number(document.getElementById('radius').value);
      if(!geocoder && radius==null || radius ==""){
        alert("Empty field");
    } else{  
            //check wether the circle is drawn already
            if(circle == null || circle ==""){
                //circle
                      circle = new google.maps.Circle({
                      strokeColor: '#008000',
                      strokeOpacity: 0.8,
                      strokeWeight: 2,
                      fillColor: '#008000',
                      fillOpacity: 0.5,
                      map: map,
                      center: location ,
                      radius: radius
                    });
              circle.setMap(map);
            } 
              else{
                 //remove  the circle
                 circle.setMap(null);
                 //draw again the circle
                      circle = new google.maps.Circle({
                      strokeColor: '#008000',
                      strokeOpacity: 0.8,
                      strokeWeight: 2,
                      fillColor: '#008000',
                      fillOpacity: 0.5,
                      map: map,
                      center: location ,
                      radius: radius
                    });
              circle.setMap(map);
            }         

     }
    });



}


$(window).ready(function() {

//submitting form in the database
$( "form" ).submit(function( event ) {
    var circleInfo=[];
    var title=$('#title').val();
    var description= $('#description').val();
    var startDate= $('#startDate').val();
    var startTime=$('#startTime').val();
    var endDate=$('#endDate').val();
    var endTime=$('#endTime').val();
    var email= $('#email').val();
    var ageFrom= $('#ageFrom').val();
    var ageTo= $('#ageTo').val();
    var gender= $("input[name='gender']:checked").val();
    var lat;
    var lng;
    var radius;
    var startDateTime = startDate+' '+startTime;
    var endDateTime = endDate+' '+endTime;
    var categories = $("#categories").val().toString();
  if(ageFrom >= ageTo) {
        event.preventDefault();
        alert('please check your Age to');
      } else if(startDateTime >= endDateTime){
    event.preventDefault();
        alert('please, the end date & time cannot be the same as the start date & time');
  } else if(circle == null || circle ==""){
      event.preventDefault();
        alert("There's no circle drawn, please draw");
  } else{
        var lat=circle.getCenter().lat();
        var lng=circle.getCenter().lng();
        var radius=(circle.getRadius()) * 0.001;
        circleInfo.push(username, title, description, startDateTime, endDateTime, email, gender, ageFrom, ageTo, lat, lng, radius, categories);
        $.ajax({
          method: "POST",
          url: "http://210.19.254.111/project/saveCircle.php",
          data: {data: circleInfo}
        })
          .done(function( msg ){
            if(msg ==="data saved successfully"){
            alert(msg);
            window.location.href = "index.php";
            return true;
          } else{
             event.preventDefault();
             alert(msg);
          }
        });   
      }
});


});

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMMYiE-JJBJGtUNxzSXtcQPCcLp-cDgKE&libraries=places&callback=initMap"
    async defer></script>


</body>
</html>