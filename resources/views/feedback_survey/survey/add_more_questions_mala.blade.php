  

                  <div class="form-group">
                       <label  for="name" class="col-md-12 control-label">Questions ( Language2 )</label>
                       <div class="col-md-12 ">
                      <select class="form-control" id="mala_q{{$i}}"  name="mala_q{{$i}}">
                      <option value="0" >Select</option>  
                      @foreach($q_det as $qstn)
                      <option value="{{$qstn->id}}" >{{$qstn->questions}}</option>
                       @endforeach
                    
                    
                      </select>
                    </div>
                    </div>
                  <div class="clearfix"></div><br>
                 
     
               
                
                 
                 