@extends('master.practitioner')

@section('sidemenubar')
    
    @include('partials.sidebar_reports')

@endsection

@section('content')
<link href="/css/main.css" rel="stylesheet">
         <div id="page-wrapper">
        <div class="container-fluid">

        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        &nbsp;
                    </h1>
                    <ol class="breadcrumb">

                        <li>
                             <a href="{{ url('practitioner/dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a>
                        </li>

                        <li class="active">
                            <i class="fa fa-pencil"></i> Create a new Report
                        </li>

                    </ol>
                </div>
            </div>
            <!-- /.row -->
               {!! Form::open(['url' => 'reports']) !!} 
              @include('create_report')
     </div>
</div>

    <script>

         $(function () {
          $('[data-toggle="popover"]').popover()
        });

        $('#client_list').select2();    
  
    </script>

@endsection