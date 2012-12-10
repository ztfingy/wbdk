
<div class='sms_main'>
    <div>
    <div class='sms_receive_header'><img src="<?php echo base_url();?>assets/images/Logo_vosSms2.png" width="46" height="46" /></div>
    </div>
<div>

<table class='sms_table'>
  <tr>
  <td width="40px"><a href="<?php echo site_url('sms/new_sms');?>"><img src="<?php echo base_url();?>assets/images/New.png" alt="Nouveau"/></a></td>
    <td width="110px"><form class='form-search' id='sms_search'><div class="input-append"><input type="text" id="searchword" class='span1 search-query'/><span class='btn' id='sms_searach_btn'><i class='icon-search'></i></span><input type="hidden" id="swd"/></div></form></td>
    
    <td>
    <select id="smsorder">
       	<option value="date" selected>date</option>
        <option value="sender">sender</option>
    </select>
   </td>
  </tr>
</table>
</div>
<br />
<div id="smslist">
	<?php
		if(sizeof($received_sms)>0){
		echo "<table class='well sms_table' >";
			foreach ($received_sms as $sms_recent) {
				$data= "<tr><td width='100px'><a href='".site_url('sms/read/'.$sms_recent['sms_id'])."'>";
				
				if($sms_recent['sms_read']==0){						
					$data.= "<strong>".$sms_recent['user_username']."</strong>";							
				}else{
					$data.=$sms_recent['user_username'];	
				}
					
				$data .= "</a></td><td>{$sms_recent['sms_senddate']}</td></tr><tr><td colspan='2' class='welcome_item_content'><a href='".site_url('sms/read/'.$sms_recent['sms_id'])."' style='color:#747474;'>";
				if(strlen($sms_recent['sms_content'])>40){ 
					$data .= substr($sms_recent['sms_content'],0,40)."..." ;
				} else {
					$data .= $sms_recent['sms_content'];
				}
				
				$data .= "</a></td></tr>";
				echo $data;
			};
		echo "</table>";
		echo "<input type='button' class='btn' value='more' id='sms_more'/>";
		}else{
			echo "you have no sms";	
			echo "<img src='".base_url()."assets/images/Horizontal_separation.png' alt='' />";
		}
	?>
            
            </div>
<br />


<table class='sms_table'>
  <tr>
     <td width="35"><a href="<?php echo site_url('sms/deleted');?>"><img class='sms_bottom_left_icon' src="<?php echo base_url();?>assets/images/SMSjetes.png" alt="Deleted Items" /></a></td>
     <td width="35"><a href="<?php echo site_url('sms/sent');?>"><img class='sms_bottom_left_icon' src="<?php echo base_url();?>assets/images/SMSenvoyes.png" alt="Sended Items" /></a></td>
    <td><a href="sms/new_sms"><img class="sms_bottom_right_icon" src="<?php echo base_url();?>assets/images/New.png" alt="Nouveau"/></a></td>
  </tr>
</table>

</div>
