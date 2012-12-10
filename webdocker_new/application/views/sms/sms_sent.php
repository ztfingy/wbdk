
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
		if(1==2){
	?>
		<table class='sms_table'>
			<tr>
				<td width="100px">
				<a href="SMSRead.php?sid=<?php echo $sms['id']?>">
				<?php 
					if($sms['haveRead']=='N'){						
						echo "<strong>".$sms['sms_username']."</strong>";							
					}else{
						echo $sms['sms_username'];	
					}
				?>
				</a>
				</td>
				<td>
				<?php 
					echo $sms['sendDate'];
				?>
				</td>
				<td rowspan="2"><img src="images/trash.png" class="delsms" alt="Delete" onmouseover="this.src='images/trash_over.png'" onmouseout="this.src='images/trash.png'" onclick="delsms($(this))"/> <input type="hidden" value="<?php echo $sms['id']?>" /> </td>
			</tr>
			<tr>
				<td colspan="2">
				<a href="SMSRead.php?sid=<?php echo $sms['id']?>"  style="color:#747474;">
					<?php 
						if(strlen($sms['smsContent'])>40){ echo substr($sms['smsContent'],0,40)."..." ;} else {echo $sms['smsContent'];}
					?>
				</a>
				</td>						
			</tr>
		</table>
	<?php 
		}else{
			echo "you have no sms";	
			echo "<img src='images/Horizontal_separation.png' alt='' />";
		}
	?>
            
            </div>
<br />
<table class='sms_table'>
  <tr>
    <td><span id="smsnum"><?php echo 0;//$totalsumsms;?></span></td>
    <td><span id="curentpage">1</span>/<span id="totalpage"><?php echo 0;// $totalpage;?></span></td>
    <td> 
    page : 	<select id="pagenum">
				<option value='' >1</option>	
			</select>
	</td>
  </tr>
</table>

<table class='sms_table'>
  <tr>
     <td width="35"><a href="<?php echo site_url('sms/deleted');?>"><img class='sms_bottom_left_icon' src="<?php echo base_url();?>assets/images/SMSjetes.png" alt="Deleted Items" /></a></td>
     <td width="35"><a href="<?php echo site_url('sms/sent');?>"><img class='sms_bottom_left_icon' src="<?php echo base_url();?>assets/images/SMSenvoyes.png" alt="Sended Items" /></a></td>
    <td><a href="sms/new_sms"><img class="sms_bottom_right_icon" src="<?php echo base_url();?>assets/images/New.png" alt="Nouveau"/></a></td>
  </tr>
</table>

</div>
