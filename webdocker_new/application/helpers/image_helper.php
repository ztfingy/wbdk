<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 function scaleimage($location, $maxw=NULL, $maxh=NULL,$class=''){
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
			$id=rand();
			$cls = "";
			if ($class!='') {
				$cls = 'class="'.$class.'"';
			}
	        return "<img src='{$location}?id={$id}' width='{$w}' height='{$h}' $cls/>";
	    }
}


/* End of file image_helper.php */
/* Location: ./application/helpers/image_helper.php */