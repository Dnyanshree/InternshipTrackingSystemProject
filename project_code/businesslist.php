<?php 
include('connect.php'); 
$page = "all";
include('session.php'); 
$update[0]=0;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="shortcut icon" href="img/favicon.png">

    <title>List Supervisor | Internship Tracking System</title>

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
	<style type="text/css">
	#supervisormenulist a {
	  font-weight: bold;
	  color: #fff;
	}
	.form-group{float:left}
	</style>
	<script>
	function funcdelete(id,name){
	var del=confirm("Are you sure want to delete "+name+" ??");
	if(del==true)
	{
		window.location="func/deletesupervisor.php?id="+id;
		return false;
	}
	}
	</script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <script src="js/lte-ie7.js"></script>
    <![endif]-->
  </head>
<?php
	//$stmt = $db->prepare("SELECT * FROM person WHERE person_id=?");
	$prsndetails = $_SESSION['username']['qry'];
	$person_id=$result['person_id'];

	if(isset($_POST["updateform"]))
	{
		$person_id = $_POST['personid'];
		$first_name = $_POST['first_name'];
		$middle_name = $_POST['middle_name'];
		$last_name= $_POST['last_name'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$address_line_1 = $_POST['address_line_1'];
		$address_line_2 = $_POST['address_line_2'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$country = $_POST['country'];
		$zip_code = $_POST['zip_code'];
		

		$sql = "UPDATE person SET first_name=?, 
									middle_name=?, 
									last_name=?, 
									phone=?, 
									email=?, 
									address_line_1=?, 
									address_line_2=?, 
									city=?, 
									state=?, 
									country=?, 
									zip_code=? WHERE person_id=?";
		$q = $db->prepare($sql);
		$q->execute(array($first_name,
						 $middle_name,
						 $last_name,
						 $phone,
						 $email,
						 $address_line_1,
						 $address_line_2,
						 $city,
						 $state,
						 $country,
						 $zip_code,
						 $person_id
						 ));

		$update[0]=1;
		$update[1]=ucwords($last_name." ".$first_name);
	   
	}

	if(isset($_POST["name"]))
	{
		$contactName = $_POST['contact_name'];
		$contactEmail = $_POST['contact_email'];
		$businessName = $_POST['business_name'];
		$businessType = $_POST['business_type'];
		$internshipOpportunities = $_POST['internship_opportunities'];

		$sql = "INSERT INTO business (contact_name, contact_email, business_name, business_type, internship_opportunities) VALUES (:contact_name, :contact_email, :business_name, :business_type, :internship_opportunities)";
		$q = $db->prepare($sql);
		$q->execute(array(':contact_name'=>$contactName,
						 ':contact_email'=>$contactEmail,
						 ':business_name'=>$businessName,
						 ':business_type'=>$businessType,
						 ':internship_opportunities'=>$internshipOpportunities
						 ));

		echo 'Inserted Successfully';
	}
	
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
					<h3 class="page-header"><i class="fa fa-table"></i> List Supervisor</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="fa fa-table"></i>Supervisor</li>
						<li><i class="fa fa-th-list"></i>List Supervisor</li>
					</ol>
				</div>
			</div>
              <!-- page start-->
              <div class="row">
				<?php
				if(isset($_GET['delete'])) {
					$mat=$_GET['delete'];
					if($mat=='success')
					echo "<div class='col-lg-12'>";
					echo "<h4 style=\"color:red; \">Supervisor Deleted Successfully</h4>";
					echo "</div>";
				}
				if($update[0]==1) {
					echo "<div class='col-lg-12'>";
					echo "<h4 style=\"color:green; \">Supervisor ".$update[1]." Updated Successfully</h4>";
					echo "</div>";
				}
				?>
                  <div class="col-lg-12">
                      <section class="panel">                          
                          <table class="table table-striped table-advance table-hover">
                           <tbody>
                              <tr>
                                 <th><i class="icon_profile"></i> Name</th>
                                 <th><i class="icon_mail_alt"></i> Email</th>
                                 <th><i class="icon_mobile"></i> Mobile</th>
                                 <th><i class="icon_pin_alt"></i> Address</th>
                                 <th><i class="icon_calendar"></i> Business Name</th>
                                 <th><i class="icon_calendar"></i> Business Type</th>
                                 <th><i class="icon_cogs"></i> Action</th>
                              </tr>
							  <?php
								/*-------------------------------Supervisor Listing--------------------------------*/
								$stmt = $db->prepare("SELECT * FROM supervisor as S , person as P ,internship as I,business as B WHERE B.business_id=I.business_id AND S.business_id=I.business_id AND S.person_id=P.person_id");
								$stmt->execute();
								while($row = $stmt->fetch())
								{
								?>
                              <tr>
                                 <td><?=ucwords($row['last_name']." ".$row['first_name'])?></td>
                                 <td><?=$row['email']?></td>
                                 <td><?=$row['phone']?></td>
                                 <td><?=ucwords($row['address_line_1'].", ".$row['address_line_2'].", ".$row['city'].", ".strtoupper($row['state'])." - ".$row['zip_code']." ".$row['country'])?></td>
                                 <td><?=ucwords($row['business_name'])?></td>
                                 <td><?=ucwords($row['business_type'])?></td>
                                 <td>
                                  <div class="btn-group">
                                      <a class="btn btn-primary" href="#" onclick="return funcdelete('<?php echo $row['person_id']?>','<?php echo strtoupper($row['first_name'])?>');"><i class="icon_check_alt2"></i> Remove</a>
                                      <a class="btn btn-danger"  href="#myModal-<?php echo $row['person_id']?>" data-toggle="modal" ><i class="icon_check_alt2"></i> Edit</a>
                                  </div>
								  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-<?php echo $row['person_id']?>" class="modal fade">
                                  <div class="modal-dialog">
                                      <div class="modal-content" style = "float:left;width:95%">
                                          <div class="modal-header">
                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                              <h4 class="modal-title">Edit Supervisor</h4>
                                          </div>
                                          <div class="modal-body">

                                              <form role="form" name="updateform" method="post" action="">
                                                  <div class="form-group">
                                                      <label class="col-lg-2" for="first_name">First Name: </label>
													  <div class=" col-lg-10">
														<input class="form-control" value="<?=$row['first_name']?>" id="first_name" type="text" name="first_name" required />
													  </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-3" for="middle_name">Middle Name: </label>
													  <div class=" col-lg-9">
														<input class="form-control" value="<?=$row['middle_name']?>" id="middle_name" type="text" name="middle_name"  />
													  </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-3" for="last_name">Last Name: </label>
													  <div class=" col-lg-9">
														<input class="form-control" value="<?=$row['last_name']?>" id="last_name" type="text" name="last_name" required />
													  </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-3" for="phone">Phone: </label>
													  <div class=" col-lg-9">
														<input class="form-control" value="<?=$row['phone']?>" id="phone" type="text" name="phone" required />
													  </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-3" for="phone">Email: </label>
													  <div class=" col-lg-9">
														<input class="form-control" value="<?=$row['email']?>" id="email" type="text" name="email" required />
													  </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-3" for="address_line_1">Address Line 1: </label>
													  <div class=" col-lg-9">
														<input class="form-control" value="<?=$row['address_line_1']?>" id="address_line_1" type="text" name="address_line_1" required />
													  </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-3" for="address_line_2">Address Line 2: </label>
													  <div class=" col-lg-9">
														<input class="form-control" value="<?=$row['address_line_2']?>" id="address_line_2" type="text" name="address_line_2" required />
													  </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-3" for="city">City: </label>
													  <div class=" col-lg-9">
														<input class="form-control" value="<?=$row['city']?>" id="city" type="text" name="city" required />
													  </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-3" for="state">State: </label>
													  <div class=" col-lg-9">
														<input class="form-control" value="<?=$row['state']?>" id="state" type="text" name="state" required />
													  </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-3" for="country">Country: </label>
													  <div class=" col-lg-9">
														<input class="form-control" value="<?=$row['country']?>" id="country" type="text" name="country" required />
													  </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-3" for="zip_code">Zip Code: </label>
													  <div class=" col-lg-9">
														<input class="form-control" value="<?=$row['zip_code']?>" id="zip_code" type="text" name="zip_code" required />
													  </div>
                                                  </div>
													<input type="hidden" name="personid" value="<?php echo $row['person_id']?>" />
												  <div class="form-group">
													<button type="submit" class="btn btn-primary" name="updateform">Submit</button>
												</div>
											  </form>
                                          </div>
                                      </div>
                                  </div>
                                </td>
                              </tr>                              
							  <?php
							  }
							  ?>
                           </tbody>
                        </table>
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
    <!-- nicescroll -->
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <!--custome script for all page-->
    <script src="js/scripts.js"></script>
	<script>
		  $("#supervisormenu").addClass("active");
		  $("#supervisormenulist").addClass("active2");
		  
	</script>
  </body>
</html>
