@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
    <style>
        .qrcode-container {
            text-align: center;
            margin: 20px;
        }

        .qrcode-container img {
            max-width: 200px;
            margin: 10px;
        }

        .print-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
@endsection

@section('content')
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.index') }}"><i class="fa fa-home"></i> Home</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <br />
                <div class="login-logo">
                    <b>Aplikasi Pengunjung</b> <br>Berbasis Website
                    {{-- {{ bcrypt('password') }} --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{ $getWanita }}</h3>

                        <p>Jumlah Pengujung Wanita</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('admin.pengunjung') }}" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $getPria }}</h3>

                        <p>Jumlah Pengujung Pria</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('admin.pengunjung') }}" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>{{ $getPelajar }}</h3>

                        <p>Jumlah Pengujung Pelajar</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('admin.pengunjung') }}" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3>{{ $getUmum }}</h3>

                        <p>Jumlah Pengujung Wisatawan Umum</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('admin.pengunjung') }}" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{ $getAsing }}</h3>

                        <p>Jumlah Pengujung Wisatawan Asing</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('admin.pengunjung') }}" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <br>
        <br>
    </section>
@endsection

@section('javascript')
    <script src="{{ asset('adminlte/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/raphael/raphael-min.js') }}"></script>
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <script>
        function printQRCode() {
            var printWindow = window.open('', '_blank', 'width=600,height=600');
            printWindow.document.write('<html><head><title>Print QR Code</title>');
            printWindow.document.write('<style>');
            printWindow.document.write('body { text-align: center; margin: 0; padding: 0; }');
            printWindow.document.write('.qrcode-container { display: block; margin: 20px; }');
            printWindow.document.write('.qrcode-container img { max-width: 100%; height: auto; }');
            printWindow.document.write('</style></head><body>');
            printWindow.document.write(document.getElementById('printArea').innerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        }

        window.onload = function() {
            var qrCodeSvg = document.querySelector('.qrcode-container svg');
            if (qrCodeSvg) {
                var svgData = new XMLSerializer().serializeToString(qrCodeSvg);
                var canvas = document.createElement('canvas');
                var ctx = canvas.getContext('2d');
                var img = new Image();

                img.onload = function() {
                    canvas.width = img.width;
                    canvas.height = img.height;
                    ctx.drawImage(img, 0, 0);

                    var imgSrc = canvas.toDataURL('image/png');
                    var imgElement = document.createElement('img');
                    imgElement.src = imgSrc;
                    document.querySelector('.qrcode-container').innerHTML = '';
                    document.querySelector('.qrcode-container').appendChild(imgElement);
                };

                img.src = 'data:image/svg+xml;base64,' + btoa(svgData);
            }
        }
    </script>
@endsection
