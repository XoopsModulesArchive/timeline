<?php
// $Id: admin_menu.php,v 1.1.1.1 2009/03/19 14:41:43 ohwada Exp $

//=========================================================
// timeline module
// 2009-03-15 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// class timeline_inc_admin_menu
// caller timeline_lib_admin_menu admin/menu.php
//=========================================================
class timeline_inc_admin_menu extends timeline_base_inc_admin_menu
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function timeline_inc_admin_menu( $dirname )
{
	$this->timeline_base_inc_admin_menu( $dirname );
}

function &getSingleton( $dirname )
{
	static $singletons;
	if ( !isset( $singletons[ $dirname ] ) ) {
		$singletons[ $dirname ] = new timeline_inc_admin_menu( $dirname );
	}
	return $singletons[ $dirname ];
}

//---------------------------------------------------------
// main
//---------------------------------------------------------
function define_main_menu()
{
	$menu[0]['title']  = 'INDEX' ;
	$menu[0]['fct']    = '';

	return $menu;
}

// --- class end ---
}

?>