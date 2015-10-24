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
                            <i class="fa fa-bar-chart"></i> <a href="{{ url('admin/reportmanager') }}">Report
                                Manager</a>
                        </li>

                    @else

                        <li>
                            <i class="fa fa-bar-chart"></i> <a href="{{ url('practitioner/reportmanager') }}">Report
                                Manager</a>
                        </li>

                    @endif
                        
                        <li class="active">
                            <i class="fa fa-search"></i>Report Overview
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->


            <h4>
                <span style="color:#000000">Report Overview: {{ $report->id}}</span> 
                  <a class="pull-right" data-toggle="popover" data-html="true" data-animation="true" data-placement="left" title="Report Information" 
                      data-content="Report ID: {{ $report->id }} <hr>
                      Practitioner: {{ $reportowner->fname }} {{ $reportowner->sname }} <br>
                      Practitioner email: {{ $reportowner->email }}<br><hr>
                      Client: {{ $client->fname }} {{ $client->sname}}<br>
                      Client email: {{ $client->email }}"> 

                    <small style="color:#111;font-size:0.9em;"><i  class="fa fa-info-circle"></i> Information </small>

                  </a>
            </h4>
            <br>

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
                                            <div class="col-sm-4" id="statuswindow">
                                                <div class="thumbnail" id="statusthumbnail">
                                                    <h3> Assessment</h3>
                                                    <hr>
                                                    <div class="caption">
                                                        <div class="checkbox">
                                                            <label style="font-size: 2em">
                                                                <input type="checkbox" disabled value=""
                                                                       checked="">
                                                                                <span class="cr"><i
                                                                                            class="cr-icon fa fa-check"></i></span>

                                                                <p>Completed</p>
                                                            </label>
                                                            <a href="{{ url('reports/assessment/view',$report->id ) }}">
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
                                            <div class="col-sm-4 col-md-4" id="statuswindow">
                                                <div class="thumbnail" id="statusthumbnail">

                                                    <h3> Typology</h3>
                                                    <hr>
                                                    <div class="caption">
                                                        <div class="checkbox">
                                                            <label style="font-size: 2em">
                                                                @if ($report_step > 1)
                                                                    <input type="checkbox" disabled value=""
                                                                           checked>
                                                                    <span class="cr"><i
                                                                                class="cr-icon fa fa-check"></i></span>
                                                                    <p>Completed</p>
                                                            </label>
                                                            <a href="{{ url('/reports/typology',$report->id) }}">
                                                                <button type="button" id="updatebtn"
                                                                        class="btn btn-primary form-control">
                                                                    View
                                                                </button>
                                                            </a>
                                                            @else
                                                                <input type="checkbox" disabled value="">
                                                                <span class="cr"><i
                                                                            class="cr-icon fa fa-check"></i></span>
                                                                <p>Incomplete</p>
                                                                </label>
                                                                @unless(Session::has('is_admin'))
                                                                    <a href="{{ url('/reports/typology/new',$report->id) }}">
                                                                        <button type="button" id="createbtn"
                                                                                class="btn btn-success form-control">
                                                                            Create
                                                                        </button>
                                                                    </a>
                                                                @endunless
                                                            @endif
                                                        </div>
                                                        <hr>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Evaluation tab -->
                                            <div class="col-sm-4 col-md-4" id="statuswindow">
                                                <div class="thumbnail" id="statusthumbnail">

                                                    <h3> Evaluation </h3>
                                                    <hr>
                                                    <div class="caption">
                                                        <div class="checkbox">
                                                            <label style="font-size: 2em">
                                                            @if (isset($evaluation_count))
                                                                    <input type="checkbox" disabled
                                                                           checked value="">
                                                                    <span class="cr"><i
                                                                                class="cr-icon fa fa-check"></i></span>
                                                                    <p>You have {{$evaluation_count}} Evaluation
                                                                        report(s).</p>
                                                            </label>
                                                                @unless(Session::has('is_admin'))
                                                                    <a href="{{ url('/reports/evaluation/new',$report->id) }}">
                                                                        <button type="button" id="createbtn"
                                                                                class="btn btn-success form-control">
                                                                            Create
                                                                        </button>
                                                                    </a>
                                                                @endunless
                                                            <br><br>
                                                            <a href="{{ url('/reports/evaluation/overview',$report->id) }}">
                                                                <button type="button" id="updatebtn"
                                                                        class="btn btn-primary form-control">
                                                                    View
                                                                </button>
                                                            </a>
                                                            @else
                                                                @if($report_step === 2)
                                                                    <input type="checkbox" disabled value="">
                                                                    <span class="cr"><i
                                                                                class="cr-icon fa fa-check"></i></span>
                                                                    <p>Incomplete</p>
                                                                    </label>
                                                                    @unless(Session::has('is_admin'))
                                                                        <a href="{{ url('/reports/evaluation/new',$report->id) }}">
                                                                            <button type="button" id="createbtn"
                                                                                    class="btn btn-success form-control">
                                                                                Create
                                                                            </button>
                                                                        </a>
                                                                    @endunless
                                                                @else
                                                                    <input type="checkbox" disabled value="">
                                                                        <span class="cr"><i
                                                                                    class="cr-icon fa fa-check"></i></span>
                                                                        <p>Incomplete</p>
                                                                        </label>

                                                                    @unless(Session::has('is_admin'))
                                                                        <h6 style="color:red;">*You need to complete a
                                                                            typology report first.</h6>
                                                                    @endunless
                                                                @endif
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
                                                                                    class="cr-icon fa fa-check"></i></span>
                                                                        Mark as Finished
                                                                    </label>
                                                                </div>
                                                               
                                                                
                                                                <div class="checkbox">
                                                                    <label style="font-size: 1.5em">
                                                                        @if($report->published === 1)
                                                                            <input type="checkbox"
                                                                                   name="PublishedStatus"
                                                                                   value="1"
                                                                                   checked>
                                                                        @else
                                                                            <input type="checkbox"
                                                                                   name="PublishedStatus"
                                                                                   value="1">
                                                                        @endif
                                                                        <span class="cr"><i
                                                                                    class="cr-icon fa fa-check"></i></span>
                                                                        Share this report with Client.
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

                                                                                    @if($reportowner->id === Session::get('prac_id'))
                                                                                         <div class="form-group" style="padding:20px;">
                                                                                           
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
                                                                                                

                                                                                                <div class="form-group">
                                                                                                   

                                                                                                        {!! Form::open(['url' => 'reports/shareReport']) !!}
                                                                                                        <div class="col-sm-6 col-md-8 colg-lg-8"
                                                                                                             >
                                                                                                            <label for="prac_list">
                                                                                                                Practitioners:</label>
                                                                                                            <br>

                                                                                                            {!! Form::select('prac_list[]', $shareable_practitioners, null, ['id' => 'prac_list', 'style' => 'width:70%', 'multiple','required']) !!}
                                                                                                            <br><br>

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

                                                                                                        <div class="col-sm-6 col-md-4 col-lg-4"
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

                                                                                                                @if(empty($shared_practitioners))
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

                                                                                                                    @foreach($shared_practitioners as $practitioner)

                                                                                                                        {!! Form::open(['url' => 'reports/removeSharer']) !!}
                                                                                                                        <input type="hidden"
                                                                                                                               name="report_id"
                                                                                                                               value={{$report->id}}>
                                                                                                                        <input type="hidden"
                                                                                                                               name="prac_id"
                                                                                                                               value={{$practitioner->id}}>
                                                                                                                        <tr>
                                                                                                                            <td> {{ $practitioner->email}}</td>
                                                                                                                            <td>
                                                                                                                                <button type="submit"
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
                                                                            </form>

                                                                    </div>
                                                        </div>

                                                        <!-- /.container -->


                                                        <script>
                                                            $('.status').selectpicker();
                                                            $('#prac_list').select2();
                                                            $('div.alert').delay(3000).slideUp(300);

                                                            $(".thumbnail").height(Math.max.apply(null, $(".thumbnail").map(function () {
                                                                return $(this).height();
                                                            })));
                                                            
                                                            $(function () {
                                                              $('[data-toggle="popover"]').popover()
                                                            })
                                                        </script>


@endsection


@stop