<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Manajemen Inventaris Laboratorium Teknik Informatika dan Komputer</title>
    <link rel="stylesheet" href="{{ url('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap/dist//css/bootstrap.css') }}">
    <link rel="shortcut icon" href="{{ url('assets/images/Logo_PNJ.png') }}" type="image/x-icon">  
    <style>
        .row{
            margin: 0 !important;
        }
        .table th, .table td{
            padding-left: 0px !important;
            border: none;
        }

        .smil-status {
            width: 80px;
            height: max-content;
            padding: 8px;
            text-align: center;
            font-weight: bold;
            font-size: 10px;
        }

        .smil-bg-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .smil-bg-primary {
            background-color: #101939;
            color: #fff;
        }

        .smil-bg-success {
            background-color: #28a745;
            color: #fff;
        }

        .smil-bg-info {
            background-color: #17a2b8;
            color: #fff;
        }

        .smil-bg-pending {
            background-color: #d4d4d4;
            color: #000;
        }

        .smil-bg-warning {
            background-color: #f6d35c;
            color: #000;
        }

        .smil-bg-secondary {
            background-color: #fff;
            color: #101939;
            border: 1px solid #c5c5c5;
        }

        @media screen and (max-width: 992px) {
            .smil-status {
                width: 50px;
                // height: 30px;
                padding: 5px;
                text-align: center;
                font-weight: bold;
                font-size: 8px;
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="row flex-column">
            <h5>Informasi Lokasi Penyimpanan</h5>
            <div class="table-responsive-lg mt-4">
                <table class="table table-borderless">
                    <tr>
                        <th>Nama Lokasi</th>
                        <td>{{ $lokasi["lokasi_name"] }}</td>
                    </tr>
                    <tr>
                        <th>Kapasitas Total</th>
                        <td>{{ $lokasi["total_capacity"] }}</td>
                    </tr>
                    <tr>
                        <th>Kapasitas Tersedia</th>
                        <td>{{ $lokasi["available_capacity"] }}</td>
                    </tr>
                    <tr>
                        <th>Kapasitas Terpakai</th>
                        <td>{{ $lokasi["stored_capacity"] }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row flex-column">
            <h5>List Alat Tersimpan</h5>
            <div class="table-responsive-lg mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Alat</th>
                            <th>QRCode Key</th>
                            <th>Kondisi Alat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (sizeof($detailAlat) == 0)
                            <tr>
                                <td colspan="3" class="text-center">Tidak Alat yang Tersimpan</td>
                            </tr>   
                        @else
                            @foreach ($detailAlat as $detail)
                                <tr>
                                    <td>
                                        {{ $detail->alat_model->alat_name }}
                                    </td>
                                    <td>
                                        {{ $detail->barcode_alat }}
                                    </td>
                                    <td>
                                        @if ($detail->condition_status == 1)
                                            <span class="smil-status smil-bg-pending">
                                                Pending
                                            </span>
                                        @elseif ($detail->condition_status == 2)
                                            <span class="smil-status smil-bg-success">
                                                Baik
                                            </span> 
                                        @elseif ($detail->condition_status == 3)
                                            <span class="smil-status smil-bg-danger">
                                                Rusak
                                            </span>  
                                        @elseif ($detail->condition_status == 4)
                                            <span class="smil-status smil-bg-warning">
                                                Habis
                                            </span>
                                        @elseif ($detail->condition_status == 5)
                                            <span class="smil-status smil-bg-info">
                                                Diperbaiki
                                            </span>  
                                        @elseif ($detail->condition_status == 6)
                                            <span class="smil-status smil-bg-danger">
                                                Apkir
                                            </span>                                            
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $detailAlat->links() !!}
                </div>
            </div>
            
        </div>
    </div>
</body>

</html>