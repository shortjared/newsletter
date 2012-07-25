<?php

/**
 * This is the admin interface of the Google Analytics app.
 * It shows a summary of the stats for your site.
 */

$this->require_admin ();

$page->title = 'Newsletter';
$page->layout = 'admin';

if (! @file_exists ('conf/newsletter.php')) {
	$this->redirect ('/newsletter/settings');
}

require_once 'apps/newsletter/lib/MCAPI.class.php';


$settings = parse_ini_file ('conf/newsletter.php');
$apikey = $settings['mailchimp_api'];

$api = new MCAPI($apikey);

$retval = $api->lists();

if ($api->errorCode){
	echo "Unable to load lists()!";
	echo "\n\tCode=".$api->errorCode;
	echo "\n\tMsg=".$api->errorMessage."\n";
} else {

	echo $tpl->render ('newsletter/admin', array(
	'lists_count' => $retval['total'],
	'lists' => $retval['data'],
));

}



?>
