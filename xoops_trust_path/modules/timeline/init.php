<?php
// $Id: init.php,v 1.1.1.1 2009/03/19 14:41:41 ohwada Exp $

//=========================================================
// timeline module
// 2009-03-15 K.OHWADA
//=========================================================

//---------------------------------------------------------
// $MY_DIRNAME is set by caller
//---------------------------------------------------------

if ( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

if ( !isset($MY_TRUST_DIRNAME) ) {
	$MY_TRUST_DIRNAME = basename( dirname( __FILE__ ) ) ;
}
if ( !defined("TIMELINE_TRUST_DIRNAME") ) {
	define("TIMELINE_TRUST_DIRNAME", $MY_TRUST_DIRNAME );
}
if ( !defined("TIMELINE_TRUST_PATH") ) {
	define("TIMELINE_TRUST_PATH", XOOPS_TRUST_PATH.'/modules/'.TIMELINE_TRUST_DIRNAME );
}

include_once TIMELINE_TRUST_PATH.'/class/base/d3/optional.php';
include_once TIMELINE_TRUST_PATH.'/class/base/d3/preload.php';
include_once TIMELINE_TRUST_PATH.'/include/optional.php';

?>