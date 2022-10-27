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
            <li class="nav-item">
              <a class="nav-link" href="pengelolaan.html"> <i class="ni ni-planet text-blue"></i> Pengelolaan </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="l_ruangan.html"> <i class="ni ni-pin-3 text-orange"></i> List Ruangan </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link active" href="DBR.html"> <i class="ni ni-single-02 text-yellow"></i> Daftar Barang Ruangan </a>
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
          <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="DBR.html">Daftar Barang Ruangan (Lantai)</a>
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
                <a class="btn btn-secondary" href="DBR.html" role="button">Gedung</a>
                <a class="btn btn-secondary active" href="lantai.html" role="button">Lantai</a>
                <a class="btn btn-secondary" href="ruangan.html" role="button">Ruangan</a>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#basicExampleModal">
                  Tambah Data
                </button>

              <!-- Modal -->
              <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Lantai</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <!-- Default form contact -->
                        <form class="text-center border border-light p-5" action="#!">

                          <!-- Name -->
                          <input type="text" id="defaultContactFormName" class="form-control mb-4" placeholder="Name">

                          <!-- Email -->
                          <input type="email" id="defaultContactFormEmail" class="form-control mb-4" placeholder="E-mail">

                          <select class="browser-default custom-select mb-4">
                              <option value="" disabled>Choose option</option>
                              <option value="1" selected>Feedback</option>
                              <option value="2">Report a bug</option>
                              <option value="3">Feature request</option>
                              <option value="4">Feature request</option>
                          </select>

                          <!-- Message -->
                          <div class="form-group">
                              <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" placeholder="Message"></textarea>
                          </div>

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
    Daftar Barang Ruangan (Lantai)
  </h3>
  <div class="card-body">
    <div id="table" class="table-editable">
      <table class="table table-bordered table-responsive-md table-striped text-center">
        <thead>
          <tr>
            <th class="text-center">Person Name</th>
            <th class="text-center">Age</th>
            <th class="text-center">Company Name</th>
            <th class="text-center">Country</th>
            <th class="text-center">City</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="pt-3-half" contenteditable="true">Aurelia Vega</td>
            <td class="pt-3-half" contenteditable="true">30</td>
            <td class="pt-3-half" contenteditable="true">Deepends</td>
            <td class="pt-3-half" contenteditable="true">Spain</td>
            <td class="pt-3-half" contenteditable="true">Madrid</td>
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
          <tr>
            <td class="pt-3-half" contenteditable="true">Guerra Cortez</td>
            <td class="pt-3-half" contenteditable="true">45</td>
            <td class="pt-3-half" contenteditable="true">Insectus</td>
            <td class="pt-3-half" contenteditable="true">USA</td>
            <td class="pt-3-half" contenteditable="true">San Francisco</td>
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
          <tr>
            <td class="pt-3-half" contenteditable="true">Guadalupe House</td>
            <td class="pt-3-half" contenteditable="true">26</td>
            <td class="pt-3-half" contenteditable="true">Isotronic</td>
            <td class="pt-3-half" contenteditable="true">Germany</td>
            <td class="pt-3-half" contenteditable="true">Frankfurt am Main</td>
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
          <tr class="hide">
            <td class="pt-3-half" contenteditable="true">Elisa Gallagher</td>
            <td class="pt-3-half" contenteditable="true">31</td>
            <td class="pt-3-half" contenteditable="true">Portica</td>
            <td class="pt-3-half" contenteditable="true">United Kingdom</td>
            <td class="pt-3-half" contenteditable="true">London</td>
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
