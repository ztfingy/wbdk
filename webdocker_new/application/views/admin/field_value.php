<div>
	


	<div class='field_value_wrapper'>
		<div class='field_value_content'>
		<div class='field_value_div well'>
			<label class='field_name_label' id=''><?php echo element('field_name', $field);?></label>
			<ul class='unstyled' id=''>
			<?php foreach ($field_values as $field_value):?>
				<li class='field_value_li'><?php echo $field_value['fieldvalue_value'];?></li>
			<?php endforeach;?>			
			</ul>		
		</div>
		<div style='display:inline-block'>
			<i class='icon-plus' id=''></i>
		</div>
			
		</div>
	</div>

<div class="input-append">
  		<input class="span2" id="field_group_name" type="text">
  		<button class="btn" type="button">Ajouter</button>
	</div>


</div>