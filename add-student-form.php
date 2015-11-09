<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Assignment 2 Form</title>

	<style>
	body{
		margin: 30px;
	}
	form{
		background-color:  #B4C8DC;
		margin: 30px;
		padding: 20px;
		width: 300px;
	}
	input{
		margin: 10px;
	}
    
    </style>

</head>

<body>
<?php 
session_start();

if( isset($_SESSION['errorMessages'])){
	
	$messages = $_SESSION['errorMessages'];
	
	echo "<h2>You have errors:</h2>";
	echo "<ul>";
	foreach( $messages as $oneMessage ){
		echo "<li>$oneMessage</li>";
	}
	echo "</ul>";
	
	unset($_SESSION["errorMessages"]);
}


?>


<h1>Input a New Student</h1>

<form method="POST" action="authorize-form.php">
		<label for="firstname">First Name:</label>
		<input type="text" name="firstname" id="firstname" /><br />
		<label for="lastname">Last Name:</label>
		<input type="text" name="lastname" id="lastname" /><br />
		<label for="id">Student ID:</label>
		<input type="text" name="id" id="id" /><br />
		<input type="submit" /><br />
	</form>



</body>
</html>