<?php

/**
 * This is the settings form for the newsletter app.
 */

$this->require_admin ();

require_once ('apps/newsletter/lib/Functions.php');

$page->title = 'Newsletters - Settings';
$page->layout = 'admin';

$form = new Form ('post', $this);

$form->data = array (
	'title' => Appconf::newsletter ('Newsletter', 'title'),
	'mailchimp_api' => Appconf::newsletter ('Newsletter', 'mailchimp_api'),
	'default_list' => Appconf::newsletter ('Newsletter', 'default_list')
);

echo $form->handle (function ($form) {
	if (empty ($_POST['default_list'])) {
		$lists = newsletter_raw_lists ($_POST['mailchimp_api']);
		if (count ($lists) > 0) {
			$_POST['default_list'] = $lists[0]['id'];
		}
	}

	$merged = Appconf::merge ('newsletter', array (
		'Newsletter' => array (
			'title' => $_POST['title'],
			'mailchimp_api' => $_POST['mailchimp_api'],
			'default_list' => $_POST['default_list']
		)
	));
	
	if (! Ini::write ($merged, 'conf/app.newsletter.' . ELEFANT_ENV . '.php')) {
		printf (
			'<p>%s</p>',
			__ ('Unable to save changes. Check your permissions and try again.')
		);
		return;
	}
	
	$form->controller->add_notification (__ ('Settings saved.'));
	$form->controller->redirect ('/newsletter/admin');
});

?>