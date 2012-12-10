/**
 * 
 */
$(document).ready(function(){
	
	$(".field_multiselect").dropdownchecklist({ width: 140 , maxDropHeight: 100 });
	$(".field_date").datepicker($.datepicker.regional['fr']);		
	$('.field_price').numeric();
	function setEndFocus(){
		var obj=event.srcElement;
		var txt = obj.createTextRange();
		txt.moveStart('character',obj.value.length+2);
		txt.collapse(true);
		txt.select();
	}
	$('#modify-product-toolbar').hover(
		function(){
			$(this).animate({left:"0px"},1000);
		},
		function(){
			$(this).animate({left:"-270px"},1000);
		}
	);
	
	
	$(".field_note").focus(function(){
		var setFocusText = $(this);
		var date = new Date();
		var today = (date.getDate())+"/"+(date.getMonth()+1)+"/"+date.getFullYear();
		if(setFocusText.val().indexOf(today)>=0){
			setEndFocus();
		}else{
			$(this).html(setFocusText.val()+"\n"+today+" : "+"  ");
			setEndFocus();
		}
	});
	
	$(".date_alert").click(function(){
		var this_id = $(this).attr('id');
		var this_id_array = this_id.split('_');
		var field_id = this_id_array[1];  //field_date_id
		var date_name = $(this).attr('title');
		var date_value = $('#field'+field_id).val();
		
		$('#set_alert_field_id').val(field_id);
		$('#set_alert_field_name').html(date_name);
		$('#set_alert_field_value').html(date_value);
			
		$.fn.colorbox({width:"250px",opacity:"0.7",inline:"true",href:"#set_date_alert",open:"true"});
	});
	
	$('#set_alert_ok').click(function(){
		var product_id = $('#product_id').val();
		var field_id = $('#set_alert_field_id').val();
		var alert_days = $('#set_alert_days').val();
		var alert_note = $('#set_alert_note').val();
		
		alert(product_id+' '+field_id+' '+alert_days+' '+alert_note);
	});
});