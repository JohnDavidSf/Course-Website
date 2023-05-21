<?php
session_start();
// If the user is not logged in or not a student, redirect to the login page...
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
        
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <body>

<?php 

//This is done because in ViewGrades.php we view the grade by assignment type (refer to variable $name = $_POST['evaluation'])
$evaluation_name = "Midterm";
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
    ?>

    
    <div style="width: 500px;">
    <canvas id="myChart"></canvas>
    </div>
    
    <script>
    
    
    var data = {
    labels: ['0-9','10-19','20-29','30-39','40-49','50-59' ,'60-69' ,'70-79' ,'80-89' ,'90-100'],
      
        datasets: [{
            label: 'Number of Student',
            backgroundColor: "yellow",
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
    </body>







    