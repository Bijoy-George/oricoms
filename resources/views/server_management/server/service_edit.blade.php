

<!------------------style ------------------------- -->

<style>

table,th,td{

		border:1px solid black;
		text-align: center;

}

th{

	font-weight: bold;
}
</style>

<!-----------------style end------------------- -->


<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right"><a href="{{url('server')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a>&nbsp;&nbsp;  <a title="File Export" href="#" class="btn btn-outline-info ml-1"  onclick="exportserverreport();"><i class="fas fa-file-import"></i></a></div>
    <div class="col-sm-12">
      <div class="widget">
        <h2>{{$services[0]->server_name}}</h2>
        <div class="widget-content pt-3">  
				
				<div class="row m-0 align-items-center">
				<div class="col-md-12"> <span class="response"></span>
				<div class="message"></div>
				
				<div id="copy_user" class="profile-center">
				<nav>
					<div class="nav nav-tabs" id="nav-tab" role="tablist">      
						<a class="nav-item nav-link active show" id="nav-profile-tab" data-toggle="tab" href="#basic_details" role="tab" aria-controls="basic-prof" aria-selected="false">Services</a>
						 
						<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#communication" role="tab" aria-controls="basic-prof" aria-selected="true">Resources</a> 
						
		
						
					</div>
				</nav>


				<div class="tab-content mb-3" id="nav-tabContent">             		
					<div class="tab-pane fade box-shadow active show" id="basic_details" role="tabpanel" aria-labelledby="nav-profile-tab">       
						                
							<!--  -->
							<table  width="100%" id="querytype_lists">
        <thead >
                <tr>
					<th  width="30" class="text-center">{{__('#')}}</th>					
					<th>{{__('Service Name')}}</th>
					<th>{{__('status')}}</th>	
					<th>{{__('Created at')}}</th>
					<th>{{__('Action')}}</th>
				</tr>
                </thead>
                <tbody>
					
					@if(isset($service_details))
					@php $i = ($service_details->currentpage()-1) * $service_details->perpage() +  1; @endphp
					
					@foreach ($service_details as $res)
					<tr>
					<td class="text-center">{{$i++}}</td>
					<td>{{$res->getservices->service_name}}</td>
					<td>{{config('constant.service_status')[$res->status] ?? ''}}</td>
					<td>{{$res->created_at}}</td>
					<td><a href="javascript:void(0)" title="Delete" onclick="deletePop('/service_resource_delete/'+{{$res->server_resource_id}},'','','','Services and Resources will be deleted ,Are you sure want to delete ?')" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a></td>
					</tr>

					
					</div>
					@endforeach
					@else
						<tr>
						<td colspan="25"><p class="text-center">No Data Found</p></td>
						</tr>
					@endif
				</tbody>
        
      </table>
							<div class="col-md-12 text-right">
								<p>&nbsp;</p>
							</div>
							<div class="d-flex justify-content-end first"> {{ $service_details->render() }}</div>
						
					</div>

					<div class="tab-pane fade box-shadow" id="communication" role="tabpanel" aria-labelledby="nav-profile-tab">       
						<div class="row row-eq-height">  
						<!--  -->

						<table width="100%" id="querytype_lists">
        <thead>
                <tr>
					<th rowspan="2" width="30" class="text-center">{{__('#')}}</th>					
					<th rowspan="2">{{__('Cpu')}}</th>
					<th rowspan="2">{{__('Ram')}}</th>

					<th colspan="2">{{__('Hard disk C')}}</th>
					<th colspan="2">{{__('Hard disk D')}}</th>
					<th colspan="2">{{__('Hard disk E')}}</th>
					<th colspan="2">{{__('Hard disk F')}}</th>
					<th colspan="2">{{__('Hard disk G')}}</th>
					<th colspan="2">{{__('Hard disk H')}}</th>

					<th rowspan="2">{{__('status')}}</th>	
					<th rowspan="2">{{__('Created at')}}</th>
				</tr>

				<tr>
					<td>{{__('Total')}}</td>
					<td>{{__('Used')}}</td>

					<td>{{__('Total')}}</td>
					<td>{{__('Used')}}</td>

					<td>{{__('Total')}}</td>
					<td>{{__('Used')}}</td>

					<td>{{__('Total')}}</td>
					<td>{{__('Used')}}</td>

					<td>{{__('Total')}}</td>
					<td>{{__('Used')}}</td>

					<td>{{__('Total')}}</td>
					<td>{{__('Used')}}</td>
				</tr>

                </thead>

                <tbody>
                	@if(count($server_resource)>0)
					@php $i = ($server_resource->currentpage()-1) * $server_resource->perpage() +  1; @endphp 
					@foreach ($server_resource as $res)
                	<tr>
                		<td class="text-center">{{$i++}}</td>
						<td>{{$res->resource1}}</td>
						<td>{{$res->resource2}}</td>
						<?php $resources3 = (unserialize($res->resource3));?>
                		<!--1 hd-->
                		<td>{{$resources3[0]['total'] ?? ''}}</td>
						<td>{{$resources3[0]['used']  ?? '' }}</td>

                		<!--2 hd-->
                		<td>{{$resources3[1]['total']  ?? ''}}</td>
						<td>{{$resources3[1]['used']  ?? '' }}</td>

                		<!--3 hd-->
                		<td>{{$resources3[2]['total']  ?? ''}}</td>
						<td>{{$resources3[2]['used']  ?? '' }}</td>

                		<!--4 hd-->
                		<td>{{$resources3[3]['total']  ?? ''}}</td>
						<td>{{$resources3[3]['used']  ?? '' }}</td>

                		<!--5 hd-->
                		<td>{{$resources3[4]['total']  ?? ''}}</td>
						<td>{{$resources3[4]['used']  ?? '' }}</td>

                		<!--6 hd-->
                		<td>{{$resources3[5]['total']  ?? ''}}</td>
						<td>{{$resources3[5]['used']  ?? '' }}</td>

                		<td>{{config('constant.service_status')[$res->status] ?? ''}}</td>

						<td>{{$res->created_at}}</td>

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
      
						</div>
<div class="d-flex justify-content-end first"> {{ $server_resource->render() }}</div>	
					</div>
		
				</div>
				
			</div>
					
					
					
					
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	
	$(document).ready(function () {
		var tabid=$('#tabid').val();
		
		if(tabid == 'communication')
		{
			$('.nav-tabs a[href="#communication"]').tab('show');
		}else (tabid == 'mail_server')
		{
			$('.nav-tabs a[href="#mail_server"]').tab('show');
		}
		
    });
</script>
