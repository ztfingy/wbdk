
<div>           
    <img class="imgbtn img_mouse_over" src="<?php echo base_url();?>assets/images/webdocker_48.png" alt="Enregistrement" />
</div>
<?php 
	$attributes = array('class'=>'','id'=>'');
	echo form_open('product/save',$attributes);
?>
<table>
	<tr>
		<td><div id='product_name_div'><?php echo form_label('Référence','product_name');?></div></td>
		<td>
		<?php 
		$data = array(
					'name'	=>	'product_name',
					'value'	=>	set_value('product_name'),
					'id'	=>	'product_name',
					'class'	=>	'field_input'					
				);
		echo form_input($data);
		$data = '';
		?></td>
		<td>*</td>
	</tr>
	<?php foreach ($fields_group as $groups):?>
		<?php foreach ($groups as $group_id=>$field_array):?>
			<?php if ($group_id!=0): ?>
			<tr><td colspan="3" class='field_group_title_tr' id='<?php echo md5($field_group[$group_id]['fieldgroup_name']);?>'><?php echo $field_group[$group_id]['fieldgroup_name'];?></td></tr>
			<?php endif;?>
			<?php foreach ($field_array as $field):?>
			<tr class='<?php echo md5($field_group[$group_id]['fieldgroup_name']);?>'>
				<td><?php echo form_label($field['field_name'],'field'.$field['field_id']);?></td>
				<td>
				<?php 
					switch ($field['field_type']) {
						case 'text':
							$data = array(
									'name'	=>	$field['field_id'],
									'value'	=>	set_value($field['field_id']),
									'id'	=>	'field'.$field['field_id'],
									'class'	=>	'field_input'
							);
							echo form_input($data);
							$data = '';
						break;
						
						case 'date':
							$data = array(
									'name'		=>	$field['field_id'],
									'value'		=>	set_value($field['field_id']),
									'id'		=>	'field'.$field['field_id'],
									'class'		=>	'field_date',
									'readonly'	=>	'readonly',
									
							);
							echo form_input($data);
							echo "<img src='".base_url()."assets/images/webdocker_62.png' class='localdate imgbtn'/>";
							$data = '';
						break;
						
						case 'dropdown':
							if (isset($fields_value[$field['field_id']])) {
								$data = is_array($fields_value[$field['field_id']])?$fields_value[$field['field_id']]:array();
								$data['']='';
							}else{
								$data = array();
							}
							$identity = 'id="field'.$field['field_id'].'" class="field_dropdown"';
							echo form_dropdown($field['field_id'],$data,set_value($field['field_id']),$identity);
							$data='';
						break;
						
						case 'multiselect':
							if (isset($fields_value[$field['field_id']])) {
								$data = is_array($fields_value[$field['field_id']])?$fields_value[$field['field_id']]:array();
								
							}else{
								$data = array();
							}
							$identity = 'id="field'.$field['field_id'].'" class="field_multiselect"';
							echo form_multiselect($field['field_id'].'[]',$data,set_value($field['field_id']),$identity);
							$data='';
						break;
						
						case 'price':
							$data = array(
									'name'	=>	$field['field_id'],
									'value'	=>	set_value($field['field_id']),
									'id'	=>	'field'.$field['field_id'],
									'class'	=>	'field_price'
							);
							echo form_input($data);
							$data = '';
						break;
						
						case 'note':
							$data = array(
									'name'	=>	$field['field_id'],
									'value'	=>	set_value($field['field_id']),
									'id'	=>	'field'.$field['field_id'],
									'class'	=>	'field_note'
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
							
							$identity = 'id="field'.$field['field_id'].'" class="field_listvariable"';
							echo form_dropdown($field['field_id'],$data,set_value($field['field_id']),$identity);
							$data='';
						break;
						
						default:
							$data = array(
									'name'	=>	$field['field_id'],
									'value'	=>	set_value($field['field_id']),
									'id'	=>	'field'.$field['field_id'],
									'class'	=>	'field_input'
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
<?php echo form_close();?>

<div id='preview_block'>
	
</div>
<div>
	<img class="imgbtn img_mouse_over" src="<?php echo base_url();?>assets/images/webdocker_48.png" alt="Enregistrement"/>
</div>
