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
        echo ("<img src='{$location}?id={$id}' alt='image' width='{$w}' height='{$h}'/>");
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

var dragedTable_x0,dragedTable_y0,dragedTable_x1,dragedTable_y1;
var dragedTable_movable = false;
var dragedTable_preCell = null;
var dragedTable_normalColor = null;
//起始单元格的颜色
var dragedTable_preColor = "lavender";
//目标单元格的颜色
var dragedTable_endColor = "#FFCCFF";
var dragedTable_movedDiv = "dragedTable_movedDiv";
var dragedTable_tableId = "";


function DragedTable(tableId)
{
	dragedTable_tableId = tableId;
	var oTempDiv = document.createElement("div");
	oTempDiv.id = dragedTable_movedDiv;
	oTempDiv.onselectstart = function(){return false};
	oTempDiv.style.cursor = "hand";
	oTempDiv.style.position = "absolute";
	oTempDiv.style.border = "1px solid black";
	oTempDiv.style.backgroundColor = dragedTable_endColor;
	oTempDiv.style.display = "none";
	document.body.appendChild(oTempDiv);
	document.all(tableId).onmousedown = showDiv;
}

//得到控件的绝对位置
function getPos(cell)
{
	var pos = new Array();
	var t=cell.offsetTop;
	var l=cell.offsetLeft;
	while(cell=cell.offsetParent)
	{
		t+=cell.offsetTop;
		l+=cell.offsetLeft;
	}
	pos[0] = t;
	pos[1] = l;
	return pos;
}

//显示图层
function showDiv()
{
	var obj = event.srcElement;
	var pos = new Array();
	//获取过度图层
	var oDiv = document.all(dragedTable_movedDiv);
	if(obj.tagName.toLowerCase() == "td")
	{
		obj.style.cursor = "hand";
		pos = getPos(obj);
		//计算中间过度层位置，赋值
		oDiv.style.width = obj.offsetWidth;
		oDiv.style.height = obj.offsetHeight;
		oDiv.style.top = pos[0];
		oDiv.style.left = pos[1];
		oDiv.innerHTML = obj.innerHTML;
		oDiv.style.display = "";
		dragedTable_x0 = pos[1];
		dragedTable_y0 = pos[0];
		dragedTable_x1 = event.clientX;
		dragedTable_y1 = event.clientY;
		//记住原td
		dragedTable_normalColor = obj.style.backgroundColor;
		obj.style.backgroundColor = dragedTable_preColor;
		dragedTable_preCell = obj;
		
		dragedTable_movable = true;
	}
}
function dragDiv()
{
	if(dragedTable_movable)
	{
		var oDiv = document.all(dragedTable_movedDiv);
		var pos = new Array();
		oDiv.style.top = event.clientY - dragedTable_y1 + dragedTable_y0;
		oDiv.style.left = event.clientX - dragedTable_x1 + dragedTable_x0;
		var oTable = document.all(dragedTable_tableId);
		for(var i=0; i<oTable.cells.length; i++)
		{
			if(oTable.cells[i].tagName.toLowerCase() == "td")
			{
				pos = getPos(oTable.cells[i]);
				if(event.x>pos[1]&&event.x<pos[1]+oTable.cells[i].offsetWidth
				&& event.y>pos[0]&& event.y<pos[0]+oTable.cells[i].offsetHeight)
				{
					if(oTable.cells[i] != dragedTable_preCell)
					oTable.cells[i].style.backgroundColor = dragedTable_endColor;
				}
				else
				{
					if(oTable.cells[i] != dragedTable_preCell)
					oTable.cells[i].style.backgroundColor = dragedTable_normalColor;
				}
			}
		}
	}
}

function hideDiv()
{
	if(dragedTable_movable)
	{
		var oTable = document.all(dragedTable_tableId);
		var pos = new Array();
		if(dragedTable_preCell != null)
		{
			for(var i=0; i<oTable.cells.length; i++)
			{
				pos = getPos(oTable.cells[i]);
				//计算鼠标位置，是否在某个单元格的范围之内
				if(event.x>pos[1]&&event.x<pos[1]+oTable.cells[i].offsetWidth
				&& event.y>pos[0]&& event.y<pos[0]+oTable.cells[i].offsetHeight)
				{
					if(oTable.cells[i].tagName.toLowerCase() == "td")
					{
						//交换文本
						dragedTable_preCell.innerHTML = oTable.cells[i].innerHTML;
						oTable.cells[i].innerHTML = document.all(dragedTable_movedDiv).innerHTML;
						//清除原单元格和目标单元格的样式
						dragedTable_preCell.style.backgroundColor = dragedTable_normalColor;
						oTable.cells[i].style.backgroundColor = dragedTable_normalColor;
						oTable.cells[i].style.cursor = "";
						dragedTable_preCell.style.cursor = "";
						dragedTable_preCell.style.backgroundColor = dragedTable_normalColor;
					}
				}
			}
		}
		dragedTable_movable = false;
		//清除提示图层
		document.all(dragedTable_movedDiv).style.display = "none";
	}
}

document.onmouseup = function()
{
	hideDiv();
	var oTable = document.all(dragedTable_tableId);
	for(var i=0; i<oTable.cells.length; i++)
	oTable.cells[i].style.backgroundColor = dragedTable_normalColor;
}

document.onmousemove = function()
{
	dragDiv();
}

function init()
{
//注册可拖拽表格
new DragedTable("collist");
}

$(document).ready(function(){
	init();
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
	$select = "select l.*, p.valueProd as price, pr.productName as nameProd from webdock_list l, webdock_productdetail p, webdock_products pr  where l.nameMerch = '".$listname."' and p.fieldProd ='selecttxt".str_replace(" ","_",$pricetype)."' and l.prodId = p.nameId and l.prodId = pr.id";
	$result = mysql_query($select,$db)  or die ('Erreur !' );
	$total = mysql_num_rows($result);
	$content = "";
	if($total > 0){
		$totalnum = 0;
		$totalquantity = 0;
		$i = 0;
		echo " / ".$total." Pieces</div>";
		?>
	
	<table id="collist" border="2" align="center" cellpadding="0" cellspacing="0" bordercolor="#7B93AC" bgcolor="#FFFFFF">
	<!--
    <thead>
    <tr style='background-color:#CEDAEB;'><th align='center' class='sortable'>Product</th><th class='sortable'><?php echo $pricetype.'('.$unit.')'; ?></th><th class='sortable'>Quantity</th><th class='sortable'>Sum</th></tr>
    </thead>
      -->
     <tr>
    <?php
    $colcpt = 0;
		while ($row = mysql_fetch_array($result)) {
			$totalnum +=($row['price']*$row['quantityProd']);
			$totalquantity+=$row['quantityProd'];
			$selectpreview = "SELECT  valueProd FROM webdock_productdetail where nameId='". $row['prodId']  ."' and fieldProd='shortNamehdField'";
			$resultpreview = mysql_query($selectpreview,$db) or die ('Erreur !' );
			$rowpreview = mysql_fetch_array($resultpreview);
	?>		
	<td style="padding-top:10px;">
	<?php $colcpt++;?>
	<div style="height:26px;background-color:#CEDAEB;line-height:26px">
	<h3> <?php echo $row['nameProd'];?></h3>
	</div>
	<div style="height:150px;text-align:center;vertical-align:middle; padding:10px;" >
		<i style="display:inline-block; height:100%;vertical-align: middle;"></i>
		<?php if ($rowpreview['valueProd']!=""){		
		echo scaleimage("preview/".$rowpreview['valueProd'].'_CDFWD.jpg',130,130);
		}?>
	</div>
	<div style='background-color:#CEDAEB;border-bottom-style: solid;	border-bottom-width: thin;	border-bottom-color: #7B93AC;'>
	<strong style="display:inline-block;width:80px;"><?php echo $pricetype;?></strong> : <?php echo $row['price']." ".$unit;?>
	</div>
	<div style='background-color:#E0E8F2;border-bottom-style: solid;	border-bottom-width: thin;	border-bottom-color: #7B93AC;'>
	<strong style="display:inline-block;width:80px;">Quantity</strong> : <?php echo $row['quantityProd'];?>
	</div>
	<div style='background-color:#CEDAEB;border-bottom-style: solid;	border-bottom-width: thin;	border-bottom-color: #7B93AC;'>
	<strong style="display:inline-block;width:80px;">SUM</strong> : <?php echo $row['price']*$row['quantityProd']." ".$unit;?>
	</div>
	</td>
	<?php	
	if ($colcpt>3) {
		echo "</tr>";
		$colcpt=0;
		if ($total%4!=0) {
			echo "<tr>";
		}
	}
		
		}
	if ($colcpt>0 && $colcpt<4) {
		for ($c = 0; $c < 4-$colcpt; $c++) {
			echo "<td  style='padding-top:10px;'></td>";
		}
		echo "</tr>";
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