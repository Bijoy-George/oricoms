<html>
<head></head>
<body>
<style>
	td, th{
		border: 1px solid #d7d7d7;
		text-align: left;
	}
	table, td{
		border-collapse: collapse;
		text-align: left;
	}
	.blocktd {
		padding: 5px;
	}
	th.blocktd {
		background: #f5f5f5;
	}
	.auto_table1 td{
		width:200px;
	}
	.auto_table2 td{
		width:200px;
	}
	.auto_table3 td{
		width:200px;
	}
</style>

<!-------------------------------->
<table cellpadding="0" cellspacing="0" style="width:100%;">
  <thead>
    <tr>
      <th class="blocktd" width="100px">Server</th>
      <th class="blocktd" width="100px">Resourse</th>
     <!-- <th class="blocktd" width="100px">Components</th>
      <th class="blocktd" width="100px">t1</th>
      <th class="blocktd" width="100px">t2</th>-->

    </tr>
  </thead>
  
   
  <tbody>

@if(count($servers) > 0)
@foreach($servers as $data)

<tr>
<td>{{$data->server_name}}</td>
<td> 
<?php $service_array = unserialize($data->service);$date = '2020-04-16';
$serv_flag_arr = Helpers::get_service_types($service_array);//echo "<pre>";print_r($serv_flag_arr);
/*foreach($service_array as $sdata)
{
	echo $sdata.'<br>';
}*/
if(count($serv_flag_arr)>0)
{
	foreach($serv_flag_arr as $flg_val)
	{ ?>
	<table class="auto_table1">
	<tr>
	<td><?php  echo config('constant.service_flag')[$flg_val->service_flag];   ?></td>
	<td>
		<table class="auto_table2">
		<?php foreach($service_array as $sdata){ ?>
		@php $check_val = Helpers::get_service_flag($sdata)  @endphp
		@if($check_val == $flg_val->service_flag)
			<tr>
			<td><?php echo Helpers::service_name($sdata);  ?></td>
			@if(count($time_arr)>0)
				@foreach($time_arr as $t_arr)
					<td>
					@php $status = Helpers::get_daily_report_status($data->id,$sdata,$t_arr->time) @endphp
					@if($status == 1)
					{{'Running'}}
				@elseif($status == 2)
				{{'Stopped'}}
			@else
			{{'--'}}
			@endif
					</td>
				@endforeach
			@endif
			</tr>
		@endif
		<?php }  ?>
		</table>
	</td>
	</tr>
	
	</table>
		
	<?php } ?>
	<table class="auto_table3">
	<tr>
	<td>CPU</td><td>#################</</td>
	
			@if(count($time_arr)>0)
				@foreach($time_arr as $t_arr)
					<td>
					@php $resource1 = Helpers::get_daily_report_resourcestatus($data->id,1,$t_arr->time) @endphp
					{{$resource1}}
					</td>
				@endforeach
			@endif
			
	</tr>
	<tr>
	<td>RAM</td><td>#####################</td>
			@if(count($time_arr)>0)
				@foreach($time_arr as $t_arr)
					<td>
					@php $resource2 = Helpers::get_daily_report_resourcestatus($data->id,2,$t_arr->time) @endphp
					{{$resource1}}
					</td>
				@endforeach
			@endif
	</tr>
	<tr>
	<td>HDD</td>
	<td>@php $resource3 = Helpers::get_daily_report_resourcestatus($data->id,3,$t_arr->time) @endphp
	<?php if($resource3 != '-') 
	{ 
		$hdd_arr = unserialize($resource3);
		if(count($hdd_arr)>0)
		{ ?>
	<table>
	<?php
			foreach($hdd_arr as $h_arr)
			{ ?>
				<tr>
				<td><?php  echo $h_arr['drive'];  ?></td>
				</tr>
			<?php } ?>
	</table>
		<?php } 
	} ?>
	</td>
			@if(count($time_arr)>0)
				@foreach($time_arr as $t_arr)
					<td>
					
					<?php if($resource3 != '-') 
					{ 
						$hdd_arr = unserialize($resource3);
						if(count($hdd_arr)>0)
						{ ?>
							<table>
	<?php
			foreach($hdd_arr as $h_arr)
			{ ?>
				<tr>
				<td><?php  echo $h_arr['used'].'/'.$h_arr['total'];  ?></td>
				</tr>
			<?php } ?>
	</table>
				<?php		} 
					} ?>
					</td>
				@endforeach
			@endif
	
	</tr>
	</table>
<?php	
}
?>
</td>

</tr>
@endforeach

@endif

  </tbody>
  
</table>

<!-------------------------------->

</body>
</html>