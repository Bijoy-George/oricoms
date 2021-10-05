@extends('layouts.campaign')
@section('title')
{{config('constant.site_title')}} - Campaigns
@endsection

@section('tab-content')
<div class="content-area">
  <header class="row align-items-center">
    <div class="col-sm-5 text-sm-left mb-3 mb-sm-0">
            <h2 class="m-0">
                      View Campaign
                  </h2>
          <small><a href="/campaigns">Campaigns</a> /  View Campaign </small>
                </div>
       <div class="col-sm-7 text-sm-right">
          <a title="Go Back" href="javascript:history.go(-1)" class="btn btn-outline-info ml-1"><i class="fas fa-chevron-left"></i></a>
        </div>
</header>
</div>
<div class="message"></div>
<div class="content-area pt-0">
  <div class="widget">
  <div class="widget-heading">
    <div class="row">
      <div class="col-12 col-md-6">
        <h2>Test Campaign </h2>
      </div>
      <div class="col-12 col-md-6">
        <div class="float-right">
          <a href="{{ url('/campaigns/' . $campaign->id . '/edit') }}"><button type="button" class="btn btn-success btn-sm mt-1 mr-1">Edit Campaign</button></a>
      @if(isset($campaign) && count($campaign->batches))
      <a href="{{ url('/campaigns/' . $campaign->id . '/reassign') }}"><button type="button" class="btn btn-primary btn-sm mt-1 mr-1">Reassign Group</button></a>
      @endif
    </div>
      </div>
    </div>
  </div>
  <div class="table-widget table-responsive mt-0 pt-0 p-3">
        <div class="row">
            <input id="campaign_id" name="id" type="hidden" value="3">
          <div class="form-group col-md-4">
            <label for="name">Campaign Name</label><br/>
            <strong>{{ $campaign->name }}</strong>
          </div>

          <div class="form-group col-md-4">
            <label for="groups">Groups</label><br/>
            <?php implode(',', $campaign->groups->pluck('name')->all()); ?>
             <strong>{{ implode(',', $campaign->groups->pluck('name')->all()) }}</strong>
          </div>
          <div class="form-group col-md-4">
            <label for="campaign_type">Campaign Type</label><br/>
            <strong>
              @if ($campaign->campaign_type == config('constant.NOTIFICATION'))
              Notificational
              @elseif ($campaign->campaign_type == config('constant.PROMOTION'))
              Promotional
              @elseif ($campaign->campaign_type == config('constant.TRANSACTION'))
              Transactional
              @endif
            </strong>
          </div>
        </div>
        <h6>Campaign Channels</h6>
      <div class="row">     
           <div class="form-group col-md-4">
            <label for="name">Source Info</label><br/>
            <strong>{{ $campaign->meta_data->get_source_type->source_type }}</strong>
          </div>
           <div class="form-group col-md-4">
            <label for="name">Select Lead Source</label><br/>
            <strong>{{ $campaign->meta_data->lead_source->name }}</strong>
          </div>
           <div class="form-group col-md-4">
            <label for="name">Budget</label><br/>
            <strong>{{ $campaign->meta_data->budget ?? 'NIL' }}</strong>
          </div>


          <div class="form-group col-md-4">
            <label for="name">Field 1</label><br/>
            <strong>Title : {{ $campaign->meta_data->field1 ?? 'NIL' }}</strong><br/>
            <p>Content : {{ $campaign->meta_data->field1_description ?? 'NIL' }}</p>

          </div>
           <div class="form-group col-md-4">
            <label for="name">Field 2</label><br/>
            <strong>Title : {{ $campaign->meta_data->field2 ?? 'NIL' }}</strong><br/>
            <p>Content : {{ $campaign->meta_data->field2_description ?? 'NIL' }}</p>

          </div>
           <div class="form-group col-md-4">
            <label for="name">Field 3</label><br/>
            <strong>Title : {{ $campaign->meta_data->field3 ?? 'NIL' }}</strong><br/>
            <p>Content : {{ $campaign->meta_data->field3_description ?? 'NIL' }}</p>

          </div>
      </div>
  </div>
</div>
</div>





<div class="content-area">
<div class="row">
  <div class="col-md-8">
    <div class="widget">
       <div class="widget-heading">
        <div class="row">
          <div class="col-12 ">
            <h2>Batch List </h2>
          </div>
        </div>
      </div>
      <div class="batch-list col-md-12">
          <div class="table-widget table-responsive mt-0">
            <table width="100%" id="batch_list" class="table table-striped">
              <thead>
                <tr>
                  <th></th>
                  <th width="30" class="text-center">#</th>
                  <th>Name</th>
                  <th>Total Target</th>
                  <th>Created By</th>
                  <th>Created Date</th>
                  <th>Email</th>
                  <th>SMS</th>
                  <th>Auto Dial</th>
                  <th>Manual Call</th>
                  <th>Push Messages</th>
                  <!-- <th>Efficiency (In %)</th> -->
                  <th>Action</th>
                  </tr>
                </thead>
              
              <tbody>
              @foreach ($batches as $batch)
              <tr>
                <td>@if($batch->status==config('constant.INACTIVE'))<i class="fas fa-circle-notch fa-spin text-primary h6" title="In Progress"></i>@elseif($batch->status==config('constant.PAUSED'))<i class="fas fa-pause text-danger h6" title="Paused" style="color: #dc3545 !important"></i>
                  @elseif($batch->status==config('constant.ACTIVE'))<i class="fas fa-check text-success h6" title="Completed"></i>@endif</td>
                <td class="text-center">{{ $batch->id }}</td>
                <td>{{ $batch->title }}</td>
                <td>{{ $batch->total_target_count }}</td>
                <td>{{ $batch->creator->name }}</td>
                <td>{{ $batch->created_at->format('d-m-Y H:i:s A') }}</td>
                <td>
                  @if($batch->channel_type == config('constant.CH_EMAIL'))
                  <a href="javascript:void(0)" onclick="campaignEmailDetails({{$batch->id}})">{{ (int)$batch->processed_count }}</a>
                  @else
                  0
                  @endif
                  </td>
                <td>
                  @if($batch->channel_type == config('constant.CH_SMS'))
                  <a href="javascript:void(0)" onclick="campaignSmsDetails({{$batch->id}})">{{ (int)$batch->processed_count }}</a>
                  @else
                  0
                  @endif
                  </td>
                <td>
                  @if($batch->channel_type == config('constant.CH_AUTODIAL'))
                  <a href="javascript:void(0)" onclick="campaignAutodialDetails({{$batch->id}})">{{ (int)$batch->processed_count }}</a>
                  @else
                  0
                  @endif
                  </td>
                <td>
                  @if($batch->channel_type == config('constant.CH_MANUAL_CALL'))
                  <a href="javascript:void(0)" onclick="campaignManualCallDetails({{$batch->id}})">{{ (int)$batch->processed_count }}</a>
                  @else
                  0
                  @endif
                  </td>
                  <td>
                  @if($batch->channel_type == config('constant.CH_PUSH_MESSAGES'))
                  <a href="javascript:void(0)" onclick="campaignPushDetails({{$batch->id}})">{{ (int)$batch->processed_count }}</a>
                  @else
                  0
                  @endif
                  </td>
                <!-- <td>
                  <a href="#" onClick="efficiencyReport({{ $campaign->id }}, {{$batch->id}})"> {{ $batch->efficiency }} </a>
                  </td> -->
                  <td class="text-center">
                    @if ($batch->status == config('constant.INACTIVE'))
                    <button class="btn btn-sm btn-danger" onclick="confirmPauseBatch({{$batch->id}},{{$batch->channel_type}})"><i class="fas fa-pause" title="Pause Batch"></i></button>
                    @elseif($batch->status == config('constant.PAUSED'))
                    <button class="btn btn-sm btn-success" onclick="confirmResumeBatch({{$batch->id}})"><i class="fas fa-play" title="Resume Batch"></i></button>
                    @endif
                  </td>
                </tr>
              @endforeach
              </tbody>
              </table>
          </div>
          {{ $batches->links() }}
    </div>
    </div>


  </div>
  <div class="col-md-4" id="status_graph"></div>
</div>



</div>


@endsection

@section('footer-custom-css-js')
	<script src="{{ asset('js/highcharts.js') }}"></script>
	<script src="{{ asset('js/campaigns/add_campaign.js') }}"></script>
@endsection