<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Assignment 2 Form</title>
</head>

<body>
<h1>Authorize</h1>
<?php 

include('dbinfo.php');

session_start();

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




if( $id == 0){
	$arrayOfFormErrors[] = "<p>Student Number is not valid.</p>";
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
	$safeId 	= $myDatabase->real_escape_string( $inputId );
	
	$query = "INSERT INTO students (id,firstname,lastname) VALUES( '$safeId','$safeFirstname','$safeLastname');";

	$results = $myDatabase->query($query);
	
	if( $results == true ){
		$arrayOfTableInformation[] = "<p>The following Student information has been inputed: $safeId, $safeFirstname $safeLastname.</p>";
		$_SESSION['tableInformation'] = $arrayOfTableInformation;
	
		header("Location: table.php");
		$myDatabase->close();
		die();
		
	}else{
		
		$arrayOfTableInformation[] = "<p>Sorry the following Student Already Exists.</p>";
		$_SESSION['tableInformation'] = $arrayOfTableInformation;
	
		header("Location: table.php");
		$myDatabase->close();
		die();
	}
	
	
	
}else{
	
	$_SESSION['errorMessages'] = $arrayOfFormErrors;
	echo "<p>there are errors</p>";
	echo $arrayOfFormErrors;
	header("Location: add-student-form.php");
	die();
}


?>








</body>
</html>