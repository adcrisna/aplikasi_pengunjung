@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/morris.js/morris.css') }}">
    <style>
        img.zoom {
            width: 130px;
            height: 100px;
            -webkit-transition: all .2s ease-in-out;
            -moz-transition: all .2s ease-in-out;
            -o-transition: all .2s ease-in-out;
            -ms-transition: all .2s ease-in-out;
        }

        .transisi {
            -webkit-transform: scale(1.8);
            -moz-transform: scale(1.8);
            -o-transform: scale(1.8);
            transform: scale(1.8);
        }
    </style>
@endsection

@section('content')
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.index') }}"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Data Analisis</li>
        </ol>
        <br />
    </section>
    <section class="content">
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
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Grafik Analisis Prediksi</h3>
                    </div>
                    <div class="box-body chart-responsive">
                        <div class="chart" id="bar-chart" style="height: 300px;"></div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Data Analisis</h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped" id="data-spk">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Akhir</th>
                                    <th>Pelajar</th>
                                    <th>Wisatawan Umum</th>
                                    <th>Wisatawan Asing</th>
                                    <th>Prediksi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (@$analisis as $key => $value)
                                    <tr>
                                        <td>{{ @$value->id }}</td>
                                        <td>{{ @$value->start_date }}</td>
                                        <td>{{ @$value->end_date }}</td>
                                        <td>{{ @$value->pelajar }}</td>
                                        <td>{{ @$value->umum }}</td>
                                        <td>{{ @$value->asing }}</td>
                                        <td>{{ @$value->prediksi }}</td>
                                        <td>
                                            <a href="{{ route('admin.deleteAnalisis', $value->id) }}"><button
                                                    class=" btn btn-xs btn-danger"
                                                    onclick="return confirm('Apakah anda ingin menghapus data ini ?')"><i
                                                        class="fa fa-trash"> Hapus</i></button></a> &nbsp;
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('adminlte/bower_components/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('adminlte/bower_components/morris.js/morris.min.js') }}"></script>
    <script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script type="text/javascript">
        var table = $('#data-spk').DataTable();

        $('#data-spk').on('click', '.btn-edit-data', function() {
            row = table.row($(this).closest('tr')).data();
            console.log(row);
            $('input[name=id]').val(row[0]);
            $('input[name=name]').val(row[1]);
            $('textarea[name=deskripsi]').val(row[2]);
            $('#modal-form-edit-data').modal('show');
        });
        $('#modal-form-tambah-data').on('show.bs.modal', function() {
            $('input[name=name]').val('');
            $('textarea[name=deskripsi]').val('');
        });

        $(document).ready(function() {
            $('.zoom').hover(function() {
                $(this).addClass('transisi');
            }, function() {
                $(this).removeClass('transisi');
            });
        });
    </script>
    <script>
        $(function() {
            "use strict";
            var bar = new Morris.Bar({
                element: 'bar-chart',
                resize: true,
                data: [
                    @foreach ($analisis as $value)
                        {
                            y: '{{ date('F', strtotime($value->start_date)) }} {{ date('Y', strtotime($value->start_date)) + 1 }}',
                            a: {{ $value->prediksi }}
                        },
                    @endforeach
                ],
                barColors: ['#00a65a'],
                xkey: 'y',
                ykeys: ['a'],
                labels: ['PREDIKSI'],
                hideHover: 'auto'
            });
        });
    </script>
@endsection
