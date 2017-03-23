@extends('layouts.main')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-11">
                <h1 class="page-header">Tipos de activos</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-1">
                <span class="center"><br><br>
                    <p>
                        <a class="btn btn-outline btn-primary" href="assetsTypes/create">
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
                        Tipos de activos en los que se clasifican los bienes para su depreciación.
                    </div>
                    <!-- /.panel-heading -->
                    @include('partials.message')
                    <div class="panel-body">
                        <!-- Evalua que exista información que mostrar primero-->
                        @if(count($assets_types) >= 1)
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>% depreciación anual</th>
                                    <th>Vida útil estimada</th>
                                    <th>Bienes</th>
                                    <th>Acción</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($assets_types as $assets_type)
                                    <tr class="gradeU">
                                        <?php
                                        //Se extrae la información de las unidades
                                        $assets = \App\Entities\Asset::all()->where('asset_type_id','==',$assets_type->id);
                                        ?>
                                        <td>{{$assets_type->name}}</td>
                                        <td>{{$assets_type->percentage}}</td>
                                        <td>{{$assets_type->useful_life}}</td>
                                        <td align="center">
                                            <button type="button" class="btn btn-success btn-circle" data-toggle="modal"
                                                    data-target="#modalAssetsTypes-{{ $assets_type->id }}">
                                                {{ count($assets) }}
                                            </button>
                                        </td>
                                        <td class="center">
                                            <a class="btn btn-warning btn-circle" href="assetsTypes/{{ $assets_type->id }}/edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @if(count($assets)==0)
                                                <form action="{{ route('assetsTypes.destroy', $assets_type->id) }}" method="POST">
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

    <!-- Modal -->
    @foreach($assets_types as $assets_type)
        <div class="modal fade" id="modalAssetsTypes-{{ $assets_type->id }}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Header de la ventana -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 style="color: #007bb6" class="modal-title"
                            id="myModalLabel">Bienes de tipo {{ $assets_type->name }}</h4>
                    </div>
                    <!-- Cuerpo de la ventana -->
                    <div class="modal-body">
                        <?php
                            //Se extrae la información de las unidades
                            $assets = \App\Entities\Asset::all()->where('asset_type_id','==',$assets_type->id);
                            $tot =0;
                        ?>
                            @if(count($assets)>=1)
                                <table width="100%" class="table table-hover table-responsive" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Nombre</th>
                                        <th># de serie</th>
                                        <th>Modelo</th>
                                        <th>Estado</th>
                                        <th>Categoría</th>
                                        <th>$ actual</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- Se comienza a presentar la información de cada uno de los bienes-->
                                    @foreach($assets as $asset)
                                        <tr class="gradeU">
                                            <td>{{ $asset->asset_code }}</td>
                                            <td>{{ $asset->name }}</td>
                                            <td>{{ $asset->serial_number }}</td>
                                            <td>{{ $asset->model }}</td>
                                            <td>
                                                @if($asset->status_id==1)
                                                    Normal
                                                @elseif($asset->status_id==2)
                                                    Pre-registro
                                                @else
                                                    Sobrante
                                                @endif
                                            </td>
                                            <td>{{ $asset->category }}</td>
                                            <td>{{ $asset->actual_cost }}</td>
                                        </tr>
                                        <?php
                                                // Se genera el total de precios de los bienes
                                            $tot = $tot + $asset->actual_cost;
                                        ?>
                                    @endforeach
                                    </tbody>
                                </table>
                                <!-- /.table-responsive -->
                                <!-- Se presenta el resultado del total -->
                                <h4 align="right">
                                    <b>Total: </b> {{ $tot }}
                                </h4>
                            @else
                                <h4>Aún no existen bienes asignados</h4>
                            @endif
                    </div>
                    <!-- Footer de la ventana -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline btn-primary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Fin del modal -->
@endsection