@extends('practitionermaster')

@section('sidemenubar')
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="{{ url('practitioner/dashboard') }}"><i class="fa fa-home"></i> Home</a>
            </li>
            <li>
                <a href="{{ url('practitioner/clientmanager') }}"><i class="fa fa-users"></i> Client Manager</a>
            </li>
            <li class="active">
                <a href="{{ url('practitioner/reportmanager') }}"><i class="fa fa-bar-chart-o"></i> Report Manager</a>
            </li>
            <li>
                <a href="{{ url('practitioner/questionmanager') }}"><i class="fa fa-pencil"></i> Question Manager</a>
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
                            <i class="fa fa-bar-chart"></i> <a href="{{ url('practitioner/reportmanager') }}">Report
                                Manager</a>
                        </li>
                        <li>
                            <i class="fa fa-search"></i>
                            <a href="{{ url('/practitioner/overview', $report->id) }} ">Report
                                Overview</a>
                        </li>
                        <li class="active">
                            Edit Typology
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <h3>Edit Typology</h3>
                <hr>

                <!-- Display client and practitioner name -->
                <div>
                    <a class="btn btn-default" href="{{ url('/practitioner/overview', $report->id) }}"> Back to
                        Overview </a>

                    <a class="btn btn-primary" role="button" data-toggle="collapse" href="#stakeholders"
                       aria-expanded="false" aria-controls="collapseExample">
                        Stakeholders
                    </a>

                    <div class="collapse" id="stakeholders">
                        <div class="well">
                            <h4>Client's name: {{ $clientinfo->fname}} {{ $clientinfo->sname}}</h4>
                            <h4>Practitioner-in-charge: {{ $pracinfo->name }}</h4>
                        </div>
                    </div>
                </div>
                <br>
                {!! Form::open(['url' => 'reports/Typology/update']) !!}
                <input type="hidden" name="reportid" value={{$report->id}}>

               @include('show_report')
               
            </div>
        </div>

        <!-- /.container-fluid -->
    </div>

    <!-- /#page-wrapper -->
    <script type="text/javascript">
        $(".selectthumbnail").height(Math.max.apply(null, $(".selectthumbnail").map(function () {
            return $(this).height();
        })));
    </script>
@endsection
@stop
