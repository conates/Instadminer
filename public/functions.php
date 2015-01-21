<?php 
require 'config.php';

	function getData($limit = 10)
	{
		$data = R::find('instagram','ORDER BY created_time DESC limit :limit',['limit'=> $limit]);
		return R::exportAll($data);
	}

	function getDataInstagram($instagram,$tag)
	{
		$data = $instagram->getTagMedia($tag);
		return $data;
	}

	function getDataInstagramById($instagram,$id)
	{
		$data = $instagram->getMedia($id);
		
		$insta_data					= R::dispense('instagram');
		$insta_data->created_time	= $data->data->created_time;
		$insta_data->link 			= $data->data->link;
		$insta_data->images			= $data->data->images->standard_resolution->url;
		$insta_data->caption_id		= $data->data->caption->id;
		$insta_data->caption_text	= $data->data->caption->text;
		$insta_data->user_picture	= $data->data->user->profile_picture;
		$insta_data->user_id		= $data->data->user->id;
		$insta_data->username		= $data->data->user->username;
		$insta_data->full_name		= $data->data->user->full_name;

		$insta_data->media_type	= $data->data->type;
		if ($data->data->type=='image') {
			$insta_data->media_image	= $data->data->images->standard_resolution->url;
			$insta_data->media_video	= '';
		}else{
			$insta_data->media_image	= '';
			$insta_data->media_video	= $data->data->videos->standard_resolution->url;
		}
		$insta_data->visible	= "1";
		R::store($insta_data);

		return $insta_data;
	}
?>