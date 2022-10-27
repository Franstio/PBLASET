@extends('layouts.app')

@section('content')
<div class="main-content">
      <!-- Navbar -->

      <!-- End Navbar -->
      <!-- Header -->
      <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
          <div class="header-body">
            <!-- Card stats -->
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Gedung</button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="">Gedung Utama</a>
                <a class="dropdown-item" href="">Bengkel/Workshop</a>
                <a class="dropdown-item" href="">Asrama Mahasiswa</a>
                <a class="dropdown-item" href="">Teaching Factory</a>
                <a class="dropdown-item" href="">Tower Monas</a>
                <a class="dropdown-item" href="">Hanggar (HK)</a>
                <a class="dropdown-item" href="">Nongsa Digital Park</a>
                <a class="dropdown-item" href="">lain lain</a>
                <a class="dropdown-item" href="">Riancian Parkiran</a>
              </div>
              </div>
              <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Lantai</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="">1</a>
                  <a class="dropdown-item" href="">2</a>
                  <a class="dropdown-item" href="">3</a>
                  <a class="dropdown-item" href="">4</a>
                  <a class="dropdown-item" href="">5</a>
                  <a class="dropdown-item" href="">6</a>
                  <a class="dropdown-item" href="">7</a>
                  <a class="dropdown-item" href="">8</a>
                  <a class="dropdown-item" href="">9</a>
                  <a class="dropdown-item" href="">10</a>
                </div>
                </div>
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ruangan</button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="">RUANG DOSEN & ADMINISTRASI</a>
                    <a class="dropdown-item" href="">QUESTION BANK</a>
                    <a class="dropdown-item" href="">CLASS ROOM 2</a>
                    <a class="dropdown-item" href="">RUANG GM</a>
                    <a class="dropdown-item" href="">CLASS ROOM 1</a>
                    <a class="dropdown-item" href="">TOILET PRIA 0.1</a>
                    <a class="dropdown-item" href="">TOILET WANITA 0.1</a>
                    <a class="dropdown-item" href="">JANITOR ROOM</a>
                    <a class="dropdown-item" href="">MUSHOLA</a>
                    <a class="dropdown-item" href="">TEMPAT WUDHU</a>
                  </div>
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
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang Ruangan</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <!-- Default form contact -->
                        <form class="text-center border border-light p-5" action="#!">
                          <input type="text" id="defaultContactFormName" class="form-control mb-4" placeholder="Nama Gedung">
                          <input type="email" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Nomor Lantai">
                          <input type="text" id="defaultContactFormName" class="form-control mb-4" placeholder="Nama Ruangan">
                          <input type="text" id="defaultContactFormName" class="form-control mb-4" placeholder="Kode Aset Barang">
                          <input type="text" id="defaultContactFormName" class="form-control mb-4" placeholder="Kode Barang">
                          <input type="text" id="defaultContactFormName" class="form-control mb-4" placeholder="Kode Satker">
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
    Daftar Barang Ruangan
  </h3>
  <div class="card-body">
    <div id="table" class="table-editable">
      <table class="table table-bordered table-responsive-md table-striped text-center">
        <thead>
          <tr>
            <th class="text-center">Nama Gedung</th>
            <th class="text-center">Nomor Lantai</th>
            <th class="text-center">Nama Ruangan</th>
            <th class="text-center">Kode Aset Barang</th>
            <th class="text-center">Kode Barang</th>
            <th class="text-center">Kode Satker</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="pt-3-half" contenteditable="true"></td>
            <td class="pt-3-half" contenteditable="true"></td>
            <td class="pt-3-half" contenteditable="true"></td>
            <td class="pt-3-half" contenteditable="true"></td>
            <td class="pt-3-half" contenteditable="true"></td>
            <td class="pt-3-half" contenteditable="true"></td>
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

@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
