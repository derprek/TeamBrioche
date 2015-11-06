<div class="container">
    <!-- Create new client Modal -->
    <div class="modal fade" id="infoMessageModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                 
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{ Session::pull('info_title')}}</h4>
                </div>

                <div class="modal-body text-center">
                    
                    @if(Session::has('missing_info'))
                        {{Session::forget('missing_info')}}
                        <br>
                            <h1> <i class="fa fa-meh-o"></i> </h1>
                        <br>
                    @else
                        <br>
                            <h1> <i style="color:#26A65B;"class="fa fa-check"></i> </h1>
                        <br>
                    @endif

                    @if(Session::has('client_email'))
                        <h5> {{ Session::pull('info_message')}} </h5>
                        <strong>{{ Session::pull('client_email')}}.</strong> 
                        <br>
                    @else
                        <h5> {{ Session::pull('info_message')}} </h5>
                    @endif
                   
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