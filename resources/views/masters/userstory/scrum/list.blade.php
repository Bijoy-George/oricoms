<style>
.grid-container {
  display: grid;
  grid-auto-rows: 10px;
  grid-gap: 10px;
  background-color: #2196F3;
  padding: 10px;
}

</style>
<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
<div class="table-widget" >
  <table width="100%" id="leadsourcetypes_lists" class="table" >
    <thead>
      <tr>
        <th width="30" class="text-center">{{__('#')}}</th>
        <th>{{__('User Story')}}</th>
        <th>{{__('To Do')}}</th>
        <th>{{__('In Progress')}}</th>
        <th>{{__('Done')}}</th>
		  
      </tr>
    </thead>
    <tbody>
    
    @if(count($results)>0)
    @php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp 
    @foreach ($results as $scrum)
    
   
    <tr >
        <td class="text-center">{{$i++}}</td>
        <td ><strong>{{$scrum->title}}</strong></td>
		
		<td>
		<table>
		<tr>
		@foreach ($task_story as $tsk)
		@if($tsk->status == 1 && $tsk->userstory_id == $scrum->id)
		<td class="grid-container">{{ $tsk->task }}</td>
	    @endif
		@endforeach
		</tr>
		</table>
		</td>
		
		<td>
		<table>
		<tr>
		@foreach ($task_story as $tsk)
		@if($tsk->status == 2 && $tsk->userstory_id == $scrum->id)
		<td class="grid-container">{{ $tsk->task }}</td>
	    @endif
		@endforeach
		</tr>
		</table>
		</td>
		
        <td>
		<table>
		<tr>
		@foreach ($task_story as $tsk)
		@if($tsk->status == 3 && $tsk->userstory_id == $scrum->id)
		<td class="grid-container">{{ $tsk->task }}</td>
	    @endif
		@endforeach
		</tr>
		</table>
	    </td>
       
    </tr>
	
    @endforeach
    @else
    <tr >
      <td colspan="7" align="center">No Data Found</td>
    </tr>
    @endif
      </tbody>
    
  </table>
</div>
<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>
