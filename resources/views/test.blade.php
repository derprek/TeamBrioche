@extends('practitionermaster')

@section('sidemenubar')
    <ul class="nav navbar-nav side-nav">
        <li>
            <a href="{{ url('practitioner/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
        </li>
        <li>
            <a href="{{ url('practitioner/clientmanager') }}"><i class="fa fa-users"></i> Client Manager</a>
        </li>
        <li class="active">
            <a href="{{ url('practitioner/reportmanager') }}"><i class="fa fa-bar-chart-o"></i> Report Manager</a>
        </li>
        <li>
            <a href="{{ url('practitioner/questionmanager') }}"><i class="fa fa-pencil"></i> Question Manager</a>
        </li>
    </ul>
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

                        <li class="active">
                            <i class="fa fa-dashboard"></i> Dashboard
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

        <div class="row">
                <div class="col-lg-12">
                <div class="well">
                 
                   @unless(empty($categories))
                
                
                <ul class="nav nav-tabs" id="myTab">

                @foreach($categories as $category)
                  
                    @if($category === reset($categories))

                      <li class="active"><a href="#{{$category->id}}" data-toggle="tab" title="{{$category->name}}">
                      <span class="round-tabs five"><i class="{{$category->thumbnail}}"></i>
                      </span> </a></li>

                    @else

                     <li><a href="#{{$category->id}}" data-toggle="tab" title="{{$category->name}}">
                     <span class="round-tabs five"><i class="{{$category->thumbnail}}"></i>
                     </span> </a></li>    

                    @endif

                @endforeach
                </ul>
               
                @endunless
                 </div>

                {!! Form::open(['url' => 'reports']) !!} 
                <div class="tab-content" >

                <?php $i = 0; ?>
                @foreach($questionslist as $questionbycat)

                    @if ($questionbycat === reset($questionslist))  

                         <div id="{{$questionbycat[0]->category_id}}" class="tab-pane fade in active">
                          <h3> {{$categories[$i]->name}}</h3>
                          <hr>
                        <div class="form-group" style="padding-left:10px;padding-right:10px;">
                        
                         
                          <label for="client_list"> Select a Client:</label>
                          <select id="client_list" name="client" class="form-control">

                            @unless($clients->isEmpty())
                                @foreach($clients as $client)

                                    <option value= {{ $client-> id }}>{{ $client->fname }} {{ $client-> sname }} </br>
                                        Email: {{ $client-> email }} </option>

                                @endforeach
                            @endunless

                          </select>    
                          </div>                  

                    @else

                      <div id="{{$questionbycat[0]->category_id}}" class="tab-pane fade"> 
                      <h3> {{$categories[$i]->name}}</h3>
                      <hr>

                    @endif
  
                @foreach($questionbycat as $questionbytype)

                     @if($questionbytype->type === "thumbnail")
                        <div class="form-group" style="padding:10px;">
                        <textarea class="form-control"
                          name="answersid[{{ $questionbytype->id }}]"
                          rows="3"
                          placeholder="{{ $questionbytype->placeholder }}"></textarea>
                        </div>
                        <!-- /.form-group -->

                     @else
                            <div class="form-group" style="padding:10px;">
                                <label for="answersid[{{ $questionbytype->id }}]">{{ $questionbytype->question }}</label>
                                @if($questionbytype->type === "tall")
                                    <textarea name="answersid[{{ $questionbytype->id }}]"
                                              class="form-control" rows="3"
                                              placeholder="{{ $questionbytype->placeholder }}"></textarea>
                                @elseif($questionbytype->type === "regular")
                                    <input type="text" name="answersid[{{ $questionbytype->id }}]"
                                           class="form-control"
                                           placeholder="{{ $questionbytype->placeholder }}">
                                @endif
                            </div>
                            <!-- /.form-group -->
                      @endif

                @endforeach
               
                    @if ($questionbycat == end($questionslist)) 

                    <div class="form-group" style="padding:10px;">
                    <a class="btn btn-primary btnPrevious" href="#">Previous Section</a>
                        {!! Form:: submit('Create Assessment' , ['class' => 'btn btn-success ']) !!}
                        {!! Form::close() !!}
                    </div> 

                    @elseif($questionbycat === reset($questionslist))

                    <div class="form-group" style="padding:10px;">
                         <a class="btn btn-primary btnNext" href="#">Next Section</a>
                    </div> 

                    @else

                    <div class="form-group" style="padding:10px;">
                        <a class="btn btn-primary btnPrevious" href="#">Previous Section</a>
                        <a class="btn btn-primary btnNext" href="#">Next Section</a>
                    </div> 

                    @endif

                    </div>
                     <?php $i++; ?>
                @endforeach
                </div>
                
                <!-- old -->

                  

</div>

<script>

    $('.btnNext').click(function(){
      $('.nav-tabs > .active').next('li').find('a').trigger('click');
    });

    $('.btnPrevious').click(function(){
      $('.nav-tabs > .active').prev('li').find('a').trigger('click');
    });

        $('#client_list').select2();    
       $(".selectthumbnail").height(Math.max.apply(null, $(".selectthumbnail").map(function() { return $(this).height(); })) +30);
    
    $(function(){
$('a[title]').tooltip();
});

    </script>

@endsection