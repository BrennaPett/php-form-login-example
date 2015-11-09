<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Assignment 2 Form</title>
</head>

<body>
<h1>Update Student Information</h1>
<?php 

include('dbinfo.php');

session_start();

if( isset($_GET['id'])){
	$idGet 			= $_GET['id'];
	$firstnameGet 	= $_GET['firstname'];
	$lastnameGet	= $_GET['lastname'];
	//echo $id;
}

$arrayOfTableInformation 	= array();
$arrayOfFormErrors 			= array();
$idValidationExpression		= "/^[a-z]00[0-9]{6}$/i";

if( empty($_POST['firstname']) && empty($_POST['lastname'])){
	echo "<p>error names</p>";
	$arrayOfFormErrors[] = "<p>You need to fill in the Firstname and Lastname.</p>";
}else{
	echo "<p>You filled in the firstname and lastname section</p>";
}

$firstname 			= trim($_POST['firstname']);
$lastname			= trim($_POST['lastname']);
$inputId			= trim($_POST['id']);
$id					= preg_match( $idValidationExpression, $inputId );

if( $idGet == $inputId && $firstnameGet == $firstname && $lastnameGet == $lastname){
		$arrayOfFormErrors[] = "<p>You can not update if none of the fields are changed.</p>";
		$_SESSION['errorMessages'] = $arrayOfFormErrors;
		header("Location: update-student-form.php?id=$idGet&firstname=$firstnameGet&lastname=$lastnameGet");
		die();
}else{

	if( $id == 0 ){
		$arrayOfFormErrors[] = "<p>Student Number is not valid.</p>";
		$_SESSION['errorMessages'] = $arrayOfFormErrors;
		echo "<p>Student Number is not valid</p>";
	}else{
		echo "<p>student number is valid</p>";
	}
	
	if(count($arrayOfFormErrors) == 0){
		echo "<p>No errors</p>";
		
		$myDatabase = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		if(  mysqli_connect_errno() != 0  ){
			die("<p>Not connected</p>");
		}else{
			echo "<p>Connected</p>";
		}
		
		$safeFirstname 	= $myDatabase->real_escape_string( $firstname );
		$safeLastname 	= $myDatabase->real_escape_string( $lastname );
		$safeId 		= $myDatabase->real_escape_string( $inputId );
	
		$query = "UPDATE students SET firstname='$safeFirstname',lastname='$safeLastname', id='$safeId' WHERE id='$idGet';";
	
		$results = $myDatabase->query($query);
	
		$arrayOfTableInformation[] = "<p>The following Student information for $idGet has been changed to: $safeId, $safeFirstname $safeLastname.</p>";
		$_SESSION['tableInformation'] = $arrayOfTableInformation;
		
		header("Location: table.php");
		$myDatabase->close();
		die();
		
	}else{
		
		$_SESSION['errorMessages'] = $arrayOfFormErrors;
		echo "<p>there are errors</p>";
		echo $arrayOfFormErrors;
		header("Location: update-student-form.php?id=$idGet&firstname=$firstnameGet&lastname=$lastnameGet");
		die();
	}

}
?>








</body>
</html>