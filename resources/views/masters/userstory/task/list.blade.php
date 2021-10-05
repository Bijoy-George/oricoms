
<div class="table-widget table-responsive">
  <table id="cus_list" class="table">
    <thead>
      <tr>
        <th scope="col" width="30" class="text-center">#</th>
        <th scope="col">Task</th>
        <th scope="col">Asigned To</th>
       
        <th scope="col">Hour</th>
		
        <th scope="col" width="200" class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php   if(isset($results) && (count($results) > 0)){
        $i = ($results->currentpage()-1) * $results->perpage() +  1; ?>
    @foreach($results as $task)
    <tr id="default" class="default">
      <td class="text-center">{{$i++}}</td>
      <td >{{$task->task}}</td>
      <td>@foreach($users as $user)
		@if($user->id == $task->asigned_to){{$user->name}}@endif
		@endforeach</td>
      
      <td >{{$task->hour}}</td>
	 <td class="text-center">
	 
		<a href="{{url('taskedit')}}/{{$task->id}}/{{$task->userstory_id}}" title="Edit Details" class="btn btn-outline-primary"><i class="fa fa-edit"></i></a> 
		<a href="javascript:void(0)" title="Delete" onclick="deletePop('addUserstoryTask/' + {{ $task->id }})" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a> 
	 </td>
	
    </tr>
    @endforeach
    <?php }else{ ?>
    <tr>
      <td class="text-center bg-white" colspan="7">No Data Found</td>
    </tr>
    <?php }?>
      </tbody>
    
  </table>
</div>
<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>
