<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Deteksi Lokasi Asset</title>
    <!-- Favicon -->
    <link href="assets/img/brand/favicon.png" rel="icon" type="image/png" />
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Icons -->
    <link href="assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
    <link href="assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
  </head>

  <body class="">
    <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
      <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="./index.html">
          <img src="assets/img/brand/blue.png" class="navbar-brand-img" alt="..." />
        </a>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Collapse header -->
          <div class="navbar-collapse-header d-md-none">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="index.html">
                  <img src="assets/img/brand/blue.png" />
                </a>
              </div>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>
          <!-- Form -->
          <form class="mt-4 mb-3 d-md-none">
            <div class="input-group input-group-rounded input-group-merge">
              <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search" />
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <span class="fa fa-search"></span>
                </div>
              </div>
            </div>
          </form>
          <!-- Navigation -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="index.html"> <i class="ni ni-tv-2 text-primary"></i> Dashboard </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link active" href="pengelolaan.html"> <i class="ni ni-planet text-blue"></i> Pengelolaan </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="l_ruangan.html"> <i class="ni ni-pin-3 text-orange"></i> List Ruangan </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="DBR.html"> <i class="ni ni-single-02 text-yellow"></i> Daftar Barang Ruangan </a>
            </li>
          </ul>
          <!-- Divider -->
        </div>
      </div>
    </nav>
    <div class="main-content">
      <!-- Navbar -->
      <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
        <div class="container-fluid">
          <!-- Brand -->
          <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="index.html">Pengelolaan Aset Gedung</a>
          <!-- Form -->
          <!-- User -->
          <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <div class="media-body ml-2 d-none d-lg-block">
                    <span class="mb-0 text-sm font-weight-bold">Admin</span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Welcome!</h6>
                </div>
                <div class="dropdown-divider"></div>
                <a href="login.html" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Logout</span>
                </a>
              </div>
            </li>
          </ul>
        </div>
        </nav>
      </nav>
      <!-- End Navbar -->
      <!-- Header -->
      <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
          <div class="header-body">
            <!-- Card stats -->
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aset Gedung</button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="pengelolaan.html">Aset Barang</a>
                <a class="dropdown-item" href="p_gedung.html">Aset Gedung</a>
              </div>
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#basicExampleModal">
                Tambah Data
              </button>
              <a class="btn btn-info" href="#" role="button">Import Data</a>

              <!-- Modal -->
              <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Aset Gedung</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <!-- Default form contact -->
                        <form class="text-center border border-light p-5" action="#!">
                          <input type="text" id="defaultContactFormName" class="form-control mb-4" placeholder="No">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Kode Satker">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Nama Satker">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Kode Barang">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Nama Barang">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="NUP">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Kondisi">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Dokumen">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Merk/Tipe">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Tgl Rekam Pertama">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Tgl Perolehan">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Nilai Perolehan Pertama">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Nilai Mutasi">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Nilai Perolehan">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Nilai Penyusutan">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Nilai Buku">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="KUANTITAS">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Luas Bangunan">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Luas Dasar Bangunan">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Jumlah Lantai">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Jml Foto">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Jalan">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Kode Kab/Kota">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Uraian Kota/Kabupaten">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Kode Provinsi">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Uraian Provinsi">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Kode Pos">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Status Penggunaan">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Status Pengelolaan">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="No PSP">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Tgl PSP">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Jml KIB">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="SBSK">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="OPTIMALISASI">
                          <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Status SBSN">
                        </form>
                        <!-- Default form contact -->
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Tambah Data</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid mt--7">
        <!-- Table -->
        <!-- Editable table -->
<div class="card">
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">
    ASET Gedung
  </h3>
  <div class="card-body">
    <div id="table" class="table-editable" style="overflow-x:auto;">
      <table class="table table-bordered table-responsive-md table-striped text-center">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th class="text-center">Kode Satker</th>
            <th class="text-center">Nama Satker</th>
            <th class="text-center">Kode Barang</th>
            <th class="text-center">Nama Barang</th>
            <th class="text-center">NUP</th>
            <th class="text-center">Kondisi</th>
            <th class="text-center">Dokumen</th>
            <th class="text-center">Merk/Tipe</th>
            <th class="text-center">Tgl Rekam Pertama</th>
            <th class="text-center">Tgl Perolehan</th>
            <th class="text-center">Nilai Perolehan Pertama</th>
            <th class="text-center">Nilai Mutasi</th>
            <th class="text-center">Nilai Perolehan</th>
            <th class="text-center">Nilai Penyusutan</th>
            <th class="text-center">Nilai Buku</th>
            <th class="text-center">KUANTITAS</th>
            <th class="text-center">Luas Bangunan</th>
            <th class="text-center">Luas Dasar Bangunan</th>
            <th class="text-center">Jumlah Lantai</th>
            <th class="text-center">Jml Foto</th>
            <th class="text-center">Jalan</th>
            <th class="text-center">Kode Kab/Kota</th>
            <th class="text-center">Uraian Kota/Kabupaten</th>
            <th class="text-center">Kode Provinsi</th>
            <th class="text-center">Uraian Provinsi</th>
            <th class="text-center">Kode Pos</th>
            <th class="text-center">Status Penggunaan</th>
            <th class="text-center">Status Pengelolaan</th>
            <th class="text-center">No PSP</th>
            <th class="text-center">Tgl PSP</th>
            <th class="text-center">Jml KIB</th>
            <th class="text-center">SBSK</th>
            <th class="text-center">OPTIMALISASI</th>
            <th class="text-center">Status SBSN</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center">1</td>
            <td class="text-center">023183200677620001KD</td>
            <td class="text-center">4201</td>
            <td class="text-center">4010101001</td>
            <td class="text-center">Bangunan Gedung Kantor Permanen</td>
            <td class="text-center">8</td>
            <td class="text-center">Baik</td>
            <td class="text-center">IMB</td>
            <td class="text-center">mereklas atap parkir dan gedung workshop</td>
            <td class="text-center">25/11/2020</td>
            <td class="text-center">02/12/2016</td>
            <td class="text-center">4268140742</td>
            <td class="text-center">0</td>
            <td class="text-center">4268140742</td>
            <td class="text-center">471670412</td>
            <td class="text-center">3796470330</td>
            <td class="text-center">1</td>
            <td class="text-center">800</td>
            <td class="text-center">800</td>
            <td class="text-center">1</td>
            <td class="text-center">4</td>
            <td class="text-center">Ahmad Yani</td>
            <td class="text-center">3251</td>
            <td class="text-center">KOTA BATAM</td>
            <td class="text-center">3200</td>
            <td class="text-center">KEPULAUAN RIAU</td>
            <td class="text-center">29461</td>
            <td class="text-center">Digunakan sendiri untuk operasional</td>
            <td class="text-center">Penetapan Status Penggunaan BMN</td>
            <td class="text-center">135/KM.6/WKN.03/KNL.04/2021</td>
            <td class="text-center">02/09/2021</td>
            <td class="text-center">0</td>
            <td class="text-center">72</td>
            <td class="text-center">728</td>
            <td class="text-center">-</td>
            </td>
            <td>
              <span class="table-remove"
                ><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">
                  Delete
                </button></span
              >
              <span class="table-remove"
              ><button type="button" class="btn btn-success btn-rounded btn-sm my-0">
                Edit
              </button></span
            >
            </td>
          </tr>
          <!-- This is our clonable table line -->
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- Editable table -->
        <!-- Footer -->
        <footer class="footer">
        </footer>
      </div>
    </div>
    <!--   Core   -->
    <script src="assets/js/plugins/jquery/dist/jquery.min.js"></script>
    <script src="assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!--   Optional JS   -->
    <!--   Argon JS   -->
    <script src="assets/js/argon-dashboard.min.js?v=1.1.2"></script>
    <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
    <script>
      window.TrackJS &&
        TrackJS.install({
          token: "ee6fab19c5a04ac1a32a645abde4613a",
          application: "argon-dashboard-free",
        });
    </script>
  </body>
</html>
