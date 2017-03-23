@extends('layouts.main')

@section('content')

        <!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Highcharts Example</title>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <style type="text/css">
        ${demo.css}
    </style>

    <!-- G R Á F I C A      T I P O S  D E  B I E N E S  U N I D A D  A C Á D E M I C A  -->
    <script type="text/javascript">
        $(function () {
            Highcharts.chart('container', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    <?php
                        // Se obtiene la información de la unidad
                        $unit = \App\Entities\Unit::find($unit_id);
                    ?>
                    // Se le da un título a la gráfica
                    text: 'Tipos de bienes en la unidad académica {{ $unit->name }}'
                },
                tooltip: {
                    // Se establece el formato a mostrar cuando se pase sobre el puntero sobre el gráfico
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f}',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    name: 'Bienes',
                    colorByPoint: true,
                    // Se comienzan a asignar los valores a cada sección del gráfico
                    <?php
                        // Se obtienen todos los registros y se separan por estado
                        $assets = \App\Entities\Asset::all();
                        $assets = $assets->where('unit_id','==',$unit_id);
                        $preregistered = $assets->where('status_id','==','2');
                        $normal = $assets->where('status_id','==','1');
                        $cont_normal = count($normal);
                        $cont_preregistered = count($preregistered);
                    ?>
                    data: [{
                        name: 'Normales',
                        y: {{ $cont_normal }},
                        sliced: true,
                        selected: true
                    }, {
                        name: 'Pre-registros',
                        y: {{ $cont_preregistered }}
                    }]
                }]
            });
        });
    </script>

    <!-- G R Á F I C A   D E   L I N E A    T O T A L E S  D E  L A  U N I D A D -->
    <script type="text/javascript">
        $(function () {
            Highcharts.chart('container2', {
                chart: {
                    // Se establece el tipo de gráfico a mostrar
                    type: 'line'
                },
                title: {
                    <?php
                        // Se obtiene la información de la unidad
                        $unit = \App\Entities\Unit::find($unit_id);
                    ?>
                    // Se le da un título al gráfico
                    text: 'Totales de la unidad académica {{ $unit->name }}'
                },
                xAxis: {
                    categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
                },
                yAxis: {
                    title: {
                        text: 'Monto ($)'
                    }
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true
                        },
                        enableMouseTracking: false
                    }
                },
                <?php
                    // Se obtienen todos los registros y se separan por estado
                    $assets = \App\Entities\Asset::all();
                    $assets = $assets->where('unit_id','==',$unit_id);
                ?>
                series: [{
                    name: 'Ganancias',
                    data: [
                        <?php
                            // Se obtienen los bienes ya revisados
                            $revised = $assets->where('category','==','Revisado');
                        ?>
                            // Se comienza a evaluar cada mes
                        @for($i=1;$i<13;$i++)
                            <?php
                            // Se generan variables para obtener las fechas de asignación
                                $tot_revised = 0;
                                if ($i<10){
                                    $start = '2016-0'.$i.'-01';
                                    $end = '2016-0'.$i.'-31';
                                }else{
                                    $start = '2016-'.$i.'-01';
                                    $end = '2016-'.$i.'-31';
                                }
                                // Se seleccionan los bienes que esten dentro de esas fechas
                                $tot_revised = $revised->where('assign_date','>=',$start);
                                $tot_revised = $revised->where('assign_date','<=',$end);
                                // Se realiza la suma de los precios de los bienes
                                $amount = 0;
                                foreach ($tot_revised as $t_r){
                                    $amount = $amount + $t_r->actual_cost;
                                }
                            ?>
                            // Se presenta el total de cada mes
                            {{ $amount }},
                        @endfor
                    ]
                }, {
                    name: 'Perdidas',
                    data: [
                        <?php
                            // Se obtienen los bienes sin revisar
                            $no_revised = $assets->where('category','==','Sin revisar');
                        ?>
                            // Se comienza a evaluar cada mes
                        @for($i=1;$i<13;$i++)
                            <?php
                                // Se generan variables para obtener las fechas de asignación
                                $tot = 0;
                                if ($i<10){
                                    $start = '2016-0'.$i.'-01';
                                    $end = '2016-0'.$i.'-31';
                                }else{
                                    $start = '2016-'.$i.'-01';
                                    $end = '2016-'.$i.'-31';
                                }
                                // Se seleccionan los bienes que esten dentro de esas fechas
                                $tot = $no_revised->where('assign_date','>=',$start);
                                $tot = $no_revised->where('assign_date','<=',$end);
                                // Se realiza la suma de los precios de los bienes
                                $amount = 0;
                                foreach ($tot as $t){
                                    $amount = $amount + $t->actual_cost;
                                }
                            ?>
                            // Se presenta el total de cada mes
                            {{ $amount }},
                        @endfor
                    ]
                }]
            });
        });
    </script>

    <!-- G R Á F I C A      T I P O S  D E  B I E N E S  U N I D A D  A C Á D E M I C A  -->
    <script type="text/javascript">
        $(function () {
            Highcharts.chart('container3', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: 0,
                    plotShadow: false
                },
                title: {
                    <?php
                        // Se obtiene la información de la unidad
                        $unit = \App\Entities\Unit::find($unit_id);
                    ?>
                    text: 'Bienes normales <br>{{ $unit->name }}',
                    align: 'center',
                    verticalAlign: 'middle',
                    y: -160
                },
                tooltip: {
                    pointFormat: '<b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        dataLabels: {
                            enabled: true,
                            distance: -50,
                            style: {
                                fontWeight: 'bold',
                                color: 'white'
                            }
                        },
                        startAngle: -90,
                        endAngle: 90,
                        center: ['50%', '75%']
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Browser share',
                    innerSize: '50%',
                    // Se comienzan a asignar los valores
                    <?php
                        // Se obtienen todos los registros y se separan por estado
                        $assets = \App\Entities\Asset::all();
                        $assets = $assets->where('unit_id','==',$unit->id);
                        $normal = $assets->where('status_id','==','1');
                        $inspected = $normal->where('category','==','Revisado');
                        $cont_inspected = count($inspected);
                        $uninspected = $normal->where('category','==','Sin revisar');
                        $cont_uninspected = count($uninspected);
                    ?>
                    data: [
                        ['Revisados', {{ $cont_inspected }}],
                        ['Sin revisar', {{ $cont_uninspected }}]
                    ]
                }]
            });
        });
    </script>
</head>
<body>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Gráficas</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Favor seleccionar una unidad académica para la generación de gráficas con reporte
                </div>
                @include('partials.message')
                <div class="panel-body">
                    <div class="row">
                        <form role="form" method="POST" action="{{ url('reports') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <select class="form-control" name="unit_id" disabled>
                                        @foreach($units as $unit)
                                            <option value="{{$unit->id}}"
                                                    @if($unit_id == $unit->id)
                                                    selected
                                                    @endif
                                            >{{$unit->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                            <div class="col-lg-3">
                                <a class="btn btn-outline btn-danger" href="/reports">
                                    <i class="fa fa-chevron-left"> Regresar</i>
                                </a>
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
    <div class="row">
        <!-- Primer contenedor - Gráfica de pastel total de bienes Normales / Pre-registros -->
        <div class="col-lg-6">
            <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
        </div>
        <!-- Segundo contenedor - Gráfica de línea totales de la unidad académica -->
        <div class="col-lg-6">
            <div id="container2" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <!-- Tercer contenedor  - Gráfica de pastel, total de bienes Revisados / NO revisados-->
        <div class="col-lg-12">
            <div id="container3" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
</body>
</html>
@endsection
