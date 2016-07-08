<?php
// $Id: base.php,v 1.1.1.1 2009/03/19 14:41:42 ohwada Exp $

//=========================================================
// timeline module
// 2009-03-15 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// class timeline_base_admin_base
//=========================================================
class timeline_base_admin_base
{
	var $_module_mid;
	var $_module_name;

	var $_prefix_mi ;
	var $_prefix_am ;

// token
	var $_token_errors = null;
	var $_token_error_flag  = false;

	var $_DIRNAME;
	var $_MODULE_URL;
	var $_MODULE_DIR;
	var $_TRUST_DIRNAME;
	var $_TRUST_DIR;

	var $_PREFIX_ADMENU = 'ADMENU';
	var $_PREFIX_TITLE  = 'TITLE';
	var $_FLAG_ADMIN_SUB_MENU = true;

// color
	var $_SPAN_STYLE_RED   = 'color: #ff0000;';

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function timeline_base_admin_base( $dirname, $trust_dirname )
{
	$this->_DIRNAME       = $dirname ;
	$this->_MODULE_URL    = XOOPS_URL       .'/modules/'. $dirname;
	$this->_MODULE_DIR    = XOOPS_ROOT_PATH .'/modules/'. $dirname;
	$this->_TRUST_DIRNAME = $trust_dirname;
	$this->_TRUST_DIR     = XOOPS_TRUST_PATH .'/modules/'. $trust_dirname;

	$this->_module_mid  = $this->get_module_mid();
	$this->_module_name = $this->get_module_name();

	$this->_prefix_mi = '_MI_'. $dirname       .'_'. $this->_PREFIX_ADMENU .'_' ;
	$this->_prefix_am = '_AM_'. $trust_dirname .'_'. $this->_PREFIX_TITLE  .'_'  ;
}

//---------------------------------------------------------
// title
//---------------------------------------------------------
function build_admin_bread_crumb( $title, $url )
{
	$text  = '<a href="'. $this->_MODULE_URL .'/admin/index.php">';
	$text .= $this->sanitize( $this->_module_name );
	$text .= '</a>';
	$text .= ' &gt;&gt; ';
	$text .= '<a href="'. $url .'">';
	$text .= $this->sanitize( $title );
	$text .= '</a>';
	$text .= "<br /><br />\n";
	return $text;
}

function build_admin_title( $name, $format=true )
{
	$str = $this->get_admin_title( $name );
	if ( $format ) {
		$str = "<h3>". $str ."</h3>\n";
	}
	return $str;
}

function get_admin_title( $name )
{
	$const_name_1 = strtoupper( $this->_prefix_mi . $name ) ;
	$const_name_2 = strtoupper( $this->_prefix_am.  $name ) ;

	if ( defined($const_name_1) ) {
		return constant($const_name_1);
	} elseif ( defined($const_name_2) ) {
		return constant($const_name_2);
	}
	return $const_name_2;
}

function build_this_url( $fct )
{
	$str = $this->_MODULE_URL .'/admin/index.php?fct='. $fct ;
	return $str ;
}

//---------------------------------------------------------
// error
//---------------------------------------------------------
function clear_errors()
{
	$this->_errors = array();
}

function get_errors()
{
	return $this->_errors;
}

function set_error( $msg )
{
// array type
	if ( is_array($msg) ) {
		foreach ( $msg as $m ) {
			$this->_errors[] = $m;
		}

// string type
	} else {
		$arr = explode("\n", $msg);
		foreach ( $arr as $m ) {
			$this->_errors[] = $m;
		}
	}
}

function get_format_error( $flag_sanitize=true, $flag_highlight=true )
{
	$val = '';
	foreach (  $this->_errors as $msg )
	{
		if ( $flag_sanitize ) {
			$msg = $this->sanitize($msg);
		}
		$val .= $msg . "<br />\n";
	}

	if ( $flag_highlight ) {
		$val = $this->highlight($val);
	}
	return $val;
}

//---------------------------------------------------------
// utility
//---------------------------------------------------------
function sanitize( $str )
{
	return htmlspecialchars( $str, ENT_QUOTES );
}

function highlight( $msg )
{
	$str  = '<span style="'. $this->_SPAN_STYLE_RED .'">';
	$str .= $msg;
	$str .= "</span>\n";
	return $str;
}

//---------------------------------------------------------
// ticket
//---------------------------------------------------------
function get_token()
{
	global $xoopsGTicket;
	if ( is_object($xoopsGTicket) ) {
		return $xoopsGTicket->issue();
	}
	return null;
}

function check_token( $allow_repost=false )
{
	global $xoopsGTicket;
	if ( is_object($xoopsGTicket) ) {
		if ( ! $xoopsGTicket->check( true , '',  $allow_repost ) ) {
			$this->_token_error_flag  = true;
			$this->_token_errors = $xoopsGTicket->getErrors();
			return false;
		}
	}
	$this->_token_error_flag = false;
	return true;
}

function get_token_errors()
{
	return $this->_token_errors;
}

//---------------------------------------------------------
// xoops param
//---------------------------------------------------------
function get_module_mid()
{
	global $xoopsModule;
	if ( is_object($xoopsModule) ) {
		return  $xoopsModule->mid();
	}
	return 0;
}

function get_module_name()
{
	global $xoopsModule;
	if ( is_object($xoopsModule) ) {
		return  $xoopsModule->getVar( 'name', 'n' );
	}
	return null;
}

// --- class end ---
}

?>