	<pre>
		<?php print_r($_SESSION);?>
		<?php 
			var_dump($this->session->userdata('all_products'));
		?>
	</pre>
	<br />
	<div id="welcomeSMS" class="welcomeBlock">          
		<div class="welcomeBlockTitle" style="background-image: url(<?php echo base_url();?>assets/images/Logo_vosSms3.png); ">Vos SMS(0)</div>
        <br />
        <div id='recent_sms'>
        	<img alt="" src="<?php echo base_url();?>assets/images/loading.gif" class='loading_img'/>
        	       	
        </div>
        <?php echo anchor('sms/received','read more...');?>
	</div>
	<br />
	
	<div id="welcomeOProduct" class="welcomeBlock">
		<div class="welcomeBlockTitle" style="background-image:url(<?php echo base_url();?>assets/images/LastprodVisite.png); ">Derniers produits visite</div>	
        <br />
        <div id='recent_visit'>
        	<img alt="" src="<?php echo base_url();?>assets/images/loading.gif" class='loading_img'/>
        </div>
        <?php echo anchor('sms/received','read more...');?>
    </div>
    <br />
			
    <div id="welcomeNProduct" class="welcomeBlock" >           
		<div class="welcomeBlockTitle" style="background-image:url(<?php echo base_url();?>assets/images/Newprod.png); ">New product </div>
        <br />
        <div id='recent_product'>
        	<img alt="" src="<?php echo base_url();?>assets/images/loading.gif" class='loading_img'/>
        </div>
        <?php echo anchor('sms/received','read more...');?>
    </div>
  	<br />
			
			
			                                                 <!-- Revision -->
			                                                 
    <div id="welcomeRevision" class="welcomeBlock">
       <div class="welcomeBlockTitle" style="background-image:url(<?php echo base_url();?>assets/images/Revision3.png); ">Revision </div>
       <br />
       <div id='recent_revision'>
       		<img alt="" src="<?php echo base_url();?>assets/images/loading.gif" class='loading_img'/>
       </div>
       <?php echo anchor('sms/received','read more...');?>
    </div>
	<br />		
												<!-- product validation -->
			                                                 
    <div id="welcomeValidate" class="welcomeBlock">
        <div class="welcomeBlockTitle" style="background-image:url(<?php echo base_url();?>assets/images/LastprodValid.png); ">Product validation </div>
        <br />
        <div id='recent_product_validation'>
        	<img alt="" src="<?php echo base_url();?>assets/images/loading.gif" class='loading_img'/>
        </div>   
        <?php echo anchor('sms/received','read more...');?>
	</div>
	<br />		
			
			
															<!-- group validation -->
			                                                 
    <div id="welcomeValidate" class="welcomeBlock">
		<div class="welcomeBlockTitle" style="background-image:url(<?php echo base_url();?>assets/images/LastprodValid.png); ">Group validation </div>
        <br />
        <div id='recent_group_validation'>
        	<img alt="" src="<?php echo base_url();?>assets/images/loading.gif" class='loading_img'/>
        </div>  
        <?php echo anchor('sms/received','read more...');?> 
	</div>
	<br/>		
						
															<!-- date alert -->
			                                                 
    <div id="welcomeDate" class="welcomeBlock" >
        <div class="welcomeBlockTitle" style="background-image:url(<?php echo base_url();?>assets/images/LastprodValid.png); ">Alerts </div>
        <br />
        <div id='recent_alert'>
        	<img alt="" src="<?php echo base_url();?>assets/images/loading.gif" class='loading_img'/>
        </div>
        <?php echo anchor('sms/received','read more...');?>
    </div>

