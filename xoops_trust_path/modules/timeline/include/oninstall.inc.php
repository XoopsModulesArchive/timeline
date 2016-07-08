<?php
// $Id: oninstall.inc.php,v 1.1 2009/03/19 15:31:31 ohwada Exp $

//=========================================================
// timeline module
// 2009-03-15 K.OHWADA
//=========================================================

//---------------------------------------------------------
// $MY_DIRNAME is set by caller
//---------------------------------------------------------

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//---------------------------------------------------------
// xoops system files
//---------------------------------------------------------
include_once XOOPS_ROOT_PATH.'/class/xoopsblock.php' ;
include_once XOOPS_ROOT_PATH.'/class/template.php' ;

//---------------------------------------------------------
// timeline files
//---------------------------------------------------------
include_once XOOPS_TRUST_PATH.'/modules/timeline/init.php';

timeline_include_once( 'include/constants.php',            $MY_DIRNAME );
timeline_include_once( 'class/base/lib/handler_basic.php', $MY_DIRNAME );
timeline_include_once( 'class/base/inc/oninstall.php',     $MY_DIRNAME );
timeline_include_once( 'class/inc/oninstall.php',          $MY_DIRNAME );

timeline_include_once_trust( 'preload/constants.php' );

//=========================================================
// onInstall function
//=========================================================
// --- eval begin ---
eval( '

function xoops_module_install_'.$MY_DIRNAME.'( &$module ) 
{
	return timeline_oninstall_base( $module ) ; 
} 

function xoops_module_update_'.$MY_DIRNAME.'( &$module ) {
	return timeline_onupdate_base( $module ) ; 
} 

function xoops_module_uninstall_'.$MY_DIRNAME.'( &$module ) {
	return timeline_onuninstall_base( $module ) ; 
} 

' ) ;
// --- eval end ---

// === function begin ===
if( ! function_exists( 'timeline_oninstall_base' ) ) 
{

function timeline_oninstall_base( &$module )
{
	$inc_class =& timeline_inc_oninstall::getInstance();
	return $inc_class->install( $module );
}

function timeline_onupdate_base( &$module )
{
	$inc_class =& timeline_inc_oninstall::getInstance();
	return $inc_class->update( $module );
}

function timeline_onuninstall_base( &$module )
{
	$inc_class =& timeline_inc_oninstall::getInstance();
	return  $inc_class->uninstall( $module );
}

function timeline_message_append_oninstall( &$module_obj , &$log )
{
	if( is_array( @$GLOBALS['ret'] ) ) {
		foreach( $GLOBALS['ret'] as $message ) {
			$log->add( strip_tags( $message ) ) ;
		}
	}

	// use mLog->addWarning() or mLog->addError() if necessary
}

function timeline_message_append_onupdate( &$module_obj , &$log )
{
	if( is_array( @$GLOBALS['msgs'] ) ) {
		foreach( $GLOBALS['msgs'] as $message ) {
			$log->add( strip_tags( $message ) ) ;
		}
	}

	// use mLog->addWarning() or mLog->addError() if necessary
}

function timeline_message_append_onuninstall( &$module_obj , &$log )
{
	if( is_array( @$GLOBALS['ret'] ) ) {
		foreach( $GLOBALS['ret'] as $message ) {
			$log->add( strip_tags( $message ) ) ;
		}
	}

	// use mLog->addWarning() or mLog->addError() if necessary
}

// === function begin ===
}

?>