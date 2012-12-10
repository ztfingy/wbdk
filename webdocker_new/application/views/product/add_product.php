<!DOCTYPE div PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
	var base_url='<?php echo base_url();?>';
</script>
<script type="text/javascript" src='<?php echo base_url()?>assets/js/jquery/jquery.js?<?php echo time();?>'></script>
<script type="text/javascript" src='<?php echo base_url()?>assets/js/jquery/jquery.colorbox.js?<?php echo time();?>'></script>
<script type="text/javascript" src='<?php echo base_url()?>assets/js/jquery/json_parse.js?<?php echo time();?>'></script>
<script type="text/javascript" src='<?php echo base_url()?>assets/js/jquery/json2.js?<?php echo time();?>'></script>
<script type="text/javascript" src='<?php echo base_url()?>assets/js/global.js?<?php echo time();?>'></script>
<link href="<?php echo base_url()?>assets/css/bootstrap.css" rel="stylesheet"/>
<link href="<?php echo base_url()?>assets/css/global.css" rel="stylesheet"/>
</head>
<body>
<span>Nom de Nouveau <?php echo $product_type;?>:</span>
<input type="hidden" id='new_product_type' value='<?php echo $type;?>'/>
<div class="input-append">
  <input class="span2" id="new_product_name" type="text">
  <button class="btn" type="button" id='save_basic_info' >OK</button>
</div>

</body>
</html>
