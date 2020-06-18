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

if(isset($_REQUEST['submit'])!= '')
{

		  $sql1 = "Select * from userdetails where email = '".$_REQUEST['email']."'";
		  $result = $conn->query($sql1);
		  
		  if($result->num_rows >0){
			  $username = $_POST['email'];
			 $message = 'Oops! But Already registered with '.$username;
			 echo "<script type='text/javascript'>alert('$message');</script>";
			 $page = 'page1_front.php';
			 echo "<script type='text/javascript'>window.location.href='$page';</script>"; 
		  }
		  
		  else
		  {
			 $sql="insert into userdetails(email,pass) values('".$_REQUEST['email']."', '".$_REQUEST['psw']."')";
			 
			 if($conn->query($sql) === true)
			 {
			  $_SESSION['loggedin'] = true;
              $_SESSION['email'] = $_REQUEST['email'];
			  $em = $_SESSION['email'];
			  
			  $s1 = "SELECT id  FROM userdetails where email = '$em'";
              $result = $conn->query($s1);
			  if ($result->num_rows === 1) {
                 // output data of each row
                  $row = $result->fetch_assoc();
				  $_SESSION['id'] = $row['id'];
				  
				  echo 'Successfully Registered with email id '.$_POST['email'];
                  $page = 'page1_front.php';
			      echo "<script type='text/javascript'>window.location.href='$page';</script>";
			      
                } else {
                  echo "error";
                }

			 }
			 
			 else
	         {
		
		     $message = 'OOps ! Some unknown error';
		     echo "<script type='text/javascript'>alert('$message');</script>";
		     echo "Error: " . $sql . "<br>" . $conn->error;
	         }
		  }
		
}
?>
