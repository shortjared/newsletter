<?php


$message = '<p>Uh oh! Something has gone wrong, you weren\'t subscrbed. <br /> <a href="/contact">Let us know!</a></p>';

$page->title = i18n_get ('Something Went Wrong!');
echo $tpl->render('newsletter/complete',array('message'=>$message));

?>
