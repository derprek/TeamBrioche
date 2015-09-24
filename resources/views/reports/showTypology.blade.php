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

                <div class="form-group" style="padding:10px;">
                    <label for="goals_typology">Goals:</label>
                     <textarea readonly name="goals_typology"
                               class="form-control" rows="5"
                               placeholder="Goals + Typology"> {{ $goals}}</textarea>
                </div>

                @foreach($answerlist as $answerbycat)

                    @foreach($answerbycat as $answerbytype)

                        @if($answerbytype->type === "thumbnail")

                            <div class="col-sm-6 col-md-6" style="padding-top:40px;border-spacing: 10px 50px;">
                                <input type="hidden" name="rqid[]" value={{ $answerbytype->pivot->rqid }}>

                                <div class="selectthumbnail" style="border: 1px outset black;padding:10px;">
                                    <br>
                                    <img style="width:20%" src={{ $answerbytype->imgpath }} >
                                    <br>
                                    <h4>{{ $answerbytype->question }}</h4>
                                    <hr>
                                    <div class="caption">
                                                <textarea class="form-control"
                                                          name="answersid[{{ $answerbytype->id }}]"
                                                          rows="3"
                                                          readonly>{{ $answerbytype->pivot->answers }}</textarea>
                                        <hr>
                                    </div>

                                    @else
                                        <div class="form-group" style="padding-top:10px;">
                                            <label for="answersid[{{ $answerbytype->id }}]">{{ $answerbytype->question }}</label>
                                            @if($answerbytype->type === "tall")
                                                <input type="hidden" name="rqid[]"
                                                       value={{ $answerbytype->pivot->rqid }}>
                                                <textarea name="answersid[{{ $answerbytype->id }}]"
                                                          class="form-control"
                                                          rows="3">{{ $answerbytype->pivot->answers }}</textarea>
                                            @elseif($answerbytype->type === "regular")
                                                <input type="hidden" name="rqid[]"
                                                       value={{ $answerbytype->pivot->rqid }}>
                                                <input type="text" name="answersid[{{ $answerbytype->id }}]"
                                                       class="form-control" value="{{ $answerbytype->pivot->answers }}">
                                            @endif
                                        </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            @endforeach

                            <div class="form-group" style="padding-right:30px;">
                                {!! Form:: submit('Update Report' , ['class' => 'btn btn-success form-control']) !!}
                                {!! Form::close() !!}
                            </div>
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
