<?php
include 'connection.php';

$id_bayar = $_POST['pembayaran_id'];
if (isset($_POST['upload'])) {
  if (isset($_FILES['image'])) {
    $query="SELECT * FROM pembayaran WHERE ID_BAYAR= '$id_bayar'";
    $res= mysqli_query($conn, $query);
    if ($rows = mysqli_num_rows($res) == 1) {
      $row_akun = mysqli_fetch_array($res);
      $idbayar = $row_akun["ID_BAYAR"];
      if ($_FILES["image"]["size"] > 500000) {
      echo"<script>alert('Size Gambar Terlalu > 500 kb !');history.go(-1)</script>";
      } else {
        $exts = array('image/jpg','image/jpeg','image/JPG','image/JPEG','image/PNG','image/png');
        $tipe = $_FILES['image']['type'];
        if(!in_array(($tipe),$exts)) {
          echo"<script>alert('Type File Harus JPG/PNG');history.go(-1)</script>";
        } else {
          $fileName = $_FILES['image']['name'];
          $tipe2 = explode("/", $tipe);
          $namabaru = $idbayar.".".$tipe2[1];
          // Simpan ke Database
          $query="UPDATE pembayaran SET BUKTI_BAYAR = '$namabaru', STATUS_BAYAR = '1' where ID_BAYAR = '$idbayar'";
          if (!mysqli_query($conn, $query)) {
            echo"<script>alert('Gagal Input');history.go(-1)</script>";
          } else {         
          // Simpan di Folder Gambar
          move_uploaded_file($_FILES['image']['tmp_name'], "bukti/".$namabaru);
          header("location:index.php");
          }
        }
      }
    } else {
      echo "<script>alert('Maaf, Bukti Pembayaran Sudah Ada');history.go(-1)</script>";
    }
  } else {
    echo "<script>alert('Gambar Belum Masuk');history.go(-1)</script>";
  }
}
