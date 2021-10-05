@extends('layouts.dashboard')
@section('title')
Dashboard - {{Auth::user()->getCompany->ori_cmp_org_name}} - {{config('constant.site_title')}}
@endsection

@section('content')
<div class="content-area">
  <?php if(isset($sbcr_expired) && $sbcr_expired != '' && session('sbcrptn_exp_pop_dismiss') != 1) {?>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="alert alert-danger alert-dismissible show pop-alert" role="alert"> Your Subscription will expire after {{$sbcr_expired}} Days.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onClick="set_session();"> <span aria-hidden="true">&times;</span> </button>
      </div>
    </div>
  </div>
  <?php } ?>
  <div class="row row-eq-heigh static-wrapper">
    <div class="col-sm col-6 p-2">
      <div class="widget-container clearfix">
        <span><i class="fas fa-users"></i></span>
        <h2>{{ $total_leads_count }}</h2>
        <p>Total Profiles</p>
      </div>
    </div>
    <div class="col-sm col-6 p-2">
      <div class="widget-container clearfix">
        <span><i class="fas fa-clipboard-list"></i></span>
        <h2>{{ $open_ticket_count }}</h2>
        <p>Open Tickets</p>
      </div>
    </div>
    <div class="col-sm col-6 p-2">
      <div class="widget-container clearfix">
        <span><i class="fas fa-clock"></i></span>
        <h2>{{ $processing_ticket_count }}</h2>
        <p>Processing Tickets</p>
      </div>
    </div>
    <div class="col-sm col-6 p-2">
      <div class="widget-container clearfix">
        <span><i class="fas fa-check-circle"></i></span>
        <h2>{{ $closed_ticket_count }}</h2>
        <p>Closed Tickets</p>
      </div>
    </div>
    @if(Helpers::checkPermission('emailfetch'))
     <div class="col-sm col-6 p-2">
      <div class="widget-container clearfix">
        <span><i class="fas fa-envelope-open"></i></span>
        <h2>{{ $unread_count }}</h2>
        <p>Unread Emails</p>
      </div>
    </div>
    @endif
    @if(Helpers::checkPermission('campaign management'))
    <div class="col-sm col-6 p-2">
      <div class="widget-container clearfix">
        <span><i class="fas fa-bullhorn"></i></span>
        <h2>{{ $campaign_count }}</h2>
        <p>Campaigns</p>
      </div>
    </div>
    @endif
 
  </div>

<div class="date-filter-wrapper">
      <div class="date-filter-icon"><i class="fas fa-sliders-h"></i></div>
      <div class="row m-0 py-2 date-filter bg-white align-items-center">
        <div class="col-sm-12"><h5 class="m-0 pb-3">Filter by Date</h5></div>
        <div class="col-4 pb-sm-2">Start Date</div>
        <div class="col-8 pb-2">
            <input name="ann_searchQuery" id="ann_searchQuery" readonly type="text" placeholder="Start Date" value="<?php echo $ann_start_dt; ?>" class="form-control form-control-sm">
        </div>
        <div class="col-4">End Date</div>
        <div class="col-8">
            <input name="ann_searchQuery1" id="ann_searchQuery1" readonly type="text" placeholder="End Date" value="<?php echo $ann_end_dt; ?>" class="form-control form-control-sm">
        </div>
      </div>
      <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
</div>
  <div id="graphcontainer" class="row row-eq-height dashboard-graphs m-0"></div>
</div>


<script type="text/javascript">
  $(".date-filter-icon").click(function(){
  $(".date-filter-wrapper").toggleClass("active");
});
</script>
@endsection 
