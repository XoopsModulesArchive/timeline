<?php
// $Id: main.php,v 1.1.1.1 2009/03/19 14:41:41 ohwada Exp $

//=========================================================
// timeline module
// 2009-03-15 K.OHWADA
//=========================================================

//---------------------------------------------------------
// $MY_DIRNAME is set by caller
//---------------------------------------------------------

if ( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//---------------------------------------------------------
// timeline files
//---------------------------------------------------------
include_once XOOPS_TRUST_PATH.'/modules/timeline/init.php';

if( !defined("TIMELINE_DIRNAME") ) {
	  define("TIMELINE_DIRNAME", $MY_DIRNAME );
}
if( !defined("TIMELINE_ROOT_PATH") ) {
	  define("TIMELINE_ROOT_PATH", XOOPS_ROOT_PATH.'/modules/'.TIMELINE_DIRNAME );
}

timeline_include_once( 'preload/debug.php' );

// fork each pages
$TIMELINE_FCT       = timeline_fct() ;
$file_trust_fct   = TIMELINE_TRUST_PATH .'/main/'. $TIMELINE_FCT .'.php' ;
$file_root_fct    = TIMELINE_ROOT_PATH  .'/main/'. $TIMELINE_FCT .'.php' ;
$file_trust_index = TIMELINE_TRUST_PATH .'/main/index.php' ;
$file_root_index  = TIMELINE_ROOT_PATH  .'/main/index.php' ;

if ( file_exists( $file_root_fct ) ) {
	timeline_debug_msg( $file_root_fct );
	include_once $file_root_fct;

} elseif ( file_exists( $file_trust_fct ) ) {
	timeline_debug_msg( $file_trust_fct );
	include_once $file_trust_fct;

} elseif ( file_exists( $file_root_index ) ) {
	timeline_debug_msg( $file_root_index );
	include_once $file_root_index;

} elseif ( file_exists( $file_trust_index ) ) {
	timeline_debug_msg( $file_trust_index );
	include_once $file_trust_index;

} else {
	die( 'wrong request' ) ;
}

?>