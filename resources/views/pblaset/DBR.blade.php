@extends('layouts.app')

@section('content')
<!-- Header -->
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $year ?? "Tahun" }}</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route("DBR") }}">ALL</a>
                    @foreach ($listYear as $tahun)
                    <a class="dropdown-item" href="{{ route("DBR",$tahun->Tahun_Data) }}">{{ $tahun->Tahun_Data }}</a>
                    @endforeach
                </div>
            </div>
            @if(isset($listYear))

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $data["gedung"][0]->Nama_Gedung ?? "Gedung"  }}</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach ($data["listGedung"] as $gedung)
                        <a class="dropdown-item" href="{{ route("DBR",$tahun->Tahun_Data) }}?kode_gedung={{ $gedung->id }}">{{ $gedung->Nama_Gedung }}</a>
                    @endforeach
                </div>
            </div>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $data["lantai"][0]->no_lantai ?? "Lantai" }}</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach ($data["listLantai"] as $lantai)
                        <a class="dropdown-item" href="{{ route("DBR",$tahun->Tahun_Data) }}?kode_gedung={{ $lantai->Kode_Gedung }}&id_lantai={{ $lantai->id }}">{{ $lantai->No_Lantai }}</a>
                    @endforeach
                </div>
            </div>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $data["ruangan"][0]->Nama_Ruangan ?? "Ruangan"}}</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach ($data["listRuangan"] as $ruangan)
                    <a class="dropdown-item" href="{{ route("DBR",$tahun->Tahun_Data)  }}?kode_gedung={{ $ruangan->Kode_Gedung }}&id_lantai={{ $ruangan->Kode_Lantai }}&kode_ruangan={{ $ruangan->Kode_Ruangan }}">{{ $ruangan->Nama_Ruangan }}</a>
                    @endforeach
                </div>
                <a class="btn btn-info" href="{{ route("DBR.Export") }}?kode_gedung={{ $data['gedung'][0]->id ?? "" }}&id_lantai={{ $data['lantai'][0]->id ?? "" }}&kode_ruangan={{ $data['ruangan'][0]->Kode_Ruangan ?? ""}} &year={{ $year }}" role="button">Export QR</a>
                <!-- Button trigger modal -->

                <!-- Modal -->
                <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <input type="text" id="defaultContactFormName" class="form-control mb-4" placeholder="QR Code">
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
            @endif
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
            <div id="table" class="table-editable" style="overflow-x:auto;">
                <table id="tbl" class="table table-bordered table-responsive-md table-striped text-center">
                    <thead>
                        <tr>
                            <th class="text-center">No </th>
                            <th class="text-center">Lokasi Penyimpanan</th>
                            <th class="text-center">Kode Barang</th>
                            <th class="text-center">Nama Barang</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">NUP</th>
                            <th class="text-center">Merk</th>
                            <th class="text-center">QR Code</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    $(function() {
    var table = $('#tbl').DataTable({
        processing: true
        , serverSide: true
        , ajax: "{{ route('aset.barang.dbr') }}?kode_gedung={{ $data['gedung'][0]->id ?? "" }}&id_lantai={{ $data['lantai'][0]->id ?? "" }}&kode_ruangan={{ $data['ruangan'][0]->Kode_Ruangan ?? ""}}&year={{ $year }}"
        , columns: [{
                data: 'DT_RowIndex'
                , name: 'DT_RowIndex'
                },
                {name:"Lokasi",data:"Lokasi"},
                {name:"Kode_Barang",data:"Kode_Barang"},
                {name:"Nama_Barang",data:"Nama_Barang"},
                {name:"Nilai_Perolehan_Pertama",data:"Nilai_Perolehan_Pertama"},
                {name:"NUP",data:"NUP"},

                {name:"Merk_Tipe",data:"Merk_Tipe"},

                {name:"QR",data:"QR"},
         ]
    });

});
</script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush

