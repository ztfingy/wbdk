<div id='search-result-toolbar'>
	<a href="<?php echo site_url('product/search/') ?>"><img class="imgbtn img_mouse_over" src="<?php echo base_url();?>assets/images/webdocker_30.png" alt="Search"/></a>
    <a href="<?php echo site_url('product/search/') ?>"><img class="imgbtn img_mouse_over" src="<?php echo base_url();?>assets/images/webdocker_32.png" alt="New Search"/></a> 
    <img src="<?php echo base_url();?>assets/images/vertical_separation.png" /> 
    <div class="merchandisingList">
	    <img src="<?php echo base_url();?>assets/images/webdocker_35.png" class="merchandising"/>  
	    <ul>
	        <li><a href="#" class="addnewlist">new list</a></li>
	        <li><a href="#" class="addexistlist">existed list</a></li>
	    </ul>
    </div>
    <img src="<?php echo base_url();?>assets/images/spacer.gif" />
    <br/>         
</div>
<img src="<?php echo base_url();?>assets/images/Horizontal_separation.png" class="horizontal_sep" />          
<br />

<div>
	<img src="<?php echo base_url();?>assets/images/first.png" class="first"/>
	<img src="<?php echo base_url();?>assets/images/prev.png" class="prev"/>
	<span class="currentpage" id="currentpageid">1</span>/<span class="totalpage" id="totalpageid"><?php echo ceil(sizeof($products_id)/10);?></span>		        
	<img src="<?php echo base_url();?>assets/images/next.png" class="next"/>
	<img src="<?php echo base_url();?>assets/images/last.png" class="last"/>

	show : 
	<select class="pagesize" id="pagesizeid" style="width:60px">
		<option selected="selected"  value="10" >10</option> 
		<option value="20">20</option>
		<option value="50">50</option>
		<option  value="100">100</option>
	</select>
	
	<table class="well table table-striped">
		<?php if(isset($products)&&is_array($products)&&sizeof($products)>0):?>
			<?php foreach ($products as $product):?>
			<tr>
			<td width="140" valign="top"><input type="checkbox" value='<?php echo $product['product_id'];?>' class='product_result_check' /><?php echo $product['product_name'];?></td>
			<td width="93" valign="top"><div align="right"> <?php echo scaleimage(preview_url().$product['product_name'].".cdr_CDFWD.jpg?id=".rand(),33,33)?></div></td>
			<td width="25" valign="top"><div align="right"><a href='<?php echo site_url('product/modify/'.$product['product_type'].'/'.$product['product_id']);?>' ><img src='<?php echo base_url();?>assets/images/webdocker_68.png' alt="View" border=0 /></a></div></td>
			</tr>
			<?php endforeach;?>
	<?php else:?>
			<tr>
				<td>no products</td>
			</tr>
	<?php endif;?>
	</table>
	
	<br />
	<label class="checkbox inline">
	<input type="checkbox" name="" value=""/>all in this page
	</label>
	<br />
	Total <span id="total_pieces_num"><?php $total = is_array($products_id)?sizeof($products_id):0;echo $total;?> </span> pieces, Select <span id="total_pieces_num"></span> pieces
	<br />
	<input type="button" class='btn' id='edit_all' value='Edit All' />
	<div>
	<img id='dashboard1' class="imgbtn img_mouse_over" id="btnShow1" src="<?php echo base_url();?>assets/images/webdocker_Dash5.png" alt="Dashboard Horizontal" />
	<img id='dashboard2' class="imgbtn img_mouse_over" id="btnShow2" src="<?php echo base_url();?>assets/images/webdocker_Dash7.png" alt="Dashboard Vertical" />
	<img id='dashboard3' class="imgbtn img_mouse_over" id="btnShow3" src="<?php echo base_url();?>assets/images/webdocker_Dash8.png" alt="Dashboard Horizontal Groupe"/>
	<img id='dashboard4' class="imgbtn img_mouse_over" id="btnShow4" src="<?php echo base_url();?>assets/images/webdocker_Dash6.png" alt="Dashboard Vertical Groupe"/>	
	<img id='dashboard5' class="imgbtn img_mouse_over" id="btnShow5" src="<?php echo base_url();?>assets/images/webdocker_Dash1.png" alt="Dashboard Fourniture" />
	
	<br />
	<img id='dashboard6' class="imgbtn img_mouse_over" id="btnShow6" src="<?php echo base_url();?>assets/images/webdocker_Dash3.png" alt="Dashboard Alarme" />
 	<img id='dashboard7' class="imgbtn img_mouse_over" id="btnShow8" src="<?php echo base_url();?>assets/images/webdocker_Dash4.png" alt="Dashboard Parcs Famille" />
 	<img id='dashboard8' class="imgbtn img_mouse_over" id="btnShow9" src="<?php echo base_url();?>assets/images/webdocker_Dash5.png" alt="Dashboard Horizontal with Validation" />
 	<img id='dashboard9' class="imgbtn img_mouse_over" id="btnShow10" src="<?php echo base_url();?>assets/images/webdocker_Dash5.png" alt="Dashboard Analysis" />
	</div>
	<img src="<?php echo base_url();?>assets/images/Horizontal_separation.png" class="horizontal_sep" />
</div>

<div>
<div id="field_template"></div>
<table class="well" id="product_field_table">
<tr>
	<td>
		<label class="checkbox inline"> 
			<input type="checkbox" id="product_fields_check_all" checked="checked"> ALL
		</label> 
	</td>
</tr>
<?php foreach ($fields_group as $groups):?>
		<?php foreach ($groups as $group_id=>$field_array):?>
			<?php $groupname = $group_id==0?'group0':$field_group[$group_id]['fieldgroup_name'];?>
			<tr>
				<td colspan="3" class='field_group_title_tr' id='<?php echo md5('group_'.$groupname);?>'>
					<label class="checkbox inline"> 
						<input type="checkbox" id="<?php echo md5('field_group_'.$group_id);?>" class="field_group_title_checkbox" value=""  checked="checked"><?php echo $group_name = $group_id==0?'':$field_group[$group_id]['fieldgroup_name'];?>
					</label> 	
				</td>
			</tr>
			
			<?php foreach ($field_array as $field):?>
			<tr class='<?php echo md5('group_'.$groupname);?>'>
				<td>
					<label class="checkbox inline"> 
						<input type="checkbox" name="product_field" class="<?php echo md5('field_group_'.$group_id);?> product_fields" title='<?php echo md5('field_group_'.$group_id);?>' value="<?php echo $field['field_id'];?>"  checked="checked"><?php echo $field['field_name'];?>
					</label> 
				</td>			
			</tr>
			<?php endforeach;?>
		<?php endforeach;?>
	<?php endforeach;?>
</table>

<div style='display:none'>
	<input type="hidden" id='result_product_id' value='<?php echo $result_product_id;?>' />
	<input type="hidden" id='result_field_id' value='<?php echo $result_field_id;?>' />
</div>
</div>


