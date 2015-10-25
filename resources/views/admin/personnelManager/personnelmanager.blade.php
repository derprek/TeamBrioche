@extends('adminmaster')

@section('sidemenubar')
    <div class="collapse navbar-collapse navbar-ex1-collapse">

        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i> Home</a>
            </li>
            <li class="active">
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
@endsection

@section('content')

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
            
            @if (Session::has('prac_registererrors'))

                <script>
                    $(document).ready(function () {
                        $("#newpractitioner").modal('show');
                    });
                </script>

            @endif

            @if (Session::has('client_registererrors'))

                <script>
                    $(document).ready(function () {
                        $("#newclient").modal('show');
                    });
                </script>

            @endif

            <div id="personnelmanagerApp">
            <div ng-controller="personnelmanagerController" class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        &nbsp;
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-users"></i> Personnel Manager
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

             <div id = "allPractitionersLoad" style = "width:100%; ">
                     
                @include('partials.loadinganimation')

                    <div id = "allPractitionersLoad_text" style="margin-left:45%;">
                         <small style="margin:auto;"  >
                            Fetching all Practitioners....
                        </small>
                    </div>
            </div>

            <div ng-hide="AllPractitioners" id="emptymsg_practitioners" class="emptymsg_container" style="visibility:hidden;">
                <h2>No Practitioners found.</h2>
                <a href="#" data-toggle="modal" data-target="#newclient"> <h3> Click here to register your first Practitioners. </h3> </a>
            </div>

            <div class="dropdown" ng-cloak ng-show="AllPractitioners">
                <button class="btn btn-success dropdown-toggle" type="button" id="menu1"
                        data-toggle="dropdown"><i class="fa fa-user-plus"></i></i> Register a new Personnel
                    <span class="caret"></span></button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                    <li role="presentation"  data-toggle="modal" data-target="#newpractitioner">
                        <a role="menuitem" tabindex="-1" href="#">Practitioner</a>
                    </li>
                    <li role="presentation"  data-toggle="modal" data-target="#newclient">
                        <a role="menuitem" tabindex="-1">Client</a>
                    </li>
                </ul>
            </div>

            <hr>

            <ul ng-cloak ng-show="AllPractitioners" class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#practitioner">Practitioners</a></li>
                <li><a data-toggle="tab" href="#clients">Clients</a></li>
            </ul>

            <div ng-cloak ng-show="AllPractitioners" class="tab-content">

            <div id="practitioner" class="tab-pane fade in active">
            <br>

            <!-- Client list table -->
            <table ng-show="AllPractitioners" class="table table-bordered table-hover table-striped">

                <input ng-show="AllPractitioners" type="text" placeholder="Search...." class="form-control" ng-model="searchprac">
                <br>

                <tr ng-show="(AllPractitioners| filter:searchprac).length > 0">
                    <th class="mediumRow">Practitioner's Name</th>
                    <th class="mediumRow">Practitioner's Email</th>
                    <th class="mediumRow">Joined on</th>
                    <th class="smallRow">View</th>
                </tr>

                <tr dir-paginate="practitioner in AllPractitioners | filter:searchprac | itemsPerPage: 10" pagination-id="practitionersPagination">
                    <td> @{{ practitioner.name }}</td>
                    <td> @{{ practitioner.email }}</td>
                    <td> @{{ practitioner.created_at }}</td>
                    <td>
                        <a href="/admin/viewpractitioner/@{{ practitioner.id }}"
                           class="btn btn-info btn-sm"> View </a>
                    </td>
                </tr>

            </table>
            <!-- /.table -->

            <div ng-if="AllPractitioners">

                <div ng-show="(AllPractitioners | filter:searchprac).length == 0" class="emptyresults_container">
                     <h3> No results found <i class="fa fa-meh-o"></i> </h3>
                </div>

            </div>

            <dir-pagination-controls ng-if="AllPractitioners" template-url="/dirPagination.tpl.html"
                                                 pagination-id="practitionersPagination"></dir-pagination-controls>

            </div>
            <!-- /.prac div -->

            <div id="clients" class="tab-pane fade">
            <br>

            <div id = "allClientsLoad" style = "width:100%; ">
                     
                @include('partials.loadinganimation')

                    <div id = "allClientsLoad_text" style="margin-left:45%;">
                         <small style="margin:auto;"  >
                            Fetching all Clients....
                        </small>
                    </div>
            </div>

            <div ng-hide="AllClients" id="emptymsg_clients" class="emptymsg_container" style="visibility:hidden;">
                <h2>No Clients found.</h2>
                <a href="#" data-toggle="modal" data-target="#newclient"> <h3> Click here to register your first Client. </h3> </a>
            </div>


            <!-- Client list table -->
            <table ng-show="AllClients" class="table table-bordered table-hover table-striped">

                <input ng-show="AllClients" type="text" placeholder="Search...." class="form-control" ng-model="searchclient">
                <br>

                <tr ng-show="(AllClients| filter:searchclient).length > 0">
                    <th class="mediumRow">Client's Name</th>
                    <th class="mediumRow">Client's Email</th>
                    <th class="mediumRow">Joined on</th>
                    <th class="smallRow">Edit</th>
                </tr>

                <tr dir-paginate="client in AllClients | filter:searchclient | itemsPerPage: 10" pagination-id="clientsPagination">
                    <td> @{{ client.name }}</td>
                    <td> @{{ client.email }}</td>
                    <td> @{{ client.created_at }}</td>
                    <td>
                        <a href="/admin/viewclient/@{{ client.id }}"
                           class="btn btn-info btn-sm"> View </a>
                    </td>
                </tr>

            </table>
            <!-- /.table -->

            <div ng-if="AllClients">

                <div ng-show="(AllClients | filter:searchclient).length == 0" class="emptyresults_container">
                     <h3> No results found <i class="fa fa-meh-o"></i> </h3>
                </div>

            </div>

            <dir-pagination-controls ng-if="AllPractitioners" template-url="/dirPagination.tpl.html"
                                                 pagination-id="clientsPagination"></dir-pagination-controls>

            </div>
            <!-- /.client div -->

            </div>

            @include('partials.RegisterPractitionerForm')
            @include('partials.RegisterClientForm_admin')

            <div ng-show="loadingSpinner" class="overlay"></div>

            </div>
           
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- #page-wrapper -->
@endsection
@stop






