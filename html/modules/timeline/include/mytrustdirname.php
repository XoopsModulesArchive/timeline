<?php
// $Id: mytrustdirname.php,v 1.1.1.1 2009/03/19 14:42:23 ohwada Exp $

//=========================================================
// timeline module
// 2009-03-15 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// main
//=========================================================
$GLOBALS['MY_DIRNAME'] = $MY_DIRNAME;

$MY_TRUST_DIRNAME = 'timeline' ;

// xoops_virsion.php call many times
if ( !defined("TIMELINE_TIME_START") ) {
	list($usec, $sec) = explode(" ",microtime()); 
	$time = floatval($sec) + floatval($usec); 
	define("TIMELINE_TIME_START", $time );
}
if ( !defined("TIMELINE_TRUST_DIRNAME") ) {
	define("TIMELINE_TRUST_DIRNAME", $MY_TRUST_DIRNAME );
}
if ( !defined("TIMELINE_TRUST_PATH") ) {
	define("TIMELINE_TRUST_PATH", XOOPS_TRUST_PATH.'/modules/'.TIMELINE_TRUST_DIRNAME );
}

?>