<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<title><?php echo $site_title;?></title>
<script type="text/javascript">
	var base_url = '<?php echo base_url();?>';
	var site_url = '<?php echo base_url();?>index.php/';
	var preview_url = '<?php echo preview_url();?>';
</script>
<?php echo $head;?>
<?php echo $css;?>
<?php echo $js;?>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body>
	<div id="main">
	<div id="content_header">
		<div id="welcomeuser"> 
        	<b><?php echo $this->session->userdata('username');?></b><a href="<?php echo site_url('authentication/logout');?>"><img src="<?php echo base_url();?>assets/images/webdocker_03.png" alt="Disconnect" /></a><br/>           
            
        </div>
		<div id="toolbar"> 
			<ul id='toolbar-ul'>
            	<li class='toolbar-item'><img class="imgbtn img_mouse_over" src="<?php echo base_url();?>assets/images/webdocker_11.png" alt="Precedent" onclick="javascript:history.go(-1)" /></li>
                <li class='toolbar-item'><img class="imgbtn img_mouse_over" src="<?php echo base_url();?>assets/images/webdocker_13.png" alt="Prochain" onclick="javascript:history.go(1)" /></li>
                <li class='toolbar-item'><img class="imgbtn img_mouse_over" src="<?php echo base_url();?>assets/images/webdocker_15.png" alt="Actualiser" onclick="javascript:location.reload(true)" /></li>
                <li class='toolbar-item'><img class="imgbtn img_mouse_over" src="<?php echo base_url();?>assets/images/webdocker_17.png" alt="Accueil" onclick="location='<?php echo site_url('');?>'" /></li>
                <li class='toolbar-item'><img class="imgbtn img_mouse_over" src="<?php echo base_url();?>assets/images/webdocker_19.png" alt="Envoyer par Email" /></li>
                <li class='toolbar-item' id='toolbar-sms'><a href="<?php echo site_url('sms/received');?>"><img class="imgbtn img_mouse_over" src="<?php echo base_url();?>assets/images/sms_empty.png" alt="SMS" id='header_sms_img' /><span id='sms_count'></span></a>
                	<ul id='sms-list-ul'>
                		<li class='sms-list-item'><a href='#'>read</a></li>
                		<li class='sms-list-item'><a href='#'>new</a></li>
                	</ul>
                </li>
                <li class='toolbar-item'><img class="imgbtn img_mouse_over" src="<?php echo base_url();?>assets/images/webdocker_21.png" alt="Administration" <?php if($this->session->userdata('group_role')=='administrator'||$this->session->userdata('group_role')=='power'){ echo "onclick='administration()'";}?>/> </li>
            </ul>
        </div> 
   
        <div id="tabs">
            <ul>
                <li id="editList"><a>Nouveau</a></li>
                <li id="searchList"><a>Rechercher</a></li>
                <li><a href='<?php echo site_url('product/merchandise') ?>'>Merchandising</a></li>
            </ul>
        </div>
        <div id="itemLists">
        	<div id="editItemList">
        	    <a class='colorbox_new_product' href="<?php echo site_url('product/add/product') ?>"><img class="imgbtn img_mouse_over" src="<?php echo base_url();?>assets/images/webdocker_38.png" /></a>
                <a class='colorbox_new_product' href="<?php echo site_url('product/add/accessory') ?>"><img class="imgbtn img_mouse_over" src="<?php echo base_url();?>assets/images/webdocker_40.png" /></a>
                <img class="imgbtn img_mouse_over" src="<?php echo base_url();?>assets/images/webdocker_38.png" />
                <img class="imgbtn img_mouse_over" src="<?php echo base_url();?>assets/images/webdocker_40.png" />
        	</div>
        	<div id="searchItemList">
        		<a href="<?php echo site_url('product/search/product') ?>"><img class="imgbtn img_mouse_over" src="<?php echo base_url();?>assets/images/webdocker_38.png" /></a>
                <a href="<?php echo site_url('product/search/accessory') ?>"><img class="imgbtn img_mouse_over" src="<?php echo base_url();?>assets/images/webdocker_40.png"/></a>
        	</div>
        </div>
	</div>
	<div id="content_body">