<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function preview_url($uri = '')
{
	$CI =& get_instance();
	return $CI->config->preview_url($uri);
}


/* End of file MY_url_helper.php */
/* Location: ./application/helpers/MY_url_helper.php */