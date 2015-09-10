@extends('app')

@section('content')
    <div id="page-wrapper">

        <div class="container-fluid">

            <div class="col-md-8 col-md-offset-2">

                <ul class="nav nav-pills">
                    <li class="active"><a data-toggle="tab" href="#practitioner"><h5>Log in as a Practitioner</h5></a>
                    </li>
                    <li><a data-toggle="tab" href="#client"><h5>Log in as a Client</h5></a></li>
                </ul>

                <div class="tab-content">
                    <!-- Start Prac login -->
                    <div id="practitioner" class="tab-pane fade in active">
                        <!-- 1st tab -->
                        <div class="panel panel-default">
                            <div class="panel-heading">Practitioner Login</div>
                            <div class="panel-body">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                        <ul>
                                            @foreach ($errors as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

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
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="remember"> Remember Me
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">Login</button>

                                            <a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your
                                                Password?</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Start Client login -->
                    <div id="client" class="tab-pane fade">
                        <!--  tab -->
                        <div class="panel panel-default">
                            <div class="panel-heading">Client Login</div>
                            <div class="panel-body">
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

                                <form class="form-horizontal" role="form" method="POST"
                                      action="{{ url('/auth/login') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">E-Mail Address</label>

                                        <div class="col-md-6">
                                            <input type="email" class="form-control" name="email"
                                                   value="{{ old('email') }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" required>Password</label>

                                        <div class="col-md-6">
                                            <input type="password" required class="form-control" name="password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="remember"> Remember Me
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">Login</button>

                                            <a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your
                                                Password?</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Client login -->
                </div>
            </div>
        </div>


@endsection
@stop