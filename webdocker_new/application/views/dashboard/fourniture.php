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
		$id=time();
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
		if(obj.className.toLowerCase() == "four")
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
				if(oTable.cells[i].className.toLowerCase() == "four")
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
						if(oTable.cells[i].className.toLowerCase() == "four")
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
	new DragedTable("coltable");
	}
	
	$(document).ready(function(){
		//$("#coltable").tablesorter().tablesorterPager({ container: $("#pagerOne"), size: 2, positionFixed: false }); 
		init();


		$(".firstpage").click(function(){
			var currentpage = $("#currentpageid").html();
			var totalpage = $("#totalpageid").html();
			var pagesize = $("#pagessizeid").val();
			if(currentpage=='1'){
				alert("this is the first page!");
			}else{
			$("#prodsfields").attr("action","showDashboardFournitures.php?page=1&&pagesize="+pagesize);
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
			$("#prodsfields").attr("action","showDashboardFournitures.php?page="+prevpage+"&&pagesize="+pagesize);
			$("#prodsfields").submit();
			}
		});

		$(".nextpage").click(function(){
			var currentpage = $("#currentpageid").html();
			var nextpage = currentpage*1+1;
			var totalpage = $("#totalpageid").html();
			var pagesize = $("#pagessizeid").val();
			$("#prodsfields").attr("action","showDashboardFournitures.php?page="+nextpage+"&&pagesize="+pagesize);
			$("#prodsfields").submit();
		});

		$(".lastpage").click(function(){
			var currentpage = $("#currentpageid").html();
			var totalpage = $("#totalpageid").html();
			var pagesize = $("#pagessizeid").val();
			$("#prodsfields").attr("action","showDashboardFournitures.php?page="+totalpage+"&&pagesize="+pagesize);
			$("#prodsfields").submit();
		});


		$(".pagessize").change(function(){
			var currentpage = $("#currentpageid").html();
			var totalpage = $("#totalpageid").html();
			var pagesize = $(this).val();
			$("#prodsfields").attr("action","showDashboardFournitures.php?page=1&&pagesize="+pagesize);
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

$selectallfours = "select f.*,p.productName from webdock_fournitures f, webdock_products p where prodId in ('".$prods."') and f.fourId = p.id order by prodId,fourId,fieldFour";
$resultallfours = mysql_query($selectallfours);

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
<form id="prodsfields" method="post" action="" target="_self">
<input type="hidden" name="fieldlist" id="fieldlist" value="<?php echo implode('|*|',$listing); ?>" />
<input type="hidden" name="totalprodsid" id="allprods" value="<?php echo $_POST['totalprodsid'];?>" />
<input type="hidden" name="txtHdCDF" value="<?php echo $_POST['txtHdCDF'];?>" />
</form> 
<table width="100%" border="2" align="center" cellpadding="2" cellspacing="0" bordercolor="#00468C" id="coltable">
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
		<table style="margin:0;padding: 0">
		<tr>
			<td style="width:200px">
			
			<?php 
				$fourid = '';
				$num=0;
				while ($four = mysql_fetch_array($resultallfours)) {
					if ($four['prodId']==$prodarray[$i]) {
						if ($four['fourId']==$fourid) {
							
			?>				
							<div style='border-bottom-style: solid;	border-bottom-width: thin;	border-bottom-color: #7B93AC;'>
							<?php echo "<strong>".$four['fieldFour']."</strong> : ".$four['valueFour'];?>
							</div>			
			<?php 
						}else{
							if($fourid == ''){
								
							}else{
								$num++;	
								echo "</td>";
								if ($num >4) {
									echo "</tr>";
									$num=0;
								}
								echo "<td style='width:200px'>";
								
								
														
							}
			?> 
			
							<div style='height:26px;background-color:#CEDAEB'><h3><?php echo $four['productName'];?></h3></div>
							<div style='min-height:150px; text-align:center; background-color:#FFFFFF; display:block; font-size:131px; font-family:Arial; width:100%'>
								<?php echo scaleimage("preview/".$four['productName'].'.cdr_CDFWD.jpg',130,130);?>
							</div>
			<?php 
							$fourid=$four['fourId'];
						}	
					}
				}
				mysql_data_seek($resultallfours,0)
			?>
			</td>
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
