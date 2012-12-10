/**
 * 
 */
$(document).ready(function(){
	
	var product_changed_value = {};

	function adminWindow(url){		
		window.external.Application.InitializeVBA();
	   	window.external.Application.GMSManager.RunMacro( "CDFWEBDOCK", "Macros.NewWindow",url);	
	};
	function launchDoc(varStrFile)
	{
		try
		{
				window.external.Application.InitializeVBA();
				window.external.Application.GMSManager.RunMacro( "CDFWEBDOCK", "Macros.LaunchFile",varStrFile);
		}
		catch(e)
		{
	
		}
	}
	
	function loadFileName(openfile)
	{
	  
	  	openfile = $.trim(openfile);
	  	if (openfile!="")
	  	{
	    window.external.Application.InitializeVBA();
		window.external.Application.GMSManager.RunMacro( "CDFWEBDOCK", "Macros.FileExists",openfile);
		window.external.Application.OpenDocument(openfile);
		}
		
	}
	
	Object.size = function(obj) {
	    var size = 0, key;
	    for (key in obj) {
	        if (obj.hasOwnProperty(key)) 
	        	size++;
	    }
	    return size;
	};


	window.onbeforeunload = function(){
		if(Object.size(product_changed_value)>0){
		        return 'you change some value but not save, if you leave this page, will lost these value,do you really want to leave?';
		   
		}
		  
	}
	$(".product_fields").change(function(){
		var field_id = $(this).attr('name');
		var field_value = $(this).val();
		product_changed_value[field_id]=field_value;
		
	});
	$(".modify_localdate").click(function(){
		var thisid = $(this).attr('id');
		var id_array = thisid.split('_');
		var field_id = id_array[1];
		
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
		$('#field'+field_id).val(todaydate);
		$("#cloche_"+field_id).hide();
		product_changed_value[field_id]=todaydate;
	});
	
	$(".field_date").change(function(){
		var field_id = $(this).attr('name');
		$("#cloche_"+field_id).hide();
	});
	
	/*
	 * 使用numeric插件后，change不好用，暂用blur代替
	 */
	$(".field_price").blur(function(){
		var field_id = $(this).attr('name');
		var field_value = $(this).val();
		product_changed_value[field_id]=field_value;
	});
	
	
	$(".save_btn").click(function(){
		
			
		
		var product_cdr = $.trim($("#product_cdrfulllink").val());
		
		window.external.Application.InitializeVBA();
		/*
		 * 如果产品没有文件，并且有文件打开，保存打开的文件为当前产品文件，
		 * 如果产品有文件，并且没有打开，忽略当前打开的文件
		 * 如果产品有文件，并且已经打开，保存
		 */

		if((product_cdr==''&&window.external.Application.Documents.Count>0)||(product_cdr!=''&&window.external.Application.Documents.Count>0&&window.external.Application.ActiveDocument.FullFileName.replace(/(\\)+/g,'\\')==product_cdr.replace(/(\\)+/g,'\\'))){
			var prodname = $('#product_name').val();
			$.ajax({
				type:"POST",
				url:site_url+"file_folder/get_file_destination/"+prodname,
				async:false,
				success:function(data){	
					if(parseInt(data)==1){
						alert("You have no folder to save the file, please contact the administrator.");
					}else{
						try
						{

						   var folderJson = JSON.parse(data);
						   
						   var cdrfilepath = folderJson.cdrfolderpath+prodname + '.cdr';
							var pdffilepath = folderJson.pdffolderpath+prodname + '.cdr';
							
							window.external.Application.GMSManager.RunMacro( "CDFWEBDOCK", "Macros.CreateFileFolder",folderJson.cdrfolderpath);
							window.external.Application.GMSManager.RunMacro( "CDFWEBDOCK", "Macros.CreateFileFolder",folderJson.pdffolderpath);
							window.external.Application.GMSManager.RunMacro( "CDFWEBDOCK", "Macros.CreateFileFolder",folderJson.attfolderpath);

							
							window.external.Application.GMSManager.RunMacro( "CDFWEBDOCK", "Macros.SaveAs_CDFWD",cdrfilepath );
							
							window.external.Application.GMSManager.RunMacro( "CDFWEBDOCK", "Macros.Topdf",pdffilepath );
							
						  	
						  	$('#product_cdrfulllink').val(cdrfilepath);
						  	$('#full_file_link').val(cdrfilepath);
						  	$('#product_pdffulllink').val(pdffilepath);
						  	product_changed_value['product_preview'] = prodname+".cdr_CDFWD.jpg";
						  	product_changed_value['product_cdrfulllink'] = cdrfilepath;
						  	product_changed_value['product_pdffulllink'] = pdffilepath;
						  	
						  	window.external.Application.InitializeVBA();
						  	window.external.Application.GMSManager.RunMacro( "CDFWEBDOCK", "Macros.CDFWDPrevwM" );
						  	window.external.Application.GMSManager.RunMacro( "CDFWEBDOCK", "Macros.uploadFile" );
						  	$('.product_preview_image img').attr('src',preview_url+prodname+'.cdr_CDFWD.jpg?'+Math.random());
						}
						catch(e)
						{
						alert(e.message);
						}
					}						
				}					
			});	
		}
		

		/*
		 * 保存修改
		 */
		var data = product_changed_value;	
		if(Object.size(data)>0){
			var product_id = $("#product_id").val();
			$.post(site_url+"product/save_product_detail_info/"+product_id,data,function(data){
				 if(parseInt(data)==1){
					 product_changed_value = {};
					 $(".field_date").show();
					 alert('OK');
				 }else{
					 alert('save failed! try again,please');
				 }
			});		
		}
		
	});

	$(".save_as_btn").click(function(){
		
	});
	
	
	
	
	
	
	$("#uploadpreviewbtn").click(function(){
		var product_name = $("#product_name").val();
		window.external.Application.InitializeVBA();
	  	window.external.Application.GMSManager.RunMacro( "CDFWEBDOCK", "Macros.uploadPreview",product_name);
	  	$('.product_preview_image img').attr('src',preview_url+product_name+'.cdr_CDFWD.jpg?'+Math.random());
	});
	
	
	
	$("#open_pdf").click(function(){
		var pdf_file_path = $("#product_pdffulllink").val();
		launchDoc(pdf_file_path);
	});
	
	
	$("#preview_block").dblclick(function(){
		var cdr_file_path = $("#product_cdrfulllink").val();
		loadFileName(cdr_file_path);
	});
});