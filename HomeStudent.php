<?php
session_start();
// If the user is not logged in or not a student, redirect to the login page...
if (!isset($_SESSION['loggedin']) || $_SESSION['user_type'] != "student") {
    header('Location: login.html');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>HOME-SOEN287</title>
    <link rel="stylesheet" href="styles.css">
</head>

<header>
    <div class="profile">
            <a href="ProfileEdit.php">Profile</a>
    </div>
    <div class="logout">
        <a href="Logout.php"> Logout</a>
    </div>
    <div class="titlelogo">
        <a href="Home.php">
            <img src="WebTitle.png" width="200" height="50">
        </a>
    </div>
</header>

<div class="nav">
    <div class="navright">
        <div class="navitem"><a href="CourseInfo.php">Course Info</a></div>
        <div class="navitem"><a href="AssignmentInfo.php">Assignment Details</a></div>
        <div class="navitem"><a href="ViewGradesStudents_update.php">My Grades</a></div>
    </div>
</div>


<body>
    <div class="bg-container">
        <div class="text-center">
            <h2>SOEN 287: Web programming</h2>
            <p>
                Department of Computer Science and Software Engineering
            </p>
        </div>
    </div>
    <div class="bd-container">

    </div>
</body>



<footer>
    <div class="ft">
        <div class="footleft">SOEN 287&emsp;&emsp;Fall 2022</div>
        <a href="https://www.concordia.ca">
            <img src="cu_logo.png" alt="Concordia University Logo" width="300" height="40" text-align="RIGHT" />
        </a>
    </div>
</footer>

</html>