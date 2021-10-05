

<style>
.listing-block {
    border: 1px solid #eee;
    padding: 10px !important;
    border-radius: 4px;
    margin-bottom: 5px;
}
.listing-block h3 {
    font-size: 20px;
    color: #2a3357;
    font-weight: 800;
    margin-bottom:0;
}
.row.single-block {
    margin: 0;
    background: #f5f5f5;
    padding: 10px 0;
    border-radius: 4px;
}
.single-block p {
    color: #666;
    font-size: 12px;
    margin: 0;
}
.single-block h4 {
    font-size: 16px;
    color: #333;
}
.row.single-block {
    margin: 0;
    background: #f5f5f5;
    padding: 15px 0px;
    border-radius: 4px;
    margin-bottom: 6px;
}
.listing-block h5 {
    font-size: 16px;
    margin-top: 10px;
    color: #666;
}
.listing-block  label{
    margin-bottom: 0;
}
.drivewrp {
    padding: 5px 10px 1px;
    background: #f5f5f5;
    border-radius: 5px;
margin-bottom:5px;
}
.dropdwn {
    margin-top: 10px;
}
.dropclk h3 {
    position: relative;
    cursor: pointer;
}
.dropclk h3::after {
    content: '';
    width: 8px;
    height: 8px;
    border-right: 1px solid #828080;
    border-bottom: 1px solid #828080;
    position: absolute;
    right: 3px;
    bottom: 9px;
    transform: rotate(45deg);
}
.drivewrp h5 {
    font-size: 13px;
    margin-bottom: 10px;
    margin-top: 4px;
    text-align: right;
}
</style>
<script>
$(document).ready(function() {
    $('.dropclk').click(function(){
        $(this).siblings('.dropdwn').slideToggle();
    });
});
</script>
<div class="content-area">
  <div class="row justify-content-center">
    


 


<!---repeat Start -->
            <!--<div class="listing-block p-3" >
                <div class="row dropclk">
                    <div class="col-12"><h3><i class="fas fa-server mr-2"></i> asdfssds</h3></div>
                </div>
                <div class="dropdwn" style="display:none;">
                <div class="row">

                    <div class="col-12 col-md-6">
                        <div class="row single-block">
                            <div class="col-12 col-md-12"><p>Service Type</p><h4>Task Sheduler</h4></div>
                            
                            <div class="col">
                                <label></label>
                              <select type="text" class="form-control"><option>Select</option></select>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-12"><h5>System Resource Utlization</h5></div>
                    <div class="col-12 col-md-6">
                        <label>CPU</label>
                        <div class="input-group mb-3">
                         <input type="text" class="form-control">
                          <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">%</span>
                          </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label>CPU</label>
                        <div class="input-group mb-3">
                         <input type="text" class="form-control">
                          <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">%</span>
                          </div>
                        </div>
                    </div>


                    <div class="col-12 col-md-3">
                        <div class="drivewrp">
                            <label>Drive B</label>
                            <div class="input-group mb-3">
                             <input type="text" placeholder="Used" class="form-control">
                              <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">/500</span>
                              </div>
                            </div>
                        </div>
                    </div>




                </div>
                </div>
            </div>-->
<!---repeat end -->













    <div class="col-sm-8 ">
      <div class="widget">
        <div class="widget-content pt-3"> 

<div class="content-area">

    <div class="table-widget" >

        <form action="/server_monitoring"  name="form-common" class="form-common" method="post">
    @csrf
    <input type="hidden" id="servers_count" name="server_count" value="{{count($permission)}}">
     <?php $s=1; $a=1; $v=1; $u=1?>
    @foreach($permission as  $res)
   
    <div class="listing-block">
        <div class="row dropclk">
                    <div class="col-12"><h3><i class="fas fa-server mr-2"></i>  {{$res['server_name']}}</h3></div>
                </div>
 
        <div class="dropdwn" id="para{{$u++}}" style="display: none;">
    <input type="hidden" name="server_id{{$s++}}" value="{{$res['id']}}">  
    <input type="hidden" name="service_count{{$a++}}" value="{{count($res['services1'])}}">
    <?php $i=0; ?><?php $p=0; $q=0;$r=0;?>

    @foreach($res['services1'] as $value)
    @if($value->service_flag == 1)
    <div class="row single-block">
    <div class="col-12 col-md-12"><h4>{{config('constant.service_flag')[$value->service_flag]}}</h4></div>
    @foreach($res['services1'] as $value)
    @if($value->service_flag == 1)
    <div class="col">
        <label>{{$value->service_name}} Status</label>
         <input type="hidden" name="service_id{{$res['id'].$p++}}" value="{{$value->id}}">
                <?php $server_check = Helpers::check_server($res['id']); ?>
    @if(!empty($server_check))
       <?php $service_helper = Helpers::service_status($res['id'],$value->id); ?>
      {{ Form::select('status'.$res['id'].$i++, [$service_helper[0]['service_status_no'] =>$service_helper[0]['service_status']] + config('constant.service_status'),null,['id' => 'status', 'class' => 'form-control']) }} 
      @else
      {{ Form::select('status'.$res['id'].$i++, ['1' => 'Running'] + config('constant.service_status'),null,['id' => 'status', 'class' => 'form-control']) }}
      @endif
    </div>
    
    @endif
    @endforeach
    </div>
    @break

    @endif
    @endforeach

    @foreach($res['services1'] as $value)
    @if($value->service_flag == 2)
       <div class="row single-block">
    <div class="col-12 col-md-12"><h4> {{config('constant.service_flag')[$value->service_flag]}}</h4></div>
    @foreach($res['services1'] as $value)
    @if($value->service_flag == 2)
    <div class="col">
        <label>{{$value->service_name}} Status</label>
         <input type="hidden" name="service_id{{$res['id'].$p++}}" value="{{$value->id}}">
          <?php $server_check = Helpers::check_server($res['id']); ?>
    @if(!empty($server_check))
       <?php $service_helper = Helpers::service_status($res['id'],$value->id); ?>
      {{ Form::select('status'.$res['id'].$i++, [$service_helper[0]['service_status_no'] => $service_helper[0]['service_status']] + config('constant.service_status'),null,['id' => 'status', 'class' => 'form-control']) }} 
      @else
      {{ Form::select('status'.$res['id'].$i++, ['1' => 'Running'] + config('constant.service_status'),null,['id' => 'status', 'class' => 'form-control']) }}  
      @endif
    </div>
    


    @endif
    @endforeach
    </div>
    @break
    
    @endif
    @endforeach
    @foreach($res['services1'] as $value)
    @if($value->service_flag == 3)
    <div class="row single-block">
    <div class="col-12 col-md-12"><h4> {{config('constant.service_flag')[$value->service_flag]}}</h4></div>
    @foreach($res['services1'] as $value)
    @if($value->service_flag == 3)
    <div class="col">
        <label>{{$value->service_name}} Status</label>
         <input type="hidden" name="service_id{{$res['id'].$p++}}" value="{{$value->id}}">
          <?php $server_check = Helpers::check_server($res['id']); ?>
    @if(!empty($server_check))
       <?php $service_helper = Helpers::service_status($res['id'],$value->id); ?>
      {{ Form::select('status'.$res['id'].$i++, [$service_helper[0]['service_status_no'] =>$service_helper[0]['service_status']] + config('constant.service_status'),null,['id' => 'status', 'class' => 'form-control']) }} 
      @else
      {{ Form::select('status'.$res['id'].$i++, ['1' => 'Running'] + config('constant.service_status'),null,['id' => 'status', 'class' => 'form-control']) }}  
      @endif
    </div>
    
    @endif
    @endforeach
    </div>
    @break
    
    @endif
    @endforeach

    @foreach($res['services1'] as $value)
    @if($value->service_flag == 4)
    <div class="row single-block">
    <div class="col-12 col-md-12"><h4> {{config('constant.service_flag')[$value->service_flag]}}</h4></div>
    @foreach($res['services1'] as $value)
    @if($value->service_flag == 4)
    <div class="col">
        <label>{{$value->service_name}} Status</label>
         <input type="hidden" name="service_id{{$res['id'].$p++}}" value="{{$value->id}}">
          <?php $server_check = Helpers::check_server($res['id']); ?>
    @if(!empty($server_check))
       <?php $service_helper = Helpers::service_status($res['id'],$value->id); ?>
      {{ Form::select('status'.$res['id'].$i++, [$service_helper[0]['service_status_no'] =>$service_helper[0]['service_status']] + config('constant.service_status'),null,['id' => 'status', 'class' => 'form-control']) }} 
      @else
      {{ Form::select('status'.$res['id'].$i++, ['1' => 'Running'] + config('constant.service_status'),null,['id' => 'status', 'class' => 'form-control']) }}  
      @endif
    </div>
    
    @endif
    @endforeach
    </div>
    @break
    
    @endif
    @endforeach

    @foreach($res['services1'] as $value)
    @if($value->service_flag == 5)
    
    <div class="row single-block">
    <div class="col-12 col-md-12"><h4> {{config('constant.service_flag')[$value->service_flag]}}</h4></div>
    @foreach($res['services1'] as $value)
    @if($value->service_flag == 5)
    <div class="col">
        <label>{{$value->service_name}} Status</label>
         <input type="hidden" name="service_id{{$res['id'].$p++}}" value="{{$value->id}}">
          <?php $server_check = Helpers::check_server($res['id']); ?>
    @if(!empty($server_check))
       <?php $service_helper = Helpers::service_status($res['id'],$value->id); ?>
      {{ Form::select('status'.$res['id'].$i++, [$service_helper[0]['service_status_no'] =>$service_helper[0]['service_status']] + config('constant.service_status'),null,['id' => 'status', 'class' => 'form-control']) }} 
      @else
      {{ Form::select('status'.$res['id'].$i++, ['1' => 'Running'] + config('constant.service_status'),null,['id' => 'status', 'class' => 'form-control']) }} 
      @endif 
    </div>
    
    @endif
    @endforeach
     </div>
    @break
   
    @endif
    @endforeach

    @foreach($res['services1'] as $value)
    @if($value->service_flag == 6)
    <div class="row single-block">
    <div class="col-12 col-md-12"><h4> {{config('constant.service_flag')[$value->service_flag]}}</h4></div>
    @foreach($res['services1'] as $value)
    @if($value->service_flag == 6)
    <div class="col">
        <label>{{$value->service_name}} Status</label>
         <input type="hidden" name="service_id{{$res['id'].$p++}}" value="{{$value->id}}">
          <?php $server_check = Helpers::check_server($res['id']); ?>
    @if(!empty($server_check))
       <?php $service_helper = Helpers::service_status($res['id'],$value->id); ?>
      {{ Form::select('status'.$res['id'].$i++, [$service_helper[0]['service_status_no'] =>$service_helper[0]['service_status']] + config('constant.service_status'),null,['id' => 'status', 'class' => 'form-control']) }} 
      @else
      {{ Form::select('status'.$res['id'].$i++, ['1' => 'Running'] + config('constant.service_status'),null,['id' => 'status', 'class' => 'form-control']) }} 
      @endif 
    </div>
    
    @endif
    @endforeach
    </div>
    @break
    
    @endif
    @endforeach
    @foreach($res['services1'] as $value)
    @if($value->service_flag == 7)
    <div class="row single-block">
    <div class="col-12 col-md-12"><h4> {{config('constant.service_flag')[$value->service_flag]}}</h4></div>
    @foreach($res['services1'] as $value)
    @if($value->service_flag == 7)
    <div class="col">
        <label>{{$value->service_name}} Status</label>
         <input type="hidden" name="service_id{{$res['id'].$p++}}" value="{{$value->id}}">
          <?php $server_check = Helpers::check_server($res['id']); ?>
    @if(!empty($server_check))
       <?php $service_helper = Helpers::service_status($res['id'],$value->id); ?>
      {{ Form::select('status'.$res['id'].$i++, [$service_helper[0]['service_status_no'] =>$service_helper[0]['service_status']] + config('constant.service_status'),null,['id' => 'status', 'class' => 'form-control']) }} 
      @else
      {{ Form::select('status'.$res['id'].$i++, ['1' => 'Running'] + config('constant.service_status'),null,['id' => 'status', 'class' => 'form-control']) }}  
      @endif
    </div>
    
    @endif
    @endforeach
    </div>
    @break
    
    @endif
    @endforeach
    @foreach($res['services1'] as $value)
    @if($value->service_flag == 8)
    <div class="row single-block">
    <div class="col-12 col-md-12"><h4> {{config('constant.service_flag')[$value->service_flag]}}</h4></div>
    @foreach($res['services1'] as $value)
    @if($value->service_flag == 8)
    <div class="col">
        <label>{{$value->service_name}} Status</label>
         <input type="hidden" name="service_id{{$res['id'].$p++}}" value="{{$value->id}}">
          <?php $server_check = Helpers::check_server($res['id']); ?>
    @if(!empty($server_check))
       <?php $service_helper = Helpers::service_status($res['id'],$value->id); ?>
      {{ Form::select('status'.$res['id'].$i++, [$service_helper[0]['service_status_no'] =>$service_helper[0]['service_status']] + config('constant.service_status'),null,['id' => 'status', 'class' => 'form-control']) }} 
      @else
      {{ Form::select('status'.$res['id'].$i++, ['1' => 'Running'] + config('constant.service_status'),null,['id' => 'status', 'class' => 'form-control']) }}  
      @endif
    </div>
    
    @endif
    @endforeach
    </div>
    @break
    
    @endif
    @endforeach
    <div class="row">
    <div class="col-sm-12">
      
        <h5>System Resource Utlization</h5>

    </div>
    <div class="col-12 col-md-6">
            <label>{{ Form::label('ip', 'Cpu')}}</label>
            <div class="input-group mb-3">
                  <?php $server_check = Helpers::check_server($res['id']); ?>
            @if(!empty($server_check))
               <?php $cpu = Helpers::server_cpu($res['id']); ?>
              <input type="text" name="resource1{{$res['id']}}" id="resource1" class="form-control" value="{{$cpu}}">
              @else 
             {{ Form::text('resource1'.$res['id'], null, array('class' => 'form-control','id' => 'resource1')) }}
             @endif
             <span id ="resource1{{$res['id']}}_err" class="error"></span>
              <div class="input-group-append">
                <span class="input-group-text">{{ Form::label('ip', '%')}}</span>
              </div>
            </div>
            <span id ="resource1_err" class="error"></span>
        </div>

        <div class="col-12 col-md-6">
            <label>{{ Form::label('ip', 'Ram')}}</label>
            <div class="input-group mb-3">
                  <?php $server_check = Helpers::check_server($res['id']); ?>
            @if(!empty($server_check))
               <?php $ram = Helpers::server_ram($res['id']); ?>
              <input type="text" name="resource2{{$res['id']}}" id="resource2" class="form-control" value="{{$ram}}">
              @else 
             {{ Form::text('resource2'.$res['id'], null, array('class' => 'form-control','id' => 'resource2')) }}
             @endif
              <span id ="resource2{{$res['id']}}_err" class="error"></span>
              <div class="input-group-append">
                <span class="input-group-text">{{ Form::label('ip', '%')}}</span>
              </div>
            </div>
            <span id ="resource2_err" class="error"></span>
        </div>
                     
                
               <?php $threshold_resource31 = $res['threshold_resource3']; ?>
               @if(!empty($threshold_resource31))
              <?php $threshold_resource3 =unserialize($threshold_resource31); ?>
               @endif
               @if(!empty($threshold_resource3))
               <?php $server_check = Helpers::check_server($res['id']); ?>
                @if(!empty($server_check))
                <?php $hdd = Helpers::hdd_used($res['id']); ?>
                 @foreach($hdd as $hdd_used)
                 <?php $my_alphabet = strtoupper($hdd_used['drive']);
                    $number = ord(strtoupper($my_alphabet)) - ord('A') + 1;
                     ?>
                    <div class="col-12 col-md-4">
                    <div class="drivewrp">
                    <label> {{ Form::label('drive', 'Drive')}}  <b> {{$hdd_used['drive']}}</b></label>           
                    <input type="hidden" name="inputs{{$res['id'].$number}}" value="{{$hdd_used['drive']}}">
                    <input type="hidden" name="size{{$res['id'].$number}}" value="{{$hdd_used['size']}}">
                    <div class="input-group ">
                <input type="text" name="used{{$res['id'].$number}}"  class="form-control" value="{{$hdd_used['used']}}">
                <span id ="used{{$res['id'].$number}}_err" class="error"></span>
                <div class="input-group-append">
                <span class="input-group-text">{{$hdd_used['size']}}</span>
                <input type="hidden" name="total{{$res['id'].$number}}" value="{{$hdd_used['total']}}">
                </div>
                </div>
                <h5>Total : <b>{{$hdd_used['total']}} {{$hdd_used['size']}}</b></h5>
                <span id ="used_err" class="error"></span>
                </div>
                </div>
                 @endforeach
                 @else 
               @foreach($threshold_resource3 as $resource)
              
              <?php $my_alphabet = strtoupper($resource['drive']);
                    $number = ord(strtoupper($my_alphabet)) - ord('A') + 1;
                     ?>

                     <div class="col-12 col-md-4">
                        <div class="drivewrp">
                            <label> {{ Form::label('drive', 'Drive')}}  <b> {{$resource['drive']}}</b></label>
                           
                    <input type="hidden" name="inputs{{$res['id'].$number}}" value="{{$resource['drive']}}">
                    <input type="hidden" name="size{{$res['id'].$number}}" value="{{$resource['tbgb']}}">

                            <div class="input-group ">

                             <input type="text" placeholder="Used" class="form-control" name="used{{$res['id'].$number}}">
                            
                              <span id ="used{{$res['id'].$number}}_err" class="error"></span>
                              <div class="input-group-append">
                                <span class="input-group-text">{{$resource['tbgb']}}</span>
                                 <input type="hidden" name="total{{$res['id'].$number}}" value="{{$resource['total']}}">
                                 
                              </div>
                            </div>
                            <h5>Total : <b>{{$resource['total']}} {{$resource['tbgb']}}</b></h5>
                            
                            <span id ="used_err" class="error"></span>
                        </div>
                    </div>
               
               @endforeach
                @endif
               @endif


             
    </div>
    <button type="button" id="hide" class="btn btn-primary px-4 mb-3"  aria-hidden="true">Save</button>  

         
     </div>
         

    </div>

    @endforeach
    
     
               
                
            
              
    
      <div class="col-md-12 form-group text-center mt-3">
                    <input type="hidden" name="callback" class="callback" value="form_basic_reload" />

                    <button type="reset" class="btn btn-danger px-4" > {{__('Reset')}} </button>
                    <button id="save_btn" type="submit" class="btn btn-primary px-4"> {{__('FinishMonitoring')}} </button>
                </div>
                </form>
    </div>
</div>

</div>
</div>
</div>
</div>
</div>


@section('footer-custom-css-js') 
<script src="{{ asset('js/tiny_mce/tiny_mce.js') }}"></script> 
<script src="{{ asset('js/tinymce.js') }}"></script> 
<script type="text/javascript" src="https://www.google.com/jsapi"></script> 
<script src="{{ asset('js/translation.js') }}"></script> 
<script type="text/javascript">

  $(document).on('click', '#hide', function () {
 
    
    $(this).parent('div').fadeOut();

});
    function service_details(id)
    {
        var url = $("#base_url").val();
        var server_id = $("#server_id").val();
        $.ajax({
       type: "POST",
       url:  url + '/service_edit',
       data: {
         "id": id,
         "server_id": server_id,
       },    
        success: function (data) {
            var response = JSON.parse(data);
            $("#service_name_wrapper").empty().html(response.services1);
            $("#server_id_wrapp").empty().val(response.server_id);
            $("#service_id_wrapp").empty().val(response.service_id);
            $("#service_details_wrapper").show();
        }
    });
    }
</script>
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 6; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><div class="row ml-1">    <div class="col-md-4 form-group"><b>{{ Form::label('ip', 'Hard disk')}} </b>{{ Form::label('ip', 'Total (GB)')}}{{ Form::text('resource3[]', null, array('class' => 'form-control','id' => 'resource3')) }}<span id ="resource3_err" class="error"></span></div><div class="col-md-4 form-group">{{ Form::label('ip', 'Used (GB)')}}{{ Form::text('used[]', null, array('class' => 'form-control','id' => 'used')) }}   <span id ="used_err" class="error"></span> </div> <div class="col-md-4 form-group">{{ Form::label('ip', 'Remark')}}{{ Form::text('remarks3[]', null, array('class' => 'form-control','id' => 'remark3')) }}<span id ="remark3_err" class="error"></span></div></div><a href="javascript:void(0);" class="remove_button" title="Remove field"><img style="width:20px;height:20px;" src="{{ URL::to('/') }}/img/remove.png"/></a></div></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});

function resource_error(data,data1,data2)
{
    console.log(data);
    console.log(data1);
    console.log(data2);
}



</script>
@endsection
