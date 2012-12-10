$(document).ready(function(){
	$(".first").click(function(){
		
		
		$currentpage = $("#currentpageid").html();
		$totalapge = $("#totalpageid").html();
		$pagesize = $("#pagesizeid").val();
		
		
		$dataarray = {"c":$currentpage,"t":$totalapge,"p":$pagesize,"a":"1"};
		
		if($currentpage=='1'){
			alert("this is the first page.");
		}else{
			$("#searchresulttable").html("<tr><td align='center'><img src='images/loading.gif'></td></tr>");
		$.ajax({
			type:"POST",
			url:"ajax/getSearchResult.php",
			async:false,
			data:$dataarray,
			success:function(data){
				$("#searchresulttable").html(data);
				$(".currentpage").each(function(){
					$(this).html("1");
				});			
				}
			});
	}
	});
	$(".prev").click(function(){
		
		
		$currentpage = $("#currentpageid").html();
		$totalapge = $("#totalpageid").html();
		$pagesize = $("#pagesizeid").val();
		
		$dataarray = {"c":$currentpage,"t":$totalapge,"p":$pagesize,"a":"2"};
		
		if($currentpage=="1"){
			alert("this is the first page.");
		}else{
			$("#searchresulttable").html("<tr><td align='center'><img src='images/loading.gif'></td></tr>");
		$.ajax({
			type:"POST",
			url:"ajax/getSearchResult.php",
			async:false,
			data:$dataarray,
			success:function(data){
				$("#searchresulttable").html(data);
				$(".currentpage").each(function(){
					$(this).html($currentpage-1);
				});			
				}
		});
		}
	});
	$(".next").click(function(){
		
		
		$currentpage = $("#currentpageid").html();
		$totalapge = $("#totalpageid").html();
		$pagesize = $("#pagesizeid").val();
		
		$dataarray = {"c":$currentpage,"t":$totalapge,"p":$pagesize,"a":"3"};
		
		if($currentpage==$totalapge){
			alert("this is the last page."+$currentpage+":"+$totalapge+":"+$pagesize+":"+$(this).attr("class"));
		}else{
			$("#searchresulttable").html("<tr><td align='center'><img src='images/loading.gif'></td></tr>");
		$.ajax({
			type:"POST",
			url:"ajax/getSearchResult.php",
			async:false,
			data:$dataarray,
			success:function(data){
	//alert(data);
				$("#searchresulttable").html(data);
				$(".currentpage").each(function(){
					$(this).html($currentpage*1+1);
				});			
				}
		});
		}
	});
	$(".last").click(function(){
		
		
		$currentpage = $("#currentpageid").html();
		$totalapge = $("#totalpageid").html();
		$pagesize = $("#pagesizeid").val();
		
		$dataarray = {"c":$currentpage,"t":$totalapge,"p":$pagesize,"a":"4"};
		
		if($currentpage==$totalapge){
			alert("this is the last page.");
		}else{
			$("#searchresulttable").html("<tr><td align='center'><img src='images/loading.gif'></td></tr>");
		$.ajax({
			type:"POST",
			url:"ajax/getSearchResult.php",
			async:false,
			data:$dataarray,
			success:function(data){
				$("#searchresulttable").html(data);
				$(".currentpage").each(function(){
					$(this).html($totalapge);
				});			
				}
		});
		}
	});
	
	
	$(".pagesize").change(function(){
		
		$totalprods = $("#totalprods").val();		
		$currentpage = $("#currentpageid").html();		
		$pagesize = $(this).val();
		$totalapge = Math.ceil($totalprods/$pagesize);
		
		//alert($totalprods);
		//alert($pagesize);
		//alert($totalapge);
		
		
		$op10 = "";
		$op20 = "";
		$op50 = "";
		$op100 = "";
		if($pagesize=='10'){
			$op10 = "selected='selected'";
		}else  if($pagesize=='20'){
			$op20 = "selected='selected'";
		}else  if($pagesize=='50'){
			$op50 = "selected='selected'";
		}else  if($pagesize=='100'){
			$op100 = "selected='selected'";
		}
		
		$op = "<option value='10' "+$op10+">10</option><option value='20' "+$op20+">20</option><option value='50' "+$op50+">50</option><option  value='100' "+$op100+">100</option>"
		
		$(".pagesize").each(function(){
			$(this).html($op);
		});

		$(".totalpage").each(function(){
			$(this).html($totalapge);
		});
		
$dataarray = {"c":$currentpage,"t":$totalapge,"p":$pagesize,"a":"1"};
		
		
			$("#searchresulttable").html("<tr><td align='center'><img src='images/loading.gif'></td></tr>");
			$.ajax({
			type:"POST",
			url:"ajax/getSearchResult.php",
			async:false,
			data:$dataarray,
			success:function(data){
				$("#searchresulttable").html(data);
				$(".currentpage").each(function(){
					$(this).html("1");
				});			
				}
			});

		
	});
	
	
	
	
	
	
	
});