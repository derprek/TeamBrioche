 <div class="container">
    <!-- Create new client Modal -->
    <div class="modal fade" id="updatepasswordModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-body">

                    @if(Session::has('password_error'))

                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                 @if(Session::has('password_error'))

                                    <li> {{ Session::pull('password_error') }}</li>

                                 @endif
                            </ul>
                        </div>
                        <br>

                    @endif

                                <!-- deletion form -->
                            <h4 style="text-align:center;"> <i class="fa fa-lock"></i> Change Password</h4>
                            <br>
                            <h6 id="reminder" style="color:red;">* Please fill up all the fields.</h6>
                            

                            @if($is_verified === true)

                            <br>
                
                            <div class="input-group">
                              <span class="input-group-addon" style="padding-right:17px;">Current Password</span>
                              <input required type="password" class="form-control" id="current_password" maxlength="50"
                                onkeyup="checkEmpty()" name="current_password" placeholder="Enter your current password" >
                            </div> 

                            <hr>

                            @endif

                             <h6 id="password_reminder" style="margin-bottom:5px;">* Passwords must have a minumum length of 7 characters.</h6>

                            <div class="input-group">
                              <span class="input-group-addon" style="padding-right:39px;">New Password</span>
                              <input required type="password" class="form-control" id="new_password" maxlength="50"
                                onkeyup="checkEmpty()" name="new_password" placeholder="Enter a new password" >
                            </div> 

                            <br>

                            <div class="input-group">
                              <span class="input-group-addon" >Confirm Password</span>
                              <input required type="password" class="form-control" id="confirm_password" maxlength="50"
                                onkeyup="checkEmpty()" name="confirm_password" placeholder="Confirm your new password">
                            </div> 
                            <br>

                            <div class="modal-footer">
                                <button type="submit" disabled id="submitBtn" class="btn btn-success pull-right">
                                    <i class="fa fa-pencil-square-o"></i></i>Update Password
                                </button>

                                @if((Auth::guest()) && (!Session::has('prac_id')))

                                <a href="/../"class="btn btn-primary pull-left">
                                   <i class="fa fa-home"></i> Back to home page
                                </a>

                                @endif

                                @unless((Auth::guest()) && (!Session::has('prac_id')))

                                <button class="btn btn-danger pull-left"
                                        data-dismiss="modal">
                                    <i class="fa fa-times"></i> Cancel
                                </button>

                                @endunless

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

@if((Session::has('password_error')) && (Session::get('password_error') === 'Your passwords do not match'))

    <script>
        $("#new_password").addClass('txtboxError');
        $("#confirm_password").addClass('txtboxError');
    </script>

@else

    <script>
        $("#new_password").removeClass('txtboxError');
        $("#confirm_password").removeClass('txtboxError');
    </script>

@endif

@if((Session::has('password_error')) && (Session::get('password_error') === 'Your current password is incorrect'))

    <script>
        $("#current_password").addClass('txtboxError');
    </script>

@else

    <script>
        $("#current_password").removeClass('txtboxError');
    </script>

@endif