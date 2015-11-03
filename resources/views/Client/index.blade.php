@extends('master.client')

@section('sidemenubar')
    
    @include('partials.sidebar_home')
    
@endsection

@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    &nbsp;
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-home"></i>Home
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row-->

        <div class="col-lg-12">
            <div class="jumbotron">
                <div class="container">
                    <h3>Greetings , {{ $username }}!</h3>
                    <p> Welcome to ATEST </p>
                    <hr>
                    <p>
                        <a class="btn btn-success btn-lg" href="{{ url('client/reportarchives') }}" role="button">View Reports </a>
                    </p>
                </div>
                 <!-- /.container-->
            </div>
            <!-- /.jumbotron-->
        </div>
<!-- /.col-lg-12-->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- #page-wrapper -->
@endsection
@stop