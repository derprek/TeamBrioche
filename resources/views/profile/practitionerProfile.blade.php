@extends('practitionermaster')

@section('sidemenubar')

    @if(Session::has('is_admin'))

        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="active">
                    <a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a>
                </li>
                <li>
                    <a href="{{ url('admin/personnelmanager') }}"><i class="fa fa-users"></i> Personnel Manager</a>
                </li>
                <li>
                    <a href="{{ url('admin/reportmanager') }}"><i class="fa fa-bar-chart-o"></i> Report Manager</a>
                </li>
                <li>
                    <a href="{{ url('admin/questionmanager') }}"><i class="fa fa-pencil"></i> Question Manager</a>
                </li>
            </ul>
        </div>

    @else

        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="active">
                    <a href="{{ url('practitioner/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a>
                </li>
                <li>
                    <a href="{{ url('practitioner/clientmanager') }}"><i class="fa fa-users"></i> Client Manager</a>
                </li>
                <li>
                    <a href="{{ url('practitioner/reportmanager') }}"><i class="fa fa-bar-chart-o"></i> Report
                        Manager</a>
                </li>
            </ul>
        </div>

    @endif

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

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    &nbsp;
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-user"></i> My Profile
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->


        <div class="row col-lg-12">
            @if (Session::has('practitioner_updateerror'))
                {{Session::forget('practitioner_updateerror')}}
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        <li>The email has already been taken.</li>
                    </ul>
                </div>
            @endif

            <br>

            <form role="form" class="form-horizontal col-sm-12 col-md-10 col-lg-10" method="POST"
                  action="{{ url('updateprofile') }}">

                <div class="form-group">
                    <label for="FirstName" class="col-sm-2 control-label">First Name</label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="fname" value="{{ $practitioner->fname }}"
                               required>
                    </div>
                </div>


                <div class="form-group">
                    <label for="Family Name" class="col-sm-2 control-label">Last Name</label>

                    <div class="col-sm-4">
                        <input type="text" name="sname" class="form-control" value="{{ $practitioner->sname }}"
                               required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="Email" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-4">
                        <input type="email" name="email" class="form-control" value="{{ $practitioner->email }}"
                               required>
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary "> Update</button>
                    </div>
                </div>
            </form>

        </div>

        <hr class="col-lg-12" style="border-top: solid 3px;">

        <div class="row col-lg-12">
            <form role="form" class="form-horizontal col-sm-12 col-md-10 col-lg-10" method="POST"
                  action="{{ url('updatepassword') }}">
                <div class="form-group">
                    <label for="Password" class="col-sm-2 control-label">Password</label>

                    <div class="col-sm-4">
                        <button type="button" data-toggle="modal" data-target="#updatepasswordModal"
                                class="btn btn-default ">Change Password
                        </button>
                    </div>

                    @include('partials.changePasswordModal')
                </div>
            </form>
        </div>


    </div>
    <!-- /.home -->


    <!-- /.reports -->


    <!-- /.container-fluid -->

@endsection
@stop






