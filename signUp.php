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
session_start();


  
	if (isset ($_POST["cancelbtn"])){
	if ($_POST["cancelbtn"]){
		
	 header("Location: index.php");
	}}
	//check log info
	
	



	
	?>
    <div class="signUpDiv">
    
  <form name="signUpfrom" method="POST" action="<?=$_SERVER["PHP_SELF"]?>" class="signUpfrom">
  <h1>Sign Up to Post on this Blog!</h1>
  <span id="signspan">Name</span>
  
  <input type="text" id="signUpname" name="signUpname">
  <br>
   <span id="signspanpass">Password</span>
   
  <input type="password" id="signUppass" name="signUppass">
 <br>
    <input type="submit" name="signUpbtn" id="signUpbtn" value="Sign Up" />
 
    <input type="submit" name="cancelbtn" id="cancelbtn" value="Cancel" />
	</form>
    </div>
    <?php
	

		
 if (isset($_POST["signUpname"])and ($_POST["signUppass"] and $_POST['signUpbtn'])){
		  require"connect.php" ; 
		 
         $signUpName = $_POST["signUpname"];
		 $signUpPass = $_POST["signUppass"];
		 
		 if( !empty($signUpName) && !empty($signUpPass) )
     {
          // Query to see if the password matches, and make session vars here.
		  $pdo = new PDO("mysql:host=$db_host;dbname=$db_name",$db_user,$db_password);

			$SQLquery = "SELECT * FROM users WHERE user_name=? AND user_hash=?";
			$results = $pdo->prepare($SQLquery);

		// check if query returned any results
		if( $results->execute(array($signUpName, md5($signUpPass))) )
		{
     // execute the query and check for a non match in the users table
		 if( $results->rowCount() == 0 )
			{
				
			  // we have no match so we can create the session variables here
			   $pdo = NULL;
			 require"connect.php" ;
			  $signUppassmd5 = md5($signUpPass);
			  
			  	$pdo_link = new PDO("mysql:host=$db_host;dbname=$db_name",$db_user,$db_password);                               
			       $sqlQuery = "INSERT INTO users (user_name, user_hash) VALUES('$signUpName','$signUppassmd5')";
				   
				    $result = $pdo_link->query($sqlQuery);
				   $sqlQuery2 = "SELECT * FROM users WHERE user_name='$signUpName' AND user_hash='$signUppassmd5'";
				  
				    $results = $pdo_link->query($sqlQuery2);
				   
				   
			  
				  $row = $results->fetch( );
					$_SESSION['user_id'] = $row['user_id'];
					$_SESSION['user_name'] = $row['user_name'];
			        $userID = $_SESSION['user_id'];
			   echo"YES!!!!!!!!!!!";
			 
			 header("Location: index.php");
			}else{ 
							
				echo ' Sorry, pick another username or password';}
							
				 }
		

		}else{
					 // query has failed to run
					 echo"HELP";
					  $pdo = NULL;
			}
 }
		 
 

?>
</body>
</html>