@extends('adminmaster')

@section('sidemenubar')
    <div class="collapse navbar-collapse navbar-ex1-collapse">

        <ul class="nav navbar-nav side-nav">
            <li class="active">
                <a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a>
            </li>
            <li>
                <a href="{{ url('admin/personnelmanager') }}"><i class="fa fa-users"></i> Personnel Manager</a>
            </li>
            <li>
                <a href="{{ url('admin/reportmanager') }}"><i class="fa fa-bar-chart-o"></i> Report Manager</a>
            </li>
            <li>
                <a href="{{ url('admin/questionmanager') }}"><i class="fa fa-pencil"></i> Question Manager</a>
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

                        <li class="active">
                            <i class="fa fa-home"></i> Dashboard
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->


            <div class="col-lg-12">

                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Dashboard</a></li>


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
                                        <h3>Greetings, Administrator!</h3>

                                        <p> Who shall we help today?</p>
                                        <hr>
                                        <p><a class="btn btn-success btn-lg"
                                              href="{{ url('admin/reportmanager') }}"
                                              role="button">View All Reports</a></p>
                                    </div>
                                </div>
                            </div>
                            <!-- notification tab -->

                        </div>
                        <hr>

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






