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

<div id="wrapper" ng-controller="MailboxController">
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

            @if((Session::has('prac_id')) && (Session::has('is_admin')))
                <a class="navbar-brand" href="{{url('admin/dashboard')}}">A T E S T</a>
            @elseif(Session::has('prac_id'))
                <a class="navbar-brand" href="{{url('practitioner/dashboard')}}">A T E S T</a>
            @elseif(Auth::check())
                <a class="navbar-brand" href="{{url('home')}}">A T E S T</a>
            @endif

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
                        <a href="/../mailbox"><i class="fa fa-fw fa-envelope"></i> <small>Mailbox</small></a>
                    </li>
                </ul>
                @include('partials.messagewindow')
            </li>

            <li class="dropdown">

                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                   @if(Session::has('prac_id'))

                    <small>{{ Session::get('prac_name')  }}</small>

                   @elseif(Auth::check())
                   
                     <small>{{ Auth::User()->fname}} {{ Auth::User()->sname}}</small>

                   @endif 
                    <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="/profile"><i class="fa fa-fw fa-user"></i> Profile</a>
                    </li>
                    <li class="divider"></li>
                    <li>

                        @if(Session::has('prac_id'))

                         <a href="/../prac/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>

                        @elseif(Auth::check())
                       
                          <a href="/../auth/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>

                        @endif 

                        
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
