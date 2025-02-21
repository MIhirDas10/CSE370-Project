<?php
session_start();

if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
}

include('dbcon.php');

$user_id = $_GET['id'];


$sql = "DELETE FROM attendance WHERE member_id='".$_GET["id"]."'";
$res = $con->query($sql) ;

?>
<script>

window.location = "../attendance.php";
</script>


 