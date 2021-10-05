<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
    

<div class="row">
    <div class='col-6'>

    <div class="table-widget" >	
    	<b>QA Servers</b>
      <table width="50%" id="querytype_lists" class="table">
        <thead>
                <tr>
					<th width="30" class="text-center">{{__('#')}}</th>					
					<th>{{__('Server Name')}}</th>
					<th>{{__('Server Ip')}}</th>
					<th>{{__('Description')}}</th>
					<th class="text-center">{{__('Action')}}</th>
				</tr>
                </thead>
                <tbody>
					
					@if(count($results)>0)
					@php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp 
					@foreach ($results as $res)
					@if($res->stage==1)
					<div >
					<tr>
					<td class="text-center">{{$i++}}</td>
					
					<input type="hidden" name="server_id" value="{{$res->id}}" id="server_id">
					
						<td>{{$res->server_name}}</td>
						<!-- <td id="server{{$res->id}}"> -->
					<!-- <a href="{{url('/server_details1',$res->id)}}" title="Service and Resource List">{{$res->server_name}}</a></td> -->
					<!-- <td id="server_server" onclick="server_detailss({{$res->id}})">{{$res->server_name}}</a></td> -->
				</div>
					<td>{{$res->server_ip}}</td>
					<td>{{Helpers::remove_p_tag($res->description)}}
						</td>
					<td class="text-center" >
					@if( Helpers::checkPermission('server edit'))
					<a href="{{route('server.edit', $res->id)}}"  class="btn btn-outline-secondary btn-sm" title="Server Edit"><i class="far fa-edit"></i></a>
					@endif
					<a href="javascript:void(0)" title="Delete" onclick="deletePop('server/' + {{ $res->id }})" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a>
				   <!--  <a href="{{url('/service_edit',$res->id)}}"  class="btn btn-outline-secondary btn-sm" title="Resource service Add"><i class="fa fa-plus"></i></a> -->
                   <!--  <a href="{{url('/server_details1',$res->id)}}"  class="btn btn-outline-secondary btn-sm" title="Service and Resource List"><i class="fa fa-list"></i></a> -->
				 </td>
					</tr>
					
					@endif
					@endforeach
					@else
						<tr>
						<td colspan="25"><p class="text-center">No Data Found</p></td>
						</tr>
					@endif
				</tbody>
        </tbody>
      </table>
    </div>
</div>
<div class="col-6">
	<div class="table-widget" >
		<b>Production Servers</b>
<table width="50%" id="querytype_lists" class="table">
        <thead>
                <tr>
					<th width="30" class="text-center">{{__('#')}}</th>					
					<th>{{__('Server Name')}}</th>
					<th>{{__('Server Ip')}}</th>
					<th>{{__('Description')}}</th>
					<th class="text-center">{{__('Action')}}</th>
				</tr>
                </thead>
                <tbody>
					
					@if(count($results)>0)
					@php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp 
					@foreach ($results as $res)
					@if($res->stage==2)
					<div >
					<tr>
					<td class="text-center">{{$i++}}</td>
					
					<input type="hidden" name="server_id" value="{{$res->id}}" id="server_id">
					<td>{{$res->server_name}}</td>
					<!-- <td id="server{{$res->id}}">
					<a href="{{url('/server_details1',$res->id)}}" title="Service and Resource List">{{$res->server_name}}</a></td> -->
					<!-- <td id="server_server" onclick="server_detailss({{$res->id}})">{{$res->server_name}}</a></td> -->
				</div>
					<td>{{$res->server_ip}}</td>
					<td>{{Helpers::remove_p_tag($res->description)}}
						</td>
					<td class="text-center" >
					@if( Helpers::checkPermission('server edit'))
					<a href="{{route('server.edit', $res->id)}}"  class="btn btn-outline-secondary btn-sm" title="Server Edit"><i class="far fa-edit"></i></a>
					@endif
					<a href="javascript:void(0)" title="Delete" onclick="deletePop('server/' + {{ $res->id }})" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a>
				    <!-- <a href="{{url('/service_edit',$res->id)}}"  class="btn btn-outline-secondary btn-sm" title="Resource service Add"><i class="fa fa-plus"></i></a> -->
                    <!-- <a href="{{url('/server_details1',$res->id)}}"  class="btn btn-outline-secondary btn-sm" title="Service and Resource List"><i class="fa fa-list"></i></a> -->
				 </td>
					</tr>
					
					@endif
					@endforeach
					@else
						<tr>
						<td colspan="25"><p class="text-center">No Data Found</p></td>
						</tr>
					@endif
				</tbody>
        </tbody>
      </table>   
      </div>
    </div>   
<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>
