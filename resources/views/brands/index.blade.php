@extends('layouts.main')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-11">
                <h1 class="page-header">Marcas</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-1">
                <span class="center"><br><br>
                    <p>
                        <a class="btn btn-outline btn-primary" href="brand/create">
                            <i class="fa fa-plus"></i>
                        </a>
                    </p>
                </span>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Marcas a las que puede pertenecer un bien
                    </div>
                    <!-- /.panel-heading -->
                    @include('partials.message')
                    <div class="panel-body">
                        <!-- Evalua que exista información que mostrar primero-->
                        @if(count($brands) >= 1)
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Acción</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($brands as $brand)
                                    <tr class="gradeU">
                                        <td>{{$brand->name}}</td>
                                        <td class="center">
                                            <a class="btn btn-warning btn-circle" href="brand/{{ $brand->id }}/edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <?php
                                            //Se extrae la información de los bienes relacionados
                                            $assets = \App\Entities\Asset::all()->where('brand_id','==',$brand->id);
                                            ?>
                                            @if(count($assets)==0)
                                                <form action="{{ route('brand.destroy', $brand->id) }}" method="POST">
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-circle">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        @else
                            <span>
                                <h2>¡Lo sentimos! No existen registros que mostrar</h2>
                            </span>
                        @endif
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