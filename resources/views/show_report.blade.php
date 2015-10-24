<link href="/css/main.css" rel="stylesheet">
<div class="row">
                <div class="col-lg-12">
                <div class="well">
                 
                @unless(empty($categories))
                
                <ul class="nav nav-tabs" id="myTab">

                @foreach($categories as $category)
                  
                    @if($category === reset($categories))

                      <li style = "width:{{$thumbnail_dist}}%;" class ="reportTabs" id="firstTab"><a href="#{{$category->id}}" data-toggle="tab" title="{{$category->name}}">
                      <span class="round-tabs five"><i class="{{$category->thumbnail}}"></i>
                      </span> </a></li>

                    @else

                     <li class ="reportTabs" style = "width:{{$thumbnail_dist}}%;" ><a href="#{{$category->id}}" data-toggle="tab" title="{{$category->name}}">
                     <span class="round-tabs five"><i class="{{$category->thumbnail}}"></i>
                     </span> </a></li>    

                    @endif

                @endforeach
                </ul>
               
                @endunless
                 </div>

                <div class="tab-content" >

                <?php $i = 0; ?>
                @foreach($answerlist as $answerbycat)

                    @if ($answerbycat === reset($answerlist))  

                         <div id="{{$answerbycat[0]->category_id}}" class="tab-pane fade in active">
                          <h3> {{$categories[$i]->name}}</h3>
                          <hr>

                        @if(isset($clients))
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
                        @endif    

                        @if(isset($goals))
                        <div class="form-group" style="padding:10px;">
                            <label for="goals_typology">Goals:</label>
                         <textarea readonly name="goals_typology"
                                   class="form-control" rows="5"
                                   placeholder="Goals + Typology"> {{ $goals}}</textarea>
                        </div>
                        @endif                 

                    @else

                      <div id="{{$answerbycat[0]->category_id}}" class="tab-pane fade"> 
                      <h3> {{$categories[$i]->name}}</h3>
                      <hr>

                    @endif
  
                @foreach($answerbycat as $answerbytype)

                     @if($answerbytype->type === "thumbnail")

                      @if(isset($is_evaluation))
             
                        @if($answerbytype->step !== 3)

                           <div class="form-group" style="padding:10px;">
                           <label for="answersid[{{ $answerbytype->id }}]">{{ $answerbytype->question }}</label>
                             <textarea class="form-control"
                              name="answersid[{{ $answerbytype->id }}]"
                              rows="3" readonly="" 
                              placeholder="No information found. Please go back to the Assessment section to add any missing information.">{{$answerbytype->pivot->answers}}</textarea>
                           </div>

                        @else

                          <div class="form-group" style="padding:10px;">
                          <label for="answersid[{{ $answerbytype->id }}]">{{ $answerbytype->question }}</label>
                          <textarea class="form-control"
                            name="answersid[{{ $answerbytype->id }}]"
                            rows="3"
                            placeholder="{{ $answerbytype->placeholder }}">{{$answerbytype->pivot->answers}}</textarea>
                          </div>
                          <!-- /.form-group -->
                        @endif

                      @else

                          <div class="form-group" style="padding:10px;">
                          <label for="answersid[{{ $answerbytype->id }}]">{{ $answerbytype->question }}</label>
                          <textarea class="form-control"
                            name="answersid[{{ $answerbytype->id }}]"
                            rows="3"
                            placeholder="{{ $answerbytype->placeholder }}">{{$answerbytype->pivot->answers}}</textarea>
                          </div>
                          <!-- /.form-group -->

                    @endif

                   @else
                          <div class="form-group" style="padding:10px;">
                              <label for="answersid[{{ $answerbytype->id }}]">{{ $answerbytype->question }}</label>
                              @if($answerbytype->type === "tall")
                                  <textarea name="answersid[{{ $answerbytype->id }}]"
                                            class="form-control" rows="3"
                                            placeholder="{{ $answerbytype->placeholder }}">{{$answerbytype->pivot->answers}}</textarea>
                              @elseif($answerbytype->type === "regular")
                                  <input type="text" name="answersid[{{ $answerbytype->id }}]"
                                         class="form-control"
                                         placeholder="{{ $answerbytype->placeholder }}"
                                         value ="{{$answerbytype->pivot->answers}}">
                              @endif
                          </div>
                          <!-- /.form-group -->
                    @endif

                @endforeach
                    
                    <div class="form-group" style="padding:10px;">

                    @if ($answerbycat === end($answerlist)) 

                        <a class="btn btn-primary btnPrevious" href="#">Previous Section</a>
                   
                    @elseif($answerbycat === reset($answerlist))

                         <a class="btn btn-primary btnNext" data-toggle="modal" data-target="#versionConfirmation" href="#">Next Section</a>

                    @else

                        <a class="btn btn-primary btnPrevious" href="#">Previous Section</a>
                        <a class="btn btn-primary btnNext" href="#">Next Section</a>

                    @endif

                    <button type="submit" class="btn btn-success pull-right"> <i class="fa fa-cloud-upload"></i> {{$submitButtonText}}</button>
                    </div> 

                    </form>

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
 
   

     $(document).ready(function() {

         TweenMax.staggerFrom(".reportTabs", 2, {scale:0.5, opacity:0, delay:0.3, ease:Elastic.easeOut, force3D:true}, 0.2);

        });
      
    $('#firstTab').delay(2500).queue(function(){
    $(this).addClass("active");
    });       

    </script>