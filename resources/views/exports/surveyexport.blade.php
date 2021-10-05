<div class="row">
<div class="col-sm-12" >

<table width="100%" align="left" border="0">
<thead>
<tr>

<td><b>English Question</b></td>
<td><b>Malayalam Question</b></td>
<td>Response in %</td>
</tr>

</thead>

<tbody>
<?php 
$i=0;

foreach($survey_qstn as $key => $row){ 
$total=0;
$qid=$row->id;
if(empty($option_arr[$qid]['option1'])){
$option_arr[$qid]['option1']=0;
}
if(empty($option_arr[$qid]['option2'])){
$option_arr[$qid]['option2']=0;
}
if(empty($option_arr[$qid]['option3'])){
$option_arr[$qid]['option3']=0;
}
if(empty($option_arr[$qid]['option4'])){
$option_arr[$qid]['option4']=0;
}
if(empty($option_arr[$qid]['option5'])){
$option_arr[$qid]['option5']=0;
}
if(empty($option_arr[$qid]['option5'])){
$option_arr[$qid]['option5']=0;
}
if(empty($option_arr[$qid]['option6'])){
$option_arr[$qid]['option6']=0;
}
if(isset($option_arr[$qid]['option1']) && !empty($option_arr[$qid]['option1']))
{
$total=$total+$option_arr[$qid]['option1'];
}
if(isset($option_arr[$qid]['option2']) && !empty($option_arr[$qid]['option2']))
{
$total=$total+$option_arr[$qid]['option2'];
}
if(isset($option_arr[$qid]['option3']) && !empty($option_arr[$qid]['option3']))
{
$total=$total+$option_arr[$qid]['option3'];
}
if(isset($option_arr[$qid]['option4']) && !empty($option_arr[$qid]['option4']))
{
$total=$total+$option_arr[$qid]['option4'];
}
if(isset($option_arr[$qid]['option5']) && !empty($option_arr[$qid]['option5']))
{
$total=$total+$option_arr[$qid]['option5'];
}
if(isset($option_arr[$qid]['option6']) && !empty($option_arr[$qid]['option6']))
{
$total=$total+$option_arr[$qid]['option6'];
}


?>
<tr>
<td>{{$row['survey_eng_qstn']['questions']}}</td>
<td>{{$row['survey_mal_qstn']['questions']}}</td>
<td></td>
</tr>

@if(!empty($row['survey_eng_qstn']['option1']) || !empty($row['survey_mal_qstn']['option1']))
<tr>  
 
    <td> @if($row['survey_eng_qstn']['option1'])  * {{$row['survey_eng_qstn']['option1']}} @endif</td>
    <td>@if($row['survey_mal_qstn']['option1'])  * {{$row['survey_mal_qstn']['option1']}} @endif</td>
    <td>@if($option_arr[$qid]['option1']) {{round(($option_arr[$qid]['option1'] / $total) * 100).'%'}}  @endif
    </td>
 
</tr>
@endif
@if(!empty($row['survey_eng_qstn']['option2']) || !empty($row['survey_mal_qstn']['option2']))
<tr>
  
    <td> @if($row['survey_eng_qstn']['option2'])   * {{$row['survey_eng_qstn']['option2']}} @endif</td>
    <td>@if($row['survey_mal_qstn']['option2']) * {{$row['survey_mal_qstn']['option2']}} @endif</td>
    <td> @if($option_arr[$qid]['option2']) {{round(($option_arr[$qid]['option2'] / $total) * 100).'%'}} @endif
    </td>
  
</tr>
@endif 
@if(!empty($row['survey_eng_qstn']['option3']) || !empty($row['survey_mal_qstn']['option3']))
<tr>   
 
    <td> @if($row['survey_eng_qstn']['option3']) * {{$row['survey_eng_qstn']['option3']}}  @endif</td>
    <td>@if($row['survey_mal_qstn']['option3']) * {{$row['survey_mal_qstn']['option3']}}  @endif</td>
    <td> @if($option_arr[$qid]['option3']) {{round(($option_arr[$qid]['option3'] / $total) * 100).'%'}}  @endif
    </td>
 
</tr> 
@endif

@if(!empty($row['survey_eng_qstn']['option4']) || !empty($row['survey_mal_qstn']['option4']))                 
<tr>
  
    <td>@if($row['survey_eng_qstn']['option4'])    * {{$row['survey_eng_qstn']['option4']}} @endif</td>
    <td> @if($row['survey_mal_qstn']['option4']) * {{$row['survey_mal_qstn']['option4']}} @endif</td>
    <td>@if($option_arr[$qid]['option4']) {{round(($option_arr[$qid]['option4'] / $total) * 100).'%'}}  @endif
      </td>
 
</tr> 
@endif
@if(!empty($row['survey_eng_qstn']['option5']) || !empty($row['survey_mal_qstn']['option5']))
<tr> 
  
    <td>@if($row['survey_eng_qstn']['option5']) * {{$row['survey_eng_qstn']['option5']}} @endif</td>  
    <td>@if($row['survey_mal_qstn']['option5'])  * {{$row['survey_mal_qstn']['option5']}} @endif</td>
    <td> @if($option_arr[$qid]['option5']) {{round(($option_arr[$qid]['option5'] / $total) * 100).'%'}} @endif
      </td>
  
</tr>
@endif

@if(!empty($row['survey_eng_qstn']['option6']) || !empty($row['survey_mal_qstn']['option6']))
<tr>  
  
    <td>@if($row['survey_eng_qstn']['option6'])  * {{$row['survey_eng_qstn']['option6']}} @endif</td>
    <td>@if($row['survey_mal_qstn']['option6']) * {{$row['survey_mal_qstn']['option6']}} @endif</td>
    <td>@if($option_arr[$qid]['option6']) {{round(($option_arr[$qid]['option6'] / $total) * 100).'%'}}  @endif
      </td>
 
</tr>
@endif

<?php
       $i++;
        }?> 
</tbody>
     
</table>                  
 
               
               
</div>
</div>   
