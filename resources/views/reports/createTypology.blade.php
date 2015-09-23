@extends('practitionermaster')

@section('sidemenubar')
    <ul class="nav navbar-nav side-nav">
        <li>
            <a href="{{ url('practitioner/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
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
                            <i class="fa fa-dashboard"></i> <a href="{{ url('practitioner/dashboard') }}">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-desktop"></i> Create Step two
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <a class="btn btn-default" href="{{ url('/practitioner/overview', $report_id) }}"> Back to Overview </a>

            <div class="form-group">
                <hr>

                {!! Form::open(['url' => 'reports/Typology']) !!}

                @unless($questions->isEmpty())

                        <!-- display the questions for step two by category -->
                <div class="row">


                <div class="form-group" style="padding:10px;">
                    <label for="goals_typology">Goals:</label>
                     <textarea readonly name="goals_typology"
                      class="form-control" rows="5"
                       placeholder="Goals + Typology"> {{ $goals}}</textarea>
                </div>

                    <input type="hidden" name="reportid" value= {{ $report_id }}>
                    @foreach($questionslist as $questionbycat)

                        @foreach($questionbycat as $questionbytype)

                            @if($questionbytype->type === "thumbnail")

                                <div class="col-sm-6 col-md-6" style="padding-top:40px;border-spacing: 10px 50px;">
                                    <div class="thumbnail" style="border: 1px outset black;padding:10px;">
                                        <br>
                                        <img style="width:20%" src={{ $questionbytype->imgpath }} >
                                        <br>
                                        <h4>{{ $questionbytype->question }}</h4>
                                        <hr>
                                        <div class="caption">
                                                <textarea class="form-control"
                                                          name="answersid[{{ $questionbytype->id }}]" rows="3"
                                                          placeholder="{{ $questionbytype->placeholder }}"></textarea>
                                            <hr>
                                        </div>

                                        @else
                                            <div class="form-group" style="padding-left:10px;">
                                                <label for="answersid[{{ $questionbytype->id }}]">{{ $questionbytype->question }}</label>
                                                @if($questionbytype->type === "tall")
                                                    <textarea name="answersid[{{ $questionbytype->id }}]"
                                                              class="form-control" rows="3"
                                                              placeholder="{{ $questionbytype->placeholder }}"></textarea>
                                                @elseif($questionbytype->type === "regular")
                                                    <input type="text" name="answersid[{{ $questionbytype->id }}]"
                                                           class="form-control"
                                                           placeholder="{{ $questionbytype->placeholder }}">
                                                @endif
                                            </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach

                                @endunless
                </div>
                <hr>
                <div class="form-group" style="padding:3%;">
                    {!! Form:: submit('Create Typology' , ['class' => 'btn btn-info form-control']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- #page-wrapper -->

@stop