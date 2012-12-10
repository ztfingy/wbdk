
<div class='sms_main'>
<div>
    <div class='sms_new_header'><img src="<?php echo base_url();?>assets/images/Logo_vosSms2.png" width="46" height="46" /></div>
</div>
<div style="padding-left:20px;">
	<div class="input-append">
    <select class='span1' id='sms_send_type'>
 
    	<option>User</option>
    	<option>Team</option>
    	<option>Group</option>

    </select>
    <select class="span2" id="sms_send_item">
    	<option></option>
    </select>
    </div>
</div>

<div id="sms_edit_pad">
    <input type="hidden" id="fromId" value="<?php echo $this->session->userdata('userid');?>" />
	<textarea id="smscontent"></textarea>
</div>

<table class='sms_table'>
  	<tr>
		<td align="left"> <a href="<?php echo site_url('sms/received');?>"><img src="<?php echo base_url();?>assets/images/back.png" alt="" /> </a></td>
		<td align="right"> <img src="<?php echo base_url();?>assets/images/Send.png" id="sendSMS" alt="" /></td>
	</tr>
</table>

</div>