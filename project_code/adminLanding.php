<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title></title>
 
</head>
<body>

  <a href='logout.php'>Logout</a>
  
  <a href='addBusinessForm.php'>Add Business</a>
 

<h1>BUSINESS LISTING</h1>
<?php
require('connect.php');
$stmt = $db->prepare("SELECT * FROM business");

  $stmt->execute();
  $result = $stmt->fetchAll();
  
  foreach ($result as $row) {
      echo "<pre>";
      //print_r($row);
      echo "Title" . "  ". "<a href='businessDetail.php?id=$row[business_id]'>" . $row['business_name']."</a>"."\n";
      echo "Description" . $row['business_type']."\n" ;
      echo "Contact Person" . $row['contact_name'] ."\n";
      echo "Email" . $row['contact_email']."\n" ;
      echo "Internship opportunities" . $row['internship_opportunities']."\n" ;
      echo "<a href='UpdateBusiness.php?id=$row[business_id]'>Edit Business</a>"."\n";
      echo "<a href=''>Delete Business</a>"."\n";
     
    }
?>
</body>
</html>