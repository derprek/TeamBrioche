@include('jsreferences')
@include('cssreferences')

 <script>
    $(document).ready(function () {
       $('#validateNewUser').modal({
		    backdrop: 'static',
		    keyboard: false
		});
    });
</script>

 <form role="form" class="form-horizontal col-sm-12 col-md-10 col-lg-10" method="POST"
 action="{{ url('validateuser') }}">
 <input type="hidden" value="{{ Session::get('new_user_email') }}" name="registered_email">


@include('partials.validateNewUserModal')