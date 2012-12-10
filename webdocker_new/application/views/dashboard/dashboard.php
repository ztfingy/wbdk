<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<title>CDESIGN Webdocker Dashboard</title>
<script type="text/javascript">
	var base_url = '<?php echo base_url();?>';
	var site_url = '<?php echo base_url();?>index.php/';
	var preview_url = '<?php echo preview_url();?>';
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery/jquery.js" ></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/dashboard.css">
<link href="" rel="stylesheet" type="text/css" />	
</head>
<body>
<div id='dashboard_header'>
	<table class='dashboard_header_table'>
		<tr>
			<td id='dashboard_title_td'>
				<div id="dashboard_title" align="center" ><span onclick="setTitle();">click here to add a title</span></div>
				<div align="center"><span class="Style4">Made with C-DESIGN Fashion &reg;</span><br />			
			</td>
			<?php if(file_exists(APPPATH.'upload/enterprise_logo.jpg')):?>
			<td id='dashboard_logo_td'>
				<div id='dashboard_enterprise_logo'>
					<img alt="" src="<?php echo scaleimage(base_url().'assets/upload/enterprise_logo.jpg',550,60); ?>">
				</div>
			</td>
			<?php endif;?>
		</tr>
	</table>
</div>
<div id='dashboard_content'>
	<?php echo $dashboard_content;?>
</div>
</body>
</html>