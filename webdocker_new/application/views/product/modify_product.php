<?php 
/*
 * 
 * 
 * 
 */

?>
<div id='modify-product-toolbar'>
	<img class="imgbtn img_mouse_over save_btn" src="<?php echo base_url();?>assets/images/webdocker_48.png" alt="Enregistrement" />
	<img class="imgbtn img_mouse_over" src="<?php echo base_url();?>assets/images/webdocker_50.png" alt="Make a copy of this product" />
    <img class="imgbtn img_mouse_over" src="<?php echo base_url();?>assets/images/webdocker_52.png" alt="send by mail" />
    <img class="imgbtn img_mouse_over" src="<?php echo base_url();?>assets/images/cartouche.png" alt="ajoutez le cartouche" onclick="addcart()"/>
	<img class="imgbtn img_mouse_over" src="<?php echo base_url();?>assets/images/cost.png" alt="Costing" />
	<img class="imgbtn img_mouse_over" src="<?php echo base_url();?>assets/images/cost.png" alt="Fournisseur" onclick="fournisseurWindow();" />
</div>

<?php 
	$attributes = array('class'=>'well','id'=>'');
	echo form_open('product/save');
?>
<table id='product_form_table'>
	<tr>
		<td><div id='product_name_div'><?php echo form_label('Référence','product_name');?></div></td>
		<td>
		<?php
		echo element('product_name', $product_value['basic_info']); 
		echo form_hidden('product_id',element('product_id', $product_value['basic_info']));
		echo form_hidden('product_name',element('product_name', $product_value['basic_info']));
		$data = '';
		?></td>
		<td></td>
	</tr>
	<?php foreach ($fields_group as $groups):?>
		<?php foreach ($groups as $group_id=>$field_array):?>
			<?php if ($group_id!=0): ?>
			<tr><td colspan="3" class='field_group_title_tr' id='<?php echo md5($field_group[$group_id]['fieldgroup_name']);?>'><?php echo $field_group[$group_id]['fieldgroup_name'];?></td></tr>
			<?php endif;?>
			<?php foreach ($field_array as $field):?>
			<?php if($group_id!=0):?>
			<tr class='<?php echo md5($field_group[$group_id]['fieldgroup_name']);?>'>
			<?php else:?>
			<tr>
			<?php endif;?>
				<td><?php echo form_label($field['field_name'],'field'.$field['field_id']);?></td>
				<td>
				<?php 
					switch ($field['field_type']) {
						case 'text':
							$data = array(
									'name'	=>	$field['field_id'],
									'value'	=>	element($field['field_id'], $product_value['detail_info']),
									'id'	=>	'field'.$field['field_id'],
									'class'	=>	'field_input product_fields'
							);
							echo form_input($data);
							$data = '';
						break;
						
						case 'date':
							$data = array(
									'name'		=>	$field['field_id'],
									'value'		=>	element($field['field_id'], $product_value['detail_info']),
									'id'		=>	'field'.$field['field_id'],
									'class'		=>	'field_date product_fields',
									'readonly'	=>	'readonly'
									
									
							);
							
							echo "<div class='input-append'>";
							echo form_input($data);
							echo "<span class='add-on modify_localdate imgbtn' id='today_".$field['field_id']."'><i class='icon-calendar'></i></span>";							
							
							echo "<img src='".base_url()."assets/images/webdocker_clocheinactive.png' class='img_mouse_over date_alert imgbtn' id='cloche_".$field['field_id']."' title='".$field['field_name']."'/>";
					
							echo "</div>";
							$data = '';
						break;
						
						case 'dropdown':
							if (isset($fields_value[$field['field_id']])) {
								$data = is_array($fields_value[$field['field_id']])?$fields_value[$field['field_id']]:array();
								$data['']='';
							}else{
								$data = array();
							}
							$identity = 'id="field'.$field['field_id'].'" class="field_dropdown product_fields"';
							echo form_dropdown($field['field_id'],$data,element($field['field_id'], $product_value['detail_info']),$identity);
							$data='';
						break;
						
						case 'multiselect':
							if (isset($fields_value[$field['field_id']])) {
								$data = is_array($fields_value[$field['field_id']])?$fields_value[$field['field_id']]:array();
							
							}else{
								$data = array();
							}
							$identity = 'id="field'.$field['field_id'].'" class="field_multiselect product_fields"';
							echo form_multiselect($field['field_id'].'[]',$data,explode(',',element($field['field_id'], $product_value['detail_info'])===FALSE?'':element($field['field_id'], $product_value['detail_info'])),$identity);
							$data='';
						break;
						
						case 'price':
							$data = array(
									'name'	=>	$field['field_id'],
									'value'	=>	element($field['field_id'], $product_value['detail_info']),
									'id'	=>	'field'.$field['field_id'],
									'class'	=>	'field_price'
							);
							echo "<div class='input-append'>";
							echo form_input($data);
							echo "<span class='add-on'>€</span>";
							echo "</div>";
							$data = '';
						break;
						
						case 'note':
							$data = array(
									'name'	=>	$field['field_id'],
									'value'	=>	element($field['field_id'], $product_value['detail_info']),
									'id'	=>	'field'.$field['field_id'],
									'class'	=>	'field_note product_fields'
							);
							echo form_textarea($data);
							$data = '';
							
						break;
						
						case 'listvariable':
							if (isset($fields_value[$field['field_id']])) {
								$data = is_array($fields_value[$field['field_id']])?$fields_value[$field['field_id']]:array();
								$data['']='';
							}else{
								$data = array();
							}
							
							$identity = 'id="field'.$field['field_id'].'" class="field_listvariable product_fields"';
							echo form_dropdown($field['field_id'],$data,element($field['field_id'], $product_value['detail_info']),$identity);
							$data='';
						break;
						
						default:
							$data = array(
									'name'	=>	$field['field_id'],
									'value'	=>	element($field['field_id'], $product_value['detail_info']),
									'id'	=>	'field'.$field['field_id'],
									'class'	=>	'field_input product_fields'
							);
							echo form_input($data);
							$data = '';;
						break;
					}
					?>
				</td>
				<td></td>
			</tr>
			<?php endforeach;?>
		<?php endforeach;?>
	<?php endforeach;?>
</table>
<?php 
	echo form_hidden('product_cdrfulllink',element('product_cdrfulllink', $product_value['basic_info']));
?>
<?php 
	echo form_hidden('product_pdffulllink',element('product_pdffulllink', $product_value['basic_info']));
?>
<?php echo form_close();?>

<div id='preview_block'>
	<div>
	Ouvrir le fichier : 
	<br />
	<div class="input-append">
	  <input class="span3" id="full_file_link" type="text" title='<?php echo element('product_cdrfulllink', $product_value['basic_info']); ?>' value='<?php echo element('product_cdrfulllink', $product_value['basic_info']); ?>' disabled>
	  <button class="btn" type="button">...</button>
	</div>

	</div>
	<div class='product_preview_div'>
	<div class='product_preview_image well'>		
		<?php 
			$location = preview_url().element('product_preview', $product_value['basic_info']);
			echo scaleimage($location,150,150,'img-rounded');?>
	</div>
	<div class='product_preview_upload'>
		<img src="<?php echo base_url();?>assets/images/btnSnapshot.png" alt="Snapshot"  id="uploadpreviewbtn" class='imgbtn'/>
	</div>
	</div>
</div>

<div>
<img src="<?php echo base_url();?>assets/images/Horizontal_separation.png" class="horizontal_sep"/><br/>
	<?php if(element('product_type', $product_value['basic_info']) == 'product'):?>
	fourniture
	<?php elseif (element('product_type', $product_value['basic_info']) == 'product'):?>
	product
	<?php endif;?>
</div>

<div>
															<!-- fichiers joint -->
<div align="center">
<img src="<?php echo base_url();?>assets/images/Horizontal_separation.png" class="horizontal_sep"/><br/>
<a href="" id="fichiers_joint">Fichiers joint (0) </a>

</div>

												           <!-- revision -->
<div align="center">
<img src="<?php echo base_url();?>assets/images/Horizontal_separation.png" class="horizontal_sep"/><br/> 
	<a href="<?php echo site_url('revision/all_revision/'.$product_value['basic_info']['product_id']);?>" id="revisions" >Revision(0)</a>
</div>


	                                                        <!-- openPDF -->
<div align="center">
<img src="<?php echo base_url();?>assets/images/Horizontal_separation.png" class="horizontal_sep"/><br/> 

	<span id="open_pdf" >open pdf</span>


</div>	
</div>

<div style='display:none'>
	<div id='set_date_alert'>
		<input type="hidden" id='set_alert_field_id' value='' />
		<span id='set_alert_field_name'></span> : 
		<span id='set_alert_field_value'></span>
		<br />
		<span>Alert before</span>
		<input type="text" class='span1' id='set_alert_days' value=''/>
		<span>days</span>
		<br />
		<textarea rows="4" cols="" id='set_alert_note'></textarea>
		<button id='set_alert_ok'>OK</button>
	</div>
</div>