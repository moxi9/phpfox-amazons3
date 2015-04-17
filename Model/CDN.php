<?php

namespace Apps\Moxi9\AmazonS3\Model;

class CDN extends \Core\CDN {

	/**
	 * @var \S3
	 */
	private $_obj;

	private $_bucket;

	public function __construct() {
		$this->_obj = new \S3(setting('cdn_amazon_id'), setting('cdn_amazon_secret'));
		$this->_bucket = setting('cdn_bucket');
	}

	public function getUrl($path) {
		if (!setting('cdn_enabled')) {
			return $path;
		}

		$url = 'https://s3.amazonaws.com/' . $this->_bucket . '/';
		$path = str_replace(\Phpfox::getParam('core.path'), $url, $path);

		return $path;
	}

	public function put($file, $name = null) {
		if (empty($name)) {
			$name = str_replace("\\", '/', str_replace(PHPFOX_DIR, '', $file));
		}
		return $this->_obj->putObjectFile($file, $this->_bucket, $name, \S3::ACL_PUBLIC_READ);
	}

	public function getServerId() {
		if (!setting('cdn_enabled')) {
			return 0;
		}

		return 1;
	}

	public function __returnObject() {
		return $this;
	}
}