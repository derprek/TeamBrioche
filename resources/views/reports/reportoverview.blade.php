@extends('master.practitioner')

@section('sidemenubar')

    @include('partials.sidebar_reports')

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
                        @if((Session::has('is_admin')) && (Session::has('is_admin')))

                            <li>
                                <a href="{{ url('admin/reportmanager') }}"><i class="fa fa-bar-chart"></i>Report
                                    Manager</a>
                            </li>

                        @elseif(Session::has('is_admin'))

                            <li>
                                <a href="{{ url('practitioner/reportmanager') }}"><i class="fa fa-bar-chart"></i> Report
                                    Manager</a>
                            </li>

                        @elseif(Auth::check())

                            <li>
                               <a href="{{ url('/client/reportarchives') }}"><i class="fa fa-bar-chart-o"></i> View all reports</a>
                          </li>

                        @endif

                        <li class="active">
                            <i class="fa fa-search"></i>Report Overview
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

             <a class="pull-right" data-toggle="popover" data-html="true" data-animation="true" data-placement="left"
                    data-trigger="hover" title="Report Information"
                   data-content="Report ID: {{ $report->id }} <hr>
                      Practitioner: {{ $reportowner->fname }} {{ $reportowner->sname }} <br>
                      Practitioner email: {{ $reportowner->email }}<br><hr>
                      Client: {{ $client->fname }} {{ $client->sname}}<br>
                      Client email: {{ $client->email }}">

                 <small style="color:#111;font-size:0.9em;"><i class="fa fa-info-circle"></i> Report Information</small>
                      
            </a>

            @unless(($can_view_client === false) || (Auth::check()))
                  <a class="pull-right" style="margin-right:2%;"href="/practitioner/viewclient/ {{ $client->id}}">
                  <i class="fa fa-user"></i> <small> View {{ $client->fname }} {{ $client->sname }}'s profile </small>
                  </a>
            @endunless    
        
            <br>

            <h4>
                <span style="color:#000000">Report Overview: {{ $report->id}}</span>
            </h4>
            <br>

            @unless(Auth::check())
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

        @endunless

    @include('partials.show_overview')

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
                                <label font-size=1.5em for="prac_notes">Practitioner's Notes: </label>
                                <textarea name="prac_notes" class="form-control" rows="7">{{ $report->prac_notes }}</textarea>
                            </div>
                            <hr/>

                            @if($reportowner->id === Session::get('prac_id'))
                                <div class="checkbox">
                                    <label style="font-size: 1.2em">
                                        @if($report->status === "Finished")
                                            <input type="checkbox" name="ReportStatus" value="Finished" checked>
                                        @else
                                            <input type="checkbox" name="ReportStatus" value="Finished">
                                        @endif
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>Mark as Finished
                                    </label>
                                </div>


                                <div class="checkbox">
                                    <label style="font-size: 1.2em">
                                        @if($report->published === 1)
                                            <input type="checkbox" name="PublishedStatus" value="1" checked>
                                        @else
                                            <input type="checkbox" name="PublishedStatus" value="1">
                                        @endif
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>Share this report with Client.
                                    </label>
                                </div>
                            @endif
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
                                                    <div class="form-group"
                                                         style="padding:10px;">
                                                        <h3>
                                                            Sharing</h3>
                                                        <p>
                                                            Who shall we share this report with?</p>

                                                        <div class="form-group">
                                                            {!! Form::open(['url' => 'reports/shareReport']) !!}
                                                            <div class="col-sm-6 col-md-8 colg-lg-8"
                                                                    >
                                                                <label for="prac_list">
                                                                    Practitioners:</label>
                                                                <br>
                                                                {!! Form::select('prac_list[]', $shareable_practitioners, null, ['id' => 'prac_list', 'style' => 'width:70%', 'multiple','required']) !!}
                                                                <br><br>

                                                                <input type="hidden" name="reportid" value={{$report->id}}>
                                                                <button type="submit" class="btn btn-primary">Share now</button>
                                                            </div>
                                                            {!! Form::close() !!}

                                                            <div class="col-sm-6 col-md-4 col-lg-4"
                                                                 style="border-spacing: 10px 50px;">
                                                                <h6>
                                                                    You are currently sharing this report with: </h6>
                                                                <table class="table table-striped">
                                                                    @if(($shared_practitioners->isEmpty()))
                                                                        <tr>
                                                                            <strong> Nobody </strong>
                                                                        </tr>
                                                                    @else
                                                                        <tr>
                                                                            <th>Name</th>
                                                                            <th>Remove</th>
                                                                        </tr>

                                                                        @foreach($shared_practitioners as $practitioner)
                                                                            {!! Form::open(['url' => 'reports/removeSharer']) !!}
                                                                            <input type="hidden" name="report_id" value={{$report->id}}>
                                                                            <input type="hidden" name="prac_id" value={{$practitioner->id}}>
                                                                            <tr>
                                                                                <td> {{ $practitioner->email}}</td>
                                                                                <td><button type="submit" class="btn btn-warning btn-xs">Remove</button>
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
                                                    <div class="col-sm-6 col-md-12 col-lg-12 emptymsg_container" >
                                                        <br>
                                                        <h3> <i class="fa fa-lock"></i>  Only the owner can share this report! </h3>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        </form>


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