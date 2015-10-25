@extends('patientmaster')

@section('sidemenubar')
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-home"></i> Dashboard</a>
            </li>
            <li class="active">
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
                            <i class="fa fa-dashboard"></i> <a href="{{ url('home') }}">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-bar-chart-o"></i> Report Manager</a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->


                <div class="tab-content">
                    <!-- home tab  -->
                    <div id="home" class="tab-pane fade in active">
                            <h3> Report Number: {{ $report->id }} </h3>
                            <!-- Display reports status -->
                            <div class="body" style="float:right"><h4>Status: {{ $report-> status }} </h4></div>
                            <br>
                            <hr/>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th>Question</th>
                                        <th>Answer</th>
                                    </tr>
                                    </thead>
                                    <!-- Display report questions and answers. -->
                                        @for ($i = 0; $i < $qrarraylength; $i++)
                                            <tr>
                                                <td>{{ $questionlist[$i]->question }} </td>
                                                <td>{{ $answerlist[$i]}} </td>
                                            </tr>
                                        @endfor
                                        </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->

                            <!-- display practitioner's notes -->
                            <label for="pracnotes">Practitioner's Notes</label>
                            @if (!empty($report->prac_notes))
                                <textarea name='pracnotes' class="form-control" rows="7"
                                          readonly=""> {{ $report->prac_notes }}</textarea>
                            @else
                                <textarea name='pracnotes' class="form-control" rows="7"
                                          readonly=""> No Remarks.</textarea>
                            @endif


                    </div>
                    <!-- /#home -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /dynamic Table -->
        </div>
    </div>
@endsection
@stop