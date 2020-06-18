<?php
session_start();
//update.php

$connect = new PDO('mysql:host=localhost;dbname=test', 'gayatri', '');

if(isset($_POST["id"]))
{
	$user = $_SESSION['id'];
 $query = "
 UPDATE events 
 SET title=:title, start_event=:start_event, end_event=:end_event 
 WHERE id=:id and user_id ='$user'
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end'],
   ':id'   => $_POST['id']
  )
 );
}

?>
