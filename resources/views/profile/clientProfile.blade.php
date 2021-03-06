@extends('master.client')

@section('sidemenubar')

    @include('partials.sidebar_home')

@endsection

@section('content')

@if(Session::has('password_error') || (count($errors) > 0))

    <script>
        $(document).ready(function () {
            $("#updatepasswordModal").modal('show');
        });
    </script>

@endif

<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                &nbsp;
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-users"></i> My Profile
                </li>
            </ol>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="row">

            <form role="form" class="form-horizontal col-sm-12 col-md-10 col-lg-10" method="POST"
                  action="{{ url('updateprofile') }}">

                <div class="form-group">

                    @if (Session::has('client_updateerror'))
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.
                            <br><br>
                            <ul>
                                <li>The email has already been taken.</li>
                            </ul>
                        </div>
                    @endif
                    <br>

                    <div class="form-group">
                        <label for="FirstName" class="col-sm-2 control-label">First Name</label>

                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="fname" value="{{ $client->fname }}"
                                   required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Family Name" class="col-sm-2 control-label">Last Name</label>

                        <div class="col-sm-4">
                            <input type="text" name="sname" class="form-control" value="{{ $client->sname }}"
                                   required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Email" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-4">
                            <input type="email" name="email" class="form-control" value="{{ $client->email }}"
                                   required>
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary "> Update</button>
                        </div>
            </form>
            
        </div>

        <hr style="border-top: solid 3px;">
        <div class="form-group">
            <label for="Password" class="col-sm-2 control-label">Password</label>

            <div class="col-sm-4">
                <button type="button" data-toggle="modal" data-target="#updatepasswordModal"
                        class="btn btn-default ">Change Password
                </button>
            </div>
            <form role="form" class="form-horizontal col-sm-12 col-md-10 col-lg-10" method="POST"
                  action="{{ url('updatepassword') }}">
             @include('partials.changePasswordModal')
        </div>

    </div>
    </form>
</div>
</div>

</div>

    <!-- -->
@endsection
@stop






