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

    <div class="container">
        <!-- Modal -->
        <div class="modal fade" role="dialog" id="reportoverview">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><span style="color:#000000">Report Overview: {{ $report_id}}</span></h4>
                    </div>

                    <div class="modal-body">
                        <ul class="nav nav-tabs">
                            @if(Session::has('banner_message'))
                                @if(Session::get('banner_message') === "Report successfully updated!")

                                    <li><a data-toggle="tab" href="#home">Report</a></li>
                                    <li class="active"><a data-toggle="tab" href="#menu1">Other Information</a></li>
                                    <li><a data-toggle="tab" href="#menu2">Sharing</a></li>
                                @else
                                    <li><a data-toggle="tab" href="#home">Report</a></li>
                                    <li><a data-toggle="tab" href="#menu1">Other Information</a></li>
                                    <li class="active"><a data-toggle="tab" href="#menu2">Sharing</a></li>
                                @endif

                            @else

                                <li class="active"><a data-toggle="tab" href="#home">Report</a></li>
                                <li><a data-toggle="tab" href="#menu1">Other Information</a></li>
                                <li><a data-toggle="tab" href="#menu2">Sharing</a></li>

                            @endif
                        </ul>

                        <div class="tab-content">
                            @if(Session::has('banner_message'))
                                <br>
                                <div class="alert alert-success fade in">
                                    {{Session::get('banner_message')}}
                                </div>
                            @endif
                            @if(Session::has('banner_message'))
                                @if(Session::get('banner_message') === "Report successfully updated!")
                                    <div id="home" class="tab-pane fade ">
                                        @else
                                            <div id="home" class="tab-pane fade ">
                                                @endif
                                                @else
                                                    <div id="home" class="tab-pane fade in active">
                                                        @endif
                                                                <!-- Assessment tab -->
                                                        <div class="col-sm-4 col-md-4"
                                                             style="padding-top:40px;border-spacing: 10px 50px;">
                                                            <div class="thumbnail"
                                                                 style="border: 1px outset black;padding:10px;">
                                                                <br>

                                                                <h3> Assessment</h3>
                                                                <hr>
                                                                <div class="caption">
                                                                    <div class="checkbox">
                                                                        <label style="font-size: 2em">
                                                                            <input type="checkbox" disabled value=""
                                                                                   checked="">
                                                                                <span class="cr"><i
                                                                                            class="cr-icon fa fa-check"></i></span>
                                                                            Completed
                                                                        </label>
                                                                        <a href="{{ url('/reports/stepone',$report_id) }}">
                                                                            <button type="button" id="updatebtn"
                                                                                    class="btn btn-primary form-control">
                                                                                View
                                                                            </button>
                                                                        </a>
                                                                    </div>
                                                                    <hr>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Typology tab -->
                                                        <div class="col-sm-4 col-md-4"
                                                             style="padding-top:40px;border-spacing: 10px 50px;">
                                                            <div class="thumbnail"
                                                                 style="border: 1px outset black;padding:10px;">
                                                                <br>

                                                                <h3> Typology</h3>
                                                                <hr>
                                                                <div class="caption">
                                                                    <div class="checkbox">
                                                                        <label style="font-size: 2em">
                                                                            @if ($reportstepcount->contains(2))
                                                                                <input type="checkbox" disabled value=""
                                                                                       checked>
                                                                                <span class="cr"><i
                                                                                            class="cr-icon fa fa-check"></i></span>
                                                                                Completed
                                                                        </label>
                                                                        <a href="#">
                                                                            <button type="button" id="updatebtn"
                                                                                    class="btn btn-primary form-control">
                                                                                View
                                                                            </button>
                                                                        </a>
                                                                        @else
                                                                            <input type="checkbox" disabled value="">
                                                                            <span class="cr"><i
                                                                                        class="cr-icon fa fa-check"></i></span>
                                                                            Incomplete
                                                                            </label>
                                                                            <a href="{{ url('/reports/createsteptwo',$report_id) }}">
                                                                                <button type="button" id="createbtn"
                                                                                        class="btn btn-success form-control">
                                                                                    Create
                                                                                </button>
                                                                            </a>
                                                                        @endif
                                                                    </div>
                                                                    <hr>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Selection tab -->
                                                        <div class="col-sm-4 col-md-4"
                                                             style="padding-top:40px;border-spacing: 10px 50px;">
                                                            <div class="thumbnail"
                                                                 style="border: 1px outset black;padding:10px;">
                                                                <br>

                                                                <h3> Selection </h3>
                                                                <hr>
                                                                <div class="caption">
                                                                    <div class="checkbox">
                                                                        <label style="font-size: 2em">
                                                                            @if ($reportstepcount->contains(3))
                                                                                <input type="checkbox" disabled
                                                                                       value="">
                                                                                <span class="cr"><i
                                                                                            class="cr-icon fa fa-check"></i></span>
                                                                                Completed
                                                                        </label>
                                                                        <button type="button" id="updatebtn"
                                                                                class="btn btn-primary form-control">
                                                                            View
                                                                        </button>
                                                                        @else
                                                                            <input type="checkbox" disabled value="">
                                                                            <span class="cr"><i
                                                                                        class="cr-icon fa fa-check"></i></span>
                                                                            Incomplete
                                                                            </label>
                                                                            <button type="button" id="createbtn"
                                                                                    class="btn btn-success form-control">
                                                                                Create
                                                                            </button>
                                                                        @endif
                                                                    </div>
                                                                    <hr>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @if(Session::has('banner_message'))
                                                        @if(Session::get('banner_message') === "Report successfully updated!")
                                                            <div id="menu1" class="tab-pane fade in active">
                                                                @else
                                                                    <div id="menu1" class="tab-pane fade">
                                                                        @endif
                                                                        @else
                                                                                <!-- practitioner notes tab -->
                                                                        <div id="menu1" class="tab-pane fade">
                                                                            @endif
                                                                            {!! Form::open(['url' => 'reports/overview/update']) !!}
                                                                            <div class="form-group">
                                                                                <br>
                                                                                <input type="hidden" name="reportid"
                                                                                       value={{$report->id}}>
                                                                                <label for="prac_notes">Practitioner's
                                                                                    Notes: </label>
                                                                                    <textarea name="prac_notes"
                                                                                              class="form-control"
                                                                                              rows="7">{{ $report->prac_notes }}</textarea>
                                                                            </div>
                                                                            <hr/>

                                                                            <div class="checkbox">
                                                                                <label style="font-size: 1.5em">
                                                                                    @if($report->status === "Finished")
                                                                                        <input type="checkbox"
                                                                                               name="ReportStatus"
                                                                                               value="Finished"
                                                                                               checked>
                                                                                    @else
                                                                                        <input type="checkbox"
                                                                                               name="ReportStatus"
                                                                                               value="Finished">
                                                                                    @endif
                                                                                    <span class="cr"><i
                                                                                                class="cr-icon fa fa-check"></i></span>Finished
                                                                                </label>
                                                                            </div>

                                                                            <hr/>
                                                                            {!! Form:: submit('Update Report' , ['class' => 'btn btn-primary form-control']) !!}
                                                                            {!! Form::close() !!}
                                                                        </div>

                                                                        @if(Session::has('banner_message'))
                                                                            @if(Session::get('banner_message') === "Report successfully updated!")
                                                                                <div id="menu2"
                                                                                     class="tab-pane fade">
                                                                                    @else
                                                                                        <div id="menu2"
                                                                                             class="tab-pane fade in active">
                                                                                            @endif
                                                                                            @else
                                                                                                    <!-- sharing tab -->
                                                                                            <div id="menu2"
                                                                                                 class="tab-pane fade">
                                                                                                @endif

                                                                                                @if($reportowner === $reportviewer)
                                                                                                    <div class="jumbotron">
                                                                                                        <div class="container">
                                                                                                            <h3>
                                                                                                                Sharing</h3>

                                                                                                            <p>
                                                                                                                Who
                                                                                                                shall
                                                                                                                we
                                                                                                                share
                                                                                                                this
                                                                                                                report
                                                                                                                with?</p>
                                                                                                            <hr>

                                                                                                            <div class="form-group">
                                                                                                                <div class="row">

                                                                                                                    {!! Form::open(['url' => 'reports/shareReport']) !!}
                                                                                                                    <div class="col-sm-6 col-md-8"
                                                                                                                         style="border-spacing: 10px 50px;">
                                                                                                                        <label for="prac_list">
                                                                                                                            Practitioners:</label>
                                                                                                                        <br>
                                                                                                                        {!! Form::select('prac_list[]', $pracslist, null, ['id' => 'prac_list', 'style' => 'width:70%', 'multiple','required']) !!}
                                                                                                                        <hr>
                                                                                                                        <input type="hidden"
                                                                                                                               name="reportid"
                                                                                                                               value={{$report->id}}>
                                                                                                                        <button type="submit"
                                                                                                                                class="btn btn-primary">
                                                                                                                            Share
                                                                                                                            now
                                                                                                                        </button>
                                                                                                                    </div>
                                                                                                                    {!! Form::close() !!}

                                                                                                                    <div class="col-sm-6 col-md-4"
                                                                                                                         style="border-spacing: 10px 50px;">
                                                                                                                        <h6>
                                                                                                                            You
                                                                                                                            are
                                                                                                                            currently
                                                                                                                            sharing
                                                                                                                            this
                                                                                                                            report
                                                                                                                            with: </h6>
                                                                                                                        <table class="table table-striped">

                                                                                                                            @if(empty($sharerslist))
                                                                                                                                <tr>
                                                                                                                                    Nobody
                                                                                                                                    :)
                                                                                                                                </tr>
                                                                                                                            @else

                                                                                                                                <tr>
                                                                                                                                    <th>
                                                                                                                                        Name
                                                                                                                                    </th>
                                                                                                                                    <th>
                                                                                                                                        Remove
                                                                                                                                    </th>

                                                                                                                                </tr>

                                                                                                                                @foreach($sharerslist as $pracinfo)

                                                                                                                                    {!! Form::open(['url' => 'reports/removeSharer']) !!}
                                                                                                                                    <input type="hidden"
                                                                                                                                           name="reportid"
                                                                                                                                           value={{$report->id}}>
                                                                                                                                    <input type="hidden"
                                                                                                                                           name="prid"
                                                                                                                                           value={{$pracinfo->pivot->prid}}>
                                                                                                                                    <tr>
                                                                                                                                        <td> {{ $pracinfo->name}}</td>
                                                                                                                                        <td>
                                                                                                                                            <button type="submist"
                                                                                                                                                    class="btn btn-warning btn-xs">
                                                                                                                                                Remove
                                                                                                                                            </button>
                                                                                                                                        </td>
                                                                                                                                    </tr>
                                                                                                                                    {!! Form::close() !!}

                                                                                                                                @endforeach

                                                                                                                            @endif

                                                                                                                        </table>
                                                                                                                    </div>

                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @else
                                                                                                    <div class="col-sm-6 col-md-12"
                                                                                                         style="border-spacing: 10px 50px;">
                                                                                                        <br>
                                                                                                        <h4>Only
                                                                                                            the
                                                                                                            owner
                                                                                                            can
                                                                                                            share
                                                                                                            this
                                                                                                            report! </h4>
                                                                                                    </div>
                                                                                                @endif

                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="modal-footer">
                                                                                            <hr/>
                                                                                            <a href="{{ url('practitioner/reportmanager') }}">
                                                                                                <button type="button"
                                                                                                        class="btn btn-danger form-control">
                                                                                                    Back
                                                                                                </button>
                                                                                            </a>
                                                                                        </div>
                                                                                </div>
                                                                                </form>
                                                                    </div>
                                                            </div>
                                            </div>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->


    <script>
        $(document).ready(function () {
            $("#reportoverview").modal('show');
        });

        $('#reportoverview').modal({
            backdrop: 'static',
            keyboard: true
        })
        $('.status').selectpicker();
        $('#prac_list').select2();
        $('div.alert').delay(3000).slideUp(300);
    </script>

@endsection
@stop