@extends('layouts.main')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Generar inventario</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Favor de seleccionar un rango de fechas para la generación de un inventario
                    </div>
                    @include('partials.message')
                    <div class="panel-body">
                        <div class="row">
                            <form role="form" method="POST" action="{{ url('inventories') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>INICIO*</label>
                                        <input type="date" class="form-control" name="date_start">
                                        @if($errors->has('date_start'))
                                            <span style="color: darkred;">{{ $errors->first('date_start') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>FIN*</label>
                                        <input type="date" class="form-control" name="date_end">
                                        @if($errors->has('date_end'))
                                            <span style="color: darkred;">{{ $errors->first('date_end') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-4">
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
                                    <button type="submit" class="btn btn-primary">Generar</button>
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
