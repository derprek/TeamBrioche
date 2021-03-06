@extends('master.practitioner')

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
                    <div class="pull-left">
                        <h3>Greetings, Practitioner!</h3>
                        <p> Who shall we help today?</p>
                        <hr>

                        <span class="pull-left">
                            <a class="btn btn-success btn-lg"
                               href="{{ url('reports/assessment/new') }}"
                               role="button">Create a new Report
                            </a>

                            @if(isset($latest_report))
                                <a class="btn btn-primary btn-lg" style="padding-left:20px;"
                                   href="/reports/overview/{{ $latest_report->id }}"
                                   role="button">View your latest Report
                                </a>
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <br>

        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- #page-wrapper -->
@endsection
@stop






