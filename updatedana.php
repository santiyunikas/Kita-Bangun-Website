<?php
//include('dbconnected.php');
include_once('connection.php');

$id = $_GET['id'];

	$query="SELECT NOMINAL, ID_DONASI FROM pembayaran WHERE ID_BAYAR = $id ";
	$res= mysqli_query($conn, $query);
	if ($rows = mysqli_num_rows($res) == 1){
		$row_akun = mysqli_fetch_array($res);
		$nominal = $row_akun["NOMINAL"];
		$donasi = $row_akun["ID_DONASI"];
		$query2="SELECT TERKUMPUL FROM donasi WHERE ID_DONASI= '$donasi'";
		$res2= mysqli_query($conn, $query2);
		if ($rows2 = mysqli_num_rows($res2) == 1) {
			$row_akun2 = mysqli_fetch_array($res2);
			$terkumpul = $row_akun2["TERKUMPUL"];
			$jumlahakhir = $nominal + $terkumpul;
			$query3="UPDATE donasi SET TERKUMPUL = '$jumlahakhir' WHERE ID_DONASI = $donasi";
			mysqli_query($conn, $query3);
			$query4="UPDATE pembayaran SET STATUS_BAYAR = '2' WHERE ID_BAYAR = $id";
			mysqli_query($conn, $query4);
			header("Location:pengajuan.php");
		}
	}
	else{
		echo "<script>alert('Maaf, Pembayaran Gagal');history.go(-1)</script>";
	}
