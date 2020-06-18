<?php

//insert.php
session_start();
$connect = new PDO('mysql:host=localhost;dbname=test', 'gayatri', '');

if(isset($_POST["title"]))
{
 $user = $_SESSION['id'];
 $query = "
 INSERT INTO events 
 (title, start_event, end_event,user_id) 
 VALUES (:title, :start_event, :end_event,'$user')
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end']
  )
 );
	

}


?>