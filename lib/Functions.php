<?php

require_once 'MCAPI.class.php';



function list_names () {
	$settings = parse_ini_file ('conf/newsletter.php');
	$apikey = $settings['mailchimp_api'];
	$api = new MCAPI($apikey);
	$retval = $api->lists();
	$lists = $retval['data'];

	$retarr[] = (object) array(
			'key' => 0,
			'value' => "-- Please Select List --"
		);


	foreach($lists as $list)
	{
		$retarr[] = (object) array(
			'key' => $list['id'],
			'value' => $list['name']
		);
	}

	return $retarr;
}





?>
