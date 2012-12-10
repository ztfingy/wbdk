/**
 * 
 */

$(document).ready(function(){
	$.ajax({
		type:"POST",
		url:site_url+"sms/get_recent_sms/"+Math.random(),
		async:false,
		datatype:'json',
		beforeSend:function(){
			$('#recent_sms .loading_img').show();
		},
		complete:function(){
			$('#recent_sms .loading_img').hide();
		},
		success:function(data){	
			$('#recent_sms').html(data);
			
		},
		error:function(){
			
		}
	});
	
	$.ajax({
		type:"POST",
		url:site_url+"product/get_recent_visit_product/"+Math.random(),
		async:false,
		datatype:'json',
		beforeSend:function(){
			$('#recent_visit .loading_img').show();
		},
		complete:function(){
			$('#recent_visit .loading_img').hide();
		},
		success:function(data){	
			$('#recent_visit').html(data);	
		},
		error:function(){
			
		}
	});
	
	$.ajax({
		type:"POST",
		url:site_url+"product/get_recent_new_product/"+Math.random(),
		async:false,
		datatype:'json',
		beforeSend:function(){
			$('#recent_product .loading_img').show();
		},
		complete:function(){
			$('#recent_product .loading_img').hide();
		},
		success:function(data){	
			$('#recent_product').html(data);	
		},
		error:function(){
			
		}
	});
	
	$.ajax({
		type:"POST",
		url:site_url+"revision/get_recent_revision/"+Math.random(),
		async:false,
		datatype:'json',
		beforeSend:function(){
			$('#recent_revision .loading_img').show();
		},
		complete:function(){
			$('#recent_revision .loading_img').hide();
		},
		success:function(data){	
			$('#recent_revision').html(data);	
		},
		error:function(){
			
		}
	});
	
	$.ajax({
		type:"POST",
		url:site_url+"product/get_recent_product_validation/"+Math.random(),
		async:false,
		datatype:'json',
		beforeSend:function(){
			$('#recent_product_validation .loading_img').show();
		},
		complete:function(){
			$('#recent_product_validation .loading_img').hide();
		},
		success:function(data){	
			$('#recent_product_validation').html(data);	
		},
		error:function(){
			
		}
	});
	
	$.ajax({
		type:"POST",
		url:site_url+"product/get_recent_group_validation/"+Math.random(),
		async:false,
		datatype:'json',
		beforeSend:function(){
			$('#recent_group_validation .loading_img').show();
		},
		complete:function(){
			$('#recent_group_validation .loading_img').hide();
		},
		success:function(data){	
			$('#recent_group_validation').html(data);	
		},
		error:function(){
			
		}
	});
	
	$.ajax({
		type:"POST",
		url:site_url+"alert/get_recent_alert/"+Math.random(),
		async:false,
		datatype:'json',
		beforeSend:function(){
			$('#recent_alert .loading_img').show();
		},
		complete:function(){
			$('#recent_alert .loading_img').hide();
		},
		success:function(data){	
			$('#recent_alert').html(data);	
		},
		error:function(){
			
		}
	});
});