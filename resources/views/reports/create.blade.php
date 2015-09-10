@extends('practitionermaster')

@section('sidemenubar')
    <ul class="nav navbar-nav side-nav">
        <li>
            <a href="{{ url('practitioner/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
        </li>
        <li class="active">
            <a href="{{ url('practitioner/reports') }}"><i class="fa fa-bar-chart-o"></i> Report Manager</a>
        </li>
        <li>
            <a href="{{ url('practitioner/questions') }}"><i class="fa fa-pencil"></i> Question Manager</a>
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
                            <i class="fa fa-dashboard"></i> <a href="/../reports">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-pencil"></i> Create a new Report
                        </li>
                    </ol>
                </div>
            </div>
            <div class="form-group">
                <label for="client_list"> Client:</label>


                {!! Form::open(['url' => 'reports']) !!}

                <select id="client_list" name="client" class="form-control">

                    @unless($clients->isEmpty())
                        @foreach($clients as $client)

                            <option value= {{ $client-> id }}>{{ $client->fname }} {{ $client-> sname }}  </br>
                                Email: {{ $client-> email }} </option>

                        @endforeach
                    @endunless

                </select>

                <hr>

                @unless($questions->isEmpty())

                    <div class="row">

                        @foreach($answerlist as $test)

                            @foreach($test as $tester)

                                @if($tester->type === "thumbnail")

                                    <div class="col-sm-6 col-md-6" style="padding-top:40px;border-spacing: 10px 50px;">
                                        <div class="thumbnail" style="border: 1px outset black;padding:10px;">
                                            <br>
                                            <img style="width:20%" src={{ $tester->imgpath }} >
                                            <br>
                                            <h4>{{ $tester->question }}</h4>
                                            <hr>
                                            <div class="caption">
                                                <textarea class="form-control" name="answersid[{{ $tester->id }}]"
                                                          rows="3" placeholder="{{ $tester->placeholder }}"></textarea>
                                                <hr>
                                            </div>


                                            @else
                                                <div class="form-group" style="padding:10px;">
                                                    <label for="answersid[{{ $tester->id }}]">{{ $tester->question }}</label>
                                                    @if($tester->type === "tall")
                                                        <textarea name="answersid[{{ $tester->id }}]"
                                                                  class="form-control" rows="3"
                                                                  placeholder="{{ $tester->placeholder }}"></textarea>
                                                    @elseif($tester->type === "regular")
                                                        <input type="text" name="answersid[{{ $tester->id }}]"
                                                               class="form-control"
                                                               placeholder="{{ $tester->placeholder }}">
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
                        {!! Form:: submit('Submit Report' , ['class' => 'btn btn-success form-control']) !!}
                        {!! Form::close() !!}
                    </div>
            </div>
            <br>

            <script>

                $('#client_list').select2();

            </script>

@stop