@extends('master.admin')

@section('sidemenubar')
    
    @include('partials.sidebar_home')
    
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
            <br>

                <div class="jumbotron">
                    <div class="container">
                        <h3>Greetings, Administrator!</h3>

                        <p> Who shall we help today?</p>
                        <hr>

                        <span class="pull-left">
                                <a class="btn btn-success btn-lg"
                                      href="{{ url('admin/reportmanager') }}"
                                      role="button">View All Reports</a>

                                <a class="btn btn-primary btn-lg"
                                      href="{{ url('admin/personnelmanager') }}"
                                      role="button">View All Personnel</a>
                        </span>

                    </div>
                </div>

            </div>
             
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- #page-wrapper -->
@endsection
@stop






