@extends('layouts.main')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Nuevo bien
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
                            <form role="form" method="POST" action="{{ url('normal') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Código de barras*</label>
                                        <input class="form-control" name="asset_code">
                                        @if($errors->has('asset_code'))
                                            <span style="color: darkred;">{{ $errors->first('asset_code') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Nombre*</label>
                                        <input class="form-control" name="name">
                                        @if($errors->has('name'))
                                            <span style="color: darkred;">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Número de serie*</label>
                                        <input class="form-control" name="serial_number">
                                        @if($errors->has('serial_number'))
                                            <span style="color: darkred;">{{ $errors->first('serial_number') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Modelo*</label>
                                        <input class="form-control" name="model">
                                        @if($errors->has('model'))
                                            <span style="color: darkred;">{{ $errors->first('model') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Fecha compra*</label>
                                        <input type="date" class="form-control" name="assign_date">
                                        @if($errors->has('assign_date'))
                                            <span style="color: darkred;">{{ $errors->first('assign_date') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Descripción</label>
                                        <textarea class="form-control" rows="3" name="description"></textarea>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="number" class="form-control" name="original_cost" placeholder="Precio">
                                        <span class="input-group-addon">MXN*</span>
                                    </div>
                                    @if($errors->has('original_cost'))
                                        <span style="color: darkred;">{{ $errors->first('original_cost') }}</span>
                                    @endif
                                    <div class="form-group">
                                        <label>Imagen</label>
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Marca*</label>
                                        <select class="form-control" name="brand_id">
                                            <option value="0">Selecciona una opcion...</option>
                                            @foreach($brands as $brand)
                                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('brand_id'))
                                            <span style="color: darkred;">{{ $errors->first('brand_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Proveedor*</label>
                                        <select class="form-control" name="provider_id">
                                            <option value="0">Selecciona una opcion...</option>
                                            @foreach($providers as $provider)
                                                <option value="{{$provider->id}}">{{$provider->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('provider_id'))
                                            <span style="color: darkred;">{{ $errors->first('provider_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Programa*</label>
                                        <select class="form-control" name="program_id">
                                            <option value="0">Selecciona una opcion...</option>
                                            @foreach($programs as $program)
                                                <option value="{{$program->id}}">{{$program->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('program_id'))
                                            <span style="color: darkred;">{{ $errors->first('program_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Unidad académica*</label>
                                        <select class="form-control" name="unit_id">
                                            <option value="0">Selecciona una opcion...</option>
                                            @foreach($units as $unit)
                                                <option value="{{$unit->id}}">{{$unit->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('unit_id'))
                                            <span style="color: darkred;">{{ $errors->first('unit_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Tipo de bien*</label>
                                        <select class="form-control" name="asset_type_id">
                                            <option value="0">Selecciona una opcion...</option>
                                            @foreach($assets_types as $asset_type)
                                                <option value="{{$asset_type->id}}">{{$asset_type->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('asset_type_id'))
                                            <span style="color: darkred;">{{ $errors->first('asset_type_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Comentarios</label>
                                        <textarea class="form-control" rows="3" name="comment"></textarea>
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
@endsection