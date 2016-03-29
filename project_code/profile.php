<?php 
include('connect.php'); 
$page = "all";
include('session.php'); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <link rel="shortcut icon" href="img/favicon.png">

    <title>Profile |  Internship Tracking System</title>

    <!-- Bootstrap CSS -->    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />


  </head>
<?php
	//$stmt = $db->prepare("SELECT * FROM person WHERE person_id=?");
	$stmt = $_SESSION['username']['qry'];
?>
  <body>
  <!-- container section start -->
  <section id="container" class="">
      <!--header start-->
      <?php include('header.php'); ?>      
      <!--header end-->

      <!--sidebar start-->
      <?php include('sidebar.php'); ?>
      <!--sidebar end-->
      
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
		  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-user-md"></i> <?=ucwords($stmt['person_type'])?> Profile</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="fa fa-user-md"></i>Profile</li>
					</ol>
				</div>
			</div>
              <div class="row">
                <!-- profile-widget -->
                <div class="col-lg-12">
                    <div class="profile-widget profile-widget-info">
                          <div class="panel-body">
                            <div class="col-lg-2 col-sm-2">
                              <h4><?=ucwords($stmt['last_name']." ".$stmt['first_name'])?></h4>               
                              <div class="follow-ava">
                                  <img src="img/profile-widget-avatar.jpg" alt="">
                              </div>
                              <h6>&lt;&lt;<?=ucwords($stmt['person_type'])?>&gt;&gt;</h6>
                            </div>
                            <div class="col-lg-4 col-sm-4 follow-info">
                                <p>Username : <b><?=$_SESSION['username']['uname'] ?></b></p>
								<p><i class="fa fa-envelope"> <?=$stmt['email']?></i> </p>
                                <h6>
                                	<?php 
									$login = new DateTime($stmt['lastlogin']);
									?>
                                    <b>
                                    <span><i class="icon_clock_alt"></i><?=$login->format('H:i')?></span>
                                    <span><i class="icon_calendar"></i><?=$login->format('d-m-y')?></span>
                                    <span><i class="icon_pin_alt"></i><?=ucwords($stmt['city'])?></span>
                                    </b>
                                </h6>
                            </div>
                          </div>
                    </div>
                </div>
              </div>
              <!-- page start-->
              <div class="row">
                 <div class="col-lg-12">
                    <section class="panel">
                          <header class="panel-heading tab-bg-info">
                              <ul class="nav nav-tabs">
                                  <li class="active">
                                      <a data-toggle="tab" href="#profile">
                                          <i class="icon-user"></i>
                                          Profile
                                      </a>
                                  </li>
                                  <li class="">
                                      <a data-toggle="tab" href="#edit-profile">
                                          <i class="icon-envelope"></i>
                                          Edit Profile
                                      </a>
                                  </li>
                                  <li class="">
                                      <a data-toggle="tab" href="#update-password">
                                          <i class="icon-envelope"></i>
                                          Update Password
                                      </a>
                                  </li>
                              </ul>
                          </header>
                          <div class="panel-body">
                              <div class="tab-content">
                                  <!-- profile -->
                                  <div id="profile" class="tab-pane active">
                                    <section class="panel">
                                      <!--div class="bio-graph-heading">
                                                Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium. My graduation from Massey University with a Bachelor of Design majoring in visual communication.
                                      </div -->
                                      <div class="panel-body bio-graph-info">
                                          <h1>Bio Graph</h1>
                                          <div class="row">
                                              <div class="bio-row">
                                                  <p><span>First Name </span>: <?=ucwords($stmt['first_name'])?> </p>
                                              </div>
                                              <div class="bio-row">
                                                  <p><span>Middle Name </span>: <?=ucwords($stmt['middle_name'])?></p>
                                              </div>                                              
                                              <div class="bio-row">
                                                  <p><span>Last Name</span>: <?=ucwords($stmt['last_name'])?></p>
                                              </div>
                                              <div class="bio-row">
                                                  <p><span>Address </span>: <?=ucwords($stmt['address_line_1'].", ".$stmt['address_line_2'])?></p>
                                              </div>
                                              <div class="bio-row">
                                                  <p><span>Email </span>: <?=$stmt['email']?></p>
                                              </div>
                                              <div class="bio-row">
                                                  <p><span>City </span>: <?=ucwords($stmt['city']." - ".$stmt['zip_code'])?></p>
                                              </div>
                                              <div class="bio-row">
                                                  <p><span>Mobile </span>: <?=$stmt['phone']?></p>
                                              </div>
                                              <div class="bio-row">
                                                  <p><span>State </span>: <?=ucwords($stmt['state'].", ".$stmt['country'])?></p>
                                              </div>
                                          </div>
                                      </div>
                                    </section>
                                      <section>
                                          <div class="row">                                              
                                          </div>
                                      </section>
                                  </div>
                                  <!-- edit-profile -->
                                  <div id="edit-profile" class="tab-pane">
                                    <section class="panel">                                          
                                          <div class="panel-body bio-graph-info">
                                              <h1> Edit Profile</h1>
                                              <form class="form-horizontal" role="form">   
                                              <!--  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Person Type</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" id="p-type" placeholder=" ">
                                                      </div>
                                                  </div> -->                                              
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">First Name</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" id="f-name" placeholder=" ">
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Middle Name</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" id="m-name" placeholder=" ">
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Last Name</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" id="l-name" placeholder=" ">
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Phone</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" id="phone" placeholder=" ">
                                                      </div>
                                                  </div>
                                                   <div class="form-group">
                                                      <label class="col-lg-2 control-label">Email</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" id="email" placeholder=" ">
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Address Line 1</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" id="addr 1" placeholder=" ">
                                                      </div>
                                                  </div>
                                                   
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Address Line 2</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" id="addr 2" placeholder=" ">
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Birthday</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" id="b-day" placeholder=" ">
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">City</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" id="city" placeholder=" ">
                                                      </div>
                                                   </div>
                                                      <div class="form-group">
                                                      <label class="col-lg-2 control-label">State</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" id="state" placeholder=" ">
                                                      </div>
                                                       </div>
                                                      <div class="form-group">
                                                      <label class="col-lg-2 control-label">Country</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" id="country" placeholder=" ">
                                                      </div>
                                                       </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Zip-Code</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" id="zipcode" placeholder=" ">
                                                      </div>
                                                       </div>

                                                    

                                                  <div class="form-group">
                                                      <div class="col-lg-offset-2 col-lg-10">
                                                          <button type="submit" class="btn btn-primary">Save</button>
                                                          <button type="button" class="btn btn-danger">Cancel</button>
                                                      </div>
                                                  </div>
                                              </form>
                                          </div>
                                      </section>
                                  </div>
                                  <!-- Update-password-->
                                  <div id="update-password" class="tab-pane">
                                    <section class="panel">                                          
                                          <div class="panel-body bio-graph-info">
                                              <h1> Update Password</h1>
                                              <form class="form-horizontal" role="form">                                                  
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Username</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?=$stmt['username']?>" readonly>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Password</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" id="password" name="password" placeholder="Password" >
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Confirm Password</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" >
                                                      </div>
                                                  </div>

                                                  <div class="form-group">
                                                      <div class="col-lg-offset-2 col-lg-10">
                                                          <button type="submit" class="btn btn-primary">Save</button>
                                                          <button type="button" class="btn btn-danger">Cancel</button>
                                                      </div>
                                                  </div>
                                              </form>
                                          </div>
                                      </section>
                                  </div>
                              </div>
                          </div>
                      </section>
                 </div>
              </div>

              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
  </section>
  <!-- container section end -->
    <!-- javascripts -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <!-- jquery knob -->
    <script src="assets/jquery-knob/js/jquery.knob.js"></script>
    <!--custome script for all page-->
    <script src="js/scripts.js"></script>

  <script>

      //knob
      $(".knob").knob();
	  $("#profilemenu").addClass("active");

  </script>


  </body>
</html>
