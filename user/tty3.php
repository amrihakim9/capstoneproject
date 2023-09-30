<?php
session_start();
if( !isset($_SESSION["id"]) || !isset($_SESSION["name"])) {
  header("Location: ../userlogin.html");
  exit;
}
$id = $_SESSION['id'];
$name = $_SESSION['name'];
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/building-solid.png" />
  <title>Laboratorium Jaringan</title>
  <!-- Custom CSS -->
  <link href="../assets/libs/flot/css/float-chart.css" rel="stylesheet" />
  <!-- Custom CSS -->
  <link href="../dist/css/style2.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    .addon1 {
      color: #fff;
      opacity: 0.6;
    }

    .addon1:hover {
      color: #fff;
      opacity: 1;
    }

    .custom-bg-dark {
      background-color: black;
    }

    .mt-4-5 {
      margin-top: 2.2rem !important;
    }

    .breadcrumb li{
      margin-left: 10px;
      margin-right: 5px;
    }

    .back-button{
      display: inline-block;
      padding: 2.5px 5px;
      background-color: green;
      color: #DFF4DF;
      border-radius: 5px;
      font-size: 15px;
      font-weight: bold;
      box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5);
      -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5);
      -moz-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5);
    }

    .back-button:hover{
      background-color: #00B76B;
      color: #DFF4DF;
    }

    .page-title{
      text-align: center;
    }

    footer {
      position: absolute;
      justify-content: center;
      display: flex;
      padding: 10px;
      text-align:center;
      color: black;
      width: 100%;
      margin-bottom: -20px;
      bottom: 0;
      left: 0;
      background-color: white;
    }

    .sidebar-item a{
      position: relative;
      width: 100%;
      list-style: none;
      border-top-left-radius: 30px;
      border-bottom-left-radius: 30px;
    }

    .card{
      position: relative;
      width: 100%;
      height: 600px;
      border-radius: 10px;
    }

    .left-sidebar, .navbar-header, .navbarSupportedContent, .page-wrapper{
      transition: all 0.5s ease;
    }
  </style>
</head>

<body>
  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>
  <div id="main-wrapper">
    <header class="topbar" data-navbarbg="skin5">
      <nav class="navbar top-navbar navbar-expand-md navbar-light shadow-lg">
        <div class="navbar-header" data-logobg="skin5">
          <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
          <a class="navbar-brand" href="user.php">
            <b class="logo-icon p-l-10">
              <img src="../assets/images/building-solid.png" alt="homepage" class="light-logo" />
            </b>
            <span class="logo-text">
              <img src="../assets/images/logotext.png" alt="homepage" class="light-logo ml-2" />
            </span>
          </a>
          <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
          <ul class="navbar-nav float-left mr-auto">
            <li class="nav-item d-none d-md-block">
              <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a>
            </li>
          </ul>
          <ul class="navbar-nav float-right">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31" /></a>
              <div class="dropdown-menu dropdown-menu-right user-dd animated">
                <a class="dropdown-item" href="../logout_user.php"><i class="fa fa-power-off m-r-5 m-l-5"></i>Keluar</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <span class="nav-link"><?=$name ?></span>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <aside class="left-sidebar" data-sidebarbg="skin5">
      <div class="scroll-sidebar">
        <nav class="sidebar-nav">
          <ul id="sidebarnav" class="p-t-30">
            <li class="sidebar-item text-center">
              <img src="../assets/images/users/1.jpg" class="rounded-circle" width="30%" alt="" />
              <p class="hide-menu text-black pt-2 addon1">&nbsp;Selamat Datang</p>
              <p class="hide-menu text-black addon1">&nbsp;<?= $name ?></p>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark" href="user.php" aria-expanded="false"><i class="fa-solid fa-home"></i><span class="hide-menu">&nbsp;Beranda</span></a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark" href="console.php" aria-expanded="false"><i class="fa-solid fa-laptop"></i><span class="hide-menu">&nbsp;Terminal</span></a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>
    <div class="page-wrapper">
      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-0">
            <div class="ml-auto text-right">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="console.php" class="back-button"> > Kembali </a>
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <div>
      <h4 class="page-title">TTY3</h4>
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
              <?php
                $websiteUrl = "";
              ?>
              <iframe src="<?php echo $websiteUrl; ?>" frameborder="0" style="width: 100%; height: 100%;"></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer>
        <p>SISTEM MONITORING PRAKTIKUM JARINGAN KOMPUTER</p>
      </footer>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap tether Core JavaScript -->
  <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
  <script src="../assets/extra-libs/sparkline/sparkline.js"></script>
  <!--Wave Effects -->
  <script src="../dist/js/waves.js"></script>
  <!--Menu sidebar -->
  <script src="../dist/js/sidebarmenu.js"></script>
  <!--Custom JavaScript -->
  <script src="../dist/js/custom.min.js"></script>
  <!--This page JavaScript -->
  <!-- <script src="../dist/js/pages/dashboards/dashboard1.js"></script> -->
  <!-- Charts js Files -->
  <script src="../assets/libs/flot/excanvas.js"></script>
  <script src="../assets/libs/flot/jquery.flot.js"></script>
  <script src="../assets/libs/flot/jquery.flot.pie.js"></script>
  <script src="../assets/libs/flot/jquery.flot.time.js"></script>
  <script src="../assets/libs/flot/jquery.flot.stack.js"></script>
  <script src="../assets/libs/flot/jquery.flot.crosshair.js"></script>
  <script src="../assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
  <script src="../dist/js/pages/chart/chart-page-init.js"></script>
</body>
</html>