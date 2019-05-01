<!DOCTYPE html>
<?php

  include "connection.php";

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

$sql = "SELECT a.ID_DONASI, a.JUDUL_DONASI, b.NAMA, a.NOMINAL, a.DESKRIPSI, a.NOMOR_TLP, a.FOTO_LOKASI, a.TERKUMPUL, a.WAKTU_BERAKHIR FROM donasi a, member b WHERE a.ID_MEMBER = b.ID_MEMBER AND a.STATUS_DONASI = '1'";
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
              <a class="nav-link js-scroll-trigger" href="#contact">Ajukan Donasi</a>
            </li>
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

    <!-- Header -->
    <header class="masthead">
      <div class="container">
        <div class="intro-text">
          <div class="intro-lead-in">Selamat Datang Di Kita Bangun !</div>
          <div class="intro-heading text-uppercase">Mari Kita Bangun Infrastruktur Bersama</div>
          <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Apa Itu Kita Bangun ?</a>
        </div>
      </div>
    </header>

    <!-- Services -->
    <section id="services">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Yang Kita Lakukan</h2>
            <h3 class="section-subheading text-muted">Kita Bangun Adalah CrowdFunding Yang Berfokus Pada Pembangunan Infrastruktur.</h3>
          </div>
        </div>
        <div class="row text-center">
          <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <i class="fas fa-circle fa-stack-2x text-primary"></i>
              <i class="fas fa-people-carry fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="service-heading">Membantu Bersama</h4>
            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
          </div>
          <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <i class="fas fa-circle fa-stack-2x text-primary"></i>
              <i class="fas fa-building fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="service-heading">Infrastruktur</h4>
            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
          </div>
          <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <i class="fas fa-circle fa-stack-2x text-primary"></i>
              <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="service-heading">Keamanan Donasi</h4>
            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Portfolio Grid -->
    <section class="bg-light" id="portfolio">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Penggalangan Donasi Yang Sedang Berlangsung</h2>
            <h3 class="section-subheading text-muted">Mari Kita Bangun Infrastruktur Demi Kemajuan Bangsa !</h3>
          </div>
        </div>
        <div class="row">
          <?php if(mysqli_num_rows($query)>0){ ?>
            <?php
              while($data = mysqli_fetch_array($query)){
                $id = $data["ID_DONASI"];
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
          <div class="col-md-4 col-sm-6 portfolio-item">
            <a class="portfolio-link" href="detaildonasi.php?id=<?php echo $id ?>">
              <div class="portfolio-hover">
                <div class="portfolio-hover-content">
                  <i class="fas fa-hand-holding-usd fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="donasi/<?php echo $data['FOTO_LOKASI'] ?>" alt="" width="350px" height="197px">
            </a>
            <div class="portfolio-caption">
              <h4><?php echo $data["JUDUL_DONASI"];?></h4>
              <p class="text-muted"><?php echo $data["NAMA"];?></p>
              <div class="progress">
                  <div class="progress-bar progress-bar-striped active" role="progressbar"
                  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">                    
                  </div>
                </div><?php
                  $nominal = $data["NOMINAL"];
                  $terkumpul = $data["TERKUMPUL"];
                 if ($durasi == 0 || $terkumpul >= $nominal) { ?>
                  <p class="text-muted">Donasi Selesai</p>
                  <?php
                    $query5="UPDATE donasi SET STATUS_DONASI = '2' where ID_DONASI = '$id'";
                    mysqli_query($conn, $query5);
                  } else { ?>
                  <p class="text-muted">Terkumpul : Rp. <?php echo $terkumpul;?></p>
                  <p class="text-muted">Sisa Durasi Penggalangan : <?php echo $durasi;?> Hari</p>
                <?php } ?>
            </div>
          </div>
          <?php } ?>
        <?php } ?> 
        </div>
      </div>
    </section>

<?php
  if(isset($_SESSION["akun_nama"])){?>
    <section id="contact">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 text-center">
              <h2 class="section-heading text-uppercase">Ajukan Donasi</h2>
              <h3 class="section-subheading text-muted">Kita Bangun.</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <form action="prosespengajuan.php" method="POST" enctype="multipart/form-data">
              <form name="sentMessage" novalidate="novalidate">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input class="form-control" id="title" name="judul" type="text" placeholder="Judul Penggalangan Donasi *" required="required" oninvalid="this.setCustomValidity('Judul Penggalangan Donasi Harus Diisi !')" oninput="setCustomValidity('')">
                      <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                      <input class="form-control" id="number" name="target" type="number" placeholder="Target Penggalangan Donasi *" required="required" oninvalid="this.setCustomValidity('Target Donasi Harus Diisi !')" oninput="setCustomValidity('')">
                      <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                      <input class="form-control" id="tanggal" name="durasi" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Tanggal Terakhir Penggalangan Donasi *" required="required" oninvalid="this.setCustomValidity('Durasi Donasi Harus Diisi !')" oninput="setCustomValidity('')">
                      <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                      <input class="form-control" id="alamat" name="alamat" type="text" placeholder="Alamat Penggalangan Donasi *" required="required" oninvalid="this.setCustomValidity('Alamat Donasi Harus Diisi !')" oninput="setCustomValidity('')">
                      <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="phone" name="nomer" pattern="[0]{1}[8]{1}[0-9]{9,10}" maxlength="12" type="tel" placeholder="Nomor HP Pengaju *" required="required" oninvalid="this.setCustomValidity('Nomor HP Harus Diisi !')" oninput="setCustomValidity('')">
                        <p class="help-block text-danger"></p>
                      </div>
                      
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <textarea class="form-control" id="message" name="deskripsi" placeholder="Deskripsi Mengenai Penggalangan Donasi *" required="required" oninvalid="this.setCustomValidity('Deskripsi Penggalangan Harus Diisi !.')" oninput="setCustomValidity('')"></textarea>
                      <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="image" name="image" accept="image/*" type="file" placeholder="Foto Lokasi Penggalangan Dana *" required="required" oninvalid="this.setCustomValidity('Wajib Mencantumkan Foto !')" oninput="setCustomValidity('')"/>
                        <p class="help-block text-danger"></p>
                      </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-lg-12 text-center">
                    <div id="success"></div>
                    <button id="sendMessageButton" name="ajuan" class="btn btn-primary btn-xl text-uppercase" type="submit">Ajukan</button>
                  </div>
                </div>
              </form>
              </form>
            </div>
          </div>
        </div>
      </section>
    <?php } ?> 
    




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
