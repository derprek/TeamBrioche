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
        </ul>
    </div>
@endsection

@section('content')

  @if(Session::has('client_registererrors'))

                <script>
                    $(document).ready(function () {
                        $("#newclient").modal('show');
                    });
                </script>

            @endif

 @if(Session::has('successful_registration'))
    <script>
        BootstrapDialog.show({
            title: 'Success',
            message: '{{ Session::pull('successful_registration')}} <strong>{{ Session::pull('email')}}.</strong> <br><br> <strong>The default password is: {{ Session::pull('defaultpassword')}}</strong>' ,
            type: BootstrapDialog.TYPE_SUCCESS,
            buttons: [{
                label: 'Close',
                cssClass: 'btn-default',
                action: function (dialogItself) {
                    dialogItself.close();
                }

            }]
        });
    </script>
@endif


    <div id="clientApp" >
        <div ng-controller="clientController" class="container-fluid">
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

           

            <button ng-show="AllClients" type="button" id="regbtn" class="btn btn-success"
                    data-toggle="modal" data-target="#newclient">
                <i class="fa fa-user"></i> Register a new Client
            </button>
            <hr>

            <div id = "allClientsLoad" style = "width:100%; ">
                     
                @include('partials.loadinganimation')

                    <div id = "allClientsLoad_text" style="margin-left:45%;">
                         <small style="margin:auto;"  >
                            Fetching your Clients....
                        </small>
                    </div>
                     </div>

                    <div id="emptymsg" class="emptymsg_container" style="visibility:hidden;">
                        <h2>No Clients found.</h2>
                        <a href="#" data-toggle="modal" data-target="#newclient"> <h3> Click here to register your first Client. </h3> </a>
                    </div>


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
                        <a href="/practitioner/viewclient/@{{ client.id }}"
                           class="btn btn-success btn-sm"> Edit </a>
                    </td>
                </tr>

            </table>
            <!-- /.table -->

            @include('partials.RegisterClientForm')

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- #page-wrapper -->
    <script>

        $('.selectpicker').selectpicker();

    </script>
@endsection

