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
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Profile Page - SOEN287</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        .profile-box {
            padding-left: 20px;
            letter-spacing: 0.7px;
        }

        h1 {
            font-weight: lighter;
        }

        table {
            color: #212529;
            border-collapse: separate;
            border-spacing: 0 15px;
            line-height: 28px;
            vertical-align: middle;
        }

        tr {
            width: 40px;
        }

        th,
        td {
            padding-right: 140px;
            text-align: left;
            font-weight: lighter;
        }

        th {
            position: relative;
            left: 0px;
        }

        td {
            border: 1px solid grey;
            border-radius: 2.2px;
            padding-left: 10px;
            width: 176px;
            height: 30px;
        }

        #user-id,
        #user-firstname,
        #user-lastname {
            background-color: #e9ecef;
        }

        #email-input,
        #program-select,
        #new-psw-input1,
        #new-psw-input2 {
            height: 30px;
            margin-bottom: 15px;
            padding-left: 9px;
            letter-spacing: 0.7px;
            font-size: 16px;
        }

        #email-input {
            margin-left: 182px;
            width: 314px;
        }

        #program-select {
            margin-left: 79px;
            width: 330px;
            height: 36px;
        }

        #profile-btn {
            margin: 20px 0;
        }

        #new-psw-input1 {
            margin-top: 20px;
            margin-left: 111px;
            margin-right: 17px;
            width: 315px;
        }

        #new-psw-input2 {
            margin-left: 45px;
            margin-bottom: 20px;
            width: 315px;
        }

        #psw-reset-box {
            border: grey solid 1px;
            border-radius: 3px;
            margin-left: -12px;
            width: fit-content;
        }

        #psw-label,
        #psw-conf-label {
            margin-left: 13px;
        }

        #psw-btn {
            margin-top: 10px;
            margin-left: 13px;
            margin-bottom: 20px;
        }
    </style>
</head>

<header>
        <div class="profile">
            <a href="ProfileEdit.php">Profile</a>
        </div>
        <div class="logout">
            <a href="Logout.php"> Logout</a>
        </div>
        <div class="titlelogo">
                <a href ="Home.php">
                    <img src="WebTitle.png"
                        width="200"
                        height="50">
                </a>
        </div>
</header>

    <div class="nav">
        <div class = "navright">
            <div class="navitem"><a href="CourseInfo.php">Course Info</a></div>
            <div class="navitem"><a href="AssignmentInfo.php">Assignment Details</a></div>
            <div class="navitem"><a href="ViewGradesStudents_update.php">View Grade</a></div>
        </div>
    </div>

<body>
    <div class="profile-box">
        <?php
        $student = $_SESSION['user'];

        // Display unchangeable user info using table
        $sql = "SELECT user, firstname, lastname FROM Student_Login WHERE user = $student";

        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<h1>" . $row["firstname"] . " " . $row["lastname"] . "</h1>";
                echo "<table>";
                echo "<tr>";
                echo "<th>Student ID</th>";
                echo '<td id="user-id">' . $row["user"] . "</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<th>First Name</th>";
                echo '<td id="user-firstname">' . $row["firstname"] . "</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<th>Last Name</th>";
                echo '<td id="user-lastname">' . $row["lastname"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
            exit();
        }

        // Display changeable user info using form
        $sql = "SELECT email, program FROM Student_Login WHERE user = $student";

        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo '<form action="ProfileUpdate.php" method="post">';
            echo '<label for="email">Email</label>';

            while ($row = mysqli_fetch_assoc($result)) {
                if (!isset($row["email"]) || empty($row["email"])) {
                    echo '<input id="email-input" type="email" placeholder="Email" name="email">' . "<br>";
                } else {
                    echo '<input id="email-input" type="email"' . 'value=' . $row["email"] . ' name="email">' . "<br>";
                }

                echo '<label for="program">Academic Program</label>';
                echo '<select id="program-select" name="program">';

                if (!isset($row["program"])) {
                    echo '<option value="null"></option>';
                } else {
                    echo '<option>' . $row["program"] . '</option>';
                }

                echo '<option value="Bachelor of Arts (BA)">Bachelor of Arts (BA)</option>';
                echo '<option value="Bachelor of Commerce (BComm)">Bachelor of Commerce (BComm)</option>';
                echo '<option value="Bachelor of Computer Science (BCompSc)">Bachelor of Computer Science (BCompSc)</option>';
                echo '<option value="Bachelor of Education (BEd)">Bachelor of Education (BEd)</option>';
                echo '<option value="Bachelor of Engineering (BEng)">Bachelor of Engineering (BEng)</option>';
                echo '<option value="Bachelor of Fine Arts (BFA)">Bachelor of Fine Arts (BFA)</option>';
                echo '<option value="Bachelor of Science (BSc)">Bachelor of Science (BSc)</option>';
                echo '</select>' . "<br>";

                echo "<input type='submit' id='profile-btn' value='Update profile' onclick=\"alert('Your profile has been updated successfully.');\" />";
                echo '</form>';
            }
        }

        echo '<h3>Password Reset</h3>';
        echo "<div id='psw-reset-box'>";
        echo '<form action="PasswordReset.php" method="post">';
        echo '<label id="psw-label" for="new-psw">New Password</label>';
        echo '<input id="new-psw-input1" type="password" placeholder="Enter your new password" name="new-psw-input1">' . "<br>";
        echo '<label id="psw-conf-label" for="new-psw">Confirm New Password</label>';
        echo '<input id="new-psw-input2" type="password" placeholder="Confirm your new password" name="new-psw-input2">' . "<br>";
        echo "<input type='submit' id='psw-btn' value='Change password' />";
        echo '</form>';
        echo '</div>';

        mysqli_close($con);

        // Display message after editing
        if (isset($_GET['success']) && $_GET['success'] == 1) {
            echo '<script>alert("Your password has been reset successfully.")</script>';
        } else if (isset($_GET['error']) && $_GET['error'] == 1) {
            echo '<script>alert("Please fill both password fields.")</script>';
        } else if (isset($_GET['error']) && $_GET['error'] == 2) {
            echo '<script>alert("Please make sure your passwords match.")</script>';
        }
        ?>
    </div>
</body>

<!-- placeholder -->
<div class="bd-container">

</div>

<footer>
    <div class="ft">
        <div class="footleft">SOEN 287&emsp;&emsp;Fall 2022</div>
        <a href="https://www.concordia.ca">
            <img src="cu_logo.png" alt="Concordia University Logo" width="300" height="50" text-align="RIGHT" />
        </a>
    </div>
</footer>

</html>