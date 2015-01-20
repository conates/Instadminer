<?php 
require 'config.php';



function getDataInstagram($instagram,$tag)
{
	$data = $instagram->getTagMedia($tag);
	return $data;
}
?>