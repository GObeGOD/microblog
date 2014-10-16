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


  if (isset($_POST["userName"])and ($_POST["password"] )){
		  require"connect.php" ; 
		 $display= 0;
         $loginName = $_POST["userName"];
		 $loginPass = $_POST["password"];
		 		
		
     // Trim any spaces from the front and back of each value;
     $loginName = trim($_POST['userName']);
     $loginPass = trim($_POST['password']);

     // Verify there is data in the variable after the trim()
     if( !empty($loginName) && !empty($loginPass) )
     {
          // Query to see if the password matches, and make session vars here.
		  $pdo = new PDO("mysql:host=$db_host;dbname=$db_name",$db_user,$db_password);

			$SQLquery = "SELECT * FROM users WHERE user_name=? AND user_hash=?";
			$results = $pdo->prepare($SQLquery);

		// check if query returned any results
		if( $results->execute(array($loginName, md5($loginPass))) )
		{
     // execute the query and check for a match in the users table
		 if( $results->rowCount() == 1 )
			{
			  // we have one match so we can create the session variables here
				  $row = $results->fetch( );
					$_SESSION['user_id'] = $row['user_id'];
					$_SESSION['user_name'] = $row['user_name'];
			        $userID = $_SESSION['user_id'];
			   
			 
			 
							}}
		else
			{
			  // error, no matches or more than one match
			   header("Location: index.php");
			  
			  //echo 'wrong login info';
			    $pdo = NULL;
			 }

		}else{
					 // query has failed to run
					  $pdo = NULL;
			}
 }

		
		
 
  

?>


</body>
</html>