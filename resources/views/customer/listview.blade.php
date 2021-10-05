
<div class="table-widget table-responsive">
  <table id="cus_list" class="table">
    <thead>
      <tr>
        <th scope="col" width="30" class="text-center">#</th>
        <th scope="col">User's Name</th>
        <th scope="col">Mobile Number</th>
        <th scope="col">User Id</th>
        <th scope="col">Email</th>
		<!--<th scope="col">Department</th>-->
		<th scope="col">Designation</th>
        <th scope="col">Last Logged In At</th>
        <th scope="col" width="200" class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php   if(isset($results) && (count($results) > 0)){
        $i = ($results->currentpage()-1) * $results->perpage() +  1; ?>
    @foreach($results as $customer)
    <tr id="default" class="default">
      <td class="text-center" >{{$i++}}</td>
	    @if(!empty($customer->role_id))
	    <?php $array_role = unserialize($customer->role_id); ?>
	    @endif
      <td ><h6 class="m-0"><a href="{{route('userDetails.edit', $customer->id)}}" title="Edit Details" ><strong>{{$customer->name}}</strong></a></h6>
	  <small>
	  @foreach($array_role as $ar_roles) 
	       {{Helpers::get_role_name($ar_roles).','}}
	  @endforeach
	  </small>
	  </td>
      <td >{{$customer->phone}}</td>
      <td >{{$customer->username}}</td>
      <td >{{$customer->email}}</td>
	 
	 <td >@if(isset($customer->designation)){{$customer->getDesignation->designation}}@else{{__('--')}}@endif
	 </td>
      <td class="text-center">@if(!empty($customer->last_logged_in_at))
        {{Helpers::common_date_conversion($customer->last_logged_in_at,3) }}
        @endif </td>
      <td ><a href="javascript:void(0)" title="Delete" onclick="deletePop('userDetails/' + {{ $customer->id }})" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a> <a href="{{route('userDetails.edit', $customer->id)}}" title="Edit Details" class="btn btn-outline-primary"><i class="fa fa-edit"></i></a> <a href="{{url('userchangepswd')}}/{{$customer->id}}" title="Change Password" class="btn btn-outline-secondary"><i class="fa fa-key"></i></a> @if($customer->status == 1) <a href="javascript:void(0)" title="Customer Active" onclick="to_inactivatePop({{$customer->id}},{{$results->currentpage()}})" class="btn btn-outline-success"><i class="fa fa-check"></i></a> @elseif($customer->status == 2) <a href="javascript:void(0)" title="Customer Inactive" onclick="to_activatePop({{$customer->id}},{{$results->currentpage()}})" class="btn btn-outline-info"><i class="fas fa-times"></i></a> @endif <a href="{{url('editCustomerRole')}}/{{$customer->id}}" title="Customer Role Edit" class="btn btn-outline-warning"><i class="fa fa-puzzle-piece"></i></a>@if(Helpers::checkPermission('edit others intimation'))<a href="{{url('intimation')}}/{{$customer->id}}" title="Intimation" class="btn btn-outline-secondary"><i class="fa fa-cog"></i></a>@endif</td>
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
