@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="dropdown">
                <!-- Button trigger modal -->
                <div class="dropdown">
                </div>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#basicExampleModal">
                    Tambah Data
                </button>

                <!-- Modal -->
                <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Nama Gedung</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="frm" class="text-center border border-light p-5" method="POST" action="{{ route("lokasi.gedung.create") }}">
                                    @csrf
                                    <input type="text" id="defaultContactFormName" class="form-control mb-4" name="Nama_Gedung" placeholder="Nama Gedung">
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" form="frm" class="btn btn-primary" value="Tambah Data">
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
            List Gedung
        </h3>
        <div class="card-body">
            <div id="table" class="table-editable">
                <table id="tbl" class="table table-bordered table-responsive-md table-striped text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th class="text-center">Nama Gedung</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="frmEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit List Gedung</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Default form contact -->
                <form id="frm2" class="text-center border border-light p-5" action="#!" method="POST">
                    @csrf
                    <input type="text" id="defaultContactFormName" id="Nama_Gedung" class="form-control mb-4" name="Nama_Gedung" placeholder="Nama Gedung">
                </form>
                <!-- Default form contact -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" form="frm2" class="btn btn-primary" value="Edit Data" />
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
            , ajax: "{{ route('lokasi.gedung.read') }}"
            , columns: [{
                    data: 'DT_RowIndex'
                    , name: 'DT_RowIndex'
                },
                {data:"id",name:"id"}
                , {
                    data: "Nama_Gedung"
                    , name: 'Nama_Gedung'
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
        var route = "{{ route("lokasi.gedung.update","test") }}";
        route = route.replace("test", data.id);
        $("#frmEdit").attr("action", route);
        $("#nama_gedung").val(data.id);
        $("#EditModal").modal("show");
    }

    function Delete(data) {
        var route = "{{ route('lokasi.gedung.delete',"test") }}";
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
