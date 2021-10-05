<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
<div class="table-widget table-responsive m-0">
  <table width="100%" id="coupon_list" class="table m-0">
    <thead>
      <tr>
        <th>{{__('#')}}</th>
        <th>{{__('Coupon Name')}}</th>
        <th>{{__('Coupon code')}}</th>
        <th>{{__('Discount')}}</th>
        <th>{{__('Valid from')}}</th>
        <th>{{__('Valid to')}}</th>
        <th>{{__('Status')}}</th>
        <th>{{__('Action')}}</th>
      </tr>
    </thead>
    <tbody>
    
    @if(count($results)>0)
    @php $i = 1; @endphp
    @foreach ($results as $coupon)
    <tr>
      <td>{{$i++}}</td>
      <td>{{$coupon->coupon_name}}</td>
      <td>{{$coupon->coupon_code}}</td>
      <td>{{$coupon->discount}}</td>
      <td>{{$coupon->valid_from}}</td>
      <td>{{$coupon->valid_to}}</td>
      <td> @if($coupon->status == config('constant.ACTIVE')){{__('Active')}}
        @else{{__('Inactive')}}
        @endif</td>
      <td><a href="{{url('/editpromo/'.$coupon->id)}}"  class="btn btn-outline-primary"><i class="far fa-edit"></i></a></td>
    </tr>
    @endforeach
    @else
    <tr >
      <td colspan="8" class="text-center bg-white">No Data Found</td>
    </tr>
    @endif
      </tbody>
  </table>
</div>
<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>
