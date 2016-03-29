<?php
    

	$db = null;
    error_reporting(0); 

	function get_db() { 
		$host = 'localhost';
        $database = 'datadiggers';
        $username = 'root';
        $password = '';

        /**
         * START OF CONNECTION CREATION AND DATABASE SELECTION
         */

        //connect to database using mysql_* (the old deprecated way)
        $link = mysql_connect($host, $username, $password);
        if(!$link) {
            die('Error: ' . mysql_error());
        }

        $dbSelected = mysql_select_db($database, $link);
        if(!$dbSelected) {
            die('Error: ' . mysql_error());
        }

        //connect to database using PDO (the new way)
        try {
            $db = new PDO('mysql:host='.$host.';dbname='.$database, $username, $password);
        } catch (PDOException $e) {
            print 'Error: ' . $e->getMessage() . '<br />';
            die();
        }

		return $db;
	}

	function get_internships () { 
		$file_db = get_db();
		$id_where = "";
		$where = "";
		$vals = array();
		$id_vals = array();
        
        if(isset($_GET['search']))
        {  
         
               
    		if($_GET['search'] != "")  {
    		 	$words = explode(" ", $_GET['search']);
    			
    			$id_where = " WHERE ";
    			
    			foreach($words as $word) {
                    
    				$word = "'%$word%'";    				
                    $id_where .= " "."job_title LIKE"." " .$word. " OR job_desc  LIKE "."  " .$word."OR";
    				
    			}
                $id_where = substr($id_where, 0, -2);
              

    		}
        }
		#inefficient to select all matches and then filter down. purely for demo and to
		#have faceted query on its own for demonstration. Look into elasticsearch or solr for efficient faceting!
        if(!empty($id_where))
        {
            $stmt = $file_db->prepare("SELECT internship_id FROM internship $id_where");
            
        }
        else{
            
            $stmt = $file_db->prepare("SELECT internship_id FROM internship ");
        }
		
		$stmt->execute($id_vals);

		$ids_list = "";
		while($internship = $stmt->fetch()) { 
            
			$ids_list .= $internship['internship_id'] . ",";	
		}
         
		$ids_list = substr($ids_list, 0, -1);

		#return if we got no results from search!
		if($ids_list == "") { 
			return $stmt;
		}

		unset($_GET['search']);

		#if we have facets
		if(count($_GET) > 0) { 

			#handle specialCases

                if(isset($_GET["job_desc"]))
                {
                    
        			     $description=$_GET["job_desc"];
        				$where .= " AND job_desc LIKE '%$description[0]%'";	
        				unset($_GET["job_desc"]);
        			
                }
              
            
    			if(isset($_GET["minPay"] )) { 
    				$where .= " AND pay >= $_GET[minPay] ";
    			}
                

    			if(isset($_GET["maxPay"] )) { 
    				$where .= " AND pay <= $_GET[maxPay] ";
    			}

    			unset($_GET["minPay"]);
    			unset($_GET["maxPay"]);
           
    			/*if(isset($_GET["minYear"] )){
    				$where .= " AND year >= $_GET[minYear] ";
    			}


    			if(isset($_GET["maxYear"])) {
    				$where .= " AND year <= $_GET[maxYear] ";
    			}

    			unset($_GET["minYear"]);
    			unset($_GET["maxYear"]);*/
            

			foreach($_GET as $key=>$value) {
				if(is_array($value)) {
					$where .= " AND $key IN (";
					foreach($value as $el) { 
						$where .= "?,";
						array_push($vals, $el);
					}
					$where = substr($where, 0, -1);
					$where .= ") ";
				}
				else { 
					$where .= " AND $key=? ";
					array_push($vals, $value);
				}
			}
		}

		$stmt = $file_db->prepare("SELECT * FROM internship WHERE internship_id IN ($ids_list) $where");
		$stmt->execute($vals);
       
		return $stmt;
	}

	function grid_view($stmt) { 
		$string = "";
      
		while ($internship = $stmt->fetch()) {
			
			$string .= "
				<div class='col-md-4 col-sm-6'>
                            <div class='thumbnail'>
                                       
                                    <span class='label label-success'>$" . $internship["pay"] . "</span>
                                    <div class='caption'>
                                        <h4 class='title'><a href='detail.php?id=$internship[internship_id]'>" . $internship["job_title"] . "</a></h4>
                                        <ul class='list-unstyled'>
                                            <li><span><strong>Description:</strong> " . $internship["job_desc"] . "</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
								</div>
								";
		}	

		if($string == "") { 
			$string = "<h3 style='text-align:center'>NO RESULTS</h3>";
		}

		return $string;
	}

	function get_models () { 
		$file_db = get_db();
		return $file_db->query('SELECT DISTINCT I.business_id, B.business_name FROM internship as I, business as B WHERE B.business_id=I.business_id');
	}

	if($_GET["ajax"] == "true") {
        unset($_GET['ajax']);
        echo grid_view(get_internships());
        exit;
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>jQuery Facets Demo</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS Assets -->

    <link rel="stylesheet" href="assets/css/jquery.fs.picker.css">
    <link href="assets/css/jquery.fs.selecter.css" rel="stylesheet">    
    <link rel="stylesheet" href="assets/css/font-awesome.css">
     <link rel="stylesheet" href="assets/css/style.css">
    <link href="assets/css/theme.css" rel="stylesheet">
    <!-- Auto Complete Css -->

</head>

<body>
<a href='logout.php'>Logout</a>
<a href='internships.php'>Applied internships</a>
<a href='UpdateProfile.php'>Update profile</a>
<a href='feedback.php'>Feedback</a>
    <!-- /Wrap -->
    <div id="wrap">
        <div class="container">


            <div class="row">

                <div class="col-md-3 col-sm-4"> 
                    <!-- left sec -->
                    <div class="left-sec">
                        <div class="left-cont">
                            <form>
                                <div class="label_div">Type a keyword : </div>
                                <div class="input_container">
                                    <input  name="search" type="text" id="country_id" onkeyup="autocomplet()">
                                    <ul id="country_list_id"></ul>
                                </div>
                            </form>
			                  <form class="filter-sec" id="facets">

                                <select name="business_id" class="form-control">
                                    <option value="">Company</option>
									<?php
										$result = get_models();
										
										foreach ($result as $m) {
									?>
											<option value="<?php echo $m['business_id'] ?>"><?php echo $m['business_name'] ?></option>
									<?php
										}
									?>
                                </select>

				<h5>Job title:</h5>
				  <div class="input-control">

                                    <input name="job_title[]" class="checkbox" id="Programmer" type="checkbox" value="Programmer" />
                                    <label for="Programmer">Programmer</label>

                                    <input name="job_title[]" class="checkbox" id="Tester" type="checkbox" value="Tester" />
                                    <label for="Tester">Tester</label>

                                    <input name="job_title[]" class="checkbox" id="used" type="checkbox" value="used" />
                                    <label for="used">Used</label>

                                    <input name="job_title[]" class="checkbox" id="php_developer" type="checkbox" value="php developer" />
                                    <label for="php_developer">php developer</label> 

                                </div>

                                <h5>Pay:</h5>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6">
                                        <input name="minPay" id="minPay" type="text" class="form-control input-sm" placeholder="Low">
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <input name="maxPay" id="maxPay" type="text" class="form-control input-sm" placeholder="High">
                                    </div>
                                </div>



                               <!--  <h5>Year:</h5>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6">
                                        <input name="minYear" id="minYear" type="text" class="form-control input-sm" placeholder="1999">
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <input name="maxYear" id="maxYear" type="text" class="form-control input-sm" placeholder="2013">
                                    </div>
                                </div> -->

				<h5>Skills</h5>
				  <div class="input-control">

                                    <input name="job_desc[]" class="checkbox" id="Mysql" type="checkbox" value="Mysql" />
                                    <label for="Mysql">Mysql</label>


                                    <input name="job_desc[]" class="checkbox" id="php" type="checkbox" value="php" />
                                    <label for="php">PHP</label>

                                    <input name="job_desc[]" class="checkbox" id="Java" type="checkbox" value="Java" />
                                    <label for="Java">Java</label>

                                   <!-- <input name="job_desc[]" class="checkbox" id="yellow" type="checkbox" value="yellow" />
                                    <label for="yellow">Yellow</label>

                                     <input name="job_desc[]" class="checkbox" id="silver" type="checkbox" value="silver" />
                                    <label for="silver">Silver</label>

                                    <input name="job_desc[]" class="checkbox" id="white" type="checkbox" value="white" />
                                    <label for="white">White</label>

                                    <input name="job_desc[]" class="checkbox" id="black" type="checkbox" value="black" />
                                    <label for="black">Black</label> -->

                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /left sec -->
                </div>
                <div class="col-md-9 col-sm-8">
                    <div class="right-sec">
                        <div class="row" id="searchCont">
							<?php echo grid_view(get_internships()); ?>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>



            <hr>






            <hr>



        </div>
        <!-- /.container -->


    <!-- /Wrap -->
    <!-- javascript -->
    <script src="js/jquery.min.js"></script>
   <!--   <script type='text/javascript' src='js/jquery.deserialize.js'></script>  -->
    <script type='text/javascript' src='js/jquery.facets.js'></script>
    <script type='text/javascript' src='js/listing.js'></script>
    <script type="text/javascript" src="js/script.js"></script>

    <script src="assets/js/jquery.fs.selecter.js"></script>
    <script src="assets/js/jquery.fs.picker.js"></script>
    <script src="assets/js/jquery.fs.scroller.js"></script>

    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/theme.js"></script>
    




    <script>
        $(document).ready(function (e) {




            $(".selecter_label_1").selecter({
                defaultLabel: "Select a Make"
            });

            $(".selecter_label_2").selecter({
                defaultLabel: "Select A Model"
            });

            $(".selecter_label_3").selecter({
                defaultLabel: "Condition"
            });

            $(".selecter_label_4").selecter({
                defaultLabel: "Transmission"
            });


            $("input[type=checkbox], input[type=radio]").picker();

        });
    </script>
    <!-- /Javascript -->



</body>

</html>
