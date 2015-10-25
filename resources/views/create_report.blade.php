<link href="/css/main.css" rel="stylesheet">
<div class="row">
                <div class="col-lg-12">
                <div class="well">
                 
                @unless(empty($categories))
                
                <ul class="nav nav-tabs" id="myTab">

                @foreach($categories as $category)
                  
                    @if($category === reset($categories))

                      <li class ="reportTabs" id="firstTab" style = "width:{{$thumbnail_dist}}%;" class="active"><a href="#{{$category->id}}" data-toggle="tab" title="{{$category->name}}">
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
                @foreach($questionslist as $questionbycat)

                    @if ($questionbycat === reset($questionslist))  

                         <div id="{{$questionbycat[0]->category_id}}" class="tab-pane fade in active">
                          <h3 class = "panel_header"> {{$categories[$i]->name}}</h3>
                          <hr>

                        @if(isset($clients))
                        <div class="form-group" style="padding-left:10px;padding-right:10px;">
                        <label for="client_list"> Select a Client:</label>
                          <select id="client_list" name="client" class="form-control">

                            @unless($clients->isEmpty())
                                @foreach($clients as $client)

                                    <option value= {{ $client-> id }}>{{ $client->fname }} {{ $client-> sname }} &#10;
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
                                     placeholder="Goals + Typology"> {{$goals}}</textarea>
                          </div>
                        @endif                 

                    @else

                      <div id="{{$questionbycat[0]->category_id}}" class="tab-pane fade"> 
                      <h3> {{$categories[$i]->name}}</h3>
                      <hr>

                    @endif
  
                @foreach($questionbycat as $questionbytype)

                     @if($questionbytype->type === "thumbnail")

                      @if(isset($evaluation))
                        @if($questionbytype->step !== 3)

                           <div class="form-group" style="padding:10px;">
                           <label for="answersid[{{ $questionbytype->id }}]">{{ $questionbytype->question }}</label>
                             <textarea class="form-control"
                              name="answersid[{{ $questionbytype->id }}]"
                              rows="3" readonly="" 
                              placeholder="{{ $questionbytype->placeholder }}">{{$questionbytype->pivot->answers}}</textarea>
                           </div>

                        @else
        
                          <div class="form-group" style="padding:10px;">
                          <label for="answersid[{{ $questionbytype->id }}]">{{ $questionbytype->question }}</label>
                          <textarea class="form-control"
                            name="answersid[{{ $questionbytype->id }}]"
                            rows="3"
                            placeholder="{{ $questionbytype->placeholder }}"></textarea>
                          </div>
                          <!-- /.form-group -->
                        @endif

                      @else

                          <div class="form-group" style="padding:10px;">
                          <label for="answersid[{{ $questionbytype->id }}]">{{ $questionbytype->question }}</label>
                          <textarea class="form-control"
                            name="answersid[{{ $questionbytype->id }}]"
                            rows="3"
                            placeholder="{{ $questionbytype->placeholder }}"></textarea>
                          </div>
                          <!-- /.form-group -->

                    @endif

                    @else
                            <div class="form-group" style="padding:10px;">
                                <label for="answersid[{{ $questionbytype->id }}]">{{ $questionbytype->question }}</label>
                                @if($questionbytype->type === "tall")
                                    <textarea name="answersid[{{ $questionbytype->id }}]"
                                              class="form-control" rows="3"
                                              placeholder="{{$questionbytype->placeholder }}"></textarea>
                                @elseif($questionbytype->type === "regular")
                                    <input type="text" name="answersid[{{ $questionbytype->id }}]"
                                           class="form-control"
                                           placeholder="{{ $questionbytype->placeholder }}">
                                @endif
                            </div>
                            <!-- /.form-group -->
                    @endif

                @endforeach
               
                    @if ($questionbycat === end($questionslist)) 

                    <div class="form-group" style="padding:10px;">
                    <a class="btn btn-primary btnPrevious" href="#">Previous Section</a>
                    <button type="submit" class="btn btn-success pull-right"> <i class="fa fa-cloud-upload"></i> {{$submitButtonText}}</button>
                       </form>
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
   
      $(function(){
      $('a[title]').tooltip();
      });

      $(document).ready(function() {

           TweenMax.staggerFrom(".reportTabs", 2, {scale:0.5, opacity:0, delay:0.3, ease:Elastic.easeOut, force3D:true}, 0.2);

          });             

      $('#firstTab').delay(2500).queue(function(){
      $(this).addClass("active");
      });             

    </script>