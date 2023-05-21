<?php
session_start();
// If the user is not logged in or is not a teacher-user, redirect to the login page...
if (!isset($_SESSION['loggedin']) || $_SESSION['user_type']!="teacher") {
    header('Location: login.html');
    exit;
}

?>
<?php
$csv = array();

// check there are no errors
if($_FILES['csv']['error'] == 0){
    $name = $_FILES['csv']['name'];
    $type = $_FILES['csv']['type'];
    $tmpName = $_FILES['csv']['tmp_name'];
    $mime_type = mime_content_type($_FILES['csv']['tmp_name']);

    // check the file is a csv
    if($mime_type === 'text/csv'){
        if(($handle = fopen($tmpName, 'r')) !== FALSE) {
            // necessary if a large csv file
            set_time_limit(0);

            $row = 0;

            while(($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                // number of fields in the csv
                $col_count = count($data);

                // get the values from the csv
                $csv[$row]['Student ID'] = $data[0];
                $csv[$row]['Grade'] = $data[1];
                $csv[$row]['Comments'] = $data[2];

                // inc the row
                $row++;
            }
            fclose($handle);
        }
        
        if(isset($_POST['evaluation2'])){
            $name = strip_tags($_POST['evaluation2']);

            $DATABASE_HOST = 'localhost';
            $DATABASE_USER = 'root';
            $DATABASE_PASS = 'P@$$w0rd';
            $DATABASE_NAME = 'SOEN287';
            
            $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
            if ( mysqli_connect_errno() ) {
                // If there is an error with the connection, stop the script and display the error.
                exit('Failed to connect to MySQL: ' . mysqli_connect_error());
            }
            
            //time data
            $timezone = date_default_timezone_get();
            $current_time = date('Y-m-d h:i:s', time());

            foreach (array_slice($csv,1) as $line) {        

            $username = $_SESSION['user'];
            $studentID_str = $line['Student ID'];
            $studentID = (int)($studentID_str);
            $grade_str = $line['Grade'];
            $grade = (int)($grade_str);
            $comment = $line['Comments'];
            
            $sql = "SELECT evaluation_id, evaluation_name FROM evaluation";
            $gradeInfo = mysqli_query($con, $sql);
                
                //Added to set the assessment number to the evaluation_id in the evaluations table
                while($row = mysqli_fetch_array($gradeInfo)){
                    if (strcmp(strtolower($name),strtolower($row['evaluation_name']))== 0){
                        
                        $assessment = $row['evaluation_id'];
                    }
                }
                 

            if(isset($name,$studentID,$grade) && $comment==""){
                $sql3 =  "INSERT INTO Grades (evaluation_name, student_id, grade, teacher, graded_at,assessment) 
                VALUES ('$name', '$studentID', '$grade', '$username', '$current_time','$assessment')";
            }
            elseif(isset($name,$studentID,$grade,$comment)){
                $sql3 =  "INSERT INTO Grades (evaluation_name, student_id, grade, comments, teacher, graded_at,assessment) 
                VALUES ('$name', '$studentID', '$grade', '$comment', '$username', '$current_time','$assessment')";
                $message = $line['Comments'];
            }
            if(isset($_POST['evaluation2'])){
                if ($con->query($sql3) === TRUE) {
                    header('Location: AddGrades_Update.php');
                  } else {
                    echo "Error: " . $sql3 . "<br>" . $con->error;
                  }
            }
        }
    }
    }
    else {
        echo '<script>
        alert("Incorrect file type uploaded, Please Upload CSV only");
         window.location.href="AddGrades_Update.php";
         </script>';
    }

}       

?>
