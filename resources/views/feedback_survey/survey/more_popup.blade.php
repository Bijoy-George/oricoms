<div class="row">
<div class="col-sm-12" >



<table width="100%" align="left" border="1">

<tr>

<td><b>English Question</b></td>
<td><b>Malayalam Question</b></td>
<td>Response in %</td>

</tr>
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
//print_r($option_arr);
 $total;
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
    <td>@if($option_arr[$qid]['option2']) {{round(($option_arr[$qid]['option2'] / $total) * 100).'%'}} @endif
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
        }

        die;?>  
</table>                  
        

          
         <?php die; if(count($question_det) >0){?>
              <p><i><b>Questions :</b></i></p>

<table width="100%" align="left" border="1">

<tr>

<td><b>English Question</b></td>
<td><b>Malayalam Question</b></td>
<td>Response in %</td>

</tr>



              <?php foreach($question_det as $key => $row){
                
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

                 $qid=$row->id;

                ?>
                <tr>
                <td><b>   <?php if(!empty($row->english_question)){?>  <?php echo $row->english_question; } ?></b> </td>
                <td><b>  <?php if(!empty($row->malayalam_question)){?>  <?php echo  $row->malayalam_question; }?></b> </td>
                <td></td>
              </tr>

                
                  <?php if(!empty($row->eng_option1) || !empty($row->mala_option1)){?>    
                  <tr>   
                   <td> <?php if(!empty($row->eng_option1)){?><span>&nbsp  * <?php echo strip_tags($row->eng_option1); ?>
                     </span><br><?php } ?></td>
                    <td> <?php if(!empty($row->mala_option1)){?><span>&nbsp * <?php echo strip_tags($row->mala_option1); ?></span><br><?php } ?></td>
                    <td><?php if(!empty($option_arr[$qid]['option1'])) { echo round(($option_arr[$qid]['option1'] / $total) * 100);?> % <?php } ?></td>
                 </tr>
                 <?php }?>  
                  <?php if(!empty($row->eng_option2) || !empty($row->mala_option2)){?>
                   <tr>   
                   <td> <?php if(!empty($row->eng_option2)){?><span>&nbsp  * <?php echo strip_tags($row->eng_option2); ?>
                     </span><br><?php } ?></td>
                     <td><?php if(!empty($row->mala_option2)){?><span>&nbsp * <?php echo strip_tags($row->mala_option2); ?></span><br><?php } ?>
                     </td>
                     <td><?php if(!empty($option_arr[$qid]['option2'])) { echo round(($option_arr[$qid]['option2'] / $total) * 100);?> % <?php } ?></td>
                  </tr>
                <?php } ?>
                  <?php if(!empty($row->eng_option3) || !empty($row->mala_option3)){?>
                  <tr>   
                   <td> <?php if(!empty($row->eng_option3)){?><span>&nbsp  * <?php echo strip_tags($row->eng_option3); ?>
                     </span><br><?php } ?></td>
                     <td><?php if(!empty($row->mala_option3)){?><span>&nbsp * <?php echo strip_tags($row->mala_option3); ?></span><br><?php } ?>
                     </td>
                     <td><?php if(!empty($option_arr[$qid]['option3'])) { echo round(($option_arr[$qid]['option3'] / $total) * 100);?> % <?php } ?></td>
                  </tr>
                <?php } ?>
                  <?php if(!empty($row->eng_option4) || !empty($row->mala_option4)){?>
                  <tr>   
                   <td> <?php if(!empty($row->eng_option4)){?><span>&nbsp  * <?php echo strip_tags($row->eng_option4); ?>
                     </span><br><?php } ?></td>
                     <td><?php if(!empty($row->mala_option4)){?><span>&nbsp * <?php echo strip_tags($row->mala_option4); ?></span><br><?php } ?>
                     </td>
                     <td><?php if(!empty($option_arr[$qid]['option4'])) { echo round(($option_arr[$qid]['option4'] / $total) * 100);?> % <?php } ?></td>
                  </tr>
                <?php } ?>
                  <?php if(!empty($row->eng_option5) || !empty($row->mala_option5)){?> 
                  <tr>   
                   <td> <?php if(!empty($row->eng_option5)){?><span>&nbsp  * <?php echo strip_tags($row->eng_option5); ?>
                     </span><br><?php } ?></td>
                     <td><?php if(!empty($row->mala_option5)){?><span>&nbsp * <?php echo strip_tags($row->mala_option5); ?></span><br><?php } ?>
                     </td>
                     <td><?php if(!empty($option_arr[$qid]['option5'])) { echo round(($option_arr[$qid]['option5'] / $total) * 100);?> % <?php } ?></td>
                  </tr>
                   <?php }?>
                  <?php if(!empty($row->eng_option6) || !empty($row->mala_option6)){?>  
                  <tr>   
                   <td><?php if(!empty($row->eng_option6)){?><span>&nbsp  * <?php echo strip_tags($row->eng_option36); ?>
                     </span><br><?php } ?></td>
                     <td><?php if(!empty($row->mala_option6)){?><span>&nbsp * <?php echo strip_tags($row->mala_option6); ?></span><br><?php } ?>
                     </td>
                     <td><?php if(!empty($option_arr[$qid]['option6'])) { echo round(($option_arr[$qid]['option6'] / $total) * 100);?> % <?php } ?></td>
                  </tr>
                  <?php }?>

               
              <?php } ?>
          
        
             
              
    <?php }   ?>     
                
               
                
           



        </div>
             
              
              
</div>   
