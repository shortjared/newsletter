<?php

$page->title = i18n_get ('Thanks for Signing Up!');
$message = "<p>You have Subscribed - look for the confirmation email!</p>";
echo $tpl->render('newsletter/complete',array('message'=>$message));

?>
