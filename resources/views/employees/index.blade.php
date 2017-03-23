@extends('layouts.main')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-11">
                <h1 class="page-header">Encargados</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-1">
                <span class="center"><br><br>
                    <p>
                        <a class="btn btn-outline btn-primary" href="employee/create">
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
                        Encargados de las unidades académicas de la institución
                    </div>
                    <!-- /.panel-heading -->
                    @include('partials.message')
                    <div class="panel-body">
                        <!-- Evalua que exista información que mostrar primero-->
                        @if(count($employees) >= 1)
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>Código de empleado</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Correo electrónico</th>
                                    <th>Unidades</th>
                                    <th>Acción</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($employees as $employee)
                                    <tr class="gradeU">
                                        <?php
                                            //Se extrae la información de las unidades
                                            $units = \App\Entities\Unit::all()->where('employee_id','==',$employee->id);
                                        ?>
                                        <td><strong>{{$employee->code}}</strong></td>
                                        <td>{{$employee->name}}</td>
                                        <td>{{$employee->surname}}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td align="center">
                                            <button type="button" class="btn btn-success btn-circle" data-toggle="modal"
                                                    data-target="#modalEmployees-{{ $employee->id }}">
                                                {{ count($units) }}
                                            </button>
                                        </td>
                                        <td class="center">
                                            <a class="btn btn-warning btn-circle" href="employee/{{ $employee->id }}/edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @if(count($units)==0)
                                            <form action="{{ route('employee.destroy', $employee->id) }}" method="POST">
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
    @foreach($employees as $employee)
        <div class="modal fade" id="modalEmployees-{{ $employee->id }}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Header de la ventana -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 style="color: #007bb6" class="modal-title"
                            id="myModalLabel">Unidades a cargo de {{ $employee->name }}</h4>
                    </div>
                    <!-- Cuerpo de la ventana -->
                    <div class="modal-body">
                        <?php
                        //Se extrae la información de las unidades
                        $units = \App\Entities\Unit::all()->where('employee_id','==',$employee->id);
                        ?>
                        @if(count($units)>=1)
                            <table width="100%" class="table table-hover table-responsive" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>Código de unidad</th>
                                    <th>Nombre</th>
                                    <th>Ubicación</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($units as $unit)
                                    <tr class="gradeU">
                                        <td>{{ $unit->code }}</td>
                                        <td>{{ $unit->name }}</td>
                                        <td>{{ $unit->location }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        @else
                            <h4>Aún no existen unidades a cargo del empleado</h4>
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