<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('dd'))
{
	function dd($param) {
		echo "<pre>";
		print_r($param);
		exit();
	}

	function dump($param) {
		echo "<pre>";
		var_dump($param);
		exit();
	}
}