// JavaScript Document

$(document).ready(function(){
	$(".fieldcheck").click(function(){
		var fieldid = $(this).next("input").val();
		var opt = $(this).val();
		var stat = $(this).attr("checked");
		$(".fieldcheck").attr("disabled",true);
		$(".group").attr("disabled",true);
		
		var dataarray ={fid:fieldid,opt:opt,stat:stat};
		
		$.ajax({
			type:"POST",
			url:"../ajax/changeFieldStat.php",
			async:false,
			data:dataarray,
			success:function(data){
				$(".fieldcheck").attr("disabled",false);
				$(".group").attr("disabled",false);
							
			}
		});
		
	});
	
	$(".groupcheck").click(function(){
		var groupid = $(this).prev("input").val();
		var opt = $(this).val();
		var stat = $(this).attr("checked");
		
		var dataarray ={gid:groupid,opt:opt,stat:stat};
		
		$.ajax({
			type:"POST",
			url:"../ajax/changeGroupStat.php",
			async:false,
			data:dataarray,
			success:function(data){

		
			}
		});
		
	});
	
	
	
	
	
	$(".delbtn, .userdelbtn, .groupdelbtn,.teamdelbtn, .delprodbtn").hover(
		function(){
			$(this).attr("src","../images/webdocker_over_64.png");
		},
		function(){
			$(this).attr("src","../images/webdocker_64.png");
		});
	
	$(".addbtn").hover(
		function(){
			$(this).attr("src","../images/webdocker_over_66.png");
		},
		function(){
			$(this).attr("src","../images/webdocker_66.png");
		});
		
	$(".order").change(function(){
		var groupid = $(this).attr("id");
		var grouporder = $(this).val();
		$.post("../ajax/changeListOrder.php",{gid:groupid,gorder:grouporder},function(data){
			//alert(data);
		});
	});
	
	$(".listfields").change(function(){
		var value = $(this).val();
		var field = $(this).attr("id").substr(6);
		var data = {"field":field,"value":value};
		var sub = $(this).next("input").attr("name");

		$.ajax({
			type:"POST",
			url:"../ajax/getSubList.php",
			async:true,
			data:data,
			success:function(data){
					$("#"+sub).html(data);
					$("#"+sub).css("width","174px");		
			}
		});
	});
	
	$(".group").change(function(){
		var fieldid = $(this).next("input").val();
		var stat = $(this).val();
		$(this).prev("input").val(stat);
		$(".fieldcheck").attr("disabled",true);
		$(".group").attr("disabled",true);
		var dataArray = {"fid":fieldid,"opt":"groupe","stat":stat};

		
		$.ajax({
			type:"POST",
			url:"../ajax/changeFieldStat.php",
			async:false,
			data:dataArray,
			success:function(data){
				$(".fieldcheck").attr("disabled",false);
				$(".group").attr("disabled",false);	
				//alert(data);		
			}
		}); 
	});
	
	

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
		var pass1=MD5(MD5(pass));
		var lname = $.trim($("#txtName").val());
		var fname = $.trim($("#txtFirst").val());
		var address = $.trim($("#address").val());
		var email = $.trim($("#email").val());
		var tel = $.trim($("#telephone").val());
		var job = $.trim($("#job").val());
		var team = $.trim($("#team").val());
		var group = $.trim($("#group").val());
		var userArray = {"login":login,"pass":pass1,"lname":lname,"fname":fname,"address":address,"email":email,"tel":tel,"job":job,"team":team,"group":group};
		$("#txtlog").css("border","");
		$("#email").css("border","");
		$(".adduserform").attr("disabled",true);
		
		
		
		if(login!=''&&pass!=''){
			var reglog = /^[a-zA-Z0-9_]{3,16}$/;
			var matchlog = reglog.test(login);
			if(matchlog){
				$.post("../ajax/checkUsername.php",{newusername:login},function(data){
					var flag = 0;
					if (data*1>=1) {
						//alert(data);
						alert("Un utilisateur porte deja ce nom");
						flag++;
						//alert("flag="+flag);
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
					
					if(flag==0){
						$.ajax({
							type:"POST",
							url:"../ajax/saveUser.php",
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
			}else{
				alert("Login must be letter, num, _, more than 3 characters and less than 16 characters");
				$("#txtlog").css("border","1px solid red");
			
			}
			
		
		}else{
			alert("Login cannot be null");
			$("#txtlog").css("border","1px solid red");

		}
		

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
				$.post("../ajax/checkUserGroupName.php",{newgroupname:groupname},function(data){
					if (data*1>=1) {
						alert("Une groupe porte deja ce nom");
					}else {
						var seeString = see.join(",");
						var editString = edit.join(",");
						var userGroupArray = {"gname":groupname,"level":level,"see":seeString,"edit":editString};
						
						$.ajax({
							type:"POST",
							url:"../ajax/saveUserGroup.php",
							async:false,
							data:userGroupArray,
							success:function(data){
								$("#newGroupName").val("");
								$("#groupsList").html(data);
							}
						}); 
						
						$.ajax({
							type:"POST",
							url:"../ajax/getUserGroup.php",
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
				$.post("../ajax/checkUserTeamName.php",{newteamname:teamname},function(data){
					if (data*1>=1) {
						alert("Un team porte deja ce nom");
					}else {
						var userTeamArray = {"tname":teamname};
						
						$.ajax({
							type:"POST",
							url:"../ajax/saveUserTeam.php",
							async:false,
							data:userTeamArray,
							success:function(data){
								$("#newTeamName").val("");
								$("#teamsList").html(data);
								$(".teammanagement").colorbox({iframe:true,innerWidth:250, innerHeight:400,title:true});
							}
						}); 
						
						$.ajax({
							type:"POST",
							url:"../ajax/getUserTeam.php",
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

$(".fieldorder").change(function(){
	var fieldid=$(this).next("input").val();
	var fieldorder = $(this).val();
	$(this).prev("input").val(fieldorder);
	$.post("../ajax/changeFieldOrder.php",{id:fieldid,order:fieldorder},function(data){
		//alert(data);
	});
});
	
	
	

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
	
	
	
	$("#menu ul li").click(function(){
		var currentLi = $(this);
		$("#menu ul li").each(function(){
			$(this).css("font-weight","normal");
		});
		
		currentLi.css("font-weight","bold");
	});
	
	$("#groupby").change(function(){
		var groupfield = $("#groupby").val();
		$.post("../ajax/changeGroupby.php",{field:groupfield},function(data){
			
		});
	});	                                          
	
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
	
	
	$("#addcurrency").click(function(){
		var newcurrency = $("#newcurrency").val();
		var regcurrency = /^[a-zA-Z]{3}/;
		var matchfield = regcurrency.test(newcurrency);
		if(matchfield){
			$.post("../ajax/saveNewCurrency.php",{currency:newcurrency},function(data){
				$("#currencytable").append(data);
			});
		}else{
			alert('3 letters for the currency unit');
		}
	});
	



	
	
	
});


function checkfieldname(){
	var fname = $("#txtAddCateg").val();
	
			if ($.trim(fname)!='') {
				var regfield = /^[a-zA-Z][a-zA-Z0-9\s]+$/;
				var matchfield = regfield.test(fname);
				if(matchfield){
					$.post("../ajax/checkFieldName.php",{newfieldname:fname},function(data){
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
					$.post("../ajax/checkFourFieldName.php",{newfieldname:fname},function(data){
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

function valueconfirmation(){
	if(confirm("Voulez-vous supprimer cette valeur ?"))
	{
		return true;
	}
	else {
		return false;
	}
} 

function checkgroupname(){
	var gname = $("#newGroupName").val();

			if ($.trim(gname)!='') {
				var reggroup = /^[a-zA-Z][\w\s]+$/;
				var matchgroup = reggroup.test(gname);
				if(matchgroup){
					$.post("../ajax/checkGroupName.php",{newgroupname:gname},function(data){
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


function deluser(user){
	var r = confirm("are you sure to delete this user?");
	if (r == true) {
		user.parent("td").parent("tr").remove();
		var userid = user.prev("input").val();
		$.post("../ajax/delUser.php", {id: userid}, function(){
			
		});
	}
}

function delgroup(group){
	var r = confirm("are you sure to delete this group?");
	if (r == true) {
		group.parent("td").parent("tr").remove();
		var groupid = group.prev("input").val();
		$.post("../ajax/delGroup.php", {id: groupid}, function(){
			
		});
	}
}

function delteam(team){
	var r = confirm("are you sure to delete this team?");
	if (r == true) {
		team.parent("td").parent("tr").remove();
		var teamid = team.prev("input").val();
		//alert(teamid);
		$.post("../ajax/delTeam.php", {id: teamid}, function(){
			
		});
	}
}


function getCurrencyRate(currency){
	var curr = currency.val();

	$.post("../ajax/getCurrencyRate.php",{c:curr},function(data){
		$("#currencyrate").val(data);
	});

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
function changeIcon(mainNode){
	if(mainNode){
		if(mainNode.next("ul").css("display").indexOf("block")>=0){
			mainNode.css("background-image","url(images/webdocker_over_71.png)");
		}else{
			mainNode.css("background-image","url(images/webdocker_71.png)");
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
