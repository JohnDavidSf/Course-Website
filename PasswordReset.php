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

if (!isset($_POST['new-psw-input1'], $_POST['new-psw-input2']) || empty($_POST['new-psw-input1']) || empty($_POST['new-psw-input2'])) {
   mysqli_close($con);
   header('Location: ProfileEdit.php?error=1');
}

$new_psw_input1 = $_POST['new-psw-input1'];
$new_psw_input2 = $_POST['new-psw-input2'];

if (($new_psw_input1 == $new_psw_input2)) {
   $hashed_password = password_hash($new_psw_input1, PASSWORD_DEFAULT);
   $sql = "UPDATE `Student_Login` SET `password`='$hashed_password' WHERE user=$student";
   $result = mysqli_query($con, $sql);

   // Reading records
   $stmt = mysqli_prepare($con, "SELECT * FROM Student_Login");

   // Executing statement
   mysqli_stmt_execute($stmt);

   // Storing result
   mysqli_stmt_store_result($stmt);

   mysqli_close($con);
   header('Location: ProfileEdit.php?success=1');
} else {
   mysqli_close($con);
   header('Location: ProfileEdit.php?error=2');
}
