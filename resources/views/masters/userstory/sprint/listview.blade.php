<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
<div class="table-widget" >
  <table width="100%" id="leadsourcetypes_lists" class="table">
    <thead>
      <tr>
        <th width="30" class="text-center">{{__('#')}}</th>
        <th>{{__('Title')}}</th>
        <th>{{__('Project')}}</th>
        <th>{{__('Goal')}}</th>
        <th>{{__('Due Date')}}</th>
        <th>{{__('Created')}}</th>
		    <th class="text-center">{{__('Action')}}</th>
      </tr>
    </thead>
    <tbody>
    
    @if(count($results)>0)
    @php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp 
    @foreach ($results as $sprint)
   
    <tr>
        <td class="text-center">{{$i++}}</td>
        <td><strong>{{$sprint->name}}</strong></td>
        <td><strong>{{$project_name}}</strong></td>
       
        <td>{{$sprint->goal}}</td>
		@php $duedate = $sprint->duedate ?? NULL @endphp
        @php $duedate = \Carbon\Carbon::parse($duedate)->format('d/m/y') @endphp
        <td>{{$duedate}}</td>
		   
        @php $created_date = $sprint->created_at ?? NULL @endphp
        @php $created = \Carbon\Carbon::parse($created_date)->format('d/m/y') @endphp
        <td>{{$created}}</td>
        <td class="text-center" >
		<a href="{{url('userstoryList')}}/{{$sprint->project_id}}/{{$sprint->id}}" title="Userstory List" class="btn btn-outline-success"><i class="fa fa fa-list"></i></a>
		<a href="{{url('addUserstory')}}/{{$sprint->project_id}}/{{$sprint->id}}" title="Add Userstory" class="btn btn-outline-warning"><i class="fa fa-puzzle-piece"></i></a>
		<a href="{{url('editSprint')}}/{{$sprint->id}}" title="Edit Details" class="btn btn-outline-primary"><i class="fa fa-edit"></i></a> 
		<a href="javascript:void(0)" title="Delete" onclick="deletePop('userstory/' + {{ $sprint->id }})" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a> 
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
