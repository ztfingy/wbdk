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
$listing = $_POST['listing'];
$prod = explode(';',$_POST['totalprodsid']);;
//print_r($listing);
set_time_limit(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="js/jquery.min.js" ></script>
<script type="text/javascript" src="js/jquery.tablesorter.js" ></script>
<script type="text/javascript" src="js/jquery.tablesorter.pager.js" ></script>
<script type="text/javascript">
$(document).ready(function(){
	//$("table").tablesorter({widthFixed: true, widgets: ['zebra']}).tablesorterPager({ container: $(".pagerOne"), positionFixed: false }); 
	
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
table.tablesorter{
	width:auto;
}
table.tablesorter tbody td {
color:#38557D;
}
.rowHeader {

	font-size:14px;
	font-weight:bold;
	text-align: center;

}
.colHeader{
	width:600px;
}
#tempBox{position:absolute;z-index:9999;}
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
<table class='tablesorter'>
<?php
$varCriterieQRY='';
$fieldsarray = $listing;
$prods = implode('\',\'',$prod);
$case = '';




for ($m = 0; $m < sizeof($fieldsarray); $m++) {
	//echo "<th>".  str_replace('select','',str_replace('selecttxt','',$fieldsarray[$m]))."</th>";
	if($fieldsarray[$m]!='selectFamille'&&$fieldsarray[$m]!='selecttxtParcs'){
		$case.="max(case fieldProd when '".$fieldsarray[$m]."' then valueProd else 0 end) '".$fieldsarray[$m]."', ";
	}
}

$case.=" max(case fieldProd when 'selectFamille' then valueProd else 0 end) Famille,";
$case.=" max(case fieldProd when 'selecttxtParcs' then valueProd else 0 end) Parcs,";
$case.=" max(case fieldProd when 'shortNamehdField' then valueProd else 0 end) shortName,";
$case.=" max(case fieldProd when 'selecttxtProd' then valueProd else 0 end) nameProd";

$selectall = "select nameId, ".$case." from webdock_productdetail where nameId in ('".$prods."') group by nameId ";
//echo $selectall;
$resultall = mysql_query($selectall);
 ?>
<!-- Table Header -->

  <thead>
	<tr class="columnHeader">
		<th class="rowHeader"></th><th class="colHeader">ABCDE</th><th class="colHeader">ABCD</th><th class="colHeader">ABC</th><th class="colHeader">AB</th><th class="colHeader">A</th>
  	</tr>
  </thead>

         <!-- Tabel body-->
    <?php 
    	$parcsArray = array('A,B,C,D,E','A,B,C,D','A,B,C','A,B','A');
    	
    	$selectFamille = "select valueProd from webdock_productdetail where fieldProd='selectFamille' and nameId in ('".$prods."') group by valueProd";

    	$resultFamille = mysql_query($selectFamille);
    	
    ?>
    <tbody>
  <?php 
  	while ($famille = mysql_fetch_array($resultFamille)) {
  ?>
    <tr>
    <td class="rowHeader"><?php echo $famille['valueProd'];?></td>
<?php 
	for($pi=0;$pi<sizeof($parcsArray);$pi++){
	
?>
	<td class="dragtd">
	<div style="width:580px;line-height:1px"></div>
<?php 
  	while ($prodinfo = mysql_fetch_array($resultall)) {

  		if($prodinfo['Parcs']==$parcsArray[$pi]&&$prodinfo['Famille']==$famille['valueProd']){
  ?>
  	<div style="float:left; width:280px" class="dragdiv">
  	<div class="product">
  	<div align="center" class="title">
  	<b><?php echo $prodinfo['shortName'] ; ?></b>
  	</div>
  	<div align="center">
  	<img src="preview/<?php echo $prodinfo['shortName'].'_CDFWD.jpg?id='.time() ; ?>"  width='120px' height="120px"/>
  	</div>
	<div>
  		<table style="font-size:8px;width:270px">
  		<?php 
  			for ($n = 0; $n < sizeof($fieldsarray); $n++) {
  		?>
  			<tr>
  				<td  style='background-color:<?php if ($n%2==0) {echo "#CEDAEB";}else{echo "#E0E8F2";}?>;'><?php echo str_replace('_',' ',str_replace('select','',str_replace('selecttxt','',$fieldsarray[$n])));?> </td>
  				<td  style='background-color:<?php if ($n%2==0) {echo "#CEDAEB";}else{echo "#E0E8F2";}?>;'><strong><?php if($prodinfo[$fieldsarray[$n]]=='0'){echo "";}else{echo $prodinfo[$fieldsarray[$n]];}?></strong></td>
  			</tr>
  		
  		<?php }?>
  		</table>
  	</div>

  	</div>
  	</div>
  <?php 
  		
  		}
 	
    
  	}
  	
  	?>

	</td>
  	<?php
  	mysql_data_seek($resultall,0);
	}
	
	?>
  	</tr>
  	<?php 
  	}
  	?>
</tbody>

</table>

<div align="center"></div>
<div align="center"><span class="Style3"><A href="javascript:window.print()">Imprimer</A>
<A href="javascript:window.close()">Fermer</A></span> </div>
</body>

<script type="text/javascript">
<!--
$.fn.Drag=function (options) {
	var defaults={
		limit : window,//是否限制拖放范围，默认限制当前窗口内
		drop:false,//是否drop
		handle:false,//拖动手柄
		finish:function () {}//回调函数
	};
	var options=$.extend(defaults,options);
	this.X=0;//初始位置
	this.Y=0;
	this.dx=0;//位置差值
	this.dy=0;
	var This=this;
	var ThisO=$(this);//被拖目标
	var thatO;
	if (options.drop) {
		var ThatO=$(options.drop);//可放下位置
		ThisO.find('.product').css({cursor:'move'});
		var tempBox=$('<div id="tempBox"></div>');
	}else {
		options.handle ? ThisO.find(options.handle).css({cursor:'move','-moz-user-select':'none'}) : ThisO.css({cursor:'move','-moz-user-select':'none'});
	}
	//拖动开始
	this.dragStart=function (e) {
		var cX=e.clientX;
		var cY=e.clientY;
		if (options.drop) {
			ThisO=$(this);
			if (ThisO.find('.product').length!=1) {return}//如果没有拖动对象就返回
			This.X=ThisO.offset().left;
			This.Y=ThisO.offset().top;
			tempBox.html(ThisO.clone());
			ThisO.html('');
			$('body').append(tempBox);
			tempBox.css({left:This.X,top:This.Y});
		}else {
			This.X=ThisO.offset().left;
			This.Y=ThisO.offset().top;
			ThisO.css({margin:0})
		}
		This.dx=cX-This.X;
		This.dy=cY-This.Y;
		if (!options.drop) {ThisO.css({position:'absolute',left:This.X,top:This.Y})}
		$(document).mousemove(This.dragMove);
		$(document).mouseup(This.dragStop);
		if ($.browser.msie) {ThisO[0].setCapture();}//IE,鼠标移到窗口外面也能释放
	}
	//拖动中
	this.dragMove=function (e) {
		var cX=e.clientX;
		var cY=e.clientY;
		if (options.limit) {//限制拖动范围
			//容器的尺寸
			var L=$(options.limit)[0].offsetLeft ? $(options.limit).offset().left : 0;
			var T=$(options.limit)[0].offsetTop ? $(options.limit).offset().top : 0;
			var R=L+$(options.limit).width();
			var B=T+$(options.limit).height();
			//获取拖动范围
			var iLeft=cX-This.dx, iTop=cY-This.dy;
			//获取超出长度
			var iRight=iLeft+parseInt(ThisO.innerWidth())-R, iBottom=iTop+parseInt(ThisO.innerHeight())-B;
			//alert($(window).height())
			//先设置右下，再设置左上
			if(iRight > 0) iLeft -= iRight;	
			if(iBottom > 0) iTop -= iBottom;
			if(L > iLeft) iLeft = L;
			if(T > iTop) iTop = T;
			if (options.drop) {
				tempBox.css({left:iLeft,top:iTop})
			}else {
				ThisO.css({left : iLeft,top : iTop})
			}
		}else {
			//不限制范围
			if (options.drop) {
				tempBox.css({left:cX-This.dx,top:cY-This.dy})
			}else {
				ThisO.css({left:cX-This.dx,top:cY-This.dy});
			}
		}
	}
	//拖动结束
	this.dragStop=function (e) {
		if (options.drop) {
			var flag=false;
			var cX=e.pageX;
			var cY=e.pageY;
			var oLf=ThisO.offset().left;
			var oRt=oLf+ThisO.width();
			var oTp=ThisO.offset().top;
			var oBt=oTp+ThisO.height();
			if (!(cX>oLf && cX<oRt && cY>oTp && cY<oBt)) {//如果不是在原位
				for (var i=0; i<ThatO.length; i++) {
					var XL=$(ThatO[i]).offset().left;
					var XR=XL+$(ThatO[i]).width();
					var YL=$(ThatO[i]).offset().top;
					var YR=YL+$(ThatO[i]).height();
					if (XL<cX && cX<XR && YL<cY && cY<YR) {//找到拖放目标，
						$(ThatO[i]).append(tempBox.html());
						ThisO.remove();
						$(ThatO[i]).find(".dragdiv").Drag({drop:'.dragtd',finish:change,limit:false});
/*
						var newElm=$(ThatO[i]).html();
						$(ThatO[i]).html(tempBox.html());
						ThisO.html(newElm);
						thatO=$(ThatO[i]);
						*/
						tempBox.remove();
						flag=true;
						break;//一旦找到，就终止循环
					}
				}
			}
			if (!flag) {//如果找不到拖放位置，归回原位
				tempBox.css({left:This.X,top:This.Y});
				ThisO.html(tempBox.find('.dragdiv').html());
				tempBox.remove();
			}
		}
		$(document).unbind('mousemove');
		$(document).unbind('mouseup');
		options.finish(e,ThisO,thatO);
		if ($.browser.msie) {ThisO[0].releaseCapture();}
	}
	//绑定拖动
	options.handle ? ThisO.find(options.handle).mousedown(This.dragStart) : ThisO.mousedown(This.dragStart);
	//IE禁止选中文本
	//document.body.onselectstart=function(){return false;}
}
//下面是例子
//.drag li里面的元素对应的放置位置是.drop li，完成后回调change函数，默认限制拖动范围是窗口内部

//.drag li里面的元素对应的放置位置是.drop li和.drag li（自身），完成后回调change函数，默认限制拖动范围是窗口内部
$('.dragtd .dragdiv').Drag({drop:'.dragtd',finish:change,limit:false});

var change=function (e,oldElm,newElm) {
//alert('拖动完成')
}
//-->
</script>

</html>
