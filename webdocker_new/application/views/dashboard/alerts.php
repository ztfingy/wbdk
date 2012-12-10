<?php
  /* 
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
session_start();
error_reporting(0);
$varcpt=0;
require_once(dirname(__FILE__).'/connexion/connexion.php');

$cptCol;


function scaleimage($location, $maxw=NULL, $maxh=NULL){
    $img = @getimagesize($location);
    if($img){
        $w = $img[0];
        $h = $img[1];

        $dim = array('w','h');
        foreach($dim AS $val){
            $max = "max{$val}";
            if(${$val} > ${$max} && ${$max}){
                $alt = ($val == 'w') ? 'h' : 'w';
                $ratio = ${$alt} / ${$val};
                ${$val} = ${$max};
                ${$alt} = ${$val} * $ratio;
            }
        }
		$id=rand();
        echo ("<img src='{$location}?id={$id}' alt='image' width='{$w}' height='{$h}'/>");
    }
}



$page = 1;
$pagesize = 10;

if (isset($_GET['pagesize'])){
	$pagesize = $_GET['pagesize'];
}

if (isset($_GET['page'])){
	$page = $_GET['page'];  //$from  page num
}

set_time_limit(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="js/jquery.min.js" ></script>
<script type="text/javascript">
$(document).ready(function(){
	$(".firstpage").click(function(){
		var currentpage = $("#currentpageid").html();
		var totalpage = $("#totalpageid").html();
		var pagesize = $("#pagessizeid").val();
		if(currentpage=='1'){
			alert("this is the first page!");
		}else{
		$("#prodsfields").attr("action","showDashboardAlerts.php?page=1&&pagesize="+pagesize);
		$("#prodsfields").submit();
		}
	});

	$(".prevpage").click(function(){
		var currentpage = $("#currentpageid").html();
		var prevpage = currentpage*1 -1;
		var totalpage = $("#totalpageid").html();
		var pagesize = $("#pagessizeid").val();
		if(currentpage=='1'){
			alert("this is the first page!");
		}else{
		$("#prodsfields").attr("action","showDashboardAlerts.php?page="+prevpage+"&&pagesize="+pagesize);
		$("#prodsfields").submit();
		}
	});

	$(".nextpage").click(function(){
		var currentpage = $("#currentpageid").html();
		var nextpage = currentpage*1+1;
		var totalpage = $("#totalpageid").html();
		var pagesize = $("#pagessizeid").val();
		$("#prodsfields").attr("action","showDashboardAlerts.php?page="+nextpage+"&&pagesize="+pagesize);
		$("#prodsfields").submit();
	});

	$(".lastpage").click(function(){
		var currentpage = $("#currentpageid").html();
		var totalpage = $("#totalpageid").html();
		var pagesize = $("#pagessizeid").val();
		$("#prodsfields").attr("action","showDashboard.php?page="+totalpage+"&&pagesize="+pagesize);
		$("#prodsfields").submit();
	});


	$(".pagessize").change(function(){
		var currentpage = $("#currentpageid").html();
		var totalpage = $("#totalpageid").html();
		var pagesize = $(this).val();
		$("#prodsfields").attr("action","showDashboardAlerts.php?page=1&&pagesize="+pagesize);
		$("#prodsfields").submit();
	});
})


function setTitle(){
	var text = $("#dashboardTitle span").html();
	var t = '';
	if(text=='click here to add a title'){

	}else{
		t = text;
	}
	$("#dashboardTitle").html("<input type='text' id='titleText' onblur='saveTitle()' value='"+t+"' />");
}
 function saveTitle(){
	 $("#dashboardTitle").html("<span onclick='setTitle()'>"+$("#titleText").val()+"</span>");
}
</script>

<style type="text/css">
body {

color:#38557D;
font-family:Arial,Helvetica,sans-serif;
font-size:12px;

}
.Style4 {
	font-size:14px;
}
td {
	background-color : #F0F0F0;
}
div img {
	vertical-align:middle;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document sans titre</title>

<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="dashboardTitle" align="center" style="font-size:20px;font-weight:bold;"><span onclick="setTitle();">click here to add a title</span></div>
<div align="center"><span class="Style4">Made with C-DESIGN Fashion &reg;</span><br />
</div>
<div align="center"><span class="Style4">
<?php 

if (isset($_POST['fieldlist'])) {
	$_POST['listing']=explode('|*|',$_POST['fieldlist']);
}

if (isset($_POST['listing'])) {
	$listing = $_POST['listing'];
}
if (isset($_POST['totalprodsid'])) {
	$allprods = $_POST['totalprodsid'];
}


$prod = explode(';',$allprods);
$varCriterieQRY='';
$fieldsarray = $listing;
$prodarray = array_slice($prod,($page-1)*$pagesize,$pagesize);
$prods = implode('\',\'',$prodarray);



$selectall = "select * from webdock_productdetail where nameId in ('".$prods."')";
$resultall = mysql_query($selectall);

$prodsinfo = array();

while ($fieldvalue = mysql_fetch_array($resultall)) {
	$prodsinfo[$fieldvalue['nameId']][$fieldvalue['fieldProd']]=$fieldvalue['valueProd'];
}

?>
<?php echo $_POST['txtHdCDF']."<br />";?> 
<?php echo sizeof($prod)." pieces";?>
<br/> 

</span>
</div>
<table width="100%" border="2" align="center" cellpadding="2" cellspacing="0" bordercolor="#00468C" >
<thead>
<tr>	        
	        <td colspan="2" >
		        <img src="images/first.png" class="firstpage"/>
		        <img src="images/prev.png" class="prevpage"/>
		        <label class="currentpage"><?php echo $page;?></label>/<label class="totalpage"><?php echo ceil(sizeof($prod)/$pagesize);?></label>	        
		        <img src="images/next.png" class="nextpage"/>
		        <img src="images/last.png" class="lastpage"/>
		        show by : 
		        <select class="pagessize" style="width:40px">
			        <option  value="10" <?php if($pagesize==10){echo "selected='selected'";}?>>10</option> 
			        <option value="20" <?php if($pagesize==20){echo "selected='selected'";}?>>20</option>
			        <option value="50" <?php if($pagesize==50){echo "selected='selected'";}?>>50</option>
			        <option  value="100" <?php if($pagesize==100){echo "selected='selected'";}?>>100</option>
		        </select>
		    </td>		    
	    </tr>
</thead>
 <tbody>
<?php 		
		$selectallalarms = "select *  from webdock_datealert  where prodId in ('".$prods."') ";
		$resultallalarms = mysql_query($selectallalarms);
		
		for($i=0;$i<sizeof($prodarray);$i++){
				
	?>
	<tr>
	<td style="width:20%">
		<div>
			<div style='height:26px;background-color:#CEDAEB'>
			<h3><?php
			if (isset($prodsinfo[$prodarray[$i]]['selecttxtProd'])&&$prodsinfo[$prodarray[$i]]['selecttxtProd']!='') {
				echo  $prodsinfo[$prodarray[$i]]['selecttxtProd']."<br>";
			}else{
				$selectpname = "select productName from webdock_products where id = ".$prodarray[$i]." limit 0,1";
				$resultpname = mysql_query($selectpname);
				$panme  = mysql_fetch_array($resultpname);
				echo $panme['productName']."<br>";
			}
			
			?></h3></div>
			<div style=" min-height:150px; text-align:center; background-color:#FFFFFF; display:block; font-size:131px; font-family:Arial;">
			<?php if ($prodsinfo[$prodarray[$i]]['shortNamehdField']!=''){
		
				echo scaleimage("preview/".$prodsinfo[$prodarray[$i]]['shortNamehdField'].'_CDFWD.jpg',130,130);
			}?>
			</div>
		</div>
		<?php 
  			for ($n = 0; $n < sizeof($fieldsarray); $n++) {
  		?>
  			<div style='background-color:<?php if ($n%2==0) {echo "#CEDAEB";}else{echo "#E0E8F2";}?>;border-bottom-style: solid;	border-bottom-width: thin;	border-bottom-color: #7B93AC;'>
  				<strong><?php echo str_replace('_',' ',str_replace('select','',str_replace('selecttxt','',$fieldsarray[$n])));?></strong> : 
  				
  				<?php echo $prodsinfo[$prodarray[$i]][$fieldsarray[$n]];?>
  			</div>
  		
  		<?php }?>
	</td>
	<td style="padding:0" valign="top">
		<table style="margin:0;padding: 0;border:1px solid black;  ">
		<tr>
						
			<?php 
				$num=0;
				while ($alarm = mysql_fetch_array($resultallalarms)) {
					if ($alarm['prodId']==$prodarray[$i]){
			?>
					<td style="width:200px">
						<div style='height:26px;line-height:26px;background-color:#CEDAEB'><h3><?php echo $alarm['dateField'];?></h3></div>
						<div style='height:20px;line-height:20px;'><?php echo date("d/m/Y",$alarm['dateValue']);?></div>
						<div style='border:1px solid #000; min-height:150px'><?php echo $alarm['alertNote'];?></div>
					</td>
					
			<?php 
					$num++;
					if ($num>5) {
						echo "</tr><tr>";
					}
					}		
				}
				mysql_data_seek($resultallalarms,0)
			?>

		</tr>
		</table>
	
	</td>
	</tr>
	<?php 
	
		}?>
		
		

</tbody>
<tfoot>
<tr>	        
	        <td colspan="2" >
		        <img src="images/first.png" class="firstpage"/>
		        <img src="images/prev.png" class="prevpage"/>
		        <label class="currentpage"><?php echo $page;?></label>/<label class="totalpage"><?php echo ceil(sizeof($prod)/$pagesize);?></label>	        
		        <img src="images/next.png" class="nextpage"/>
		        <img src="images/last.png" class="lastpage"/>
		        show by : 
		        <select class="pagessize" style="width:40px">
			        <option  value="10" <?php if($pagesize==10){echo "selected='selected'";}?>>10</option> 
			        <option value="20" <?php if($pagesize==20){echo "selected='selected'";}?>>20</option>
			        <option value="50" <?php if($pagesize==50){echo "selected='selected'";}?>>50</option>
			        <option  value="100" <?php if($pagesize==100){echo "selected='selected'";}?>>100</option>
		        </select>
		    </td>		    
	    </tr>
</tfoot>
</table>	
<div align="center"></div>
<div align="center"><span class="Style3"><A href="javascript:window.print()">Imprimer</A>
<A href="javascript:window.close()">Fermer</A></span> </div>
</body>
</html>
