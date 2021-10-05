<table width="100%" align="left" border="1">
  <?php $engflag=$eng_count=0;?>
  <?php $malflag=$mal_count=0;


  ?>

@foreach($survey_qstn as $row)

  @if(!empty($row['survey_eng_qstn']))
   <?php
    $eng_count++;
    $engflag=1;?>
  @endif
  @if(!empty($row['survey_mal_qstn']))
   <?php
     $mal_count++;
    $malflag=1;?>
  @endif
@endforeach
 
      <thead>
        <tr>
          
          @foreach($default_field as $fields)
            <?php $profile_arr=['first_name','email','mobile'];?>
            @if(in_array($fields['field_name'],$profile_arr))
            <th rowspan="2">{{$fields['label']}}</th>
            @endif
          @endforeach
          
          
          @if($engflag == 1)
          <th colspan="{{$eng_count}}">English</th>
          @endif
          @if($malflag == 1)
          <th colspan="{{$mal_count}}">Malayalam</th>
          @endif
          
        </tr>
        <tr>
          @if($engflag == 1)
            @foreach($survey_qstn as $row)
            @if(!empty($row['survey_eng_qstn']['questions']))
              <th>{{$row['survey_eng_qstn']['questions']}}</th>
            @endif 
            @endforeach
          @endif
          @if($malflag == 1)
            @foreach($survey_qstn as $row)
             @if(!empty($row['survey_mal_qstn']['questions'])) 
              <th>{{$row['survey_mal_qstn']['questions']}}</th> 
             @endif
            @endforeach
          @endif
        </tr>
       
      </thead>
      <tbody>
        @foreach($survey_details as $values)

        <tr>
          @foreach($default_field as $fields)
            <?php $profile_arr=['first_name','email','mobile'];?>
            @if(in_array($fields['field_name'],$profile_arr))
            <td>{{$values['customers'][$fields->field_name]}}</td>
            @endif
          @endforeach

          @if($values->language_type == 1)
          @foreach($values['question_answers'] as $answer_det)
          
           <td> {{$qmast_arr[$answer_det->question_id][$answer_det->answer]}}</td>
          @endforeach
          @for($k=1;$k<=$eng_count;$k++)
          <td></td>
          @endfor
          @elseif($values->language_type == 2)
          @for($k=1;$k<=$eng_count;$k++)
          <td></td>
          @endfor
          @foreach($values['question_answers'] as $answer_det)
          
           <td> {{$qmast_arr[$answer_det->question_id][$answer_det->answer]}}</td>
          @endforeach
          
           @endif
          
          
            

          
        </tr>

        @endforeach
      </tbody>
   
</table>
