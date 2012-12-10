<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$template_conf = array(
	'template' => 'default',
	'site_name' => 'Webdocker',
	'site_title' => 'Webdocker',
	'devmode' => true,
	'content' => '',
	'css' => '',
	'js' => '',
	'head' => '',
	'messages' => '',
	'assets_dir' => 'assets/'
);

$template_css = array('colorbox','jquery-ui-1.8.2.custom','global');

$template_js = array('jquery/jquery','jquery/jquery.ui.core','jquery/jquery.ui.widget','jquery/jquery.ui.position','jquery/jquery.colorbox');

$template_head = array(
	'jquery' => '<script type="text/javascript" src="http://www.google.com/jsapi"></script>',
	'bootstrap' => '<link rel="stylesheet" href="'.base_url().'assets/css/bootstrap.css">'
);
