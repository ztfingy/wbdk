/**
 * 
 */
$(document).ready(function(){
	function adminWindow(url){		
		window.external.NewWindow(url);
	};
	function launchDoc(varStrFile)
	{
		try
		{
			window.external.LaunchFile(varStrFile);
		}
		catch(e)
		{
	
		}
	}
	
	function loadFileName(openfile)
	{
		launchDoc(openfile);		
	}
	
	
	
	$("save_btn").click(function(){
		
	});

	
});