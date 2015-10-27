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

<body>

@if(Session::has('flash_message'))

    @include('partials.flashMessageModal');

    <script>
            
        $('#flashMessageModal').modal('show');
       
       setTimeout(function(){
          $('#flashMessageModal').modal('hide')
        }, 3000);

    </script>

@endif

<div id="wrapper">
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
            <a class="navbar-brand" href="#">A T E S T</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">

            <li class="dropdown" ng-app="messengerApp" ng-controller="masterMessageController" ng-cloak>
                <a ng-cloak href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="badge pull-left " ng-if="totalunread()">  @{{ totalunread() }} </span> <i class="fa fa-envelope-o"></i>
                    <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#" ng-click="startAdd()"><i class="fa fa-pencil"></i> <small>Compose</small></a>
                    </li>
                    <li>
                        <a href="/../mailbox"><i class="fa fa-fw fa-envelope"></i> <small>Mailbox</small></a>
                    </li>
                </ul>
                @include('partials.messagewindow')
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="fa fa-user"></i> {{ Auth::User()->fname}} {{ Auth::User()->sname}}  <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="/profile"><i class="fa fa-fw fa-user"></i> Profile</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="/../auth/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items  -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            @yield('sidemenubar')
        </div>
        <!-- /.navbar-collapse -->
    </nav>

    <div class="body">
        @yield('content')
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
</body>

</html>
