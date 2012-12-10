<?php
session_start();
error_reporting(0);
$varSelectOption="1";
if ($_SESSION['loginOK']!="OK"){
header ("location:index.php");
}
require_once(dirname(__FILE__).'/connexion/connexion.php');

$id = $_GET['rid'];

/*
 * 
    
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

 */

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
function sendRevision(){
	var title=$("#tdtitle").html()+"-"+$("h3").html();
	var note=$("#tdnote").html();
	var attachs=$("#tdattach").val();

	var revision = "";	
	revision +=title;
	revision +="|&|";
	revision +=note;
	revision +="|&|";
	revision +=attachs;
	<?php if($_SESSION['CDF']=="Y"){?>
	window.external.Application.InitializeVBA();	
	window.external.Application.GMSManager.RunMacro( "CDFWEBDOCK", "Macros.SendRevision",revision);
	<?php }else{?>
	//alert(revision);
	window.external.SendRevision(revision);
	//window.external.opnFdlf();
	<?php }?>
}

</script>
<style type="text/css">
	table {
		background-color:#38557D;
		
	}
	td {
		margin:1px;
		background-color:#CEDAEB;
	}
</style>
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

	function multiEdit(){
		var url = "http://"+window.location.hostname+":"+window.location.port+"/webdocker/multiSearchProduct.php";	
		<?php if($_SESSION['CDF']=="Y"){?>	
		window.external.Application.InitializeVBA();
	   	window.external.Application.GMSManager.RunMacro( "CDFWEBDOCK", "Macros.FullWindow",url);
	<?php }else{
		?>
		window.location=url;
		<?php 
	}?>
	   	$.post("ajax/emptyXML.php");	
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
            <?php
            	$selectrevision = "select r.*,p.productName from webdock_revisions r, webdock_products p where r.id = '".$id."' and r.prodId=p.id";
				$resultrevision = mysql_query($selectrevision);
				$totalrevision = mysql_num_rows($resultrevision);
				if($totalrevision>0){
					while ($revision = mysql_fetch_array($resultrevision)) {
			?>
			<h3>Revision of <?php echo $revision['productName']?></h3>
			<table>
				<tr><td><strong>Title</strong></td><td id="tdtitle"><?php echo $revision['title']?></td></tr>
				<tr><td><strong>Note</strong></td><td id="tdnote"><?php echo $revision['note']?></td></tr>
				<tr><td><strong>Attachments</strong></td>
					<td ><?php 
					$attacharray = explode(";",$revision['attachment']);
					for ($i = 0; $i < sizeof($attacharray); $i++) {
						if ($attacharray[$i]!='') {
					?>
						<span onclick="launchDoc('<?php echo str_replace('\\','\\\\',$attacharray[$i]);?>')" style="text-decoration:underline; cursor:hand; "  >
					<?php 
							echo basename($attacharray[$i])."<br />";
							
					?>
					</span>
					<?php 
						}
					}
					?></td>
				</tr>
				<input type="hidden" id="tdattach" value="<?php echo $revision['attachment'];?>" />
				<tr><td><strong>Date</strong></td><td><?php echo $revision['addAt']?></td></tr>
			</table>
			
			<!-- 
			<table>
				<tr><td><strong>Title</strong></td><td id="tdtitle"> <input type="text" value=" <?php echo $revision['title']?> " /></td></tr>
				<tr><td><strong>Note</strong></td><td id="tdnote"> <textarea ><?php echo $revision['note']?></textarea> </td></tr>
				<tr><td><strong>Attachments</strong></td>
					<td ><?php 
					$attacharray = explode(";",$revision['attachment']);
					for ($i = 0; $i < sizeof($attacharray); $i++) {
						if ($attacharray[$i]!='') {
							echo "<a href='".$attacharray[$i]."'>".basename($attacharray[$i])."</a><br />";
						}
					}
					?>
					
					<input type="hidden" name="attachments" id="attachments" value="" /> <div id="displayattachments"></div> <input type="text" name="revisionattach" id="revisionattach" value="" onclick="comEventOccured_link()"/><img src="images/webdocker_66.png" id="addrevisionattachment" alt="ajoutez cet attachement" />
					
					</td>
				</tr>
				<input type="hidden" id="tdattach" value="<?php echo $revision['attachment'];?>" />
				<tr><td><strong>Date</strong></td><td><?php echo $revision['addAt']?></td></tr>
			</table>
			 -->
			
			
			
			<br />
			<input type="button" name="sendbyemail" id="sendrevision" value="send by email" onclick="sendRevision();"/>
			<br />
			<br />
			<a href="productRevision.php?pov=<?php echo $revision['prodId']?>"><img src="images/back.png" alt="retourner" /></a>

			<?php 
					}
				}
			?>
	
	            
            <script type='text/javascript' language='javascript'>

function comEventOccured_link()
{

try{

<?php   if($_SESSION['CDF']=="Y"){ ?>

		window.external.Application.InitializeVBA();
		
		var opnfldr = window.external.Application.GMSManager.RunMacro( "CDFWEBDOCK", "Macros.opnFdlf" );

		document.getElementById('revisionattach').value=opnfldr;

<?php } else {?>
        document.getElementById('revisionattach').value = window.external.opnFdlf();
<?php }?>
}
catch(e)
{

}

}
function launchDoc(varStrFile)
{

try
{
		<?php if ($_SESSION['CDF']=="Y"){?>
		window.external.Application.InitializeVBA();
		//window.external.Application.ActiveDocument.Metadata.Notes = (varStrFile);	
		window.external.Application.GMSManager.RunMacro( "CDFWEBDOCK", "Macros.LaunchFile",varStrFile );
		<?php }else{ ?>
		window.external.LaunchFile(varStrFile);
		
		<?php } ?>
}
catch(e)
{

}

}
</SCRIPT>
	
			
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
