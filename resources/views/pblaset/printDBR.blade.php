<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Deteksi Lokasi Asset</title>
  </head>
  <body>
    <table border="1" width="80%" cellpadding="50" >
        @foreach ($dbr as $data)
        <tr>
            <td>{{ QrCode::size(100)->generate(json_encode($data)) }}</td>
            <td>Barang: {{ $data->Nama_Barang }} ( {{ $data->Kode_Barang }})<br/>Ruangan: {{  $data->Lokasi}}</td>
        </tr>
        @endforeach
    </table>
  </body>
</html>
