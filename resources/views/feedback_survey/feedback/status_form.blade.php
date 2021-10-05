@php if(!empty($fb_questions)){
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
} @endphp
<div class="form-group">
                
          <label for="title" class="control-label">{{__('Status')}}<span class="red_star">*</span></label>
          <div class="dropdown-mul-2">
            <select   name="status_id[]" id="status_id" multiple placeholder="Select Status">
            @foreach($status as $st)
              <option value="{{$st->id}}">{{$st->name}}</option>
            @endforeach
            </select>
           
          </div>
       <span class="error" id="status_id_err"></span>
</div>

<div class="clearfix"></div><br>
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
<div class="row col-sm-12">
<label  for="name" class="col-md-4 control-label"></label> 
<div class="form-group col-sm-3">
   @if($i== 0)<label>{{__('English Questons')}} </label>@endif
</div>
<div class="form-group col-sm-3">
  @if($i== 0)<label>{{__('Malayalam Questions')}} </label>@endif
</div>
<div class="form-group">
 
</div>
</div>
<div class="row col-sm-12">
<label  for="name" class="col-md-4 control-label"></label> 
<div class="form-group col-sm-3">
   

     <select class="form-control" name="eng_q[]" id="eng_q{{$i}}" >
      <option value="0" >Select </option>
         @foreach($engquestions as $qstn)
        <option value="{{$qstn->id}}" @if($eng_question[$i] == $qstn->id) selected="selected" @endif >{{$qstn->questions}}</option>
        @endforeach
      </select>
      <span id="eng_q_err{{$i}}"></span> 

</div>
<div class="form-group col-sm-3">
     
     <select class="form-control" name="mal_q[]" id="mal_q{{$i}}" >
      <option value="0" >Select</option>
         @foreach($malaquestions as $qstn)
        <option value="{{$qstn->id}}" @if($mal_question[$i] == $qstn->id) selected="selected" @endif >{{$qstn->questions}}</option>
        @endforeach
      </select>
      <span id="mal_q_err{{$i}}"></span>

</div>
<?php if(isset($fb_questions[$i]['id']) && !empty($fb_questions[$i]['id']))
{
$relation_id=$fb_questions[$i]['id'];
}else{
$relation_id=0;
}?>
<input type="hidden" name="relation_id{{$i}}" class="form-control" value="{{$relation_id}}">
<div class="form-group">
@if($relation_id !=0)
<a  style="cursor: pointer;position: absolute;
top: 16%;" onclick="delete_fb_question({{$relation_id}})"><i class="far fa-trash-alt"></i></a>
@endif
</div>
</div> 
 <?php } ?>


<div class="clearfix"></div><br>
<div class="form-group">

          <label for="title" class="control-label">{{__('Action Time')}}<span class="red_star">*</span></label> 
          <div class="col-md-6 ">
          <input type="radio"  name="action"   id="action" value="1" @if(isset($fb_det->action_type) && $fb_det->action_type == 1){{ 'checked'}} @endif> Hour 
          <input  type="radio" name="action"  id="action" value="2" @if(isset($fb_det->action_type) && $fb_det->action_type == 2){{ 'checked'}} @endif> Minute <br>
          <span class="error" id="action_err"></span>
          @php if(isset($fb_det->action_type) && isset($fb_det->action_time)){ 
              if($fb_det->action_type ==1)
              {

                $minutes = $fb_det->action_time;
                $action_time = floor($minutes / 60);
                
                
              }else{
                $action_time=$fb_det->action_time;
              }
          }else{
            $action_time='';
          }@endphp
          <input type="text" name="action_time" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="4" class="form-control " id="action_time" value="{{$action_time}}" >
        <span class="error" id="action_time_err"></span> 
         </div>

</div>
<div class="clearfix"></div><br>  
<div class="form-group">
<label  for="name" class="col-md-4 control-label"></label> 
<div class="form-group col-sm-3">
                 <input type="checkbox" name="comment_box"  class="custom-checkbox" id="comment_box" value="1"  @if(isset($fb_det->is_comment) && $fb_det->is_comment == 1){{ 'checked'}} @elseif(!isset($fb_det->is_comment)){{ 'checked'}}  @endif>
                 <label class="custom-checkbox-label" for="comment_box"> Want to display comment box</label>

</div>
<div class="form-group col-sm-3">
                 <input type="checkbox" name="rating"  id="rating" value="1" class="custom-checkbox" @if(isset($fb_det->is_rating) && $fb_det->is_rating == 1){{ 'checked'}} @elseif(!isset($fb_det->is_rating)) {{ 'checked'}} @endif> 
                 <label class="custom-checkbox-label" for="rating"> Want to display rating</label> 

</div>
      
</div> 
<div class="clearfix"></div><br>
<script type="text/javascript">

    var sobj = JSON.parse('<?php echo $status_json;?>');

    $('.dropdown-mul-2').dropdown({
      data: sobj,
      limitCount: 4,
      input: '<input type="text" maxLength="20" placeholder="Search">'

    });
</script>   
   