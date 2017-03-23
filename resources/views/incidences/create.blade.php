@extends('layouts.main')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Nueva incidencia
                    <a class="btn btn-outline btn-danger" href="/incidence">
                        <i class="fa fa-chevron-left"> Regresar</i>
                    </a>
                </h1>
                <h4 class="page-footer" align="right">Nuevo tipo de incidencia
                    <button type="button" class="btn btn-outline btn-success" data-toggle="modal"
                            data-target="#modalIncidenceType">
                        <i class="fa fa-plus"></i>
                    </button>
                </h4>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    </div>
                    @include('partials.message')
                    <div class="panel-body">
                        <div class="row">
                            <form role="form" method="POST" action="{{ url('incidence') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Comentario*</label>
                                        <textarea class="form-control" rows="3" name="comment"></textarea>
                                        @if($errors->has('comment'))
                                            <span style="color: darkred;">{{ $errors->first('comment') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Imagen</label>
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Tipo incidencia*</label>
                                        <select class="form-control" name="incidence_type_id">
                                            <option value="0">Selecciona una opcion...</option>
                                        @foreach($incT as $inc)
                                                <option value="{{$inc->id}}">{{$inc->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('incidence_type_id'))
                                            <span style="color: darkred;">{{ $errors->first('incidence_type_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Código de bien*</label>
                                        <select class="form-control" name="asset_id">
                                            <option value="0">Selecciona una opcion...</option>
                                        @foreach($assets as $asset)
                                                <option value="{{$asset->id}}">{{$asset->asset_code}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('asset_id'))
                                            <span style="color: darkred;">{{ $errors->first('asset_id') }}</span>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary">Agregar</button>
                                    <button type="reset" class="btn btn-default">Limpiar</button>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </form>
                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

    <!-- Modal -->
    <div class="modal fade" id="modalIncidenceType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Header de la ventana -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title" id="myModalLabel" style="color: #007bb6">Nuevo tipo de incidencia</h3>
                </div>
                <form role="form" method="POST" action="{{ url('incidenceType') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <!-- Cuerpo de la ventana -->
                    <div class="modal-body">
                        <label>Nombre*</label>
                        <input name="name" class="form-control">
                        @if($errors->has('name'))
                            <span style="color: darkred;">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <!-- Footer de la ventana -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline btn-primary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-outline btn-success">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection