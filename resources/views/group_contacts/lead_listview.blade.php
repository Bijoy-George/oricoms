<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
<div class="table-widget table-responsive mt-0">
  <table width="100%" id="lead_lists" class="table">
    <thead>
      <tr> 
        <!--<th>#</th>-->
        <?php  
		    foreach($deflt_fields as $fields)
			{
				echo "<th>".$fields->label."</th>";
			}
		    foreach($cust_fields as $val)
			{
				echo "<th>".$val->label."</th>";
			}
		   
		   
		   ?>
        <th><input type="checkbox" id="select-all" onclick="selectAllCustomers()"></th>
      </tr>
    </thead>
    <tbody>
      <?php  
 $i = ($results->currentpage()-1) * $results->perpage() +  1; 	 
	    foreach($results as $res){
			echo "<tr>";
			/* echo "<td>".$i."</td>"; */
		    foreach($deflt_fields as $fields)
		    {  
				echo "<td>".$res[$fields->field_name]."</td>";
		    }
		    $details = $res->profile_details;
		 
			//  echo "<pre>";print_r($details);echo "</pre>";
			foreach($cust_fields as $val)	
			{
				$fieldid = $val->id;
				$flag = 1;
				foreach($details as $detail)
				{
					if($detail->field_id == $fieldid)
					{
						echo "<td>".$detail->value."</td>";
						$flag = 2;
					}
				}
				if($flag == 1)
				{
					echo "<td>&nbsp;</td>";
				}
			}
			echo '<td><input type="checkbox" class="contact-select" name="customer_id[]" id="customer_id[]" value="' . $res->id . '" onClick="toggleContact(this)"></td>';
			echo "</tr>";
	  }
	  
	?>
    </tbody>
  </table>
</div>
<div class="d-flex justify-content-end first">{{ $results->render() }}</div>