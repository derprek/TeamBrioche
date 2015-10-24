@extends('patientmaster')

@section('sidemenubar')

      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li class="active">
                <a href="{{ url('home') }}"><i class="fa fa-home"></i> Dashboard</a>
            </li>
            <li>
                <a href="{{ url('client/reportarchives') }}"><i class="fa fa-bar-chart-o"></i> Reports</a>
            </li>
        </ul>
    </div>

@endsection

@section('content')

@if(Session::has('password_error') || (count($errors) > 0))

    <script>
        $(document).ready(function () {
            $("#updatepasswordModal").modal('show');
        });
    </script>

@endif
           
    <div >
        <div class="container-fluid">

        <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        &nbsp;
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-users"></i> My Profile
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

             <div class="col-lg-12">

                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Personal Information</a></li>
                    <li><a data-toggle="tab" href="#reports">Reports</a></li>
                </ul>

            <div class="tab-content">
                  
                <div id="home" class="tab-pane fade in active col-sm-10 col-md-10 col-lg-12">

                    <form role="form" method="POST" action="{{ url('updatepassword') }}">
                        
                    <div class="form-group"> 

                        @if (Session::has('practitioner_updateerror'))
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>                                     
                                        <li>The email has already been taken.</li>
                                </ul>
                            </div>
                        @endif

                        <br>
                        <input type="hidden" name="id" class="form-control" value="{{ $client->id }}" required> 
                        <label>First Name:<input type="text" name="fname" class="form-control" value="{{ $client->fname }}" required>   </label>
                        <br>

                        <label>Family Name:<input type="text" name="sname" class="form-control" value="{{ $client->sname }}" required> </label>
                        <br>

                        <label> Registered Email Address: <input type="email" name="email" value="{{ $client->email }}" class="form-control" required> </label>
                        <br><br>

                        <input type="submit" value="Update" class="btn btn-primary btn-sm ">
                        </form>

                        <button type="button" data-toggle="modal" data-target="#updatepasswordModal" class="btn btn-info btn-sm ">Change Password</button>

                         <form role="form" method="POST" action="{{ url('/updatepassword') }}">
                         <input type="hidden" name="id" class="form-control" value="{{ $client->id }}" required>
                         @include('partials.changePasswordModal')

                        <hr>

                    </div>

             </div><!-- /.home -->

                <div id="reports" class="tab-pane fade">

                 <button type="button" data-toggle="modal" data-target="#updatepasswordModal" class="btn btn-info btn-sm ">Update Password</button>

                </div><!-- /.reports -->
        </div>
           </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- -->
@endsection
@stop






