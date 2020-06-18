<?php
session_start();
$_SESSION['loggedin'] = false;
$_SESSION['email'] = '';
$_SESSION['id'] = '';

$hostname = "localhost";
$username = "gayatri";
$password = "";
$database = "test";
$conn = new mysqli($hostname,$username,$password,$database);
if($conn->connect_error)
{
	die('Connection Failed'.$conn->connect_error);
}

if(isset($_POST['submit'])!= '')
{
          $email = $_POST['email'];
          $pass = $_POST['psw'];
		  
		  
		  
		  $sql1 = "Select id from userdetails where email = '$email' and pass = '$pass'";
		  $result = $conn->query($sql1);
		  
		  if($result->num_rows == 1){
			  $row = $result->fetch_assoc();
			  $_SESSION['id'] = $row['id'];
			  $_SESSION['loggedin'] = true;
              
			  $_SESSION['email'] = $_POST['email'];
			  $username = $_SESSION['email'];
			   $message =  'Successfully logged in with '.$username;
		       echo "<script type='text/javascript'>alert('$message');</script>";
			   $page = 'page1_front.php';
			   echo "<script type='text/javascript'>window.location.href='$page';</script>";
			   
			  
			 
		  }
		  
		  else
		  {
			  $username = $_POST['email'];
			 $message = 'Invalid EmailId or Password';
		     echo "<script type='text/javascript'>alert('$message');</script>";
			 
			 $page = 'page1_front.php';
			 echo "<script type='text/javascript'>window.location.href='$page';</script>"; 
		  }
		
}

?>

