@extends('patientmaster')

@section('sidemenubar')
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li class="active">
                <a href="{{ url('home') }}"><i class="fa fa-home"></i> Dashboard</a>
            </li>
            <li>
                <a href="{{ url('client/reportarchives') }}"><i class="fa fa-bar-chart-o"></i> Reports</a>
            </li>
        </ul>
    </div>
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
                            <i class="fa fa-dashboard"></i> <a href="#">Home</a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row-->

                <div class="col-lg-12">
                    <div class="jumbotron">
                        <div class="container">
                            <h3>Greetings , {{ $username }}!</h3>

                            <p> Welcome to ATEST </p>
                            <hr>
                            <p><a class="btn btn-success btn-lg" href="{{ url('client/reportarchives') }}"
                                  role="button">View Reports</a></p>
                        </div>
                    </div>
                </div>
                    <!-- /.home-->
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- #page-wrapper -->




@endsection
@stop