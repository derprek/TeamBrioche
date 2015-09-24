
                @foreach($answerlist as $answerbycat)

                    @foreach($answerbycat as $answerbytype)
                        
                            @if($answerbytype->type === "thumbnail")

                            <div class="col-sm-6 col-md-6" >
                                <div class="selectthumbnail" id ="questionthumbnail">

                                    <img style="width:15%;" src={{ $answerbytype->imgpath }} >
                                    <br>
                                    <h4>{{ $answerbytype->question }}</h4>
                                    <hr>
                                    <div class="caption">
                                     @if($answerbytype->category_id < 6)
                                        <textarea class="form-control"
                                                  rows="3" readonly="" >{{$answerbytype->pivot->answers}}</textarea>
                                       @else
                                                <input type="hidden" name="qsid[]" value={{ $answerbytype->pivot->qsid }}>
                                                 <textarea class="form-control" name="answersid[{{ $answerbytype->id }}]"
                                              rows="3" >{{$answerbytype->pivot->answers}}</textarea>
                                       @endif
                                        <hr>
                                    </div>

                            @else
                                    <div class="form-group" >
                                    <label for="answersid[{{ $answerbytype->id }}]">{{ $answerbytype->question }}</label>
                                    @if($answerbytype->type === "tall")                                  
                                          <input type="hidden" name="qsid[]" value={{ $answerbytype->pivot->qsid }}>
                                            <textarea name="answersid[{{ $answerbytype->id }}]"
                                              class="form-control" rows="3"
                                             placeholder="{{ $answerbytype->placeholder }}">{{$answerbytype->pivot->answers}}</textarea>
                                                         
                                    @elseif($answerbytype->type === "regular")
                                     <input type="hidden" name="qsid[]" value={{ $answerbytype->pivot->qsid }}>
                                        <input type="text" name="answersid[{{ $answerbytype->id }}]"
                                               class="form-control"
                                               value="{{$answerbytype->pivot->answers}}">
                                    @endif
                               </div>
                                <!-- /.form-group -->
                            @endif
                             
                    @endforeach
                </div>
                <!-- /.thumbnail -->
            </div>
            @endforeach                  

                    <div class="col-sm-6 col-md-12"  style="padding:3%;">
                            {!! Form:: submit('Update Changes' , ['class' => 'btn btn-success form-control']) !!}
                            {!! Form::close() !!}
                        </div>
        <script type="text/javascript">
           $(".selectthumbnail").height(Math.max.apply(null, $(".selectthumbnail").map(function() { return $(this).height(); })) +30);
        </script>