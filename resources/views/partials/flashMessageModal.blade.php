<div class="container">
            <!-- Create new client Modal -->
            <div class="modal fade" id="flashMessageModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">

                        <div class="modal-body" style="text-align:center;">

                            <h3>Success</h3>
                            
                            <br>
                                <h1> <i style="color:#26A65B;"class="fa fa-check"></i> </h1>
                            <br>

                            <h5> {{ Session::pull('flash_message') }} </h5>
                           
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