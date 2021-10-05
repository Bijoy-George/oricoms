<!--<h2>Customer Feedback Rating {{'( '.$fb_stat['total_fb_count'].' )'}} </h2>-->
<div class="average-rating text-center p-4">
  <h5 class="mb-1">Overall Rating</h5>
  <h1 class="mb-1">@if(!empty($fb_stat['avg'])) {{$fb_stat['avg']}} / {{ 5 * $fb_stat['total_fb_count'] }} @else 0/0  @endif</h1>
  <ul id='stars' class="stars mb-1">
     <?php 
     if(!empty($fb_stat['total_fb_count'])){
       $star_avg=round($fb_stat['avg'] / $fb_stat['total_fb_count']);
     }else{
       $star_avg=0;
     }
    ?>
    
    @for ($i = 1; $i <= 5; $i++)
    @if($i <= $star_avg)
    <li  class="star checked" data-value='1'> <i class='fa fa-star fa-fw'></i> </li>
    @else
    <li  class="star" data-value='1'> <i class='fa fa-star fa-fw'></i> </li>
    @endif
    @endfor

  </ul>
  <h6 class="m-0">Based on {{$fb_stat['total_fb_count']}} feedbacks</h6>
</div>
<div class="rating-status p-3">
   
@php


 $rating_arr=['5'=>'Excellent','4'=>'Good','3'=>'Average','2'=>'Bad','1'=>'Very Bad','0'=>'No Rating'];
@endphp

@foreach($rating_arr as $key1 =>$fb_val)
<?php
$small_caps=strtolower($fb_val);
if(!empty($fb_stat[$fb_val]) && !empty($fb_stat['avg']))
{

  $total_result=round(($fb_stat[$fb_val]*$key1*100)/$fb_stat['avg']) ;
  
}else{
  $total_result=0;
}
 ?>
   <div class="row py-1 align-items-center {{str_replace(' ', '-', $small_caps)}}">
    <div class="col-3">{{$fb_val}}</div>
    <div class="col-7">
      <div class="rating-rail">
        <div class="bar" style="width:{{$total_result}}%"></div>
      </div>
    </div>

    <div class="col-1"> {{$total_result}}% </div>
  </div>
@endforeach

@php

if($star_avg == 5)
{
  $flag="Very Happy";
  $flag_icon='<i class="far fa-laugh"></i>';
}else if($star_avg == 4)
{
  $flag="Happy";
  $flag_icon='<i class="far fa-smile"></i>';
}else if($star_avg == 3)
{
  $flag="Okay";
  $flag_icon='<i class="far fa-smile-beam"></i>';
}else if($star_avg == 2)
{
  $flag="Disappointed";
  $flag_icon='<i class="far fa-frown"></i>';
}else if($star_avg == 1)
{
  $flag="Vaery Disappointed";
  $flag_icon='<i class="far fa-angry"></i>  ';
}else if($star_avg == 0)
{
  $flag="--";
  $flag_icon='<i class="far fa-meh"></i>';
}else 
{
  $flag="--";
  $flag_icon='<i class="far fa-laugh"></i>';
}
@endphp


</div>
<div class="feedback-message py-2 px-3 text-center">
	Your customers are  {{$flag}} <?php echo $flag_icon;?>  
</div>
<!--

<div class="widget-scroller" id="rat_div">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="rat_list" class="table">
    @php $avg='0'; @endphp  
    @foreach($fb_stat['feedback_statistics'] as $key1 =>$fb_val)
    <?php 
		 $rating_arr=config('constant.FB_RATING');
		 $rating_arr[0]='No Rating';
		 $rating=$key1;
		 $avg+=$fb_val * $rating;
	 ?>
    <tr>
      <td align="left">{{$rating_arr[$key1]}}</td>
      <td align="left"><div class="rating-stars">
          <ul id='stars' class="stars">
            @for ($i = 1; $i <= 5; $i++)
            @if($i <= $rating)
            <li  class="star checked"  data-value='1'> <i class='fa fa-star fa-fw'></i> </li>
            @else
            <li class="star"  data-value='{{$key1}}'> <i class='fa fa-star fa-fw'></i> </li>
            @endif
            @endfor
            ( {{$fb_val}} )
          </ul>
        </div></td>
    </tr>
    @endforeach
    <tr>
      <?php if(isset($fb_stat['total_fb_count']) && !empty($fb_stat['total_fb_count']) && isset($avg) && !empty($avg))
{
?>
      <td><strong>Average</strong></td>
      <td align="left"><div class="rating-stars">
          <ul id='stars' class="stars">
            <?php $star_avg=round($avg / $fb_stat['total_fb_count']);?>
            @for ($i = 1; $i <= 5; $i++)
            @if($i <= $star_avg)
            <li  class="star checked" data-value='1'> <i class='fa fa-star fa-fw'></i> </li>
            @else
            <li  class="star" data-value='1'> <i class='fa fa-star fa-fw'></i> </li>
            @endif
            @endfor
            &nbsp <strong> {{$avg}} / {{ 5 * $fb_stat['total_fb_count'] }}    &nbsp &nbsp ( {{(($avg/(5 * $fb_stat['total_fb_count']))*100) }} % )</strong>
          </ul>
        </div></td>
      <?php }?>
    </tr>
  </table>
</div>-->
<style type="text/css">
  
  .checked {
    color: orange;
}
</style>
