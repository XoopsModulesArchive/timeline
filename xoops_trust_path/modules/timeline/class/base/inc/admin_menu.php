<?php
// $Id: admin_menu.php,v 1.1.1.1 2009/03/19 14:41:42 ohwada Exp $

//=========================================================
// timeline module
// 2009-03-15 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// class timeline_base_inc_admin_menu
//=========================================================
class timeline_base_inc_admin_menu
{
	var $_prefix_mi;

	var $_DIRNAME;
	var $_PREFIX = 'ADMENU' ;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function timeline_base_inc_admin_menu( $dirname )
{
	$this->_DIRNAME = $dirname;
	$this->_prefix_mi = '_MI_'. $dirname .'_'.$this->_PREFIX.'_' ;
}

//---------------------------------------------------------
// main
//---------------------------------------------------------
function define_main_menu()
{
	// dummy
}

function define_sub_menu()
{
	// dummy
}

function build_main_menu()
{
	return $this->build_menu_common( $this->define_main_menu() );
}

function build_sub_menu( )
{
	return $this->build_menu_common( $this->define_sub_menu() );
}

function build_menu_common( $menu )
{
	if ( !is_array($menu) || !count($menu) ) {
		return null ;
	}

	$arr = array();
	foreach( $menu as $k => $v )
	{
		$title  = $this->get_lang_mi( $v['title'] ) ;
		$link   = 'admin/index.php' ;
		$target = '' ;
		if ( isset($v['fct']) && $v['fct'] ) {
			$link .= '?fct='. $v['fct'] ;
		}
		if ( isset($v['target']) && $v['target'] ) {
			$target = $v['target'] ;
		}
		$arr[ $k ] = array(
			'title'  => $title ,
			'link'   => $link ,
			'target' => $target ,
		);
	}

	return $arr;
}

//---------------------------------------------------------
// langauge
//---------------------------------------------------------
function get_lang_mi( $name )
{
	$const_name = strtoupper( $this->_prefix_mi . $name );
	if ( defined($const_name) ) {
		return constant( $const_name );
	}
	return $const_name;
}

// --- class end ---
}

?>