  <div class="" id="no_data"></div>
  <div id="faq_lists" class="table-widget">
      <table width="50%" style="width:100%" id="faq_list" class="table">
      <thead>
      <tr>
        <th width="30" class="text-center" scope="col">#Sl.No</th>
        <th scope="col">Role Title</th>
        <th scope="col">Permissions</th>
        <th class="text-center" scope="col" width="80">Action</th>
      </tr>
      </thead>
      <tbody>
	   <?php $i = ($results->currentpage()-1) * $results->perpage() +  1; ?>
      @foreach($results as $data)
      <tr id="default" class="default">
        <td class="text-center">{{$i++}}</td>
        <td style="width:10%">{{$data->role}}</td>
        <td >
            <?php
            $access_permission = unserialize($data->access_permission);
//            print_r($access_permission);
            $access_permission_name='';
              if($access_permission):
                foreach ($access_permission as $row)
                {
                        $access_permission_name.=$row['permission_name'].', ';
                }
              endif;
                $access_permission_name = rtrim($access_permission_name,', ');
            ?>
            {{ str_limit($access_permission_name, 300) }}
            </td>
        <td class="text-center">         
			<a href="javascript:void(0)" onclick="deletePop('roles/' +{{$data->id}})" class="btn btn-outline-secondary btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
			<a href="{{route('roles.edit', $data->id)}}" title="Edit Details" class="btn btn-outline-secondary btn-sm"><i class="fa fa-edit"></i></a>
		</td>
		</tr>
      @endforeach
      </tbody>
    </table>
</div>
<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>