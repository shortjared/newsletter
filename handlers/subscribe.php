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
		$message = '<p>Uh oh! Something has gone wrong, you weren\'t subscrbed. <br /> <a href="/contact">Let us know!</a></p>';

		$page->title = i18n_get ('Something Went Wrong!');
		echo $tpl->render('newsletter/complete',array('message'=>$message));

	} else {
		//Everything worked they should get an email
		$page->title = i18n_get ('Thanks for Signing Up!');
	    	$message = "<p>You have Subscribed - look for the confirmation email!</p>";
		echo $tpl->render('newsletter/complete',array('message'=>$message));
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
