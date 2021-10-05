@extends('layouts.base')
@section('header-css-js')
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('fonts/css/all.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
<link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script> 
<script src="{{ asset('js/app.js') }}"></script> 
<script src="{{ asset('js/custom.js') }}"></script> 
<script src="{{ asset('js/common.js') }}"></script> 

<!-- <script src="https://code.highcharts.com/highcharts.js"></script> -->
<!-- <script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script> -->
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" rel="stylesheet">

@endsection
@section('nav-bar-code')
@php
  $admin_role = 0;
  $admin_role = Auth::user()->role_id
@endphp
  <script>
  $( function() {
    $( document ).tooltip({
      position: {
        my: "center bottom-20",
        at: "center top",
        using: function( position, feedback ) {
          $( this ).css( position );
          $( "<div>" )
            .addClass( "arrow" )
            .addClass( feedback.vertical )
            .addClass( feedback.horizontal )
            .appendTo( this );
        }
      }
    });
  } );
  </script>
  @php $chrome    =      config('constant.chromever');
       $firefox   =      config('constant.mozilaver');
       $opera   =      config('constant.opera');
       $Safari   =      config('constant.Safari');
  @endphp

  <script type="text/javascript">
    $( document ).ready(function() {
$("input[type=file]").on('change',function(){
    var fileName = this.value.split(/\\|\//).pop();
    if (fileName != '')
    {

      $(this).siblings('.input-file-trigger').html(fileName);
    }
    else
    {
       $(this).siblings('.input-file-trigger').html('<i class="fas fa-upload"></i> Choose a file..');
    }
});
setTimeout(function(){ 
  $('.loadpro').fadeOut();
  
  
 }, 2500);
});
$(document).ready(function () {
$('#assign_members').picker({containerWidth: 465, search: true});
});
</script>
<script type="text/javascript">
 $( document ).ready(function() {
  function get_browser_info(){
    var ua=navigator.userAgent,tem,M=ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || []; 
    if(/trident/i.test(M[1])){
        tem=/\brv[ :]+(\d+)/g.exec(ua) || []; 
        return {name:'IE ',version:(tem[1]||'')};
        }   
    if(M[1]==='Chrome'){
        tem=ua.match(/\bOPR\/(\d+)/)
        if(tem!=null)   {return {name:'Opera', version:tem[1]};}
        }   
    M=M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
    if((tem=ua.match(/version\/(\d+)/i))!=null) {M.splice(1,1,tem[1]);}
    return {
      name: M[0],
      version: M[1]
    };
 }
  var browser=get_browser_info();
    var chrome = "<?php echo $chrome ?>";
    var firefox = "<?php echo $firefox?>";
    var opera    ="<?php echo $opera?>";
    var Safari    ="<?php echo $Safari?>";
  if(browser.name == "Chrome")
  {
    if(browser.version < chrome)
    {
    
       $('.alertms').show(''); 
    }
  }
  else if(browser.name == "Firefox")
  {
     if(browser.version < firefox)
    {
      $('.alertms').show(''); 
      
    }
  }
  else if(browser.name == "Opera")
  {
     if(browser.version < opera)
    {
      $('.alertms').show(''); 
      
    }
  }
   else if(browser.name == "Safari")
  {
     if(browser.version < Safari)
    {
      $('.alertms').show(''); 
      
    }
  }
// console.log(browser.name);
// console.log(browser.version);

 }); 

</script>
<style type="text/css">
  .alertms {
    color: red;
    font-size: 12px;
    padding: 0;
    margin-top: 0px;
    margin-bottom: 0;
}
</style>
<nav class="@if($admin_role == 1)super_admin @endif navbar navbar-expand-lg navbar-light fixed-top py-0"> <a class="navbar-brand" href="/"> <img width="125px" src="{{url('/')}}/img/logo-white.png" alt=""/> </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <div class="menu-wrapper">
      <div class="sidebar-logo">
      @if(Auth::user()->cmpny_id !=32)
        <img width="125px" src="{{url('/')}}/img/logo-white.png" alt=""/>
      @endif
      </div>

    <ul class="nav navbar-nav">
      <li class="nav-item {{Helpers::current_page('dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{url('/dashboard')}}">
      <i class="fas fa-th-large"></i> Dashboard</a></li>

	  @if( helpers::checkPermission('lead list'))
      <li class="nav-item {{Helpers::current_page('leadlist') ? 'active' : '' }}"><a class="nav-link" href="{{url('/leadlist')}}">
      <i class="fas fa-user-tie"></i> {{ !empty(Helpers::get_company_meta('customer_label')) ? Helpers::get_company_meta('customer_label') : 'Customer' }}</a></li>

      @endif

      @if( helpers::checkPermission('pipeline'))
      <li class="nav-item {{Helpers::current_page('pipeline') ? 'active' : '' }}"><a class="nav-link" href="{{url('/pipeline')}}">
      <i class="fas fa-stream"></i> Pipeline</a></li>
      @endif

      @if( helpers::checkPermission('Helpdesk'))
      <li class="nav-item {{Helpers::current_page('helpdesk') ? 'active' : '' }} "><a class="nav-link" href="{{url('/helpdesk')}}">
      <i class="fas fa-headset"></i> Helpdesk</a></li>
      @endif

      @if( helpers::checkPermission('followup view'))
      <li class="nav-item {{Helpers::current_page('followups') ? 'active' : '' }} "><a class="nav-link" href="{{url('/followups')}}"><i class="fab fa-rocketchat"></i> Followups</a></li>
      @endif

      @if( helpers::checkPermission('agent manual outbound call'))
        <li class="nav-item {{Helpers::current_page('agent_calllist') ? 'active' : '' }}"><a class="nav-link" href="{{url('/agent_calllist')}}">
          <i class="fas fa-list"></i> Assigned Call List</a></li>
      @endif
      
      @if(Helpers::checkPermission('emailfetch'))
	  <li class="nav-item {{Helpers::current_page('emailfetchlist') ? 'active' : '' }} "><a class="nav-link" href="{{url('/emailfetchlist')}}">
    <i class="fas fa-envelope"></i> Mailbox</a></li>
      @endif
      
      @if( helpers::checkPermission('Task'))
      <li class="nav-item {{Helpers::current_page('tasks') ? 'active' : '' }} "><a class="nav-link" href="{{url('/tasks')}}">
      <i class="fas fa-tasks"></i> Tasks</a></li>
      @endif
	  
	   	@if(Helpers::get_company_meta('side_menu_set_extension') == 1)
	 @if( Helpers::checkPermission('outbound call'))
    <li class="nav-item {{Helpers::current_page('setextension') ? 'active' : '' }} "><a class="nav-link" href="{{url('/setextension')}}">
      <i class="fas fa-phone-square"></i> Set Extension</a></li>
      @endif
      @endif

      @if(Helpers::checkPermission('campaign management'))
      <li class="nav-item dropdown"><a class="nav-link dropdown-toggle text-capitalize" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-mail-bulk"></i> Campaigns</a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item {{Helpers::current_page('campaigns') ? 'active' : '' }} " href="{{url('/campaigns')}}"><i class="fas fa-bullhorn"></i>Campaign</a> 
        <a class="dropdown-item {{Helpers::current_page('outboundcall_followup') ? 'active' : '' }} " href="{{url('/outboundcall')}}"><i class="fas fa-sign-out-alt"></i> Manual Outbound </a>
          <a class="dropdown-item {{Helpers::current_page('unattended') ? 'active' : '' }} " href="{{url('/unattendedcall')}}"><i class="fas fa-phone-slash"></i>Unattended Call </a>
        </div>
	  </li>
	  @endif
    @if(Helpers::checkPermission('server management'))
      <li class="nav-item dropdown"><a class="nav-link dropdown-toggle text-capitalize" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-mail-bulk"></i> Server Management</a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
    @if(Helpers::checkPermission('server create'))
        <a class="dropdown-item {{Helpers::current_page('projects') ? 'active' : '' }} " href="{{url('/server')}}"><i class="fas fa-bullhorn"></i>Server</a> 
    @endif
    @if(Helpers::checkPermission('service create'))
        <a class="dropdown-item {{Helpers::current_page('services') ? 'active' : '' }} " href="{{url('/services')}}"><i class="fas fa-sign-out-alt"></i> Services </a>
    @endif
    </div>
    </li>
    @endif


    @if(Helpers::checkPermission('project management view'))
      <li class="nav-item dropdown"><a class="nav-link dropdown-toggle text-capitalize" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-mail-bulk"></i> Project Management</a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
		@if(Helpers::checkPermission('project management'))
        <a class="dropdown-item {{Helpers::current_page('projects') ? 'active' : '' }} " href="{{url('/projects')}}"><i class="fas fa-bullhorn"></i>Projects</a> 
		@endif
		@if(Helpers::checkPermission('task management'))
        <a class="dropdown-item {{Helpers::current_page('project_task_pm') ? 'active' : '' }} " href="{{url('/project_task_pm')}}"><i class="fas fa-sign-out-alt"></i> Tasks </a>
		@endif
		@if(Helpers::checkPermission('tracker management'))
        <a class="dropdown-item {{Helpers::current_page('tracker') ? 'active' : '' }} " href="{{url('/tracker')}}"><i class="fas fa-sign-out-alt"></i> Tracker </a>
		@endif
    @if (Helpers::checkPermission('project intimation management'))
        <a class="dropdown-item {{Helpers::current_page('project_intimations') ? 'active' : '' }} " href="{{url('/project_intimations')}}"><i class="fas fa-sign-out-alt"></i> Intimations </a>
    @endif
		
        </div>
    </li>
    @endif
	  
	  <!--<li class="nav-item"><a class="nav-link" href="#" onclick="showNotifications()"><i class="material-icons">notification_important</i><span id="unread_count"></span></a></li>-->
    </ul>
  </div>

    <?php  $user_name='';
$user_name = Auth::User()->name;
?>


<div style="display:none;" class="alert  alertms " id="warn">
    <strong><i class="fas fa-exclamation-triangle mr-3"></i> Warning!</strong> Your Browser is Outofdate some features dont working on your Browser  please update your browser
  </div>
    <ul class="nav navbar-nav ml-auto action-menu">
     
	@if( Helpers::checkPermission('notification list'))
	<li class="nav-item dropdown notification"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bell"></i><span id="unread_count"></span></a>
    	<ul id="notification_list" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"></ul>
</li>
@endif
      <!--<li class="nav-item notification"><a class="nav-link" href="{{url('/view_notifications')}}" id="notification_id"><svg fill="#FFFFFF" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
        </svg><span id="unread_count2"></span></a></li>-->
      <li class="nav-item"><a class="nav-link" href="{{url('/settings')}}"><i class="fas fa-cog"></i></a></li>
      <li class="nav-item user-action dropdown"><a class="nav-link dropdown-toggle p-1 pr-3 text-capitalize" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img src="{{ asset('img/avatar.svg') }}" width="30" class="mr-1" alt=""/> {{$user_name}}</a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
		<h6 class="dropdown-header">{{Helpers::get_company_dets(Auth::user()->cmpny_id)['ori_cmp_org_name']}}</h6>
        @if( Helpers::checkPermission('changepassword'))
          <a class="dropdown-item" href="{{url('/changepassword')}}"><i class="fas fa-key"></i> Change Password</a>
          @endif
          <a class="dropdown-item" href="{{url('/cache_clear')}}"><i class="fas fa-sync-alt"></i> Refresh</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); 
          <?php
            // Checking whether the logged in user is a chat agent or not. 
            // 1st parameter represents the role type that needs to be checked
            $is_chat_agent = Helpers::get_company_meta("chat_agent");

            $user_role_id = Auth::User()->role_id;
            $unserialize_user_roles = unserialize($user_role_id);
            foreach($unserialize_user_roles as $role)
            {
              if($role == $is_chat_agent)
              {
                $chat_enable_flag = 1;
              }
              else
              {
                $chat_enable_flag = 0;
              }
            }
            
            //$cmpny_plan_id = Helpers::get_cmpny_plan_id();
            if($chat_enable_flag == 1)
            {
          ?>
          jsxc.xmpp.logout(false);
          resetChatCount();
          <?php
            }
          ?>
          document.getElementById('logout-form').submit();"><i class="fas fa-power-off"></i> Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form> </div>
    </ul>
  </div>
</nav>

<div id="msg" class="alert" role="alert"></div>
<div id="message" class="alert" role="alert"></div>
<div class="loader-back"></div>
<div class="loader-container"></div>
@endsection
@section('footer-css-js') 
<script src="{{ asset('js/popper.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/preloader.css') }}">
<script src="{{ asset('js/jquery.preloader.min.js') }}"></script> 
<script src="{{ asset('js/jquery-ui.min.js') }}"></script> 

<script src="{{ asset('/jsxc/build/lib/jsxc.dep.js') }}"></script>
<script src="{{ asset('/jsxc/build/jsxc.js') }}"></script>
<script src="{{ asset('/jsxc/connect/js/chatConnection.js') }}"></script>
<script>
$(document).ready(function () {
	$('.datetimepicker').datetimepicker({
				format:'d/m/Y H:i'
			});
});
</script>
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.datetimepicker.min.css') }}"/>
<script src="{{ asset('js/jquery.datetimepicker.js') }}"></script>
<script>
  function resetChatCount()
  {
    $.ajax({
            async: false,
            type: "POST",
            url:  "{{ url('/reset_chat_count') }}",
            data: {
                 },
            success: function (msg)
                {
                }
              });
  }
</script>
@endsection
@section('common-popups') 
<!-- Deletion modal start -->
<div class="modal fade" id="deleteRecord" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <form role="form" method="POST" class="form-common" name="deletionFrom" action="#">
    @method('DELETE')
    @csrf
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <div class="message"></div>
          <p id="delete_msg">Are you sure want to delete ?</p> 
          
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" id="id" value="">
		  <input type="hidden" class="callback-path" id="callback-path" value="">
		  <input type="hidden" class="" id="from_create" value="">
		  <input type="hidden" name="pageno" id="pageno" value="">
		  <input type="hidden" name="callback" class="callback" value="form_basic_reload" />
          <!--<input type="hidden" name="" id="pageid" value="">-->
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-primary" id="s1">Yes</button>
        </div>
      </div>
    </div>
  </form>
</div>
<!-- Deletion modal end --> 

<!-- Mail template list pop up starts -->
<div id="mailtemplate" class="modal modal-wide fade ">
  <div class="modal-dialog modal-xl modal-dialog-centered" style="max-width: 1200px; z-index: 999999;">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title">Mail Template</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body pt-0" id="mail_template_div">
        <div class="py-5 text-center">No Data Found</div>
      </div>
      <div  class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary" onclick="compose_mail(2)"> <i class="fa fa-envelope" aria-hidden="true"></i> Send Email</button> -->
        <button id="send_mail" type="button" class="btn btn-primary" onclick="attachmentUpload()"> <i class="fa fa-envelope" aria-hidden="true"></i> Send Email</button>
<div id="msg_mail"></div>
      </div>
    </div>
  </div>
</div>
<!-- Mail template list pop up ends --> 
<!-- SMS template list pop up starts -->
<div id="smstemplate" class="modal modal-wide fade ">
  <div class="modal-dialog modal-xl modal-dialog-centered" style="max-width: 1200px; z-index: 999999;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">SMS Template</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body pt-0" id="sms_template_div"><div class="py-5 text-center">No Data Found</div></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="compose_mail(1)"> <i class="fa fa-envelope" aria-hidden="true"></i> Send SMS</button>
<div id="msg_mail"></div>
      </div>
    </div>
  </div>
</div>
<!-- SMS template list pop up ends --> 
<!-- Push template list pop up starts -->
<div id="push_template" class="modal modal-wide fade ">
  <div class="modal-dialog modal-xl modal-dialog-centered" style="max-width: 1200px; z-index: 999999;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Push Template</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body pt-0" id="push_template_div"><div class="py-5 text-center">No Data Found</div></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="compose_mail(6)"> <i class="fa fa-envelope" aria-hidden="true"></i> Send Push</button>
<div id="msg_mail"></div>
      </div>
    </div>
  </div>
</div>
<!-- Push template list pop up ends --> 
<!-- Activate modal start -->
<div class="modal" id="activateRecord" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <form role="form" method="POST" class="form-common" name="activateFrom" action="#">
    @method('POST')
    @csrf
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <div class="message"></div>
          <p>Are you sure want to activate ?</p>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="categoryid" id="categoryid" value="">
          <input type="hidden" name="type" id="type" value="">
          <!--<input type="hidden" name="" id="pageid" value="">-->
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-primary" id="s2">Yes</button>
        </div>
      </div>
    </div>
  </form>
</div>

<!-- Mail SMS template list pop up starts -->
<div id="mail_sms_template" class="modal">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="temp_head">Mail SMS Template</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body pt-0" id="mail_sms_template_div">
        <div class="py-5 text-center">No Data Found</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
<!-- Mail SMS template list pop up ends -->
@endsection