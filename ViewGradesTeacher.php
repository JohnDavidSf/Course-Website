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
        <title>Grade Distributions - SOEN 287</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="ViewGradesTeacher.css">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        
    ?>
    
    <body>
        <div>
            <h2>View Evaluation's Grade Distribution</h2>
            
            <form name="select-eval" method="post" action="ViewGradesTeacher.php" class="form-container">    
                <label for="evaluationName"><b>Select Evaluation:</b></label>
                <select name="evaluation" required>

                    <?php
                        while ($evaluation=mysqli_fetch_array($all_evaluation,MYSQLI_ASSOC)):;
                    ?>
                    <option value="<?php echo $evaluation["evaluation_name"]; ?>"><?php echo $evaluation["evaluation_name"]?></option>
                    <?php endwhile;?>
                </select>
                <button class="bt-submit" type="submit" name="submit">Submit</button>
            </form>
            <br><br>
            <?php
                if(isset($_POST['evaluation'])){
                    $name = $_POST['evaluation'];
                    $sql2 = "SELECT * FROM `Grades`";
                    $q_result = mysqli_query($con, "SELECT * FROM Grades WHERE evaluation_name='$name'");
                    echo "<table border = '1' margin-left = 'auto' margin-right ='auto'>
                    <tr>
                    <th>Evaluation</th>
                    <th>Student ID</th>
                    <th>Grade</th>
                    <th>Comments</th>
                    </tr>";
                    while($row = mysqli_fetch_array($q_result))
                    {
                        echo "<tr>";
                        echo "<td>" . $row['evaluation_name'] . "</td>";
                        echo "<td>" . $row['student_id'] . "</td>";
                        echo "<td>" . $row['grade'] . "</td>";
                        echo "<td>" . $row['comments'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";

                    

                }              
            ?>
        </div>
        <div class='avgTable'>
            <h4>Evaluation's Grade Average</h4>
        
            <?php
                if(isset($_POST['evaluation'])){
                    $avg_name = $_POST['evaluation'];
                    $sql3 = "SELECT * FROM `Grades`";
                    $avg_result = mysqli_query($con, "SELECT AVG(grade), evaluation_name FROM Grades Group BY evaluation_name");
                   
                   echo "<table border = '1' margin-left = 'auto' margin-right ='auto'>
                    <tr>
                    <th>Evaluation</th>
                    <th>Average</th>
                    </tr>";
                    while($row = mysqli_fetch_array($avg_result))
                    {
                        echo "<tr>";
                        echo "<td>" . $row['evaluation_name'] . "</td>";
                        echo "<td>" . $row['AVG(grade)'] . "</td>"; 
                    
                       
                        echo "</tr>";
                    }
                    echo "</table>";
            
                }  
                
            ?>
        
        </div>
        <script>
            function openChart(){
                document.getElementById("chart").style.display = "block";
            }
        </script>

        <div class="graph-container" id="chart">
            <?php
            if(isset($_POST['evaluation'])){
                $evaluation_name = $_POST['evaluation'];
                $con= mysqli_connect($DATABASE_HOST,$DATABASE_USER,$DATABASE_PASS,$DATABASE_NAME);
                $query = $con->query("
                SELECT 


                COUNT(DISTINCT id) AS TotalStudents,
                COUNT(DISTINCT IF(grade BETWEEN 90 and 100,
                        id,
                        NULL)) AS a100,
                COUNT(DISTINCT IF(grade BETWEEN 80 and 89,
                        id,
                        NULL)) AS a90,
                COUNT(DISTINCT IF(grade BETWEEN 70 and 79,
                        id,
                        NULL)) AS a80,
                COUNT(DISTINCT IF(grade BETWEEN 60 and 69,
                        id,
                        NULL)) AS a70,
                COUNT(DISTINCT IF(grade BETWEEN 50 and 59,
                        id,
                        NULL)) AS a60,
                COUNT(DISTINCT IF(grade BETWEEN 40 and 49,
                        id,
                        NULL)) AS a50,
                COUNT(DISTINCT IF(grade BETWEEN 30 and 39,
                        id,
                        NULL)) AS a40,
                COUNT(DISTINCT IF(grade BETWEEN 20 and 29,
                        id,
                        NULL)) AS a30,
                COUNT(DISTINCT IF(grade BETWEEN 10 and 19,
                        id,
                        NULL)) AS a20,
                COUNT(DISTINCT IF(grade BETWEEN 0 and 9,
                        id,
                        NULL)) AS a10
                                    
            FROM
            Grades Where evaluation_name = '$evaluation_name'
                ");
                foreach($query as $data)
                {
                    $a100[] = $data['a100'];
                    $a90[] = $data['a90'];
                    $a80[] = $data['a80'];
                    $a70[] = $data['a70'];
                    $a60[] = $data['a60'];
                    $a50[] = $data['a50'];
                    $a40[] = $data['a40'];
                    $a30[] = $data['a30'];
                    $a20[] = $data['a20'];
                    $a10[] = $data['a10'];
                    

                    
                }
                $grade_distribution = array($data['a10'],$data['a20'],$data['a30'],$data['a40'],$data['a50'],$data['a60'],$data['a70'],$data['a80'],$data['a90'],$data['a100']);
            }
                ?>

    
        <div style="width: 500px;">
            <canvas id="myChart"></canvas>
        </div>
        
        <script>
        
            var data = {
            labels: ['0-9','10-19','20-29','30-39','40-49','50-59' ,'60-69' ,'70-79' ,'80-89' ,'90-100'],
            
                datasets: [{
                    label: 'Number of Students',
                    backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                            ],
                    borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)'
                            ],
                    data: <?php echo json_encode($grade_distribution) ?>
                }
            ]
            };

        

            const config = {
                type: 'bar',
                data: data,
                options: {
                    scales: {
                        yAxes: [{
                            display: true,
                            ticks: {
                                min: 0,
                                max: 10
                            }
                        }]
                    }
                },
            };

            var myChart = new Chart(
                document.getElementById('myChart'),
                config
            );
        </script>
    </div>
        <!-- placeholder -->
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
