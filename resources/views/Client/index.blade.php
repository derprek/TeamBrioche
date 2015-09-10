@extends('patientmaster')

@section('sidemenubar')
    <ul class="nav navbar-nav side-nav">
        <li class="active">
            <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="{{ url('reportarchives') }}"><i class="fa fa-bar-chart-o"></i> Reports</a>
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
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="#">Dashboard</a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="col-lg-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
                    <li><a data-toggle="tab" href="#">Notification</a></li>
                </ul>
                <div class="tab-content">
                    <!-- 1st tab -->

                    <div id="home" class="tab-pane fade in active">
                        <br>

                        <div class="jumbotron">
                            <div class="container">
                                <h3>Greetings , {{ Auth::User()->fname}}!</h3>

                                <p> Welcome to ATEST </p>
                                <hr>
                                <p><a class="btn btn-success btn-lg" href="{{ url('reportarchives') }}"
                                      role="button">View Reports</a></p>
                            </div>

                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>



@endsection
@stop