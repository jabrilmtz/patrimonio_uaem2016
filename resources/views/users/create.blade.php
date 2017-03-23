@extends('layouts.main')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Nuevo usuario
                    <a class="btn btn-outline btn-danger" href="/users">
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
                            <form role="form" method="POST" action="{{ url('users') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Nombre*</label>
                                        <input class="form-control" name="name">
                                        @if($errors->has('name'))
                                            <span style="color: darkred;">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Email*</label>
                                        <input type="email" class="form-control" name="email" placeholder="ejemlo@gmail.com">
                                        @if($errors->has('email'))
                                            <span style="color: darkred;">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Teléfono*</label>
                                        <input type="tel" class="form-control" name="phone" placeholder="10 dígitos">
                                        @if($errors->has('phone'))
                                            <span style="color: darkred;">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Contraseña*</label>
                                        <input class="form-control" name="password" type="password" placeholder="Mínimo 6 caracteres">
                                        @if($errors->has('password'))
                                            <span style="color: darkred;">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Tipo*</label>
                                        <select class="form-control" name="role_id">
                                            <option value="0">Selecciona una opcion...</option>
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('role_id'))
                                            <span style="color: darkred;">{{ $errors->first('role_id') }}</span>
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
@endsection