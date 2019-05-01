<?php
include 'connection.php';

$username = $_POST['name'];
$pass = $_POST['password'];
$email = $_POST['email'];
$repass = $_POST['repassword'];

$ada=true;
while($ada) {
  $rand=rand(101,999);
  $sql="SELECT * FROM member WHERE ID_MEMBER = '$rand'";
  $rs=mysqli_query($conn, $sql);
  if(mysqli_num_rows($rs) > 0){
    $ada=true;
  } else {
    $ada=false;
  }
}

if (isset($_POST['register'])) {
  $cekuser ="SELECT * FROM member WHERE NAMA = '$username' OR EMAIL = '$email'";
  $res = mysqli_query($conn, $cekuser);
  if(mysqli_num_rows($res) > 0) {
    echo "<script>alert('Maaf, Nama atau Email Sudah Digunakan');history.go(-1)</script>";
  } else {
    $query="INSERT INTO member(ID_MEMBER, NAMA, PASSWORD, EMAIL) VALUES('$rand','$username','$pass','$email')";
    if ($pass != $repass){
      echo "<script>alert('Maaf, Password Tidak Cocok');history.go(-1)</script>";
    } else {
      mysqli_query($conn, $query);
      header("location:index.php");
    }
  }
}

?>