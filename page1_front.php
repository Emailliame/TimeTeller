<?php 
session_start();
 echo "<script type='text/javascript'>$('#signup_form').trigger('reset');</script>";
 echo "<script type='text/javascript'>$('#login_form').trigger('reset');</script>";
 ?>



<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="style_front.css">

<title>Time Teller</title>
<script src = "http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Quicksand" />
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src = "jfront.js"></script>
</head>
<body>

<!-- For Image -->
<div class = "bg" style = "height: 100%;"></div>  


<div class = "wrapper">


<nav>
<div class = "logo">TIME TELLER</div>
   <ul>
     <li><a class = "active" id="link-home" href = "#home">Home</a></li>
	 <li><a href = "calendar/index.php">Events</a></li>
	 <li><a href = "calendar/logout.php">Log out</a></li>
	 <li>
	 <a href = "#" onclick ="document.getElementById('id01').style.display='block'">Log in</a>
     </li>
	 <li><a href = "#" onclick ="document.getElementById('id02').style.display='block'">Sign up</a></li>
   </ul>
</nav>
<p class = "content">You will never find time for anything, If you want time you must make it.</p>

</div>




                                         <!--Page Login is here-->

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="login.php" method = "post" id = "login_form">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="container">
     <br><br> <label for="email" ><b>Email Id</b></label>
      <input type="email" placeholder="Enter EmailId" name="email" required>

      <label for="psw" ><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
        
      <button type="submit" class = "loginbtn" id= "submit" name = "submit">Login</button>
      
    </div>

    <div class="container" style="background-color:rgb(162,157,195,0.65)">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#" >password?</a></span>
    </div>
  </form>
</div>


                                                   <!-- Finish-->

                                             <!-- For Sign up-->

<div id="id02" class="signmodal">
  <span onclick="document.getElementById('id02').style.display='none'" class="signclose" title="Close Modal" >&times;</span>
  <form class="signmodal-content animate" action='signup.php' method='post' id="signup_form" accept-charset = 'UTF-8' onsubmit = "return validate();">
    <div class="signcontainer">
      <h1 style = "color : rgb(78,45,156,1)">Sign Up</h1>
      <p style = "color : rgb(78,45,156,1)">Please fill in this form to create an account.</p>
	  <span class = "text-danger" id = "error_para"></span>
      <hr>
	  
      <label for="email" style = "color : rgb(78,45,156,1)"><b>Email</b></label>
      <input type="email" placeholder="Enter Email" name="email" id="email" required>

      <label for="psw" style = "color : rgb(78,45,156,1)"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" id= "psw" pattern=".{8,}" 
	  title="Must contain at least 8 or more characters" required>

      <label for="psw-repeat" style = "color : rgb(78,45,156,1)"><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="psw-repeat" id = "psw-repeat"
       pattern=".{8,}" 
	   title="Must contain at least 8 or more characters" required>

      <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

      <div class="signclearfix">
        <button type="submit" class="signupbtn" name = "submit" id = "submit">Sign Up</button>
      </div>
    </div>
  </form>
</div>

<script type = "text/javascript">
// Get the modal
var modal = document.getElementById('id02');
var modal2 = document.getElementById('id01');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
  if(event.target == modal2){
	  modal2.style.display = "none";
  }
}

function validate()
{
	var error = "";
	var pass1 = document.getElementById("psw");
	var pass2 = document.getElementById("psw-repeat");
	
	
	if(pass1.value != pass2.value )
	{
		error = "Both Passwords must be same";
		document.getElementById("error_para").innerHTML = error;
		return false;
	}
	
	else
	{
		return true;
	}
}

// When the user starts to type something inside the password field
var myInput = document.getElementById("psw");
myInput.onkeyup = function() {
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>

                                                           <!--Finish-->


</body>
<!-- Messages -->
<?php 
	
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $message = 'You Login ! and Now set any events with EmailId -  '.$_SESSION['email'];
    echo "<script type='text/javascript'>alert('$message');</script>";
} 
 else {
    echo "<script type='text/javascript'>alert('Need login! before set any events and alarm');</script>";
}
?>
<!-- IN php-->

</html>
