{!! Form::open(array('route' => 'search_smscategory', 'class' => 'listing2 form-common', 'method'=>'POST', 'name' => 'form-common')) !!}
<aside class="sidebar">
  <div class="search-box">
      <div class="row align-items-center justify-content-center">
        <div class="col-sm-2 text-center text-sm-left">
          <h5 class="m-0">Search</h5>
        </div>
        <div class="col-sm-5 mb-2 mb-sm-0">
        	{{ Form::text('search_keywords', null, array('id' => 'sms_search','class' => 'form-control','placeholder' => 'Keyword')) }}
        </div>
        <div class="col-sm-2 mb-2 mb-sm-0">
          {{ Form::submit('Find', array('class' => 'reset-pageno btn btn-primary btn-block')) }}
        {{ Form::hidden('pageno', 1, array('id' => 'pageno')) }}
        </div>
        <div class="col-sm-2">
          <button type="reset" class="btn btn-outline-danger btn-block" id="r1" onclick="resetResult();">Reset</button>
        </div>
        <input type="hidden" id="current_cus" value="{{$current_cus}}"/>
      <input type="hidden" id="user_mobile" value="<?php if(isset($user_mobile) && !empty($user_mobile)){ ?>{{$user_mobile}} <?php } ?>"/>
      </div>
  </div>
</aside>
<div class="row">
  <div class="col-md-4 px-0" id="list3"></div>
  <div class="col-md-8 email-content py-4 sms-content" id="sms-content1"></div>
</div>
{!! Form::close() !!}
