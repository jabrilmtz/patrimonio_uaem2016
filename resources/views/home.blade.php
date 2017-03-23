@extends('layouts.main')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Inicio</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-list-ul fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ count($normals) }}</div>
                                <div>Bienes normales</div>
                            </div>
                        </div>
                    </div>
                    <a href="/normal">
                        <div class="panel-footer">
                            <span class="pull-left">Ver más</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-edit fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ count($preregistereds) }}</div>
                                <div>Bienes pre-registrados</div>
                            </div>
                        </div>
                    </div>
                    <a href="/preregistered">
                        <div class="panel-footer">
                            <span class="pull-left">Ver más</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-question fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ count($surplus) }}</div>
                                <div>Bienes sobrantes</div>
                            </div>
                        </div>
                    </div>
                    <a href="/surplus">
                        <div class="panel-footer">
                            <span class="pull-left">Ver más</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-warning fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ count($incidences) }}</div>
                                <div>Incidencias</div>
                            </div>
                        </div>
                    </div>
                    <a href="/incidence">
                        <div class="panel-footer">
                            <span class="pull-left">Ver más</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i> Cantidad de incidencias ocurridas
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div id="incidencesChart" style="height: 300px;"></div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-8 -->
            <div class="col-lg-4">
                <!-- /.panel -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i> Tipos de incidencias ocurridas
                    </div>
                    <div class="panel-body">
                        <?php
                            $incidences = \App\Entities\Incidence::all();
                        ?>
                        @if(count($incidences)==0)
                            <h4>Aún no existen registros</h4>
                        @else
                            <div id="incidenceTypeChart" style="height: 300px;"></div>
                        @endif
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
@endsection
