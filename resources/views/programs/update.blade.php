@extends('layouts.main')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Modificar programa académico
                    <a class="btn btn-outline btn-danger" href="/program">
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
                            <form role="form" method="POST" action="{{ route('program.update', $program->id) }}"
                                  enctype="multipart/form-data">
                                <input name="_method" type="hidden" value="PUT">
                                {{ csrf_field() }}
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Nombre*</label>
                                        <input class="form-control" name="name" value="{{ $program->name }}">
                                        @if($errors->has('name'))
                                            <span style="color: darkred;">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Rama*</label>
                                        <input class="form-control" name="branch" value="{{ $program->branch }}">
                                        @if($errors->has('branch'))
                                            <span style="color: darkred;">{{ $errors->first('branch') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Modalidad*</label>
                                        <input class="form-control" name="modality" value="{{ $program->modality }}">
                                        @if($errors->has('modality'))
                                            <span style="color: darkred;">{{ $errors->first('modality') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Descripción</label>
                                        <textarea class="form-control" rows="3" name="description">
                                            {{ $program->description }}
                                        </textarea>
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