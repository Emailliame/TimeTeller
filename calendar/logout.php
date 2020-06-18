<?php
session_start();
$_SESSION['loggedin'] = false;
$_SESSION['email'] = '';
$_SESSION['id'] = '';
$page = '../page1_front.php';
echo "<script type='text/javascript'>alert('Sucessfully logout');window.location.href='$page';</script>"; 
?>