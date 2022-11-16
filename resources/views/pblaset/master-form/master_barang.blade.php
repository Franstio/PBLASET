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
                    <!-- Button trigger modal -->
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Master Barang</button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route("master.satker") }}">Master Satker</a>
                            <a class="dropdown-item" href="{{ route("master-aset-barang-index") }}">Master Barang</a>
                            <a class="dropdown-item" href="mastergedung.html">Master Gedung</a>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#basicExampleModal">
                        Tambah Data
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form class="text-center border border-light p-5" action="{{ route("tambah-master-aset-barang") }}" method="POST">
@csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Master Barang</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Default form contact -->
                                        <input type="text" id="defaultContactFormName" class="form-control mb-4" name="Kode_Barang" placeholder="Kode Barang">
                                        <input type="text" id="defaultContactFormName" class="form-control mb-4" name="Nama_Barang" placeholder="Nama Barang">
                                        <input type="text" id="defaultContactFormName" class="form-control mb-4" name="Merk_Tipe" placeholder="Merk/Tipe Barang">
                                    <!-- Default form contact -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-primary" value="Tambah Data">
                                </div>
                                </form>

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
                Master Asset Barang
            </h3>
            <div class="card-body">
                <div class="table-editable">
                    <table id="tbl"  class="table table-bordered table-responsive-md table-striped text-center">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Kode Barang</th>
                                <th class="text-center">Nama Barang</th>
                                <th class="text-center">Merk Tipe</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id='formEdit' class="text-center border border-light p-5" action="" method="POST">
                @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Master Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Default form contact -->
                    <input type="text" id="kode_barang" name="Kode_Barang" class="form-control mb-4" placeholder="Kode Barang">
                    <input type="text" id="nama_barang" name="Nama_Barang" class="form-control mb-4" placeholder="Nama Barang">
                    <input type="text" id="merk_tipe" name="Merk_Tipe" class="form-control mb-4" placeholder="Merk/Tipe Barang">
                <!-- Default form contact -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Edit Data" >
            </div>
            </form>
    </div>
    </div>
</div>


@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
<script>
    $(function() {
        var table = $('#tbl').DataTable({
            processing: true
            , serverSide: true
            , ajax: "{{ route('get-master-barang') }}"
            , columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: "Kode_Barang"
                    ,name: 'Kode_Barang'
                }
                , {
                    data: 'Nama_Barang'
                    , name: 'Nama_Barang'
                },
                {
                    data: "Merk_Tipe",
                    name: "Merk_Tipe"
                }
                , {
                    data: 'action'
                    , name: 'action'
                    , orderable: true
                    , searchable: true
                }
            , ]
        });

    });
    function Edit(data)
    {
        var route = "{{ route('update-master-aset-barang',"test") }}";
        route = route.replace("test",data.Kode_Barang);
        console.log(route);
        $("#formEdit").attr("action",route);
        $("#nama_barang").val(data.Nama_Barang);
        $("#kode_barang").val(data.Kode_Barang);
        $("#merk_tipe").val(data.Merk_Tipe);
        $("#EditModal").modal("show");
    }
    function Delete(data)
    {
        var route = "{{ route('delete-master-aset-barang',"test") }}";
        route = route.replace("test",data);
        $.ajax({
            url : route,
            method : 'DELETE',
            data: {
                _token:  '{{ csrf_token() }}',
                _method:'DELETE'
            }
        }).done(function() {
            $("#tbl").DataTable().ajax.reload();
        });

    }
</script>
@endpush
