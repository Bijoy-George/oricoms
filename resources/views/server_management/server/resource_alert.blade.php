@extends('layouts.listpage')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Project
@endsection
@section('content')

<div class="col-md-12 p-2">
  <div class="widget">

    <h2>Server Resource Alert<a class="help-tooltip" data-toggle="tooltip" data-placement="top" title="Shows top most country wise customer registration count"></h2>

    <div class="widget-content" id="container-country-registration" data-highcharts-chart="3" role="region" aria-label="Chart. Highcharts interactive chart." aria-hidden="false" style="overflow: hidden;">
  
<table class="table table-bordered">
  <thead>
        <tr>
          <th rowspan="2" style="border-bottom:none;" width="30" class="text-center">{{__('#')}}</th>         
          <th rowspan="2" class="text-center" style="border-bottom:none;">{{__('Server Name')}}</th>
          <th colspan="6" class="text-center">{{__('Resources')}}</th>
          <!-- <th style="border-bottom:none;">{{__('Increased')}}</th>
          <th style="border-bottom:none;">{{__('Threshold_value')}}</th> -->
          <th rowspan="2" class="text-center" style="border-bottom:none;">{{__('Time')}}</th>
        </tr>
        <tr>
          <th colspan="2" class="text-center">CPU</th>         
          <th colspan="2" class="text-center">RAM</th>
          
          
          <th colspan="2" class="text-center">Hard Disk</th>
          <!-- <th style="border-top:none;"></th>
          <th></th>
          <th style="border-top:none;"></th> -->
          <!-- <th></th> -->
          <!-- <th style="border-top:none;"></th> -->
          
        </tr>
        <tr>
          <th></th>
          <th></th>
          <th class="text-center">Used(GB)</th>
          <th class="text-center">Threshold(GB)</th>
          <th class="text-center">Used(GB)</th>
          <th class="text-center">Threshold(GB)</th>
          <th class="text-center">Used(GB)</th>
          <th class="text-center">Threshold(GB)</th>
          <th></th>

        </tr>

         @if(count($resource)>0)
          @php $i = ($resource->currentpage()-1) * $resource->perpage() +  1; @endphp 

          @foreach ($resource as $res)
          <?php $resources3 = (unserialize($res->resource3)); ?>
          @if(($res->resource1 > 
          
          $res->getresources->threshold_resource1)||($res->resource2 > $res->getresources->threshold_resource2)||($resources3[0]['used']>$res->getresources->threshold_resource3))
        <tr>
          <th>{{$i++}}</th>
          <th>{{$res->getresources->server_name}}</th>
          
          <th> @if($res->resource1 > $res->getresources->threshold_resource1){{$res->resource1}} @endif </th>
          <th>@if($res->resource1 > $res->getresources->threshold_resource1) {{$res->getresources->threshold_resource1}} @endif</th>
          
          
          <th>@if($res->resource2 > $res->getresources->threshold_resource2)  {{$res->resource2}} @endif </th>
          <th>@if($res->resource2 > $res->getresources->threshold_resource2){{$res->getresources->threshold_resource2}} @endif</th>
          

          
          <th>@if($resources3[0]['used']>$res->getresources->threshold_resource3) {{$resources3[0]['used']}} @endif</th>
          <th>@if($resources3[0]['used']>$res->getresources->threshold_resource3){{$res->getresources->threshold_resource3}} @endif</th>
          
          <!-- <th>{{'4'}}</th>  
          <th>{{'4'}}</th>  --> 
          
          
          
          <th>{{$res->created_at}}</th> 
        </tr>  
        @endif
        @endforeach
          @else
          <tr>
            <td colspan="8"><p class="text-center">No Data Found</p></td>
            </tr>
            @endif
                </thead>
                <tbody>
      </table>
   </div>
</div>
</div>




@endsection
