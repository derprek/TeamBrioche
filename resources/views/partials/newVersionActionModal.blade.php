<div class="container">
<!-- Create new client Modal -->
<div class="modal fade" id="versionConfirmation" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">

                <h4 style="text-align:center;"> <i class="fa fa-exclamation-triangle"></i>You are currently at version: {{Session::get('current_version_number')}}</h4>
                
                <br><br>
                 @if(Session::has('is_owner'))
                     <h6 style="text-align:center;"><strong>You are the owner of this version<strong></h6>
                     <br>
                     <h6 style="text-align:center;">Do you wish to <strong>overwrite</strong> this version or <strong>create</strong> a new version?</h6>
                 @else
                     <h6 style="text-align:center;">Please confirm you want to <strong>create</strong> a new version?</h6>
                 @endif
               
                <br><br><br>

                <div class="modal-footer">

                    <a href="{{ url('assessment/newversion') }}" class="btn btn-success pull-right" style="margin-right:8px;">
                    <i class="fa fa-file"></i> New Version</a>

                    @if(Session::has('is_owner'))
                      {!! Form::open(['url' => 'assessment/update']) !!}
                        <input type="hidden" name="version_number" value= {{ Session::pull('current_version_number') }}>
                      
                        <button type="submit" class="btn btn-info pull-right" style="margin-right:8px;">
                        <i class="fa fa-pencil-square-o"></i> Overwrite</button>
                      {!! Form::close() !!}
                    @else
                        {{ Session::forget('current_version_number') }}
                    @endif

                    <button type="button"  class="btn btn-danger pull-left" data-dismiss="modal">
                        <i class="fa fa-times"></i> Discard changes
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