@if($result_arr['is_exist'] != 0)
                <div class="alert alert-secondary" role="alert"><h2 class="m-0 text-center">ഇതിനകം അഭിപ്രായം സമർപ്പിച്ചു.</h2></div>
@else
				<form class="form-common" role="form" method="POST" action="{{ url('api/feedback_insertion') }}" autocomplete="off">
                    <div class="row justify-content-center text-center">
                    <div id="msg" class="alert" role="alert"></div>
					
					<div class="form-group col-md-12">
                                @php
                                $i=1;@endphp
                                @foreach ($result_arr['questions'] as $value)
                                    <h4><?php echo $value['mal_questions']['questions'];?></h4> 
                                    
                                     
                                     @if($value['mal_questions']['option1'])
                                     <input required type="radio" name="questions[<?php echo $value['mal_questions']['id'];?>]"  value="{{$value['mal_questions']['option1']}}"  id="radio-1-{{$value['mal_questions']['id']}}" class="custom-radio"> 

                                     <label for="radio-1-{{$value['mal_questions']['id']}}" class="custom-checkbox-label">{{$value['mal_questions']['option1']}}</label>
                                     @endif
                                     @if($value['mal_questions']['option2'])
                                     <input  required type="radio" name="questions[<?php echo $value['mal_questions']['id'];?>]"  value="{{$value['mal_questions']['option2']}}" id="radio-2-{{$value['mal_questions']['id']}}" class="custom-radio"> 
                                     
                                     <label for="radio-2-{{$value['mal_questions']['id']}}" class="custom-checkbox-label">{{$value['mal_questions']['option2']}}</label>
                                     @endif

                                    
                                     @if($value['mal_questions']['option3'])
                                     <input  required type="radio" name="questions[<?php echo $value['mal_questions']['id'];?>]"  value="{{$value['mal_questions']['option3']}}" id="radio-3-{{$value['mal_questions']['id']}}" class="custom-radio"> 
                                     

                                     <label for="radio-3-{{$value['mal_questions']['id']}}" class="custom-checkbox-label">{{$value['mal_questions']['option3']}}</label>

                                    @endif
                                    @if($value['mal_questions']['option4'])
                                     <input  required type="radio" name="questions[<?php echo $value['mal_questions']['id'];?>]"  value="{{$value['mal_questions']['option4']}}" id="radio-4-{{$value['mal_questions']['id']}}" class="custom-radio"> 
                                    
                                    <label for="radio-4-{{$value['mal_questions']['id']}}" class="custom-checkbox-label">{{$value['mal_questions']['option4']}}</label>

                                    @endif
                                    @if($value['mal_questions']['option5'])
                                     <input  type="radio" name="questions[<?php echo $value['mal_questions']['id'];?>]"  value="{{$value['mal_questions']['option5']}}" id="radio-5-{{$value['mal_questions']['id']}}" class="custom-radio"> 
                                     
                                      <label for="radio-5-{{$value['mal_questions']['id']}}" class="custom-checkbox-label">{{$value['mal_questions']['option5']}}</label>

                                    @endif
                                    @if($value['mal_questions']['option6'])
                                     <input  required type="radio" name="questions[<?php echo $value['mal_questions']['id'];?>]"  value="{{$value['mal_questions']['option6']}}" id="radio-6-{{$value['mal_questions']['id']}}" class="custom-radio"> 

                                      <label for="radio-6-{{$value['mal_questions']['id']}}" class="custom-checkbox-label">{{$value['mal_questions']['option6']}}</label>

                                    @endif


                               @php  
                               $i++; @endphp
                                @endforeach 
                    </div>
                    @if($result_arr['is_rating'] == 1)
					<div class="col-md-12 form-group" id="rating_div">
                    <h4>{{__('നിങ്ങളുടെ മൊത്തത്തിലുള്ള അനുഭവത്തെ നിങ്ങൾ എങ്ങനെ വിലയിരുത്തുന്നു?')}}</h4>


                     <input required type="radio" name="rating" id="rating-1" class="custom-radio" value="5" >
                      <label for="rating-1" class="custom-checkbox-label">എക്സലൻറ്റ് </label>
                      <input required type="radio" name="rating" id="rating-2" class="custom-radio" value="4" >
                      <label for="rating-2" class="custom-checkbox-label">ഗുഡ് </label>
                      <input required type="radio" name="rating" id="rating-3" class="custom-radio" value="3" >
                      <label for="rating-3" class="custom-checkbox-label">ആവറേജ് </label>
                      <input required type="radio" name="rating" id="rating-4" class="custom-radio" value="2" >
                      <label for="rating-4" class="custom-checkbox-label">ബാഡ്</label>
                      <input required type="radio" name="rating" id="rating-5" class="custom-radio" value="1" >
                      <label for="rating-5" class="custom-checkbox-label">വെരി ബാഡ്</label> 

                       
                    </div>
                    @endif
                    {{ Form::hidden('fid',$result_arr['fid']) }}
                    {{ Form::hidden('authentication_key',$result_arr['authentication']) }}
                    {{ Form::hidden('customer_id',$result_arr['customer_id']) }}
                    {{ Form::hidden('type',$result_arr['type']) }}
                    {{ Form::hidden('company_id',$result_arr['company_id']) }}
                    @if($result_arr['is_comment'] == 1)     
                    <div class="form-group  col-md-10">
                        <label for="comments"> {{__('അഭിപ്രായങ്ങൾ :')}}</label> 
                        <textarea class="form-control" type="textarea" name="comments" id="comments" placeholder="നിങ്ങളുടെ അഭിപ്രായങ്ങൾ" maxlength="6000" rows="7"></textarea>
                    </div>
                    @endif
                    <div class="form-group text-right"><br>
    						<button type="submit" class="btn btn-success px-4">
    							{{__('സമർപ്പിക്കുക')}}
    						</button>  
						<button type="reset" class="btn btn-outline danger px-4" >
								 {{__('പുനഃസജ്ജമാക്കുക')}}
						</button>
					</div>
                    </div>
                        
				</form>
				
@endif