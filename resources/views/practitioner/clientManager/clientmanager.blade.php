@extends('practitionermaster')

@section('sidemenubar')
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="{{ url('practitioner/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a>
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


            <button ng-show="AllClients" ng-cloak type="button" id="regbtn" class="btn btn-success"
                    data-toggle="modal" data-target="#newclient">
                <i class="fa fa-user-plus"></i> Register a new Client
            </button>
            <hr>

            <!-- Client list table -->
            <table ng-cloak ng-show="AllClients"  class="table table-bordered table-hover table-striped">

                <input ng-cloak ng-show="AllClients" type="text" placeholder="Search...." class="form-control" ng-model="search">
                <br>

                <tr ng-show="(AllClients| filter:search).length > 0">
                    <th class="normalRow">Client Name</th>
                    <th class="normalRow">Client Email</th>
                    <th class="mediumRow">Joined on</th>
                    <th class="smallRow">Options</th>
                </tr>

                <tr dir-paginate="client in AllClients | filter:search | itemsPerPage: 8" pagination-id="clientsPagination">
                    <td> @{{ client.name }}</td>
                    <td> @{{ client.email }}</td>
                    <td> @{{ client.joined_date }}</td>
                    <td>
                        <a href="/practitioner/viewclient/@{{ client.id }}"
                           class="btn btn-primary btn-sm"> View </a>
                    </td>
                </tr>

            </table>

            <div ng-if="AllClients">

                <div ng-show="(AllClients | filter:search).length == 0" class="emptyresults_container">
                     <h3> No results found <i class="fa fa-meh-o"></i> </h3>
                </div>

            </div>

            <dir-pagination-controls ng-if="AllClients" template-url="/dirPagination.tpl.html"
                                                 pagination-id="clientsPagination"></dir-pagination-controls>

            <!-- /.table -->

            @include('partials.RegisterClientForm')

            <div ng-show="loadingSpinner" style="visibility:hidden;" class="overlay"></div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- #page-wrapper -->
    <script>

        $('.selectpicker').selectpicker();

    </script>
@endsection

