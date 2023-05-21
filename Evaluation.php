<?php
session_start();
// If the user is not logged in redirect to the login page...
//$message = $_SESSION['user_type'];
//echo "<script>alert('$message');</script>";
if (!isset($_SESSION['loggedin']) || $_SESSION['user_type']!="teacher") {
	header('Location: login.html');
    exit;
}

// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'P@$$w0rd';
$DATABASE_NAME = 'SOEN287';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

//Get the records from Add New Evaluation form
$evaluation_name = $_POST['evaluation_name'];
$evaluation_score = $_POST['evaluation_score'];
$evaluation_weight = $_POST['evaluation_weight'];
$evaluation_editweight = $_POST['edit_weight'];
$evaluation_editscore = $_POST['edit_score'];

//time data
$timezone = date_default_timezone_get();
$current_time = date('Y-m-d h:i:s', time());

$username = $_SESSION['user'];

//Insert data into database
$sql = "INSERT INTO Evaluation (evaluation_id, evaluation_name, evaluation_score, evaluation_weight, updated_by, updated_at) VALUES ('0', '$evaluation_name', '$evaluation_score', '$evaluation_weight', '$username', '$current_time')";

if ($con->query($sql) === TRUE) {
    header('Location: EvaluationManagement.php');
	exit;
  } else {
    echo "Error: " . $sql . "<br>" . $con->error;
  }
  ?>