@extends('practitionermaster')

@section('sidemenubar')

    @if(Session::has('is_admin'))
    
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li >
                    <a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i> Home</a>
                </li>
                <li>
                    <a href="{{ url('admin/personnelmanager') }}"><i class="fa fa-users"></i> Personnel Manager</a>
                </li>
                <li class="active">
                    <a href="{{ url('admin/reportmanager') }}"><i class="fa fa-bar-chart-o"></i> Report Manager</a>
                </li>
                <li>
                    <a href="{{ url('admin/questionmanager') }}"><i class="fa fa-pencil"></i> Question Manager</a>
                </li>
            </ul>
        </div>
    
    @else
    
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
            </ul>
        </div>

    @endif
    
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
                        
                    @if(Session::has('is_admin'))

                        <li>
                            <a href="{{ url('admin/reportmanager') }}"><i class="fa fa-bar-chart"></i> Report
                                Manager</a>
                        </li>
                        <li>
                            <a href="{{ url('/reports/overview', $report->id) }} "><i class="fa fa-search"></i>Report
                                Overview</a>
                        </li>
                        <li>
                             Viewing all <strong>Evaluation</strong> for Report: {{$report->id}}.
                        </li>

                    @else

                        <li>
                           <a href="{{ url('practitioner/reportmanager') }}"> <i class="fa fa-bar-chart"></i> Report
                                Manager</a>
                        </li>
                        <li>
                            <a href="{{ url('/reports/overview', $report->id) }} ">
                                <i class="fa fa-search"></i>Report
                                Overview</a>
                        </li>
                        <li>
                            Viewing all <strong>Evaluation(s)</strong> for Report: {{$report->id}}.
                        </li>

                    @endif

                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="col-lg-12">

                @unless(Session::has('is_admin'))
                <a class="btn btn-success"
                   href="{{ url('/reports/evaluation/new',$report->id) }}"
                   role="button">Create a new evaluation
                </a>
                <hr>
                @endunless
                
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home"><strong>View all Evaluation reports</strong></a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <!-- 1st tab -->
                        <table class="table table-bordered table-hover table-striped">
                        <br>
                            @if(empty($evaluationlist))
                                <tr> No Records
                                </tr>

                            @else

                                <tr>
                                    <th>Evaluation Number</th>
                                    <th>Product</th>
                                    <th>Client</th>
                                    <th>Practitioner</th>
                                    <th>Updated on</th>
                                    <th>View</th>
                                </tr>

                                <!-- List out reports -->
                                @foreach($evaluationlist as $evaluation)
                                    <tr>
                                        <td style="width:10%;"> {{ $evaluation['id'] }}</td>
                                        <td style="width:40%;"> {{ $evaluation['product'] }}</td>
                                        <td style="width:20%;"> {{ $evaluation['client_name'] }}</td>
                                        <td style="width:20%;"> {{ $evaluation['prac_name'] }}</td>
                                        <td style="width:10%;"> {{ $evaluation['date'] }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="menu1"
                                                        data-toggle="dropdown">Options
                                                    <span class="caret"></span></button>
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                               href="{{ url('/reports/evaluation/view',$evaluation['id']) }}">View</a>
                                                    </li>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                               data-toggle="modal"
                                                                               data-target="#{{$evaluation['id']}}">Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>


                                    <div class="container">
                                        <!-- Create new client Modal -->
                                        <div class="modal fade" id="{{$evaluation['id']}}" role="dialog">
                                            <div class="modal-dialog ">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title"><span
                                                                    style="color:#000000">Delete</span></h4>
                                                    </div>

                                                    <div class="modal-body">

                                                        <!-- Registration form -->
                                                        <form role="form" method="POST"
                                                              action="{{ url('/reports/selection/delete') }}">
                                                            <input type="hidden" name="selectid"
                                                                   value="{{ $evaluation['id'] }}">
                                                            <input type="hidden" name="reportid"
                                                                   value="{{ $report->id }}">

                                                            <h4> Are you sure you want to delete
                                                                Evaluation {{$evaluation['id']}} </h4>

                                                            <div class="modal-footer">
                                                                <button type="submit"
                                                                        class="btn btn-primary form-control">Confirm
                                                                </button>
                                                                <br><br>
                                                                <button type="button"
                                                                        class="btn btn-danger form-control"
                                                                        data-dismiss="modal">Close
                                                                </button>
                                                            </div>
                                                            <!-- /.modal-footer -->
                                                        </form>
                                                    </div>
                                                    <!-- /.modal-body -->
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
                                    </div>
                                    <!-- /.container -->
                                @endforeach
                            @endif
                        </table>
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








