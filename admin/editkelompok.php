<?php
session_start();
if( !isset($_SESSION["id"])) {
	header("Location: ../adminlogin.html");
	exit;
}
$id = $_SESSION['id'];
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

    .mt-4-5 {
      margin-top: 2.2rem !important;
    }

    .topbar .top-navbar .navbar-nav .nav-item .nav-link.nama:hover {
      background-color: #EDEDED;
      color: rgba(0, 0, 0, 0.5);
    }

    .page-wrapper {
      min-height: 90vh;
    }

    .text-bold{
      color: white;
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
      <nav class="navbar top-navbar navbar-expand-md navbar-light">
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
            <h4 class="page-title">Data User</h4>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Tabel Data User</h5>
                <div class="table-responsive">
                  <table id="zero_config" class="table text-center table-bordered">
                    <thead class="bg-info text-bold">
                      <tr>
                        <!-- <th scope="col">No.</th> -->
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Kelompok</th>
                        <th scope="col" style="width: 20%;">Aksi</th>
                      </tr>
                    </thead>
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
      <!-- Modal -->
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Update User</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <input type="hidden" name="id" id="iduser" value="">
                <div class="form-group">
                  <label for="nama">Nama Lengkap</label>
                  <input type="text" class="form-control" id="nama" readonly>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="kelompok">Kelompok</label>
                    <input type="number" class="form-control" id="kelompok">
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-primary save">Save</button>
            </div>
          </div>
        </div>
      </div>
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
  <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="../dist/js/pages/chart/chart-page-init.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script>
    const dataTable = $('#zero_config').DataTable({
      processing: true,
      serverSide: true,
      order: [],
      paging: true, 
      pageLength: 10, 
      columnDefs: [{
        targets: 2,
        orderable: false
      }],
      ajax: '../assets/php/table_kelompok2.php',
    });

    $(document).on('click', '.delete', function(event) {
      event.preventDefault();
      Swal.fire({
        title: 'are you sure?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!',
        cancelButtonText: 'Cancel!',
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
              url: `../assets/php/kelompok.php?id=${$(this).attr('id')}`,
              method: 'DELETE',
              dataType: 'json',
              beforeSend: function() {
                $('.swal2-confirm').attr('disabled', true);
                $('.swal2-confirm').empty().append('<div class="spinner"></div>');
              },
            })
            .done(function(data) {
              // dataTable.ajax.reload()
              // dataTable.reload()
              if (data.status === 1) {
                Swal.fire({
                  icon: 'success',
                  title: data.status_message, 
                });
                window.location.reload()
              } else {
                Swal.fire({
                  icon: 'error',
                  title: data.status_message,
                });
              }
            })
            .fail(function() {
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'error',
              });
            });
        }
      });
    });

    $(document).on('click', '.update', function() {
      var id = $(this).attr("id");
      $.ajax({
        url: `../assets/php/kelompok.php?id=${id}`,
        method: "GET",
        dataType: "json",
      }).done(function(response) {
        const data = response[0]
        $('#iduser').val(data.id);
        $('#nama').val(data.nama);
        $('#kelompok').val(data.kelompok);
      }).fail(function() {})
    });

    $(document).on('click', '.save', function() {
      var id = $('#iduser').val();
      var nama = $('#nama').val();
      var kelompok = $('#kelompok').val();

      if (id == '' || nama == '' || kelompok == '') {
        alert('err')
      } else {
        $.ajax({
          url: `../assets/php/kelompok.php`,
          method: "put",
          contentType: "application/json",
          data: JSON.stringify({
            id,
            nama,
            kelompok
          }),
          dataType: "json",
        }).done(function(response) {
          // dataTable.ajax.reload()
          // dataTable.reload()
          $('#exampleModalCenter').modal('toggle');
          alert(response.status_message)
          window.location.reload()
          // var oTable = $('#zero_config').dataTable(); 
          oTable.fnDraw(false);
        }).fail(function() {
          alert('error')
        })
      }
    });
  </script>
</body>
</html>