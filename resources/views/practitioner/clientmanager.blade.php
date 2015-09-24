@extends('practitionermaster')

@section('sidemenubar')
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="{{ url('practitioner/dashboard') }}"><i class="fa fa-home"></i> Home</a>
            </li>
            <li class="active">
                <a href="{{ url('practitioner/clientmanager') }}"><i class="fa fa-users"></i> Client Manager</a>
            </li>
            <li>
                <a href="{{ url('practitioner/reportmanager') }}"><i class="fa fa-bar-chart-o"></i> Report Manager</a>
            </li>
            <li>
                <a href="{{ url('practitioner/questionmanager') }}"><i class="fa fa-pencil"></i> Question Manager</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    @include('clients_angularjs')

    <div ng-app="clientApp" id="page-wrapper">
        <div ng-controller="AllClientsController" class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        &nbsp;
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-users"></i> Client Manager
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            @if (count($errors) >0)

                <script>
                    $(document).ready(function () {
                        $("#newclient").modal('show');
                    });
                </script>

            @endif

            <button type="button" id="regbtn" class="btn btn-success"
                    data-toggle="modal" data-target="#newclient">
                <i class="fa fa-user"></i> Register a new Client
            </button>

            <hr>

            <div id="allClientsLoad" style="width:100%; ">
                <br><br><br>

                <div style="margin:auto;" class="la-ball-spin-clockwise-fade-rotating la-dark la-2x">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                <br>
<<<<<<< HEAD
                    <button ng-cloak type="button" id="regbtn" class="btn btn-success"
                            data-toggle="modal" data-target="#newclient">Register a new
                        Client
                    </button>
                    <hr>

                    <div id = "allClientsLoad" style = "width:100%; ">
                            <br><br><br>
                                <div style="margin:auto;"  class="la-ball-spin-clockwise-fade-rotating la-dark la-2x">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            <br>
                            <div id = "allClientsLoad_text" style="margin-left:45%;">
                                 <small style="margin:auto;"  >
                                    Fetching your Clients....
                                </small>
                            </div>
                             </div>
=======
>>>>>>> a8ae6c61eeac99612645a7bd386d49f9884d4144

                <div id="allClientsLoad_text" style="margin-left:45%;">
                    <small style="margin:auto;">
                        Fetching your Clients....
                    </small>
                </div>
            </div>

            <div id="emptymsg" style="visibility:hidden;">
                <h2>No Clients found.</h2>
            </div>

<<<<<<< HEAD
                         <!-- Client list table -->
                         <table ng-cloak ng-show="AllClients" class="table table-bordered table-hover table-striped">

                        <input ng-cloak ng-show="AllClients" type ="text" placeholder ="Search...." class = "form-control" ng-model="search">
                        <br>

                        <tr ng-cloak ng-show="AllClients">
                            <th>Client Name</th>
                            <th>Client Email</th>
                            <th>Joined on</th>
                            <th>Edit</th>
                        </tr>
                       
                            <tr ng-cloak ng-repeat="client in AllClients | filter:search">
                                <td> @{{ client.fname }}</td>
                                <td> @{{ client.email }}</td>
                                <td> @{{ client.created_at }}</td>
                                <td>
                                    <a href="#"
                                       class="btn btn-success btn-sm"> Edit </a>
                                </td>
                            </tr>
                       
                </table>
                <!-- /.table -->


                <div class="container">
                    <!-- Create new client Modal -->
                    <div class="modal fade" id="newclient" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><span style="color:#000000">New Client</span></h4>
                                </div>

                                <div class="modal-body">
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
=======
            <!-- Client list table -->
            <table ng-show="AllClients" class="table table-bordered table-hover table-striped">

                <input ng-show="AllClients" type="text" placeholder="Search...." class="form-control" ng-model="search">
                <br>

                <tr ng-show="AllClients">
                    <th>Client Name</th>
                    <th>Client Email</th>
                    <th>Joined on</th>
                    <th>Edit</th>
                </tr>

                <tr ng-repeat="client in AllClients | filter:search">
                    <td> @{{ client.fname }}</td>
                    <td> @{{ client.email }}</td>
                    <td> @{{ client.created_at }}</td>
                    <td>
                        <a href="#"
                           class="btn btn-success btn-sm"> Edit </a>
                    </td>
                </tr>

            </table>
            <!-- /.table -->


            <div class="container">
                <!-- Create new client Modal -->
                <div class="modal fade" id="newclient" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><span style="color:#000000">New Client</span></h4>
                            </div>

                            <div class="modal-body">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif

                                            <!-- Registration form -->
                                    <form role="form" method="POST" action="{{ url('/practitioner/createUser') }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="prac_id" value="{{ Session::get('prac_id') }}">

                                        <label for="fname"> Given name:*</label>
                                        <input required type="text" name="fname" class="form-control"
                                               placeholder="Enter the client's given name"
                                               value="{{ old('fname') }}" autofocus>
                                        <br>

                                        <label for="sname"> Family name:*</label>
                                        <input required type="text" name="sname" class="form-control"
                                               placeholder="Enter the client's family name"
                                               value="{{ old('sname') }}">
                                        <br>

                                        <label for="email"> Email Address:*</label>
                                        <input required type="email" name="email" class="form-control"
                                               placeholder="Enter the client's email address"
                                               value="{{ old('email') }}">
                                        <br>

                                        <label for="password"> Password:*</label>
                                        <input required type="password" name="password" class="form-control"
                                               placeholder="Enter a password">
                                        <br>

                                        <label for="password_confirmation"> Confirm Password:*</label>
                                        <input required type="password" name="password_confirmation"
                                               class="form-control"
                                               placeholder="Re-enter the password">
                                        <br>

                                        <select id="genderselect" name="gender" class="selectpicker"
                                                data-style="btn-inverse">
                                            <option value='Male'>Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <br><br>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success pull-right">
                                                <i class="fa fa-check"></i> Register Client
                                            </button>

                                            <button type="submit" class="btn btn-danger pull-left"
                                                    data-dismiss="modal">
                                                <i class="fa fa-times"></i> Cancel
                                            </button>
>>>>>>> a8ae6c61eeac99612645a7bd386d49f9884d4144
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
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- #page-wrapper -->
    <script>

        $('.selectpicker').selectpicker();

    </script>
@endsection

