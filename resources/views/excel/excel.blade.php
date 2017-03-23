@extends('layouts.main')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Importar / Exportar datos</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            @include('partials.message')
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-cloud-download fa-fw"></i> Importar
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="form-group">
                            <form role="form" method="POST" action="{{ url('excelImport') }}" enctype="multipart/form-data">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                <label>Archivo (.xls)</label>
                                <input type="file" class="form-control" name="excel1">
                                <br>
                                <button type="submit" class="btn btn-outline btn-success">Importar</button>
                            </form>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-8 -->
            <div class="col-lg-4">
                <!-- /.panel -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-cloud-upload fa-fw"></i> Exportar
                    </div>
                    <div class="panel-body">
                        <form method="get" role="form" action="{{ url('excelExport') }}">
                            <button type="submit" class="btn btn-outline btn-primary">Exportar</button>
                        </form>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
@endsection
