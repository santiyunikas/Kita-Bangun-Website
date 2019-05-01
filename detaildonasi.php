<!DOCTYPE html>
<?php

  include "connection.php";

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
$iddonasi = $_GET['id'];
$sql = "SELECT a.ID_DONASI, a.JUDUL_DONASI, b.NAMA, a.NOMINAL, a.DESKRIPSI, a.NOMOR_TLP, a.FOTO_LOKASI, a.TERKUMPUL, a.WAKTU_BERAKHIR FROM donasi a, member b WHERE a.ID_MEMBER = b.ID_MEMBER AND a.ID_DONASI = '$iddonasi'";
$query = mysqli_query($conn,$sql);

?>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kita Bangun</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="css/agency.min.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Kita Bangun</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item">
              <a class="nav-link" id="portfolio" href="index.php">Home</a>
            </li>
            <?php
              session_start();
              if(empty($_SESSION["akun_nama"])){?>
            <li class="nav-item">
              <a class="nav-link" id="portfolio" data-toggle="modal" href="#portfolioModal7">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="portfolio" data-toggle="modal" href="#portfolioModal8">Register</a>
            </li>
            <?php } else{?>
            <li class="nav-item">
              <a class="nav-link" id="portfolio" href="riwayat.php">Riwayat</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" data-toggle="dropdown" href="#"><?php echo $_SESSION["akun_nama"] ?> &nbsp&nbsp<i class="fas fa-user-circle fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">            
            <a class="dropdown-item fas fa-sign-out-alt fa-fw" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
            </li>      <?php }?>      
          </ul>
        </div>
      </div>
    </nav>

    <section id="contact">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 text-center">
              <h2 class="section-heading text-uppercase">Detail Donasi</h2>
              <h3 class="section-subheading text-muted">Kita Bangun.</h3>
            </div>
          </div>


    <!-- Portfolio Grid -->
    <section class="bg-light" id="portfolio">
      <div class="container">
            <div class="row">
              <?php
                if(mysqli_num_rows($query)>0){ ?>
                <?php
                  while($data = mysqli_fetch_array($query)){
                    $id = $data['ID_DONASI'];
                    $waktu_akhir = $data["WAKTU_BERAKHIR"];
                    date_default_timezone_set('Asia/Jakarta');
                    $date=date("Y-m-d h:i:sa");
                    $min = (strtotime($waktu_akhir) - strtotime($date)) / (60*60*24);
                    if ($min < 0) {
                      $durasi = 0;
                    } else {
                      $durasi = floor($min);
                    }
                  ?>
                ?>
              <div class="col-lg-8 mx-auto" align="center">
                  <!-- Project Details Go Here -->
                  <h2 class="text-uppercase" ><?php echo $data["JUDUL_DONASI"];?></h2>
                  <p class="item-intro text-muted" ><?php echo $data["NAMA"];?></p>
                  <img class="img-fluid d-block mx-auto" src="donasi/<?php echo $data['FOTO_LOKASI'] ?>" alt="" width="350px" height="197px">
                  <p><?php echo $data["DESKRIPSI"];?></p>
                  <ul class="list-inline">
                    <li>Target Penggalangan Donasi : Rp. <?php echo $data["NOMINAL"];?></li>
                    <li>Terkumpul : Rp. <?php echo $data["TERKUMPUL"];?></li>
                    <li>Sisa Durasi Penggalangan : <?php echo $durasi;?> Hari</li>
                  </ul>
                  <?php
                    $nominal = $data["NOMINAL"];
                    $terkumpul = $data["TERKUMPUL"];
                    if ($durasi == 0 || $terkumpul >= $nominal) { ?>
                      <h3>Donasi Selesai</h3>
                      <?php
                        $query5="UPDATE donasi SET STATUS_DONASI = '2' where ID_DONASI = '$id'";
                        mysqli_query($conn, $query5);
                    } else {
                    if(isset($_SESSION["akun_nama"])){?>
                    <h3>Kirimkan donasimu !</h3>
                    <form action="prosespembayaran.php?id=<?php echo $iddonasi ?>" method="POST">
                      <select class="form-control" id="bank" name="bank" oninvalid="this.setCustomValidity('Mohon Pilih Bank !')" oninput="setCustomValidity('')" required="required">
                          <option value="">Jenis Bank Yang Digunakan *</option>  
                          <option value="BRI">BRI</option>  
                          <option value="BNI">BNI</option>  
                          <option value="BTN">BTN</option>  
                          <option value="Mandiri">Mandiri</option>
                          <option value="BCA">BCA</option> 
                          <option value="Danamon">Danamon</option> 
                        </select>
                       <br></br>
                      <input class="form-control" id="number" name="number" type="number" placeholder="Jumlah Donasi Yang Ingin Dikirimkan *" min="10000" required="required" oninvalid="this.setCustomValidity('Mohon Isi Jumlah Donasi !')" oninput="setCustomValidity('')" >                  
                      <br>  
                    <button class="btn btn-primary" type="submit" name="bayar">
                      <i class="fas fa-hands-helping"></i>
                      Kirim Donasi</button>
                      </form>   
                  <?php } ?>
                <?php } ?>
              </div>
              <?php } ?>
            <?php } ?>
            </div>
          </div>
    </section>

      <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
  </section>
    
    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <span class="copyright">Copyright &copy; Your Website 2018</span>
          </div>
          <div class="col-md-4">
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-linkedin-in"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-4">
            <ul class="list-inline quicklinks">
              <li class="list-inline-item">
                <a href="#">Privacy Policy</a>
              </li>
              <li class="list-inline-item">
                <a href="#">Terms of Use</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>

    <!-- Portfolio Modals -->

    <!-- Modal login -->
    <div class="portfolio-modal modal fade" id="portfolioModal7" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="close-modal" data-dismiss="modal">
            <div class="lr">
              <div class="rl"></div>
            </div>
          </div>
          <section id="contact">
            <div class="container">
              <div class="row">
                <div class="col-lg-12 text-center">
                  <h2 class="section-heading text-uppercase">Login</h2>
                  <h3 class="section-subheading text-muted">Kita Bangun.</h3>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <form action="proseslogin.php" method="POST">
                  <form name="sentMessage" novalidate="novalidate">
                    <div class="row">
                        <div class="col-lg-6 mx-auto">
                            <div class="form-group">
                                <input class="form-control" id="email" name="email" type="email" placeholder="Your Email *" required="required" oninvalid="this.setCustomValidity('Please enter your email address.')" oninput="setCustomValidity('')">
                                <p class="help-block text-danger"></p>
                            </div>                        
                          <div class="form-group">
                            <input class="form-control" id="password" name="password" type="password" placeholder="Password *" required="required" oninvalid="this.setCustomValidity('Please enter your password.')" oninput="setCustomValidity('')">
                            <p class="help-block text-danger"></p>
                          </div>                        
                        </div>                      
                        <div class="col-lg-12 text-center">
                          <button id="sendMessageButton" name="login" class="btn btn-primary btn-xl text-uppercase" type="submit">Login</button>
                        </div>
                    </div>
                  </form>
                  </form>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>

    <!-- Modal 8 -->
    <div class="portfolio-modal modal fade" id="portfolioModal8" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
              <div class="lr">
                <div class="rl"></div>
              </div>
            </div>
            <section id="contact">
              <div class="container">
                <div class="row">
                  <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">Register</h2>
                    <h3 class="section-subheading text-muted">Kita Bangun.</h3>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <form action="prosesregister.php" method="POST">
                    <form name="sentMessage" novalidate="novalidate">
                      <div class="row">
                        <div class="col-lg-6 mx-auto">
                          <div class="form-group">
                                <input class="form-control" id="name" name="name" type="text" placeholder="Your Name *" required="required" oninvalid="setCustomValidity('Please enter your name.')" oninput="setCustomValidity('')">
                                <p class="help-block text-danger"></p>
                              </div>  
                          <div class="form-group">
                                <input class="form-control" id="email" name="email" type="email" placeholder="Your Email *" pattern="[a-z0-9._%+-]{1,40}[@]{1}[a-z]{1,10}[.]{1}[a-z]{3}" required="required" oninvalid="setCustomValidity('Please enter your email address.')" oninput="setCustomValidity('')">
                                <p class="help-block text-danger"></p>
                              </div>                        
                          <div class="form-group">
                            <input class="form-control" id="password" name="password" type="password" placeholder="Password *" required="required" oninvalid="etCustomValidity('Please enter your password.')" oninput="setCustomValidity('')">
                            <p class="help-block text-danger"></p>
                          </div>                        
                          <div class="form-group">
                              <input class="form-control" id="password" name="repassword" type="password" placeholder="Re-enter Password *" required="required" oninvalid="setCustomValidity('Please re-enter your password.')" oninput="setCustomValidity('')">
                              <p class="help-block text-danger"></p>
                            </div>                        
                        </div>                      
                        <div class="clearfix"></div>
                        <div class="col-lg-12 text-center">
                          <div id="success"></div>
                          <button id="sendMessageButton" name="register" class="btn btn-primary btn-xl text-uppercase" type="submit">Register</button>
                        </div>
                      </div>
                    </form>
                    </form>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Contact form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/agency.min.js"></script>

  </body>

</html>
