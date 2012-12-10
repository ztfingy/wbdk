<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<link href="<?php echo base_url();?>assets/css/global.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet"/>
<script type="text/javascript">
	
</script>
<title>Login</title>
</head>
<body>
	<div id="webdocker_logo">
		<img src="<?php echo base_url();?>assets/images/logo_webdocker.png" alt="" />
	</div>
	<div id="login_form" >

		<?php 
		$attributes = array('class' => 'well', 'id' => 'loginform');
		echo form_open('authentication/submit',$attributes); ?>
		
		
		
		<p>
		
		<label for="username">Username: </label>
		
		<?php 
			$attributes = array(
					'name'	=>'username',
					'id'	=>'username',
					'class'	=>'input-medium',
					'value' =>set_value('username')
			);
		echo form_input($attributes); ?>
		
		</p>
		
		<p>
		
		<label for="password">Password: </label>
		
		<?php 
			$attributes = array(
					'name'	=>'password',
					'id'	=>'password',
					'class'	=>'input-medium'
			);
		echo form_password($attributes); ?>
		
		</p>
		<?php echo validation_errors('<p class="error">','</p>'); ?>
		<p>
		
		<?php 
			$attributes = array(
					'name'	=>'submit',
					'class'	=>'btn',
					'value'	=>'Login'
			);
		echo form_submit('submit','Login'); ?>
		
		</p>
		
		<?php echo form_close(); ?>

	</div>
</body>
</html>

