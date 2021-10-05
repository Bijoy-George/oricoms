<html>
<head></head>
<body>
<style>
  td, th{
    border: 1px solid #d7d7d7;
    text-align: left;
  }
  table, td{
    border-collapse: collapse;
    text-align: left;
  }
  .blocktd {
    padding: 5px;
  }
  th.blocktd {
    background: #f5f5f5;
  }
</style>

<!-------------------------------->
<table cellpadding="0" cellspacing="0">
  <thead>
    <tr>
      <th class="blocktd" width="100px">Server</th>
      <th class="blocktd" width="100px">Resourse</th>
      <th class="blocktd" width="100px">Components</th>
      @foreach($results1 as $value)
      <?php $count= count($value['getresource']) ?>
      @foreach($value['getresource'] as $resource)
      <th class="blocktd" width="100px">{{$resource->time}}</th>
     @endforeach
     @break
      @endforeach
     <!--  <th class="blocktd" width="100px">14 Mar</th>
      <th class="blocktd" width="100px">15 Mar</th>
      <th class="blocktd" width="100px">16 Mar</th>
      <th class="blocktd" width="100px">17 Mar</th>
      <th class="blocktd" width="100px">18 Mar</th>
      <th class="blocktd" width="100px">19 Mar</th> -->
    </tr>
  </thead>
  
   @foreach($results1 as $data)
  <tbody>

    <!--Server Name Repeat Start-->
  
   
    <tr>
      <td width="100px" class="blocktd">{{$data->server_name}}</td>
      <td colspan="9">
        <table cellpadding="0" cellspacing="0">

          <!--Server Type Repeat Start-->
           @foreach($data['getservice'] as $resource)
          <tr>
            <td  class="blocktd" width="100px">{{Helpers::service_type($resource->service_id)}}</td>
            <td colspan=$count+1>
              <table cellpadding="0" cellspacing="0">

                <!--Components Repeat End-->
                <tr>
                  <td class="blocktd" width="100px">{{Helpers::service_name($resource->service_id)}}</td>
                  <td class="blocktd" width="100px">{{config('constant.service_status')[$resource->status]}}</td>
                 <!--  <td class="blocktd" width="100px">Running</td>
                  <td class="blocktd" width="100px">Running</td>
                  <td class="blocktd" width="100px">Running</td>
                  <td class="blocktd" width="100px">Running</td>
                  <td class="blocktd" width="100px">Stopped</td>
                  <td class="blocktd" width="100px">Stopped</td> -->
                </tr>
                <!--Components Repeat End-->

              </table>
            </td>
          </tr>
          @endforeach

          <!--Server Type Repeat End-->

          <!--CPU Section Start-->
          

          <tr>
            <td  class="blocktd" width="100px">CPU</td>
            <td colspan=$count+1>
              <table cellpadding="0" cellspacing="0">

                <!--Components Repeat End-->
                 @foreach($data['getresource'] as $resource)
                <tr>
                  <td class="blocktd" width="100px"></td>
                  <td class="blocktd" width="100px">{{$resource->resource1}}</td>
                  <!-- <td class="blocktd" width="100px">10%</td>
                  <td class="blocktd" width="100px">10%</td>
                  <td class="blocktd" width="100px">10%</td>
                  <td class="blocktd" width="100px">10%</td>
                  <td class="blocktd" width="100px">10%</td>
                  <td class="blocktd" width="100px">10%</td> -->
                </tr>
                <!--Components Repeat End-->
                @endforeach
              </table>
            </td>
          </tr>
          
          <!--CPU Section End-->

          <!--RAM Section Start-->
     
          <tr>
            <td  class="blocktd" width="100px">RAM</td>
            <td colspan=$count+1>
              
              <table cellpadding="0" cellspacing="0">

                <!--Components Repeat End-->
                 @foreach($data['getresource'] as $resource)
                <tr>
                  <td class="blocktd" width="100px"></td>
                  <td class="blocktd" width="100px">{{$resource->resource2}}</td>
                 <!--  <td class="blocktd" width="100px">10%</td>
                  <td class="blocktd" width="100px">10%</td>
                  <td class="blocktd" width="100px">10%</td>
                  <td class="blocktd" width="100px">10%</td>
                  <td class="blocktd" width="100px">10%</td>
                  <td class="blocktd" width="100px">10%</td> -->
                </tr>
                <!--Components Repeat End-->
                 @endforeach
              </table>
              
            </td>
          </tr>
          <!--RAM Section End-->
          

          <!--RAM Section Start-->
          <tr>
            <td  class="blocktd" width="100px">HDD</td>
            <td colspan=$count+1>
              <table cellpadding="0" cellspacing="0">

                <!--Components Repeat End-->
                @foreach($data['getresource'] as $resource)
                <?php $resource3 =unserialize($resource->resource3);?>
              
                @foreach($resource3 as $hdd)
                <tr>
                  <td class="blocktd" width="100px">{{$hdd['drive']}}</td>
                  <td class="blocktd" width="100px">{{$hdd['used']}}/{{$hdd['total']}}{{$hdd['size']}}</td>
                  <!-- <td class="blocktd" width="100px">120GB</td>
                  <td class="blocktd" width="100px">120GB</td>
                  <td class="blocktd" width="100px">120GB</td>
                  <td class="blocktd" width="100px">120GB</td>
                  <td class="blocktd" width="100px">120GB</td>
                  <td class="blocktd" width="100px">120GB</td> -->
                </tr>

                <!--Components Repeat End-->
                @endforeach
                @endforeach

              </table>
            </td>
          </tr>
          <!--RAM Section End-->

        </table>
      </td>
    </tr>
    <!--Server Name Repeat End-->

  </tbody>
  @endforeach
</table>

<!-------------------------------->

</body>
</html>