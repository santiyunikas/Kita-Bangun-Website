<?php
session_start();

include 'connection.php';

$email = $_POST['email'];
$pass = $_POST['password'];

if (isset($_POST['login'])) {
	$query="SELECT * FROM member WHERE EMAIL= '$email' AND PASSWORD= '$pass'";
	$res= mysqli_query($conn, $query);
	if ($rows = mysqli_num_rows($res) == 1){
		$row_akun = mysqli_fetch_array($res);
		$_SESSION["akun_nama"] = $row_akun["NAMA"];
		$_SESSION["id_akun"] = $row_akun["ID_MEMBER"];
		$id = $row_akun["ID_MEMBER"];
		$admin="SELECT * FROM member WHERE ID_MEMBER = '$id' AND ID_MEMBER < 100";
		$res1= mysqli_query($conn, $admin);
		if ($rows1 = mysqli_num_rows($res1) == 1) {
			header("location:adminpanel.php");
		} else {
			header("location:index.php");
		}
	}
	else{
		echo "<script>alert('Maaf, Anda Harus Login Terlebih dahulu. Silahkan Cek apakah Email dan Password anda sudah benar');history.go(-1)</script>";
	}
}
	
?>