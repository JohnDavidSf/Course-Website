<?php
session_start();
// If the user is not logged in and is a teacher redirect to the login page...
if (!isset($_SESSION['loggedin']) || $_SESSION['user_type']!="teacher") {
	header('Location: login.html');
    exit;
}
$host    = "localhost";
$user    = "root";
$pass    = 'P@$$w0rd';
$db_name = "SOEN287";

//create connection
$con = mysqli_connect($host, $user, $pass, $db_name);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

//get results from database

if (isset($_POST['approve'])) {
    $con->query("UPDATE Student_Login SET validate=1 WHERE id={$_POST['approve']}");
 }
elseif (isset($_POST['deny'])) {
    $con->query("DELETE FROM Student_Login WHERE id={$_POST['deny']}");
 }
$result = mysqli_query($con, "SELECT firstname, lastname, user,id FROM Student_login WHERE validate=0");
?>

<!DOCTYPE html>
<html>
<head> 
    <title>Access Request List - SOEN 287</title>
    <link rel='stylesheet' type='text/css' media='screen' href='AccessRequestList.css'>
    <link rel='stylesheet' href='styles.css'>
    <style>
        table {
            margin: 15px auto;
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            font-family: sans-serif, Arial, Helvetica;
            letter-spacing: 0.5px;
        }

        th, td {
            padding: 5px;
            background-color: rgba(255,255,255,0.2);
            color: rgb(56, 57, 57);
            text-align: left;
        }

        th {
            font-size: 16px;
        }

        td {
            font-size: 15px;
        }

        td:nth-child(1) {
            width: 120px;
        }

        td:nth-child(2) {
            width: 180px;
        }

        td:nth-child(3) {
            width: 180px;
        }

        td:nth-child(4) {
            width: 90px;
            padding-left: 0px;
            margin-left: 0px;
            border: 0px;
        }

        tr:hover {
            background-color: rgb(233, 239, 250);
        }

        tr:first-child:hover {
            background-color: white;
        }

        tr:first-child{ 
            border-bottom: 1px solid;
            border-color: rgb(170, 170, 170);
        }

        button {
            letter-spacing: 1px;
            opacity: 0.8;
        }

        button:hover {
            opacity: 2;
        } 
    </style>
</head>

    <header>
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
                <div class="navitem"><a href="EvaluationManagement.php">Add Evaluation</a></div>
                <div class="navitem"><a href="AccessRequestList.php">Access Requests</a></div>
                <div class ="navitem"><a href = "AddGrades_update.php">Add Grade </a> </div>
                <div class="navitem"><a href="ViewGradesTeacher.php">View Grade</a></div>
            </div>
     </div>

<body>
    <table>
        <tr class = "tableHead">
            <th>Student ID</th>
            <!-- Want to make a function for this column that checks against data base and displays red/green box if student id is valid-->
            <th>First Name</th>
            <th>Last Name</th>
            <!-- button to add student to database if approved -->
            <th>Actions</th>
        </tr>
        <tr>
            <?php
                foreach($result as $line){
                    echo '<tr>';
                    echo '<td>' . $line['user'] . '<td>' . $line['firstname'] . '<td>' . $line['lastname'] . '</td>';
                    echo '<td><form method="post"><button type = "submit" name="approve" value=' . $line['id'] . '>Approve</button></form>';
                    echo '<td><form method="post"><button type = "submit" name="deny" value=' . $line['id'] . '>Deny</button></form>';
                    echo '</tr>';
                }
            ?>
        </tr>
    </table>
</body>

<!-- Place holder -->
<div class="content-container">

</div>

<footer>
    <div class="ft">
        <div class="footleft">SOEN 287&emsp;&emsp;Fall 2022</div>
        <a href = "https://www.concordia.ca">
            <img src = "cu_logo.png"
                alt = "Concordia University Logo"
                width = "300" 
                height = "50"
                text-align = "RIGHT"/>
        </a>
    </div>
</footer>

</html>