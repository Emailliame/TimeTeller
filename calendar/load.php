<?php
session_start();
//load.php

$connect = new PDO('mysql:host=localhost;dbname=test', 'gayatri', '');

$data = array();
$user = $_SESSION['id'];

$query = "SELECT * FROM events where user_id ='$user' ORDER BY id";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
  'title'   => $row["title"],
  'start'   => $row["start_event"],
  'end'   => $row["end_event"]
 );
}

echo json_encode($data);

?>
