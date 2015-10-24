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
                    <h5>{{$evaluation_count}} evaluation report(s).</h5>
                </div>
            </div>
        </div>
        <!-- .body -->
        <div class="panel-footer">
                                                        <span class="pull-left"><a
                                                                href="{{ url('/reports/evaluation/new',$report->id) }}">
                                                                <i class="fa fa-plus"></i> Create New
                                                            </a></span>
                                                        <span class="pull-right"><a
                                                                href="{{ url('/reports/evaluation/overview',$report->id) }}">
                                                                <i class="fa fa-arrow-right"></i> View </a></span>

            <div class="clearfix"></div>
        </div>
    </div>
    <!-- .panel-atest -->

    @else
    @if($report_step === 2)
    <p>Incomplete</p>
</div>
<!-- .col-xs-9 -->
</div>
<!-- .row -->
</div>
<!-- .body -->

<div class="panel-footer"><span class="pull-left"><a href="{{ url('/reports/evaluation/new',$report->id) }}"><i
                class="fa fa-plus"></i> Create New</a></span>
</div>
<!-- .footer -->
</div>
<!-- .panel-atest -->

@else
<p style="color:#a94442">Incomplete</p>
<h6 style="color:#a94442"><br> * You need to
    complete a typology report
    first.</h6>

<!-- .row -->
</div>
<!-- .panel-atest -->


@endif
@endif

</div>

</div>
<!-- .body -->
</div>
<!-- .panel-atest -->

<!-- end of selection panel -->


<!-- testing ends here-->