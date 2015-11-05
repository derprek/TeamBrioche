<div class="container">
    <!-- Create new client Modal -->
    <div class="modal fade" id="errorMessageModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        
                    @if(Session::has('error_title'))
                        <h4 class="modal-title">{{ Session::pull('error_title')}}</h4>
                    @else
                        <h4 class="modal-title">Ooops look like there was an issue</h4>
                    @endif

                  </div>

                <div class="modal-body" style="text-align:center;">

                    <br>
                        <h1> <i style="color:#26A65B;"class="fa fa-check"></i> </h1>
                    <br>

                    <h5> {{ Session::pull('error_message')}} </h5>
                   
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