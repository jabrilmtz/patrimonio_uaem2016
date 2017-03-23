<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema de Patrimonio UAEM</title>

    <!-- Bootstrap Core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/home">Sistema de Patrimonio UAEM</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <!-- Modal para cargar la información de usuario -->
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalUser">
                    <i class="fa fa-user fa-fw"></i>
                    <!-- Se extrae el nombre del usuario para mostrarlo -->
                        {{ Auth::user()->name }}
                </button>
            </li>
            <li>
                <!-- Botón para cerrar sesión -->
                <a href="{{ url('/logout') }}"
                   onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out fa-fw"></i>
                    Salir
                </a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <!-- Comienzan a mostrarse las opciones del menú -->
                    <li>
                        <a href="#"><i class="fa fa-list-ul fa-fw"></i> Bienes<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="/normal"> Normales</a>
                            </li>
                            <li>
                                <a href="/preregistered"> Pre-registros</a>
                            </li>
                            <li>
                                <a href="/surplus"> Sobrantes</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <?php
                        //Se extrae la información del rol del usuario
                        $user_role = \App\Entities\UsersRole::find(Auth::user()->id);
                    ?>
                    @if($user_role->role_id == 1)
                        <li>
                            <a href="/assetsTypes"><i class="fa fa-archive fa-fw"></i> Tipos de activos</a>
                        </li>
                        <li>
                            <a href="/incidence"><i class="fa fa-warning fa-fw"></i> Incidencias</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-list-ul fa-fw"></i> Catálogos<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/brand"><i class="fa fa-tag fa-fw"></i> Marcas</a>
                                </li>
                                <li>
                                    <a href="/provider"><i class="fa fa-shopping-cart fa-fw"></i> Proveedores</a>
                                </li>
                                <li>
                                    <a href="/program"><i class="fa fa-book fa-fw"></i> Programas académicos</a>
                                </li>
                                <li>
                                    <a href="/employee"><i class="fa fa-male fa-fw"></i> Encargados</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="/unit"><i class="fa fa-institution fa-fw"></i> Unidades académicas</a>
                        </li>
                        <li>
                            <a href="/users"><i class="fa fa-users fa-fw"></i> Usuarios</a>
                        </li>
                        <li>
                            <a href="/inventories"><i class="fa fa-table fa-fw"></i> Inventarios</a>
                        </li>
                        <li>
                            <a href="/reports"><i class="fa fa-bar-chart-o fa-fw"></i> Graficas</a>
                        </li>
                        <li>
                            <a href="/excel"><i class="fa fa-database fa-fw"></i> Datos</a>
                        </li>
                    @else
                        <li>
                            <a href="/unit"><i class="fa fa-institution fa-fw"></i> Unidades académicas</a>
                        </li>
                        <li>
                            <a href="/inventories"><i class="fa fa-table fa-fw"></i> Inventarios</a>
                        </li>
                        <li>
                            <a href="/reports"><i class="fa fa-bar-chart-o fa-fw"></i> Gráficas</a>
                        </li>
                    @endif
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

</div>
<!-- /#wrapper -->

@yield('content')

<!-- jQuery -->
<script src="/vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="/vendor/metisMenu/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="/vendor/raphael/raphael.min.js"></script>
<script src="/vendor/morrisjs/morris.min.js"></script>

<!-- Gráfica en forma de dona de tipos de incidencias-->
<script>
    new Morris.Donut({
        // Se especifíca el nombre de la gráfica para hacer referencia
        element: 'incidenceTypeChart',
        data: [
                <?php
                    // Se extraen todos los tipos de incidencias
                    $inc_types = \App\Entities\IncidencesType::all();
                ?>
                    // Se comienzan a recorrer las incidencias
                @foreach($inc_types as $inc_type)
                    // Se asigna el nombre del tipo de incidencia a una sección de la gráfica
                    {label: "{{ $inc_type->name }} ",
                        <?php
                                // Se evalua cantidad de incidencias dentro del tipo
                            $incidences = \App\Entities\Incidence::all();
                            $incidences = $incidences->where('incidence_type_id','==',$inc_type->id);
                        ?>
                        // Se le asigna el valor de la cuenta de dichas incidencias
                        value: '{{ count($incidences) }}'},
                @endforeach
        ]
    });
</script>

<!-- Gráfica de barras de incidencias ocurridas  -->
<script>
    new Morris.Bar({
        element: 'incidencesChart',
        data: [
            <?php
                    // Se obtienen todos los registros y se separan por estado
                $incidences = \App\Entities\Incidence::all();
                $unattended = $incidences->where('status','==','0');
                $process = $incidences->where('status','==','1');
                $attended = $incidences->where('status','==','2');
                    // Se declaran e inicializan los contadores
                    $cont_un =0; $cont_process=0; $cont_att=0;
            ?>
                    // Se comienza a evaluar mes por mes
                @for($i=1; $i<=12; $i++)
                    // Se evalua si pertenecen a no atendidos
                    @foreach($unattended as $un)
                        @if($un->created_at->month == $i)
                            <?php
                                $cont_un = $cont_un+1;
                            ?>
                        @endif
                    @endforeach
                    // Se evalua si pertenecen a en proceso
                    @foreach($process as $pro)
                        @if($pro->created_at->month == $i)
                            <?php
                            $cont_process = $cont_process+1;
                            ?>
                        @endif
                    @endforeach
                    // Se evalua si pertenecen a atendidos
                    @foreach($attended as $att)
                        @if($att->created_at->month == $i)
                            <?php $cont_att = $cont_att+1; ?>
                        @endif
                    @endforeach
                    {
                    <?php
                            // Se asigna el nombre del mes
                        switch ($i){
                            case 1: ?>
                                y: 'Enero',
                            <?php break;
                            case 2: ?>
                                y: 'Febrero',
                            <?php break;
                            case 3: ?>
                                y: 'Marzo',
                            <?php break;
                            case 4: ?>
                                y: 'Abril',
                            <?php break;
                            case 5: ?>
                                y: 'Mayo',
                            <?php break;
                            case 6: ?>
                                y: 'Junio',
                            <?php break;
                            case 7: ?>
                                y: 'Julio',
                            <?php break;
                            case 8: ?>
                                y: 'Agosto',
                            <?php break;
                            case 9: ?>
                                y: 'Septiembre',
                            <?php break;
                            case 10: ?>
                                y: 'Octubre',
                            <?php break;
                            case 11: ?>
                                y: 'Noviembre',
                            <?php break;
                            case 12: ?>
                                y: 'Diciembre',
                            <?php break;
                        }
                    ?>
                            //Se asigna el valor de los contadores por mes
                    a: "{{ $cont_un }}",
                    b: "{{ $cont_process }}",
                    c:"{{ $cont_att }}"},
                    <?php
                        // Se reinician los contadores
                        $cont_un =0; $cont_process=0; $cont_att=0;
                    ?>
                @endfor
        ],
        xkey: 'y',
        ykeys: ['a', 'b', 'c'],
        labels: ['Sin atender', 'En proceso', 'Atendido']
    });
</script>


<!-- Custom Theme JavaScript -->
<script src="/dist/js/sb-admin-2.js"></script>


<!-- Data tables -->
<script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            language: {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
    } );
</script>

<!-- Modal -->
<div class="modal fade" id="modalUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Header de la ventana -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="myModalLabel" style="color: #007bb6">Información de usuario</h3>
            </div>
            <form role="form" method="POST" action="{{ route('users.update', Auth::user()->id) }}"
                  enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PUT">
                <input name="option_update" type="hidden" value="2">
                {{ csrf_field() }}
                <!-- Cuerpo de la ventana -->
                <div class="modal-body">
                    <label>Nombre: </label>
                    <input name="name" class="form-control" value="{{ Auth::user()->name }}"><br>
                    <label>Email: </label>
                    <input name="email" type="email" class="form-control" value="{{ Auth::user()->email }}"><br>
                    <?php
                        //Se extrae la información de los roles de usuario
                        $user_role = \App\Entities\UsersRole::find(Auth::user()->id);
                        $role = \App\Entities\Role::find($user_role->role_id);
                    ?>
                    <label>Teléfono: </label>
                    <input name="phone" class="form-control" value="{{ $user_role->phone }}"><br>
                    <label>Tipo de usuario: </label>
                    <input name="role_id" disabled class="form-control" value="{{ $role->name }}"><br>
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

</body>

</html>
