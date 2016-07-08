<?php
// $Id: admin.php,v 1.1.1.1 2009/03/19 14:41:41 ohwada Exp $

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

//---------------------------------------------------------
// check permission
//---------------------------------------------------------
global $xoopsUser;

// environment
require_once XOOPS_ROOT_PATH.'/class/template.php' ;
$module_handler =& xoops_gethandler( 'module' ) ;
$xoopsModule =& $module_handler->getByDirname( $MY_DIRNAME ) ;
$config_handler =& xoops_gethandler( 'config' ) ;
$xoopsModuleConfig =& $config_handler->getConfigsByCat( 0 , $xoopsModule->getVar( 'mid' ) ) ;

// check permission of 'module_admin' of this module
$moduleperm_handler =& xoops_gethandler( 'groupperm' ) ;
if( ! is_object( @$xoopsUser ) || ! $moduleperm_handler->checkRight( 'module_admin' , $xoopsModule->getVar( 'mid' ) , $xoopsUser->getGroups() ) ) {
	die( 'only admin can access this area' ) ;
}

$xoopsOption['pagetype'] = 'admin' ;
require_once XOOPS_ROOT_PATH.'/include/cp_functions.php' ;

//---------------------------------------------------------
// altsys
//---------------------------------------------------------
$mytrustdirname = TIMELINE_TRUST_DIRNAME ;
$mytrustdirpath = XOOPS_TRUST_PATH.'/modules/'.$mytrustdirname ;
$mydirname      = $MY_DIRNAME;
$mydirpath      = XOOPS_ROOT_PATH.'/modules/'.$MY_DIRNAME ;

if( ! empty( $_GET['lib'] ) ) {

// initialize language manager
	$langmanpath = XOOPS_TRUST_PATH.'/libs/altsys/class/D3LanguageManager.class.php' ;
	if( ! file_exists( $langmanpath ) ) {
		die( 'install the latest altsys' ) ;
	}

	require_once( $langmanpath ) ;
	$langman =& D3LanguageManager::getInstance() ;

	// common libs (eg. altsys)
	$lib  = preg_replace( '/[^a-zA-Z0-9_-]/' , '' , $_GET['lib'] ) ;
	$page = preg_replace( '/[^a-zA-Z0-9_-]/' , '' , @$_GET['page'] ) ;

	// check the page can be accessed (make controllers.php just under the lib)
	$controllers = array() ;
	if( file_exists( XOOPS_TRUST_PATH.'/libs/'.$lib.'/controllers.php' ) ) {
		require XOOPS_TRUST_PATH.'/libs/'.$lib.'/controllers.php' ;
		if( ! in_array( $page , $controllers ) ) {
			$page = $controllers[0] ;
		}
	}
	
	if( file_exists( XOOPS_TRUST_PATH.'/libs/'.$lib.'/'.$page.'.php' ) ) {
		include XOOPS_TRUST_PATH.'/libs/'.$lib.'/'.$page.'.php' ;
	} else if( file_exists( XOOPS_TRUST_PATH.'/libs/'.$lib.'/index.php' ) ) {
		include XOOPS_TRUST_PATH.'/libs/'.$lib.'/index.php' ;
	} else {
		die( 'wrong request' ) ;
	}

	exit();
} 

// load language files (main.php & admin.php)
//	$langman->read( 'admin.php' , $mydirname , $mytrustdirname ) ;
//	$langman->read( 'main.php' , $mydirname , $mytrustdirname ) ;

//---------------------------------------------------------
// timeline
//---------------------------------------------------------
timeline_include_once( 'preload/debug.php' );

// fork each pages
$get_fct  = isset($_GET['fct'])  ? $_GET['fct']  : null;
$post_fct = isset($_POST['fct']) ? $_POST['fct'] : $get_fct;
$fct = preg_replace( '/[^a-zA-Z0-9_-]/' , '' , $post_fct ) ;

$file_trust_fct   = TIMELINE_TRUST_PATH .'/admin/'.$fct.'.php' ;
$file_root_fct    = TIMELINE_ROOT_PATH  .'/admin/'.$fct.'.php' ;
$file_trust_index = TIMELINE_TRUST_PATH .'/admin/index.php' ;
$file_root_index  = TIMELINE_ROOT_PATH  .'/admin/index.php' ;
$file_root_main   = TIMELINE_ROOT_PATH  .'/admin/main.php' ;

if ( file_exists( $file_root_fct ) ) {
	timeline_debug_msg( $file_root_fct );
	include_once $file_root_fct;

} elseif ( file_exists( $file_trust_fct ) ) {
	timeline_debug_msg( $file_trust_fct );
	include_once $file_trust_fct;

//} elseif ( file_exists( $file_root_index ) ) {
//	timeline_debug_msg( $file_root_index );
//	include_once $file_root_index;

} elseif ( file_exists( $file_root_main ) ) {
	timeline_debug_msg( $file_root_main );
	include_once $file_root_main;

} elseif ( file_exists( $file_trust_index ) ) {
	timeline_debug_msg( $file_trust_index );
	include_once $file_trust_index;

} else {
	die( 'wrong request' ) ;
}

?>