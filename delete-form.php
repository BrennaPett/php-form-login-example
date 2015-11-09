<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Assignment 2</title>
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
<div>
<h2>You are About to Delete Something!</h2>
<?php 
session_start();



if( isset($_GET['id']) ){
	$id 		= $_GET['id'];
	$firstname 	= $_GET['firstname'];
	$lastname	= $_GET['lastname'];
	//echo $id;
}

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

<form method="post" action="authorize-delete.php<?php echo "?id=$id&firstname=$firstname&lastname=$lastname" ?>">
	
     <fieldset> 
     
    	<legend>Do you really want to delete this student: <?php echo "$id $firstname $lastname" ?>?</legend>
        <input type="radio" name="delete" value="yes">Yes
		<br>
		<input type="radio" name="delete" value="no">No
        
    </fieldset>
    
        <input type="submit" /><br />
        
</form>

</div>

</body>
</html>