<?php 
	session_start();
	error_reporting(0);
	$varSelectOption=0;
	require_once(dirname(__FILE__).'/connexion/connexion.php');
	
	
	//$_GET['sid']=1;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/webDocker.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/jquery.min.js" ></script>
<script type="text/javascript" src="js/jquery.ui.core.js" ></script>
<script type="text/javascript" src="js/jquery.ui.widget.js" ></script>
<script type="text/javascript" src="js/jquery.ui.datepicker.js" ></script>
<script type="text/javascript" src="js/jquery.ui.datepicker-fr.js" ></script>
<script type="text/javascript" src="js/jquery.colorbox.js" ></script>
<script type="text/javascript" src="js/ui.dropdownchecklist.js" ></script>
<script type="text/javascript" src="js/jquery.tablesorter.js" ></script>
<script type="text/javascript" src="js/jquery.tablesorter.pager.js" ></script>
<script type="text/javascript" src="js/common.js" ></script>
<link href="css/jquery-ui-1.8.2.custom.css" rel="stylesheet" type="text/css" />
<link href="css/ui.dropdownchecklist.css" rel="stylesheet" type="text/css" />
<link href="css/colorbox.css" rel="stylesheet" type="text/css" />
<link href="css/webDocker.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="doctitle" -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#replySMS").click(function(){
			var f=$("#fromId").val();
			var t=$("#sendtype").val();
			var v=$("#toId").val();		
			var c=$("#smscontent").val();
			
			var data = {"f":f,"t":t,"v":v,"c":c};
			$.post("ajax/saveSMS.php",data,function(data){
				if(parseInt(data)==1){
					window.location.href='SMSReceived.php';
				}else{
					alert(data);
				}
				
			});
		});

		$("#delsms").click(function(){
			var c = confirm("are you sure to delete this message?");
			if(c){
			var sid = $(this).next("input").val();

			$.post("ajax/delSMS.php",{sid:sid},function(data){
				if(parseInt(data)==1){
					window.location.href='SMSReceived.php';
				}else{
					alert("delete failed");

				}
			});
			}
		});
	});
</script>
<title>C-DESIGN Fashion</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>
	
<body>
<script type="text/javascript">
function adminWindow(){	
	var url = "http://"+window.location.hostname+":"+window.location.port+"/webdocker/adminWindow/administration.html";
	//var url = "http://localhost/webdocker/adminWindow/administration.html";		
	<?php if($_SESSION['CDF']=="Y"){?>
	window.external.Application.InitializeVBA();
   	window.external.Application.GMSManager.RunMacro( "CDFWEBDOCK", "Macros.NewWindow",url);	
	<?php }else{?>
		window.external.NewWindow(url);
	<?php }?>
}
	function loadFileName(openfile)
  {
  
  	var str=openfile;
	//for (i=0;i<52;i++){
	//str=str.replace(/\\\\/g,'\\');
	//}
	str=str.replace(/^\s+/g,'').replace(/\s+$/g,'') ;
	openfile=str;
  	if (str!=""){
    window.external.Application.InitializeVBA();
	window.external.Application.OpenDocument(openfile);
	}
	
  }
function sendmail(){
 	
 	var pname = $("#pid").val();
	var fullpath = $("#fileToLoad").html();
 	var $allatt = $("input[name='emailitems[]']");
	var $revatt = $("input[name='emailrevitems[]']");
	var mailbody = "";
	
	loadFileName(fullpath);
	
	if($("#prodinformation").attr("checked")){
		mailbody += "info|";	
	}
	$revatt.each(function(){
			if (this.checked) {
				mailbody += $(this).val();
				mailbody += "|";
			}
		});	
	
	var dataArray = {"name":pname,"mailbody":mailbody};
	$.ajax({
			type:"POST",
			url:"ajax/getProdInfo.php",
			async:false,
			data:dataArray,
			success:function(data){
				$("#prodinformation").val(data);
			
			}
		});
	
	
	if ($("#prodfilepdf").attr("checked")) {  
		$.ajax({
			type:"POST",
	  		url: "ajax/checkPDF.php",
	  		async: false,
			data:"filepath="+fullpath,
			success:function(data){
				
				if(data*1==0){
					window.external.Application.InitializeVBA();					
					window.external.Application.ActiveDocument.Metadata.Notes = fullpath;
					window.external.Application.GMSManager.RunMacro( "CDFWEBDOCK", "Macros.Topdf" );
					
				}
			}		
 		});
		//$("#prodfilepdf").val(fullpath.replace(/.cdr/i,".pdf"));
		$("#prodfilepdf").val(fullpath+".pdf");
	};
		window.external.Application.InitializeVBA();
		window.external.Application.ActiveDocument.Metadata.Notes = "";
		window.external.Application.ActiveDocument.Metadata.Notes += $("#prodfilepdf").val();
		window.external.Application.ActiveDocument.Metadata.Notes += "|*|";
		window.external.Application.ActiveDocument.Metadata.Notes += $("#prodinformation").val();
		window.external.Application.ActiveDocument.Metadata.Notes += "|*|";
		$allatt.each(function(){
			if (this.checked) {
				window.external.Application.ActiveDocument.Metadata.Notes += $(this).val();
				window.external.Application.ActiveDocument.Metadata.Notes += ";";
			}
		});	
		$revatt.each(function(){
			if (this.checked) {
				window.external.Application.ActiveDocument.Metadata.Notes += $(this).prev("input").val();
				window.external.Application.ActiveDocument.Metadata.Notes += ";";
			}
		});	
		//alert(window.external.Application.ActiveDocument.Metadata.Notes);
		window.external.Application.GMSManager.RunMacro( "CDFWEBDOCK", "Macros.Mailto");
		$.fn.colorbox.close();

	}
</script>
	<div id="main">
    	<?php if ($_SESSION['loginOK']=="OK") {?>
    	<div id="welcomeuser"> 
        	<b><?php echo $_SESSION['hello'];?></b><a href="disconnection.php"><img src="images/webdocker_03.png" alt="Disconnect" /></a><br/>           
            <img src="images/Horizontal_separation.png" class="horizontal_sep"/>
        </div>
        <?php 
       
        	$selectreceivedsms = " select * from webdock_sms where toId=".$_SESSION['id_member']." and haveRead='N' and showSMS='Y'";
        	$resultreceivedsms = mysql_query($selectreceivedsms);
        	$totalreceivedsms = mysql_num_rows($resultreceivedsms);
        ?>
        
        
        
        <div id="toolbar"> 
			<ul>
            	<li><img src="images/webdocker_11.png" alt="Precedent" onclick="javascript:history.go(-1)" onmouseover="this.src='images/webdocker_over_11.png'" onmouseout="this.src='images/webdocker_11.png'"/></li>
                <li><img src="images/webdocker_13.png" alt="Prochain" onclick="javascript:history.go(1)" onmouseover="this.src='images/webdocker_over_13.png'" onmouseout="this.src='images/webdocker_13.png'"/></li>
                <li><img src="images/webdocker_15.png" alt="Actualiser" onclick="javascript:location.reload(true)" onmouseover="this.src='images/webdocker_over_15.png'" onmouseout="this.src='images/webdocker_15.png'"/></li>
                <li><img src="images/webdocker_17.png" alt="Accueil" onclick="location='welcome.php'" onmouseover="this.src='images/webdocker_over_17.png'" onmouseout="this.src='images/webdocker_17.png'"/></li>
                <li><a href="#" class="mailto"><img src="images/webdocker_19.png" alt="Envoyer par Email" onmouseover="this.src='images/webdocker_over_19.png'" onmouseout="this.src='images/webdocker_19.png'"/></a></li>
                <li id="smsli">
                <a href="SMSReceived.php">
                <?php if($totalreceivedsms<=0){ ?>
                <img id="smsimg" src="images/sms_empty.png" alt="SMS" onmouseover="this.src='images/sms_empty_over.png'" onmouseout="this.src='images/sms_empty.png'"/><br/>
                <?php
                }else {
                ?>
                <p style="width:29px;height:29px;margin:0px;background-image:url(images/sms.png);" onmouseover="$(this).css('background-image','url(images/sms_over.png)')" onmouseout="$(this).css('background-image','url(images/sms.png)' )"> <span id="smscount" style="width:21px;height:12px;position:relative;left:10px;top:3px;text-align:center;display:block;line-height:12px;font:bold"><?php echo $totalreceivedsms; ?></span> </p>
                <?php
                }
                ?></a>
                </li>
                <!--
                <li><img src="../images/webdocker_21.png" alt="Administration" <?php if($_SESSION['level'] == 'A'){ ?>onclick="location='admin.php'" <?php } ?> onmouseover="this.src='images/webdocker_over_21.png'" onmouseout="this.src='images/webdocker_21.png'"/> </li>
                -->
                <li><img src="images/webdocker_21.png" alt="Administration" <?php if($_SESSION['level'] == 'A'){ ?>onclick="adminWindow();" <?php } ?> onmouseover="this.src='images/webdocker_over_21.png'" onmouseout="this.src='images/webdocker_21.png'"/> </li>
            </ul>
        </div> 
   
        <div id="tabs">
            <ul>
                <li id="editLi" <?php if($varSelectOption=="1"){echo "style='background-color:#CEDAEB'";}?>><a href="addProduct.php" <?php if($varSelectOption=="1"){echo "style='color:#38557D'";}?>>Editer</a>
                	<ul id="editItemList" style="display:none; position:absolute;z-index:99">
                		<li  style="float:none; width:86px;color:#FFF;padding-left:3px"><a href="addProduct.php" style="text-align:left">Single Edit</a></li>
                		<li  style="float:none;width:86px;color:#FFF;padding-left:3px;cursor:pointer" onclick="multiEdit();">Multi Edit</li>
                	</ul>
                </li>
                <li <?php if($varSelectOption=="2"){echo "style='background-color:#CEDAEB'";}?>><a href="searchProduct.php" <?php if($varSelectOption=="2"){echo "style='color:#38557D'";}?>>Rechercher</a></li>
                <li <?php if($varSelectOption=="3"){echo "style='background-color:#CEDAEB'";}?>><a href="merchandiseList.php" <?php if($varSelectOption=="3"){echo "style='color:#38557D'";}?>>Merchandising</a></li>
            </ul>
        </div>
        <?php } else {?>
        <div id="logo">
        <img src="images/Logo_Webdocker.png" width="279" height="42" />
</div>
        <?php }?>
        <div id="content">
            <!-- InstanceBeginEditable name="EditRegion3" -->
            <div style="border:1px solid #38557D;background-color:#FFF;">
           <div style="position:relative; z-index:55">
           		<div style="background-image:url(images/BarreBleu_lire.png); background-repeat: no-repeat; padding: 7px;"><img src="images/Logo_vosSms2.png" width="46" height="46" /></div>
           </div>
           
			<?php
				mysql_query("update webdock_sms set haveRead='Y' where id=".(int)$_GET['sid']);
				$selectallsms = "select s.*, u.lastname,u.firstname from webdock_sms s,webdock_user u  where s.id='".(int)$_GET['sid']."' and s.fromId=u.idUser";
				$resultallsms = mysql_query($selectallsms);
				$sms = mysql_fetch_array($resultallsms);

			?>
			<div style="border-bottom:1px solid #38557D;margin-top:-30px; padding:5px;background:transparent;">
			<div style="margin-left:50px;">
			<table>
				<tr>
					
					<td width="100px"><strong><?php echo $sms['firstname']." ".strtoupper($sms['lastname']);?></strong></td>
					<td width="70px"><?php echo date("m/d/Y",strtotime($sms['sendDate']));?></td>
					<td><img src="images/trash.png" id="delsms" alt="Delete" onmouseover="this.src='images/trash_over.png'" onmouseout="this.src='images/trash.png'"/> <input type="hidden" value="<?php echo $sms['id']?>" /> </td>
				</tr>
			</table>
			</div>
			<!-- 
			<span style="display:inline-block;width:100px;color:#000;margin-left:50px;"><strong><?php echo $sms['firstname']." ".strtoupper($sms['lastname']);?></strong></span>
			<span style="display:inline-block;margin-left:10px;"><?php echo date("m/d/Y",strtotime($sms['sendDate']));?></span>
			
			<span style="float:right;"><img src="images/trash.png" alt="Delete" onmouseover="this.src='images/trash_over.png'" onmouseout="this.src='images/trash.png'"/></span>
			 -->
			</div>
			<div style="padding:7px;height:200px;overflow:scroll;">
				<?php echo $sms['smsContent'];?>
			</div>
			<div style="background-image:url('images/SeparationBleu.png');color:#FFF;font-weight: blod;padding-left:10px;">Repondre</div>
			<div style="padding-right:7px;padding-bottom:7px;height:200px;">
				<input type="hidden" id="fromId" value="<?php echo $sms['toId'];?>" />
				<input type="hidden" id="sendtype" value="user" />
				<input type="hidden" id="toId" value="<?php echo $sms['fromId'];?>" />
				<textarea style="width:100%;height:198px;font-family: Arial,Helvetica,sans-serif;" id="smscontent"></textarea>
				
			</div>
			<div style="border-top:1px solid #38557D;padding:7px;">
			
				<table>
					<tr>
						<td align="left"> <a href="SMSReceived.php"><img src="images/back.png" alt="back" onmouseover="this.src='images/back_over.png'" onmouseout="this.src='images/back.png'"/> </a></td>
						<td align="right"> <img src="images/Send.png" id="replySMS" alt="send" onmouseover="this.src='images/Send_over.png'" onmouseout="this.src='images/Send.png'"/></td>
					</tr>
				</table>
			</div>
			
			
    
            </div>
		  <!-- InstanceEndEditable -->
        </div>
    </div>
    
    <div style="display:none">
    Créé par C-DESIGN® - 37 rue Meslay 75003 PARIS (Fr) - SARL au capital de 7 622,45 Euros -SIRET : 419 327 234 000 29 
Tél. : +33 (0)1 55 34 36 36 - Fax : +33 (0)1 55 34 36 37 - Email : contact@cdesignfashion.com - Internet : www.cdesignfashion.com
Le code source du présent logiciel ainsi que tout autre code source référent sont la propriété exclusive de C-DESIGN®.   L'utilisation du présent logiciel est soumis  à la licence d'utilisation que avez acquise auprès de C-DESIGN®. Toute reproduction du code source est interdite
Il est formellement interdit de décompiler ou désassembler ce code, de modifier ou fusionner tout ou partie de celui-ci avec un autre code ou programme, et de l'utiliser pour toute autre utilisation que celle prévue par C-DESIGN® telle que définie dans le Contrat de Licence Utilisateur final. (CLUF)
Copyright© 2011 C-DESIGN®. Tous droits réservés .
 
…………………………………………………………………
 
Created by C-DESIGN® - 37 rue Meslay 75003 PARIS (Fr) - SARL with registered capital of 7 622,45 Euros -SIRET : 419 327 234 000 29 
Tel. : +33 (0)1 55 34 36 36 - Fax : +33 (0)1 55 34 36 37 - Email : contact@cdesignfashion.com - Internet : www.cdesignfashion.com
The source code of this software and any other referent source code are the exclusive property of C-DESIGN®. The use of this software is subject to the license that you acquired from C-DESIGN®. Any reproduction of the source code is prohibited.
It is forbidden to decompile or disassemble this code, modify or merge all or any part of this source code with another code or program, and use it for any other use than that provided by C-DESIGN® as defined in the End User License Agreement. (EULA)
Copyright© 2011 C-DESIGN®. All rights reserved.

    </div>
</body>
<!-- InstanceEnd --></html>