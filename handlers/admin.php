<?php

/**
 * This is the admin interface of the Google Analytics app.
 * It shows a summary of the stats for your site.
 */

$this->require_admin ();

$page->title = 'Newsletters';
$page->layout = 'admin';

if (! file_exists ('conf/app.newsletter.' . ELEFANT_ENV . '.php')) {
	$this->redirect ('/newsletter/settings');
}

$apikey = Appconf::newsletter ('Newsletter', 'mailchimp_api');
$api = new MCAPI($apikey);

$retval = $api->lists();

if ($api->errorCode) {
	printf ('<p>%s</p>', __ ('Unable to load lists from MailChimp at this time.'));
	error_log ('[newsletter/admin] ' . $api->errorCode . ' ' . $api->errorMessage);
} else {
	echo $tpl->render ('newsletter/admin', array (
		'lists_count' => $retval['total'],
		'lists' => $retval['data'],
		'default_list' => Appconf::newsletter ('Newsletter', 'default_list')
	));
}

?>