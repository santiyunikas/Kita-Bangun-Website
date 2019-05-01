<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Panel - Kita Bangun</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="adminpanel.php">Kita Bangun Admin Panel</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          <div class="input-group-append">
            </button>
          </div>
        </div>
      </form>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">            
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="adminpanel.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pengajuan.php">
            <i class="fas fa-fw fa-ribbon"></i>
            <span>Pengajuan Donasi</span>
          </a>          
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="postingan.php">
            <i class="fas fa-fw fa-handshake"></i>
            <span>Donasi Aktif</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="transaksi.php">
            <i class="fas fa-fw fa-file-invoice-dollar"></i>
            <span>Transaksi Donasi</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pencairan.php">
            <i class="fas fa-fw fa-hand-holding-usd"></i>
            <span>Pencairan Donasi</span></a>
        </li>
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="adminpanel.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Donasi Aktif</li>
          </ol>
            
            <!-- Tampilan Donasi Aktif--> 
           
                  
          <div class="container">   
        <div class="row">
        <?php
            REQUIRE_ONCE('connection.php');
                $QUERY = MYSQLI_QUERY( $conn,
                "SELECT *  FROM donasi WHERE STATUS_DONASI = '1'"
              );
                  while ($data = mysqli_fetch_array($QUERY))
                  {
                  $data['JUDUL_DONASI'];
                  $data['NAMA'];
                  $data['TERKUMPUL'];
                  $waktu_akhir = $data['WAKTU_BERAKHIR'];
                  date_default_timezone_set('Asia/Jakarta');
                  $date=date("Y-m-d h:i:sa");
                  $min = (strtotime($waktu_akhir) - strtotime($date)) / (60*60*24);
                  if ($min < 0) {
                    $durasi = 0;
                  } else {
                    $durasi = floor($min);
                  }
                  $durasi;
                  $data['NOMOR_TLP'];
                  $data['DESKRIPSI'];   
                  ?>
          <div class="col-md-4 col-sm-6 portfolio-item">
            <a class="portfolio-link" data-toggle="modal" href="#portfolioModal1">
              <div class="portfolio-hover">
                <div class="portfolio-hover-content">                  
                </div>
              </div>
              <img class="img-fluid" src="donasi/<?php echo $data['FOTO_LOKASI'] ?>" alt="">
            </a>
            <div class="portfolio-caption">
              <h4><?php echo  $data['JUDUL_DONASI'];?> </h4>
              <p class="text-muted"> <?php echo  $data['NAMA'];?> </p>
              <div class="progress">
                  <div class="progress-bar progress-bar-striped active" role="progressbar"
                  aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:40%">                    
                  </div>
                </div>
                <p class="text-muted">Terkumpul : Rp. <?php echo $data['TERKUMPUL'] ?></p>
                <p class="text-muted">Sisa Durasi Penggalangan : <?php echo $durasi ?> Hari</p>
            </div>            
          </div>
          <?php
                  }
                  ?>
        </div>
      </div>

          

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © KitaBangun.com</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

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

    <!-- Modal 1 -->
    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="close-modal" data-dismiss="modal">
            <div class="lr">
              <div class="rl"></div>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-lg-8 mx-auto">
                <div class="modal-body">
                  <!-- Project Details Go Here -->
                  <h2 class="text-uppercase"><input class="form-control" id="title" type="text" placeholder="Judul Penggalangan Donasi *" required="required" data-validation-required-message="Judul Penggalangan Donasi Harus Diisi !" value="Bangun Jembatan Suhat"></h2>
                  <p class="item-intro text-muted"><input class="form-control" id="title" type="text" placeholder="Nama Penggalang Donasi *" required="required" data-validation-required-message="Nama Penggalang Donasi Harus Diisi !" value="Aulia Rizki Ananda"></p>
                  <img class="img-fluid d-block mx-auto" src="img/portfolio/01-full.jpg" alt="">
                  <input class="form-control" id="picture" type="file" placeholder="Foto Penggalangan Dana *" required="required" data-validation-required-message="Wajib Mencantumkan Foto !">
                  <p><textarea class="form-control" id="message" placeholder="Deskripsi Mengenai Penggalangan Donasi *" required="required" data-validation-required-message="Deskripsi Penggalangan Harus Diisi !.">Keterangan mengenai penggalangan donasi. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</textarea></p>
                  <ul class="list-inline">
                    <li>Target Penggalangan Donasi :</li>                    
                    <li><input class="form-control" id="number" type="number" placeholder="Target Penggangan Donasi *" min="10000" required="required" data-validation-required-message="Mohon Isi Jumlah Target Donasi !" value="123123321"></li>
                    <li>Sisa Durasi Penggalangan :</li>
                    <li><input class="form-control" id="number" type="number" placeholder="Durasi Penggangan Donasi *" required="required" data-validation-required-message="Mohon Isi Durasi Donasi !" value="9"></li>
                  </ul>
                  <button class="btn btn-primary" type="submit">
                    <i class="fas fa-save"></i>
                    Simpan</button>                                      
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>

  </body>

</html>
