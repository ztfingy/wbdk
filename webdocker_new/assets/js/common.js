// JavaScript Document
$(document).ready(function(){
	var page = $("#Page").val();
	var groupnum = $("#groupnum").val();
	$("#btnShow1").click(function(){
		
		//getAllProducts();
		$.ajax({
			type:"POST",
			url:"ajax/getSearchProds.php",
			async:false,
			success:function(data){			
				$("#totalprodsid").val(data);
				$("#form1").attr("target","_blank");
				$("#form1").attr("action","showDashboard.php");	
				$("#form1").submit();		
				}
			});
		
	});	
	$("#btnShow2").click(function(){
		//getAllProducts();
		$.ajax({
			type:"POST",
			url:"ajax/getSearchProds.php",
			async:false,
			success:function(data){			
				$("#totalprodsid").val(data);
				$("#form1").attr("target","_blank");
				$("#form1").attr("action","showDashboardCol.php");
				$("#form1").submit();	
				}
			});
		
		
	
		
	});	
	$("#btnShow3").click(function(){
		//getAllProducts();
		$.ajax({
			type:"POST",
			url:"ajax/getSearchProds.php",
			async:false,
			success:function(data){			
				$("#totalprodsid").val(data);
				$("#form1").attr("target","_blank");
				$("#form1").attr("action","showDashboardGroup.php");
				$("#form1").submit();
				}
			});
		
		
	});
	$("#btnShow4").click(function(){
		//getAllProducts();
		$.ajax({
			type:"POST",
			url:"ajax/getSearchProds.php",
			async:false,
			success:function(data){			
				$("#totalprodsid").val(data);
				$("#form1").attr("target","_blank");
				$("#form1").attr("action","showDashboardColGroup.php");
				$("#form1").submit();	
				}
			});
				
	});		
	$("#btnShow5").click(function(){
		//getAllProducts();
		$.ajax({
			type:"POST",
			url:"ajax/getSearchProds.php",
			async:false,
			success:function(data){			
				$("#totalprodsid").val(data);
				$("#form1").attr("target","_blank");
				$("#form1").attr("action","showDashboardFournitures.php");
				$("#form1").submit();
				}
			});
		
		
	});	
	$("#btnShow6").click(function(){
		//getAllProducts();
		$.ajax({
			type:"POST",
			url:"ajax/getSearchProds.php",
			async:false,
			success:function(data){			
				$("#totalprodsid").val(data);
				$("#form1").attr("target","_blank");
				$("#form1").attr("action","showDashboardAlerts.php");
				$("#form1").submit();
				}
			});
		
		
	});
	$("#btnShow7").click(function(){
		//getAllProducts();
		$.ajax({
			type:"POST",
			url:"ajax/getSearchProds.php",
			async:false,
			success:function(data){			
				$("#totalprodsid").val(data);
				$("#form1").attr("target","_blank");
				$("#form1").attr("action","showProductProcess.php");
				$("#form1").submit();	
				}
			});
		
		
	});
	$("#btnShow8").click(function(){
		//getAllProducts();
		$.ajax({
			type:"POST",
			url:"ajax/getSearchProds.php",
			async:false,
			success:function(data){			
				$("#totalprodsid").val(data);
				$("#form1").attr("target","_blank");
				$("#form1").attr("action","showDashboard_Parcs_Famille.php");
				$("#form1").submit();	
				}
			});
		
		
	});
	$("#btnShow9").click(function(){
		//getAllProducts();
		$.ajax({
			type:"POST",
			url:"ajax/getSearchProds.php",
			async:false,
			success:function(data){			
				$("#totalprodsid").val(data);
				$("#form1").attr("target","_blank");
				$("#form1").attr("action","showDashboardwithValidateField.php");
				$("#form1").submit();	
				}
			});		
	});
	$("#btnShow10").click(function(){
		
		//getAllProducts();
		var totalFields = $("input[name='listing[]']:checked").length;
		if(totalFields>20){
			alert("Please select less than 20 fields to analyse.");
		}else{
		$.ajax({
			type:"POST",
			url:"ajax/getSearchProds.php",
			async:false,
			success:function(data){			
				$("#totalprodsid").val(data);
				$("#form1").attr("target","_blank");
				$("#form1").attr("action","showDashboardAnalysis.php");
				$("#form1").submit();	
				}
			});		
		}
	});
	
	$("#editLi").hover(
		function(){			
			$("#editItemList").show();
		},
		function(){			
			$("#editItemList").hide();			
		}
	);
	
	$("#newMultiProduct").hover(

		function(){			
			$("#MultiProductList").show();
		},
		function(){		
			$("#MultiProductList").hide();		
		}

	);
	$(".editall").click(function(){
		getMultiProducts();
		$("#form1").attr("target","_self");
		$("#form1").attr("action","MultipleEdit.php");
		$("#form1").submit();
	});
	$("#btnListShow1").click(function(){
		$("#listform").attr("target","_blank");
		$("#listform").attr("action","showListDashboard.php");
	});	
	
	$("#btnListShow2").click(function(){
		$("#listform").attr("target","_blank");
		$("#listform").attr("action","showListDashboardCol.php");
	});
	
	$("#savelinks").click(function(){
		getAllProducts();
		$("#form1").submit();
	});
	$("#listOK").click(function(){
		$("#listform").attr("target","_self");
		$("#listform").attr("action","");
	});
	
	
	
	//sms 列表显示
	$("#smsli").hover(function(){
		$("#smsfunction").toggle();
		
	});
	
	$(".alertPop").colorbox({iframe:true,onLoad: function() {$('#cboxClose').remove();}, innerWidth:220, innerHeight:200,title:true});
	$(".smsfunctionlist a").colorbox({iframe:true,innerWidth:250, innerHeight:400,title:true});
	$(".teammanagement").colorbox({iframe:true,innerWidth:220, innerHeight:250,title:true});
	$(".viewFieldBlockDetail").colorbox({iframe:true,href:function(){return "getBlockDetail.php?bid="+$(this).prev("select").val();},innerWidth:220,innerHeight:250});

	
	
	$("#currencyunit").change(function(){
		var cunit = $("#currencyunit").val();
		$.post("ajax/changeCurrencyUnit.php",{currencyunit:cunit},function(data){
			
		});
	});
	$("#groupby").change(function(){
		var groupfield = $("#groupby").val();
		$.post("ajax/changeGroupby.php",{field:groupfield},function(data){
			
		});
	});
	$(".datepicker,.datepickerread").datepicker($.datepicker.regional['fr']);
	
	$(".searchlistfield").dropdownchecklist({ width: 157 , maxDropHeight: 100 });
	
	 
	 $("#accessarySearchresult").tablesorter({widthFixed: true, widgets: ['zebra']}).tablesorterPager({ container: $(".pagerOne"), positionFixed: false }); 
	/* 
	$("#functionbtn").mouseover(function(){
		if($("#functions").css("display")!="block"){
			$(this).attr("src","images/fonctions_over.png")
		}
	});
	$("#functionbtn").mouseout(function(){
		if($("#functions").css("display")!="block"){
			$(this).attr("src","images/fonctions.png");
		}
	});
	*/
	$("#functionbtn").click(function(){
		
	//	if($("#functions").attr('display')=='none'){
		var os = $(this).offset();
		$("#functions").css("top",(os.top+23)+"px");
		$("#functions").css("left",os.left+"px");
		$("#functions").toggle();
		if($("#functions").css("display")=="block"){
			$(this).attr("src","images/fonctions_over.png");
			
			$("#functions li").mouseover(function(){
				$(this).css("background","#A0A0A0");
			});
			$("#functions li").mouseout(function(){
				$(this).css("background","#F0F0F0");
			});
			$("#functions li").click(function(){
				$("#functions").hide();                                                                                                                                  
			})
		}else{
			$(this).attr("src","images/fonctions.png");
		}
	//	}
		
	});

	$("#newProdName").blur(function(){
		var pname = $("#newProdName").val();
			if ($.trim(pname)!='') { 
				$.post("ajax/checkProductName.php",{newprodname:pname},function(data){
					if (data*1>=1) {
						$("#nameexist").html("<img src='images/webdocker_03.png'></img>");
						alert("Un produit porte deja ce nom");
					}else {
						$("#nameexist").html("<img src='images/check.png'></img>");
						//alert("OK");
					};
				});
			
			 }else{
			 	$("#nameexist").html("<font color='red'>*</font>");
				alert("name can't be null");
			 };
	});
	
	
	$("#fournituresbar").click(function(){
		$("#attachedFournitures").toggle();

	});
	$(".fournitureitem").click(function(){
		var f = $(this).next("input").val();
		$("#"+f).toggle();

	});

	
	$(".delbtn, .userdelbtn, .groupdelbtn,.teamdelbtn, .delprodbtn").hover(
		function(){
			$(this).attr("src","images/webdocker_over_64.png");
		},
		function(){
			$(this).attr("src","images/webdocker_64.png");
		});
	
	
	
	$(".addbtn").hover(
		function(){
			$(this).attr("src","images/webdocker_over_66.png");
		},
		function(){
			$(this).attr("src","images/webdocker_66.png");
		});
	
	$(".merchandisingList").hover(function(){
			$(".merchandising").attr("src","images/webdocker_over_35.png");
			$(".merchandisingList").children("ul").show();
		},
		function(){
			$(".merchandising").attr("src","images/webdocker_35.png");
			
			$(".merchandisingList").children("ul").hide();
			
			
		}
	);
	$(".addnewlist").colorbox({width:"250px",inline:"true",opacity:"0.4",href:"#newlist"});
	$(".addexistlist").colorbox({width:"250px",inline:"true",opacity:"0.4",href:"#existlist"});
	$(".mailto").colorbox({width:"250px",height:"250px",inline:"true",opacity:"0.4",href:"#selectmailitem"});
	$(".addlist").click(function(){
		
		var listname = $("#newlistname").val();
		if ($.trim(listname) == '') {
			alert("name can not be null");
		}else {
			$.ajax({
			type:"POST",
			url:"ajax/getSearchProds.php",
			async:false,
			success:function(data){			
				$("#totalprodsid").val(data);
			$("#form1").attr("target", "_self");
			$("#form1").attr("action", "merchandiseList.php?list=" + listname + "&&random=" + Math.random());
			$("#form1").submit();
			$.fn.colorbox.close();
			}
			});
		}
	});
	$(".addtolist").click(function(){
		$.ajax({
			type:"POST",
			url:"ajax/getSearchProds.php",
			async:false,
			success:function(data){			
				$("#totalprodsid").val(data);
		$("#newlistname").val('');
		var tolistname = $("#existlistname").val();		
		$("#form1").attr("target","_self");
		$("#form1").attr("action","merchandiseList.php?tolist="+tolistname+"&&random="+Math.random());
		$("#form1").submit();
		$.fn.colorbox.close();
		}});
	});
	$(".addlist2").click(function(){
		
		var listname2 = $("#newlistname2").val();
		if($.trim(listname2)==''){
			alert("name can not be null");
		}else{
			$.ajax({
			type:"POST",
			url:"ajax/getSearchProds.php",
			async:false,
			success:function(data){			
				$("#totalprodsid").val(data);
			$("#form1").attr("target","_self");
			$("#form1").attr("action","merchandiseList.php?list="+listname2+"&&random="+Math.random());
			$("#form1").submit();
			$.fn.colorbox.close();
			}});
		}
		
	});
/*	
	$("#lginbutton").click(function(){
		var e ='';
		window.external.Application.InitializeVBA();
		e = window.external.Application.GMSManager.RunMacro( "CDFWEBDOCK", "Macros.CDF");
		if(e='CDF'){
			$("#form2").submit();
		}else{
			alert("user webdocker in C-DESIGN Fashion or standlone webdocker tools please;");
			window.opener=null;
			window.open('','_self');
			window.close();

		}
	});
	
*/	
	$("#checkall").click(function(){
		if(this.checked){
			$("input[name='prod[]']").each(function(){
				this.checked=true;
				var pid = $(this).val();
				var c = true;
		
				$.post("ajax/selectProd.php",{"pid":pid,"c":c},function(data){
					//alert(data);
				});
			});
		}else{
			$("input[name='prod[]']").each(function(){
				this.checked=false;
				var pid = $(this).val();
				var c = false;
		
				$.post("ajax/selectProd.php",{"pid":pid,"c":c},function(data){
					//alert(data);
				});
			});
		}
	});
	$("#checkallfields").click(function(){
		if(this.checked){
			$("input[name='listing[]'],.groupcheck").each(function(){this.checked=true;});
		}else{
			$("input[name='listing[]'],.groupcheck").each(function(){this.checked=false;});
		}
	});
	
	
	$(".groupcheck").click(function(event){
		if(this.checked){
			$(this).parent("span").next("ul").find("input[name='listing[]']").each(function(){this.checked=true;});
		}else{
			$(this).parent("span").next("ul").find("input[name='listing[]']").each(function(){this.checked=false;});
			$("#checkallfields").attr("checked",false);
		}
		event.stopPropagation();
	});
	
	
	$("#fieldtemplate").click(function(){
		$(this).hide();
		$("#templatenamediv").show();
	});
	$("#savefieldtemplate").click(function(){
		var checkedfields = new Array();
		var tname = $("#fieldtemplatename").val();
		
		if($.trim(tname)==''){
			alert("type a name, please");
		}else{
			$("input[name='listing[]']:checked").each(function(){
				checkedfields.push($(this).attr("id"));
			});
			var dataarray = {"tname":tname,"checkedfields":checkedfields};
			
			$.post("ajax/saveSearchFieldTemplate.php",dataarray,function(data){
				$("#templatebutton").html(data);
				
				$("#fieldtemplate").show();
				$("#templatenamediv").hide();
			});
		}
	});
	
/*	
	var dates = $('#from, #to').datepicker({
										   defaultDate:"+1w",
										   onSelect: function(selecteDate){
											   var option = this.id =="from"?"minDate":"maxDate";
											   var instance = $(this).data("datepicker");
											   var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selecteDate, instance.settings);
											   dates.not(this).datepicker("option",option,date)
											   }
										   });
	*/
	
	for(i=0;i<groupnum;i++){
		var group = $("#groupmain ul").eq(i).attr("id");
		checkCookie(group);
	}
	
	$(".groupTitle > span").click(function(){
										
		var ulNode = $(this).next("ul");
		//alert(ulNode.attr("id"));
		//ulNode.slideToggle("fast");
		var ulNodeId = ulNode.attr("id");
		changeState(ulNode);
		changeIcon($(this));
		setCookie(ulNodeId,ulNode.css("display"),365);
		//alert(document.cookie);
		//alert(ulNode.css("display"));
	});
	$(".searchgroupTitle > span").click(function(){
		
		var ulNode = $(this).next("ul");
		//alert(ulNode.attr("id"));
		//ulNode.slideToggle("fast");
		var ulNodeId = ulNode.attr("id");
		changeState(ulNode);
		setCookie(ulNodeId,ulNode.css("display"),365);
		//alert(document.cookie);
		//alert(ulNode.css("display"));
	});
	$("#level").change(function(){
		var level = $("#level").val();
		if(level == "R"){
			$("input[name='authorizedgroup[]']").each(function(){this.checked=true;});
			$("input[name='editablegroup[]']").each(function(){this.checked=true;});
			$("#fieldgrouplist").css("display","block");
		}else{
			$("#fieldgrouplist").css("display","none");
			$("input[name='authorizedgroup[]']").each(function(){this.checked=false;});	
			$("input[name='editablegroup[]']").each(function(){this.checked=false;});	
			
		}
	});
	
/*	
	var utilityHandle = {
		setFocus:function(objFocusEven,values){
			//objFocusEven.focus();
			if($.browser.msie){
				var txt = objFocusEven[0].createTextRange();
				txt.moveStart('character',values);
				txt.collapse(true);
				txt.select();
				}}}
	
*/
	function setEndFocus(){
		var obj=event.srcElement;
		var txt = obj.createTextRange();
		txt.moveStart('character',obj.value.length+2);
		txt.collapse(true);
		txt.select();
	}
	
	$(".commentarea").focus(function(){
		var setFocusText = $(this);
		var date = new Date();
		var today = (date.getDate())+"/"+(date.getMonth()+1)+"/"+date.getFullYear();
		if(setFocusText.val().indexOf(today)>=0){
			setEndFocus();
		}else{
			$(this).html(setFocusText.val()+"<br/>---------<br/><font color='red'><strong>"+today+":</strong></font><br/><br/>"+"  ");
			setEndFocus();
		}
	});
	
	
	
	
	$("#newrevision").click(function(){
		$('#revisionform').toggle();
		if($('#newrevision').val()=='new'){
			$('#newrevision').val('cancel');
		}else{
			$('#newrevision').val('new');
		};
		
	});
	
	$("#addrevisionattachment").click(function(){
		var attachment=$("#revisionattach").val();
		if(attachment!=''){
			var attachments = $("#attachments").val();
			attachments = attachments+";"+attachment;
			$("#attachments").val(attachments);
			$("#revisionattach").val("");
			
			var attachmentarray = attachments.split(";");
			attachmenthtml="";
			for(var i=0;i<attachmentarray.length;i++){
				if(attachmentarray[i]!=''){
					attachmenthtml=attachmenthtml+"<span onclick='launchDoc(\""+attachmentarray[i].replace(/\\/g,'\\\\')+"\")'>"+attachmentarray[i].substr(attachmentarray[i].lastIndexOf("\\")+1)+"</span><img src='images/webdocker_64.png' onclick='delattach();'/> ";
				}
			}
			$("#displayattachments").html(attachmenthtml);
			//alert($("#attachments").val());
			//alert($("#displayattachments").html());
			
		}else{
			alert("click the input box, select an attachment first.");
			
		}
		
		
	});
	$("#saverevision").click(function(){
		var name = $("#productname").val();
		var title = $("#revisiontitle").val();
		var note = $("#revisionnote").val();
		var attachments = $("#attachments").val();
		if (title=='') { 
			alert("add a title, please");
		} else {
			$.post("ajax/saveRevision.php",{na:name,t:title,n:note,a:attachments}, function(data){
				$("#revisionlist").html(data);
			});
			$("#revisiontitle").val("");
			$("#revisionnote").val("");
			$("#attachments").val("");
			$("#displayattachments").html("");
		};
		
	});
	
	
	$("#attachmentfiles").click(function(){
		var check = $("#attachmentfiles").attr("checked");
		if(check){
			$("#attachmentitems").show();
		}else{
			$("#attachmentitems").hide();
		}
		var $allitems = $(".attachmentitem");
		$allitems.each(function(){$(this).attr("checked",check)});
	});
	
	$("#revisioninfos").click(function(){
		var checkr = $("#revisioninfos").attr("checked");
		if(checkr){
			$("#revisionitems").show();
		}else{
			$("#revisionitems").hide();
		}
		var $allrevisionitems = $(".revisionitem");
		$allrevisionitems.each(function(){$(this).attr("checked",checkr)});
	});
	
	
	$("#prodinformation").click(function(){
		var checkr = $("#prodinformation").attr("checked");
		if(checkr){
			$("#groupinfo").show();
		}else{
			$("#groupinfo").hide();
		}
		var $allrevisionitems = $(".groups");
		$allrevisionitems.each(function(){$(this).attr("checked",checkr)});
	});
	
	
	$("#selectList,#selectPrice").change(function(){
		var lname = $("#selectList").val();
		var pprice = $("#selectPrice").val();
		
		$("#dellistname").val(lname);
		$("#selectlistname").val(lname);
		$("#selectpricetype").val(pprice);
		$.post("ajax/getListItems.php",{listname:lname,prodprice:pprice},function(data){
			$("#listitems").html(data);
			
			
			$(".prodNum").blur(function(){
				
				var curunit = $("#currunit").html();
				var a = parseInt($(this).val()==''?0:$(this).val());
				var b = parseInt($(this).parent("td").prev("td").html());
				var c = a*b;
				var total = 0;
				var totalquantity = 0;
				$(this).val(a);
				$(this).parent("td").next(".sum").html(c+curunit);
				$(".sum").each(function(){
					total+=parseInt($(this).html());
				});
				$(".prodNum").each(function(){
					totalquantity+=parseInt($(this).val());
				});
				$("#total").html(total+curunit);
				$("#totalquantity").html(totalquantity);
			});
			
			$(".delprodbtn").hover(
			function(){
				$(this).attr("src","images/webdocker_over_64.png");
			},
			function(){
				$(this).attr("src","images/webdocker_64.png");
			});
			

			
		$(".delprodbtn").click(function(){
			var lname = $("#selectList").val();
			var pname = $(this).prev(".delprod").val();
			var pprice = $("#selectPrice").val();
			$.post("ajax/getListItems.php",{listname:lname,productname:pname,prodprice:pprice},function(data){
			$("#listitems").html(data);
			
			location="merchandiseList.php?list="+lname+"&&price="+pprice;
  			
			});
		
		});	
		});
	});
	
	$(".fieldcheck").click(function(){
		var fieldname = $(this).prev("input").val();
		var opt = $(this).val();
		var stat = $(this).attr("checked");
		$(".fieldcheck").attr("disabled",true);
		$(".group").attr("disabled",true);
		
		$.ajax({
			type:"POST",
			url:"ajax/changeFieldStat.php",
			async:false,
			data:"name="+fieldname+"&opt="+opt+"&stat="+stat,
			success:function(data){
				$(".fieldcheck").attr("disabled",false);
				$(".group").attr("disabled",false);
							
			}
		});
		
	});

 	$(".listfields").change(function(){
		var value = $(this).val();
		var field = $(this).attr("id").substr(6);
		var relation = $(this).next("input").val();
		
		var relationarray = relation.split('--');
		var deep = 9999;
		for(var i=0;i<relationarray.length;i++){
			if(relationarray[i]==field){
				deep = i;
			}
			if(i>deep){
				$("#select"+relationarray[i]).html('');
			}
		}
		
		
		var data = {"field":relationarray[deep+1],"value":value};
		$.ajax({
			type:"POST",
			url:"ajax/getSubList.php",
			async:true,
			data:data,
			success:function(data){
					$("#select"+relationarray[deep+1]).html(data);
					$("#select"+relationarray[deep+1]).css("width","174px");		
			}
		});
	});
	
 /*	
 	$(".readlistfields").click(function(){
 		var value = $(this).val();
 		var field = $(this).attr("id").substr(6);
		var relation = $(this).next("input").val();
		
		var relationarray = relation.split('--');
		var deep = 9999;
		for(var i=0;i<relationarray.length;i++){
			if(relationarray[i]==field){
				deep = i;
			}
		}
		if(deep!=0){
			var parentvalue = $("#select"+relationarray[deep-1]).val();
			if(parentvalue==''){
				$("#select"+relationarray[deep]).html('');
			}else{
				var data = {"field":relationarray[deep],"value":parentvalue};
				$.ajax({
					type:"POST",
					url:"ajax/getSubList.php",
					async:false,
					data:data,
					success:function(data){
							$("#select"+relationarray[deep]).html(data);
							$("#select"+relationarray[deep]).css("width","174px");		
					}
				});
			}
		}
 	});
 	
 */	
 	
	$(".group").change(function(){
		var fieldname = $(this).prev("input").val();
		var stat = $(this).val();
		$(".fieldcheck").attr("disabled",true);
		$(".group").attr("disabled",true);
		var dataArray = {"name":fieldname,"opt":"groupe","stat":stat};

		
		$.ajax({
			type:"POST",
			url:"ajax/changeFieldStat.php",
			async:false,
			data:dataArray,
			success:function(data){
				$(".fieldcheck").attr("disabled",false);
				$(".group").attr("disabled",false);	
				//alert(data);		
			}
		}); 
	});
	
	
//用户 组 群 添加框
	$("#newuser").click(function(){
		if($(this).html()=='Nouveau'){
			$(this).html('Annuler');
		}else{
			$(this).html('Nouveau');
		}
		$("#adduserform").toggle();
		$(".adduserform").each(function(){
			$(this).val('');
		});
	});
	$("#newgroup").click(function(){
		if($(this).html()=='Nouveau'){
			$(this).html('Annuler');
		}else{
			$(this).html('Nouveau');
		}
		$("#addgroupform").toggle();
		$(".addgroupform").each(function(){
			$(this).val('');
		});
	});
	$("#newteam").click(function(){
		if($(this).html()=='Nouveau'){
			$(this).html('Annuler');
		}else{
			$(this).html('Nouveau');
		}
		$("#addteamform").toggle();
		$(".addteamform").each(function(){
			$(this).val('');
		});
	});
	$("#submituser").click(function(){
		var login = $.trim($("#txtlog").val());
		var pass = $.trim($("#txtMdp").val());
		var lname = $.trim($("#txtName").val());
		var fname = $.trim($("#txtFirst").val());
		var address = $.trim($("#address").val());
		var email = $.trim($("#email").val());
		var tel = $.trim($("#telephone").val());
		var job = $.trim($("#job").val());
		var team = $.trim($("#team").val());
		var group = $.trim($("#group").val());
		var userArray = {"login":login,"pass":pass,"lname":lname,"fname":fname,"address":address,"email":email,"tel":tel,"job":job,"team":team,"group":group};
		$("#txtlog").css("border","");
		$("#email").css("border","");
		$(".adduserform").attr("disabled",true);
		
		var flag = 0;
		
		if(login!=''){
			var reglog = /^[a-zA-Z0-9_]{3,16}$/;
			var matchlog = reglog.test(login);
			if(matchlog){
				$.post("ajax/checkUsername.php",{newusername:login},function(data){
					if (data*1>=1) {
						alert("Un utilisateur porte deja ce nom");
						flag++;
					}else {
						if(email!=''){
							var reg = /^([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/gi;
							var match = reg.test(email);
							if(match){
								
							}else{
								$("#email").css("border","1px solid red");
								alert("the email address is not valid");
								flag++;
							}
						}
						
					};
				});
			}else{
				alert("Login must be letter, num, _, more than 3 characters and less than 16 characters");
				$("#txtlog").css("border","1px solid red");
				flag++;
			}
			
		}else{
			alert("Login cannot be null");
			$("#txtlog").css("border","1px solid red");
			flag++;
		}
		if(flag==0){
			$.ajax({
				type:"POST",
				url:"ajax/saveUser.php",
				async:false,
				data:userArray,
				success:function(data){
					$(".adduserform").attr("disabled",false);
					$(".adduserform").each(function(){
						$(this).val('');
					});	
					if(data=='0'){
						alert("Add failed,please contact the administrator.")
					}else{
					$("#usersList").html(data);	
					}
				}
			}); 
		}else{
			$(".adduserform").attr("disabled",false);
		}

	});
	
	$("#submitgroup").click(function(){
		var groupname = $.trim($("#newGroupName").val());
		var level = $("#level").val();
		var see =new Array();
		var edit =new Array();
		$("input[name='authorizedgroup[]']").each(function(){
			if (this.checked) {
				see.push($(this).val());
			}
		});
		$("input[name='editablegroup[]']").each(function(){
			if (this.checked) {
				edit.push($(this).val());
			}
		});

		if (groupname!='') { 
			var reggroup = /^[a-zA-Z][\w\s]+$/;
			var matchgroup = reggroup.test(groupname);
			if(matchgroup){
				$.post("ajax/checkUserGroupName.php",{newgroupname:groupname},function(data){
					if (data*1>=1) {
						alert("Une groupe porte deja ce nom");
					}else {
						var seeString = see.join(",");
						var editString = edit.join(",");
						var userGroupArray = {"gname":groupname,"level":level,"see":seeString,"edit":editString};
						
						$.ajax({
							type:"POST",
							url:"ajax/saveUserGroup.php",
							async:false,
							data:userGroupArray,
							success:function(data){
								$("#newGroupName").val("");
								$("#groupsList").html(data);
							}
						}); 
						
						$.ajax({
							type:"POST",
							url:"ajax/getUserGroup.php",
							async:false,
							success:function(data){
								$("#group").html(data);
							}
						}); 
					};
				});
			}else{
				alert("Group name can only start with letter,can only contain letter, num,space and underscore");
				$("#newGroupName").css("border","1px solid red");
			}
		}else{
		 	alert("Group name cannot be null");
			$("#newGroupName").css("border","1px solid red");
		};

	});
	
	
	$("#submitteam").click(function(){
		var teamname = $.trim($("#newTeamName").val());
		if (teamname!='') { 
			var regteam = /^[a-zA-Z][\w\s]+$/;
			var matchteam = regteam.test(teamname);
			if(matchteam){
				$.post("ajax/checkUserTeamName.php",{newteamname:teamname},function(data){
					if (data*1>=1) {
						alert("Un team porte deja ce nom");
					}else {
						var userTeamArray = {"tname":teamname};
						
						$.ajax({
							type:"POST",
							url:"ajax/saveUserTeam.php",
							async:false,
							data:userTeamArray,
							success:function(data){
								$("#newTeamName").val("");
								$("#teamsList").html(data);
							}
						}); 
						
						$.ajax({
							type:"POST",
							url:"ajax/getUserTeam.php",
							async:false,
							success:function(data){
								$("#team").html(data);
							}
						}); 
					};
				});
			}else{
				alert("Team name can only start with letter,can only contain letter, num,space and underscore");
				$("#newTeamName").css("border","1px solid red");
			}
		}else{
		 	alert("Team name cannot be null");
			$("#newTeamName").css("border","1px solid red");
		};
	});
//field排序
$(".fieldorder").change(function(){
	var fieldid=$(this).prev("input").val();
	var fieldorder = $(this).val();
	$.post("ajax/changeFieldOrder.php",{id:fieldid,order:fieldorder},function(data){
		//alert(data);
	});
});
	
	
	
//用户组群 管理
	$("#users").click(function(){
		$("#users").attr("disabled",true);
		$("#teams").attr("disabled",false);
		$("#groups").attr("disabled",false);
		
		$("#usersDiv").show();
		$("#groupsDiv").hide();
		$("#teamsDiv").hide();
		
	});
	$("#groups").click(function(){
		$("#users").attr("disabled",false);
		$("#teams").attr("disabled",false);
		$("#groups").attr("disabled",true);
		
		$("#usersDiv").hide();
		$("#groupsDiv").show();
		$("#teamsDiv").hide();
	});
	$("#teams").click(function(){
		$("#users").attr("disabled",false);
		$("#teams").attr("disabled",true);
		$("#groups").attr("disabled",false);
		
		$("#usersDiv").hide();
		$("#groupsDiv").hide();
		$("#teamsDiv").show();
	});
//删除产品
	$(".delprodbtn").click(function(){
		var lname = $("#selectList").val();
		var ptype = $("#selectPrice").val();
		var pname = $(this).prev(".delprod").val();
		var curunit = $("#currunit").html();
		$.post("ajax/getListItems.php",{listname:lname,productname:pname},function(data){
			$("#listitems").html(data);
			
			
			$(".prodNum").blur(function(){
				var a = parseInt($(this).val()==''?0:$(this).val());
				var b = parseInt($(this).parent("td").prev("td").html());
				var c = a*b;
				var total = 0;
				var totalquantity = 0;
				$(this).val(a);
				$(this).parent("td").next(".sum").html(c+curunit);
				$(".sum").each(function(){
					total+=parseInt($(this).html());
				});
				$(".prodNum").each(function(){
					totalquantity+=parseInt($(this).val());
				});
				$("#total").html(total+curunit);
				$("#totalquantity").html(totalquantity);
			});
			
			$(".delprodbtn").hover(
			function(){
				$(this).attr("src","images/webdocker_over_64.png");
			},
			function(){
				$(this).attr("src","images/webdocker_64.png");
			});	
			location="merchandiseList.php?list="+lname+"&&price="+ptype;	
		});
		
	});
	
	$(".deleteFour").click(function(){
		var conf = confirm("Voulez-vous supprimer ce fourniture?");
		if (conf == true) {
			var fourname = $(this).attr("id");
			var fourid = $(this).attr("alt");
			var prodname = $("#pid").val();
			var divname = fourname + "_div";
			var fournum = $("#fournitureNum").html();
			var fournumnow = parseInt(fournum) - 1;
			$("#fournitureNum").html(fournumnow);
			$("#" + divname).hide();
			$.post("ajax/delFournitures.php", {
				fname: fourid,
				pname: prodname
			}, function(data){
			 //alert(data);
			})
		}
	});
	
	
	$(".prodNum").blur(function(){
				var a = parseInt($(this).val()==''?0:$(this).val());
				var b = parseInt($(this).parent("td").prev("td").html());
				var c = a*b;
				var total = 0;
				var totalquantity = 0;
				$(this).val(a);
				$(this).parent("td").next(".sum").html(c+curunit);
				$(".sum").each(function(){
					total+=parseInt($(this).html());
				});
				$(".prodNum").each(function(){
					totalquantity+=parseInt($(this).val());
				});
				$("#total").html(total+curunit);
				$("#totalquantity").html(totalquantity);
			});
	
	
	$(".order").change(function(){
		var groupid = $(this).attr("id");
		var grouporder = $(this).val();
		$.post("ajax/changeListOrder.php",{gid:groupid,gorder:grouporder},function(data){
			//alert(data);
		});
	});
/*	
	$.post("changeGroup.php",{grp:"default"},function(data){
																					
													$("#addProdTable").html('');
													$("#addProdTable").html(data);
													$(".datepicker").datepicker();
													function setEndFocus(){
														var obj=event.srcElement;
														var txt = obj.createTextRange();
														txt.moveStart('character',obj.value.length+2);
														txt.collapse(true);
														txt.select();}
																						
														$(".commentarea").focus(function(){
															var setFocusText = $(this);
															var date = new Date();
															var today = (date.getDate()+1)+"/"+(date.getMonth()+1)+"/"+date.getFullYear();
															if(setFocusText.val().indexOf(today)>=0){
																setEndFocus();}
															else{
																$(this).html(setFocusText.val()+"<br/>---------<br/><font color='red'><strong>"+today+":</strong></font><br/><br/>"+"  ");
																setEndFocus();}
																												
															});
	});
									
	*/
	
	$("#selectGroupe").change(function(){
		var group = $("#selectGroupe").val();
		$.post("ajax/changeGroup.php",{grp:group},function(data){
			$("#addProdTable").html('');
			$("#addProdTable").html(data);
			$(".datepicker").datepicker();
			function setEndFocus(){
				var obj=event.srcElement;
				var txt = obj.createTextRange();
				txt.moveStart('character',obj.value.length+2);
				txt.collapse(true);
				txt.select();}
				$(".commentarea").focus(function(){
					var setFocusText = $(this);
					var date = new Date();
					var today = (date.getDate()+1)+"/"+(date.getMonth()+1)+"/"+date.getFullYear();
					if(setFocusText.val().indexOf(today)>=0){
						setEndFocus();
					}else{
						$(this).html(setFocusText.val()+"<br/>---------<br/><font color='red'><strong>"+today+":</strong></font><br/><br/>"+"  ");
						setEndFocus();
					}
				});
			});
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
		
		
		
		
		

});



function makeRequest(dataSource)
{
	$.get(dataSource,function(data){
		var tableau=data.split("&&&&&");	
		for (var i=0; i<tableau.length; i++) {
			if (tableau[i].replace('<br>','')!=''){
				document.getElementById('selectTheme').options[document.getElementById('selectTheme').length] = new Option(tableau[i].replace('<br>',''),tableau[i].replace('<br>',''));
			}
		}
	},"text").responseText;

}
 
 
/*    function makeRequest(url) {

        var httpRequest = false;

        if (window.XMLHttpRequest) { // Mozilla, Safari,...
            httpRequest = new XMLHttpRequest();
            if (httpRequest.overrideMimeType) {
                httpRequest.overrideMimeType('text/xml');
                // Voir la note ci-dessous ?propos de cette ligne
            }
        }
        else if (window.ActiveXObject) { // IE
            try {
                httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
            }
            catch (e) {
                try {
                    httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
					
                }
                catch (e) {}
            }
        }

        if (!httpRequest) {
            alert('Abandon :( Impossible de cr�er une instance XMLHTTP');
            return false;
        }
        httpRequest.onreadystatechange = function() { alertContents(httpRequest); };
        httpRequest.open('GET', url, true);
        httpRequest.send(null);

    }

    function alertContents(httpRequest) {

        if (httpRequest.readyState == 4) {
            if (httpRequest.status == 200) {
			var xmldoc = httpRequest.responseXML;
			
alert (xmlDoc.getElementsByTagName('container')[0].childNodes.length )

	document.getElementById('selectTheme').options[document.getElementById('selectTheme').length] = new Option('x','x');
			
document.getElementById('selectTheme').options[document.getElementById('selectTheme').length] = new Option(xmldoc.getElementsByTagName('info').item(i).firstChild.data, xmldoc.getElementsByTagName('info').item(i).firstChild.data);
			
			
			

             
            } else {
			
                alert('Un probl�me est survenu avec la requ�te.');
            }
        }

    }*/


function productconfirmation(){
if(confirm("Voulez-vous supprimer ce produit ?"))
{
	if(confirm("Voulez-vous supprimer cdr fichier aussi ?")){
		var file = $("#fileToLoad").html();
		$.post("ajax/delCdrFile.php",{url:file},function(){});
	}
return true;
}
else {
return false;
}
} 

function confirmationChange(varStr){
if(confirm(varStr))
{
return true;
}
else {
return false;
}
} 

function valueconfirmation(){
	if(confirm("Voulez-vous supprimer cette valeur ?"))
	{
		return true;
	}
	else {
		return false;
	}
} 

function error () { return true; }






function changeIcon(mainNode){
	if(mainNode){
		if(mainNode.next("ul").css("display").indexOf("block")>=0){
			mainNode.css("background-image","url(images/webdocker_over_71.png)");
		}else{
			mainNode.css("background-image","url(images/webdocker_71.png)");
			}
	}
}

function changeState(mainNode){
	if(mainNode){
		if(mainNode.css("display").indexOf("block")>=0){
			mainNode.css("display","none");
		}else{
			mainNode.css("display","block");
			}
	}
}




function setCookie(c_name,value,expiredays){
 	var exdate = new Date();
	exdate.setDate(exdate.getDate()+expiredays);
	document.cookie=c_name+"="+escape(value)+((expiredays==null)?"":";expires="+exdate.toGMTString());
}

function getCookie(c_name){
	if(document.cookie.length>0){
		c_start=document.cookie.indexOf(c_name+"=");
		if(c_start!=-1){
			c_start=c_start+c_name.length+1;
			c_end = document.cookie.indexOf(";",c_start);
			if(c_end==-1){
				c_end=document.cookie.length;
			}
		return unescape(document.cookie.substring(c_start,c_end));
		}
	}
	return "";
}

function checkCookie(c_name){
 	param = getCookie(c_name);
	if(param!=null && param!=""){
		$("#"+c_name).css("display",param);	
		if($("#"+c_name).css("display").indexOf("block")>=0){
			$("#"+c_name).prev().css("background-image","url(images/webdocker_over_71.png)");
		}else{
			$("#"+c_name).prev().css("background-image","url(images/webdocker_71.png)");
			}
	}
}


function getAllProducts(){
		var table = $("table#accessarySearchresult")[0];
		var c = table.config;
		var allrows = c.rowsCopy;
		var hidtable1 = $("table#hiddentable1")[0];
		var hidtable2 = $("table#hiddentable2")[0];
		var tableBody1 = $(hidtable1.tBodies[0]);
		var tableBody2 = $(hidtable2.tBodies[0]);
		var m = c.page*c.size;
		var n = (c.page+1)*c.size-1;
		 	// clear the table body
		
		 	$.tablesorter.clearTableBody(hidtable1);
		 	$.tablesorter.clearTableBody(hidtable2);
			
		
		 	for (var i = 0; i < allrows.length; i++) {
		
		 	//tableBody.append(rows[i]);
				if(i<m){
		 		var row = allrows[i];
		 		var len = row.length;
				
		 		for (var j = 0; j < len; j++) {
		
		 			tableBody1[0].appendChild(row[j]);
		
		 		}
				}else if(i>n){
					var row = allrows[i];
		 			var len = row.length;
				
		 			for (var j = 0; j < len; j++) {
		
		 				tableBody2[0].appendChild(row[j]);
		
		 			}
				}
		 	}	
}

function getMultiProducts(){
	var table = $("table#multisearchresult")[0];
		var c = table.config;
		var allrows = c.rowsCopy;
		var hidtable1 = $("table#hiddentable1")[0];
		var hidtable2 = $("table#hiddentable2")[0];
		var tableBody1 = $(hidtable1.tBodies[0]);
		var tableBody2 = $(hidtable2.tBodies[0]);
		var m = c.page*c.size;
		var n = (c.page+1)*c.size-1;
		 	// clear the table body
		
		 	$.tablesorter.clearTableBody(hidtable1);
		 	$.tablesorter.clearTableBody(hidtable2);
			
		
		 	for (var i = 0; i < allrows.length; i++) {
		
		 	//tableBody.append(rows[i]);
				if(i<m){
		 		var row = allrows[i];
		 		var len = row.length;
				
		 		for (var j = 0; j < len; j++) {
		
		 			tableBody1[0].appendChild(row[j]);
		
		 		}
				}else if(i>n){
					var row = allrows[i];
		 			var len = row.length;
				
		 			for (var j = 0; j < len; j++) {
		
		 				tableBody2[0].appendChild(row[j]);
		
		 			}
				}
		 	}

}
function checkgroupname(){
	var gname = $("#newGroupName").val();

			if ($.trim(gname)!='') {
				var reggroup = /^[a-zA-Z][\w\s]+$/;
				var matchgroup = reggroup.test(gname);
				if(matchgroup){
					$.post("ajax/checkGroupName.php",{newgroupname:gname},function(data){
						if (data*1>=1) {
							alert("Un groupe porte deja ce nom");
							
						}else {
							$("#addnewgroup").val(Math.random());
							$("#addgroupform").submit();
						};
					});
				}else{
					alert("field name can only start with letter,can only contain letter, num, space and _");
				}
			 }else{
			 	alert("name can't be null");
			
			 };
}

function checkfieldname(){
	var fname = $("#txtAddCateg").val();
	
			if ($.trim(fname)!='') {
				var regfield = /^[a-zA-Z][a-zA-Z0-9\s]+$/;
				var matchfield = regfield.test(fname);
				if(matchfield){
					$.post("ajax/checkFieldName.php",{newfieldname:fname},function(data){
					if (data*1>=1) {
						alert("Un field porte deja ce nom");
						
					}else {
						$("#fieldsessionid").val(Math.random());
						$("#form1").submit();
					};
				});
				}else{
					alert("field name can only start with letter,can only contain letter, num and space");
				}
				
				
			 }else{
			 	alert("name can't be null");
			
			 };
}
function checkfourfieldname(){
	var fname = $("#txtAddCateg").val();

			if ($.trim(fname)!='') {
				var regfield = /^[a-zA-Z][a-zA-Z0-9\s]+$/;
				var matchfield = regfield.test(fname);
				if(matchfield){
					$.post("ajax/checkFourFieldName.php",{newfieldname:fname},function(data){
					if (data*1>=1) {
						alert("Un field porte deja ce nom");
						
					}else {
						$("#fourfieldsessionid").val(Math.random());
						$("#form1").submit();
					};
				});
				}else{
					alert("field name can only start with letter,can only contain letter, num and space");
				} 
				
			
			 }else{
			 	alert("name can't be null");
			
			 };
}

//删除 用户
function deluser(user){
	var r = confirm("are you sure to delete this user?");
	if (r == true) {
		user.parent("td").parent("tr").remove();
		var userid = user.prev("input").val();
		$.post("ajax/delUser.php", {id: userid}, function(){
			
		});
	}
}
//删除 组
function delgroup(group){
	var r = confirm("are you sure to delete this group?");
	if (r == true) {
		group.parent("td").parent("tr").remove();
		var groupid = group.prev("input").val();
		$.post("ajax/delGroup.php", {id: groupid}, function(){
			
		});
	}
}
//删除 群
function delteam(team){
	var r = confirm("are you sure to delete this team?");
	if (r == true) {
		team.parent("td").parent("tr").remove();
		var teamid = team.prev("input").val();
		alert(teamid);
		$.post("ajax/delTeam.php", {id: teamid}, function(){
			
		});
	}
}

//汇率
function getCurrencyRate(currency){
	var curr = currency.val();

	$.post("ajax/getCurrencyRate.php",{c:curr},function(data){
		$("#currencyrate").val(data);
	});

}
