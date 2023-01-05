@extends('layouts.app')

@section('content')

<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            @if($count = Session::get('Count'))
            <div class="alert alert-info alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Deleted {{ $count }} Data</strong>
            </div>
            @endif
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $year ?? "Tahun" }}</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route("aset.gedung.pengolahan") }}">ALL</a>
                    @foreach ($listYear as $tahun)
                    <a class="dropdown-item" href="{{ route("aset.gedung.pengolahan",$tahun->Tahun_Data) }}">{{ $tahun->Tahun_Data }}</a>
                    @endforeach
                </div>
            </div>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aset Gedung</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route("pengolahan") }}">Aset Barang</a>
                    <a class="dropdown-item" href="{{ route("aset.gedung.pengolahan") }}">Aset Gedung</a>
                </div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#mdlInsert">
                    Tambah Data
                </button>
                <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#mdlImport">Import Data</button>
                <a class="btn btn-info" href="{{ route("aset.gedung.export",$year ?? "") }}" role="button">Export Data</a>
                @if ($year != "" && $year != null)
                <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{ route("aset.gedung.delete.year",$year) }}" role="button">Delete Data {{ $year }}</a>
                @endif
                               <!-- Modal -->

            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--7">
    <div class="card">
        <h3 class="card-header text-center font-weight-bold text-uppercase py-4">
            ASET GEDUNG
        </h3>
        <div class="card-body">
            <div id="table" class="table-editable" style="overflow-x:auto;">
                <table id="tbl" class="table table-bordered table-responsive-md table-striped text-center">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Kode Satker</th>
                            <th class="text-center">Nama Satker</th>
                            <th class="text-center">Kode Gedung</th>
                            <th class="text-center">Nama Gedung</th>
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
                            <th class="text-center">Dokumen</th>
                            <th class="text-center">Luas Bangunan</th>
                            <th class="text-center">Luas Dasar Bangunan</th>
                            <th class="text-center">Jumlah Lantai</th>
                            <th class="text-center">Jalan</th>
                            <th class="text-center">Kode Kabupaten Kota</th>
                            <th class="text-center">Uraian Kabupaten Kota</th>
                            <th class="text-center">Kode Provinsi</th>
                            <th class="text-center">Uraian Provinsi</th>
                            <th class="text-center">Kode POS</th>
                            <th class="text-center">SBSK</th>
                            <th class="text-center">Optimalisasi</th>
                            <th class="text-center">Status SBSN</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- This is our clonable table line -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<v-app>
<form-import csrf="{{  csrf_token()}}" title="Import Data Aset Gedung" url="{{ route("aset.gedung.import") }}"></form-import>
<form-aset-gedung csrf="{{  csrf_token()}}" modalid="mdlInsert" url-detail-gedung="{{ route("aset.gedung.details.find","") }}" url-list-satker="{{ route("satker.list","") }}" url-master-gedung="{{ route("aset.gedung.list","") }}" url="{{ route("aset.gedung.detail.create") }}" id="" title="Tambah Aset Gedung" form="frmInsert"></form-aset-gedung>
<form-aset-gedung csrf="{{  csrf_token()}}" url="{{ route("aset.gedung.detail.update","1") }}" id="" modalid="mdlUpdate" form="frmUpdate" url-detail-gedung="{{ route("aset.gedung.details.find","") }}" url-list-satker="{{ route("satker.list","") }}" url-master-gedung="{{ route("aset.gedung.list","") }}"></form-aset-gedung>
</v-app>
@endsection

@push('js')
<script>

        function Edit(data)
        {
            let url = "{{ route("aset.gedung.detail.update",'test') }}";
            url = url.replace("test",data.id);
            $("#frmUpdate").attr("action",url);
            console.log({id: data.id});
            window.app.$children[window.app.$children.length-1].setUrl(url);
            window.app.$children[window.app.$children.length-1].retrieveDetails(data.id);
            $("#mdlUpdate").modal("show");
        }
        function Delete(data)
        {
            var route = "{{ route('aset.gedung.detail.delete',"test") }}";
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
        $(function() {
        var table = $('#tbl').DataTable({
            processing: true
            , serverSide: true
            , ajax: "{{ route('aset.gedung.detail') }}{{ ($year != null && $year != "") ? "?Tahun_Data=$year" : '' }}"
            , columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {name:"Kode_Satker",data:"Kode_Satker"},
                    {name:"Nama_Satker",data:"Nama_Satker"},
                    {name:"Kode_Gedung",data:"Kode_Gedung"},
                    {name:"Nama_Gedung",data:"Nama_Gedung"},
                    {name:"NUP",data:"NUP"},
                    {name:"Kondisi",data:"Kondisi"},
                    {name:"Merk_Tipe",data:"Merk_Tipe"},
                    {name:"Tgl_Rekam Pertama",data:"Tgl_Rekam_Pertama"},
                    {name:"Tgl_Perolehan",data:"Tgl_Perolehan"},
                    {name:"Nilai_Perolehan_Pertama",data:"Nilai_Perolehan_Pertama"},
                    {name:"Nilai_Mutasi",data:"Nilai_Mutasi"},
                    {name:"Nilai_Perolehan",data:"Nilai_Perolehan"},
                    {name:"Nilai_Penyusutan",data:"Nilai_Penyusutan"},
                    {name:"Nilai_Buku",data:"Nilai_Buku"},
                    {name:"Kuantitas",data:"Kuantitas"},
                    {name:"jml_foto",data:"jml_foto"},
                    {name:"Status_Penggunaan",data:"Status_Penggunaan"},
                    {name:"Status_Pengelolaan",data:"Status_Pengelolaan"},
                    {name:"No_PSP",data:"No_PSP"},
                    {name:"Tgl_PSP",data:"Tgl_PSP"},
                    {name:"Jumlah_KIB",data:"Jumlah_KIB"},
                    {name:"Dokumen",data:"Dokumen"},
                    {name: "Luas_Bangunan",data:"Luas_Bangunan"},
                    {name: "Luas_Dasar_Bangunan",data:"Luas_Dasar_Bangunan"},
                    {name: "Jumlah_Lantai",data:"Jumlah_Lantai"},
                    {name: "Jalan",data:"Jalan"},
                    {name: "Kode_Kab_Kota",data:"Kode_Kab_Kota"},
                    {name: "Uraian_Kab_Kota",data:"Uraian_Kab_Kota"},
                    {name: "Kode_Provinsi",data:"Kode_Provinsi"},
                    {name: "Uraian_Provinsi",data:"Uraian_Provinsi"},
                    {name: "Kode_Pos",data:"Kode_Pos"},
                    {name: "SBSK",data:"SBSK"},
                    {name: "Optimalisasi",data:"Optimalisasi"},
                    {name: "Status_SBSN",data:"Status_SBSN"},
                    {data: 'action', name: 'action', orderable: true, searchable: true}
             ]
        });

    });
</script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

@endpush
