<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
<div class="table-widget" >
  <table width="100%" id="leadsourcetypes_lists" class="table">
    <thead>
      <tr>
        <th width="30" class="text-center">{{__('#')}}</th>
        <th>{{__('Title')}}</th>
        <th>{{__('Priority')}}</th>
        <th>{{__('Estimation')}}(Hr)</th>
        <th>{{__('User')}}</th>
		    <th>{{__('Project')}}</th>
        <th>{{__('Created')}}</th>
		    <th class="text-center">{{__('Action')}}</th>
      </tr>
    </thead>
    <tbody>
    
    @if(count($results)>0)
    @php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp 
    @foreach ($results as $story)
   
    <tr>
        <td class="text-center">{{$i++}}</td>
        <td><strong>{{$story->title}}</strong></td>
        <td>
		@if(isset($story->priority))
            <span class="{{$story->GetPriority->name}}" aria-hidden="true" 
            data-toggle="tooltip" data-placement="top" title="Priority {{$story->GetPriority->name}}">    
              {{str_limit($story->GetPriority->name, $limit = 1, $end = '')}}
            </span>
            @endif
			</td>
        <td>{{$story->estimate}}</td>
		<td>@foreach($users as $user)
		@if($user->id == $story->user){{$user->name}}@endif
		@endforeach</td>
			
        
        <td>{{$story->project}}</td>
		   
        @php $created_date = $story->created_at ?? NULL @endphp
        @php $created = \Carbon\Carbon::parse($created_date)->format('d/m/y') @endphp
        <td>{{$created}}</td>
        <td class="text-center" >
		<a href="{{url('taskList')}}/{{$story->project_id}}/{{$story->sprint_id}}/{{$story->id}}" title="Task List" class="btn btn-outline-success"><i class="fa fa fa-list"></i></a>
		<a href="{{url('addUserstoryTask')}}/{{$story->project_id}}/{{$story->sprint_id}}/{{$story->id}}" title="Add Task" class="btn btn-outline-warning"><i class="fa fa-puzzle-piece"></i></a>
		<a href="{{url('editUserstory')}}/{{$story->project_id}}/{{$story->sprint_id}}/{{$story->id}}" title="Edit Details" class="btn btn-outline-primary"><i class="fa fa-edit"></i></a> 
		<a href="javascript:void(0)" title="Delete" onclick="deletePop('userstory/' + {{ $story->id }})" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a> 
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
