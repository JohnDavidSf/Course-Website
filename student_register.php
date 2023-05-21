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

#echo $_POST['studentid'];
#echo $_POST['password'];
#echo $_POST['firstname'];
#echo $_POST['lastname'];

if ( !isset($_POST['studentid'], $_POST['password'], $_POST['firstname'], $_POST['lastname']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}

$result = $con->query("SELECT id FROM Student_Login WHERE user = {$_POST['studentid']}");
if($result->num_rows >0) {
    $message = "Student ID already registered, Registration not completed, please try again";
                            echo "<script>
                            alert('$message');
                            window.location.href='register.html';
                            </script>";
                            exit;
    $con->close();
}


$usertype_database = "Student_Login";
    #echo $_POST['user_type'];
$time = date("Y-m-d H:i:s");
$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);



if ($stmt = $con->prepare("INSERT INTO $usertype_database (user,password,registered_on,firstname,lastname) VALUES (?,?,?,?,?)")) {
	# Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $stmt->bind_param('sssss',$_POST['studentid'],$hashed_password,$time,$_POST['firstname'],$_POST['lastname']);
	$stmt->execute();

	$stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link rel="stylesheet" href="registration_success.css" />
    <title>Registration Successful Page</title>
  </head>
  <body>
    <form>
      <div class="confirmation-message">
        <img src="green-hook-mark-green-circle.png" />
        <h2>SUCCESS!</h2>
        <p>
          Your registration request has been successfully transferred to the
          teacher. You will be able to log in once your request is approved.
        </p>
        <button type="submit" formaction="Login.html">OK</button>
      </div>
    </form>
  </body>
</html>