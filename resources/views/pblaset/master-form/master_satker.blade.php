@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="dropdown">
                <!-- Button trigger modal -->
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $name }}</button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route("master.satker") }}">Master Satker</a>
                        <a class="dropdown-item" href="{{ route("master-aset-barang-index") }}">Master Aset Barang</a>
                        <a class="dropdown-item" href="{{ route("master.gedung") }}">Master Aset Gedung</a>
                    </div>
                </div>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#basicExampleModal">
                    Tambah Data
                </button>
                <!-- Modal -->
                <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Master Satker</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Default form contact -->
                                <form id="frm" class="text-center border border-light p-5" action="{{ route("master.satker.create") }}" method="POST">
                                    @csrf
                                    <input type="text" id="defaultContactFormName" class="form-control mb-4" name="Kode_Satker" placeholder="Kode Satker">
                                    <input type="text" id="defaultContactFormName" class="form-control mb-4" name="Nama_Satker" placeholder="Nama Satker">
                                </form>
                                <!-- Default form contact -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" form="frm" class="btn btn-primary">Tambah Data</button>
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
            Master Satker
        </h3>
        <div class="card-body">
            <div  class="table-editable">
                <table id="tbl" class="table table-bordered table-responsive-md table-striped text-center">
                    <thead>
                        <tr>
                            <th class="text-center">No. </th>
                            <th class="text-center">Kode Satker</th>
                            <th class="text-center">Nama Satker</th>
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
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Master Satker</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Default form contact -->
                <form id="frmEdit" class="text-center border border-light p-5" action="{{ route("master.satker.update","test") }}" method="POST">
                    @csrf
                    <input type="text" id="kode_satker" class="form-control mb-4" name="Kode_Satker" placeholder="Kode Satker">
                    <input type="text" id="nama_satker" class="form-control mb-4" name="Nama_Satker" placeholder="Nama Satker">
                </form>
                <!-- Default form contact -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="frmEdit" class="btn btn-primary">Edit Data</button>
            </div>
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
            , ajax: "{{ route('master.satker.read') }}"
            , columns: [{
                    data: 'DT_RowIndex'
                    , name: 'DT_RowIndex'
                }
                , {
                    data: "Kode_Satker"
                    , name: 'Kode_Satker'
                }
                , {
                    data: 'Nama_Satker'
                    , name: 'Nama_Satker'
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

    function Edit(data) {
        var route = "{{ route("master.satker.update","test") }}";
        route = route.replace("test", data.Kode_Satker);
        console.log(route);
        $("#frmEdit").attr("action", route);
        $("#nama_satker").val(data.Nama_Satker);
        $("#kode_satker").val(data.Kode_Satker);
        $("#EditModal").modal("show");
    }

    function Delete(data) {
        var route = "{{ route('master.satker.delete',"test ") }}";
        route = route.replace("test", data);
        $.ajax({
            url: route
            , method: 'DELETE'
            , data: {
                _token: '{{ csrf_token() }}'
                , _method: 'DELETE'
            }
        }).done(function() {
            $("#tbl").DataTable().ajax.reload();
        });

    }

</script>
@endpush
