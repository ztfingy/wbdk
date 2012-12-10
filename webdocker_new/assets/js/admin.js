/**
 * 
 */

$(document).ready(function(){
	$('#field_group_table').dataTable({
		"bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false,
        'aaSorting': []
	});
	$('#field_table').dataTable({
		"bPaginate": false,
		"bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false,
        'aaSorting': []
	});
	
	$(".field_order").dblclick(function(){
		var order = $.trim($(this).html());
			
		$(this).html('<input type="text" class="span1 field_order_input" value="'+order+'" onblur="save_field_order($(this))" />');
		$(".field_order_input").numeric();
	});
	
	
});
function save_field_order(order_input){
		var order_tr = order_input.parent('td');
		var thisid = order_tr.attr('id');
		var thisidarray = thisid.split('_');
		var field_id = thisidarray[1];
		var field_item = thisidarray[2];
		var item_value = order_input.val();
		order_tr.html(item_value);
	};