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

?>

