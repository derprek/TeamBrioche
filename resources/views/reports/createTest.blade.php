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
                            <i class="fa fa-pencil"></i> Create a new Report
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="form-group">
                <label for="client_list"> Client:</label>

                {!! Form::open(['url' => 'reports']) !!}
                <select id="client_list" name="client" class="form-control">

                    @unless($clients->isEmpty())
                        @foreach($clients as $client)

                            <option value= {{ $client-> id }}>{{ $client->fname }} {{ $client-> sname }} </br>
                                Email: {{ $client-> email }} </option>

                        @endforeach
                    @endunless

                </select>

                <hr>

                @unless(empty($categories))
                 <div class="form-group">
                <ul class="nav nav-tabs">

                @foreach($categories as $category)

                    @if($category->id === 1)

                      <li class="active"><a data-toggle="tab" href="#{{$category->id}}"> <small> {{$category->name}} </small></a></li>
                   
                    @else

                      <li><a data-toggle="tab" href="#{{$category->id}}"> <small> {{$category->name}} </small></a></li>    

                    @endif

                @endforeach
                </ul>
                </div>
                @endunless

                <div class="tab-content">

                @foreach($questionslist as $questionbycat)

                    @if ($questionbycat === reset($questionslist))  <div id="{{$questionbycat[0]->category_id}}" class="tab-pane fade in active">
                    @else <div id="{{$questionbycat[0]->category_id}}" class="tab-pane fade"> @endif

                @foreach($questionbycat as $questionbytype)

                     @if($questionbytype->type === "thumbnail")

                        <textarea class="form-control"
                          name="answersid[{{ $questionbytype->id }}]"
                          rows="3"
                          placeholder="{{ $questionbytype->placeholder }}"></textarea>

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
                @endforeach
                </div>

                    <hr>
                    <div class="form-group" style="padding:3%;">
                        {!! Form:: submit('Create Assessment' , ['class' => 'btn btn-success form-control']) !!}
                        {!! Form::close() !!}
                    </div>
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

    <script>

        $('#client_list').select2();    
       $(".selectthumbnail").height(Math.max.apply(null, $(".selectthumbnail").map(function() { return $(this).height(); })) +30);
    
    </script>
@endsection

@stop