<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Assignment 2</title>

	<style>
	body{
		padding: 30px;
	}
	table{
		background-color: #B4C8DC;
		margin: 30px 0;
		border-collapse: collapse;
	}
    tr:nth-of-type(odd){
		background-color: #F1F1F1;
		padding: 5px;
	}
    td{
		padding: 5px;
		text-align: center;
		border: 1px solid white;
	}
	th{
		padding: 5px;
		text-align: center;
	}
    </style>


</head>

<body>
<h1>PHP Assignment 2</h1>
<?php 

include('dbinfo.php');

session_start();

if( isset($_SESSION['tableInformation'])){
	
	$infoArray = $_SESSION['tableInformation'];
	
	
	echo "<ul>";
	foreach( $infoArray as $oneInfo ){
		echo "<li>$oneInfo</li>";
	}
	echo "</ul>";
	
	unset($_SESSION["tableInformation"]);
}

$myDatabase = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(mysqli_connect_errno() != 0){
	//echo "<p>You are not connected</p>";
	die();
}else{
	//echo "<p>You are connected</p>";
}

$query = "SELECT * from students";

$results = $myDatabase->query($query);

echo "<table>";

echo "<tr>";
echo "<th>#</th>";
echo "<th>Student Number</th>";
echo "<th>Firstname</th>";
echo "<th>Lastname</th>";
echo "<th colspan='2'><a href='add-student-form.php'>Add a Student</a></th>";


echo "</tr>";
while( $oneRowofData = $results->fetch_assoc() ){
	echo "<tr>";
	echo "<td>". $oneRowofData['primary_key']."</td>";
	echo "<td>". $oneRowofData['id']."</td>";
	echo "<td>". $oneRowofData['firstname']."</td>";
	echo "<td>". $oneRowofData['lastname']."</td>";
	echo "<td><a href='delete-form.php?id=".$oneRowofData['id']."&firstname=".$oneRowofData['firstname']."&lastname=".$oneRowofData['lastname']."'>Delete</a></td>";
	echo "<td><a href='update-student-form.php?id=".$oneRowofData['id']."&firstname=".$oneRowofData['firstname']."&lastname=".$oneRowofData['lastname']."'>Update</a></td>";
	echo "</tr>";
}

echo "</table>";

?>

</body>
</html>