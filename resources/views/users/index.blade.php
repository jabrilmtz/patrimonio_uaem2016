@extends('layouts.main')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-11">
                <h1 class="page-header">Usuarios</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-1">
                <span class="center"><br><br>
                    <p>
                        <a class="btn btn-outline btn-primary" href="users/create">
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
                        Usuarios de la aplicación
                    </div>
                    <!-- /.panel-heading -->
                    @include('partials.message')
                    <div class="panel-body">
                        <!-- Evalua que exista información que mostrar primero-->
                        @if(count($users) >= 1)
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Teléfono</th>
                                    <th>Tipo</th>
                                    <th>Acción</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    @if($user->id != Auth::user()->id)
                                    <tr class="gradeU">
                                        <?php
                                        //Se extrae la información de los roles de usuario
                                            $user_role = \App\Entities\UsersRole::find($user->id);
                                            $role = \App\Entities\Role::find($user_role->role_id);
                                        ?>
                                        <td><strong>{{$user->name}}</strong></td>
                                        <td>{{$user->email}}</td>
                                        <td>{{ $user_role->phone }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td class="center">
                                            <a class="btn btn-warning btn-circle" href="users/{{ $user->id }}/edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                <input name="_method" type="hidden" value="DELETE">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-circle">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endif
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