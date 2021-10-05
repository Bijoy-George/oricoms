<div class="table-widget mt-0 table-responsive">
  <table width="100%" id="group_list" class="table table-striped">
    <thead>
      <tr>
        <th></th>
        <th width="35" class="text-center">#</th>
        <th>Name</th>
        <th class="text-center">Members</th>
        <th>Created By</th>
        <th>Creation Date</th>
        <th width="120" class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
    
    @foreach($groups as $group)
    <tr class="anchor-wrap">
      <td>
        @if(count($group->processing_import_batches) > 0)
          <i class="fas fa-circle-notch fa-spin text-primary h6" title="In Progress"></i>
        @else
          <i class="fas fa-check text-success h6" title="Completed"></i>
        @endif
      </td>
      <td class="text-center">{{ $group->id }}</td>
      <td><a href="{{url('/groups/'.$group->id.'/edit')}}" class="d-block"><strong>{{ $group->name }}</strong></a><small>{{ $group->created_at->format('d-m-Y H:i:s A') }}</small></td>
      <td class="text-center">{{ $group->contacts->count() }}</td>
      <td>{{ $group->creator->name }}</td>
      <td>{{ $group->created_at->format('d-m-Y H:i:s A') }}</td>
      <td class="text-center">
        <a href="javascript:void(0)" onclick="deletePop('groups/' + {{ $group->id }})" class="btn btn-sm btn-outline-danger"> <i class="far fa-trash-alt"></i></a> 
        <a href="{{url('/groups/'.$group->id.'/edit')}}" class="btn btn-sm btn-outline-primary"> <i class="fas fa-edit"></i> </a></td>

        
    </tr>
    @endforeach
    </tbody>
    
  </table>
</div>
<div class="d-flex justify-content-end first">{{ $groups->render() }}</div>