/**
 * 
 */
$(document).ready(function(){
	$.ajax({
			type:"POST",
			url:site_url+"sms/get_unread_sms_num/"+Math.random(),
			async:false,
			success:function(data){	
				var num = parseInt(data);

				if(num>0){
					$('#header_sms_img').attr('src',base_url+'assets/images/sms.png');
					$("#sms_count").html(num);
					$("#sms_count").css('z-index','10');
					
				}else{
					$('#header_sms_img').attr('src',base_url+'assets/images/sms_empty.png');
					$("#sms_count").html(num);
					$("#sms_count").css('z-index','-10');
					
				}		
			}
		});
	var refreshId = setInterval(function(){
		$.ajax({
			type:"POST",
			url:site_url+"sms/get_unread_sms_num/"+Math.random(),
			async:false,
			success:function(data){	
				var num = parseInt(data);

				if(num>0){
					$('#header_sms_img').attr('src',base_url+'assets/images/sms.png');
					$("#sms_count").html(num);
					$("#sms_count").css('z-index','10');
				}else{
					$('#header_sms_img').attr('src',base_url+'assets/images/sms_empty.png');
					$("#sms_count").html(num);
					$("#sms_count").css('z-index','-10');
					
				}		
			}
		});
	},60000);
	$("#editList").click(function(){
		$("#searchItemList").hide();
		$("#editItemList").slideToggle();
	});
	$("#searchList").click(function(){
		$("#editItemList").hide();
		$("#searchItemList").slideToggle();
	});
	
	$(".colorbox_new_product").colorbox({initialWidth:200,initialHeight:150});
	$("#save_basic_info").click(function(){
		var product_name = $.trim($("#new_product_name").val());
		var prodcut_type = $('#new_product_type').val();
		if(product_name==''){
			alert('type a name');
		}else{
			$.ajax({
				type:"POST",
				url:site_url+"product/save_product_basic_info",
				async:false,
				data:{name:product_name,type:prodcut_type},
				success:function(data){	
					try{
						var return_json = JSON.parse(data);
						switch(return_json.stat){
						case '0':
							alert('name exists!!');
							break;
						case '1':
							location.href=return_json.url;
							break;
						case '2':
							alert('save failed!!');
						}
					}catch(e){
						alert(e.message);
					}
							
							
				}
			});
		}
	});
	
	$(".img_mouse_over").mouseover(function() {
		var src = $(this).attr('src');
		$(this).attr('src',src+'_over.png');	
	}).mouseout(function() {
		var src = $(this).attr('src');
		$(this).attr('src',src.replace('_over.png',''));	
	});
	
	$(".field_group_title_tr").click(function(){
		var title_id = $(this).attr('id');
		$("."+title_id).toggle();
	});
	
	$(".localdate").click(function(){
		var t = new Date();
		var d = t.getDate();
		if(d<10){
			d="0"+d;	
		}
		var m = t.getMonth()+1;
		if(m<10){
			m="0"+m	;
		}
		var y = t.getFullYear();	
		var todaydate = d+"/"+m+"/"+y;
		$(this).prev("input").val(todaydate);
	});
		
	$('#toolbar-sms').hover(function() {
		$('#sms-list-ul').slideDown(1000);
	}, function() {
		$('#sms-list-ul').slideUp(1000);
	});	
});

function administration(){
	window.location.href=site_url+'admin';
}
