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
                        <li>
                            Edit Assessment
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

                <div class="form-group">
                    {!! Form::open(['url' => 'reports/stepAssessment/update']) !!}

                    <h3>Edit Assessment</h3>
                    <hr>
                    <input type="hidden" name="reportid" value={{$report->id}}>

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
                                <h4>Report: {{$report->id}}</h4>
                                <h4>Client's name: {{ $clientinfo->fname}} {{ $clientinfo->sname}}</h4>
                                <h4>Practitioner's name: {{ $pracinfo->name }}</h4>
                            </div>
                        </div>


                    </div>
                </div>

                <!-- Display question in step one by  category -->

                    <br>
                    <hr>

                    @foreach($answerlist as $answerbycat)

                        @foreach($answerbycat as $answerbytype)

                            @if($answerbytype->type === "thumbnail")
                                <input type="hidden" name="rqid[]" value={{ $answerbytype->pivot->rqid }}>

                                <div class="col-sm-6 col-md-6" style="padding-top:40px;border-spacing: 10px 50px;">
                                    <div class="selectthumbnail" style="border: 1px outset black;padding:10px;">
                                        <br>
                                        <img style="width:10%" src={{ $answerbytype->imgpath }} >
                                        <br>
                                        <h4>{{ $answerbytype->question }}</h4>
                                        <hr>
                                        <div class="caption">
                                                <textarea class="form-control"
                                                          name="answersid[{{ $answerbytype->id }}]"
                                                          rows="5">{{$answerbytype->pivot->answers}}</textarea>
                                            <hr>
                                        </div>

                                        @else

                                            <div class="form-group" style="padding:10px;">
                                                <label for="answersid[{{ $answerbytype->id }}]">{{ $answerbytype->question }}</label>
                                                @if($answerbytype->type === "tall")
                                                    <input type="hidden" name="rqid[]"
                                                           value={{ $answerbytype->pivot->rqid }}>
                                                    <textarea name="answersid[{{ $answerbytype->id }}]"
                                                              class="form-control"
                                                              rows="3">{{$answerbytype->pivot->answers}}</textarea>

                                                @elseif($answerbytype->type === "regular")
                                                    <input type="hidden" name="rqid[]"
                                                           value={{ $answerbytype->pivot->rqid }}>
                                                    <input type="text" name="answersid[{{ $answerbytype->id }}]"
                                                           class="form-control"
                                                           value="{{ $answerbytype->pivot->answers }}">
                                                @endif
                                            </div>
                                            <!-- /.form-group -->
                                        @endif
                                        @endforeach
                                    </div>
                                    <!-- /.thumbnail -->
                                </div>
                                @endforeach


                <hr>
                <div class="form-group" style="padding:3%;">
                    {!! Form:: submit('Update Report' , ['class' => 'btn btn-success form-control']) !!}
                    {!! Form::close() !!}
                </div>

            <!-- /.form-group -->
        </div>
        <!-- /.container-fluid -->
    </div>


    <script type="text/javascript">
        $(".selectthumbnail").height(Math.max.apply(null, $(".selectthumbnail").map(function () {
                    return $(this).height();
                })) + 30);
    </script>

@endsection
@stop
