@extends('layouts.main')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Modificar proveedor
                    <a class="btn btn-outline btn-danger" href="/provider">
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
                            <form role="form" method="POST" action="{{ route('provider.update', $provider->id) }}"
                                  enctype="multipart/form-data">
                                <input name="_method" type="hidden" value="PUT">
                                {{ csrf_field() }}
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Código de proveedor*</label>
                                        <input class="form-control" name="code" value="{{ $provider->code }}" disabled>
                                        @if($errors->has('code'))
                                            <span style="color: darkred;">{{ $errors->first('code') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Nombre*</label>
                                        <input class="form-control" name="name" value="{{ $provider->name }}">
                                        @if($errors->has('name'))
                                            <span style="color: darkred;">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Email*</label>
                                        <input type="email" class="form-control" name="email"
                                               placeholder="ejemlo@gmail.com" value="{{ $provider->email }}">
                                        @if($errors->has('email'))
                                            <span style="color: darkred;">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div><br>
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