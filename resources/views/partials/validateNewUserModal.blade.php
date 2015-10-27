 <div class="container">
    <!-- Create new client Modal -->
    <div class="modal fade" id="validateNewUser" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-body">

                    @if(Session::has('invalid_user'))

                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                 @if(Session::has('invalid_user'))

                                    <li> {{ Session::pull('invalid_user') }}</li>

                                 @endif
                               
                            </ul>
                        </div>
                        <br>

                    @endif

                                <!-- deletion form -->
                            <h4 style="text-align:center;"> <i class="fa fa-lock"></i> Enter your email to confirm your identity</h4>
                            <br><br>
                            
                            <input required type="email" name="email" class="form-control" maxlength="50"
                                   value="" placeholder="Enter your registered email" autofocus>

                            <br>

                            <div class="modal-footer">

                                <a href="/../"class="btn btn-primary pull-left">
                                   <i class="fa fa-home"></i> Back to home page
                                </a>

                                <button type="submit" class="btn btn-success pull-right">
                                    <i class="fa fa-check"></i>Validate me
                                </button>

                               

                            </div>
                            <!-- /.modal-footer -->
                        </form>
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

<script>    

function checkEmpty() {

    if (document.getElementById("current_password")) 
    {
        var current_password = $("#current_password").val();
    } 
    else 
    {
        var current_password = 8;
    }

    var new_password = $("#new_password").val();
    var confirm_password = $("#confirm_password").val();

    if(jQuery.trim(current_password).length > 0 && jQuery.trim(new_password).length > 0 && jQuery.trim(confirm_password).length > 0)
    {
        $("#reminder").hide();
    }
    else
    {
         $("#reminder").show();
    }

    if(jQuery.trim(new_password).length > 7 && jQuery.trim(confirm_password).length > 7)
    {
       document.getElementById("submitBtn").disabled = false;
       $("#password_reminder").hide();
    }
    else
    {
       document.getElementById("submitBtn").disabled = true;
       $("#password_reminder").show();
    }



}

</script>
