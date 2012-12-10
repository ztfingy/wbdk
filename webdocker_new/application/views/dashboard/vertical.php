<table class="table" >
	<?php 
	$products_id_array = $this->session->userdata('result_products_id');
	$fields_id_array = $this->session->userdata('result_fields_id');
	for ($i=0;$i<ceil(sizeof($products_id_array)/4);$i++):?>
		<tr>
			<?php for($j=0;$j<4;$j++):?>
			<td>
				<?php if($i*4+$j<sizeof($products_id_array)):?>
				<div align="center">
				<!--  
					<span><?php echo $products_info[$products_id_array[$i*4+$j]]['product_name'];?></span>
				-->
					<?php echo scaleimage(preview_url().$products_info[$products_id_array[$i*4+$j]]['product_name'].".cdr_CDFWD.jpg",130,130);?>
					<table class="table table-bordered">
						<tr><td>Product : </td><td><?php echo $products_info[$products_id_array[$i*4+$j]]['product_name'];?></td></tr>
						<?php foreach ($this->session->userdata('result_fields_id') as $field_id):?>
							<tr><td><?php echo element($field_id,$fields_info);?> : </td><td><?php echo element($field_id, $products_info[$products_id_array[$i*4+$j]]);?></td></tr>
						<?php endforeach;?>
					
					</table>
				</div>
				<?php endif;?>
			</td>
			<?php endfor;?>
			
		</tr>
	
	<?php endfor;?>
</table>	

<div align="center"><span class="Style3"><A href="javascript:window.print()">Imprimer</A>
<A href="javascript:window.close()">Fermer</A></span> </div>

