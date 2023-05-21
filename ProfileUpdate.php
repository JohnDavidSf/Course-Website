<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['user_type'] != "student") {
    header('Location: login.html');
    exit();
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'P@$$w0rd';
$DATABASE_NAME = 'SOEN287';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

$student = $_SESSION['user'];

$email = $_POST["email"];
$program = $_POST["program"];

$sql = "UPDATE `Student_Login` SET email='$email', program='$program' WHERE user=$student";
$result = mysqli_query($con, $sql);

// Reading records
$stmt = mysqli_prepare($con, "SELECT * FROM Student_Login");

// Executing statement
mysqli_stmt_execute($stmt);

// Storing result
mysqli_stmt_store_result($stmt);

mysqli_close($con);

header("Location: ProfileEdit.php");
?>