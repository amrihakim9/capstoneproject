<?php
session_start();
if( !isset($_SESSION["id"])) {
	header("Location: ../adminlogin.html");
	exit;
}
$id = $_SESSION['id'];
?>
<?php
include 'conn.php';
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

  <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css"> -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" />
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

    .topbar .top-navbar .navbar-nav .nav-item .nav-link.nama:hover {
      background-color: #EDEDED;
      color: rgba(0, 0, 0, 0.5);
    }

    .page-wrapper {
      min-height: 90vh;
    }

    .text-black{
      color: #fff;
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
    .text-bold{
      color: white;
      align-items: center;
    }

    .sidebar-item a{
      position: relative;
      width: 100%;
      list-style: none;
      border-top-left-radius: 30px;
      border-bottom-left-radius: 30px;
    }

    .left-sidebar, .navbar-header, .navbarSupportedContent, .page-wrapper{
      transition: all 0.5s ease;
    }

    .approve{
      background-color: green;
      color: white;
      cursor: pointer;
      border-radius: 10px;
    }

    .deny{
      background-color: red;
      color: white;
      cursor: pointer;
      border-radius: 10px;
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
          <a class="navbar-brand" href="admin.php">
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
                <a class="dropdown-item" href="../logout_admin.php"><i class="fa fa-power-off m-r-5 m-l-5"></i>Keluar</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <span class="nav-link nama">admin</span>
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
              <p class="hide-menu text-black addon1">&nbsp;admin</p>
	    </li>

	    <li class="sidebar-item">
      		<a class="sidebar-link waves-effect waves-dark" href="admin.php" aria-expanded="false"><i class="fa-solid fa-home"></i><span class="hide-menu">&nbsp;Beranda</span></a>
    	    </li>

    	    <li class="sidebar-item">
      		<a class="sidebar-link waves-effect waves-dark" href="usermanage.php" aria-expanded="false"><i class="fa-solid fa-terminal"></i><span class="hide-menu">&nbsp;Monitoring</span></a>
    	    </li>

     	    <li class="sidebar-item">
       		<a class="sidebar-link waves-effect waves-dark" href="approve_login.php" aria-expanded="false"><i class="fa-solid fa-user-plus"></i><span class="hide-menu">&nbsp;Persetujuan</span></a>
     	    </li>

    	    <li class="sidebar-item">
       		<a class="sidebar-link waves-effect waves-dark" href="editkelompok.php" aria-expanded="false"><i class="fa-regular fa-folder-open"></i><span class="hide-menu">&nbsp;Data User</span></a>
	    </li> 

           </li>
          </ul>
        </nav>
      </div>
    </aside>
    <div class="page-wrapper">
      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Persetujuan Login User</h4>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Tabel Persetujuan User</h5>
                <div class="table-responsive">
                <table id="zero_config" class="table text-center table-bordered">
                  <thead class="bg-info text-bold">
                    <tr>
                      <th><strong>Nama Lengkap</strong></th>
                      <th><strong>Username</strong></th>
                      <th><strong>Kelompok</strong></th>
                      <th><strong>Aksi</strong></th>
                    </tr>
                  </thead>
                  <tbody> 
                    <?php
                    $query = "SELECT * FROM user WHERE approve = 'pending' ORDER BY id ASC";
                    $result = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_array($result)){
                    ?>        
                    <tr>
                      <td><?php echo $row['nama'];?></td>
                      <td><?php echo $row['username'];?></td>
                      <td><?php echo $row['kelompok'];?></td>
                      <td>
                        <form action="approve_login.php" method="POST">
                          <input type="hidden" name="id" value="<?php echo $row['id'];?>" />
                          <input type="submit" name="approve" value="Approve" class="approve" />
                          <input type="submit" name="deny" value="Deny" class="deny"/>
                        </form>
                      </td>
                    </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
                </div>
              </div>
            </div>
          </div>
	</div>
      </div>
	<footer> 

	<p>SISTEM MONITORING PRAKTIKUM JARINGAN KOMPUTER</p>
	</footer>
    </div>
    
<?php
if(isset($_POST['approve'])){
    $id = $_POST['id'];

    $select = "UPDATE user SET approve = 'approved' WHERE id = '$id'";
    $result = mysqli_query($conn, $select);

    echo '<script type = "text/javascript">';
    echo 'alert("User Disetujui!");';
    echo 'window.location.href = "approve_login.php"';
    echo '</script>';
}

if(isset($_POST['deny'])){
    $id = $_POST['id'];

    $select = "UPDATE user SET approve = 'deny' WHERE id = '$id'";
    $result = mysqli_query($conn, $select);

    echo '<script type = "text/javascript">';
    echo 'alert("User Ditolak!");';
    echo 'window.location.href = "approve_login.php"';
    echo '</script>';
}
?>

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
  <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="../dist/js/pages/chart/chart-page-init.js"></script>
   <script>
    $(document).ready(function() {
      $('#zero_config').DataTable({
        "paging": true,
        "lengthMenu": [10, 25, 50, 75, 100],
        "ordering": true,
        "info": true,
	      "searching": true,
        columnDefs: [{
        targets: 3,
        orderable: false
      	}],
          "language": {
          "paginate": {
          "previous": "Previous",
          "next": "Next"
        },
          "search": "Search:",
          "infoEmpty": "Tidak ada data yang tersedia",
          "infoFiltered": "(disaring dari _MAX_ total data)"
        }
      });
    });
  </script> 
</body>
</html>