<!doctype html>
<html>
<head>
<meta charset="UTF-8">

<title>Midterm: Micro-blog</title>
<link href="CSS/Blogstyle.css" rel="stylesheet"> 


</head>


<body>

<?
	
if (isset ($_POST["loginbtn"])){
	if ($_POST["loginbtn"]){
		
		echo'<form name="loginform" method="POST" action="signUp.php">
	<span>Name</span>
   												
    <input type="text" name="userName" id="userName" />
    <span>Password</span>
    <input type="password" name="password" id="password"/>
	
    <input type="submit" name="longinFrombtn" id="longinFrombtn" value="Sign-in" />
	</form>';	
	}
}
?>

     <form name="login" method="POST" action="<?=$_SERVER["PHP_SELF"]?>">
    <input type="submit" name="loginbtn" id="loginbtn" value="Log-in" />
	</form>
    
	 <form name="myform" method="POST" action="signUp.php">
    <input type="submit" name="singUpbtn" id="singUpbtn" value="Sign-in" />
	</form>
    
<?php
	
	
      // 1- Connect to the database using mysqli
     $db_host = "localhost";
     $db_user = "root";
     $db_password = "root";
     $db_name = "MicroBlog";
     
     $db_link = mysqli_connect($db_host, $db_user, $db_password, $db_name) 
     or die("Unable to connect to DB: " . mysqli_connect_error ());     
	 
	 // 2- Run the desired query / queries        
	$sqlQuery = " SELECT  message_text,time_stamp,user_name
 FROM messages INNER JOIN users
ON  messages.message_id= users.user_id
ORDER BY time_stamp
 ";                
	$result = mysqli_query($db_link, $sqlQuery);     
	
	
	
	   
	 
	   // 3- Loop through the recordset and output the product_names
     if( $result )
     {
          while( $row = mysqli_fetch_assoc($result) )
          {
               echo "<p>message= " . $row['message_text'] . "</p>\n\t\t";
          }
     }
     else
     {
          //if $result was not set display error messages from our link
          echo "<p>" . mysqli_error( $db_link ) . "</p>\n\t\t";    
     }

	 
      ?>  
      
      <?php
mysqli_close($link);
?>

</body>
</html>