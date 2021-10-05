@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Channel Gateway
@endsection
@section('content')

 


<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-9 text-right"><a href="{{url('settings')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-md-9 mt-3">
      <div class="widget">
        <h2>{{__('Channel Gateway')}}</h2>
        <div class="widget-content"> {!! Form::open(array('route' => 'company_meta.store', 'class' => 'reload form-common', 'method'=>'POST')) !!}
          <?php 
            $transcation_email_group = $promotion_email_group = $notification_email_group = array();
          ?>        
          @if(count($res))		
          @foreach($res as $meta)
          @php $value = $meta->meta_name; @endphp
          @php $$value = $meta->meta_value; @endphp
          @endforeach
          @endif
          @if(!isset($transcation_email)) @php $transcation_email = ''; @endphp @endif
          @if(!isset($promotion_email)) @php $promotion_email = ''; @endphp @endif
          @if(!isset($notification_email)) @php $notification_email = ''; @endphp @endif
          @if(!isset($transcation_sms)) @php $transcation_sms = ''; @endphp @endif
          @if(!isset($promotion_sms)) @php $promotion_sms = ''; @endphp @endif
          @if(!isset($notification_sms)) @php $notification_sms = ''; @endphp @endif

          <?php
          if(!isset($transcation_email_group) || empty($transcation_email_group)) {
            $transcation_email_group = array();
          }else{
            $transcation_email_group = unserialize($transcation_email_group);
          }

          if(!isset($promotion_email_group) || empty($promotion_email_group)) {
            $promotion_email_group = array();
          }else{
            $promotion_email_group = unserialize($promotion_email_group);
          }

          if(!isset($notification_email_group) || empty($notification_email_group)) {
            $notification_email_group = array();
          }else{
            $notification_email_group = unserialize($notification_email_group);
          }

          ?>
          <input type="hidden" name="transcation_email_group" value="">
          <input type="hidden" name="promotion_email_group" value="">
          <input type="hidden" name="notification_email_group" value="">
          <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

<script type="text/javascript">
 
  $(document).ready(function(){
$(".ch_remove").hide();
$(document).on("click", ".chgdeletegmail" , function() { 
             var i=$('#gmail_count').val();
             if(i == 1){ $(".chgdeletegmail").hide(); }
              $("#Gmail_con"+i).remove();
             i--;
             $('#gmail_count').val(i);
        });

$(document).on("click", ".chgdeletegun" , function() { 
             var j=$('#mailgun_count').val();
             if(j == 1){ $(".chgdeletegun").hide(); }
              $("#Mailgun_con"+j).remove();
             j--;
             $('#mailgun_count').val(j);
        });

$(document).on("click", ".chgdeletesendgrid" , function() { 
             var k=$('#sendgrid_count').val();
             if(k == 1){ $(".chgdeletesendgrid").hide(); }
              $("#SendGrid_con"+k).remove();
             k--;
             $('#sendgrid_count').val(k);
        });

$(document).on("click", ".chgdeletesmtp" , function() { 
             var l=$('#smtp_count').val();
             if(l == 1){ $(".chgdeletesmtp").hide(); }
              $("#SMTP_con"+l).remove();
             l--;
             $('#smtp_count').val(l);
        });

$(document).on("click", ".chgdeletemailchimp" , function() { 
             var m=$('#mailchimp_count').val();
             if(m == 1){ $(".chgdeletemailchimp").hide(); }
              $("#Mailchimp_con"+m).remove();
             m--;
             $('#mailchimp_count').val(m);
        });



  $("#gmailadd").click(function(){
    $(".chgdeletegmail").show();
    var i=$('#gmail_count').val();
if(i<=2)
            {
           i++;
           $('#gmail_count').val(i);
           

             $('#Gmail_con>div.gat_con_in').append('<div class="gat_con" id="Gmail_con'+i+'"><div class="row"><div class="col-sm-4 form-group "><label for="gmail_host_1" class="control-label mb-1">{{__('GMAIL Host')}}</label><input type="text" value=""  name="gmail_host_1'+i+'" class="form-control"></div><div class="col-sm-4 form-group "><label for="gmail_encryption_1" class="control-label mb-1">{{__('Encryption')}}</label><select name="gmail_encryption_1'+i+'" class="form-control"><option value="none">None</option><option @if(isset($gmail_encryption_1)) @if($gmail_encryption_1 == 'ssl') {{'selected'}} @endif @endif value="ssl">SSL</option><option @if(isset($gmail_encryption_1)) @if($gmail_encryption_1 == 'tls') {{'selected'}} @endif @endif value="tls">TLS</option></select></div><div class="col-sm-4 form-group "><label for="gmail_port_1" class="control-label mb-1">{{__('GMAIL Port')}}</label><input type="number" value=""  name="gmail_port_1'+i+'" class="form-control"></div><div class="col-sm-4 form-group "><label for="gmail_user_name_1" class="control-label mb-1">{{__('GMAIL User Name')}}</label><input type="text" value=""  name="gmail_user_name_1'+i+'" class="form-control"></div><div class="col-sm-4 form-group "><label for="gmail_password_1" class="control-label mb-1">{{__('GMAIL Password')}}</label><input type="password" value=""  name="gmail_password_1'+i+'" class="form-control"></div><div class="col-sm-4 form-group "><label for="gmail_from_name_1" class="control-label mb-1">{{__('GMAIL From Name')}}</label><input type="text" value=""  name="gmail_from_name_1'+i+'" class="form-control"></div><div class="col-sm-4 form-group "><label for="gmail_from_email_1" class="control-label mb-1">{{__('GMAIL From Email')}}</label><input type="text" value=""  name="gmail_from_email_1'+i+'" class="form-control"></div><div class="col-md-12 radio_con"><input type="radio" name="transcation_email" value="gmail_1'+i+'" class="{{$transcation_email}} custom-radio d-none" id="email-radio-1'+i+'"><label for="email-radio-1'+i+'" class="custom-checkbox-label pr-3">Transcation Email</label><input type="radio"  name="promotion_email" value="gmail_1'+i+'" class="{{$promotion_email}} custom-radio d-none" id="email-radio-2'+i+'"> <label for="email-radio-2'+i+'" class="custom-checkbox-label pr-3">Promotion Email</label> <input type="radio"  name="notification_email" value="gmail_1'+i+'" class="{{$notification_email}} custom-radio d-none" id="email-radio-3'+i+'"> <label for="email-radio-3'+i+'" class="custom-checkbox-label pr-3">Notification Email</label> </div> <div class="col-md-12 checkbox_con"><input type="checkbox" name="transcation_email_group[]" value="gmail_1'+i+'" class="custom-checkbox d-none" id="t_gmail_email-check-1'+i+'"><label for="t_gmail_email-check-1'+i+'" class="custom-checkbox-label pr-3">Transcation Email Group</label><input type="checkbox" name="promotion_email_group[]" value="gmail_1'+i+'" class="custom-checkbox d-none" id="p_gmail_email-check-1'+i+'"> <label for="p_gmail_email-check-1'+i+'" class="custom-checkbox-label pr-3">Promotion Email Group</label> <input type="checkbox" name="notification_email_group[]" value="gmail_1'+i+'" class="custom-checkbox d-none" id="n_gmail_email-check-1'+i+'"> <label for="n_gmail_email-check-1'+i+'" class="custom-checkbox-label pr-3">Notification Email Group</label> </div></div></div>');
             $('#Gmail_con'+i).show();
            
            }
       });
     
   

  $("#mailgunadd").click(function(){
    $(".chgdeletegun").show();
    var j=$('#mailgun_count').val();
if(j<=2)
            {
           j++;
           $('#mailgun_count').val(j);
           $('#Mailgun_con>div.gat_con_in').append('<div class="gat_con" id="Mailgun_con'+j+'"><div class="row"><div class="col-sm-4 form-group "><label for="mailgun_host_1" class="control-label mb-1">{{__('Mailgun Host')}}</label><input type="text" value=""  name="mailgun_host_1'+j+'" class="form-control"></div><div class="col-sm-4 form-group "><label for="mailgun_encryption_1" class="control-label mb-1">{{__('Encryption')}}</label><select name="mailgun_encryption_1'+j+'" class="form-control"><option value="none">None</option><option @if(isset($mailgun_encryption_1)) @if($mailgun_encryption_1 == 'ssl') {{'selected'}} @endif @endif value="ssl">SSL</option><option @if(isset($mailgun_encryption_1)) @if($mailgun_encryption_1 == 'tls') {{'selected'}} @endif @endif value="tls">TLS</option></select></div><div class="col-sm-4 form-group "><label for="mailgun_port_1" class="control-label mb-1">{{__('Mailgun Port')}}</label><input type="number" value=""  name="mailgun_port_1'+j+'" class="form-control"></div><div class="col-sm-4 form-group "><label for="mailgun_user_name_1" class="control-label mb-1">{{__('Mailgun User Name')}}</label><input type="text" value=""  name="mailgun_user_name_1'+j+'" class="form-control"></div><div class="col-sm-4 form-group "><label for="mailgun_password_1" class="control-label mb-1">{{__('Mailgun Password')}}</label><input type="password" value="" name="mailgun_password_1'+j+'" class="form-control"></div><div class="col-sm-4 form-group "><label for="mailgun_from_name_1" class="control-label mb-1">{{__('Mailgun From Name')}}</label><input type="text" value=""  name="mailgun_from_name_1'+j+'" class="form-control"></div><div class="col-sm-4 form-group "><label for="mailgun_from_email_1" class="control-label mb-1">{{__('Mailgun From Email')}}</label><input type="text" value=""  name="mailgun_from_email_1'+j+'" class="form-control"></div><div class="col-md-12"><input type="radio"  name="transcation_email" value="mailgun_1'+j+'" class="{{$transcation_email}} custom-radio d-none" id="email-radio-4'+j+'"><label for="email-radio-4'+j+'" class="custom-checkbox-label pr-3">Transcation Email</label><input type="radio"  name="promotion_email" value="mailgun_1'+j+'" class="{{$promotion_email}} custom-radio d-none" id="email-radio-5'+j+'"> <label for="email-radio-5'+j+'" class="custom-checkbox-label pr-3">Promotion Email</label><input type="radio"  name="notification_email" value="mailgun_1'+j+'" class="{{$notification_email}} custom-radio d-none" id="email-radio-6'+j+'"> <label for="email-radio-6'+j+'" class="custom-checkbox-label pr-3">Notification Email</label> </div>  <div class="col-md-12 checkbox_con"><input type="checkbox" name="transcation_email_group[]" value="mailgun_1'+j+'" class="custom-checkbox d-none" id="t_mailgun_email-check-1'+j+'"><label for="t_mailgun_email-check-1'+j+'" class="custom-checkbox-label pr-3">Transcation Email Group</label><input type="checkbox" name="promotion_email_group[]" value="mailgun_1'+j+'" class="custom-checkbox d-none" id="p_mailgun_email-check-1'+j+'"> <label for="p_mailgun_email-check-1'+j+'" class="custom-checkbox-label pr-3">Promotion Email Group</label> <input type="checkbox" name="notification_email_group[]" value="mailgun_1'+j+'" class="custom-checkbox d-none" id="n_mailgun_email-check-1'+j+'"> <label for="n_mailgun_email-check-1'+j+'" class="custom-checkbox-label pr-3">Notification Email Group</label> </div> </div></div>');
            $('#Mailgun_con'+j).show();

            }
       });

  $("#sendgridadd").click(function(){
    $(".chgdeletesendgrid").show();
    var k=$('#sendgrid_count').val();
if(k<=2)
            {
           k++;
           $('#sendgrid_count').val(k);
            $('#SendGrid_con>div.gat_con_in').append(' <div class="gat_con" id="SendGrid_con'+k+'"><div class="row"><div class="col-sm-4 form-group"><label for="sendgrid_host_1" class="control-label mb-1">{{__('Sendgrid Host')}}</label><input type="text" value=""  name="sendgrid_host_1'+k+'" class="form-control"></div><div class="col-sm-4 form-group "><label for="sendgrid_encryption_1" class="control-label mb-1">{{__('Encryption')}}</label><select name="sendgrid_encryption_1'+k+'" class="form-control"><option value="none">None</option><option @if(isset($sendgrid_encryption_1)) @if($sendgrid_encryption_1 == 'ssl') {{'selected'}} @endif @endif value="ssl">SSL</option><option @if(isset($sendgrid_encryption_1)) @if($sendgrid_encryption_1 == 'tls') {{'selected'}} @endif @endif value="tls"> TLS</option></select></div><div class="col-sm-4 form-group "><label for="sendgrid_port_1" class="control-label mb-1">{{__('Sendgrid Port')}}</label><input type="number" value=""  name="sendgrid_port_1'+k+'" class="form-control"> </div><div class="col-sm-4 form-group "><label for="sendgrid_user_name_1" class="control-label mb-1">{{__('Sendgrid User Name')}}</label><input type="text" value="" name="sendgrid_user_name_1'+k+'" class="form-control"></div><div class="col-sm-4 form-group "><label for="sendgrid_password_1" class="control-label mb-1">{{__('Sendgrid Password')}}</label><input type="password" value=""  name="sendgrid_password_1'+k+'" class="form-control"></div><div class="col-sm-4 form-group "><label for="sendgrid_from_name_1" class="control-label mb-1">{{__('Sendgrid From Name')}}</label><input type="text" value=""  name="sendgrid_from_name_1'+k+'" class="form-control"></div><div class="col-sm-4 form-group "><label for="sendgrid_from_email_1" class="control-label mb-1">{{__('Sendgrid From Email')}}</label><input type="text" value=""  name="sendgrid_from_email_1'+k+'" class="form-control"></div><div class="col-md-12"><input type="radio"  name="transcation_email" value="sendgrid_1'+k+'" class="{{$transcation_email}} custom-radio d-none" id="email-radio-sg1'+k+'"> <label for="email-radio-sg1'+k+'" class="custom-checkbox-label pr-3">Transcation Email</label><input type="radio"  name="promotion_email" value="sendgrid_1'+k+'" class="{{$promotion_email}} custom-radio d-none"  id="email-radio-sg2'+k+'"><label for="email-radio-sg2'+k+'" class="custom-checkbox-label pr-3">Promotion Email</label><input type="radio"  name="notification_email" value="sendgrid_1'+k+'" class="{{$notification_email}} custom-radio d-none" id="email-radio-sg3'+k+'"> <label for="email-radio-sg3'+k+'" class="custom-checkbox-label pr-3">Notification Email</label> </div>  <div class="col-md-12 checkbox_con"><input type="checkbox" name="transcation_email_group[]" value="sendgrid_1'+k+'" class="custom-checkbox d-none" id="t_sendgrid_email-check-1'+k+'"><label for="t_sendgrid_email-check-1'+k+'" class="custom-checkbox-label pr-3">Transcation Email Group</label><input type="checkbox" name="promotion_email_group[]" value="sendgrid_1'+k+'" class="custom-checkbox d-none" id="p_sendgrid_email-check-1'+k+'"> <label for="p_sendgrid_email-check-1'+k+'" class="custom-checkbox-label pr-3">Promotion Email Group</label> <input type="checkbox" name="notification_email_group[]" value="sendgrid_1'+k+'" class="custom-checkbox d-none" id="n_sendgrid_email-check-1'+k+'"> <label for="n_sendgrid_email-check-1'+k+'" class="custom-checkbox-label pr-3">Notification Email Group</label> </div> </div></div>');
            $('#SendGrid_con'+k).show();
     
    }
             });
  $("#smtpadd").click(function(){
    $(".chgdeletesmtp").show();
    var l=$('#smtp_count').val();
if(l<=2)
            {
           l++;
           $('#smtp_count').val(l);
            $('#SMTP_con>div.gat_con_in').append('<div class="gat_con" id="SMTP_con'+l+'"><div class="row"><div class="col-sm-4 form-group"><label for="smtp_host_1" class="control-label mb-1">{{__('SMTP Host')}}</label><input type="text" value="" id="" name="smtp_host_1'+l+'" class="form-control"></div><div class="col-sm-4 form-group"><label for="smtp_encryption_1" class="control-label mb-1">{{__('Encryption')}}</label><select name="smtp_encryption_1'+l+'" class="form-control"><option value="none">None</option><option @if(isset($smtp_encryption_1)) @if($smtp_encryption_1 == 'ssl') {{'selected'}} @endif @endif value="ssl">SSL</option><option @if(isset($smtp_encryption_1)) @if($smtp_encryption_1 == 'tls') {{'selected'}} @endif @endif value="tls">TLS</option></select> </div><div class="col-sm-4 form-group"><label for="smtp_port_1" class="control-label mb-1">{{__('SMTP Port')}}</label><input type="number" value=""  name="smtp_port_1'+l+'" class="form-control"></div><div class="col-sm-4 form-group"><label for="smtp_user_name_1" class="control-label mb-1">{{__('SMTP User Name')}}</label><input type="text" value=""  name="smtp_user_name_1'+l+'" class="form-control"></div><div class="col-sm-4 form-group"><label for="smtp_password_1" class="control-label mb-1">{{__('SMTP Password')}}</label><input type="password" value=""  name="smtp_password_1'+l+'" class="form-control"></div><div class="col-sm-4 form-group"><label for="smtp_from_name_1" class="control-label mb-1">{{__('SMTP From Name')}}</label><input type="text" value=""  name="smtp_from_name_1'+l+'" class="form-control"></div><div class="col-sm-4 form-group"><label for="smtp_from_email_1" class="control-label mb-1">{{__('SMTP From Email')}}</label><input type="text" value=""  name="smtp_from_email_1'+l+'" class="form-control"></div><div class="col-md-12"><input type="radio"  name="transcation_email" value="smtp_1'+l+'" class="{{$transcation_email}} custom-radio d-none" id="email-radio-smtp-1'+l+'"><label for="email-radio-smtp-1'+l+'" class="custom-checkbox-label pr-3">Transcation Email</label><input type="radio"  name="promotion_email" value="smtp_1'+l+'" class="{{$promotion_email}} custom-radio d-none" id="email-radio-smtp-2'+l+'"><label for="email-radio-smtp-2'+l+'" class="custom-checkbox-label pr-3">Promotion Email</label><input type="radio"  name="notification_email" value="smtp_1'+l+'" class="{{$notification_email}} custom-radio d-none" id="email-radio-smtp-3'+l+'"><label for="email-radio-smtp-3'+l+'" class="custom-checkbox-label pr-3">Notification Email</label></div>  <div class="col-md-12 checkbox_con"><input type="checkbox" name="transcation_email_group[]" value="smtp_1'+l+'" class="custom-checkbox d-none" id="t_smtp_email-check-1'+l+'"><label for="t_smtp_email-check-1'+l+'" class="custom-checkbox-label pr-3">Transcation Email Group</label><input type="checkbox" name="promotion_email_group[]" value="smtp_1'+l+'" class="custom-checkbox d-none" id="p_smtp_email-check-1'+l+'"> <label for="p_smtp_email-check-1'+l+'" class="custom-checkbox-label pr-3">Promotion Email Group</label> <input type="checkbox" name="notification_email_group[]" value="smtp_1'+l+'" class="custom-checkbox d-none" id="n_smtp_email-check-1'+l+'"> <label for="n_smtp_email-check-1'+l+'" class="custom-checkbox-label pr-3">Notification Email Group</label> </div> </div></div>');
             $('#SMTP_con'+l).show();
             }
             });
  $("#mailchimpadd").click(function(){
    $(".chgdeletemailchimp").show();
    var m=$('#mailchimp_count').val();
if(m<=2)
            {
           m++;
           $('#mailchimp_count').val(m);
            $('#Mailchimp_con>div.gat_con_in').append('<div class="gat_con" id="Mailchimp_con'+m+'"><div class="row"><div class="col-sm-4 form-group"><label for="mailchimp_host_1" class="control-label mb-1">{{__('Mailchimp Host')}}</label><input type="text" value="" id="mailchimp_host_1" name="mailchimp_host_1'+m+'" class="form-control"></div><div class="col-sm-4 form-group"><label for="mailchimp_encryption_1" class="control-label mb-1">{{__('Encryption')}}</label><select name="mailchimp_encryption_1'+m+'" class="form-control"><option value="none">None</option><option @if(isset($mailchimp_encryption_1)) @if($mailchimp_encryption_1 == 'ssl') {{'selected'}} @endif @endif value="ssl">SSL</option><option @if(isset($mailchimp_encryption_1)) @if($mailchimp_encryption_1 == 'tls') {{'selected'}} @endif @endif value="tls">TLS</option></select></div><div class="col-sm-4 form-group"><label for="mailchimp_port_1" class="control-label mb-1">{{__('Mailchimp Port')}}</label><input type="number" value="" id="mailchimp_port_1" name="mailchimp_port_1'+m+'" class="form-control"></div><div class="col-sm-4 form-group"><label for="mailchimp_user_name_1" class="control-label mb-1">{{__('Mailchimp User Name')}}</label><input type="text" value="" id="mailchimp_user_name_1" name="mailchimp_user_name_1'+m+'" class="form-control"></div><div class="col-sm-4 form-group"><label for="mailchimp_password_1" class="control-label mb-1">{{__('Mailchimp Password')}}</label><input type="password" value="" id="mailchimp_password_1" name="mailchimp_password_1'+m+'" class="form-control"></div><div class="col-sm-4 form-group"><label for="mailchimp_from_name_1" class="control-label mb-1">{{__('Mailchimp From Name')}}</label><input type="text" value="" id="mailchimp_from_name_1" name="mailchimp_from_name_1'+m+'" class="form-control"></div><div class="col-sm-4 form-group"><label for="mailchimp_from_email_1" class="control-label mb-1">{{__('Mailchimp From Email')}}</label><input type="text" value="" id="mailchimp_from_email_1" name="mailchimp_from_email_1'+m+'" class="form-control"></div><div class="col-md-12"><input type="radio" name="transcation_email" value="mailchimp_1'+m+'" class="{{$transcation_email}} custom-radio d-none" id="email-radio-mc-1'+m+'"><label for="email-radio-mc-1'+m+'" class="custom-checkbox-label pr-3">Transcation Email</label><input type="radio" name="promotion_email" value="mailchimp_1'+m+'" class="{{$promotion_email}} custom-radio d-none" id="email-radio-mc-2'+m+'"><label for="email-radio-mc-2'+m+'" class="custom-checkbox-label pr-3">Promotion Email</label><input type="radio" name="notification_email" value="mailchimp_1'+m+'" class="{{$notification_email}} custom-radio d-none" id="email-radio-mc-3'+m+'"><label for="email-radio-mc-3'+m+'" class="custom-checkbox-label pr-3">Notification Email</label> </div>  <div class="col-md-12 checkbox_con"><input type="checkbox" name="transcation_email_group[]" value="mailchimp_1'+m+'" class="custom-checkbox d-none" id="t_mailchimp_email-check-1'+m+'"><label for="t_mailchimp_email-check-1'+m+'" class="custom-checkbox-label pr-3">Transcation Email Group</label><input type="checkbox" name="promotion_email_group[]" value="mailchimp_1'+m+'" class="custom-checkbox d-none" id="p_mailchimp_email-check-1'+m+'"> <label for="p_mailchimp_email-check-1'+m+'" class="custom-checkbox-label pr-3">Promotion Email Group</label> <input type="checkbox" name="notification_email_group[]" value="mailchimp_1'+m+'" class="custom-checkbox d-none" id="n_mailchimp_email-check-1'+m+'"> <label for="n_mailchimp_email-check-1'+m+'" class="custom-checkbox-label pr-3">Notification Email Group</label> </div></div></div>');
             $('#Mailchimp_con'+m).show();
             }
             });
});
</script>


         


          <div class="row m-0"> 
            <div class="col-md-12"><span class="response"></span></div>
            <div class="col-sm-12 pt-3"> <h6><strong>{{ Form::label('communication_channel', 'Communication channel') }}</strong></h6>
              @php $have_channel = ''; @endphp
              @if(isset($communication_channels))
              <div class="form-group com_channel align-items-center">
                <?php $i=0; ?>
                @foreach ($communication_channels as $key => $value)
                @php $sel=''; @endphp
                @if(isset($active_channels))
                @foreach($active_channels as $type_key => $val)
                @if($key == $type_key) 
                @php $sel = 'selected'; @endphp 
                @php $have_channel = 'yes'; @endphp 
                @endif 
                @endforeach
                @endif
                  <input type="checkbox" name="check_list[]" class="check_list custom-checkbox" id="com-ch-<?php echo $i; ?>" @if($sel != '')     checked="true" @endif value="{{ $key }}">
                  <label for="com-ch-<?php echo $i; ?>" class="custom-checkbox-label pr-3">{{ $value }}</label>
                  <?php $i++; ?>
                @endforeach
              


              </div>
              @endif </div>
            <div class="col-sm-6 form-group ">
              <label for="from_name" class="control-label mb-1">{{__('From Name')}}</label>
              <input required type="text" value="{{isset($from_name)?$from_name:''}}"  name="from_name" class="form-control">
            </div>
            <div class="col-sm-6 form-group ">
              <label for="from_email" class="control-label mb-1">{{__('From Email')}}</label>
              <input required type="email" value="{{isset($from_email)?$from_email:''}}"  name="from_email" class="form-control">
            </div>
            <div class="col-sm-4 form-group ">
              <label for="" class="control-label mb-1">{{__('Transcation Email')}}</label>
              <input type="text" readonly value="{{$transcation_email}}"  name="te" class="form-control">
            </div>
            <div class="col-sm-4 form-group ">
              <label for="" class="control-label mb-1">{{__('Promotion Email')}}</label>
              <input type="text" readonly value="{{$promotion_email}}" name="te" class="form-control">
            </div>
              <div class="col-sm-4 form-group ">
              <label for="" class="control-label mb-1">{{__('Notification Email')}}</label>
              <input type="text" readonly value="{{$notification_email}}"  name="te" class="form-control">
            </div>
            <div class="col-sm-4 form-group ">
              <label for="from_email" class="control-label mb-1">{{__('Transcation SMS')}}</label>
              <input type="text" readonly value="{{$transcation_sms}}"  name="ts" class="form-control">
            </div>
              <div class="col-sm-4 form-group ">
              <label for="from_email" class="control-label mb-1">{{__('Promotion SMS')}}</label>
              <input type="text" readonly value="{{$promotion_sms}}"  name="ts" class="form-control">
              </div>
              <div class="col-sm-4 form-group ">
              <label for="from_email" class="control-label mb-1">{{__('Notification SMS')}}</label>
              <input type="text" readonly value="{{$notification_sms}}"  name="ts" class="form-control">
            </div>
            <div class="col-sm-4 form-group ">
              <label for="" class="control-label mb-1">{{__('Transcation Email Group')}}</label>
              <textarea readonly name="teg" class="form-control">{{join(', ', $transcation_email_group)}}</textarea> 
            </div>
            <div class="col-sm-4 form-group ">
              <label for="" class="control-label mb-1">{{__('Promotion Email Group')}}</label>
              <textarea readonly name="peg" class="form-control">{{join(', ', $promotion_email_group)}}</textarea> 
            </div>
            <div class="col-sm-4 form-group ">
              <label for="" class="control-label mb-1">{{__('Notification Email Group')}}</label>
              <textarea readonly name="peg" class="form-control">{{join(', ', $notification_email_group)}}</textarea> 
            </div>
          </div>
          @if($have_channel != '')
          <div class="row m-0"> @foreach($channels as $channel)		
            @php $c_gateways = $channel->getChannelGateway; @endphp
            @if(count($c_gateways))
            @php $select ='';  $channel_name = $channel->GetTemplateType->name; @endphp 
            <div class="col-md-12 pt-3">
              <h6><strong>{{$channel_name}}</strong></h6>
            </div>
            <div class="col-md-12">
              <ul id="{{$channel_name}}" class='channel_gateway d-flex'>
                @foreach($c_gateways as $c_gateway)
                <li data-block="{{str_replace(" ", "",$channel_name)}}" class="{{$c_gateway->name}}_con"> @if(in_array($c_gateway->id, $cpm_gateways))
                  @php $select = 'yes'; @endphp
                  @endif
                  <!--<input type="checkbox" name="gateway_list[]" class="gateway_list custom-checkbox" id="sms-<?php echo $i; ?>" @if($select != '') checked @endif value="{{$c_gateway->id}}">
                  <label for="sms-<?php echo $i; ?>" class="custom-checkbox-label pr-3">{{$c_gateway->id}}-{{$c_gateway->name}}</label>-->
                  <label class="gateway_title pr-3">{{$c_gateway->name}}</label></li>
                @php $select =''; @endphp
                <?php $i++; ?>
                @endforeach
              </ul>
            </div>
            <div id="{{str_replace(" ", "",$channel_name)}}_container" class='gat_container col-md-12'> @foreach($c_gateways as $c_gateway)
              @php $gateway = $c_gateway->name; @endphp
              
              @if($gateway == "ElitBuzz")
              <div class="gat_con" id="ElitBuzz_con">
                <div class="row">
                  <div class="col-sm-4 form-group ">
                    <label for="elitbuzz_sender_id_1" class="control-label mb-1">{{__('Sender ID')}}</label>
                    <input type="text" value="{{isset($elitbuzz_sender_id_1)?$elitbuzz_sender_id_1:''}}"  name="elitbuzz_sender_id_1" class="form-control">
                  </div>
                  <div class="col-sm-4 form-group ">
                    <label for="elitbuzz_user_name_1" class="control-label mb-1">{{__('User Name')}}</label>
                    <input type="text" value="{{isset($elitbuzz_user_name_1)?$elitbuzz_user_name_1:''}}"  name="elitbuzz_user_name_1" class="form-control">
                  </div>
                  <div class="col-sm-4 form-group ">
                    <label for="elitbuzz_password_1" class="control-label mb-1">{{__('Password')}}</label>
                    <input type="password" value="{{isset($elitbuzz_password_1)?$elitbuzz_password_1:''}}" name="elitbuzz_password_1" class="form-control">
                  </div>
                  <div class="col-md-12">
                    <input type="radio" @if($transcation_sms == 'elitbuzz_1') checked @endif name="transcation_sms" value="elitbuzz_1" class="{{$transcation_sms}} custom-radio d-none" id="sms-radio-1">
                    <label for="sms-radio-1" class="custom-checkbox-label pr-3">Transcation SMS</label>
                    <input type="radio" @if($promotion_sms == 'elitbuzz_1') checked @endif name="promotion_sms" value="elitbuzz_1" class="{{$promotion_sms}} custom-radio d-none" id="sms-radio-2">
                    <label for="sms-radio-2" class="custom-checkbox-label pr-3">Promotion SMS</label>
                    <input type="radio" @if($notification_sms == 'elitbuzz_1') checked @endif name="notification_sms" value="elitbuzz_1" class="{{$notification_sms}} custom-radio d-none" id="sms-radio-3">
                    <label for="sms-radio-3" class="custom-checkbox-label pr-3">Notification SMS</label> </div>
                </div>
              </div>
@endif
              
              @if($gateway == "ValueFirst")
              <div class="gat_con" id="ValueFirst_con">
                <div class="row"> 
                  
                  <!--<label for="valuefirst_sender_id_1" class="control-label mb-1">{{__('ValueFirst Sender ID')}}</label>
			<input type="text" value="{{isset($valuefirst_sender_id_1)?$valuefirst_sender_id_1:''}}" id="" name="valuefirst_sender_id_1" class="form-control">-->
                  <div class="col-sm-4 form-group ">
                    <label for="valuefirst_user_name_1" class="control-label mb-1">{{__('User Name')}}</label>
                  <input type="text" value="{{isset($valuefirst_user_name_1)?$valuefirst_user_name_1:''}}"  name="valuefirst_user_name_1" class="form-control"></div>
                  <div class="col-sm-4 form-group ">
                    <label for="valuefirst_password_1" class="control-label mb-1">{{__('Password')}}</label>
                    <input type="password" value="{{isset($valuefirst_password_1)?$valuefirst_password_1:''}}"  name="valuefirst_password_1" class="form-control">
                  </div>
                  <div class="col-sm-4 form-group ">
                    <label for="valuefirst_from_name_1" class="control-label mb-1">{{__('From Name')}}</label>
                  <input type="text" value="{{isset($valuefirst_from_name_1)?$valuefirst_from_name_1:''}}"  name="valuefirst_from_name_1" class="form-control"></div>
                  <div class="col-sm-4 form-group ">
                    <label for="valuefirst_url_1" class="control-label mb-1">{{__('URL')}}</label>
                    <input type="text" value="{{isset($valuefirst_url_1)?$valuefirst_url_1:''}}"  name="valuefirst_url_1" class="form-control">
                  </div>
                  <div class="col-sm-4 form-group ">
                    <label for="valuefirst_responcefull_url_1" class="control-label mb-1">{{__('Response full URL')}}</label>
                    <input type="text" value="{{isset($valuefirst_responcefull_url_1)?$valuefirst_responcefull_url_1:''}}"  name="valuefirst_responcefull_url_1" class="form-control">
                  </div>
                  <div class="col-md-12">
                    <input type="radio" @if($transcation_sms == 'valuefirst_1') checked @endif name="transcation_sms" value="valuefirst_1" class="{{$transcation_sms}} custom-radio d-none" id="sms-radio-11">
                    <label for="sms-radio-11" class="custom-checkbox-label pr-3">Transcation SMS</label>
                    <input type="radio" @if($promotion_sms == 'valuefirst_1') checked @endif name="promotion_sms" value="valuefirst_1" class="{{$promotion_sms}} custom-radio d-none" id="sms-radio-12">
                    <label for="sms-radio-12" class="custom-checkbox-label pr-3">Promotion SMS</label>
                    <input type="radio" @if($notification_sms == 'valuefirst_1') checked @endif name="notification_sms" value="valuefirst_1" class="{{$notification_sms}} custom-radio d-none" id="sms-radio-13">
                    <label for="sms-radio-13" class="custom-checkbox-label pr-3">Notification SMS</label> </div>
                </div>
              </div>
@endif
              
              @if($gateway == "ESMS")
              <div class="gat_con" id="ESMS_con">
                <div class="row">
                  <div class="col-sm-4 form-group ">
                    <label for="esms_sender_id_1" class="control-label mb-1">{{__('ESMS Sender ID')}}</label>
                    <input type="text" value="{{isset($esms_sender_id_1)?$esms_sender_id_1:''}}"  name="esms_sender_id_1" class="form-control">
                  </div>
                  <div class="col-sm-4 form-group ">
                    <label for="esms_user_name_1" class="control-label mb-1">{{__('User Name')}}</label>
                    <input type="text" value="{{isset($esms_user_name_1)?$esms_user_name_1:''}}"  name="esms_user_name_1" class="form-control">
                  </div>
                  <div class="col-sm-4 form-group ">
                    <label for="esms_password_1" class="control-label mb-1">{{__('Password')}}</label>
                    <input type="password" value="{{isset($esms_password_1)?$esms_password_1:''}}"  name="esms_password_1" class="form-control">
                  </div>

                  <div class="col-sm-4 form-group ">
                    <label for="esms_from_name_1" class="control-label mb-1">{{__('From Name')}}</label>
                  <input type="text" value="{{isset($esms_from_name_1)?$esms_from_name_1:''}}" id="" name="esms_from_name_1" class="form-control"></div>
                  <div class="col-sm-4 form-group ">
                    <label for="esms_url_1" class="control-label mb-1">{{__('URL')}}</label>
                    <input type="text" value="{{isset($esms_url_1)?$esms_url_1:''}}" id="" name="esms_url_1" class="form-control">
                  </div>
                  <div class="col-sm-4 form-group ">
                    <label for="esms_responcefull_url_1" class="control-label mb-1">{{__('Response full URL')}}</label>
                    <input type="text" value="{{isset($esms_responcefull_url_1)?$esms_responcefull_url_1:''}}" id="" name="esms_responcefull_url_1" class="form-control">
                  </div>


                  <div class="col-md-12">
                    <input type="radio" @if($transcation_sms == 'esms_1') checked @endif name="transcation_sms" value="esms_1" class="{{$transcation_sms}} custom-radio d-none" id="sms-radio-21">
                    <label for="sms-radio-21" class="custom-checkbox-label pr-3">Transcation SMS</label>
                    <input type="radio" @if($promotion_sms == 'esms_1') checked @endif name="promotion_sms" value="esms_1" class="{{$promotion_sms}} custom-radio d-none" id="sms-radio-31">
                    <label for="sms-radio-31" class="custom-checkbox-label pr-3">Promotion SMS</label>
                    <input type="radio" @if($notification_sms == 'esms_1') checked @endif name="notification_sms" value="esms_1" class="{{$notification_sms}} custom-radio d-none" id="sms-radio-41">
                    <label for="sms-radio-41" class="custom-checkbox-label pr-3">Notification SMS</label> </div>
                </div>
              </div>
@endif


             
              @if($gateway == "Gmail")
   
              <div class="gmailbase" id="gmailbase">

              <div class="gat_con" id="Gmail_con">
                  <div class="gat_con_in">
                  @for($cnt = 1; $cnt <= (isset($gmail_count)? $gmail_count : 1); $cnt++)
    <?php if($cnt != 1){ $inc = '1'.$cnt;} else{ $inc = $cnt; }
      $m_names = array(
        'gmail_port_1' => 'gmail_port_',
        'gmail_host_1' => 'gmail_host_',
        'gmail_encryption_1' => 'gmail_encryption_',
        'gmail_user_name_1' => 'gmail_user_name_',
        'gmail_password_1' => 'gmail_password_',
        'gmail_from_name_1' =>'gmail_from_name_',
        'gmail_from_email_1' => 'gmail_from_email_');
     
      foreach ($m_names as $key => $value) {
        $$key = Helpers::get_company_meta($value.$inc);
      }
    ?>
              <div class="row">
                <div class="col-sm-4 form-group ">
                  <label for="gmail_host_{{$inc}}" class="control-label mb-1">{{__('GMAIL Host')}}</label>
                  <input type="text" value="{{isset($gmail_host_1)?$gmail_host_1:''}}"  name="gmail_host_{{$inc}}" class="form-control">
                  </div>
                  <div class="col-sm-4 form-group ">
                  <label for="gmail_encryption_{{$inc}}" class="control-label mb-1">{{__('Encryption')}}</label>
                  <select name="gmail_encryption_{{$inc}}" class="form-control">
                    <option value="none">None</option>
                    <option @if(isset($gmail_encryption_1)) @if($gmail_encryption_1 == 'ssl') {{'selected'}} @endif @endif value="ssl">
                  
                  SSL
                  
                  </option>
                    <option @if(isset($gmail_encryption_1)) @if($gmail_encryption_1 == 'tls') {{'selected'}} @endif @endif value="tls">
                  
                  TLS
                  
                  </option>
                  </select>
                  </div>
                  <div class="col-sm-4 form-group ">
                  <label for="gmail_port_{{$inc}}" class="control-label mb-1">{{__('GMAIL Port')}}</label>
                  <input type="number" value="{{isset($gmail_port_1)?$gmail_port_1:''}}"  name="gmail_port_{{$inc}}" class="form-control">
                  </div>
                  <div class="col-sm-4 form-group ">
                  <label for="gmail_user_name_{{$inc}}" class="control-label mb-1">{{__('GMAIL User Name')}}</label>
                  <input type="text" value="{{isset($gmail_user_name_1)?$gmail_user_name_1:''}}"  name="gmail_user_name_{{$inc}}" class="form-control">
                  </div>
                  <div class="col-sm-4 form-group ">
                  <label for="gmail_password_{{$inc}}" class="control-label mb-1">{{__('GMAIL Password')}}</label>
                  <input type="password" value="{{isset($gmail_password_1)?$gmail_password_1:''}}"  name="gmail_password_{{$inc}}" class="form-control">
                  </div>
                  <div class="col-sm-4 form-group ">
                  <label for="gmail_from_name_{{$inc}}" class="control-label mb-1">{{__('GMAIL From Name')}}</label>
                  <input type="text" value="{{isset($gmail_from_name_1)?$gmail_from_name_1:''}}"  name="gmail_from_name_{{$inc}}" class="form-control">
                  </div>
                  <div class="col-sm-4 form-group ">
                  <label for="gmail_from_email_{{$inc}}" class="control-label mb-1">{{__('GMAIL From Email')}}</label>
                  <input type="text" value="{{isset($gmail_from_email_1)?$gmail_from_email_1:''}}"  name="gmail_from_email_{{$inc}}" class="form-control">
                  </div>
                  <div class="col-md-12 radio_con">

                    <input type="radio" @if($transcation_email == "gmail_$inc") checked @endif name="transcation_email" value="gmail_{{$inc}}" class="{{$transcation_email}} custom-radio d-none" id="t_email-radio-{{$inc}}">
                    <label for="t_email-radio-{{$inc}}" class="custom-checkbox-label pr-3">Transcation Email</label>

                    <input type="radio" @if($promotion_email == "gmail_$inc") checked @endif name="promotion_email" value="gmail_{{$inc}}" class="{{$promotion_email}} custom-radio d-none" id="p_email-radio-{{$inc}}">
                    <label for="p_email-radio-{{$inc}}" class="custom-checkbox-label pr-3">Promotion Email</label>

                    <input type="radio" @if($notification_email == "gmail_$inc") checked @endif name="notification_email" value="gmail_{{$inc}}" class="{{$notification_email}} custom-radio d-none" id="n_email-radio-{{$inc}}">
                    <label for="n_email-radio-{{$inc}}" class="custom-checkbox-label pr-3">Notification Email</label> 
                   </div>

                   <div class="col-md-12 checkbox_con">
                    <input type="checkbox" @if(in_array("gmail_$inc",$transcation_email_group)) checked @endif name="transcation_email_group[]" value="gmail_{{$inc}}" class="custom-checkbox d-none" id="t_gmail_email-check-{{$inc}}">
                    <label for="t_gmail_email-check-{{$inc}}" class="custom-checkbox-label pr-3">Transcation Email Group</label>

                    <input type="checkbox" @if(in_array("gmail_$inc",$promotion_email_group)) checked @endif name="promotion_email_group[]" value="gmail_{{$inc}}" class="custom-checkbox d-none" id="p_gmail_email-check-{{$inc}}">
                    <label for="p_gmail_email-check-{{$inc}}" class="custom-checkbox-label pr-3">Promotion Email Group</label>

                    <input type="checkbox" @if(in_array("gmail_$inc",$notification_email_group)) checked @endif name="notification_email_group[]" value="gmail_{{$inc}}" class="custom-checkbox d-none" id="n_gmail_email-check-{{$inc}}">
                    <label for="n_gmail_email-check-{{$inc}}" class="custom-checkbox-label pr-3">Notification Email Group</label> 
                   </div>

               </div>
  @endfor
 <input type="text" class="count_txt" name="gmail_count" value="{{isset($gmail_count)?$gmail_count:''}}" id="gmail_count">
              </div>      
  @if(!isset($gmail_count) || (isset($gmail_count) && $gmail_count <=2))

            <button value="Add more" class="ch_add_more"  id="gmailadd" type="button">Add more</button><button value="Delete" class="ch_remove chgdeletegmail" type="button">Delete</button>
            @endif 

              </div>      
                @endif

              
                
                
                @if($gateway == "Mailgun")
              <div class="gat_con" id="Mailgun_con">
                  <div class="gat_con_in">
                  @for($cnt = 1; $cnt <= (isset($mailgun_count)? $mailgun_count : 1); $cnt++)
    <?php if($cnt != 1){ $inc = '1'.$cnt;} else{ $inc = $cnt; }
      $m_namesgun = array(
        'mailgun_port_1' => 'mailgun_port_',
        'mailgun_host_1' => 'mailgun_host_',
        'mailgun_encryption_1' => 'mailgun_encryption_',
        'mailgun_user_name_1' => 'mailgun_user_name_',
        'mailgun_password_1' => 'mailgun_password_',
        'mailgun_from_name_1' =>'mailgun_from_name_',
        'mailgun_from_email_1' => 'mailgun_from_email_');
     
      foreach ($m_namesgun as $key => $value) {
        $$key = Helpers::get_company_meta($value.$inc);
      }
    ?>
            <div class="row">
                <div class="col-sm-4 form-group ">
                <label for="mailgun_host_{{$inc}}" class="control-label mb-1">{{__('Mailgun Host')}}</label>
                <input type="text" value="{{isset($mailgun_host_1)?$mailgun_host_1:''}}"  name="mailgun_host_{{$inc}}" class="form-control">
                </div>
                <div class="col-sm-4 form-group ">
                <label for="mailgun_encryption_{{$inc}}" class="control-label mb-1">{{__('Encryption')}}</label>
                <select name="mailgun_encryption_{{$inc}}" class="form-control">
                  <option value="none">None</option>
                  <option @if(isset($mailgun_encryption_1)) @if($mailgun_encryption_1 == 'ssl') {{'selected'}} @endif @endif value="ssl">
                  
                  SSL
                  
                  </option>
                  <option @if(isset($mailgun_encryption_1)) @if($mailgun_encryption_1 == 'tls') {{'selected'}} @endif @endif value="tls">
                  
                  TLS
                  
                  </option>
                </select>
                </div>
                <div class="col-sm-4 form-group ">
                <label for="mailgun_port_{{$inc}}" class="control-label mb-1">{{__('Mailgun Port')}}</label>
                <input type="number" value="{{isset($mailgun_port_1)?$mailgun_port_1:''}}"  name="mailgun_port_{{$inc}}" class="form-control">
                </div>
                <div class="col-sm-4 form-group ">
                <label for="mailgun_user_name_{{$inc}}" class="control-label mb-1">{{__('Mailgun User Name')}}</label>
                <input type="text" value="{{isset($mailgun_user_name_1)?$mailgun_user_name_1:''}}"  name="mailgun_user_name_{{$inc}}" class="form-control">
                </div>
                <div class="col-sm-4 form-group ">
                <label for="mailgun_password_{{$inc}}" class="control-label mb-1">{{__('Mailgun Password')}}</label>
                <input type="password" value="{{isset($mailgun_password_1)?$mailgun_password_1:''}}" name="mailgun_password_{{$inc}}" class="form-control">
                </div>
                <div class="col-sm-4 form-group ">
                <label for="mailgun_from_name_{{$inc}}" class="control-label mb-1">{{__('Mailgun From Name')}}</label>
                <input type="text" value="{{isset($mailgun_from_name_1)?$mailgun_from_name_1:''}}"  name="mailgun_from_name_{{$inc}}" class="form-control">
                </div>
                <div class="col-sm-4 form-group ">
                <label for="mailgun_from_email_{{$inc}}" class="control-label mb-1">{{__('Mailgun From Email')}}</label>
                <input type="text" value="{{isset($mailgun_from_email_1)?$mailgun_from_email_1:''}}"  name="mailgun_from_email_{{$inc}}" class="form-control">
                </div>
                <div class="col-md-12 radio_con">

                  <input type="radio" @if($transcation_email == "mailgun_$inc") checked @endif name="transcation_email" value="mailgun_{{$inc}}" class="{{$transcation_email}} custom-radio d-none" id="a_email-radio-{{$inc}}">
                  <label for="a_email-radio-{{$inc}}" class="custom-checkbox-label pr-3">Transcation Email</label>

                  <input type="radio" @if($promotion_email == "mailgun_$inc") checked @endif name="promotion_email" value="mailgun_{{$inc}}" class="{{$promotion_email}} custom-radio d-none" id="b_email-radio-{{$inc}}">
                  <label for="b_email-radio-{{$inc}}" class="custom-checkbox-label pr-3">Promotion Email</label>

                  <input type="radio" @if($notification_email == "mailgun_$inc") checked @endif name="notification_email" value="mailgun_{{$inc}}" class="{{$notification_email}} custom-radio d-none" id="c_email-radio-{{$inc}}">
                  <label for="c_email-radio-{{$inc}}" class="custom-checkbox-label pr-3">Notification Email</label> </div>

                  <div class="col-md-12 checkbox_con">

                  <input type="checkbox" @if(in_array("mailgun_$inc", $transcation_email_group)) checked @endif name="transcation_email_group[]" value="mailgun_{{$inc}}" class="custom-checkbox d-none" id="t_mailgun_email-check-{{$inc}}">
                  <label for="t_mailgun_email-check-{{$inc}}" class="custom-checkbox-label pr-3">Transcation Email Group</label>

                  <input type="checkbox" @if(in_array("mailgun_$inc", $promotion_email_group)) checked @endif name="promotion_email_group[]" value="mailgun_{{$inc}}" class="custom-checkbox d-none" id="p_mailgun_email-check-{{$inc}}">
                  <label for="p_mailgun_email-check-{{$inc}}" class="custom-checkbox-label pr-3">Promotion Email Group</label>

                  <input type="checkbox" @if(in_array("mailgun_$inc", $notification_email_group)) checked @endif name="notification_email_group[]" value="mailgun_{{$inc}}" class="custom-checkbox d-none" id="n_mailgun_email-check-{{$inc}}">
                  <label for="n_mailgun_email-check-{{$inc}}" class="custom-checkbox-label pr-3">Notification Email Group</label> </div>
            </div>
              @endfor
<input type="text" class="count_txt" name="mailgun_count" value="{{isset($mailgun_count)?$mailgun_count:''}}" id="mailgun_count">
            </div>
  @if(!isset($mailgun_count) || (isset($mailgun_count) && $mailgun_count <=2))
            <button value="Add" class="chgmailgun  ch_add_more"  id="mailgunadd" type="button">Add more</button><button value="Delete" class="ch_remove chgdeletegun" type="button">Delete!</button>
            @endif
            </div>
            @endif   
              
   @if($gateway == "SendGrid")
              <div class="gat_con" id="SendGrid_con">
                  <div class="gat_con_in">
 @for($cnt = 1; $cnt <= (isset($sendgrid_count)? $sendgrid_count : 1); $cnt++)
    <?php if($cnt != 1){ $inc = '1'.$cnt;} else{ $inc = $cnt; }
      $m_namessendgrid = array(
        'sendgrid_port_1' => 'sendgrid_port_',
        'sendgrid_host_1' => 'sendgrid_host_',
        'sendgrid_encryption_1' => 'sendgrid_encryption_',
        'sendgrid_user_name_1' => 'sendgrid_user_name_',
        'sendgrid_password_1' => 'sendgrid_password_',
        'sendgrid_from_name_1' =>'sendgrid_from_name_',
        'sendgrid_from_email_1' => 'sendgrid_from_email_');
     
      foreach ($m_namessendgrid as $key => $value) {
        $$key = Helpers::get_company_meta($value.$inc);
      }
    ?>
            <div class="row">
                <div class="col-sm-4 form-group">
                <label for="sendgrid_host_{{$inc}}" class="control-label mb-1">{{__('Sendgrid Host')}}</label>
                <input type="text" value="{{isset($sendgrid_host_1)?$sendgrid_host_1:''}}"  name="sendgrid_host_{{$inc}}" class="form-control">
                </div>
                <div class="col-sm-4 form-group ">
                <label for="sendgrid_encryption_{{$inc}}" class="control-label mb-1">{{__('Encryption')}}</label>
                <select name="sendgrid_encryption_{{$inc}}" class="form-control">
                  <option value="none">None</option>
                  <option @if(isset($sendgrid_encryption_1)) @if($sendgrid_encryption_1 == 'ssl') {{'selected'}} @endif @endif value="ssl">
                  
                  SSL
                  
                  </option>
                  <option @if(isset($sendgrid_encryption_1)) @if($sendgrid_encryption_1 == 'tls') {{'selected'}} @endif @endif value="tls">
                  
                  TLS
                  
                  </option>
                </select>
                </div>
                <div class="col-sm-4 form-group ">
                <label for="sendgrid_port_{{$inc}}" class="control-label mb-1">{{__('Sendgrid Port')}}</label>
                <input type="number" value="{{isset($sendgrid_port_1)?$sendgrid_port_1:''}}"  name="sendgrid_port_{{$inc}}" class="form-control">
                </div>
                <div class="col-sm-4 form-group ">
                <label for="sendgrid_user_name_{{$inc}}" class="control-label mb-1">{{__('Sendgrid User Name')}}</label>
                <input type="text" value="{{isset($sendgrid_user_name_1)?$sendgrid_user_name_1:''}}" name="sendgrid_user_name_{{$inc}}" class="form-control">
                </div>
                <div class="col-sm-4 form-group ">
                <label for="sendgrid_password_{{$inc}}" class="control-label mb-1">{{__('Sendgrid Password')}}</label>
                <input type="password" value="{{isset($sendgrid_password_1)?$sendgrid_password_1:''}}"  name="sendgrid_password_{{$inc}}" class="form-control">
                </div>
                <div class="col-sm-4 form-group ">
                <label for="sendgrid_from_name_{{$inc}}" class="control-label mb-1">{{__('Sendgrid From Name')}}</label>
                <input type="text" value="{{isset($sendgrid_from_name_1)?$sendgrid_from_name_1:''}}"  name="sendgrid_from_name_{{$inc}}" class="form-control">
                </div>
                <div class="col-sm-4 form-group ">
                <label for="sendgrid_from_email_{{$inc}}" class="control-label mb-1">{{__('Sendgrid From Email')}}</label>
                <input type="text" value="{{isset($sendgrid_from_email_1)?$sendgrid_from_email_1:''}}"  name="sendgrid_from_email_{{$inc}}" class="form-control">
                </div>
                <div class="col-md-12 radio_con">
                  <input type="radio" @if($transcation_email == "sendgrid_$inc") checked @endif name="transcation_email" value="sendgrid_{{$inc}}" class="{{$transcation_email}} custom-radio d-none" id="d_email-radio-{{$inc}}">
                  <label for="d_email-radio-{{$inc}}" class="custom-checkbox-label pr-3">Transcation Email</label>
                  <input type="radio" @if($promotion_email == "sendgrid_$inc") checked @endif name="promotion_email" value="sendgrid_{{$inc}}" class="{{$promotion_email}} custom-radio d-none"  id="e_email-radio-{{$inc}}">
                   <label for="e_email-radio-{{$inc}}" class="custom-checkbox-label pr-3">Promotion Email</label>
                  <input type="radio" @if($notification_email == "sendgrid_$inc") checked @endif name="notification_email" value="sendgrid_{{$inc}}" class="{{$notification_email}} custom-radio d-none" id="f_email-radio-{{$inc}}">
                   <label for="f_email-radio-{{$inc}}" class="custom-checkbox-label pr-3">Notification Email</label> </div>

                   <div class="col-md-12 checkbox_con">
                    <input type="checkbox" @if(in_array("sendgrid_$inc",$transcation_email_group)) checked @endif name="transcation_email_group[]" value="sendgrid_{{$inc}}" class="custom-checkbox d-none" id="t_sendgrid_email-check-{{$inc}}">
                    <label for="t_sendgrid_email-check-{{$inc}}" class="custom-checkbox-label pr-3">Transcation Email Group</label>

                    <input type="checkbox" @if(in_array("sendgrid_$inc",$promotion_email_group)) checked @endif name="promotion_email_group[]" value="sendgrid_{{$inc}}" class=" custom-checkbox d-none" id="p_sendgrid_email-check-{{$inc}}">
                    <label for="p_sendgrid_email-check-{{$inc}}" class="custom-checkbox-label pr-3">Promotion Email Group</label>

                    <input type="checkbox" @if(in_array("sendgrid_$inc",$notification_email_group)) checked @endif name="notification_email_group[]" value="sendgrid_{{$inc}}" class="custom-checkbox d-none" id="n_sendgrid_email-check-{{$inc}}">
                    <label for="n_sendgrid_email-check-{{$inc}}" class="custom-checkbox-label pr-3">Notification Email Group</label> 
                   </div>
              </div>
                    @endfor


    <input type="text" class="count_txt" name="sendgrid_count" value="{{isset($sendgrid_count)?$sendgrid_count:''}}" id="sendgrid_count">
            </div>
  @if(!isset($sendgrid_count) || (isset($sendgrid_count) && $sendgrid_count <=2))
            <button value="Add mor" class="sendgridadd  ch_add_more"  id="sendgridadd" type="button">Add more</button><button value="Delete" class="ch_remove chgdeletesendgrid" type="button">Delete</button>

            @endif 
          </div>
            @endif
              
              @if($gateway == "SMTP")
              <div class="gat_con" id="SMTP_con">

                <div class="gat_con_in">
                  @for($cnt = 1; $cnt <= (isset($smtp_count)? $smtp_count : 1); $cnt++)
    <?php if($cnt != 1){ $inc = '1'.$cnt;} else{ $inc = $cnt; }
      $m_namessmtp = array(
        'smtp_port_1' => 'smtp_port_',
        'smtp_host_1' => 'smtp_host_',
        'smtp_encryption_1' => 'smtp_encryption_',
        'smtp_user_name_1' => 'smtp_user_name_',
        'smtp_password_1' => 'smtp_password_',
        'smtp_from_name_1' =>'smtp_from_name_',
        'smtp_from_email_1' => 'smtp_from_email_');
     
      foreach ($m_namessmtp as $key => $value) {
        $$key = Helpers::get_company_meta($value.$inc);
      }
    ?>
            <div class="row">
                <div class="col-sm-4 form-group">
                <label for="smtp_host_{{$inc}}" class="control-label mb-1">{{__('SMTP Host')}}</label>
                <input type="text" value="{{isset($smtp_host_1)?$smtp_host_1:''}}" id="" name="smtp_host_{{$inc}}" class="form-control">
                </div>
                <div class="col-sm-4 form-group">
                <label for="smtp_encryption_{{$inc}}" class="control-label mb-1">{{__('Encryption')}}</label>
                <select name="smtp_encryption_{{$inc}}" class="form-control">
                  <option value="none">None</option>
                  <option @if(isset($smtp_encryption_1)) @if($smtp_encryption_1 == 'ssl') {{'selected'}} @endif @endif value="ssl">
                  
                  SSL
                  
                  </option>
                  <option @if(isset($smtp_encryption_1)) @if($smtp_encryption_1 == 'tls') {{'selected'}} @endif @endif value="tls">
                  
                  TLS
                  
                  </option>
                </select>
                 </div>
                <div class="col-sm-4 form-group">
                <label for="smtp_port_{{$inc}}" class="control-label mb-1">{{__('SMTP Port')}}</label>
                <input type="number" value="{{isset($smtp_port_1)?$smtp_port_1:''}}"  name="smtp_port_{{$inc}}" class="form-control">
                 </div>
                <div class="col-sm-4 form-group">
                <label for="smtp_user_name_{{$inc}}" class="control-label mb-1">{{__('SMTP User Name')}}</label>
                <input type="text" value="{{isset($smtp_user_name_1)?$smtp_user_name_1:''}}"  name="smtp_user_name_{{$inc}}" class="form-control">
                </div>
                <div class="col-sm-4 form-group">
                <label for="smtp_password_{{$inc}}" class="control-label mb-1">{{__('SMTP Password')}}</label>
                <input type="password" value="{{isset($smtp_password_1)?$smtp_password_1:''}}"  name="smtp_password_{{$inc}}" class="form-control">
                </div>
                <div class="col-sm-4 form-group">
                <label for="smtp_from_name_{{$inc}}" class="control-label mb-1">{{__('SMTP From Name')}}</label>
                <input type="text" value="{{isset($smtp_from_name_1)?$smtp_from_name_1:''}}"  name="smtp_from_name_{{$inc}}" class="form-control">
                </div>
                <div class="col-sm-4 form-group">
                <label for="smtp_from_email_{{$inc}}" class="control-label mb-1">{{__('SMTP From Email')}}</label>
                <input type="text" value="{{isset($smtp_from_email_1)?$smtp_from_email_1:''}}"  name="smtp_from_email_{{$inc}}" class="form-control">
                </div>
                <div class="col-md-12 radio_con">
                  <input type="radio" @if($transcation_email == "smtp_$inc") checked @endif name="transcation_email" value="smtp_{{$inc}}" class="{{$transcation_email}} custom-radio d-none" id="g_email-radio-smtp-{{$inc}}">
                  <label for="g_email-radio-smtp-{{$inc}}" class="custom-checkbox-label pr-3">Transcation Email</label>
                  <input type="radio" @if($promotion_email == "smtp_$inc") checked @endif name="promotion_email" value="smtp_{{$inc}}" class="{{$promotion_email}} custom-radio d-none" id="h_email-radio-smtp-{{$inc}}">
                  <label for="h_email-radio-smtp-{{$inc}}" class="custom-checkbox-label pr-3">Promotion Email</label>
                  <input type="radio" @if($notification_email == "smtp_$inc") checked @endif name="notification_email" value="smtp_{{$inc}}" class="{{$notification_email}} custom-radio d-none" id="i_email-radio-smtp-{{$inc}}">
                  <label for="i_email-radio-smtp-{{$inc}}" class="custom-checkbox-label pr-3">Notification Email</label></div>

                  <div class="col-md-12 checkbox_con">
                    <input type="checkbox" @if(in_array("smtp_$inc",$transcation_email_group)) checked @endif name="transcation_email_group[]" value="smtp_{{$inc}}" class="custom-checkbox d-none" id="t_smtp_email-check-{{$inc}}">
                    <label for="t_smtp_email-check-{{$inc}}" class="custom-checkbox-label pr-3">Transcation Email Group</label>

                    <input type="checkbox" @if(in_array("smtp_$inc",$promotion_email_group)) checked @endif name="promotion_email_group[]" value="smtp_{{$inc}}" class="custom-checkbox d-none" id="p_smtp_email-check-{{$inc}}">
                    <label for="p_smtp_email-check-{{$inc}}" class="custom-checkbox-label pr-3">Promotion Email Group</label>

                    <input type="checkbox" @if(in_array("smtp_$inc",$notification_email_group)) checked @endif name="notification_email_group[]" value="smtp_{{$inc}}" class="custom-checkbox d-none" id="n_smtp_email-check-{{$inc}}">
                    <label for="n_smtp_email-check-{{$inc}}" class="custom-checkbox-label pr-3">Notification Email Group</label> 
                   </div>

              </div>
                  @endfor

                  <input type="text" class="count_txt" name="smtp_count" value="{{isset($smtp_count)?$smtp_count:''}}" id="smtp_count">
            </div>
  @if(!isset($smtp_count) || (isset($smtp_count) && $smtp_count <=2))
            <button value="Add" class="smtpadd  ch_add_more"  id="smtpadd" type="button">Add more</button><button value="Delete" class="ch_remove chgdeletesmtp" type="button">Delete</button>
            @endif
              </div>
              @endif
              
              @if($gateway == "Mailchimp")
              <div class="gat_con" id="Mailchimp_con"><div class="gat_con_in">
                   @for($cnt = 1; $cnt <= (isset($mailchimp_count)? $mailchimp_count : 1); $cnt++)
    <?php if($cnt != 1){ $inc = '1'.$cnt;} else{ $inc = $cnt; }
      $m_namesmailchimp = array(
        'mailchimp_port_1' => 'mailchimp_port_',
        'mailchimp_host_1' => 'mailchimp_host_',
        'mailchimp_encryption_1' => 'mailchimp_encryption_',
        'mailchimp_user_name_1' => 'mailchimp_user_name_',
        'mailchimp_password_1' => 'mailchimp_password_',
        'mailchimp_from_name_1' =>'mailchimp_from_name_',
        'mailchimp_from_email_1' => 'mailchimp_from_email_');
     
      foreach ($m_namesmailchimp as $key => $value) {
        $$key = Helpers::get_company_meta($value.$inc);
      }
    ?>
            <div class="row">
                <div class="col-sm-4 form-group">
                <label for="mailchimp_host_{{$inc}}" class="control-label mb-1">{{__('Mailchimp Host')}}</label>
                <input type="text" value="{{isset($mailchimp_host_1)?$mailchimp_host_1:''}}" id="mailchimp_host_1" name="mailchimp_host_{{$inc}}" class="form-control">
                </div>
                <div class="col-sm-4 form-group">
                <label for="mailchimp_encryption_{{$inc}}" class="control-label mb-1">{{__('Encryption')}}</label>
                <select name="mailchimp_encryption_{{$inc}}" class="form-control">
                  <option value="none">None</option>
                  <option @if(isset($mailchimp_encryption_1)) @if($mailchimp_encryption_1 == 'ssl') {{'selected'}} @endif @endif value="ssl">
                  
                  SSL
                  
                  </option>
                  <option @if(isset($mailchimp_encryption_1)) @if($mailchimp_encryption_1 == 'tls') {{'selected'}} @endif @endif value="tls">
                  
                  TLS
                  
                  </option>
                </select>
                </div>
                <div class="col-sm-4 form-group">
                <label for="mailchimp_port_{{$inc}}" class="control-label mb-1">{{__('Mailchimp Port')}}</label>
                <input type="number" value="{{isset($mailchimp_port_1)?$mailchimp_port_1:''}}" id="mailchimp_port_1" name="mailchimp_port_{{$inc}}" class="form-control">
                </div>
                <div class="col-sm-4 form-group">
                <label for="mailchimp_user_name_{{$inc}}" class="control-label mb-1">{{__('Mailchimp User Name')}}</label>
                <input type="text" value="{{isset($mailchimp_user_name_1)?$mailchimp_user_name_1:''}}" id="mailchimp_user_name_1" name="mailchimp_user_name_{{$inc}}" class="form-control">
                </div>
                <div class="col-sm-4 form-group">
                <label for="mailchimp_password_{{$inc}}" class="control-label mb-1">{{__('Mailchimp Password')}}</label>
                <input type="password" value="{{isset($mailchimp_password_1)?$mailchimp_password_1:''}}" id="mailchimp_password_1" name="mailchimp_password_{{$inc}}" class="form-control">
                </div>
                <div class="col-sm-4 form-group">
                <label for="mailchimp_from_name_{{$inc}}" class="control-label mb-1">{{__('Mailchimp From Name')}}</label>
                <input type="text" value="{{isset($mailchimp_from_name_1)?$mailchimp_from_name_1:''}}" id="mailchimp_from_name_1" name="mailchimp_from_name_{{$inc}}" class="form-control">
                </div>
                <div class="col-sm-4 form-group">
                <label for="mailchimp_from_email_{{$inc}}" class="control-label mb-1">{{__('Mailchimp From Email')}}</label>
                <input type="text" value="{{isset($mailchimp_from_email_1)?$mailchimp_from_email_1:''}}" id="mailchimp_from_email_1" name="mailchimp_from_email_{{$inc}}" class="form-control">
                </div>
                 <div class="col-md-12 radio_con">
                  <input type="radio" @if($transcation_email == "mailchimp_$inc") checked @endif name="transcation_email" value="mailchimp_{{$inc}}" class="{{$transcation_email}} custom-radio d-none" id="x_email-radio-mc-{{$inc}}">
                  <label for="x_email-radio-mc-{{$inc}}" class="custom-checkbox-label pr-3">Transcation Email</label>
                  <input type="radio" @if($promotion_email == "mailchimp_$inc") checked @endif name="promotion_email" value="mailchimp_{{$inc}}" class="{{$promotion_email}} custom-radio d-none" id="y_email-radio-mc-{{$inc}}">
                  <label for="y_email-radio-mc-{{$inc}}" class="custom-checkbox-label pr-3">Promotion Email</label>
                  <input type="radio" @if($notification_email == "mailchimp_$inc") checked @endif name="notification_email" value="mailchimp_{{$inc}}" class="{{$notification_email}} custom-radio d-none" id="z_email-radio-mc-{{$inc}}">
                  <label for="z_email-radio-mc-{{$inc}}" class="custom-checkbox-label pr-3">Notification Email</label> </div>

                  <div class="col-md-12 checkbox_con">
                    <input type="checkbox" @if(in_array("mailchimp_$inc",$transcation_email_group)) checked @endif name="transcation_email_group[]" value="mailchimp_{{$inc}}" class="custom-checkbox d-none" id="t_mailchimp_email-check-{{$inc}}">
                    <label for="t_mailchimp_email-check-{{$inc}}" class="custom-checkbox-label pr-3">Transcation Email Group</label>

                    <input type="checkbox" @if(in_array("mailchimp_$inc",$promotion_email_group)) checked @endif name="promotion_email_group[]" value="mailchimp_{{$inc}}" class="custom-checkbox d-none" id="p_mailchimp_email-check-{{$inc}}">
                    <label for="p_mailchimp_email-check-{{$inc}}" class="custom-checkbox-label pr-3">Promotion Email Group</label>

                    <input type="checkbox" @if(in_array("mailchimp_$inc",$notification_email_group)) checked @endif name="notification_email_group[]" value="mailchimp_{{$inc}}" class="custom-checkbox d-none" id="n_mailchimp_email-check-{{$inc}}">
                    <label for="n_mailchimp_email-check-{{$inc}}" class="custom-checkbox-label pr-3">Notification Email Group</label> 
                   </div>

              </div>
                  @endfor

                  <input type="text" class="count_txt" name="mailchimp_count" value="{{isset($mailchimp_count)?$mailchimp_count:''}}" id="mailchimp_count">
            </div>
  @if(!isset($mailchimp_count) || (isset($mailchimp_count) && $mailchimp_count <=2))
            <button value="Add mor" class="mailchimpadd  ch_add_more"  id="mailchimpadd" type="button">Add more</button><button value="Delete" class="ch_remove chgdeletemailchimp" type="button">Delete</button>

            @endif 
              </div>
             
              @endif
              
              
              @endforeach </div>
            <p style="margin-top:20px;margin-bottom:20px;"></p>
            @endif
            
            @endforeach </div>
          @endif
          <div class="message"></div>
          <div class="col-sm-12 col-md-offset-2"> {{ Form::hidden('id', null, array('class' => 'form-control' )) }}
            <input type="hidden" name="callback" class="callback" value="1form_basic_reload" />
            <div class="form-group">
              <div class="col-md-12 text-right pt-3">
                <button type="reset" class="btn btn-outline-danger px-3" > {{__('Reset')}} </button>
                <button type="submit" class="btn btn-primary px-3"> {{__('Save')}} </button>
              </div>
            </div>
          </div>
          {!! Form::close() !!} </div>
      </div>
    </div>
  </div>
</div>       
</div>
       

@endsection
@section('footer-custom-css-js') 
<script src="{{ asset('js/jscolor.js') }}"></script> 
@endsection
