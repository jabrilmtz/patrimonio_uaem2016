@extends('layouts.main')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Modificar bien escaneado
                    <a class="btn btn-outline btn-danger" href="/normal">
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
                            <form role="form" method="POST" action="{{ route('normal.update', $asset->id) }}" enctype="multipart/form-data">
                                <input name="_method" type="hidden" value="PUT">
                                {{ csrf_field() }}
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Código*</label>
                                        <input hidden name="asset_code" value="{{ $asset->asset_code }}">
                                        <input disabled class="form-control" value="{{ $asset->asset_code }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Nombre*</label>
                                        <input class="form-control" name="name" value="{{ $asset->name }}">
                                        @if($errors->has('name'))
                                            <span style="color: darkred;">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Número de serie*</label>
                                        <input class="form-control" name="serial_number" value="{{ $asset->serial_number }}">
                                        @if($errors->has('serial_number'))
                                            <span style="color: darkred;">{{ $errors->first('serial_number') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Modelo*</label>
                                        <input class="form-control" name="model" value="{{ $asset->model }}">
                                        @if($errors->has('model'))
                                            <span style="color: darkred;">{{ $errors->first('model') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Fecha compra*</label>
                                        <input type="date" class="form-control" name="assign_date" value="{{ $asset->assign_date }}">
                                        @if($errors->has('assign_date'))
                                            <span style="color: darkred;">{{ $errors->first('assign_date') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Descripción</label>
                                        <textarea class="form-control" rows="3" name="description">{{ $asset->description }}</textarea>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">$</span>
                                        <input hidden name="actual_cost" value="{{ $asset->actual_cost }}">
                                        <input disabled type="number" class="form-control" value="{{ $asset->actual_cost }}">
                                        <span class="input-group-addon">MXN*</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Imagen</label>
                                    <!--<img src="imgAssets/{{$asset->image}}" class="img-responsive" alt="Responsive image" style="max-width: 50px;">-->
                                        <input type="file" class="form-control" name="image" value="{{ $asset->image }}">
                                    </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Marca*</label>
                                        <select class="form-control" name="brand_id">
                                            @foreach($brands as $brand)
                                                <option value="{{$brand->id}}"
                                                        @if($asset->brand_id == $brand->id)
                                                        selected
                                                        @endif
                                                >{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('brand_id'))
                                            <span style="color: darkred;">{{ $errors->first('brand_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Proveedor*</label>
                                        <select class="form-control" name="provider_id">
                                            @foreach($providers as $provider)
                                                <option value="{{$provider->id}}"
                                                        @if($asset->provider_id == $provider->id)
                                                        selected
                                                        @endif
                                                >{{$provider->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Programa*</label>
                                        <select class="form-control" name="program_id">
                                            @foreach($programs as $program)
                                                <option value="{{$program->id}}"
                                                        @if($asset->program_id == $program->id)
                                                        selected
                                                        @endif
                                                >{{$program->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Unidad académica*</label>
                                        <select class="form-control" name="unit_id">
                                            @foreach($units as $unit)
                                                <option value="{{$unit->id}}"
                                                        @if($asset->unit_id == $unit->id)
                                                        selected
                                                        @endif
                                                >{{$unit->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tipo de bien*</label>
                                        <select class="form-control" name="asset_type_id">
                                            @foreach($assets_types as $asset_type)
                                                <option value="{{$asset_type->id}}"
                                                        @if($asset->asset_type_id == $asset_type->id)
                                                        selected
                                                        @endif
                                                >{{$asset_type->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('asset_type_id'))
                                            <span style="color: darkred;">{{ $errors->first('asset_type_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Comentarios</label>
                                        <textarea class="form-control" rows="3" name="comment">{{ $asset->comment }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Modificar</button>
                                    <button type="reset" class="btn btn-default">Cancelar</button>
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