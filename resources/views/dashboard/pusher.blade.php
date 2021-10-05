
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
  </head>
  <body>
    <div><b>Notification:</b></div>
     <div id="message"></div>
    <div id="count"></div>
    <div id="message"></div>
    <?php $pusher = Helpers::get_pusher();?>
    @if(!empty($pusher))
     <div class="table-widget" >
      <table width="100%" id="querytype_lists" class="table">
        <thead>
                <tr>    
          <th>{{__('Title')}}</th>
          <th>{{__('Comment')}}</th>
          <th>{{__('Link')}}</th>
        </tr>
                </thead>
                <tbody>
          
          @if(count($pusher)>0)
          
          @foreach ($pusher as $res)
          <tr>
          <td><strong>{{$res->title}}</strong></td>
          <td>{{$res->comment}}</td>
          <td><a href="$res->link">View</a></td>
         
          </tr>
          @endforeach
          @else
            <tr>
            <td colspan="25"><p class="text-center">No Data Found</p></td>
            </tr>
          @endif
        </tbody>

        </tbody>
      </table>
    </div>

    @endif




     <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="//js.pusher.com/3.1/pusher.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

     <script type="text/javascript">
     

      var pusher = new Pusher('37f1e79773e00e8cd10d', {
        encrypted: true,
        cluster: 'ap2'
      });

      
      var channel = pusher.subscribe('dasboard-notification');

     

      channel.bind('App\\Events\\Oripusher', function(data) {
         //
        // console.log(data);
       
 myDivObj = document.getElementById("count");
if ( myDivObj ) {
      var data1= parseInt(myDivObj.innerHTML);
      
 myDivObj = document.getElementById("count");       // var number=parseInt(data.count);
        var message=data.data.msg;
         var name=data.data.server_name;
        console.log(name);
       document.getElementById("message").innerHTML  =message;
       document.getElementById("count").innerHTML  =name;
        
      }
        
      });
    </script>
  </body>
</html>
