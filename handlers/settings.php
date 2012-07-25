<?php

/**
 * This is the settings form to set your Google Analytics site ID.
 * Saves the site ID to the file conf/analytics.php.
 */

$this->require_admin ();

$page->title = 'Mailchimp Newsletter API Key';
$page->layout = 'admin';

$f = new Form ('post', 'newsletter/admin');

if ($f->submit ()) {
	$_POST['open'] = '<?php';
	if (file_put_contents ('conf/newsletter.php', $tpl->render ('newsletter/conf', $_POST))) {
		$this->add_notification (i18n_get ('Settings updated.'));
		$this->redirect ('/newsletter/admin');
	} else {
		echo '<p><strong>' . i18n_get ('Failed to update settings. Please check your folder permissions and try again.') . '</strong></p>';
	}
}

$o = new StdClass;
if (file_exists ('conf/newsletter.php')) {
	$settings = parse_ini_file ('conf/newsletter.php');
	$o->site_id = $settings['mailchimp_api'];
}

$o = $f->merge_values ($o);
$o->failed = $f->failed;
echo $tpl->render ('newsletter/settings', $o);

?>
