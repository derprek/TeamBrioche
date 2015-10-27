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

    @if(Session::get('flash_message') === 'Create_New_Version!')
        {{Session::forget('flash_message')}}
        @include('partials.newVersionActionModal')   

        <script>

             $('#versionConfirmation').modal({
                show: true,
                keyboard: false,
                backdrop: 'static'
            });
               
        </script>

    @else

        @include('partials.flashMessageModal');

        <script>
                
            $('#flashMessageModal').modal('show');
           
           setTimeout(function(){
              $('#flashMessageModal').modal('hide')
            }, 3000);

        </script>

    @endif
@endif



@if(Session::has('error_message'))

    @include('partials.errorMessageModal');

    <script>
                
            $('#errorMessageModal').modal('show');
           
           setTimeout(function(){
              $('#errorMessageModal').modal('hide')
            }, 10000);

    </script>
    
@endif

@if(Session::has('info_message'))

    @include('partials.infoMessageModal');

    <script>
                
            $('#infoMessageModal').modal('show');
           
    </script>

    @unless(Session::has('client_email'))

        <script>

          setTimeout(function(){
                  $('#infoMessageModal').modal('hide')
                }, 10000);

        </script>

    @endunless
    
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
            <a class="navbar-brand" href="{{url('practitioner/dashboard')}}">A T E S T</a>
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

                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                    @if(Auth::check())

                        <small>{{ Auth::user()->fname }} {{ Auth::user()->sname }}</small>

                    @else

                       <small>{{ Session::get('prac_name')  }}</small>

                    @endif

                    
                    <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="/profile"><i class="fa fa-fw fa-user"></i> Profile</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                    @if(Auth::check())

                        <a href="/../auth/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>

                    @else

                        <a href="/../prac/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>

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
