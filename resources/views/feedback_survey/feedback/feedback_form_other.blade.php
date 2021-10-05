<?php 
$eng_question=array();
$mal_question=array();
//print_r($fb_questions[0]['id']);
if(!empty($fb_questions))
{
foreach ($fb_questions as $value) {
  
  if(!empty($value->eng_qstn_id))
  {
    $eng_question[]=$value->eng_qstn_id;
  }
  if(!empty($value->mal_qstn_id))
  {
    $mal_question[]=$value->mal_qstn_id;
  }
  
}

}?>
<?php for($i=0;$i<3;$i++){
  if(isset($eng_question[$i]) && !empty($eng_question[$i]))
  {
    $eng_question[$i]=$eng_question[$i];
  }else{
    $eng_question[$i]=0;
  }
  if(isset($mal_question[$i]) && !empty($mal_question[$i]))
  {
    $mal_question[$i]=$mal_question[$i];
  }else{
    $mal_question[$i]=0;
  }
  ?>

<div class="col-sm-6">
  <div class="form-group"> @if($i== 0)
    <label>English Questons</label>
    @endif
    <select class="form-control" name="eng_q[]" id="eng_q{{$i}}" >
      <option value="0" >Select</option>
      
         @foreach($engquestions as $qstn)
        
      <option value="{{$qstn->id}}" @if($eng_question[$i] == $qstn->id) selected="selected" @endif >{{$qstn->questions}}</option>
      
        @endforeach
      
    </select>
    <span id="eng_q_err{{$i}}"></span> </div>
</div>
<div class="col-sm-6"> @if($i== 0)
  <label>Malayalam Questions</label>
  @endif
  <select class="form-control" name="mal_q[]" id="mal_q{{$i}}" >
    <option value="0" >Select</option>
    
         @foreach($malaquestions as $qstn)
        
    <option value="{{$qstn->id}}" @if($mal_question[$i] == $qstn->id) selected="selected" @endif >{{$qstn->questions}}</option>
    
        @endforeach
      
  </select>
  <span id="mal_q_err{{$i}}"></span> </div>
</div>
<div class="col-sm-12">
  <?php if(isset($fb_questions[$i]['id']) && !empty($fb_questions[$i]['id']))
{
$relation_id=$fb_questions[$i]['id'];
}else{
$relation_id=0;
}?>
  <input type="hidden" name="relation_id{{$i}}" class="form-control" value="{{$relation_id}}">
  <div class="form-group"> @if($relation_id !=0) <a  style="cursor: pointer;position: absolute;
top: 16%;" onclick="delete_fb_question({{$relation_id}})"><i class="far fa-trash-alt"></i></a> @endif </div>
</div>
<?php } ?>
<div class="form-group">
  <input type="checkbox" name="comment_box"  class="custom-checkbox" id="comment_box" value="1"  @if(isset($fb_det->
  is_comment) && $fb_det->is_comment == 1){{ 'checked'}} @endif>
  <label class="custom-checkbox-label" for="comment_box"> Want to display comment box</label>
</div>
<div class="form-group">
  <input type="checkbox" name="rating"  id="rating" value="1" class="custom-checkbox" @if(isset($fb_det->
  is_rating) && $fb_det->is_rating == 1){{ 'checked'}} @endif>
  <label class="custom-checkbox-label" for="rating"> Want to display rating</label>
</div>
<div class="clearfix"></div>
<script type="text/javascript">
 
     $('#fb_questions').multiselect({
        columns: 1,
        placeholder: 'Choose Questions'
    });
    </script>
<style type="text/css">
      .add_qstn{
        position: absolute;
        right: -2%;
        top: 10%;
      }

    </style>