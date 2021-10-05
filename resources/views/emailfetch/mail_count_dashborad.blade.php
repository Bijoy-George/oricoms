<div class="container">
<div class="row row-eq-heigh static-wrapper">
   <div class="col-sm col-6 p-2">
      <div class="widget-container clearfix">
         <a href="{{url('emailfetchlist')}}">
          <span><i class="fas fa-mail-bulk"></i></span>
          <h2>{{$total}}</h2>
          <p>Total email</p>
        </a>
      </div>
    </div>
        <div class="col-sm col-6 p-2">
      <div  class="widget-container clearfix">
        <a href="{{url('emailfetchlist/1')}}">
        <span><i class="fas fa-check-circle"></i> </span>
        <h2>{{$answered}}</h2>
        <p>Replied</p>
       </a>
      </div>
    </div>
        
        <div class="col-sm col-6 p-2">
      <div class="widget-container clearfix">
         <a href="{{url('emailfetchlist')}}">
          <span><i class="fas fa-envelope-open"></i></span>
          <h2> {{$read_count}}</h2>
          <p>Reads</p>
        </a>
      </div>
    </div>
        
        <div class="col-sm col-6 p-2">
      <div class="widget-container clearfix">
         <a href="{{url('emailfetchlist')}}">
          <span><i class="fas fa-envelope"></i></span>
          <h2> {{$unread_count}}</h2>
          <p>Unread</p>
        </a>
      </div>
    </div>
       
</div>
</div> 




<style type="text/css">
.modal.modal-wide .modal-dialog {
  width: 100%;
}
.modal-wide .modal-body {
  overflow-y: auto;
}
.email-wrapper .email-content {
    position: relative;
    min-height: 400px!important;
}

</style>
