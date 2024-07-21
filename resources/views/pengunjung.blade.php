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
            <div class="col-sm-12">
                @if (\Session::has('msg_success'))
                    <h5>
                        <div class="alert alert-info">
                            {{ \Session::get('msg_success') }}
                        </div>
                    </h5>
                @endif
                @if (\Session::has('msg_error'))
                    <h5>
                        <div class="alert alert-danger">
                            {{ \Session::get('msg_error') }}
                        </div>
                    </h5>
                @endif
                <br />
                <div class="login-logo">
                    <b>FORM PENGUNJUNG</b> <br>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="attachment-block clearfix">
                <center>
                    <h4><b>Silahkan Isi Data Pengunjung</b></h4>
                </center>
                <div class="attachment-pushed" style="margin-left:0 !important;">
                    <div class="attachment-text">
                        <div class="box-body">
                            <form action="{{ route('addPengunjung') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group has-feedback">
                                    <label>Nama Pengunjung:</label>
                                    <input type="text" name="name" class="form-control" placeholder="Nama Pengunjung"
                                        required>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Jenis Kelamin :</label>
                                    <select name="jenis_kelamin" class="form-control" required>
                                        <option value="">Pilih</option>
                                        <option value="Pria">Pria</option>
                                        <option value="Wanita">Wanita</option>
                                    </select>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Kategori Usia :</label>
                                    <select name="kategori_usia" class="form-control" required>
                                        <option value="">Pilih</option>
                                        <option value="Anak-Anak">Anak-Anak</option>
                                        <option value="Wanita">Wanita</option>
                                    </select>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Kategori Pengunjung :</label>
                                    <select name="kategori_pengunjung" class="form-control" required>
                                        <option value="">Pilih</option>
                                        <option value="Pelajar">Pelajar</option>
                                        <option value="Wisatawan Umum">Wisatawan Umum</option>
                                        <option value="Wisatawan Asing">Wisatawan Asing</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-xs-2 col-xs-offset-5">
                                        <button type="submit" class="btn btn-success btn-block btn-flat"
                                            style="border-radius: 10px">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
    <script type="text/javascript">
        var table = $('#data-product').DataTable();
    </script>
@endsection
