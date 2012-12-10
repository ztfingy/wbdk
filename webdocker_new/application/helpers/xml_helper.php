<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function new_configxml() {
	$xml = "<?xml version='1.0' encoding='utf-8'?><config></config>";
	$adminconfig = simplexml_load_string($xml);
	$adminconfig->asXML(APPPATH."xml/config.xml");
}


function update_configxml($k,$v) {
	$configArray = get_array_configxml();
	$configArray[$k]=$v;
	$xml = "<?xml version='1.0' encoding='utf-8'?><config>";
	foreach ($configArray as $key => $value) {
 		$xml.="<{$key}>{$value}</{$key}>";
	}
	$xml .= "</config>";
	$adminconfig = simplexml_load_string($xml);
	$adminconfig->asXML(APPPATH."xml/config.xml");
}

function get_array_configxml() {
	$filelink = APPPATH.'xml/config.xml';
	$configArray = array();
	if (file_exists($filelink))
	{
	  $xml = simplexml_load_file($filelink);
	  
	  foreach($xml->children() as $child)
	  {
	  	$configArray[strval($child->getName())] = strval($child);
	  }
	  
	  return $configArray;
	}else{
		new_configxml();
		$configArray = array();
		return $configArray;
	}
}