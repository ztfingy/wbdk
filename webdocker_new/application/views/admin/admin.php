<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=9" />
		<link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet"/>
		<link href="<?php echo base_url();?>assets/css/global.css" rel="stylesheet" />		
		<link href="<?php echo base_url();?>assets/css/admin.css" rel="stylesheet"/>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery/jquery.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery/jquery.dataTables.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery/jquery.numeric.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery/jquery.colorbox.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/admin.js"></script>
		<title></title>
	</head>
	<body>
		<div>
		
		</div>
		<div class='admin-container'>

			<div class='sidebar-div well'>

				<ul class='nav nav-list'>
					<li><a href="<?php echo site_url('admin/field_group');?>"><i class="icon-chevron-right"></i>Champ Groupes</a></li>
					<li><a href="<?php echo site_url('admin/field');?>"><i class="icon-chevron-right"></i>Champs Produit</a></li>
					<li><a href="<?php echo site_url('admin/product_accessory_field');?>"><i class="icon-chevron-right"></i>Champs Fourniture Produit</a></li>
					<li><a href="<?php echo site_url('admin/cost_field');?>"><i class="icon-chevron-right"></i>Champs Costing</a></li>
					<li><a ><i class="icon-chevron-right"></i>Taux de Change</a>
						<ul style="display:none">
							<li><a href="<?php echo site_url('admin/field_group');?>">Monnaie</a></li>
							<li><a href="<?php echo site_url('admin/field_group');?>">Liste</a></li>
						</ul>
					</li>
					<li><a href="<?php echo site_url('admin/field_group');?>"><i class="icon-chevron-right"></i>Profil d'Utilisateur</a></li>
					<li><a href="<?php echo site_url('admin/field_group');?>"><i class="icon-chevron-right"></i>Dashboard</a></li>
					<li><a href="<?php echo site_url('admin/field_group');?>"><i class="icon-chevron-right"></i>Configuration des Fichiers</a></li>
				</ul>

			</div>
			<div class='content-div'>
				<?php echo $admin_content;?>
			</div>

		</div>

	</body>
</html>
