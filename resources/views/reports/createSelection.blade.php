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
                            <i class="fa fa-dashboard"></i> <a href="{{ url('practitioner/dashboard') }}">Dashboard</a>
                        </li>
                        <li>
                            <i></i> <a href="{{ url('practitioner/reportmanager') }}">Report Manager</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-pencil"></i> Create a new Selection report
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <div class="form-group">
                <a class="btn btn-default" href="{{ URL::previous() }}"> Back to
                    Overview </a>

                <a class="btn btn-primary" role="button" data-toggle="collapse" href="#stakeholders"
                   aria-expanded="false" aria-controls="collapseExample">
                    Stakeholders
                </a>

                <div class="collapse" id="stakeholders">
                    <div class="well">
                        <h4>Report No: {{ $report_id }}</h4>
                        <h4>Client: {{ $clientname }}</h4>
                        <h4>Practitioner-in-charge: {{ $pracname }}</h4>
                    </div>
                </div>

                {!! Form::open(['url' => 'reports/Selection']) !!}
                <input type="hidden" name="reportid" value= {{ $report_id }}>
                <input type="hidden" name="clientid" value= {{ $client_id }}>
                <hr>

                @unless($questions->isEmpty())

                        <!-- Display question in step one by  category -->
                <div class="row">

                    @foreach($questionslist as $questionbycat)

                        @foreach($questionbycat as $questionbytype)

                            @if($questionbytype->type === "thumbnail")

                                <div class="col-sm-6 col-md-6" style="padding-top:10px;border-spacing: 10px 50px;">
                                    <div class="selectthumbnail" id="questionthumbnail" style="height:50%;">
                                        <br>
                                        <img style="width:10%;" src={{ $questionbytype->imgpath }} >
                                        <br>
                                        <h4>{{ $questionbytype->question }}</h4>
                                        <hr>
                                        <div class="caption">
                                            @if($questionbytype->category_id < 6)
                                                <textarea class="form-control"
                                                          rows="3"
                                                          readonly="">{{$questionbytype->pivot->answers}}</textarea>
                                            @else
                                                <textarea class="form-control"
                                                          name="answersid[{{ $questionbytype->id }}]"
                                                          rows="5"></textarea>
                                            @endif
                                            <hr>
                                        </div>

                                        @else
                                            <div class="form-group" style="padding:10px;">
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
                                            <!-- /.form-group -->
                                        @endif
                                        @endforeach
                                    </div>
                                    <!-- /.thumbnail -->
                                </div>
                                @endforeach

                                @endunless
                </div>
                <!-- /.row -->
                <hr>
                <div class="form-group" style="padding:3%;">
                    {!! Form:: submit('Create Selection' , ['class' => 'btn btn-success form-control']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    <br>

    <script type="text/javascript">
        $(".selectthumbnail").height(Math.max.apply(null, $(".selectthumbnail").map(function () {
            return $(this).height();
        })));
    </script>
@endsection

@stop