@extends('practitionermaster')

@section('sidemenubar')
    
    @if(Session::has('is_admin'))
    
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="active" >
                    <a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i> Home</a>
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
                    <a href="{{ url('practitioner/dashboard') }}"><i class="fa fa-home"></i> Home</a>
                </li>
                <li>
                    <a href="{{ url('practitioner/clientmanager') }}"><i class="fa fa-users"></i> Client Manager</a>
                </li>
                <li >
                    <a href="{{ url('practitioner/reportmanager') }}"><i class="fa fa-bar-chart-o"></i> Report Manager</a>
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
                        <input type="hidden" name="id" class="form-control" value="{{ $practitioner->id }}" required> 
                        <label>First Name:<input type="text" name="fname" class="form-control" value="{{ $practitioner->fname }}" required>   </label>
                        <br>

                        <label>Family Name:<input type="text" name="sname" class="form-control" value="{{ $practitioner->sname }}" required> </label>
                        <br>

                        <label> Registered Email Address: <input type="email" name="email" value="{{ $practitioner->email }}" class="form-control" required> </label>
                        <br><br>

                        <input type="submit" value="Update" class="btn btn-primary btn-sm ">
                        </form>

                        <button type="button" data-toggle="modal" data-target="#updatepasswordModal" class="btn btn-info btn-sm ">Change Password</button>

                         <form role="form" method="POST" action="{{ url('/updatepassword') }}">
                         <input type="hidden" name="id" class="form-control" value="{{ $practitioner->id }}" required>
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






