@extends('practitionermaster')

@section('sidemenubar')
    <ul class="nav navbar-nav side-nav">
        <li>
            <a href="{{ url('practitioner/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
        </li>
        <li class="active">
            <a href="{{ url('practitioner/clientmanager') }}"><i class="fa fa-users"></i> Client Manager</a>
        </li>
        <li>
            <a href="{{ url('practitioner/reports') }}"><i class="fa fa-bar-chart-o"></i> Report Manager</a>
        </li>
        <li>
            <a href="{{ url('practitioner/questions') }}"><i class="fa fa-pencil"></i> Question Manager</a>
        </li>
    </ul>
@endsection

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        &nbsp;
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="{{ url('practitioner/dashboard') }}">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-users"></i> Client Manager
                        </li>
                    </ol>
                </div>
            </div>

            @if (count($errors) >0)

                <script>
                    $(document).ready(function () {
                        $("#newclient").modal('show');
                    });
                </script>

            @endif




            <div id="menu1" class="tab-pane fade in active">
                <table class="table table-bordered table-hover table-striped">
                    <br>
                    <button type="button" id="regbtn" class="btn btn-success"
                            data-toggle="modal" data-target="#newclient">Register a new
                        Client
                    </button>
                    <hr>
                    @if($clients->isEmpty())
                        <tr> No Clients
                        </tr>
                    @else
                        <tr>
                            <th>Client Name</th>
                            <th>Client Email</th>
                            <th>Joined on</th>
                            <th>Edit</th>
                        </tr>
                        @foreach($clients as $client)
                            <tr>
                                <td> {{ $client->fname}} {{ $client->sname}}</td>
                                <td> {{ $client->email}}</td>
                                <td> {{ $client->created_at}}</td>
                                <td>
                                    <a href="#"
                                       class="btn btn-success btn-sm"> Edit </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </table>

            </div>

            <div class="container">
                <!-- Modal -->
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
                                    </div>
                                @endif

                                <form role="form" method="POST" action="{{ url('/practitioner/createUser') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <div class="form-group" id="qntable">
                                        <label for="fname"> Given name:*</label>
                                        <input required type="text" name="fname" class="form-control"
                                               placeholder="Enter the client's given name" value="{{ old('fname') }}">
                                        <br>

                                        <label for="sname"> Family name:*</label>
                                        <input required type="text" name="sname" class="form-control"
                                               placeholder="Enter the client's family name" value="{{ old('sname') }}">
                                        <br>

                                        <label for="email"> Email Address:*</label>
                                        <input required type="text" name="email" class="form-control"
                                               placeholder="Enter the client's email address"
                                               value="{{ old('email') }}">
                                        <br>

                                        <label for="password"> Password:*</label>
                                        <input required type="text" name="password" class="form-control"
                                               placeholder="Enter a password">
                                        <br>

                                        <label for="password_confirmation"> Confirm Password:*</label>
                                        <input required type="text" name="password_confirmation" class="form-control"
                                               placeholder="Re-enter the password">
                                        <br>


                                        <select id="genderselect" name="gender" class="selectpicker"
                                                data-style="btn-inverse">
                                            <option value='Male'>Male</option>
                                            <option value="Female">Female</option>
                                        </select>

                                    </div>


                            </div>


                            <div class="modal-footer">

                                <button type="submit" class="btn btn-info form-control">Register Client</button>

                                <hr/>
                                <button type="button" class="btn btn-danger form-control" data-dismiss="modal">Close
                                </button>


                            </div>
                        </div>
                        </form>
                    </div>
                </div>


            </div>

        </div>
    </div>
@endsection

