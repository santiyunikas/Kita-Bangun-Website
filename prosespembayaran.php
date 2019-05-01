<?php
session_start();
include 'connection.php';

$jumlah = $_POST["number"];
$bank = $_POST["bank"];
$member = $_SESSION["id_akun"];
$donasi = $_GET["id"];

$ada=true;
while($ada) {
  $rand=rand(10001,99999);
  $sql="SELECT * FROM pembayaran WHERE ID_BAYAR = '$rand'";
  $rs=mysqli_query($conn, $sql);
  if(mysqli_num_rows($rs) > 0){
    $ada=true;
  } else {
    $ada=false;
  }
}

if (isset($_POST['bayar'])) {
	$query="SELECT * FROM member WHERE ID_MEMBER= '$member'";
	$res= mysqli_query($conn, $query);
	if ($rows = mysqli_num_rows($res) == 1){
		$row_akun = mysqli_fetch_array($res);
		$idmember = $row_akun["ID_MEMBER"];
		$namamember = $row_akun["NAMA"];
		$query2="SELECT * FROM donasi WHERE ID_DONASI= '$donasi'";
		$res2= mysqli_query($conn, $query2);
		if ($rows2 = mysqli_num_rows($res2) == 1) {
			$row_akun2 = mysqli_fetch_array($res2);
			$iddonasi = $row_akun2["ID_DONASI"];
			$query3="INSERT INTO pembayaran(ID_MEMBER, NAMA, ID_DONASI, ID_BAYAR, NO_REKENING, NAMA_BANK, NOMINAL, WAKTU_TRANSAKSI, STATUS_BAYAR) VALUES('$idmember','$namamember','$iddonasi','$rand','123456789','$bank','$jumlah',now(),'0')";
			mysqli_query($conn, $query3);
			header("location:riwayat.php");
		}
	}
	else{
		echo "<script>alert('Maaf, Pembayaran Gagal');history.go(-1)</script>";
	}
}
	
?>