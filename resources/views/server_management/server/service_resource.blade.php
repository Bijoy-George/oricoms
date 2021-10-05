@extends('layouts.listpage')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Project
@endsection
@section('content')
<div class="content-area">
  <div class="row justify-content-center">
    	<div class="col-sm-7 text-right"><a href="{{url('server')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-7 mt-3">
      <div class="widget">
        <div class="widget-content pt-3"> 





<div class="content-area">

    <div class="table-widget" >

    	<form action="/server_service" class="form-common" method="post">
	@csrf
      <table width="100%" id="querytype_lists" class="table">
      	
      	<b>{{ Form::label('DATE', 'DATE')}} </b>
      	<input type="text" name="date">
      	<b>{{ Form::label('TIME', 'TIME')}} </b>
      	<input type="text" name="time">
      	<input type="hidden" name="server_id" value="{{$id}}">
      	<div class="col-md-12">
        <b>Server Name :{{$server_name}} </b>
        </div>
        <thead>
                <tr>
										
					<th>{{__('Service names')}}</th>
					
					<!-- <th>{{__('Service Type')}}</th> -->
					<th>{{__('Status')}}</th>
				
				</tr>
                </thead>
                <tbody>	
					@if(count($services1)>0)
					<input type="hidden" name="services_count" value="{{count($services1)}}">
			<?php $i=0 ?><?php $p=0 ?>
			
					@foreach ($services1 as $res)

					<tr>
					
					<td><strong>{{$res->service_name}}</strong></td>

					
					<td>{{ Form::select('status'.$i++, ['' => 'Select Status'] + config('constant.service_status'),null,['id' => 'status', 'class' => 'form-control']) }}	</td>
					
					<span id ="description{{$res->id}}_err" class="error"></span></td>
					<input type="hidden" name="service_id{{$p++}}" value="{{$res->id}}">
					</tr>
					@endforeach
					@else
						<tr>
						<td colspan="25"><p class="text-center">No Data Found</p></td>
						</tr>
					@endif
				</tbody>

        </tbody>
      </table>
      <!--  -->
      <div class="content-area">
  <div class="row">


    <div class="col-sm-12">
      <div class="widget">
        <h2>{{__('System Resource Utlization')}}</h2>
        <div class="widget-content pt-3">  		
	<div class="row m-0">
        <div class="col-md-12"> <span class="response"></span>
            <div class="message"></div>
        </div>
        <!-- <input type="hidden" class="arg" value="1">
        <input type="hidden" class="error_callback" value="resource_error"> -->
		<input type="hidden" name="vendor_count" id="vendor_count" value="@if(isset($server_list)){{Helpers::get_contact_count($server_list->id)}}@else {{'1'}} @endif">
					
				<div class="col-md-4 form-group">
			<b>{{ Form::label('ip', 'Cpu')}} </b>
			{{ Form::label('ip', '%')}} 						
			{{ Form::text('resource1', null, array('class' => 'form-control','id' => 'resource1')) }}
			<span id ="resource1_err" class="error"></span>
			    </div>		        
				<div class="col-md-4 form-group">
			<b>{{ Form::label('ip', 'Ram')}} </b>
			{{ Form::label('ip', '%')}} 						
			{{ Form::text('resource2', null, array('class' => 'form-control','id' => 'resource2')) }}
			<span id ="resource2_err" class="error"></span>
			    </div>	   
            	<div class="field_wrapper col-12">
            		<div class="wrapper_remove">
             <div class="row md-12">		
				<div class="col-md-12 form-group">	
			<b>{{ Form::label('ip', 'Hard disk')}} </b>
				@if(isset($threshold_resource3))
					@foreach($threshold_resource3 as $resource)
					<?php $my_alphabet = strtoupper($resource['drive']);
					$number = ord(strtoupper($my_alphabet)) - ord('A') + 1;
					 ?>
					 <div class="col-md-1 form-group">
					 	{{ Form::label('drive', 'Drive')}} 
					<input type="text" name="inputs{{$number}}" value="{{$resource['drive']}}">
					<input type="hidden" name="size{{$number}}" value="{{$resource['tbgb']}}">
				</div>
					<div class="col-md-2 form-group">
					{{ Form::label('ip', 'Used ')}} 						
					<input type="text" name="used{{$number}}">{{$resource['tbgb']}}
					<span id ="used_err" class="error"></span>
				</div>
				<div class="col-md-2 form-group">
					{{ Form::label('total', 'Total')}} 
					<input type="text" name="total{{$number}}" value="{{$resource['total']}}">
					{{$resource['tbgb']}}
				</div>
					@endforeach
					@endif
			   
			 	
			
			    </div>
			   
			    </div>
            <div class= "row ml-1">
            	<!-- <div class="col-md-2">
            	
			    <a href="javascript:void(0);" class="add_button" title="Add field"><img style="width:20px;height:20px;" src="{{ URL::to('/') }}/img/add.png"/></a>
			</div> -->
			<!-- <div class="col-md-2">    
			    <a href="javascript:void(0);" class="remove_button" title="Remove field"><img style="width:20px;height:20px;" src="{{ URL::to('/') }}/img/remove.png"/></a>
			</div> -->
			<div>     
            </div>

			    </div> 

			 </div>
</div>
			   
	</div>    
	{{--NEW TAB STARTS--}}
	<div style="display:none;">
    <div class="col-md-12 form-group">
    {{ Form::label('server_credentials', 'Server Credentials')}}
	{{ Form::textarea('server_credentials', null, array('id' => 'server_credentials', 'class' => 'lang_trans tinymce form-control' )) }} <span id ="server_credentials_err" class="error"></span>							
	</div>				
	<div class="field_wrapper_projectmeta">				
	</div>
	</div>
	<div class="col-md-12 mb-3"></div>
					
	{{--NEW TAB ENDS--}}
					
	{{ Form::hidden('id', null, array('class' => 'form-control' )) }}
				
				</div>
    </div>
</div>
      <div class="col-md-12 form-group text-right">
					<input type="hidden" name="callback" class="callback" value="form_basic_reload" />

					<button type="reset" class="btn btn-outline-danger px-4" > {{__('Reset')}} </button>
					<button id="save_btn" type="submit" class="btn btn-primary px-4"> {{__('Save')}} </button>
				</div>
				</form>
    </div>
</div>

</div>
</div>
</div>
</div>
</div>

@endsection 
@section('footer-custom-css-js') 
<script src="{{ asset('js/tiny_mce/tiny_mce.js') }}"></script> 
<script src="{{ asset('js/tinymce.js') }}"></script> 
<script type="text/javascript" src="https://www.google.com/jsapi"></script> 
<script src="{{ asset('js/translation.js') }}"></script> 
<script type="text/javascript">
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
    var fieldHTML = '<div><div class="row ml-1">	<div class="col-md-4 form-group"><b>{{ Form::label('ip', 'Hard disk')}} </b>{{ Form::label('ip', 'Total (GB)')}}{{ Form::text('resource3[]', null, array('class' => 'form-control','id' => 'resource3')) }}<span id ="resource3_err" class="error"></span></div><div class="col-md-4 form-group">{{ Form::label('ip', 'Used (GB)')}}{{ Form::text('used[]', null, array('class' => 'form-control','id' => 'used')) }}	<span id ="used_err" class="error"></span> </div> <div class="col-md-4 form-group">{{ Form::label('ip', 'Remark')}}{{ Form::text('remarks3[]', null, array('class' => 'form-control','id' => 'remark3')) }}<span id ="remark3_err" class="error"></span></div></div><a href="javascript:void(0);" class="remove_button" title="Remove field"><img style="width:20px;height:20px;" src="{{ URL::to('/') }}/img/remove.png"/></a></div></div>'; //New input field html 
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
