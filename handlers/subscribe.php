<?php

$f = new Form ('post', 'newsletter/subscribe');

$f->verify_csrf = false;
if ($f->submit ()) {
	
	//Setup Mailchimp API
	require_once 'apps/newsletter/lib/MCAPI.class.php';
	$settings = parse_ini_file ('conf/newsletter.php');
	$apikey = $settings['mailchimp_api'];
	$api = new MCAPI($apikey);


	//Perform Mailchimp API Call
	$retval = $api->listSubscribe($_POST['list_id'], $_POST['email'], array('FNAME'=>'Jared','LNAME'=>'Short'));


if ($api->errorCode){
		//If something broke (API)
		$this->redirect('newsletter/failure');
	} else {
		//Everything worked they should get an email
		$this->redirect('newsletter/success');
	}


} else {
	//Form hasn't been submitted yet.
	$page->title = i18n_get ('Subscribe to the Newsletter');
	echo $tpl->render ('newsletter/subscribe', array(
		'email' => $_GET['email'],
		'list_id' =>$_GET['list_id']
	));
}

?>
