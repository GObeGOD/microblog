<?php
/*
Template Name: Win
 */

get_header(); ?>

<!doctype html>

<html>

<head>
<meta charset="UTF-8">
<title>Midterm: Micro-blog</title>
<link href="CSS/Blogstyle.css"" rel="stylesheet">
<meta name="handheldfriendly" content="true">
	<meta name="mobileoptimized" content="240">
	<meta name="viewport" content="width=device-width,initial-scale=1,target-densitydpi=device-dpi">
</head>

<body>





<?php
     // 1- Connect to the database using mysqli
     require"connect.php" ;
	 // 2- Run the desired query / queries        
	$sqlQuery = "SELECT  message_text,time_stamp,user_name
	           	 FROM messages INNER JOIN users
				 ON  messages.user_id= users.user_id
				 ORDER BY  time_stamp DESC LIMIT 5";     
				            
	$result = mysqli_query($db_link, $sqlQuery);     
	
	
	
	   
	 
	   // 3- Loop through the recordset and output the product_names
     if( $result )
     {
          while( $row = mysqli_fetch_assoc($result) )
          {
			  echo'<div class="divmain">';
			 echo " <p id='messages1'>-" . $row['message_text'] . " </p>" ;
 				echo "<p id='usersd'> <span id='nameSpan'>". $row['user_name']."</span>" . " -  ".date("g:i a F j, Y ", strtotime($row['time_stamp']))." </p> ";   
  				//	echo "<p> " . $row['time_stamp'] . " </p> ";   
				//echo "<p id='userDate'>" . date("g:i a F j, Y ", strtotime($row['time_stamp'])) . " </p> ";   
					// echo  date("g:i a F j, Y ", strtotime($row['time_stamp'])) . "<br />";
					
					
				 echo'</div>';
					}
					
   					mysqli_close($db_link);
    
	 }
   	  else {
          //if $result was not set display error messages from our link
          echo "<p>" . mysqli_error( $db_link ) . "</p>";   
		   mysqli_close($db_link);
		   
     }
?>
</body>
</html>