<?php

if (setting('cdn_enabled')) {
	new Core\Event([
		'lib_phpfox_cdn' => 'Apps\Moxi9\AmazonS3\Model\CDN'
	]);
}