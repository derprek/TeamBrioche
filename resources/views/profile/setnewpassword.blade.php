@include('jsreferences')
@include('cssreferences')

 <script>
    $(document).ready(function () {
       $('#updatepasswordModal').modal({
		    backdrop: 'static',
		    keyboard: false
		});
    });
</script>

@if(Session::has('invalid_user'))

<script>
    $(document).ready(function () {
       $('#updatepasswordModal').modal({
		    backdrop: 'static',
		    keyboard: false
		});
    });
</script>

                    @endif
                    

 <form role="form" class="form-horizontal col-sm-12 col-md-10 col-lg-10" method="POST"
 action="{{ url('setfirstpassword') }}">
 <input type="hidden" name="valid_email" value="{{$registered_email}}" >

@include('partials.changePasswordModal')