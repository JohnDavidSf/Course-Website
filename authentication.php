<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'P@$$w0rd';
$DATABASE_NAME = 'SOEN287';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

#echo $_POST['user-id'];
#echo $_POST['password'];
#Registration of passwords needs to be done with the following command password_hash($_POST['password'], PASSWORD_DEFAULT);
#echo $_POST['user_type'];

if ( !isset($_POST['user-id'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}
if ($_POST['user_type'] == "teacher"){
    $usertype_database = "Teacher_Login";
    #echo $_POST['user_type'];
} elseif ($_POST['user_type'] == "student"){
    $usertype_database = "Student_Login";
    #echo $_POST['user_type'];
}
if ($stmt = $con->prepare("SELECT id, password, validate FROM $usertype_database WHERE user=?")) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $stmt->bind_param('s',$_POST['user-id']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password,$validate);
        $stmt->fetch();
        #echo $id;
        #echo $password;
        #echo $validate;

        if($validate == 0){
            #Account not Yet Validated
            $message = "Your account has not been yet validated by your Teacher, please wait";
                            echo "<script>
                            alert('$message');
                            window.location.href='login.html';
                            </script>";
                            exit;
            
        }
        else{
            if (password_verify($_POST['password'], $password)) {
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['user'] = $_POST['user-id'];
                $_SESSION['user_type'] = $_POST['user_type'];
                $_SESSION['id'] = $id;
                $time = date("Y-m-d H:i:s");
                $sqla= $con->prepare("UPDATE $usertype_database SET last_login='$time' WHERE id='$id'");
                $sqla->execute();
                if ($_SESSION['user_type']=="teacher") {
                    header('Location: HomeTeacher.php');
                }
                elseif ($_SESSION['user_type']=="student") {
                    header('Location: HomeStudent.php'); 
                }
                
            } else {
                #Bad password
                $message = "Incorrect password or username, please try again";
                            echo "<script>
                            alert('$message');
                            window.location.href='login.html';
                            </script>";
                            exit;
            }
        }

    } else {
        #Bad username
        $message = "Incorrect password or username, please try again";
                            echo "<script>
                            alert('$message');
                            window.location.href='login.html';
                            </script>";
                            exit;
    }

	$stmt->close();
}

?>