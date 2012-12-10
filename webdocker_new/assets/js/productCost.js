$(document).ready(function(){
	

			$("#costPreviewToggle").click(function(){
				$("#previewImage").toggle();
				$s = $(this).attr("checked")?0:1;
				
				$.post("ajax/saveUserConfigInXML.php",{"name":"CostPreview","value":$s},function(){});
			});

			
			$(".ro").click(function(){
				$(this).blur();
			});


			$(".currency,.ratelist,.pv,.pa,.ca,.cb").change(function(){
				var eid = $(this).attr("id");
				var pid = getProductId(eid);
				
				var c=$("#currency_"+pid).val();
				var r=$("#ratelist_"+pid).val();
				var f=$("#fournitureTotal_"+pid).val();
				var pv=$("#pv_"+pid).val();
				var pa=$("#pa_"+pid).val();
				var ca=$("#ca_"+pid).val();
				var cb=$("#cb_"+pid).val();
				var rate = 1;
				var pr = 0;
				var tdm = 0;
				
				if(c!=''&&r!=''&&f!=''&&pv!=''&&pa!=''&&ca!=''&&cb!=''){
						getRateValue(pid);
						rate = $("#rate_"+pid).val();
						pr = pa*(1+ca/100+cb/100)/rate+f*1;
						tdm = pv/pr;
						$("#pr_"+pid).val(pr.toFixed(2));
						$("#tdm_"+pid).val(tdm.toFixed(2));
									
				}
				
			});
			
			
			$(".pa").change(function() {
				
				var eid = $(this).attr("id");
				var pid = getProductId(eid);
				
				var sims = Array("simulation1","simulation2","simulation3","simulation4");
				for(s in sims){
					getMontantIncoterm(sims[s],pid);
					getPaddu(sims[s],pid);
					getPaddueur(sims[s],pid);
					getMontantDouane(sims[s],pid);
					getPrhtValue(sims[s],pid);
					getTdm(sims[s],pid);
					getMdm(sims[s],pid);
					
				}
			});
			
			$(".currency,.ratelist").change(function() {
				var eid = $(this).attr("id");
				var pid = getProductId(eid);
				
				
				getRateValue(pid);
				var sims = Array("simulation1","simulation2","simulation3","simulation4");
				for(s in sims){
					getPaddueur(sims[s],pid);
					getMontantDouane(sims[s],pid);
					getPrhtValue(sims[s],pid);
					getTdm(sims[s],pid);
					getMdm(sims[s],pid);
				}
			});
			
			$(".ca,.cb").change(function(){
				var eid = $(this).attr("id");
				var pid = getProductId(eid);
				
				var sims = Array("simulation1","simulation2","simulation3","simulation4");
				for(s in sims){
					getPrhtValue(sims[s],pid);
					getTdm(sims[s],pid);
					getMdm(sims[s],pid);
				}
			});
			
			
			
			
			
			$(".costLocation").change(function() {
				
				var l = $(this).attr("name");
				var lnum = 0;
				var lid = $(this).attr("id");
				var lidarray = lid.split("_");
				var s = lidarray[0];
				var p = lidarray[2];

				var lvalue = $(this).val();
				
				switch(l){
					case "country":
					lnum=1;
					break;
					
					case "city":
					lnum=2;
					break;
					
					case "factory":
					lnum=3;
					break;
		
				}
				$.post("ajax/getSubCostLocation.php",{"lnum":lnum,"lvalue":lvalue},function(data){
					switch(l){
					case "country":
					$("#"+s+"_city_"+p).html(data);
					break;
					
					case "city":
					$("#"+s+"_factory_"+p).html(data);
					break;
					
					case "factory":
					$("#"+s+"_agent_"+p).html(data);
					break;
					
				}
				});
				
			});
			
			
			
			$(".incoterms").change(function() {
				var iid = $(this).attr("id");
				var sn = getSimulationName(iid);
				var pid = getSimProductId(iid);
				
				getIncotermValue(sn,pid);
				getMontantIncoterm(sn,pid);
				getPaddu(sn,pid);
				getPaddueur(sn,pid);
				getPrhtValue(sn,pid);
				getTdm(sn,pid);
				getMdm(sn,pid);
			});
			
			
			$(".douanes").change(function() {
				var did = $(this).attr("id");
				var sn = getSimulationName(did);
				var pid = getSimProductId(did);
				
				
				getDouaneValue(sn,pid);
				getMontantDouane(sn,pid);
				getPrhtValue(sn,pid);
				getTdm(sn,pid);
				getMdm(sn,pid);
			});
			
			
			$(".savecost").click(function(){

				$(".simulationTable").each(function(){
					var prefix = $(this).attr("id");
					var pid= $("#productId").val();
					var pv = $("#"+prefix+"_pv").val();
					var factory = $("#"+prefix+"_factory").val();
					var inco = $("#"+prefix+"_inco").val();
					var coef = $("#"+prefix+"_coef").val();
					var pafob = $("#"+prefix+"_pafob").val();
					var trans = $("#"+prefix+"_trans").val();
					var pricepc = $("#"+prefix+"_pricepc").val();
					var paddu = $("#"+prefix+"_paddu").val();
					var prddu = $("#"+prefix+"_prddu").val();
					var tdm = $("#"+prefix+"_tdm").val();
					var note = $("#"+prefix+"_note").val();
					var dataarray = {sid:prefix,pid:pid,pv:pv,factory:factory,inco:inco,coef:coef,pafob:pafob,trans:trans,pricepc:pricepc,paddu:paddu,prddu:prddu,tdm:tdm,note:note};
					
					$.ajax({
						type:"POST",
						url:"ajax/saveSimulationCost.php",
						async:false,
						data:dataarray,
						success:function(data){
									
						}
					});
					
				});
				
				
				$("#form").submit();
			});

			

			$(".currency").change(function(){
				var eid = $(this).attr("id");
				var pid = getProductId(eid);
				
				var cunit = $(this).val();
				$("#paunit_"+pid).html(cunit);
				$(".paunits_"+pid).each(function(){
					$(this).html(cunit);
				});
			});


			$(".rateListDetail").mouseover(function(){
				var eid = $(this).attr("id");
				var pid = getProductId(eid);
				
				var rid = $(this).prev("select").val();
				var p = $(this).position();
				if(rid!=''){
					$.post("ajax/getRateList.php",{rid:rid},function(data){
						$("#ratelistdiv").html(data);
						$("#ratelistdiv").css("left",p.left-80);
						$("#ratelistdiv").css("top",p.top+16);
						$("#ratelistdiv").css("width","60px");
						$("#ratelistdiv").show();						
					});
				}
			});
			$(".rateListDetail").mouseout(function(){
				$("#ratelistdiv").hide();
			});

			$(".quantity").change(function(){
				var eid = $(this).attr("id");
				var pid = getProductId(eid);
				getPalPamValue(pid);
			});	
			
			$(".simulationToggle").click(function(){
				var img = $(this);
				var sid = $(this).attr("alt");
				if(img.attr("src")=='images/plus.png'){
					img.attr("src","images/minus.png");
				}else{
					img.attr("src","images/plus.png");
				}
				
				$("#"+sid).toggle();
				
			});
						
		function getSimulationName(elementId){
			var lidarray = elementId.split("_");
			var s = lidarray[0];
			return s;
		}	
		
		function getProductId(elementId){
			var lidarray = elementId.split("_");
			var p = lidarray[1];
			return p;
		}
		
		function getSimProductId(elementId){
			var lidarray = elementId.split("_");
			var p = lidarray[2];
			return p;
		}
		
		function getMontantIncoterm(s,p){
			var pa = $("#pa_"+p).val();
			var incotermvalue = $("#"+s+"_coefficient_"+p).val();
			
			if(pa!=''&&incotermvalue!=''){
				var montant = pa*(incotermvalue-1);
				$("#"+s+"_montantIncoterm_"+p).val(montant.toFixed(2));
			}
			
		}
		

		function getIncotermValue(s,p){
			var iid = $("#"+s+"_incoterm_"+p).val();
			if(iid==''){
				$("#"+s+"_coefficient").val('');
			}else{
				$.ajax({
				type:"POST",
				url:"ajax/getIncotermValue.php",
				async:false,
				data:{"iid":iid},
				success:function(data){			
					$("#"+s+"_coefficient_"+p).val(data);	
					}
				});

			}
		}
		
		
		function getPaddu(s,p){
			var pa = $("#pa_"+p).val();
			var mntinco = $("#"+s+"_montantIncoterm_"+p).val();
			if(pa!=''&&mntinco!=''){
				var paddu = pa*1+mntinco*1;
				$("#"+s+"_paddu_"+p).val(paddu.toFixed(2));
			}
			
		}
		
		function getPaddueur(s,p){
			var rate = getRate(p);
			var paddu = $("#"+s+"_paddu_"+p).val();
			if(paddu!=''){
				var paddueur = paddu/rate;
				$("#"+s+"_paddueur_"+p).val(paddueur.toFixed(2));
			}
			
		}
		
		function getDouaneValue(s,p){
			var did = $("#"+s+"_douane_"+p).val();
			if(did==''){
				$("#"+s+"_douaneValue_"+p).val('');
			}else{
				$.ajax({
				type:"POST",
				url:"ajax/getDouaneValue.php",
				async:false,
				data:{"did":did},
				success:function(data){			
					$("#"+s+"_douaneValue_"+p).val(data);
					}
				});

				
			}
		}
		
		function getMontantDouane(s,p){
			var pa = $("#pa_"+p).val();
			var douanevalue = $("#"+s+"_douaneValue_"+p).val();
			var rate = getRate(p);
			if(pa!=''&&douanevalue!=''&&rate!=''){
				var montant = pa*(douanevalue-1)/rate;			
				$("#"+s+"_montantDouane_"+p).val(montant.toFixed(2));
			}
			
		}
		
		function getPrhtValue(s,p){
			var paddueur = $("#"+s+"_paddueur_"+p).val();
			var ca=$("#ca_"+p).val();
			var cb=$("#cb_"+p).val();
			var montantdouane = $("#"+s+"_montantDouane_"+p).val();
			var fourtotal = $("#fournitureTotal_"+p).val();
			if(paddueur!=''&&ca!=''&&cb!=''&&montantdouane!=''){
				var prht = paddueur*(1+ca/100+cb/100)+parseFloat(montantdouane)+parseFloat(fourtotal);
				$("#"+s+"_prht_"+p).val(prht.toFixed(2));
			}
			
		}
		
		function getTdm(s,p){
			var pv=$("#pv_"+p).val();
			var prht = $("#"+s+"_prht_"+p).val();
			if(pv!=''&&prht!=''){
				var tdm = pv/prht;
				$("#"+s+"_tdm_"+p).val(tdm.toFixed(2));
			}
			
		}
		
		function getMdm(s,p){
			var pv=$("#pv_"+p).val();
			var prht = $("#"+s+"_prht_"+p).val();
			if(pv!=''&&prht!=''){
				var mdm = pv*1-prht;
				$("#"+s+"_mdm_"+p).val(mdm.toFixed(2));
			}
		}
		
		
		function getRate(p){			
			var rate = $("#rate_"+p).val();
			return rate;
		}
		
		
		function getRateValue(p){
			var c=$("#currency_"+p).val();
			var r=$("#ratelist_"+p).val();
			var rate = 1;
			if(c!=''&&r!=''){
				$.ajax({
				type:"POST",
				url:"ajax/getRate.php",
				async:false,
				data:{"rid":r,"c":c},
				success:function(data){			
					rate = data;
					$("#rate_"+p).val(rate);
					}
				});

			}			
		}
		
		
		
	
});
-
		
		
		

		
		
		
		
		
		function comparepaddu(){
			var paless=$(".paddus").first().val();
			var pamore=$(".paddus").first().val();
			$(".paddus").each(function(){
				if($(this).val()<paless){
					paless =$(this).val();
				}
				if($(this).val()>pamore){
					pamore =$(this).val();
				}
			});
			$("#paless").val(paless);
			$("#pamore").val(pamore);
			getPalPamValue();
		}
		function getPalPamValue(){
			var q = $("#quantity").val();
			var pal =  $("#paless").val();
			var pam =  $("#pamore").val();
			if(q!=''&&pal!=''&&pam!=''){
				$("#montantless").val(pal*q);
				$("#montantmore").val(pam*q);
				getTdeValue();
				getMdeValue();
			}
		}


		function getSimulationPrdduValue(e){
			//e1 = coefficient  , paddu
			
			var prefix = e.attr("id").split("_");
			var paddu = $("#"+prefix[0]+"_paddu").val();
			var coef = $("#"+prefix[0]+"_coef").val();
			var cuvalue = $("#currency").val();
			var rlvalue = $("#ratelist").val();
			if(coef!=''&&cuvalue!=''&&rlvalue!=''&&paddu!=''){
				$.post("ajax/getPrValue.php",{co:coef,cu:cuvalue,rl:rlvalue,pa:paddu},function(data){
					$("#"+prefix[0]+"_prddu").val(data);
				});
				getSimulationTdmValue(e);
			}
		}

		function getSimulationTdmValue(e){
			//e1 = coefficient  , paddu
			
			var prefix = e.attr("id").split("_");
			var pv = $("#"+prefix[0]+"_pv").val();
			var prddu = $("#"+prefix[0]+"_prddu").val();
			if(prddu!=''&&pv!=''){				
				$("#"+prefix[0]+"_tdm").val(pv/prddu);				
			}
		}

		function getMdeValue(){
			var montantlessvalue = $("#montantless").val();
			var montantmorevalue = $("#montantmore").val();
			if(montantlessvalue!=''&&montantmorevalue!=''){
				$("#mde").val(montantmorevalue-montantlessvalue);
			}
		}

		function getTdeValue(){
			var montantlessvalue = $("#montantless").val();
			var montantmorevalue = $("#montantmore").val();
			if(montantlessvalue!=''&&montantmorevalue!=''){
				$("#tde").val((montantmorevalue-montantlessvalue)/montantlessvalue);
			}
		}



