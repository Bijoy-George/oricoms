    <?php if(isset($trending_query['cnt_month']))
        { ?>
	        <?php if(count($trending_query['cnt_month']) > 0)
                { ?>
				<div class="row"> 
					<div class="col-md-12" style="overflow-y:scroll;height: 300px;">
					  <h2>Trending Query</h2>
					  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-responsive table-striped">
					  <?php if(count($trending_query['cnt_month']) > 0)
						{ ?>
							<?php 
								foreach($trending_query['cnt_month'] as $value )
									{?>
									<tr>
									  <td style="width: 100%";>{{$value->question}}</td>
									  <td><span>{{$value->count}}</span></td>
									</tr>
							<?php   } 
						}else{?>
								<tr>
								  <td><center><h1>No Data Found</h1></center></td>
								</tr>
						<?php  }?>                    
					  </table>
					</div>
				</div>
		<?php } } ?>
