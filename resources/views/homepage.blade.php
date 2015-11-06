@extends('master.home')

@section('content')
        <!-- Header -->
<header>
    <div class="container" id="home">
        <div class="row" >
            <div class="col-lg-12">
                <img class="img-responsive" src="img/final_logo.png" style="width:30%;" alt="">

                <div class="intro-text">
                    <hr class="star-light">
                    <span>Assistive Technology Evaluation and Selection Tool</span>
                </div>
                <br>
                <button type="button" id="regbtn" class="btn btn-primary"
                        data-toggle="modal" data-target="#praclogin">Practitioner Login
                </button>
                <button type="button" id="regbtn" class="btn btn-primary"
                        data-toggle="modal" data-target="#clientlogin">Client Login
                </button>
            </div>
        </div>
    </div>
</header>

@include('modalerror')

        <!-- Introduction Section -->
<section class="intro" id="mission">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
               <h2>The Online Assistive Tool</h2>
                <hr class="star-primary">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12 text-center">
                <p>
                    Assistive Technology (AT) is regularly provided by health and social services to many people with a wide range of
                    needs or disabilities, to overcome barriers and difficulties in daily life.<br><br>
                    The tool aims to support practitioners to meet clients’ individual needs when selecting AT by using a
                    common language and structure for the process.<br><br>
                    Experts in the field of AT were consulted during the development of the tool and initial
                    evaluation, and provided positive feedback on the research aims and approach.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="text-center">
    <div class="footer-below">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    Copyright &copy; Team Brioche
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Practitioner login -->
<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="praclogin" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title"><span style="color:#000000">Practitioner Login</span></h3>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" role="form" method="POST"
                          action="{{ url('practitioner/login') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">

                            <div class="col-md-12">
                                <input type="email" class="form-control" required name="email" maxlength="30"
                                       value="{{ old('email') }}" placeholder="&#xF007; E-mail Address"
                                       style="font-family:Arial, FontAwesome" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="password" required class="form-control" maxlength="50" placeholder="&#xF023; Password"
                                       style="font-family:Arial, FontAwesome" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </div>
                    </form>
                    @if ($errors-> any())
                        @foreach ($errors->all() as $error)
                            @if($error === "Invalid Credentials. Please try again!")
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        <li>{{ $error }}</li>
                                    </ul>
                                </div>
                            @endif
                        @endforeach
                    @endif

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

<!-- Client login -->
<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="clientlogin" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title"><span style="color:#000000">Client Login</span></h3>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" role="form" method="POST"
                          action="{{ url('client/login') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="email" class="form-control" required name="email" maxlength="30"
                                       value="{{ old('email') }}" placeholder="&#xF007; E-mail Address"
                                       style="font-family:Arial, FontAwesome" autofocus>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="password" required class="form-control" placeholder="&#xF023; Password"
                                       maxlength="50" style="font-family:Arial, FontAwesome" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </div>
                    </form>
                    @if ($errors-> any())
                        @foreach ($errors->all() as $error)
                            @if($error === "Invalid Credentials! Please try again")
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        <li>{{ $error }}</li>
                                    </ul>
                                </div>
                            @endif
                        @endforeach
                    @endif
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
@endsection

@stop