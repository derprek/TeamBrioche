<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> A T E S T</title>

    @include('cssreferences')
    @include('jsreferences')

</head>

<body ng-app="messengerApp">
@if(Session::has('flash_message'))
    <script>
        BootstrapDialog.show({
            title: 'Success',
            message: '{{ Session::get('flash_message')}}',
            buttons: [{
                label: 'Close',
                cssClass: 'btn-info',
                action: function (dialogItself) {
                    dialogItself.close();
                }

            }]
        });
    </script>
@endif

<div id="wrapper" ng-controller="InboxController">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('practitioner/dashboard')}}">A T E S T</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">

        <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="badge pull-left " ng-if="totalunread()"> @{{ totalunread() }} </span> <i class="fa fa-envelope-o"></i>
                    <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#" ng-click="startAdd()"><i class="fa fa-pencil"></i> <small>Compose</small></a>
                    </li>
                    <li>
                        <a href="/../practitioner/inbox"><i class="fa fa-fw fa-envelope"></i> <small>Inbox</small></a>
                    </li>
                </ul>
                @include('partials.messagewindow')
            </li>


            <li class="dropdown">

                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                    <small>{{ Session::get('prac_name')  }}</small>
                    <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="/../prac/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items -->
        <div class="body">
            @yield('sidemenubar')
        </div>
        <!-- /.body -->
    </nav>

    <div class="body">
        @yield('content')
    </div>

</div>
<!-- /#wrapper -->

</body>
</html>