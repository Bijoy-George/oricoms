@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Settings
@endsection
@section('content')
<div class="settings-wrapper p-4">
  <div class="row settings settings-wrapper">
	<div class="col-12 p-2">
		<h2>Master Data Management </h2>
		<div class="widget">
			
			<div class="widget-content">
				<ul class="settings-menu">

       <!--<li><a class="a-block" href="{{url('/channels')}}"><i class="far fa-question-circle"></i>Channels</a></li>-->

      @if( Helpers::checkPermission('query type list'))
      <li><a class="a-block" href="{{url('/query_type')}}"><i class="fas fa-quote-left"></i>Query Type</a></li>
      @endif

      @if( Helpers::checkPermission('designation list'))
      <li><a class="a-block" href="{{url('/designations')}}"><i class="fas fa-check-double"></i>Designations</a></li>
      @endif

      @if( Helpers::checkPermission('view faq categories'))
      <li><a class="a-block" href="{{url('/faq_categories')}}"><i class="fas fa-question"></i>FAQ Categories</a></li>
      @endif

      @if( Helpers::checkPermission('query status list'))
      <li><a class="a-block" href="{{url('/query_status')}}"><i class="fas fa-check-double"></i>Query Status</a></li>
      @endif

      @if( Helpers::checkPermission('customer nature list'))
      <li><a class="a-block" href="{{url('/customer_nature')}}"><i class="far fa-smile"></i>Customer Nature</a></li>
      @endif

      @if( Helpers::checkPermission('query action list'))
      <li><a class="a-block" href="{{url('/query_action')}}"><i class="far fa-smile"></i>Query Actions</a></li>
      @endif

      @if( Helpers::checkPermission('customer priority list'))
      <li><a class="a-block" href="{{url('/priority')}}"><i class="far fa-star"></i>Customer Priority</a></li>
      @endif
     @if( Helpers::checkPermission('customer response list'))
      <li><a class="a-block" href="{{url('/customer_response')}}"><i class="far fa-smile"></i>Customer Response</a></li>
      @endif
       @if( Helpers::checkPermission('supply card list'))
      <li><a class="a-block" href="{{url('/supply_card')}}"><i class="far fa-star"></i>Supply Cards</a></li>
      @endif

      @if( Helpers::checkPermission('lead source type list'))
      <li><a class="a-block" href="{{url('/lead_source_type')}}"><i class="fas fa-list-ul"></i>Lead Source Types</a></li>
      @endif

      @if( Helpers::checkPermission('lead source list'))
      <li><a class="a-block" href="{{url('/lead_sources')}}"><i class="far fa-list-alt"></i>Lead Source Management</a></li>
      @endif         
     
      </ul>
			</div>
		</div>
	</div>
	
	<div class="col-12 p-2">
		<h2>Master Management </h2>
		<div class="widget">
			
			<div class="widget-content">
				<ul class="settings-menu">
      
      @if(Helpers::checkPermission('campaign management'))
        <li>
          <a class="a-block" href="{{url('/campaigns')}}">
            <i class="fas fa-chart-pie"></i>Campaign Management
          </a>
        </li>
      @endif
	    @if(Helpers::checkPermission('faq list'))
        <li>
          <a class="a-block" href="{{url('/faqs')}}">
            <i class="far fa-question-circle"></i>FAQ Management
          </a>
        </li>
      @endif
     
      @if( Helpers::checkPermission('sales automation list'))
      <li><a class="a-block" href="{{url('/sales_automation')}}"><i class="fas fa-link"></i>Sales Automation</a></li>
      @endif
	  @if( Helpers::checkPermission('sales automation list'))
      <li><a class="a-block" href="{{url('/sales_automation_customer')}}"><i class="fas fa-link"></i>Sales Automation Customer</a></li>
      @endif
      @if( Helpers::checkPermission('template list'))
      <li><a class="a-block" href="{{url('/templates')}}"><i class="fas fa-layer-group"></i>Templates</a></li>
      @endif
       @if( Helpers::checkPermission('question management'))
      <li><a class="a-block" href="{{url('/questions')}}"><i class="fas fa-question"></i>Questions</a></li>
      @endif 
      @if( Helpers::checkPermission('supply office list'))
      <li><a class="a-block" href="{{url('/supply_offices')}}"><i class="fas fa-link"></i>Supply Offices</a></li>
      @endif
	  @if( Helpers::checkPermission('project management'))
      <li><a class="a-block" href="{{url('/pm_master')}}"><i class="fas fa-link"></i>Project Management Master</a></li>
      @endif
      </ul>
			</div>
		</div>
	</div>
	<div class="col-12 p-2">
		<h2>User - Roles - Permission </h2>
		<div class="widget">
			
			<div class="widget-content">
				<ul class="settings-menu">
				@if( Helpers::checkPermission('user management'))
				  <li><a class="a-block" href="{{url('/userDetails')}}"><i class="fas fa-user-plus"></i>User Management</a></li>
				@endif
				  @if( Helpers::checkPermission('role management'))
					<li><a class="a-block" href="{{url('/roles')}}"><i class="fas fa-th-list"></i>Role List</a></li>
				  @endif
			  </ul>
			</div>
		</div>
	</div>
	@if (Auth::User()->id == 1)
	<div class="col-12 p-2">
		<h2>Roles - Permission Management </h2>
		<div class="widget">
			
			<div class="widget-content">
				<ul class="settings-menu">
				  <li><a class="a-block" href="{{url('/plan')}}"><i class="fas fa-puzzle-piece"></i>Plan</a></li>
				  <li><a class="a-block" href="{{url('/permissions')}}"><i class="fas fa-shield-alt"></i>Permission Management</a></li>
				  <li><a class="a-block" href="{{url('/packages')}}"><i class="fas fa-box"></i>Package Permission Management</a></li>
				</ul>
			</div>
		</div>
	</div>
	
	@endif

	<div class="col-12 p-2">
		<h2>Settings </h2>
		<div class="widget">
			
			<div class="widget-content">
			<ul class="settings-menu">
      @if( Helpers::checkPermission('changepassword'))
      <li><a class="a-block" href="{{url('/changepassword')}}"><i class="fas fa-key"></i>Change Password</a></li>
      @endif
      @if( Helpers::checkPermission('outbound call'))
      <li><a class="a-block" href="{{url('/setextension')}}"><i class="fas fa-phone-square"></i>Set Extension</a></li>
      @endif
	  @if( Helpers::checkPermission('channel gateway'))

      <li><a class="a-block" href="{{url('/channel_gateway')}}"><i class="fas fa-user-plus"></i>Channel Gateway</a></li>
    @endif
    
    @if( Helpers::checkPermission('intimation settings create'))
      <li><a class="a-block" href="{{url('/intimation_settings')}}"><i class="fas fa-bullhorn"></i>Intimation Settings</a></li>
    @endif
    @if( Helpers::checkPermission('company meta'))
      <li><a class="a-block" href="{{url('/company_meta')}}"><i class="fas fa-building"></i>Company Meta</a></li>
    @endif
    </ul>
			</div>
		</div>
	</div>
	<div class="col-12 p-2">
		<h2>Feedback </h2>
		<div class="widget">
			
			<div class="widget-content">
			<ul class="settings-menu">     
			  @if( Helpers::checkPermission('feedback settings'))
			  <li><a class="a-block" href="{{url('/feedback')}}"><i class="fas fa-sliders-h"></i>Feedback Settings</a></li>
			  @endif
			  @if( Helpers::checkPermission('feedback report'))
			  <li><a class="a-block" href="{{url('/feedback_report')}}"><i class="fas fa-clipboard-list"></i>Feedback Report</a></li>
			  @endif    
			</ul>
			</div>
		</div>
	</div>
	<div class="col-12 p-2">
		<h2>Survey </h2>
		<div class="widget">
			
			<div class="widget-content">
				<ul class="settings-menu">
				  @if( Helpers::checkPermission('survey management'))
				  <li><a class="a-block" href="{{url('/survey')}}"><i class="fas fa-poll-h"></i>Survey Management</a></li>
				  @endif
				  @if( Helpers::checkPermission('survey management'))
				  <li><a class="a-block" href="{{url('/survey_report')}}"><i class="fas fa-list-alt"></i>Survey Report</a></li>
				  @endif
				  
				</ul>
			</div>
		</div>
	</div>
	<div class="col-12 p-2">
		<h2>Other Report </h2>
		<div class="widget">
			<div class="widget-content">
			<ul class="settings-menu">    
			  @if( Helpers::checkPermission('escalation reports'))
			  <li><a class="a-block" href="{{url('/escalation_report')}}"><i class="fas fa-clipboard-list"></i>Escalation Report</a></li>
			  @endif    
			</ul>
			</div>
		</div>
	</div>
	
	<div class="col-12 p-2">
		<h2>Profile Settings </h2>
		<div class="widget">
			
			<div class="widget-content">
			<ul class="settings-menu">
      @if( Helpers::checkPermission('profile customization'))
      <li><a class="a-block" href="{{url('/profile_customization')}}"><i class="fas fa-puzzle-piece"></i>Profile Customization</a></li>
      @endif
       @if( Helpers::checkPermission('customer tab list'))
      <li><a class="a-block" href="{{url('/tab')}}"><i class="fas fa-cogs"></i>Tab Settings</a></li>
      @endif
    </ul>
			</div>
		</div>
	</div>
	<div class="col-12 p-2">
		<h2>Chat</h2>
		<div class="widget">
			
			<div class="widget-content">
				<ul class="settings-menu">

      @if(Helpers::checkPermission('chat configuration'))
        <li><a class="a-block" href="{{url('/chat_configuration')}}"><i class="fas fa-comments"></i>Chat Configuration</a></li>
     @endif

      @if( Helpers::checkPermission('chat agent report'))
      <li><a class="a-block" href="{{url('/agent_chat_reports')}}"><i class="fas fa-list-alt"></i>Chat Agent Report</a></li>
      @endif      
           
      @if( Helpers::checkPermission('view auto reply categories'))
      <li><a class="a-block" href="{{url('/auto_reply_categories')}}"><i class="fas fa-reply-all"></i>Chat Auto Reply Categories</a></li>
      @endif

       @if(Helpers::checkPermission('auto reply list'))
        <li>
          <a class="a-block" href="{{url('/chat_auto_reply')}}">
            <i class="fas fa-reply"></i>Chat Auto Reply Management
          </a>
        </li>
      @endif

    </ul>
			</div>
		</div>
	</div>
   



  
    
   
 


 






</div>
</div>
@endsection
