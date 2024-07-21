@extends('layouts.index')
@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
@endsection

@section('content')
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ route('index') }}"><i class="fa fa-home"></i> Beranda</a></li>
        </ol>
    </section>
    <br>
    <section class="content">
        <div class="row">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>

                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img class="img-responsive pad" src="{{ asset('adminlte/dist/img/photo1.png') }}" alt="First slide"
                            style="height: 450px; width:100%;">
                    </div>
                    <div class="item">
                        <img class="img-responsive pad" src="{{ asset('adminlte/dist/img/photo2.png') }}" alt="Second slide"
                            style="height: 450px; width:100%;">
                    </div>
                    <div class="item">
                        <img class="img-responsive pad" src="{{ asset('adminlte/dist/img/photo3.jpg') }}" alt="Third slide"
                            style="height: 450px; width:100%;">
                    </div>
                </div>

                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <br />
                <div class="login-logo">
                    <b>Aplikasi Kunjungan</b> <br>
                    {{-- {{ bcrypt('password') }} --}}
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="attachment-block clearfix">
                <div class="col-sm-4">
                    <img class="img-responsive" src="{{ asset('adminlte/dist/img/photo1.png') }}" alt="Attachment Image"
                        style="width: 250px">
                </div>
                <div class="col-sm-8">
                    <div class="attachment-pushed" style="margin-left:0 !important;">
                        <div class="attachment-text">
                            Description about the attachment can be placed here.
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem ipsum dolor sit
                            amet consectetur adipisicing elit. Pariatur, obcaecati in vero velit explicabo aperiam autem
                            quisquam numquam ipsa molestias atque, veritatis officia nihil quos asperiores! Consequuntur
                            voluptate molestias quos?
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deleniti ullam debitis placeat vero in
                            doloremque, nesciunt reprehenderit quae asperiores dolorem provident dignissimos nisi magni eos
                            explicabo corrupti omnis est labore.
                        </div>
                        <!-- /.attachment-text -->
                    </div>
                </div>
                <!-- /.attachment-pushed -->
            </div>
        </div>
        <br>
        <br>
    </section>
@endsection

@section('javascript')
    <script src="{{ asset('adminlte/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/raphael/raphael-min.js') }}"></script>
    <script type="text/javascript">
        var table = $('#data-product').DataTable();
    </script>
@endsection
