/**
 * 
 */
$(document).ready(function(){
	function adminWindow(url){		
		window.external.Application.InitializeVBA();
	   	window.external.Application.GMSManager.RunMacro( "CDFWEBDOCK", "Macros.NewWindow",url);	
	};
	
	
	$("save_btn").click(function(){
		var product_name = $.trim($("#newProdName").val());

		if(product_name!=''){
			$.post(base_url+"product/check_product_name/"+product_name,function(data){
	
				if(parseInt(data)=1){
					alert("Un produit porte deja ce nom");
				}else{
					
					window.external.Application.InitializeVBA();
					
					
					if (window.external.Application.Documents.Count<=0){
						alert ('Aucun document ouvert');
					} else{
						
						$.ajax({
							type:"POST",
							url:base_url+"file_folder/get_folder_info/",
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
										
									  	
									  	document.getElementById('fullName').innerText= window.external.Application.ActiveDocument.FullFileName;
									  	document.getElementById('fullNamehdField').innerText= window.external.Application.ActiveDocument.FullFileName;
									  	document.getElementById('shortNamehdField').innerText= window.external.Application.ActiveDocument.FileName;
									  	window.external.Application.InitializeVBA();
									  	window.external.Application.GMSManager.RunMacro( "CDFWEBDOCK", "Macros.CDFWDPrevwM" );
									  	
									  	window.external.Application.InitializeVBA();
									  	window.external.Application.GMSManager.RunMacro( "CDFWEBDOCK", "Macros.uploadFile" );
									  	document.forms['addProduct'].submit();
									}
									catch(e)
									{
									alert(e.message);
									}

								}		
								
							}
						});
						
					}
					
				}
			});
		}else{
			alert ('Donnez un nom au produit svp');
		}
	});

	
});