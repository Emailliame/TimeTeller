<?php
session_start();
//delete.php

if(isset($_POST["id"]))
{
 $connect = new PDO('mysql:host=localhost;dbname=test', 'gayatri', '');
 $user = $_SESSION['id'];
 $query = "
 DELETE from events WHERE id=:id and user_id='$user'
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':id' => $_POST['id']
  )
 );
}

?>
