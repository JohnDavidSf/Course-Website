<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}

if (isset($_SESSION['loggedin']) && $_SESSION['user_type']=="student") {
    header('Location: HomeStudent.php');
}

if (isset($_SESSION['loggedin']) && $_SESSION['user_type']=="teacher") {
    header('Location: HomeTeacher.php');
}

?>
