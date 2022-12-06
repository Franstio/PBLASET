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
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tahun</button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="">2018</a>
                        <a class="dropdown-item" href="">2019</a>
                        <a class="dropdown-item" href="">2020</a>
                        <a class="dropdown-item" href="">2021</a>
                        <a class="dropdown-item" href="">2022</a>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aset Barang</button>
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
                    <div class="modal w-100 fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg w-100" role="modal">
                            <div class="modal-content w-100">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Aset Barang</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body w-100">
                                    <!-- Default form contact -->
                                    <div id="apps">
                                        <v-app app>
                                            <form class="text-center border border-light p-5" action="#!">
                                                <v-stepper v-model="e1">
                                                    <v-stepper-header>
                                                      <v-stepper-step :complete="e1 > 1" step="1">Pilih Master Barang</v-stepper-step>

                                                      <v-divider></v-divider>

                                                      <v-stepper-step  step="2">Masukkan Data Detail Barang</v-stepper-step>
                                                    </v-stepper-header>

                                                    <v-stepper-items>
                                                      <v-stepper-content step="1">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="text" id="defaultContactFormName" class="form-control  " placeholder="No">
                                                            </div>
                                                            <div class="col">
                                                                <input type="text" id="defaultContactFormEmail" class="form-control " placeholder="Kode Satker">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Nama Satker">
                                                            </div>
                                                            <div class="col">
                                                                <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Kode Barang">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Nama Barang">
                                                            </div>
                                                            <div class="col">
                                                                <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="NUP">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Merk/Tipe">
                                                            </div>
                                                            <div class="col">
                                                                <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Kode Ruangan">
                                                            </div>
                                                        </div>
                                                        <v-btn
                                                          color="primary"
                                                          @click="e1 = 2"
                                                        >
                                                          Next
                                                        </v-btn>
                                                      </v-stepper-content>

                                                      <v-stepper-content step="2">
                                                        <input type="text" id="defaultContactFormName" class="form-control mb-4" placeholder="No">
                                                        <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Kode Satker">
                                                        <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Nama Satker">
                                                        <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Kode Barang">
                                                        <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Kode Ruangan">
                                                        <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Nama Barang">
                                                        <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="NUP">
                                                        <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Merk/Tipe">
                                                        <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Tgl Rekam Pertama">
                                                        <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Tgl Perolehan">
                                                        <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Nilai Perolehan Pertama">
                                                        <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Nilai Mutasi">
                                                        <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Nilai Perolehan">
                                                        <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Nilai Penyusutan">
                                                        <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Nilai Buku">
                                                        <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="KUANTITAS">
                                                        <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Jml Foto">
                                                        <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Status Penggunaan">
                                                        <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Status Pengelolaan">
                                                        <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="No PSP">
                                                        <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Jumlah KIB">

                                                        <v-btn
                                                          color="primary"
                                                          @click="e1 = 1"
                                                        >
                                                          Back
                                                        </v-btn>

                                                        <v-btn text>Cancel</v-btn>
                                                      </v-stepper-content>
                                                    </v-stepper-items>
                                                </v-stepper>
                                            </form>
                                        </v-app>
                                    </div>

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
        <div class="card">
            <h3 class="card-header text-center font-weight-bold text-uppercase py-4">
                ASET BARANG
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
                                <th class="text-center">Kode Ruangan</th>
                                <th class="text-center">Nama Barang</th>
                                <th class="text-center">NUP</th>
                                <th class="text-center">Kondisi</th>
                                <th class="text-center">Merk/Tipe</th>
                                <th class="text-center">Tgl Rekam Pertama</th>
                                <th class="text-center">Tgl Perolehan</th>
                                <th class="text-center">Nilai Perolehan Pertama</th>
                                <th class="text-center">Nilai Mutasi</th>
                                <th class="text-center">Nilai Perolehan</th>
                                <th class="text-center">Nilai Penyusutan</th>
                                <th class="text-center">Nilai Buku</th>
                                <th class="text-center">KUANTITAS</th>
                                <th class="text-center">Jml Foto</th>
                                <th class="text-center">Status Penggunaan</th>
                                <th class="text-center">Status Pengelolaan</th>
                                <th class="text-center">No PSP</th>
                                <th class="text-center">Tgl PSP</th>
                                <th class="text-center">Jumlah KIB</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-center">023183200677620000KD</td>
                                <td class="text-center">Politeknik Negeri Batam</td>
                                <td class="text-center">3010303004</td>
                                <td class="text-center"></td>
                                <td class="text-center">Air Compresor</td>
                                <td class="text-center">1</td>
                                <td class="text-center">Baik</td>
                                <td class="text-center">Screw Air compressor Set</td>
                                <td class="text-center">31/10/2021</td>
                                <td class="text-center">31/12/2017</td>
                                <td class="text-center">68225000</td>
                                <td class="text-center">0</td>
                                <td class="text-center">68225000</td>
                                <td class="text-center">48732142</td>
                                <td class="text-center">19492858</td>
                                <td class="text-center">1</td>
                                <td class="text-center">1</td>
                                <td class="text-center">Digunakan sendiri untuk operasional</td>
                                <td class="text-center"></td>
                                <td class="text-center">39/M/2021</td>
                                <td class="text-center">10/02/2022</td>
                                <td class="text-center">0</td>
                                </td>
                                <td>
                                    <span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">
                                            Delete
                                        </button></span>
                                    <span class="table-remove"><button type="button" class="btn btn-success btn-rounded btn-sm my-0">
                                            Edit
                                        </button></span>
                                </td>
                            </tr>
                            <!-- This is our clonable table line -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
@vite(['resources/js/app.js'])
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

@endpush
