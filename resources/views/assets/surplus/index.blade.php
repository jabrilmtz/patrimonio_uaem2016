@extends('layouts.main')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-11">
                <h1 class="page-header">Sobrantes</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-1">
                <span class="center"><br><br>
                    <p>
                        <a class="btn btn-outline btn-primary" href="surplus/create">
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
                        Bienes sobrantes en la institución (no pertenecen a ninguna unidad académica)
                    </div>
                    <!-- /.panel-heading -->
                    @include('partials.message')
                    <div class="panel-body">
                        <!-- Evalua que exista información que mostrar primero-->
                        @if(count($assets) >= 1)
                            <table width="100%" class="table table-striped table-bordered table-hover table-responsive" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Número de serie</th>
                                    <th>Modelo</th>
                                    <th>Precio</th>
                                    <th>Fecha de asignación</th>
                                    <th>Marca</th>
                                    <th>Programa</th>
                                    <th>Proveedor</th>
                                    <th>Usuario</th>
                                    <th>Acción</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($assets as $asset)
                                    <tr class="gradeU">
                                        <?php
                                            //Se extrae la información de los usuarios
                                            $user = \App\User::find($asset->user_id);
                                            //Se extrae la información de los proveedores
                                            $provider = \App\Entities\Provider::find($asset->provider_id);
                                            //Se extrae la información de los programas
                                            $program = \App\Entities\Program::find($asset->program_id);
                                            //Se extrae la información de las marcas
                                            $brand = \App\Entities\Brand::find($asset->brand_id);
                                        ?>
                                        <td><strong>{{$asset->asset_code}}</strong></td>
                                        <td>{{$asset->name}}</td>
                                        <td>{{$asset->serial_number}}</td>
                                        <td>{{$asset->model}}</td>
                                        <td>{{$asset->actual_cost}} MXN</td>
                                        <td>{{ $asset->assign_date }}</td>
                                        <td>{{$brand->name}}</td>
                                        <td>{{$program->name}}</td>
                                        <td>{{$provider->name}}</td>
                                        <td>{{$user->name}}</td>
                                        <td class="center">
                                            <a class="btn btn-warning btn-circle" href="surplus/{{ $asset->id }}/edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-success btn-circle" data-toggle="modal"
                                                    data-target="#modalAssets-{{ $asset->id }}">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            <form action="{{ route('surplus.destroy', $asset->id) }}" method="POST">
                                                <input name="_method" type="hidden" value="DELETE">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-circle">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </form>
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
    @foreach($assets as $asset)
        <div class="modal fade" id="modalAssets-{{ $asset->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Header de la ventana -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 style="color: #007bb6" class="modal-title" id="myModalLabel">Información de {{ $asset->asset_code }} - {{ $asset->name }}</h4>
                    </div>
                    <!-- Cuerpo de la ventana -->
                    <div class="modal-body">
                        <!-- Se obtiene la información de depreciación -->
                        <?php
                            //Se extrae la información del tipo de bien
                            $asset_type = \App\Entities\AssetsType::find($asset->asset_type_id);
                        ?>
                        <label>Tipo de bien: </label>
                        <input disabled class="form-control" value="{{ $asset_type->name }}"><br>
                        <label>% de depreciación anual: </label>
                        <input disabled class="form-control" value="{{ $asset_type->percentage }} %"><br>
                        <label>Vida útil estimada: </label>
                        <input disabled class="form-control" value="{{ $asset_type->useful_life }} años">
                        <br>
                        <h4 align="center">TABLA DE DEPRECIACIÓN</h4>
                        <table width="100%" class="table table-hover table-responsive" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Fin de año #</th>
                                    <th>Depreciación anual</th>
                                    <th>Depreciación acumulada</th>
                                    <th>Valor en libros</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Se obtienen los registros de depreciación -->
                                <?php
                                    //Se extrae la información de los usuarios
                                    $binnacles = \App\Entities\Binnacle::all()->where('asset_id','=',$asset->id);
                                ?>
                                @foreach($binnacles as $binnacle)
                                    <tr class="gradeU">
                                        <td>{{ $binnacle->year }}</td>
                                        <td>{{ $binnacle->anual_depreciation }}</td>
                                        <td>{{ $binnacle->accumulated_depreciation }}</td>
                                        <td>{{ $binnacle->value }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- /.table-responsive -->
                        <h5>Información contable basada en el Art. 40, LISR</h5>
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