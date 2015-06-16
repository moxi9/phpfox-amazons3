<?php

// Check if CDN is enabled
if (setting('cdn_enabled')) {
	// Attach an event to the CDN bootloader to our Model
	new Core\Event([
		'lib_phpfox_cdn' => 'Apps\PHPfox_AmazonS3\Model\CDN'
	]);
}