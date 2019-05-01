<?php
//include('dbconnected.php');
include_once('connection.php');

$id = $_GET['id'];
//query upda
$result = MYSQLI_QUERY( $conn, "UPDATE donasi SET STATUS_DONASI='1' WHERE ID_DONASI =$id ");
//mysql_close($host);

header("Location:pengajuan.php");
?>