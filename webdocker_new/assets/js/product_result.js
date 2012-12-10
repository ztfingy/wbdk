/**
 * 
 */

$(document).ready(function(){
	var products_id_string = $('#result_product_id').val();
	var products_id_array = products_id_string.split(',');

	var fields_id_string = $('#result_field_id').val();
	var fields_id_array = fields_id_string.split(',');
	
	$(".field_group_title_checkbox").click(function(event){
		var checkbox_id = $(this).attr("id");
		var checkbox_stat = $(this).prop("checked");
		$("."+checkbox_id).each(function(){
			$(this).prop("checked",checkbox_stat);
			var field_id = $(this).val();
			if(checkbox_stat){
				if($.inArray(field_id,fields_id_array)<0){
					fields_id_array.push(field_id);
				}
			}else{
				fields_id_array.splice($.inArray(field_id,fields_id_array),1);
			}
		});
		event.stopPropagation();
	});
	
	$("input[name='product_field']").click(function(){
		var checkbox_stat = $(this).prop("checked");
		var checkbox_title = $(this).attr("title");
		
		if(!checkbox_stat){
			$("#"+checkbox_title).prop("checked",checkbox_stat);
		}
	});
	
	$('#search-result-toolbar').hover(
		function(){
			$(this).animate({left:"0px"},1000);
		},
		function(){
			$(this).animate({left:"-270px"},1000);
		}
	);
	check_product_result();
	function check_product_result(){
		$('.product_result_check').each(function(){
			var product_id = $(this).val();
			if($.inArray(product_id,products_id_array)>=0){
				$(this).prop('checked',true);
			}
		});
	}
	
	$("#product_fields_check_all").click(function(){
		var check_all = $(this).prop('checked');
		if(check_all){
			fields_id_array = fields_id_string.split(',');
		}else{
			fields_id_array = new Array();
		}
		$('.product_fields').each(function(){
			$(this).prop('checked',check_all);			
		});
	});
	
	$(".product_result_check").click(function(){
		select_product($(this));
	});
	
	function select_product(result_checkbox){
		var product_id = result_checkbox.val();
		var select = result_checkbox.prop('checked');
		if(select){
			products_id_array.push(product_id);
		}else{
			products_id_array.splice($.inArray(product_id,products_id_array),1);
		}
	}
	function save_selected_products(){		
		$.ajax({
			type:"POST",
			url:site_url+"product/products_id_temp",
			async:false,
			data:{products_array:products_id_array,fields_array:fields_id_array},
			success:function(data){			

			}
		});
	}
	$('#edit_all').click(function(){
		save_selected_products();
		
	});
	
	$('#dashboard1').click(function(){
		save_selected_products();
		window.location.href = site_url+'dashboard/horizontal';
	});
	$('#dashboard2').click(function(){
		save_selected_products();	
		window.location.href = site_url+'dashboard/vertical';
	});
	$('#dashboard3').click(function(){
		save_selected_products();
	});
	$('#dashboard4').click(function(){
		save_selected_products();
	});
	$('#dashboard5').click(function(){
		save_selected_products();
	});
	$('#dashboard6').click(function(){
		save_selected_products();
	});
	$('#dashboard7').click(function(){
		save_selected_products();
	});
	$('#dashboard8').click(function(){
		save_selected_products();
	});
	$('#dashboard9').click(function(){
		save_selected_products();
		window.location.href = site_url+'dashboard/analysis';
		
	});

});

