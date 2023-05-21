<?php

session_start();
// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'P@$$w0rd';
$DATABASE_NAME = 'SOEN287';

$con= mysqli_connect($DATABASE_HOST,$DATABASE_USER,$DATABASE_PASS,$DATABASE_NAME);
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>


<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset = "utf-8">
        <title> My Grades-SOEN287</title>
        <link rel="stylesheet" href="ViewGradesStudents.css">
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
            <div class="navitem"><a href="ViewGradesStudents_update.php">My Grades</a></div>
        </div>
    </div>

    <body class = "grades-box">
        <h1 class = "title"> Marks and assessments</h1>
        <h4 class= "information"> 
            You need to receive a grade over 50% in <u>both</u> the midterm and the final examination to pass the course, regardless of your grade in other components of the course.
        </h4>

        <div class = "my-grades-box">
            <h2 class = "title">My grades</h2>

            <table style = "width: 60%" class = "table">

            
                <?php
                #Get the logged in user's grades //Tested, functions properly
                $student = $_SESSION['user'];
                $query=  "SELECT evaluation_name, comments, grade FROM grades WHERE student_id = '".$student."'";
                $stmt = $con->prepare($query);
                $stmt->execute();
                // returns mysqli_result object
                $this_student = $stmt->get_result();
                $query = "SELECT evaluation_weight, evaluation_name FROM evaluation";
                $stmt = $con->prepare($query);
                $stmt->execute();
                $compare = $stmt->get_result();
                ?>
            
                

               
                <tr class = table title>
                 <th>Assessments</th>
                 <th> Grade</th>
                 <th> Weight</th>
                 </tr>
                
                 <?php
                 $totalWeight = 0;
                 $finalGrade = 0;
                foreach($this_student as $row):{
                    echo "<tr>";
                    echo "<td>" . $row['evaluation_name'] . "</td>";
                    $name = $row['evaluation_name'];
                    $grade = $row['grade'];
                    echo "<td>" . $grade . "</td>";
                    foreach($compare as $row):{
                        if($row['evaluation_name'] == $name):{
                            $weight = $row['evaluation_weight'];
                            echo "<td>" . $weight . "</td>";
                             $totalWeight = $totalWeight + $weight;
                             $finalGrade = $weight/100 * $grade + $finalGrade;
                            break;
                        }
                                 endif;
                    }
                    endforeach;
                   // echo "<td>" . $weight . "</td>";
                    echo "</tr>";
                }
            endforeach;
                
               echo "</table>";

               $myGrade = 0;
               
               

               //Displays final grade when all the grades have been posted
               if ($totalWeight == 100){

              echo"<h2 class = \"title\">Final Grade: " . $finalGrade ."/100"."</h2>";
               } else {
                echo"<h2 class = \"title\">Final Grade: Not calculated </h2>";
                 }
                 ;
            ?>
            </table>

            
        </div>
        <div class = "letter-grade-CGPA-relationship\=">
            <h2 class = "title">Letter grade/CGPA relationship</h2>

            <table style = "width:50%" class="table">
                <tr class = "table title\">
                    <th>Letter grade</th>
                    <th> CGPA</th>
                </tr>
                
                <tr class = "table data">
                    <td> 
                        <p>A+</p>
                        <p>A</p>
                        <p>A-</p>
                    </td>
                    <td>
                        <p>4.30</p>
                        <p>4.00</p>
                        <p>3.70</p>
                    </td>
                </tr>
                <tr class = "table data">
                    <td> 
                        <p>B+</p>
                        <p>B</p>
                        <p>B-</p>
                    </td>
                    <td>
                        <p>3.30</p>
                        <p>3.00</p>
                        <p>2.70</p>
                    </td>
                </tr>
                <tr class = "table data">
                    <td> 
                        <p>C+</p>
                        <p>C</p>
                        <p>C-</p>
                    </td>
                    <td>
                        <p>2.30</p>
                        <p>2.00</p>
                        <p>1.70</p>
                    </td>
                </tr>
                <tr class = "table data">
                    <td> 
                        <p>D+</p>
                        <p>D</p>
                        <p>D-</p>
                    
                    </td>
                    <td>
                        <p>1.30</p>
                        <p>1.00</p>
                        <p>0.70</p>
                    </td>
                </tr>
                
                
            </table>
            
        </div>
        <div class = "their grades box">
            <h2 class = "title">Class grades</h2>

           <table style = "width:100%" class="table">
            <tr class="table title">

           

           


           <th>Assessment</th>
            <th>Your grade</th>
            <th>Class average</th>
            <th>Your class rank</th>
            <th>Median grade</th>
           </tr>
            
           <?php


           function findRank( $assessment){
            $DATABASE_HOST = 'localhost';
            $DATABASE_USER = 'root';
            $DATABASE_PASS = 'P@$$w0rd';
            $DATABASE_NAME = 'SOEN287';

            $con= mysqli_connect($DATABASE_HOST,$DATABASE_USER,$DATABASE_PASS,$DATABASE_NAME);

            $student = $_SESSION['user'];
            $query = "SELECT id, student_id FROM grades WHERE assessment = $assessment ORDER BY grade DESC";
            $stmt = $con->prepare($query);
            $stmt ->execute();
            $rows = $stmt->get_result();
            $rank = 1;
            //Finding rank of logged in student
            foreach($rows as $row):{
                if ($row['student_id'] == $student){
                    return $rank;
                } else {
                    $rank = $rank +1;
                }
            }
        endforeach;
        }

        function findMedian( int $assessment){
            $DATABASE_HOST = 'localhost';
            $DATABASE_USER = 'root';
            $DATABASE_PASS = 'P@$$w0rd';
            $DATABASE_NAME = 'SOEN287';

            $con= mysqli_connect($DATABASE_HOST,$DATABASE_USER,$DATABASE_PASS,$DATABASE_NAME);

            $query = "SELECT grade FROM grades WHERE assessment = $assessment ";
            $stmt = $con->prepare($query);
            $stmt ->execute();
            $result = $stmt->get_result();
            $array = array();
            $i = 0;
            
           //creating array with grades for this assessment
            while($row = mysqli_fetch_array($result)){
                $array[$i] = $row;
                $i++;
            }
            sort($array);
            $nbOfRows= sizeof($array);
            $midValue = floor($nbOfRows/2);

            //number of rows is odd
            if ($nbOfRows % 2 == 1){
              return $array[$midValue][0];
            } else //number of rows is even
             {
              return  ($array[$midValue][0] + $array[$midValue-1][0])/2;
            }
  
        }
           
               //Get number of students from student_login table
               $maxId = "SELECT id FROM student_login where validate = 1";
               $stmt = $con->prepare($maxId);
                $stmt->execute();
                $result = $stmt->get_result();
               $nbOfStudents = mysqli_num_rows($result);
               

               //Getting the number of distinct assessments in the grades table
               $nbOfAssessments =  "SELECT evaluation_id FROM evaluation";
               $stmt= $con->prepare($nbOfAssessments);
               $stmt->execute();
               $result = $stmt->get_result();
               $nbOfAssessments = mysqli_num_rows($result);
               $assessmentsArray = [$nbOfAssessments];
           $i = 0;

               #Get values (1 of 1) from the evaluation table, run through them one by one
               #echo $nbOfAssessments;
              

               //Getting all the grades from the grades table
               $allGrades= "SELECT grade FROM grades ORDER BY grade DESC ";
               $stmt= $con->prepare($allGrades);
               $stmt->execute();
               $allGrades = $stmt->get_result();
               $i = 0;
           while ($row = mysqli_fetch_array($result)) {
               $assessment = intval($row['evaluation_id']);

               //Collecting grades of each assessment for the average
               
                   $theirGrade = 0;
                   $examtype = "SELECT grade, evaluation_name, student_id FROM grades WHERE assessment = $assessment";
                   $stmt = $con->prepare($examtype);
                   $stmt->execute();
                   $this_exam = $stmt->get_result();
    


                   //When  the grades for an assessment have been entered for all the students
                   if (mysqli_num_rows($this_exam) == $nbOfStudents) {

                       //Find the rank of the logged in student
                       $rank = findRank($assessment);
                       $student = $_SESSION['user'];

                       foreach ($this_exam as $row): {
                               $theirGrade = $row['grade'] + $theirGrade;
                           if ($row['student_id'] == $student) {
                               $myGrade = $row['grade'];
                           }
                           ;
                               $exam_type = $row['evaluation_name'];
                               $rank = findRank($assessment);
                               $median = findMedian($assessment);

                           }
                       endforeach;
                       $average = $theirGrade / $nbOfStudents;
                       //Printing the table with the
                       echo "<tr> 
                    <td>" . $exam_type . "</td>
                    <td>" . $myGrade . "</td>
                    <td>" . $average . "</td>
                    <td>" . $rank . "</td>
                    <td>" . $median . "</td>
                    </tr>";

                   } else {
                       break;
                   }
               }
           
           ;
                
               


              
              ?>
                
         </table>
            
            
        </div>
    </body>
    
    <!-- placeholder -->
    <div class="bd-container">

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


<!--Citation
Information for letter grade/CGPA relationship:
Concordia University, 2022,\"GPA and academic performance\", accessed: 12/10/2022
Double pass information:
BENHARREF Abdelghani, 2022, \"SOEN 287: COncordia University Web Programming (3 Credits) Fall 2022 Course Outline/Syllabus\", accessed: 14/10/2022
-->
