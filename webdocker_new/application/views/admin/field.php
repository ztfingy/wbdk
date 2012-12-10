<div>
	<label>Champs Produit</label>
	<div class="input-prepend input-append">
		<select class='span2'> 
			<option value='dropdown'>Liste deroulante</option>
			<option value='multiselect'>Multi Selection List</option>
			<option value='listvariable'>Liste Variable</option>
			<option value='text'>Champs libre</option>
			<option value='note'>Note</option>
			<option value='date'>Date</option>
			<option value='price'>Prix</option>

		</select>
		
			<input id="field_name" class="span2" type="text">
		<button class='btn'>Ajouter</button>
		
	</div>
	<table class="well table" id='field_table'>
	<thead class='table-header'>
		<tr>
			<th>Champe</th>
			<th>Voir</th>
			<th>Recherche</th>
			<th>Cartouche</th>
			<th>Fourniture Cartouche</th>
			<th>Produit</th>
			<th>Fourniture</th>
			<th>Groupe</th>
			<th>Ordre</th>
			<th>Type</th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($fields as $field):?>
			<tr class='field_item'>
				<td>
				<?php 				
					echo $field['field_name'];	
				?>
				
				</td>
				<td><input type="checkbox" id='field_<?php echo $field['field_id'];?>_see' <?php if($field['field_of_product']==1){echo "checked='checked'";}?> /></td>
				<td><input type="checkbox" id='field_<?php echo $field['field_id'];?>_search' <?php if($field['field_of_product']==1){echo "checked='checked'";}?> /></td>
				<td><input type="checkbox" id='field_<?php echo $field['field_id'];?>_cartouche' <?php if($field['field_of_accessory']==1){echo "checked='checked'";}?> /></td>
				<td><input type="checkbox" id='field_<?php echo $field['field_id'];?>_fourcartouche' <?php if($field['field_of_accessory']==1){echo "checked='checked'";}?> /></td>
				<td><input type="checkbox" id='field_<?php echo $field['field_id'];?>_product' <?php if($field['field_of_accessory']==1){echo "checked='checked'";}?> /></td>
				<td><input type="checkbox" id='field_<?php echo $field['field_id'];?>_accessory' <?php if($field['field_of_accessory']==1){echo "checked='checked'";}?> /></td>
				<td>
					<?php 
						$identity = 'class="field_group span2" id="group_'.$field['field_id'].'_group"';
						echo form_dropdown('field_group',$field_groups,$field['field_fieldgroup_id'],$identity);
					?>
				</td>
				<td class='field_order' id='field_<?php echo $field['field_id'];?>_order'>
					<?php echo $field['field_order'];?>
				</td>
				<td>
					<?php echo $field_type_array[$field['field_type']];?>
				</td>
				<td>
				<?php if ($field['field_type']=='dropdown'||$field['field_type']=='multiselect'||$field['field_type']=='listvariable'):?>
				<a href='<?php echo site_url('admin/field/expand/'.$field['field_id']);?>'>
				<i class="icon-plus" id='field_<?php echo $field['field_id'];?>_add'></i>
				</a>
				<?php endif;?>
				</td>
				<td><i class="icon-minus" id='field_<?php echo $field['field_id'];?>_delete'></i></td>
			</tr>
		<?php endforeach;?>
	</tbody>	
	</table>
	<pre>
		<?php print_r($fields);?>
	</pre>
</div>