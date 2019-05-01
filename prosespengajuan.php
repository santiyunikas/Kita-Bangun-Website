<?php
session_start();
include 'connection.php';

$judul = $_POST['judul'];
$target = $_POST['target'];
$durasi = $_POST['durasi'];
$nomer = $_POST['nomer'];
$alamat = $_POST['alamat'];
$deskripsi = $_POST['deskripsi'];
$member = $_SESSION["id_akun"];

$ada=true;
while($ada) {
  $rand=rand(1001,9999);
  $sql="SELECT * FROM donasi WHERE ID_DONASI = '$rand'";
  $rs=mysqli_query($conn, $sql);
  if(mysqli_num_rows($rs) > 0){
    $ada=true;
  } else {
    $ada=false;
  }
}

if (isset($_FILES['image'])) {
  if (isset($_POST['ajuan'])) {
  $query="SELECT * FROM member WHERE ID_MEMBER= '$member'";
  $res= mysqli_query($conn, $query);
  if ($rows = mysqli_num_rows($res) == 1) {
    $row_akun = mysqli_fetch_array($res);
    $idmember = $row_akun["ID_MEMBER"];
    $namamember = $row_akun["NAMA"];
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
        $namabaru = $rand.".".$tipe2[1];
        // Simpan ke Database
        $query="INSERT INTO donasi(ID_MEMBER, NAMA, ID_DONASI, NOMINAL, TERKUMPUL, WAKTU_BERAKHIR, JUDUL_DONASI, ALAMAT, NOMOR_TLP, DESKRIPSI, FOTO_LOKASI, STATUS_DONASI) VALUES('$idmember','$namamember','$rand','$target',0,'$durasi','$judul','$alamat','$nomer','$deskripsi','$namabaru','0')";
        if (!mysqli_query($conn, $query)) {
          echo"<script>alert('Gagal Input');history.go(-1)</script>";
        } else {         
        // Simpan di Folder Gambar
        move_uploaded_file($_FILES['image']['tmp_name'], "donasi/".$namabaru);
        header("location:index.php");
        }
      }
    }
  } else {
    echo "<script>alert('Maaf, Ada Yang Salah');history.go(-1)</script>";
  }
}
} else {
  echo "<script>alert('Gambar Belum Masuk');history.go(-1)</script>";
}
?>