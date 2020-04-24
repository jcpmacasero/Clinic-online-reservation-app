<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Googleplus {
	public function __construct() {
		require_once realpath(dirname(__FILE__).'/googleplus/src/Google/autoload.php');
	}
}