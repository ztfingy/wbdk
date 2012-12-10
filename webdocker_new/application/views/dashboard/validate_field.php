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

set_time_limit(0);

$page = 1;
$pagesize = 10;



if (isset($_GET['pagesize'])){
	$pagesize = $_GET['pagesize'];
}

if (isset($_GET['page'])){
	$page = $_GET['page'];  //$from  page num
}

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
$listings = implode('\',\'',$listing);

$products = array();

	$selectProducts = "select * from webdock_productdetail where nameId in ('".$prods."') and fieldProd in ('".$listings."')";
	$resultProducts = mysql_query($selectProducts);
	while ($product = mysql_fetch_array($resultProducts)) {
		$products[$product['nameId']][$product['fieldProd']][0]=$product['valueProd'];
		$products[$product['nameId']][$product['fieldProd']][1]=$product['validation'];
	}

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
$id=time();
	        echo ("<img src='{$location}?id={$id}' alt='image' width='{$w}' height='{$h}' class='previewimg'/>");
	    }
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="js/jquery.min.js" ></script>
<script type="text/javascript" src="js/jquery.tablesorter.js" ></script>
<script type="text/javascript" src="js/jquery.tablesorter.pager.js" ></script>
<script type="text/javascript">
$(document).ready(function(){
	$("table").tablesorter({widthFixed: true, widgets: ['zebra']}).tablesorterPager({ container: $(".pagerOne"), positionFixed: false }); 
	$(".firstpage").click(function(){
		var currentpage = $("#currentpageid").html();
		var totalpage = $("#totalpageid").html();
		var pagesize = $("#pagessizeid").val();
		if(currentpage=='1'){
			alert("this is the first page!");
		}else{
		$("#prodsfields").attr("action","showDashboardwithValidateField.php?page=1&&pagesize="+pagesize);
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
		$("#prodsfields").attr("action","showDashboardwithValidateField.php?page="+prevpage+"&&pagesize="+pagesize);
		$("#prodsfields").submit();
		}
	});

	$(".nextpage").click(function(){
		var currentpage = $("#currentpageid").html();
		var nextpage = currentpage*1+1;
		var totalpage = $("#totalpageid").html();
		var pagesize = $("#pagessizeid").val();
		$("#prodsfields").attr("action","showDashboardwithValidateField.php?page="+nextpage+"&&pagesize="+pagesize);
		$("#prodsfields").submit();
	});

	$(".lastpage").click(function(){
		var currentpage = $("#currentpageid").html();
		var totalpage = $("#totalpageid").html();
		var pagesize = $("#pagessizeid").val();
		$("#prodsfields").attr("action","showDashboardwithValidateField.php?page="+totalpage+"&&pagesize="+pagesize);
		$("#prodsfields").submit();
	});


	$(".pagessize").change(function(){
		var currentpage = $("#currentpageid").html();
		var totalpage = $("#totalpageid").html();
		var pagesize = $(this).val();
		$("#prodsfields").attr("action","showDashboardwithValidateField.php?page=1&&pagesize="+pagesize);
		$("#prodsfields").submit();
	});

});
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
<link href="css/style.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
body {

color:#38557D;
font-family:Arial,Helvetica,sans-serif;
font-size:14px;

}
table.tablesorter tbody td {
color:#38557D;
}

</style>
<title>Document sans titre</title>


</head>

<body>
<div id="dashboardTitle" align="center" style="font-size:20px;font-weight:bold;"><span onclick="setTitle();">click here to add a title</span></div>
<div align="center"><span class="Style4">Made with C-DESIGN Fashion &reg;</span><br />
</div>
<div align="center">

<?php echo $_POST['txtHdCDF']."<br />";?> 
<?php echo sizeof($prod)." pieces";?>

</div>
<form id="prodsfields" method="post" action="" target="_self">
<input type="hidden" name="fieldlist" id="fieldlist" value="<?php echo implode('|*|',$listing); ?>" />
<input type="hidden" name="totalprodsid" id="allprods" value="<?php echo $_POST['totalprodsid'];?>" />
<input type="hidden" name="txtHdCDF" value="<?php echo $_POST['txtHdCDF'];?>" />
</form> 
<table width="243" border="2" align="center" cellpadding="0" cellspacing="0" bordercolor="#7B93AC" bgcolor="#FFFFFF" class='tablesorter'>
<!-- Table Header -->
  <thead>
<tr>
    <th>Nom du produit
    <div width="140px"></div></th>
<?php

for ($m = 0; $m < sizeof($fieldsarray); $m++) {
	echo "<th>".  str_replace('select','',str_replace('selecttxt','',$fieldsarray[$m]))."</th>";
}


 ?>
  </tr>
  
  	<tr>	        
	        <td colspan="<?php echo sizeof($listing)+2;?>">
		        <img src="images/first.png" class="firstpage"/>
		        <img src="images/prev.png" class="prevpage"/>
		        <label class="currentpage" id="currentpageid"><?php echo $page;?></label>/<label class="totalpage" id="totalpageid"><?php echo ceil(sizeof($prod)/$pagesize);?></label>	        
		        <img src="images/next.png" class="nextpage"/>
		        <img src="images/last.png" class="lastpage"/>
		        show by : 
		        <select class="pagessize" id="pagessizeid" style="width:40px">
			        <option  value="10" <?php if($pagesize==10){echo "selected='selected'";}?>>10</option> 
			        <option value="20" <?php if($pagesize==20){echo "selected='selected'";}?>>20</option>
			        <option value="50" <?php if($pagesize==50){echo "selected='selected'";}?>>50</option>
			        <option  value="100" <?php if($pagesize==100){echo "selected='selected'";}?>>100</option>
		        </select>
		    </td>		    
	    </tr>
  </thead>
         <!-- Tabel body-->
    <tbody>
<?php 
	for ($i = 0; $i < sizeof($prodarray); $i++) {
		$selectimg = "select valueProd from webdock_productdetail where nameId=".$prodarray[$i]." and fieldProd='shortNamehdField'";
		$resultimg = mysql_query($selectimg);
		$img = mysql_fetch_array($resultimg);
					
					
		$selectpname = "select * from webdock_products where id =".$prodarray[$i];
		$resultpname = mysql_query($selectpname);
		$pname =  mysql_fetch_array($resultpname);
		$pvalid = $pname['validation'];
?>
	<tr>
		<td>
			<acronym title="Produit">
      <div align="center">
        <?php  echo  $pname['productName']."<br>"; 
        
        echo scaleimage("preview/".$img['valueProd'].'_CDFWD.jpg',100,100);

        ?>
  		<br />
        </div></acronym>
		</td>
		<?php 
		for ($j = 0; $j < sizeof($listing); $j++) {
	?>
		<td <?php if($products[$prodarray[$i]][$listing[$j]][1]=='Y'||$pvalid=='Y'){ echo "style='background-color:RGB(0,71,212);color:#FFF'";}?>>
		<?php echo $products[$prodarray[$i]][$listing[$j]][0];?>
		</td>
	<?php 		
		}
		?>
	
	
	</tr>
<?php 
  	}?>
</tbody>
<tfoot>
	   <tr>	        
	        <td colspan="<?php echo sizeof($listing)+2;?>">
		        <img src="images/first.png" class="firstpage"/>
		        <img src="images/prev.png" class="prevpage"/>
		        <label class="currentpage" id="currentpageid"><?php echo $page;?></label>/<label class="totalpage" id="totalpageid"><?php echo ceil(sizeof($prod)/$pagesize);?></label>	        
		        <img src="images/next.png" class="nextpage"/>
		        <img src="images/last.png" class="lastpage"/>
		        show by : 
		        <select class="pagessize" id="pagessizeid" style="width:40px">
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
