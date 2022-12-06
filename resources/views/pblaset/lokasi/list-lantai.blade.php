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
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Nomor Lantai</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Default form contact -->
                                <form class="text-center border border-light p-5" action="{{ route("lokasi.lantai.create",[$data["nama_gedung"],$data["kode_gedung"]]) }}" id="frm1" method="POST">
                                    @csrf
                                    <input type="number" step="1" min="1" id="defaultContactFormName" class="form-control mb-4" name="no_lantai" placeholder="Nomor Lantai">
                                </form>
                                <!-- Default form contact -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" form='frm1' class="btn btn-primary" value="Tambah Data" >
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
            List Lantai ({{ $data["nama_gedung"] }})
        </h3>
        <div class="card-body">
            <div id="table" class="table-editable">
                <table id="tbl" class="table table-bordered table-responsive-md table-striped text-center">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Lantai</th>
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
                <h5 class="modal-title" id="exampleModalLabel">Edit List Lantai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Default form contact -->
                <form method="POST" id="frmEdit" class="text-center border border-light p-5" action="#!">
                    @csrf
                    <input type="text" id="no_lantai" class="form-control mb-4" name="no_lantai" placeholder="Lantai">
                </form>
                <!-- Default form contact -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Edit Data" form="frmEdit" />
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
            , ajax: {
                url:"{{ route('lokasi.lantai.read',[$data["nama_gedung"],$data["kode_gedung"]]) }}?Kode_Gedung={{ $data["kode_gedung"] }}",
            }
            , columns: [{
                    data: 'DT_RowIndex'
                    , name: 'DT_RowIndex'
                }
                , {
                    data: "no_lantai"
                    , name: "no_lantai"
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
        var route = "{{ route("lokasi.lantai.update",[$data["nama_gedung"],$data["kode_gedung"],"test"]) }}";
        route = route.replace("test", data.id);
        $("#frmEdit").attr("action", route);
        $("#no_lantai").val(data.no_lantai);
        $("#EditModal").modal("show");
    }

    function Detail(id,nm)
    {
        let url = '{{ route('lokasi.ruangan',[$data["kode_gedung"],$data["nama_gedung"],"no_lantai","kode_lantai"]) }}';
        url = url.replace("no_lantai",nm);
        url = url.replace("kode_lantai",id);
        console.log(url);
        window.location  = url;
    }
    function Delete(data) {
        var route = "{{ route('lokasi.lantai.delete',[$data["nama_gedung"],$data["kode_gedung"],"test"]) }}";
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
