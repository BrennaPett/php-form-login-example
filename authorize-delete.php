<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Assignment 2</title>
</head>

<body>

<?php 
session_start();

include('dbinfo.php');

$arrayOfErrors 				= array();
$arrayOfTableInformation 	= array();

if( isset($_GET['id'])){
	

	$id 		= $_GET['id'];
	$firstname 	= $_GET['firstname'];
	$lastname	= $_GET['lastname'];

	//echo $id;
}

if( isset($_POST['delete'])){
	echo "<p>Thanks for choosing the answer</p>";
	
	if( $_POST['delete'] == 'no'){
		echo "<p>You answered no</p>";
		
		$arrayOfTableInformation[] = "<p>You didn't deleted $id $firstname $lastname.</p>";
		$_SESSION['tableInformation'] = $arrayOfTableInformation;
		
		header("Location: table.php");
		die();
		
	}else{
		
		echo "<p>you answered yes</p>";
		
		$myDatabase = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	 	if(  mysqli_connect_errno() != 0  ){
	  		die('<p>Not connected</p>');
	  	}else{
	  		echo "<p>Connected</p>";
	  	}
		
		$safeFirstname 	= $myDatabase->real_escape_string( $firstname );
		$safeLastname 	= $myDatabase->real_escape_string( $lastname );
		
		$query 			= "DELETE FROM students WHERE id='$id'";
		$results 		= $myDatabase->query($query);
		$arrayOfTableInformation[] = "<p>You have deleted $id $safeFirstname $safeLastname</p>";
		$_SESSION['tableInformation'] = $arrayOfTableInformation;
		
		header("Location: table.php");
		$myDatabase->close();
		die();
	}
	
	
}else{
	echo "<p>You didn't choose an answer</p>";
	
	$arrayOfErrors[] =  "<p>You need to choose an answer.</p>";
	
	header("Location: delete-form.php");
	die();
}




?>



</body>
</html>