@extends('layouts.main')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Modificar incidencia
                    <a class="btn btn-outline btn-danger" href="/incidence">
                        <i class="fa fa-chevron-left"> Regresar</i>
                    </a>
                </h1>
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
                            <form role="form" method="POST" action="{{ route('incidence.update', $incidence->id) }}"
                                  enctype="multipart/form-data">
                                <input name="_method" type="hidden" value="PUT">
                                <input name="option_update" type="hidden" value="1">
                                {{ csrf_field() }}
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Estado*</label>
                                        <select class="form-control" name="status">
                                            <option value="0"
                                                    @if($incidence->status == 0)
                                                    selected
                                                    @endif
                                            >
                                                Sin atender
                                            </option>
                                            <option value="1"
                                                    @if($incidence->status == 1)
                                                    selected
                                                    @endif
                                            >
                                                En proceso
                                            </option>
                                            <option value="2"
                                                    @if($incidence->status == 2)
                                                    selected
                                                    @endif
                                            >
                                                Atendido
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Comentario*</label>
                                        <textarea class="form-control" rows="3" name="comment">{{ $incidence->comment }}</textarea>
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
                                            @foreach($incT as $inc)
                                                <option value="{{$inc->id}}"
                                                        @if($incidence->incidence_type_id == $inc->id)
                                                            selected
                                                        @endif
                                                >
                                                    {{$inc->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Código de bien*</label>
                                        <select class="form-control" name="asset_id">
                                            @foreach($assets as $asset)
                                                <option value="{{$asset->id}}"
                                                        @if($incidence->asset_id == $asset->id)
                                                            selected
                                                        @endif
                                                >
                                                    {{$asset->asset_code}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary">Modificar</button>
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
@endsection