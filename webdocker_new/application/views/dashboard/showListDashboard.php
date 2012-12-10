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


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="js/jquery.min.js" ></script>
<script type="text/javascript" src="js/jquery.tablesorter.js" ></script>
<script type="text/javascript" src="js/jquery.tablesorter.pager.js" ></script>
<script type="text/javascript">
/*
$(document).ready(function(){
	$("table").tablesorter({widthFixed: true, widgets: ['zebra']}).tablesorterPager({ container: $("#pagerOne"), positionFixed: false }); 
});
 */
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
<title>Document sans titre</title>
</head>
<style type="text/css">
	body {
		width:19cm;
		color:#7B93AC;
		font-family:Arial,Helvetica,sans-serif;
		font-size:12px;
	}
	table {
		width:19cm;
		border:double  #7B93AC;
	}
	td, th {
		color:#7B93AC;
		border:1px #7B93AC solid;
	}

</style>
<body>
<div id="dashboardTitle" align="center" style="font-size:20px;font-weight:bold;"><span onclick="setTitle();">click here to add a title</span></div>
<div align="center"><span >Made with C-DESIGN Fashion &reg;</span><br />
</div>
<?php
	$unitresult= mysql_query("SELECT * FROM `webdock_fields` WHERE lst = 'P' LIMIT 0 , 1",$db);
	$unittotal = mysql_num_rows($unitresult);
	$unit = "€";
	if ($unittotal>0) {
		while ($unitrow = mysql_fetch_array($unitresult)) {
			$unit = $unitrow['subCateg'];
		};
	}
	$listname = $_POST["selectlistname"];
	$pricetype = $_POST["selectpricetype"];
	
	?>
	<div style="font-size:14px"><strong>Merchandising : </strong><i><?php echo $listname ; ?></i>
	<?php
	$select = "select l.*, p.valueProd as price, pr.productName as nameProd from webdock_list l, webdock_productdetail p,webdock_products pr  where l.nameMerch = '".$listname."' and p.fieldProd ='selecttxt".str_replace(" ","_",$pricetype)."' and l.prodId = p.nameId and l.prodId = pr.id";
	//echo $select;
	$result = mysql_query($select,$db)  or die ('Erreur !' );
	$total = mysql_num_rows($result);
	$content = "";
	if($total > 0){
		$totalnum = 0;
		$totalquantity = 0;
		$i = 0;
		echo " / ".$total." Pieces</div>"
		?>
	
	<table border="2" align="center" cellpadding="0" cellspacing="0" bordercolor="#7B93AC" bgcolor="#FFFFFF">
    <thead>
    <tr style='background-color:#CEDAEB;'><th align='center' class='sortable'>Product</th><th class='sortable'><?php echo $pricetype.'('.$unit.')'; ?></th><th class='sortable'>Quantity</th><th class='sortable'>Sum</th></tr>
    </thead>
    <?php
		while ($row = mysql_fetch_array($result)) {
			$totalnum +=($row['price']*$row['quantityProd']);
			$totalquantity+=$row['quantityProd'];
			$selectpreview = "SELECT  valueProd FROM webdock_productdetail where nameId='". $row['prodId']  ."' and fieldProd='shortNamehdField'";
			$resultpreview = mysql_query($selectpreview,$db) or die ('Erreur !' );
			$rowpreview = mysql_fetch_array($resultpreview);
	?>		
	<tr <?php if($i%2==0){echo "class='oven'";} ?> align='center'><td class='listprodname'><?php echo $row['nameProd'];?><br/><img alt=''  width='100'  src='preview/<?php echo $rowpreview['valueProd'];?>_CDFWD.jpg?id=<?php echo time();?>' /><br /></td><td class='price' align='center'><?php echo $row['price'];?></td><td style='text-align:center'> <?php echo $row['quantityProd'];?></td><td style='text-align:center' class='sum'><?php echo $row['price']*$row['quantityProd']." ".$unit;?></td></tr>
	<?php		
		}
	?>
	<tr style="font-size:16px;font-weight:bold;background-color:#CEDAEB"><td align="center"><?php echo $total." Pieces"?></td><td></td><td align="center"><?php echo $totalquantity;?></td><td align="center"><i><?php echo $totalnum." ".$unit;?></i></td></tr>	
	</table>
    <?php
	} else {
	
		echo " / 0 Piece</div>no product";
	}
	?>


<div align="center"></div>
<div align="center"  class="noprint"><span class="Style3"><A href="javascript:$('.noprint').css('display','none');window.print()">Imprimer</A>
<A href="javascript:window.close()">Fermer</A></span> </div>
</body>
</html>