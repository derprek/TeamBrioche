<div class="tab-content">
    @if(Session::has('banner_message'))
        <br>
        <div class="alert alert-success fade in">
            {{Session::get('banner_message')}}
        </div>
    @endif

    @unless(Auth::check())
    @if(Session::has('banner_message'))
        @if(Session::get('banner_message') === "Report successfully updated!")
            <div id="home" class="tab-pane fade ">
                @else
                    <div id="home" class="tab-pane fade ">
                        @endif
                        @else
                            <div id="home" class="tab-pane fade in active">
                                @endif

      @endunless                                  
      <!-- testing starts here -->

                                <div class="row">
                                    <!-- assessment panel -->
                                    <div class="col-lg-4 col-md-4">
                                        <div class="panel panel-atest">
                                            <div class="panel-heading">Assessment</div>

                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-xs-3"><i class="fa fa-pencil fa-3x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <p>Completed</p>
                                                    </div>

                                                </div>
                                            </div>

                                                <div class="panel-footer">
                                                    <span class="pull-right"><a href="{{ url('reports/assessment/view',$report->id ) }}"><strong>View</strong> <i
                                                                class="fa fa-arrow-right"></i></a></span>

                                                    <div class="clearfix"></div>
                                                </div>

                                        </div>
                                    </div>
                                    <!-- end of assessment panel -->

                                    <!-- typology panel -->
                                    <div class="col-lg-4 col-md-4">
                                        <div class="panel panel-atest">
                                            <div class="panel-heading">Typology</div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <i class="fa fa-leaf fa-3x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">

                                                        @if ($report_step > 1) <p>Completed</p>
                                                        @else <p style="color:#a94442">Incomplete</p>
                                                        @endif

                                                    </div>
                                                </div>

                                            </div>
                                            @if ($report_step > 1)

                                                <div class="panel-footer">
                                                        <span class="pull-right"><a
                                                                    href="{{ url('/reports/typology/view',$report->id) }}"><strong>View</strong>
                                                                <i class="fa fa-arrow-right"></i></a></span>
                                                    <div class="clearfix"></div>
                                                </div>

                                            @else
                                                @unless(Session::has('is_admin'))
                                                    <div class="panel-footer"><span
                                                                class="pull-left"><a
                                                                    href="{{ url('/reports/typology/new',$report->id) }}"><strong>Create</strong>
                                                                <i class="fa fa-arrow-right"></i> </a></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                @endunless
                                            @endif
                                        </div>
                                    </div>
                                    <!-- end of typology panel -->


                                    <!-- selection panel -->
                                    <div class="col-lg-4 col-md-4">
                                    <div class="panel panel-atest">
                                        <div class="panel-heading">Evaluation</div>
                                        <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-balance-scale fa-3x"></i>
                                            </div>
                                        <div class="col-xs-9 text-right">

                                            @if (isset($evaluation_count))
                                                
                                                <h4> <strong>{{$evaluation_count}}</strong> evaluation report (s).</h4>

                                            @else

                                                <p style="color:#a94442">Incomplete</p>

                                                @unless((Session::has('is_admin')) ||(Auth::check()))                         
                                                <h6 style="color:#a94442"><br> * You need to
                                                    complete a typology report
                                                    first.</h6>
                                                @endunless

                                            @endif

                                        </div>

                                         </div>
                             </div>
                                                <!-- .row -->
                                            <!-- .panel-body -->
                                        

                                            @if (isset($evaluation_count))

                                                <div class="panel-footer">

                                                @unless((Auth::check()) || (Session::has('is_admin')))
                                                    <span class="pull-left"><a
                                                            href="{{ url('/reports/evaluation/new',$report->id) }}">
                                                        <i class="fa fa-plus"></i> Create New
                                                    </a></span>
                                                @endunless
                                         
                                                <span class="pull-right"><a
                                                        href="{{ url('/reports/evaluation/overview',$report->id) }}">
                                                    <i class="fa fa-arrow-right"></i> View </a></span>
                                                <div class="clearfix"></div>
                                            

                                            @elseif($report_step === 2)

                                                <div class="panel-footer">

                                                @unless((Auth::check()) || (Session::has('is_admin')))
                                                    <span class="pull-left"><a
                                                            href="{{ url('/reports/evaluation/new',$report->id) }}">
                                                        <i class="fa fa-plus"></i> Create New
                                                    </a></span>
                                                    <div class="clearfix"></div>
                                                @endunless

                                                 </div>

                                            @endif
                                                <!-- .body -->
              
                <!-- .panel-atest-->
</div>
                @if(Auth::check())
                  
                 
                  </div>  
                  </div>
                  </div>
                 </div>
                
                @endunless