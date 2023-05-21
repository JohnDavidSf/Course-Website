<?php
session_start();
// If the user is not logged in or is not a teacher-user, redirect to the login page...
if (!isset($_SESSION['loggedin']) || $_SESSION['user_type']!="teacher") {
    header('Location: login.html');
    exit;
}

?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset= "utf-8">
        <title> Add Grades - SOEN287</title>
        <link rel="stylesheet" href="ViewGradesTeacher.css">
        <link rel="stylesheet" href="styles.css">
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

        //get all evaluation types from the sql table
        $sql = "SELECT * FROM `Evaluation`";
        $all_evaluation = mysqli_query($con, $sql);
        $all_evaluation2 = mysqli_query($con, $sql);

    
    ?>
    
    <body>
        <div class = "AddForm">
            <h2>Add Grades per Student ID</h2>
            <form name="grading_student" method="post" action="AddGrades_update.php" class="form-container">    
                <label for="evaluationName"><b>Select Evaluation:</b></label>
                <select name="evaluation" required>
                    
                    <?php
                        while ($evaluation=mysqli_fetch_array($all_evaluation,MYSQLI_ASSOC)):;
                    
                    ?>
                    <option value="<?php echo $evaluation["evaluation_name"]; ?>"><?php echo $evaluation["evaluation_name"]?></option>
                    <?php endwhile;?>
                </select>
                <br>
                <label for="studentID"><b>Student ID</b></label>
                <input type="text" placeholder="Enter the student ID" name="student_id" pattern="[0-9]{8}" title="Eight characters only" required>
                <br>
                <label for="student_grade"><b>Grade</b></label>
                <input type="text" placeholder="Enter the total score" name="grade" pattern="[0-9]+" title="please enter number only" required>
                <br>
                <label for="student_comment"><b>Comment</b></label>
                <input type="text" placeholder="Enter comments" name="comment">
                <br>
                
                <input type="submit" value="Submit"/>
            </form>
        </div>
        <div class = "uploadForm">
            <h2>Add Grades via CSV</h2>
            <form action="csv_upload.php" method="post" enctype="multipart/form-data">
                    <label for="evaluationName2"><b>Select Evaluation:</b></label>
                <select name="evaluation2" required>
                    
                    <?php
                   
                        while ($evaluation2=mysqli_fetch_array($all_evaluation2,MYSQLI_ASSOC)):;
                        
                    ?>
                    <option value="<?php echo $evaluation2["evaluation_name"]; ?>">
                    <?php echo $evaluation2["evaluation_name"]?></option>
                    <?php endwhile;?>
                </select>
                <br>
                <input type="file" name="csv" id="fileToUpload" required>
                <input type="submit" value="Upload CSV" name="submit_file">
            </form>
        </div>
        
        <div class="table-container">

            <?php

                if(isset($_POST['evaluation'])){
                   
                $evaluation = strip_tags($_POST['evaluation']);
                $name = $_POST['evaluation'];
                
                //time data
                $timezone = date_default_timezone_get();
                $current_time = date('Y-m-d h:i:s', time());

                $username = $_SESSION['user'];
                $studentID_str = $_POST['student_id'];
                $studentID = (int)($studentID_str);
                $grade_str = $_POST['grade'];
                $grade = (int)($grade_str);
                $comment = $_POST['comment'];
                

                $sql = "SELECT evaluation_id, evaluation_name FROM evaluation";
                $gradeInfo = mysqli_query($con, $sql);
                
                //Added to set the assessment number to the evaluation_id in the evaluations table
                while($row = mysqli_fetch_array($gradeInfo)){
                    if (strcmp(strtolower($evaluation),strtolower($row['evaluation_name']))== 0){
                        
                        $assessment = $row['evaluation_id'];
                    }
                }
            }        
        

                if(isset($name,$studentID,$grade,) && $comment==""){
                    $sql3 =  "INSERT INTO Grades (evaluation_name, student_id, grade, teacher, graded_at,assessment) 
                    VALUES ('$name', '$studentID', '$grade', '$username', '$current_time', '$assessment')";
                }
                elseif(isset($name,$studentID,$grade,$comment)){
                    $sql3 =  "INSERT INTO Grades (evaluation_name, student_id, grade, comments, teacher, graded_at, assessment) 
                    VALUES ('$name', '$studentID', '$grade', '$comment', '$username', '$current_time', $assessment)";
                    $message = $_POST['comment'];
                }
                if(isset($_POST['evaluation'])){
                    if ($con->query($sql3) === TRUE) {
                        echo "New grade correctly Added";
                      } else {
                        echo "Error: " . $sql3 . "<br>" . $con->error;
                      }
                }

                $sql2 = "SELECT * FROM `Grades`";
                $q_result = mysqli_query($con, "SELECT * FROM Grades");

                echo "<table border = '1' margin-left = 'auto' margin-right ='auto'>
                <tr>
                <th>Evaluation</th>
                <th>Student ID</th>
                <th>Grade</th>
                <th>Comments</th>
                
                <th>Assessment</th>
                </tr>";
    
                while($row = mysqli_fetch_array($q_result))
                {
                        echo "<tr>";
                        echo "<td>" . $row['evaluation_name'] . "</td>";
                        echo "<td>" . $row['student_id'] . "</td>";
                        echo "<td>" . $row['grade'] . "</td>";
                        echo "<td>" . $row['comments'] . "</td>";
                        echo "<td>" . $row['assessment'] . "</td>";
                        echo "</tr>";
                }
                    
                echo "</table>";
            ?>
        </div>

       <!--  place holder -->
        <div class="content-container">
        </div>

    </body>  

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
