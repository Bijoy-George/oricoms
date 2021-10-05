
@if(!empty($details))

  <div class="row">
              
    <div class="col-sm-12">
                
    <?php //dd($details['feedback_question']);?>               
        @if($details['feedback_request']['req_title'])<p id="title_p">Followup Title: {{strip_tags($details['feedback_request']['req_title'])}}</p>@endif
        @if($details['feedback_request']['remainder_date'])<p id="followdate_p">Followup Date & Time: @if(!empty($details['feedback_request']['remainder_date']) && $details['feedback_request']['remainder_date'] != '0000-00-00 00:00:00') 
                {{App\Helpers::common_date_conversion($details['feedback_request']['remainder_date'],3) }}
              @else Nil @endif</p>  @endif                  
        @if($details->todo)<p id="todo_p">Description: {{strip_tags($details['feedback_request']['answer'])}}</p>@endif
                    
                    
                    
    </div>

    @if(!empty($details->rating) || !empty(strip_tags($details->comments)) || !empty($details->questions))
    <div class="col-sm-12" id="fb_div">
      <?php 
      $fbtype='';
      $fb_cat=config('constant.FB_TYPE');?>
      @foreach($channels as  $type)

          @if($details->fb_type == $type->id)
            <?php $fbtype=$type->name;?>
          @endif
      @endforeach
     <p style="color:#147bd4;"> <i><b>Followup Feedback -  <span>Medium : {{$fbtype}}</b></i></span></p>
      
      
      
      <p id="comments_p">Comments : {{strip_tags($details->comments)}}</p> 
      <p id="rating_p">Rating :  
                @php $rating_arr=config('constant.FB_RATING');
                   $rating_arr[0]='--';
               @endphp
             {{ $rating_arr[$details->rating] }}     

                    <!-- <div class="rating-stars">
                      <ul id='stars' class="stars">
                    
                      <?php 
                      $rating_arr=config('constant.FB_RATING');?>
                      @foreach ($rating_arr as $key =>$type)
                                      <?php if($key <= $details->rating){ $c_class = 'star checked'; }else{ $c_class = 'star';} ?>

                      
                                
                        <li  class="<?php echo $c_class;?>" title='{{$type}}' data-value='{{$key}}'>
                                      <i class='fa fa-star fa-fw'></i>
                                      </li>
                               
                        @endforeach
                        </ul>
                        </div>-->
                </p>
                
                <?php $question_det=$details['feedback_question'];
               // print_r($question_det);?>
               <!--@if(!empty($question_det))
                    <p><i><b>Questions</b></i></p>
                    @foreach($question_det as $key => $row)
                      <span><i>{{$key+1}}.  {{$row->questions}}<br>
                      Answer : <b>{{strtoupper($row->answer)}}</b> </i></span><br>
                    @endforeach
                @endif-->
              </div>
             @endif
              
              
</div>   
@endif