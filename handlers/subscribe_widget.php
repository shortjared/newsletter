<?php
//First check if this is form submissions if so, redirect to full registration form
if(isset($_POST['email']))
{
	$this->redirect('newsletter/subscribe?email='.$_POST['email'].'&list_id='.$_POST['list_id']);
}
//If it's not embedd widget on dynamic embed page
else
{
if(isset($data['list']))
	{
echo $tpl->render('newsletter/subscribe_widget', array(
			'list_id' => $data['list']
		));
}
else
	{
		//Something is wrong with the dynamic embed
		echo "";
	}

}


/*

	//Create API Object for Mailchimp
	require_once 'apps/newsletter/lib/MCAPI.class.php';
	$settings = parse_ini_file ('conf/newsletter.php');
	$apikey = $settings['mailchimp_api'];
	$api = new MCAPI($apikey);


	$retval = $api->listSubscribe($_POST['list_id'], $_POST['email'], array('FNAME'=>'Jared','LNAME'=>'Short'));

	if ($api->errorCode){
	echo "Unable to subscribe!";
	echo "\n\tCode=".$api->errorCode;
	echo "\n\tMsg=".$api->errorMessage."\n";
		$message = '<p>Uh oh! Something has gone wrong, you weren\'t subscrbed. <br /> <a href="/contact">Let us know!</a></p>';
	} else {
		echo "Hoorah!";
	    	$message = "<p>You have Subscribed - look for the confirmation email!</p>";
	}
*/

?>

