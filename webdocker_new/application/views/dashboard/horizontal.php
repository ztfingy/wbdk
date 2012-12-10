<table class="table table-bordered" >
	<tr>
		<th>Product</th>
		<?php foreach ($this->session->userdata('result_fields_id') as $field_id):?>
			<th><?php echo element($field_id,$fields_info);?></th>
		<?php endforeach;?>
	</tr>
	
	<?php foreach ($this->session->userdata('result_products_id') as $product_id):?>
		<tr>
			<td>
				<?php echo $products_info[$product_id]['product_name'];?>
				<?php echo scaleimage(preview_url().$products_info[$product_id]['product_name'].".cdr_CDFWD.jpg",100,100);?>
			</td>
			<?php foreach ($this->session->userdata('result_fields_id') as $field_id):?>
			<td><?php echo element($field_id, $products_info[$product_id]);?></td>
			<?php endforeach;?>
		</tr>
	<?php endforeach;?>


</table>