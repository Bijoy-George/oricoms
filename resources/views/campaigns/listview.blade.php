
<div class="table-widget table-responsive  mt-0">
  <table width="100%" id="campaign_list" class="table">
    <thead>
      <tr>
        <th width="35" class="text-center">#</th>
        <th>Name</th>
        <th class="text-center">Active Members</th>
        <th>Channels</th>
        <th class="text-center">Created By</th>
        <th class="text-center">Creation Date</th>
        <th width="120" class="text-center">Report</th>
        <th width="120" class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
    
    @foreach($campaigns as $campaign)
    <tr class="anchor-wrap">
      <td class="text-center">{{ $campaign->id }}</td>
      <td><a href="/campaigns/{{ $campaign->id }}" class="d-block"><strong>{{ $campaign->name }}</strong></a><small>Sent on {{ $campaign->created_at->format('d-m-Y') }} at {{ $campaign->created_at->format('H:i:s A') }}</small></td>
      <td class="text-center">{{ $campaign->members_count }}</td>
      <td>{{ Helpers::find_channels($campaign->id) }}</td>
      <td class="text-center">{{ $campaign->creator->name }}</td>
      <td class="text-center">{{ $campaign->created_at->format('d-m-Y H:i:s A') }}</td>
	  <td class="text-center">
        <a href="{{url('/campaigns/'.$campaign->id)}}" class="btn btn-sm btn-outline-primary"><i class="fas fa-chart-pie"></i> </a></td>
      <td class="text-center">
        <a href="javascript:void(0)" onclick="deletePop('campaigns/' + {{ $campaign->id }})" class="btn btn-sm btn-outline-danger"> <i class="far fa-trash-alt"></i> </a> 
        <a href="{{url('/campaigns/'.$campaign->id.'/edit')}}" class="btn btn-sm btn-outline-primary"><i class="fas fa-pencil-alt"></i> </a></td>
    </tr>
    @endforeach
      </tbody>
    
  </table>
</div>
<div class="d-flex justify-content-end first"> {{ $campaigns->render() }}</div>