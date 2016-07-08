<?php
// $Id: menu.php,v 1.1.1.1 2009/03/19 14:41:41 ohwada Exp $

//=========================================================
// timeline module
// 2009-03-15 K.OHWADA
//=========================================================

//---------------------------------------------------------
// $MY_DIRNAME is set by caller
//---------------------------------------------------------

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//---------------------------------------------------------
// timeline files
//---------------------------------------------------------
include_once XOOPS_TRUST_PATH.'/modules/timeline/init.php';

$MY_DIRNAME= $GLOBALS['MY_DIRNAME'];
timeline_include_once( 'class/base/inc/admin_menu.php', $MY_DIRNAME );
timeline_include_once( 'class/inc/admin_menu.php',      $MY_DIRNAME );
timeline_include_language( 'modinfo.php',               $MY_DIRNAME );

//=========================================================
// main
//=========================================================
$manager =& timeline_inc_admin_menu::getSingleton( $MY_DIRNAME );
$adminmenu = $manager->build_main_menu();

?>