<?php
// $Id: optional.php,v 1.1.1.1 2009/03/19 14:41:41 ohwada Exp $

//=========================================================
// timeline module
// 2009-03-15 K.OHWADA
//=========================================================

if ( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// optional functions
// do not replace this file
//=========================================================
function timeline_fct()
{
	$d3_class =& timeline_base_d3_optional::getInstance();
	return $d3_class->get_fct();
}

function timeline_include_once_trust( $file, $debug=true )
{
	$d3_class =& timeline_base_d3_optional::getInstance();
	$d3_class->init_trust( TIMELINE_TRUST_DIRNAME );
	return $d3_class->include_once_trust_file( $file, $debug );
}

function timeline_include_once( $file, $dirname=null, $debug=true )
{
	$d3_class =& timeline_base_d3_optional::getInstance();
	$d3_class->init( timeline_get_dirname( $dirname ), TIMELINE_TRUST_DIRNAME );
	return $d3_class->include_once_file( $file, $debug );
}

function timeline_include_once_language( $file, $dirname=null, $language=null )
{
	$d3_class =& timeline_base_d3_optional::getInstance();
	$d3_class->init( timeline_get_dirname( $dirname ), TIMELINE_TRUST_DIRNAME );
	return $d3_class->include_once_language( $file );
}

function timeline_include_language( $file, $dirname=null, $language=null )
{
	$d3_class =& timeline_base_d3_optional::getInstance();
	$d3_class->init( timeline_get_dirname( $dirname ), TIMELINE_TRUST_DIRNAME );
	return $d3_class->include_language( $file );
}

function timeline_debug_msg( $file, $dirname=null )
{
	$d3_class =& timeline_base_d3_optional::getInstance();
	$d3_class->init( timeline_get_dirname( $dirname ), TIMELINE_TRUST_DIRNAME );
	return $d3_class->debug_msg_include_file( $file );
}

function timeline_include_once_preload( $dirname=null )
{
	$preload_class =& timeline_base_d3_preload::getInstance();
	$preload_class->init( timeline_get_dirname( $dirname ), TIMELINE_TRUST_DIRNAME );
	return $preload_class->include_once_preload_files();
}

function timeline_include_once_preload_trust()
{
	$preload_class =& timeline_base_d3_preload::getInstance();
	$preload_class->init_trust( TIMELINE_TRUST_DIRNAME );
	return $preload_class->include_once_preload_trust_files();
}

function timeline_get_dirname( $dirname )
{
	if ( ! defined("TIMELINE_TRUST_DIRNAME") ) {
//		debug_print_backtrace();
		die( 'not permit' );
	}

	if ( empty($dirname) ) {
		if ( defined("TIMELINE_DIRNAME") ) {
			$dirname = TIMELINE_DIRNAME ;
		} else {
//			debug_print_backtrace();
			die( 'not permit' );
		}
	}

	return $dirname;
}

?>