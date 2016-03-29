<?php 
include('connect.php'); 
$page = "all";
include('session.php'); 
$update[0]=0;

  $prsndetails = $_SESSION['username']['qry'];
  $person_id=$result['person_id'];

  $q = $db->query("SELECT student_id FROM student WHERE person_id='".$person_id."'");
  $f = $q->fetch();
  $student_id = $f['student_id'];

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="shortcut icon" href="img/favicon.png">

    <title>List Student Skill | Internship Tracking System</title>

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
	#studskillsmenulist a {
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
		window.location="func/deletestudentskill.php?id="+id;
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
	

	if(isset($_POST["updateform"]))
	{
		$student_skill_id = $_POST['student_skill_id'];
		
		$skill_level = $_POST['skill_level'];

		$sql = "UPDATE student_skill SET skill_level=? 
									 WHERE student_skill_id=?";
		$q = $db->prepare($sql);
		$q->execute(array($skill_level,
						 $student_skill_id						
						 ));
		
	   
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
					<h3 class="page-header"><i class="fa fa-table"></i> List Student Skills</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="fa fa-table"></i>Student Skills</li>
						<li><i class="fa fa-th-list"></i>List Student Skills</li>
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
					echo "<h4 style=\"color:red; \">Student Skills Deleted Successfully</h4>";
					echo "</div>";
				}
				if($update[0]==1) {
					echo "<div class='col-lg-12'>";
					echo "<h4 style=\"color:green; \">Student Skiils ".$skill_id." Updated Successfully</h4>";
					echo "</div>";
				}
				?>
                  <div class="col-lg-12">
                      <section class="panel">                          
                          <table class="table table-striped table-advance table-hover">
                           <tbody>
                              <tr>
                                 <th><i class="skill_name"></i> Skill Name</th>
                                 <th><i class="skill_level"></i> SKill Level</th>                                
                                 <th><i class="icon_cogs"></i> Action</th>
                              </tr>
							  <?php
								/*-------------------------------Supervisor Listing--------------------------------*/
                  
               
								$stmt = $db->prepare("SELECT *,S.skill_level as SL FROM student_skill as S , skill as A where S.skill_id = A.skill_id AND S.student_id = '$student_id'");
								$stmt->execute();
                 $result = $stmt->fetchAll();
								foreach($result as $row)
								{
                  
								?>
                              <tr>
                                 <td><?=ucwords($row['skill_name'])?></td>
                                 <td><?php echo $row['3']?></td>
                                 <td>
                                  <div class="btn-group">
                                      <a class="btn btn-primary" href="#" onclick="return funcdelete('<?php echo $row['student_id']?>');"><i class="icon_check_alt2"></i> Remove</a>
                                      <a class="btn btn-danger"  href="#myModal-<?php echo $row['skill_name']?>" data-toggle="modal" ><i class="icon_check_alt2"></i> Edit</a>
                                  </div>
								  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-<?php echo $row['skill_name']?>" class="modal fade">
                                  <div class="modal-dialog">
                                      <div class="modal-content" style = "float:left;width:95%">
                                          <div class="modal-header">
                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                              <h4 class="modal-title">Edit Student Skill</h4>
                                          </div>
                                          <div class="modal-body">

                                              <form role="form" name="updateform" method="post" action="">
                                                 <div class="form-group ">
                                          <label for="skill" class="control-label col-lg-2">Skill<span class="required">*</span></label>
                                          <div class="col-lg-10">
												<input type="text" readonly value="<?=$row['skill_name']?> " style="text-align:center;background:#DDD; margin-bottom:10px"/>
                                          </div>
                                                <label for="skill" class="control-label col-lg-2">Skill Level<span class="required">*</span></label>
                                          <div class="col-lg-10">
											  <select name="skill_level" class="form-control m-bot15" required="">
												<option value=''> --Select--</option>
												<?php
												for($i=1;$i<=10;$i++)
												{
													echo '<option value="'.$i.'"';
													if($row['SL']==$i)
														echo "selected";
													echo '>'.$i.'</option>';
												}
												?>
											  </select>
                                          </div>
                                      </div>
                                      
                                  	<input type="hidden" name="student_skill_id" value="<?php echo $row['student_skill_id']?>" />
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
		  $("#studskillsmenu").addClass("active");
		  $("#studskillsmenulist").addClass("active2");
		  
	</script>
  </body>
</html>
