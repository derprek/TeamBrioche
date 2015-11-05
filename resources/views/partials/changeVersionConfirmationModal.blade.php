<div class="container">
            <!-- Create new client Modal -->
            <div class="modal fade" id="changeVersionConfirmation{{ $version['id'] }}" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">

                        <div class="modal-body" style="text-align:center;">

                            <h4 > <i class="fa fa-exclamation-triangle"></i>You are currently at version: {{ $currentversion['version_number'] }}</h4>
                            
                            <br>

                            @if($currentversion['updated_at'] > $version['updated_at'])

                                <h5>Please confirm you want to rollback this assessment to a older <strong> version: {{ $version['version_number'] }}</strong></h5>

                            @else

                                <h5>Please confirm you want to update this assessment to <strong>version: {{ $version['version_number'] }} </strong></h5>

                            @endif

                            <hr><br>

                            <h6>  <strong> Current Version: {{ date('F d, Y', strtotime($currentversion['updated_at'])) }}  (Last Modified) </strong></h6>
                            <h6>  <strong> {{ date('h:ia', strtotime($currentversion['updated_at'])) }}  </strong></h6>

                            <hr style="width:70%;background-color:black;height:0.8px;">

                            <h6>   Version {{ $version['version_number'] }} : {{ date('F d, Y', strtotime($version['updated_at'])) }}  (Last Modified) </h6>
                            <h6>   {{ date('h:ia', strtotime($version['updated_at'])) }}  </h6>            
                            
                            <br><i class="fa fa-info-circle pull-right" data-toggle="popover" data-html="true" data-trigger="hover" data-placement="left" data-title="No Worries Mate" 
                                 data-content="You may revert back to the current version in future"></i>
                            <br>

                            <div class="modal-footer">

                            {!! Form::open(['url' => '/assessment/setcurrentversion']) !!}
                            <input type="hidden" name="assessment_id" value={{ $assessment->id }} >
                            <input type="hidden" name="version_id" value={{ $version['id']}} >
                            <input type="hidden" name="version_number" value={{ $version['version_number'] }} >

                            <button type="submit" class="btn btn-success pull-right" style="margin-right:8px;">
                                 <i class="fa fa-check"></i> Confirm
                            </button>

                            {!! Form::close() !!}
                                
                            <button type="submit"  class="btn btn-danger pull-left" data-dismiss="modal">
                                <i class="fa fa-times"></i> Cancel
                            </button>

                            </div>
                            <!-- /.modal-footer -->
                </div>
                <!-- /.modal-body -->
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>
<!-- /.container -->