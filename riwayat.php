<?php
session_start();

$id = $_SESSION["id_akun"];

include 'connection.php';
$sql = "SELECT a.ID_MEMBER, a.ID_BAYAR, b.JUDUL_DONASI, a.NOMINAL, a.WAKTU_TRANSAKSI, a.BUKTI_BAYAR, a.STATUS_BAYAR, a.NAMA_BANK FROM pembayaran a, donasi b WHERE b.ID_DONASI = a.ID_DONASI AND a.ID_MEMBER = '$id'";
$query = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
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
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" data-toggle="dropdown" href="#"><?php echo $_SESSION["akun_nama"] ?> &nbsp&nbsp<i class="fas fa-user-circle fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">            
            <a class="dropdown-item fas fa-sign-out-alt fa-fw" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
            </li>      
          </ul>
        </div>
      </div>
    </nav>

    

    <section id="contact">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 text-center">
              <h2 class="section-heading text-uppercase">Riwayat Donasi</h2>
              <h3 class="section-subheading text-muted">Kita Bangun.</h3>
            </div>
          </div>
          

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Daftar Transaksi</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Judul Penggalangan</th>
                      <th>Jumlah Donasi</th>
                      <th>Waktu Donasi</th>
                      <th>Upload Bukti</th> 
                      <th>Bukti Tranfer</th> 
                      <th>Status</th>                     
                    </tr>
                  </thead>
                 
                  <tbody>
                    <?php for ($i=0;$i<10;$i++){?>
                      <?php if(mysqli_num_rows($query)>0){ ?>
                        <?php
                            while($data = mysqli_fetch_array($query)){
                        ?>
                    <tr>
                      <td><?php echo $data["JUDUL_DONASI"];?></td>
                      <td><?php echo $data["NOMINAL"];?></td>
                      <td><?php echo $data["WAKTU_TRANSAKSI"];?></td>
                      <td>
                      <?php $id = $data["ID_BAYAR"];
                      if (empty($data['BUKTI_BAYAR'])) { ?>
                      <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#validateModal<?php echo $data['ID_BAYAR']; ?>">Upload Bukti Transfer</a>
                      <?php } else {
                        echo "Sudah Upload Bukti";
                      } ?>
                      </td>
                      <td>
                      <?php if (!empty($data['BUKTI_BAYAR'])) { ?>
                      <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#uploadModal<?php echo $data['ID_BAYAR']; ?>">Tampilkan Bukti Transfer</a>
                      <?php } else {
                        if ($data['NAMA_BANK'] == 'BRI') {
                          echo "Tranfer Ke Rekening 1234567890";
                        } elseif ($data['NAMA_BANK'] == 'Mandiri') {
                          echo "Tranfer Ke Rekening 9876543210";
                        } elseif ($data['NAMA_BANK'] == 'BNI') {
                          echo "Tranfer Ke Rekening 1234598760";
                        } elseif ($data['NAMA_BANK'] == 'BCA') {
                          echo "Tranfer Ke Rekening 9876512340";
                        } elseif ($data['NAMA_BANK'] == 'Danamon') {
                          echo "Tranfer Ke Rekening 1357924680";
                        } elseif ($data['NAMA_BANK'] == 'BTN') {
                          echo "Tranfer Ke Rekening 2468135790";
                        }
                      } ?>
                      </td>
                      <td><?php
                      if ($data['STATUS_BAYAR'] == '2') {
                        echo "Sukses";
                      } elseif ($data['STATUS_BAYAR'] == '1') {
                        echo "Menunggu Validasi";
                      } elseif ($data['STATUS_BAYAR'] == '0') {
                        echo "Menunggu Bukti";
                      }
                      ?></td>
                    </tr>

                      <!-- Upload Modal-->
                      <div class="modal fade" id="validateModal<?php echo $data['ID_BAYAR']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Transfer</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <?php
                                $id = $data['ID_BAYAR'];
                                ?>
                              <form action="buktibayar.php" method="POST" enctype="multipart/form-data">
                                <form name="sentMessage" novalidate="novalidate">
                                  <input class="form-control" id="image" name="image" type="file" accept="image/*" placeholder="Bukti Pembayaran *" required="required" oninvalid="this.setCustomValidity('Bukti Transaksi Belum Dipilih !')" oninput="setCustomValidity('')">
                                  <input type="hidden" name="pembayaran_id" value="<?php echo $id ?>" >
                              </div>
                              <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>            
                                <button id="sendMessageButton" class="btn btn-primary " type="submit" name="upload">Upload</button>
                                </form>
                              </form>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Upload Modal -->
                        <div class="portfolio-modal modal fade" id="uploadModal<?php echo $data['ID_BAYAR']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
                                      <h2 class="text-uppercase">Bukti Transfer</h2>
                                      <?php
                                      $id8 = $data['ID_BAYAR'];
                                      $sql8 = "SELECT BUKTI_BAYAR FROM pembayaran WHERE ID_BAYAR = '$id8'";
                                      $query8 = mysqli_query($conn,$sql8);
                                        if(mysqli_num_rows($query8)>0){
                                              while($data8 = mysqli_fetch_array($query8)){
                                      ?>
                                      <img class="img-fluid d-block mx-auto" src="bukti/<?php echo $data8['BUKTI_BAYAR']; ?>" alt=""> 
                                          <?php } ?>                 
                                        <?php } ?>             
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php }?>             
                      <?php }?>
                    <?php } ?>                    
                  </tbody>
                </table>
              </div>
            </div>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Daftar Pengajuan</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Judul Penggalangan</th>
                      <th>Target Donasi</th>
                      <th>Waktu Akhir Donasi</th>
                      <th>Alamat</th>
                      <th>Foto Lokasi</th> 
                      <th>Status</th>                     
                    </tr>
                  </thead>
                  <tbody>
                  <?php                   
                  $id2 = $_SESSION["id_akun"];
                  $sql1 = "SELECT ID_MEMBER, ID_DONASI, JUDUL_DONASI, NOMINAL, WAKTU_BERAKHIR, FOTO_LOKASI, ALAMAT, STATUS_DONASI FROM donasi WHERE ID_MEMBER = '$id2'";
                  $query1 = mysqli_query($conn,$sql1);
                  ?>
                    <?php for ($i=0;$i<10;$i++){?>
                      <?php if(mysqli_num_rows($query1)>0){ ?>
                        <?php
                            while($data1 = mysqli_fetch_array($query1)){
                        ?>
                    <tr>
                      <td><?php echo $data1["JUDUL_DONASI"];?></td>
                      <td><?php echo $data1["NOMINAL"];?></td>
                      <td><?php echo $data1["WAKTU_BERAKHIR"];?></td>
                      <td><?php echo $data1["ALAMAT"];?></td>
                      <td><a class="btn btn-primary" href="#" data-toggle="modal" data-target="#uploadModal1<?php echo $data1['ID_DONASI']; ?>">Tampilkan Foto Lokasi</a></td>
                      <td><?php
                      if ($data1['STATUS_DONASI'] == '1') {
                        echo "Disetujui"; ?>
                        <a class="btn btn-primary" href="detaildonasi.php?id=<?php echo $data1['ID_DONASI'] ?>" type="submit">Detail Donasi</a>
                      <?php } elseif ($data1['STATUS_DONASI'] == '2') {
                        echo "Selesai"; ?>
                        <a class="btn btn-primary" href="detaildonasi.php?id=<?php echo $data1['ID_DONASI'] ?>" type="submit">Detail Donasi</a>
                      <?php } elseif ($data1['STATUS_DONASI'] == '0') {
                        echo "Menunggu Konfirmasi";
                      } ?></td>
                    </tr>       
                      <!-- Upload Modal -->
                        <div class="portfolio-modal modal fade" id="uploadModal1<?php echo $data1['ID_DONASI']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
                                      <h2 class="text-uppercase">Foto Lokasi</h2>
                                      <?php
                                      $id9 = $data1['ID_DONASI'];
                                      $sql9 = "SELECT FOTO_LOKASI FROM donasi WHERE ID_DONASI = '$id9'";
                                      $query9 = mysqli_query($conn,$sql9);
                                        if(mysqli_num_rows($query9)>0){
                                              while($data9 = mysqli_fetch_array($query9)){
                                      ?>
                                      <img class="img-fluid d-block mx-auto" src="donasi/<?php echo $data9['FOTO_LOKASI']; ?>" alt=""> 
                                          <?php } ?>                 
                                        <?php } ?>                
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>             
                        <?php }?>             
                      <?php }?>
                    <?php } ?>                    
                  </tbody>
                </table>
              </div>
            </div>
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
