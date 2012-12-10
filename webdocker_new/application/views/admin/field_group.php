<div>
	<label>Champ Groupes</label>
	<div class="input-append">
		<label for='field_group_name' class='help-inline' style='line-height:30px;'>Nouveau Groupe : </label>
  		<input class="span2" id="field_group_name" type="text">
  		<button class="btn" type="button">Ajouter</button>
	</div>

	<table class="well table" id='field_group_table'>
	<thead class='table-header'>
		<tr>
			<th>Groupe</th><th>Order</th><th>Produit</th><th>Fourniture</th>
		</tr>
	</thead>	
	<tbody>
		<?php foreach ($field_groups as $field_group):?>
			<tr class='field_group_item'>
				<td><?php echo anchor('admin/field_group/expand/'.$field_group['fieldgroup_id'],$field_group['fieldgroup_name']);?></td>
				<td><?php echo $field_group['fieldgroup_order'];?></td>
				<td><input type="checkbox" id='group_<?php echo $field_group['fieldgroup_id'];?>_product' <?php if($field_group['fieldgroup_of_product']==1){echo "checked='checked'";}?> /></td>
				<td><input type="checkbox" id='group_<?php echo $field_group['fieldgroup_id'];?>_accessory' <?php if($field_group['fieldgroup_of_accessory']==1){echo "checked='checked'";}?> /></td>
			</tr>
		<?php endforeach;?>
	</tbody>
	</table>

</div>