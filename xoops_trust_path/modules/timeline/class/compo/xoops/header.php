<?php
// $Id: header.php,v 1.1.1.1 2009/03/19 14:41:43 ohwada Exp $

//=========================================================
// timeline module
// 2009-03-15 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// class timeline_compo_xoops_header
//=========================================================
class timeline_compo_xoops_header extends timeline_base_xoops_header
{
	var $_JS_URL ;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function timeline_compo_xoops_header( $dirname )
{
	$this->timeline_base_xoops_header( $dirname, TIMELINE_TRUST_DIRNAME );

	$this->_JS_URL = $this->_MODULE_URL .'/libs/timeline';
}

function &getSingleton( $dirname )
{
	static $singletons;
	if ( !isset( $singletons[ $dirname ] ) ) {
		$singletons[ $dirname ] = new timeline_compo_xoops_header( $dirname );
	}
	return $singletons[ $dirname ];
}

//---------------------------------------------------------
// assign
//---------------------------------------------------------
function assign_or_get_default_css( $flag_template=false )
{
	$CSS_CONST = 'default_css' ;
	$CSS_FILE  = 'default.css' ;

	$show = false ;
	$css  = null ;

	if ( $this->check_once_name( $CSS_CONST ) ) {
		$show = true ;
		$css = $this->build_link_css_libs( $CSS_FILE );
	}

	if ( !$flag_template && $this->_FLAG_ASSIGN_HEADER && $css ) {
		$this->assign_xoops_module_header( $css );
		$show = false ;
	}

	$arr = array(
		'show' => $show ,
	);
	return $arr;
}

function assign_or_get_timeline_js( $flag_template=false )
{
	$show = false ;
	$js   = null ;

	if ( $this->check_name_js( 'timeline' ) ) {
		$show = true ;
		$js   = $this->build_timeline_js() ;
	}

	if ( !$flag_template && $this->_FLAG_ASSIGN_HEADER && $js ) {
		$this->assign_xoops_module_header( $js );
		$show = false ;
	}

	$arr = array(
		'show' => $show ,
	);
	return $arr;
}

function build_timeline_js()
{
	$str  = 'Timeline_ajax_url="'.  $this->_JS_URL .'/timeline_ajax/simile-ajax-api.js";'."\n" ;
	$str .= 'Timeline_urlPrefix="'. $this->_JS_URL .'/timeline_js/";'."\n" ;       
	$str .= 'Timeline_parameters="bundle=true";'."\n";

	$ret  = $this->build_envelop_js( $str );
	$ret .= $this->build_script_js( $this->_JS_URL .'/timeline_js/timeline-api.js' );
	$ret .= $this->build_script_js( $this->_LIBS_URL .'/timeline.js' );
	return $ret;
}

// --- class end ---
}

?>