@extends('layouts.main')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Modificar unidad académica
                    <a class="btn btn-outline btn-danger" href="/unit">
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
                            <form role="form" method="POST" action="{{ route('unit.update', $unit->id) }}" enctype="multipart/form-data">
                                <input name="_method" type="hidden" value="PUT">
                                {{ csrf_field() }}
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Código*</label>
                                        <input type="hidden" name="code" value="{{ $unit->code }}">
                                        <input disabled class="form-control" value="{{ $unit->code }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Nombre*</label>
                                        <input class="form-control" name="name" value="{{ $unit->name }}">
                                        @if($errors->has('name'))
                                            <span style="color: darkred;">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Ubicación*</label>
                                        <input class="form-control" name="location" value="{{ $unit->location }}">
                                        @if($errors->has('location'))
                                            <span style="color: darkred;">{{ $errors->first('location') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Empleado encargado*</label>
                                        <select class="form-control" name="employee_id">
                                            @foreach($employees as $employee)
                                                <option value="{{$employee->id}}"
                                                        @if($unit->employee_id == $employee->id)
                                                        selected
                                                        @endif
                                                >{{$employee->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
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