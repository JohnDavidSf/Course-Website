<?php
session_start();
// If the user is not logged in or is not a teacher-user, redirect to the login page...
if (!isset($_SESSION['loggedin']) || $_SESSION['user_type']!="teacher") {
	header('Location: login.html');
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Evaluation Management - SOEN287</title>
        <link rel='stylesheet' href = "Evaluation.css">
        <link rel='stylesheet' href = "styles.css"> 

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
        <!-- A button to open the popup form -->
        <div class="btn-container">
            <button class="main-button" onclick="openNew()">Add New</button>
            <button class="main-button" onclick="openEdit()">Edit/Delete</button>
        </div>
        
        
    </body>

    <!-- Form to add new evaluation -->
    <div class = "form-popup" id = "new-eval">
        <form name="new-eval" method="post" action="Evaluation.php" class="form-container">
            <h2>Add New Evaluation</h2>

            <label for="evaluation_name"><b>Evaluation Name</b></label>
            <input type="text" placeholder="Enter the evaluation name" name="evaluation_name" required>

            <label for="evaluation_score"><b>Evaluation Score</b></label>
            <input type="text" placeholder="Enter the total score" name="evaluation_score" required>
            
            <label for="evaluation_weight"><b>Evaluation Weight</b></label>
            <input type="text" placeholder="Enter the weight in %" name="evaluation_weight" required>

            <div class="btn-container-center">
                <button type="submit" class="btn">Add</button>
                <button type="button" class="btn cancel" onclick="closeNew()">Close</button>
            </div>
            
        </form>
    </div>

      <!-- Form to edit evaluation -->
      <div class = "form-popup" id = "edit-eval">
        <form name="edit-eval" method="post" action="/EvaluationEdit.php" class="form-container">
            <h2>Edit Existing Evaluation</h2>
            <!-- <label for="action_type"><b>Choose action:</b></label> -->
            <select name="action" required>
                <option value="edit">Edit</option>
                <option value="delete">Delete</option>
            </select>
            <br><br>
            <label for="evaluation_name"><b>Evaluation Name</b></label>
            <input type="text" placeholder="Enter the evaluation name" name="evaluation_name" required>

            <label for="evaluation_score"><b>Evaluation Score</b></label>
            <input type="text" placeholder="Enter the total score" name="evaluation_score">

            <label for="evaluation_weight"><b>Evaluation Weight</b></label>
            <input type="text" placeholder="Enter the weight in %" name="evaluation_weight">

            <div class="btn-container-center">
                <button type="submit" class="btn">Submit</button>
                <button type="button" class="btn cancel" onclick="closeEdit()">Close</button>
            </div>
            
        </form>
    </div>

    <!--Table with data from table-->
    <?php
        $DATABASE_HOST = 'localhost';
        $DATABASE_USER = 'root';
        $DATABASE_PASS = 'P@$$w0rd';
        $DATABASE_NAME = 'SOEN287';
        
        $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
        if ( mysqli_connect_errno() ) {
            // If there is an error with the connection, stop the script and display the error.
            exit('Failed to connect to MySQL: ' . mysqli_connect_error());
        }
        
        $result = mysqli_query($con,"SELECT * FROM Evaluation");
        
        echo "<table border = '1' margin-left = 'auto' margin-right ='auto'>
        <tr>
        <th>Evaluation ID</th>
        <th>Evaluation Name</th>
        <th>Evaluation Score</th>
        <th>Evaluation weight</th>
        <th>Updated by</th>
        <th>Updated at</th>
        </tr>";
        
        while($row = mysqli_fetch_array($result))
        {
        echo "<tr>";
        echo "<td>" . $row['evaluation_id'] . "</td>";
        echo "<td>" . $row['evaluation_name'] . "</td>";
        echo "<td>" . $row['evaluation_score'] . "</td>";
        echo "<td>" . $row['evaluation_weight'] . "</td>";
        echo "<td>" . $row['updated_by'] . "</td>";
        echo "<td>" . $row['updated_at'] . "</td>";
        echo "</tr>";
        }
        echo "</table>";

        $query = mysqli_query($con , "SELECT sum(evaluation_weight) FROM Evaluation");
        $row = mysqli_fetch_array($query);
        $sumOfWeights = $row[0];

        echo "<p style ='font-family:sans-serif, Arial, Helvetica; font-size: 14px; font-style: italic; margin-left: 12px'> Sum of weights: $sumOfWeights </p>";
        
        mysqli_close($con);


    ?>

    <script>
        function openNew() {
            document.getElementById("edit-eval").style.display = "none";
            document.getElementById("new-eval").style.display = "block";
        }
            
        function closeNew() {
            document.getElementById("new-eval").style.display = "none";
        }


        function openEdit() {
            document.getElementById("new-eval").style.display = "none";
            document.getElementById("edit-eval").style.display = "block";
        }
            
        function closeEdit() {
            document.getElementById("edit-eval").style.display = "none";
        }
    </script>

<!-- placeholder -->
<div class="content-container"></div>
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