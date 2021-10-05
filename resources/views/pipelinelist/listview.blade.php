  <!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
  <script>
  $( function() {
    $( "div.droptrue" ).sortable({
      connectWith: ".card-conatiner"
    });
	var pro_id,pro_status_id;
	$( ".droptrue" ).droppable({
		drop: function(event, ui){
			  pro_status_id = event.target.getAttribute('id');
			  pro_status_id	= pro_status_id.replace('status-', '');
			  pro_id = ui.draggable.attr('id');
			  pro_id = pro_id.replace('profile-', '');
			  updateStatus(pro_status_id,pro_id);
		}
    });
	function updateStatus(pro_status_id,pro_id)
	{
		$.ajaxSetup({
        header:$('meta[name="csrf-token"]').attr('content')
        });
        var token       = '{{csrf_token()}}';
		var url = $("#base_url").val();
		
		$.ajax({
			url: url+"/update_profile_status",
			type: "POST",
			data: {
				"_token": token,				
				"profile_id":pro_id,
				"profile_status":pro_status_id
			},
			dataType: "json",
		}).done(function(data){
			console.log('Success');
		}).fail(function(jqXHR, ajaxOptions, thrownError){
			  console.log('No response');
		});
	}
  });
  </script>




	<div class="row pt-4">
	<?php 
		$profile_status = config('constant.profile_status'); 
	?>
	@foreach($results_all as $key =>$values)

  <?php  $countvalue = count($values);
  		$percentvale = 0;
  		if ($all_count)
  		{
        $percentvale =  $countvalue * 100  / $all_count;
        } ?>
		<div class="pipelinelist " id="sortablewrp_{{$key}}">
        <div class="card-head clearfix">
        <div class="clearfix">
          <h3>{{$profile_status[$key]}}</h3>
          <a href="{{url('profile')}}/0/0/0/0/0/0/0/{{$key}}" class="add-pro"><i class="fas fa-plus"></i></a>
        </div>
          <div class="progress-bar-wrap clearfix">
            <div class="outter-progress">
              <div class="inner-progress" style="width: {{$percentvale}}%;"></div>
            </div>
            <span>{{count($values)}} / {{$all_count}}</span>
          </div>
      </div>
			<div class="card-conatiner droptrue"  id="status-{{$key}}">
				@foreach($values as $val)
				<div class="card-block " class="ui-state-default"  id="profile-{{$val['id']}}">
					<div>
						<h4><i class="fas fa-user"></i> <a href="/profile/0/{{$val['id']}}">{{$val['first_name']}}</a></h4>
            
            @if(isset($val['mobile']))
            <p>
              <i class="fas fa-phone"></i> {{$val['mobile']}} 
              </p>
            @endif
            @if(isset($val['email']))
            <p>
            <span><i class="fas fa-envelope"></i> {{$val['email']}}</span>
          </p>
             @endif
					</div>
          <div class="card-action">
            <a class="drag" href="javascript:void(0)"><i class="fas fa-bars"></i></a>      
           </div>
				</div>
				
				@endforeach
			</div>
		</div>
	@endforeach
  </div>


<script>
function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
  ev.preventDefault();
  var data = ev.dataTransfer.getData("text");
  ev.target.appendChild(document.getElementById(data));
}
</script>
