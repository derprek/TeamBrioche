@extends('practitionermaster')

@section('sidemenubar')
    <ul class="nav navbar-nav side-nav">
        <li>
            <a href="{{ url('practitioner/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
        </li>
        <li>
            <a href="{{ url('practitioner/reports') }}"><i class="fa fa-bar-chart-o"></i> Report Manager</a>
        </li>
        <li class="active">
            <a href="{{ url('practitioner/questions') }}"><i class="fa fa-pencil"></i> Question Manager</a>
        </li>
        <li>
            <a href="{{ url('practitioner/clientmanager') }}"><i class="fa fa-users"></i> Client Manager</a>
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
                            <i class="fa fa-pencil"></i> Question Manager
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->


            <div class="col-lg-12">

                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#assessment"><strong>Assessment</strong></a></li>
                    <li><a data-toggle="tab" href="#typology">Typology</a></li>
                </ul>

                <div class="tab-content">
                    <div id="assessment" class="tab-pane fade in active">
                        <table class="table table-bordered table-hover table-striped">
                            @if(empty($questionStepOne))
                                <tr>
                                    <td> No Questions found.</td>
                                </tr>
                            @else
                                @foreach($questionStepOne as $question)
                                    <tr>
                                        <td> {{ $question->question}} </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                    <div id="typology" class="tab-pane">
                        <table class="table table-bordered table-hover table-striped">
                            @if(empty($questionStepTwo))
                                <tr>
                                    <td> No Questions found.</td>
                                </tr>
                            @else
                                @foreach($questionStepTwo as $question)
                                    <tr>
                                        <td> {{ $question->question}} </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>
            <hr/>

            <button type="button" class="btn btn-success form-control" data-toggle="modal" data-target="#newqn">Add
                a
                Question
            </button>
            <!-- End New Products Modal -->

        </div>
    </div>

    <div class="container">
        <!-- Modal -->
        <div class="modal fade" id="newqn" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><span style="color:#000000">New Question</span></h4>
                    </div>
                    <div class="modal-body">

                        {!! Form::open(['url' => 'practitioner/addquestion']) !!}
                        <article>
                            <div class="form-group" id="qntable">
                                <label for="newquestion"> Question</label>
                                <textarea name="newquestion" class="form-control" rows="7"
                                          placeholder="Enter a new question"></textarea>
                            </div>
                        </article>
                    </div>
                    <div class="modal-footer">
                        {!! Form:: submit('Add Question' , ['class' => 'btn btn-primary form-control']) !!}
                        <hr/>
                        <button type="button" class="btn btn-info form-control" data-dismiss="modal">Close</button>
                        {!! Form::close() !!}
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@stop

