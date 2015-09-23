@extends('practitionermaster')

@section('sidemenubar')
    <ul class="nav navbar-nav side-nav">
        <li class="active">
            <a href="{{ url('practitioner/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
        </li>
        <li>
            <a href="{{ url('practitioner/clientmanager') }}"><i class="fa fa-users"></i> Client Manager</a>
        </li>
        <li>
            <a href="{{ url('practitioner/reportmanager') }}"><i class="fa fa-bar-chart-o"></i> Report Manager</a>
        </li>
        <li>
            <a href="{{ url('practitioner/questionmanager') }}"><i class="fa fa-pencil"></i> Question Manager</a>
        </li>
    </ul>
@endsection

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        &nbsp;
                    </h1>
                    <ol class="breadcrumb">

                        <li class="active">
                            <i class="fa fa-dashboard"></i> Dashboard
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->


            <div class="col-lg-12">

                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
                    <li><a data-toggle="tab" href="#notification">Notification</a></li>

                </ul>


                <div class="tab-content">
                    @if ((count($errors) > 0) OR (Session::has('flash_message')))
                        <div id="home" class="tab-pane fade">
                            @else
                                    <!-- Home tab -->
                            <div id="home" class="tab-pane fade in active">
                                @endif
                                <br>

                                <div class="jumbotron">
                                    <div class="container">
                                        <h3>Greetings, Practitioner!</h3>

                                        <p> Who shall we help today?</p>
                                        <hr>
                                        <p><a class="btn btn-success btn-lg"
                                              href="{{ url('reports/createAssessment') }}"
                                              role="button">Create a new Report</a></p>
                                    </div>
                                </div>
                            </div>
                            <!-- notification tab -->
                            <div id="notification" class="tab-pane fade ">
                                <br>

                                <div class="jumbotron">
                                    <div class="container">
                                        <h3>Notification will be implemented here</h3>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- #page-wrapper -->
@endsection
@stop






