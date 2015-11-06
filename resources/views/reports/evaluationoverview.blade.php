@extends('master.practitioner')

@section('sidemenubar')

    @include('partials.sidebar_reports')

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
                    
                @if((Session::has('prac_id')) && (Session::has('is_admin')))

                    <li>
                        <a href="{{ url('admin/reportmanager') }}"><i class="fa fa-bar-chart"></i> Report Manager</a>
                    </li>

                    <li>
                        <a href="{{ url('/reports/overview', $report->id) }} "><i class="fa fa-search"></i>Report Overview</a>
                    </li>

                @elseif(Session::has('prac_id'))

                    <li>
                       <a href="{{ url('practitioner/reportmanager') }}"> <i class="fa fa-bar-chart"></i> Report Manager</a>
                    </li>

                    <li>
                        <a href="{{ url('/reports/overview', $report->id) }} "> <i class="fa fa-search"></i>Report Overview</a>
                    </li>

                 @elseif(Auth::check())

                    <li>
                        <a href="{{ url('/client/reportarchives') }}"><i class="fa fa-bar-chart-o"></i> View all reports</a>
                    </li>

                    <li>
                        <a href="{{ url('/reports/overview',$report->id ) }}"><i class="fa fa-search"></i>Report Overview</a>
                    </li>

                @endif

                <li class="active">
                    Viewing all <strong>Evaluation(s)</strong> for Report: {{$report->id}}.
                </li>

                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="col-lg-12">

            <br>
                <a class="directionLinks pull-left" href="{{ url('/reports/overview', $report->id) }}" >
                     <i class="fa fa-chevron-left"></i>Back to Overview
                </a> 
            <br><hr>

            @unless((Session::has('is_admin')) || (Auth::check()))
                
                <a class="btn btn-success pull-left"
                   href="{{ url('/reports/evaluation/new',$report->id) }}"
                   role="button"><i class="fa fa-plus"></i> Create a new Evaluation
                </a>
                <br><br>
                
            @endunless

                    <!-- 1st tab -->
                    <table class="table table-bordered table-hover table-striped">
                    <br>
                        @if(empty($evaluationlist))
                            <tr> No Records </tr>
                        @else

                            <tr>
                                <th class="smallRow">Evaluation Number</th>
                                <th class="normalRow">Product</th>
                                <th class="mediumRow">Client</th>
                                <th class="mediumRow">Practitioner</th>
                                <th class="smallRow">Updated on</th>
                                <th class="smallRow">View</th>
                            </tr>

                            <!-- List out reports -->
                            @foreach($evaluationlist as $evaluation)
                                <tr>
                                    <td> {{ $evaluation['id'] }}</td>
                                    <td> {{ $evaluation['product'] }}</td>
                                    <td> {{ $evaluation['client_name'] }}</td>
                                    <td> {{ $evaluation['prac_name'] }}</td>
                                    <td> {{ $evaluation['date'] }}</td>
                                    <td><a
                                         href="{{ url('/reports/evaluation/view',$evaluation['id']) }}"
                                        class="btn btn-primary btn-sm"> View</a></td>

                            @endforeach
                        @endif

                    </table>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- #page-wrapper -->
@endsection
@stop








