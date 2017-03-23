@extends('layouts.main')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-11">
                <h1 class="page-header">Incidencias</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-1">
                <span class="center"><br><br>
                    <p>
                        <a class="btn btn-outline btn-primary" href="incidence/create">
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
                        Incidencias ocurridas con los bienes escaneados
                    </div>
                    <!-- /.panel-heading -->
                    @include('partials.message')
                    <div class="panel-body">
                        <!-- Evalua que exista información que mostrar primero-->
                        @if(count($incidences) >= 1)
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha</th>
                                    <th>Tipo</th>
                                    <th>Bien</th>
                                    <th>Comentario</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($incidences as $incidence)
                                    <tr class="gradeU">
                                        <?php
                                            //Se extrae la información de los usuarios
                                            $inT = \App\Entities\IncidencesType::find($incidence->incidence_type_id);
                                            $assets = \App\Entities\Asset::find($incidence->asset_id);
                                        ?>
                                        <td><strong>{{$incidence->id}}</strong></td>
                                        <td>{{$incidence->created_at->toFormattedDateString() }}</td>
                                        <td>{{$inT->name}}</td>
                                            <td align="center">
                                                <button type="button" class="btn btn-success" data-toggle="modal"
                                                        data-target="#modalAsset-{{ $incidence->asset_id}}">
                                                    {{ $assets->asset_code  }}
                                                </button>
                                            </td>
                                        <td>{{$incidence->comment}}</td>
                                        <td>
                                            @if($incidence->status==0)
                                                Sin atender
                                            @elseif($incidence->status==1)
                                                En proceso
                                            @else
                                                Atendido
                                            @endif
                                        </td>
                                        <td class="center">
                                            <a class="btn btn-warning btn-circle" href="incidence/{{ $incidence->id }}/edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
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
    @foreach($incidences as $incidence)
        <div class="modal fade" id="modalAsset-{{ $incidence->asset_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <?php
                        //Se extrae la información de los bienes
                        $asset = \App\Entities\Asset::find($incidence->asset_id);
                    ?>
                    <!-- Header de la ventana -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 style="color: #007bb6" class="modal-title" id="myModalLabel">
                            Información de {{ $asset->name }} - {{ $asset->asset_code }}</h4>
                    </div>
                        <form role="form" method="POST" action="{{ route('incidence.update', $asset->id) }}"
                              enctype="multipart/form-data">
                            <input name="_method" type="hidden" value="PUT">
                            <input name="option_update" type="hidden" value="2">
                            {{ csrf_field() }}
                            <!-- Cuerpo de la ventana -->
                            <div class="modal-body">
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
                                    <label>Descripción</label>
                                    <textarea class="form-control" rows="3" name="description">{{ $asset->description }}</textarea>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">$</span>
                                    <input hidden name="actual_cost" value="{{ $asset->actual_cost }}">
                                    <input disabled type="number" class="form-control" value="{{ $asset->actual_cost }}">
                                    <span class="input-group-addon">MXN*</span>
                                </div>
                                <?php
                                    //Se extrae la información de los catálogos
                                    $brands = \App\Entities\Brand::all();
                                    $providers = \App\Entities\Provider::all();
                                    $programs = \App\Entities\Program::all();
                                    $units = \App\Entities\Unit::all();
                                    $assets_types = \App\Entities\AssetsType::all();
                                ?>
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
                                @if($asset->status == '1' || $asset->status == '2')
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
                                @endif
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
                            </div>
                            <!-- Footer de la ventana -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline btn-primary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-outline btn-success">Actualizar</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Fin del modal -->
@endsection