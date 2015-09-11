@extends('master')

@section('content')
        <!-- Header -->
<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <img class="img-responsive" src="img/logo.png" alt="">
                <div class="intro-text">
                    <span class="name">A T E S T </span>
                    <hr class="star-light">
                    <span class="skills">Assitive Technology Evaluation and Selection Tool</span>
                </div>
                <br>
                <button type="button" id="regbtn" class="btn btn-success"
                        data-toggle="modal" data-target="#praclogin">Practitioner Login
                </button>
                <button type="button" id="regbtn" class="btn btn-success"
                        data-toggle="modal" data-target="#clientlogin">Client Login
                </button>


            </div>
        </div>
    </div>
</header>

@include('modalerror')

<section class="success" id="mission">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Our Mission</h2>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-lg-offset-2">
                <p>ATEST is an online assistive Tool</p>
            </div>
            <div class="col-lg-4">
                <p> This project will assist many people with disabilities who require assistive technologies to match
                    their lifestyle and needs. At the present moment people who need assistive technologies have to go
                    through a system to attain these technologies which can take up to a year. This process despite its
                    length does not guarantee that people are matched with the appropriate assistive technology. The
                    application asks the users questions in order to generate a report. </p>
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
<!-- prac login -->
<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="praclogin" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span style="color:#000000">Practitioner Login</span></h4>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" role="form" method="POST"
                          action="{{ url('practitioner/login') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" required name="email"
                                       value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="password" required class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
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
            </div>
        </div>
    </div>
</div>

<!-- client login -->
<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="clientlogin" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span style="color:#000000">Client Login</span></h4>
                </div>
                <div class="modal-body">

                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ url('client/login') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" required name="email"
                                       value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="password" required class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
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
            </div>
        </div>
    </div>
</div>
@endsection

@stop