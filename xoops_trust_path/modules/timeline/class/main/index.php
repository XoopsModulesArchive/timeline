<?php
// $Id: index.php,v 1.3 2011/12/26 05:45:39 ohwada Exp $

//=========================================================
// timeline module
// 2009-03-15 K.OHWADA
//=========================================================

//---------------------------------------------------------
// change log
// 2011-12-25 K.OHWADA
// monet_xml
//---------------------------------------------------------

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// class timeline_main_index
//=========================================================
class timeline_main_index 
{
	var $_xoops_param ;
	var $_timeline_class;
	var $_language_class;
	var $_header_class;

	var $_DIRNAME;
	var $_MODULE_URL;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function timeline_main_index( $dirname )
{
	$this->_DIRNAME    = $dirname ;
	$this->_MODULE_URL = XOOPS_URL .'/modules/'. $dirname ;

	$this->_xoops_param    =  new timeline_base_xoops_param();
	$this->_timeline_class =& timeline_compo_timeline::getSingleton( $dirname );
	$this->_language_class =& timeline_compo_d3_language::getSingleton(  $dirname );
	$this->_header_class   =& timeline_compo_xoops_header::getSingleton( $dirname );
}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) {
		$instance = new timeline_main_index( $dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// main
//---------------------------------------------------------
function main()
{
	$ID = 0;

	$this->_timeline_class->set_show_onload(   true );
	$this->_timeline_class->set_show_onresize( true );

	$sample_url = '';
	$show_unit  = false ;

	$op   = isset($_GET['op'])   ? $_GET['op']   : null ;
	$unit = isset($_GET['unit']) ? $_GET['unit'] : null ;
	$date = isset($_GET['date']) ? $_GET['date'] : null ;

	switch ( $op )
	{
		case 'simple_events':
			timeline_include_once( 'sample/simple.php' );
			$this->_timeline_class->init_simple_events();
			$param = $this->_timeline_class->build_simple_events( $ID, timelime_sample_simple() );
			$js    = $this->_timeline_class->fetch_simple_events( $param );
			$title = $this->get_lang('TITLE_SIMPLE_EVENTS');
			$class = 'timeline_view';
			break;

		case 'painter_json':
			$json  = $this->_MODULE_URL.'/sample/painter.json' ;
			$this->_timeline_class->init_painter_json();
			$param = $this->_timeline_class->build_painter_json( $ID, $json );
			$js    = $this->_timeline_class->fetch_painter_json( $param );
			$title = $this->get_lang('TITLE_PAINTER_JSON');
			$class = 'timeline_painter';
			$sample_url = _C_TIMELINE_SAMPLE_URL_PAINTER_JSON;
			break;

		case 'painter_events':
			timeline_include_once( 'sample/painter.php' );
			$this->_timeline_class->init_painter_events();
			$this->_timeline_class->set_band_unit( $unit );
			$this->_timeline_class->set_center_date( $date );
			$param = $this->_timeline_class->build_painter_events( $ID, timelime_sample_painter() );
			$js    = $this->_timeline_class->fetch_painter_events( $param );
			$title = $this->get_lang('TITLE_PAINTER_EVENTS');
			if ( $unit ) {
				$title .= ' ('.$unit.')';
			}
			$class = 'timeline_painter';
			$show_unit  = true ;
			break;

		case 'monet_xml':
			$xml   = $this->_MODULE_URL.'/sample/monet.xml' ;
			$this->_timeline_class->init_monet_xml();
			$param = $this->_timeline_class->build_monet_xml( $ID, $xml );
			$js    = $this->_timeline_class->fetch_monet_xml( $param );
			$title = $this->get_lang('TITLE_MONET_XML');
			$class = 'timeline_view';
			$sample_url = _C_TIMELINE_SAMPLE_URL_MONET_XML;
			break;

		case 'monet_events':
			timeline_include_once( 'sample/monet.php' );
			$this->_timeline_class->init_monet_events();
			$param = $this->_timeline_class->build_monet_events( $ID, timelime_sample_monet() );
			$js    = $this->_timeline_class->fetch_monet_events( $param );
			$title = $this->get_lang('TITLE_MONET_EVENTS');
			$class = 'timeline_view';
			break;

		case 'simple_xml':
		default:
			$xml   = $this->_MODULE_URL.'/sample/simple.xml' ;
			$this->_timeline_class->init_simple_xml();
			$param = $this->_timeline_class->build_simple_xml( $ID, $xml );
			$js    = $this->_timeline_class->fetch_simple_xml( $param );
			$title = $this->get_lang('TITLE_SIMPLE_XML');
			$class = 'timeline_view';
			$sample_url = _C_TIMELINE_SAMPLE_URL_SIMPLE_XML;
			break;
	}

	$arr = $this->build_common( $ID );

	$arr['timeline_js'] = $js;
	$arr['element']     = $param['element'];
	$arr['class']       = $class;
	$arr['lang_title']  = $title;
	$arr['sample_url']  = $sample_url;
	$arr['op']          = $op;
	$arr['show_unit']   = $show_unit;

	return $arr;
}

function build_common( $id )
{
	$param = $this->_header_class->assign_or_get_default_css() ;
	$show_default_css = $param['show'] ;

	$arr = array(
		'xoops_dirname'    => $this->_DIRNAME ,
		'mydirname'        => $this->_DIRNAME ,
		'module_name'      => $this->_xoops_param->get_module_name() ,
		'is_module_admin'  => $this->_xoops_param->is_module_admin() ,
		'show_default_css' => $show_default_css ,
		'id'               => $id ,
		'lang_title_timeline'       => $this->get_lang('TITLE_TIMELINE') ,
		'lang_title_simple_xml'     => $this->get_lang('TITLE_SIMPLE_XML') ,
		'lang_title_simple_events'  => $this->get_lang('TITLE_SIMPLE_EVENTS') ,
		'lang_title_painter_json'   => $this->get_lang('TITLE_PAINTER_JSON') ,
		'lang_title_painter_events' => $this->get_lang('TITLE_PAINTER_EVENTS') ,
		'lang_title_monet_xml'      => $this->get_lang('TITLE_MONET_XML') ,
		'lang_title_monet_events'   => $this->get_lang('TITLE_MONET_EVENTS') ,
		'lang_caution_ie'           => $this->get_lang('CAUTION_IE') ,
	);

	return $arr;
}

//---------------------------------------------------------
// utility
//---------------------------------------------------------
function sanitize( $str )
{
	return htmlspecialchars( $str, ENT_QUOTES );
}

//---------------------------------------------------------
// config
//---------------------------------------------------------
function get_config( $name )
{
	return $this->_xoops_param->get_module_config_by_name( $name );
}

function get_config_text( $name )
{
	return $this->_xoops_param->get_module_config_text_by_name( $name );
}

//---------------------------------------------------------
// language
//---------------------------------------------------------
function get_lang( $name )
{
	return $this->_language_class->get_constant( $name );
}

// --- class end ---
}

?>