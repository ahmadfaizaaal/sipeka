<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Name: DOMPDF Library
* Author: dompdf
* Source: https://github.com/dompdf/dompdf
*/
require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
class Dompdf_lib extends Dompdf {
	function __construct()
	{
		parent::__construct();
	}
}