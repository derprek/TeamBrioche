<div class="container">
            <!-- Create new client Modal -->
            <div class="modal fade" id="versionConfirmation" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">

                        <div class="modal-body">

                                    <h4 style="text-align:center;"> <i class="fa fa-exclamation-triangle"></i>You are trying to modify version: {{Session::pull('version_number')}}

                                    </h4>
                                    <br>
                                    <small>Do you wish to overwrite this version or create a new version?</small>
                                    <br><br>

                                    <div class="modal-footer">

                                         <a href="{{ url('assessment/newversion') }}" class="btn btn-success pull-right" style="margin-right:8px;">
                                         <i class="fa fa-file"></i> New Version</a>

                                         <a href="{{ url('assessment/update') }}" class="btn btn-info pull-right" style="margin-right:8px;">
                                         <i class="fa fa-pencil-square-o"></i> Overwrite</a>

                                        <button type="submit"  class="btn btn-danger pull-left"
                                                data-dismiss="modal">
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