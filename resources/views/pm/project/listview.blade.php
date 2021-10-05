<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
    <div class="table-widget" >
      <table width="100%" id="querytype_lists" class="table">
        <thead>
                <tr>
					<th width="30" class="text-center">{{__('#')}}</th>					
					<th>{{__('Projects')}}</th>
					<th>{{__('Members')}}</th>
					<th>{{__('Status')}}</th>
					<th class="text-center">{{__('Action')}}</th>
				</tr>
                </thead>
                <tbody>
					
					@if(count($results)>0)
					@php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp 
					@foreach ($results as $res)
					<tr>
					<td class="text-center">{{$i++}}</td>
					<td><strong>{{$res->prjt_name}}</strong></td>
					<td>{{Helpers::get_unserialized_member_names($res->members)}}</td>
					<td>{{Helpers::get_master_values($res->project_status)}}</td>
					<td class="text-center" >
					<!--@if( Helpers::checkPermission('project delete'))
					<a href="javascript:void(0)" onclick="deletePop('projects/' + {{ $res->id }},{{ $res->id }})" class="btn btn-default">
					<i class="fa fa-trash" aria-hidden="true"></i></a>
					@endif-->
					
					@if( Helpers::checkPermission('project edit'))
					<a href="{{route('projects.edit', $res->id)}}"  class="btn btn-outline-secondary btn-sm"><i class="far fa-edit"></i></a>
					@endif
					<a href="javascript:void(0)" title="Delete" onclick="deletePop('projects/' + {{ $res->id }})" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a></td>
					
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
<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>

