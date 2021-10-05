

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Profile Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!! Form::open(array('url' => 'upload_profile_files', 'id' => 'upload_profilepic', 'class' => 'form-upload mb-2', 'method'=>'POST')) !!}
      <div class="modal-body">
       <div class="changeimg-wrp">
            
              {{ csrf_field() }}
               <input type="hidden" name="profile_pid" value="{{$user_details->id}}">
               <input type="hidden" class="callback" name="callbackFunc" id="callbackFunc" value="show_profile_header">
               <input type="hidden" class="arg" value="{{$user_details->id}}" name="arg">
               <input type="hidden" class="delete_pic" value="0" name="delete_pic">
               @if($field_det) 
              <div class="advancedUpload_profilepic ">Upload Photo</div>
              <input type="hidden" value="" name="profile_photo" id="attach_profilepic">
             
              @endif
              
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="upload_profile()">Save changes</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

<div class="profile-left rounded box-shadow mb-3">
  <div class="row align-items-center">
        <div class="col-12 col-md-3">
          <div class="profile-pic p-2"> 
            <span class="loadpro"><i class="fas fa-user"></i></span>
            <img @if(!empty($user_details->profile_photo)) src="{{url('uploads/profile/'.$user_details->profile_photo)}}" @else src="{{asset('img/dp.png')}}" @endif alt="profile_photo" class="img-fluid" alt=""/> 
            <div class="changeimg"  data-toggle="modal" data-target="#exampleModal">
              <span><i class="fas fa-camera"></i> Change Photo</span>
            </div>
          </div>
           @if(!empty($user_details->profile_photo))
               <button type="button" class="btn-m procancelbtn"  onclick="delete_photo()"><i class="fa fa-trash" aria-hidden="true"></i></button>
             @endif
        </div>
        @if($show_cus_details)
        <div class="col-sm-4 px-sm-0">
          <h2>@if($user_details->first_name){{$user_details->first_name}}@endif @if($user_details->last_name){{$user_details->last_name}}@endif</h2>
          <ul class="mb-1">
            @if($user_details->email)<li class="pro-email"><i class="fas fa-envelope"></i> {{$user_details->email}}@else{{'--'}}</li>@endif
            @if($user_details->mobile)<li class="pro-phone"><i class="fas fa-phone"></i> @if($user_details->country_code){{$user_details->country_code}}@endif {{$user_details->mobile}} </li>@endif
            <li class="pro-cpmny"><i class="fas fa-building"></i>
              @if(isset($user_details->company->ori_cmp_org_name)){{$user_details->company->ori_cmp_org_name}}@else{{'--'}}@endif
              
            </li>
          </ul>
        </div>
        <div class="col-12 col-md-5 p-0">
          <div class="button-group p-3 text-sm-right pro-option">
            
              <a data-toggle="tooltip" data-placement="top" title="Phone" type="button" class="btn btn-success btn-sm" style="color: #fff;" href="{{config('constant.callcenter_url')}}/callmeout.php?number={{$user_details->country_code.$user_details->mobile}}&extension={{ Auth::user()->extension }}&callerid={{ Helpers::get_company_meta('outbound_caller_id') }}" target="_blank"><i class="fas fa-phone"></i> Call</a>

            <button data-toggle="tooltip" data-placement="top" title="Mail" type="button" id="email" class="btn btn-secondary btn-sm" onclick="get_mail_template('{{$user_details->email}}')" data-toggle="modal" data-target="#mailtemplate"><i class="fas fa-envelope"></i> Mail</button>
            <button data-toggle="tooltip" data-placement="top" title="SMS" type="button" class="btn btn-dark btn-sm" onclick="get_sms_template('{{$user_details->mobile}}')" data-toggle="modal" data-target="#smstemplate"><i class="fas fa-comment-alt"></i> SMS</button>
          </div>
        </div>

        @endif
      @if(!$show_cus_details) <div class="row row-eq-height"><div class="col-sm-6 form-group"><p>The customer details have been hidden</p> </div></div>@endif  



    

    
    

    



  </div>
</div>
<script type="text/javascript">
function delete_photo()
  {
    $('.delete_pic').val(1);
    $("#upload_profilepic").submit();
  }  
    var vars = {};
  var successFiles1  = [];
var errorFiles1    = [];
 var uploadObj_profilepic = $(".advancedUpload_profilepic").uploadFile({
  url:"/mail_attachment_upload",
  multiple:true,
  autoSubmit:false,
  fileName:"file",
  allowedTypes:"jpg,png,jpeg,pdf",
  maxFileSize:1024*1024*2,
  maxFileCount:1,
  returnType:'json',
  multiple:true,
  dragDrop:true,
  showStatusAfterSuccess:true,
  showDelete:false,
  showDone:false,
  dynamicFormData: function ()
  {
      var data = {type:1}
      return data;
  },
  onSelect:function(files) {
   
    setTimeout(function() {
      $("div.ajax-file-upload-error").remove();
    }, 5000);
  },
  onSuccess:function(files,data,xhr)
  {
  
    successFiles1.push({
      originalName: data.original_name,
      mimeType: data.mime_type,
      savedName: data.saved_name
    });

     attachments = JSON.stringify(successFiles1);

     $("#attach_profilepic").val(attachments);
     console.log(attachments)
     $("#upload_profilepic").submit(); 
    return;

    
  },
  onError: function(files, status, errMsg, pd)
  {
   
    errorFiles1.push(files[0]);
    return;
  },
  afterUploadAll: function(obj)
  {
   
    setTimeout(function() {
      $(".ajax-file-upload-statusbar").has(".ajax-file-upload-error").remove();
    }, 5000);
    if (errorFiles1.length !== 0)
    {
      console.log('Failure123');
    }
    else {

      console.log('Success123');
      var callbackFunc  = $("#callbackFunc").val();
      setTimeout(function() {
        location.reload();
      }, 3000);
      // console.log(callbackFunc);
      // if (callbackFunc !== '' && typeof callbackFunc != "undefined")
      // {
      //   window[callbackFunc](2);
      // }
    }
   
    }

});


</script>
