<?php
// $Id: menu.php,v 1.1.1.1 2009/03/19 14:41:42 ohwada Exp $

//=========================================================
// timeline module
// 2009-03-15 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// class timeline_base_lib_admin_menu
// base on myalbum's mymenu.php
//=========================================================
class timeline_base_admin_menu
{
// set param
	var $_main_menu = null ;
	var $_sub_menu  = null ;

	var $_module_mid = 0;
	var $_prefix_am;

	var $_DIRNAME;
	var $_MODULE_URL;
	var $_MODULE_DIR;
	var $_TRUST_DIRNAME;
	var $_TRUST_DIR;

	var $_PREFIX     = 'MYMENU' ;
	var $_DIV_STYLE  = 'float:left;height:1.5em;' ;
	var $_FONT_STYLE = 'font:normal normal bold 9pt/12pt;' ;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function timeline_base_admin_menu( $dirname , $trust_dirname )
{
	$this->_DIRNAME       = $dirname ;
	$this->_MODULE_URL    = XOOPS_URL       .'/modules/'. $dirname;
	$this->_MODULE_DIR    = XOOPS_ROOT_PATH .'/modules/'. $dirname;
	$this->_TRUST_DIRNAME = $trust_dirname;
	$this->_TRUST_DIR     = XOOPS_TRUST_PATH .'/modules/'. $trust_dirname;

	$this->_module_mid = $this->get_module_mid();
	$this->_prefix_am = '_AM_'. $trust_dirname .'_'.$this->_PREFIX.'_' ;
}

//---------------------------------------------------------
// set param
//---------------------------------------------------------
function set_main_menu( $val )
{
	$this->_main_menu = $val ;
}

function set_sub_menu( $val )
{
	$this->_sub_menu = $val ;
}

//---------------------------------------------------------
// main
//---------------------------------------------------------
function build_menu_with_sub( $flag_sub=true )
{
	$str = $this->build_main_menu( !$flag_sub, false );

	if ( $flag_sub ) {
		$str .= "<br />\n";
		$str .= $this->build_sub_menu( true, false );
	}

	$str .= $this->build_hr( true );
	return $str;
}

function build_main_menu( $flag_default=true, $flag_hr=true  )
{
	$admin_menu = $this->_main_menu ;
	$add_menu   = $this->build_additinal_menu();

	$menu_array = null;
	if ( is_array($admin_menu) && count($admin_menu) &&
	     is_array($add_menu)  && count($add_menu) ) {
		$menu_array = array_merge( $admin_menu, $add_menu );
	} elseif ( is_array($admin_menu) && count($admin_menu) ) {
		$menu_array = $admin_menu;
	} elseif ( is_array($add_menu) && count($add_menu) ) {
		$menu_array = $add_menu ;
	}

	if ( is_array($menu_array) && count($menu_array) ) {
		$str  = $this->build_highlight( $menu_array, $flag_default );
		$str .= $this->build_hr( $flag_hr ) ;
		return $str ;
	}

	return null;
}

function build_sub_menu( $flag_default=true, $flag_hr=true )
{
	$menu_array = $this->_sub_menu ;

	if ( is_array($menu_array) && count($menu_array) ) {
		$str  = $this->build_highlight( $menu_array, $flag_default );
		$str .= $this->build_hr( $flag_hr ) ;
		return $str ;
	}

	return null;
}

function build_hr( $flag_hr=true )
{
	if ( $flag_hr ) {
		$str = "<hr style='display:block;' />\n" ;
		return $str ;
	}
	return null;
}

function build_additinal_menu()
{
	// with XOOPS_TRUST_PATH and altsys

	$flag_preferences = false;

	$menu_array = array();

	if ( $this->is_installed_altsys() ) {

// mytplsadmin (TODO check if this module has tplfile)
		if( file_exists( XOOPS_TRUST_PATH.'/libs/altsys/mytplsadmin.php' ) ) {
			array_push( $menu_array , array(
				'title' => $this->get_title( 'tplsadmin' ) , 
				'link'  => 'admin/index.php?mode=admin&lib=altsys&page=mytplsadmin'
			) ) ;
		}

	// myblocksadmin
		if( file_exists( XOOPS_TRUST_PATH.'/libs/altsys/myblocksadmin.php' ) ) {
				array_push( $menu_array , array( 
				'title' => $this->get_title( 'blocksadmin' ) ,
				'link'  => 'admin/index.php?mode=admin&lib=altsys&page=myblocksadmin'
			) ) ;
		}

	// mypreferences
		if( $this->has_xoops_config_this_module() ) {
			if( file_exists( XOOPS_TRUST_PATH.'/libs/altsys/mypreferences.php' ) ) {
				$flag_preferences = true;
				array_push( $menu_array , array( 
					'title' => _PREFERENCES ,
					'link'  => 'admin/index.php?mode=admin&lib=altsys&page=mypreferences'
				) ) ;
			}
		}
	}

	// preferences
	if( !$flag_preferences && $this->has_xoops_config_this_module() ) {

	// XOOPS Cube 2.1
		if( defined( 'XOOPS_CUBE_LEGACY' ) ) {
			$link = XOOPS_URL.'/modules/legacy/admin/index.php?action=PreferenceEdit&confmod_id='.$this->_module_mid;

	// XOOPS 2.0
		} else {
			$link = XOOPS_URL.'/modules/system/admin.php?fct=preferences&op=showmod&mod='.$this->_module_mid;
		}

		array_push( $menu_array , array( 
			'title' => _PREFERENCES ,
			'link'  => $link 
		) ) ;
	}

	array_push( $menu_array , array( 
		'title' => $this->get_title( 'goto_module' ) , 
		'link'  => 'index.php',
	) ) ;

	return $menu_array;
}

function build_highlight( $menu_array, $flag_default=true )
{
	$mymenu_uri  = $_SERVER['REQUEST_URI'];
	$mymenu_link = substr( strstr( $mymenu_uri , '/admin/' ) , 1 ) ;

	$flag_highlight = false ;

// set gray all
	foreach( array_keys( $menu_array ) as $i )  {
		$menu_array[$i]['color'] = '#DDDDDD' ;
	}

	$post_fct = isset($_POST['fct']) ? $_POST['fct'] : null;
	$fct = preg_replace( '/[^a-zA-Z0-9_-]/' , '' , $post_fct ) ;

// highlight
	if ( $fct ) {
		$uri_fct = $mymenu_link.'?fct='.$fct;
		foreach( array_keys( $menu_array ) as $i ) 
		{
			if ( $uri_fct == $menu_array[$i]['link'] ) {
				$menu_array[$i]['color'] = '#FFCCCC' ;
				$flag_highlight = true ;
				break ;
			}
		}
	}

	if ( $fct && !$flag_highlight ) {
		$uri_fct = $mymenu_uri.'?fct='.$fct;
		foreach( array_keys( $menu_array ) as $i ) 
		{
			if ( stristr( $uri_fct , $menu_array[$i]['link'] ) ) {
				$menu_array[$i]['color'] = '#FFCCCC' ;
				$flag_highlight = true ;
				break ;
			}
		}
	}

	if ( !$flag_highlight ) {
		foreach( array_keys( $menu_array ) as $i ) 
		{
			if ( $mymenu_link == $menu_array[$i]['link'] ) {
				$menu_array[$i]['color'] = '#FFCCCC' ;
				$flag_highlight = true ;
				break ;
			}
		}
	}

	if ( !$flag_highlight ) {
		foreach( array_keys( $menu_array ) as $i ) 
		{
			$link = $menu_array[$i]['link'];
			if ( $link != 'admin/index.php' && 
			     strpos( $mymenu_link , $link ) === 0 ) {

				$menu_array[$i]['color'] = '#FFCCCC' ;
				$flag_highlight = true ;
				break ;
			}
		}
	}

	if ( !$flag_highlight && $flag_default ) {
		foreach( array_keys( $menu_array ) as $i ) 
		{
			if ( stristr( $mymenu_uri , $menu_array[$i]['link'] ) ) {
				$menu_array[$i]['color'] = '#FFCCCC' ;
				break ;
			}
		}
	}

	// link conversion from relative to absolute
	foreach( array_keys( $menu_array ) as $i ) 
	{
		if( stristr( $menu_array[$i]['link'] , XOOPS_URL ) === false ) {
			$menu_array[$i]['link'] = $this->_MODULE_URL .'/'. $menu_array[$i]['link'] ;
		}
	}

	// display
	$text = "<div style='text-align:left;width:98%;'>\n" ;

	foreach( $menu_array as $menuitem ) 
	{
		$target = '';
		if ( isset($menuitem['target']) && $menuitem['target'] ) {
			$target = 'target="'. $menuitem['target'] .'"';
		}

		$style = 'style="background-color:'. $menuitem['color'] .'; '.$this->_FONT_STYLE. '"';

		$text .= '<div style="'. $this->_DIV_STYLE. '">';
		$text .= '<nobr>';
		$text .= '<a href="'. $this->sanitize( $menuitem['link'] ) .'" '. $target .' '. $style .'>';
		$text .= $this->sanitize( $menuitem['title'] );
		$text .= '</a> | </nobr></div>'."\n" ;
	}

	$text .= "</div>\n";
	$text .= "<br style='clear:left;' />\n";

	return $text;
}

//---------------------------------------------------------
// utility
//---------------------------------------------------------
function sanitize( $str )
{
	return htmlspecialchars( $str, ENT_QUOTES );
} 

//---------------------------------------------------------
// language
//---------------------------------------------------------
function get_title( $name )
{
	$const_name = strtoupper( $this->_prefix_am . $name );
	$title = defined( $const_name ) ? constant( $const_name ) : $name ;
	return $title;
}

//---------------------------------------------------------
// xoops param
//---------------------------------------------------------
function get_module_mid()
{
	global $xoopsModule;
	if ( is_object($xoopsModule) ) {
		return $xoopsModule->mid();
	}
	return 0;
}

function has_xoops_config_this_module()
{
	$config_handler =& xoops_gethandler('config');
	return count( $config_handler->getConfigs( new Criteria( 'conf_modid' , $this->_module_mid ) ) );
}

function get_xoops_module_by_dirname( $dirname )
{
	$module_handler =& xoops_gethandler('module');
	return $module_handler->getByDirname( $dirname );
}

function is_installed_altsys()
{
	$module = $this->get_xoops_module_by_dirname( 'altsys' );
	if ( is_object($module) ) {
		return true;
	}
	return false;
}

// --- class end ---
}

?>