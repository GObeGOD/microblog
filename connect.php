<?php
   // 1- Connect to the database using mysqli
     $db_host = "localhost";
     $db_user = "root";
     $db_password = "root";
     $db_name = "MicroBlog";
     
     $db_link = mysqli_connect($db_host, $db_user, $db_password, $db_name) 
     or die("Unable to connect to DB: " . mysqli_connect_error ());    
	 ?>