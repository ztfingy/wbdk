<form class="form-inline">
<?php echo form_dropdown('merchandise_list',array(),'','class="input-small" placeholder="List"');?>
<?php echo form_dropdown('price_field',array(),'','class="input-small" placeholder="Price"');?>
<?php 
	$data = array(
		'class' 	=>	'btn',
		'content'	=>	'OK'
	);
echo form_button($data);
?>
</form>

<div>


</div>
<div>
<img class="imgbtn img_mouse_over" id="btnListShow1" src="<?php echo base_url();?>assets/images/webdocker_92.png" alt="Dashboard 1" />
<img class="imgbtn img_mouse_over" id="btnListShow2" src="<?php echo base_url();?>assets/images/webdocker_94.png" alt="Dashboard 2" />
</div>	
