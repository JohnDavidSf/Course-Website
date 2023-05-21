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

//Action selected
$action_type = $_POST['action'];

//Get the records from Add New Evaluation form
$evaluation_name = $_POST['evaluation_name'];
$evaluation_score = $_POST['evaluation_score'];
$evaluation_weight = $_POST['evaluation_weight'];

//time data
$timezone = date_default_timezone_get();
$current_time = date('Y-m-d h:i:s', time());

//Delete assignment
if($action_type === "delete"){
    $sql = "DELETE FROM Evaluation WHERE evaluation_name = '$evaluation_name'";
}

//Edit assignment
if($action_type === "edit"){
    //Update the evaluation weight
    if ($evaluation_weight !== "" and $evaluation_score === ""){
        $sql = "UPDATE Evaluation SET evaluation_weight='$evaluation_weight', updated_at='$current_time' WHERE evaluation_name='$evaluation_name'";
    }

    //Update the evaluation score
    if ($evaluation_score !== "" and $evaluation_weight === ""){
        $sql = "UPDATE Evaluation SET evaluation_score='$evaluation_score', updated_at='$current_time' WHERE evaluation_name='$evaluation_name'";
    }

    //Update the evaluation weight and score
    if ($evaluation_score !== "" and $evaluation_weight !== ""){
        $sql = "UPDATE Evaluation SET evaluation_weight='$evaluation_weight', evaluation_score='$evaluation_score', updated_at='$current_time' WHERE evaluation_name='$evaluation_name'";
    }
}


 if ($con->query($sql) === TRUE) {
    header('Location: EvaluationManagement.php');
	exit;
  } else {
    echo "Error: " . $sql . "<br>" . $con->error;
  }


