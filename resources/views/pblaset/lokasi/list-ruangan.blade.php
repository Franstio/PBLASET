@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="dropdown">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#basicExampleModal">
                    Tambah Data
                </button>
                <!-- Modal -->
                <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Ruangan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Default form contact -->
                                <form id="frm1" class="text-center border border-light p-5" method="POST" action="{{ route("lokasi.ruangan.create",[$data["nama_gedung"],$data["kode_gedung"],$data["no_lantai"],$data["kode_lantai"]] ) }}">
                                    @csrf
                                    <input type="text" id="defaultContactFormName" class="form-control mb-4" name="Kode_Ruangan" placeholder="Kode Ruangan">
                                    <input type="text" id="defaultContactFormName" class="form-control mb-4" name="Nama_Ruangan" placeholder="Nama Ruangan">
                                </form>
                                <!-- Default form contact -->
                            </div>
                            <div class="modal-footer">
                                <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" value="Tambah Data" form="frm1" />
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
            List Ruangan
        </h3>
        <div class="card-body">
            <div id="table" class="table-editable">
                <table id="tbl" class="table table-bordered table-responsive-md table-striped text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="text-center">Nama Ruangan</th>
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
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit List Ruangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Default form contact -->
                <form  class="text-center border border-light p-5" method="POST" id='frmEdit' action="#!">
                    @csrf
                    <input type="text"  class="form-control mb-4" id="kode_ruangan" name="Kode_Ruangan" placeholder="Kode Ruangan">
                    <input type="text" class="form-control mb-4" id="nama_ruangan" name="Nama_Ruangan" placeholder="Nama Ruangan">
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
            , ajax:
            {
                url : "{{ route('lokasi.ruangan.read',[$data["nama_gedung"],$data["kode_gedung"],$data["no_lantai"],$data["kode_lantai"]]) }}?Kode_Lantai={{ $data["kode_lantai"] }}",
            },
             columns: [{
                    data: 'DT_RowIndex'
                    , name: 'DT_RowIndex'
                }
                , {
                    data: "Nama_Ruangan"
                    , name: "Nama_Ruangan"
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
        var route = "{{ route("lokasi.ruangan.update",[$data["nama_gedung"],$data["kode_gedung"],$data["no_lantai"],$data["kode_lantai"],"test"]) }}";
        route = route.replace("test", data.Kode_Ruangan);
        $("#frmEdit").attr("action", route);
        $("#kode_ruangan").val(data.Kode_Ruangan);
        $("#nama_ruangan").val(data.Nama_Ruangan);
        $("#EditModal").modal("show");
    }

    function Delete(data) {
        var route = "{{ route("lokasi.ruangan.delete",[$data["nama_gedung"],$data["kode_gedung"],$data["no_lantai"],$data["kode_lantai"],"test"]) }}";
        console.log(route);
        route = route.replace("test", data);
        console.log(route);
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
