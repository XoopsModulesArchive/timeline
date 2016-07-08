<?php
// $Id: timeline.php,v 1.8 2011/12/28 15:57:34 ohwada Exp $

//=========================================================
// timeline module
// 2009-03-15 K.OHWADA
//=========================================================

//---------------------------------------------------------
// change log
// 2011-12-25 K.OHWADA
// init_monet_xml()
// 2009-04-10 K.OHWADA
// set_show_onload()
//---------------------------------------------------------

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// class timeline_compo_timeline
//=========================================================
class timeline_compo_timeline
{
	var $_header_class;
	var $_language_class ;
	var $_multibyte_class ;
	var $_utility_class ;
	var $_xoops_param_class ;

// set param
	var $_element_name  = 'timeline_view' ;
	var $_show_element  = false;
	var $_show_onload   = false;
	var $_show_onresize = false;
	var $_show_timeout  = false;
	var $_timeout = 1000;	// 1 sec
	var $_style   = 'border: 1px solid #808080; ' ;
	var $_width   = '100%';
	var $_height  = '150px';

	var $_center_date = '';
	var $_icon_alone  ;
	var $_band_0_icon ;
	var $_band_0_date   ;
	var $_band_0_width  ;
	var $_band_0_pixels ;
	var $_band_0_unit   ;
	var $_band_1_date   ;
	var $_band_1_width  ;
	var $_band_1_pixels ;
	var $_band_1_unit   ;
	var $_band_1_syncwith  ;
	var $_band_1_highlight ;
	var $_band_1_layout ;

	var $_param_simple_xml ;
	var $_param_simple_events ;
	var $_param_painter_json ;
	var $_param_painter_enevts ;
	var $_param_monet_xml ;
	var $_param_monet_events ;

	var $_timezone;

	var $_desc_max   = 100 ;
	var $_desc_width = 20 ;
	var $_desc_break = '<br />' ;

	var $_DIRNAME ;
	var $_MODULE_URL ;
	var $_MARKER_URL ;

// Sep 27 2009 09:00:00 +0900
	var $_FMT_DATETIME = 'M j Y H:i:s O';

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function timeline_compo_timeline( $dirname )
{
	$this->_DIRNAME    = $dirname;
	$this->_MODULE_URL = XOOPS_URL .'/modules/'. $dirname ;
	$this->_IMAGES_URL = $this->_MODULE_URL .'/images';

	$this->_header_class    =& timeline_compo_xoops_header::getSingleton(  $dirname );
	$this->_language_class  =& timeline_compo_d3_language::getSingleton(   $dirname );
	$this->_multibyte_class = new timeline_base_lib_multibyte();
	$this->_utility_class   = new timeline_base_lib_utility();
	$this->_xoops_param_class = new timeline_base_xoops_param();

	$this->_param_simple_xml = array(
		'band_0_date'      => _C_TIMELINE_SIMPLE_XML_BAND_DATE ,
		'band_0_width'     => _C_TIMELINE_SIMPLE_XML_BAND_0_WIDTH ,
		'band_0_pixels'    => _C_TIMELINE_SIMPLE_XML_BAND_0_PIXELS ,
		'band_0_unit'      => _C_TIMELINE_SIMPLE_XML_BAND_0_UNIT ,
		'band_1_date'      => _C_TIMELINE_SIMPLE_XML_BAND_DATE ,
		'band_1_width'     => _C_TIMELINE_SIMPLE_XML_BAND_1_WIDTH ,
		'band_1_pixels'    => _C_TIMELINE_SIMPLE_XML_BAND_1_PIXELS ,
		'band_1_unit'      => _C_TIMELINE_SIMPLE_XML_BAND_1_UNIT ,
		'band_1_syncwith'  => _C_TIMELINE_BAND_1_SYNCWITH ,
		'band_1_highlight' => _C_TIMELINE_BAND_1_HIGHLIGHT ,
	);

	$this->_param_simple_events = array(
		'band_0_date'      => _C_TIMELINE_SIMPLE_EVENTS_BAND_DATE ,
		'band_0_width'     => _C_TIMELINE_SIMPLE_EVENTS_BAND_0_WIDTH ,
		'band_0_pixels'    => _C_TIMELINE_SIMPLE_EVENTS_BAND_0_PIXELS ,
		'band_0_unit'      => _C_TIMELINE_SIMPLE_EVENTS_BAND_0_UNIT ,
		'band_1_date'      => _C_TIMELINE_SIMPLE_EVENTS_BAND_DATE ,
		'band_1_width'     => _C_TIMELINE_SIMPLE_EVENTS_BAND_1_WIDTH ,
		'band_1_pixels'    => _C_TIMELINE_SIMPLE_EVENTS_BAND_1_PIXELS ,
		'band_1_unit'      => _C_TIMELINE_SIMPLE_EVENTS_BAND_1_UNIT ,
		'band_1_syncwith'  => _C_TIMELINE_BAND_1_SYNCWITH ,
		'band_1_highlight' => _C_TIMELINE_BAND_1_HIGHLIGHT ,
	);

	$this->_param_painter_json = array(
		'band_0_date'      => _C_TIMELINE_PAINTER_JSON_BAND_DATE ,
		'band_0_width'     => _C_TIMELINE_PAINTER_JSON_BAND_0_WIDTH ,
		'band_0_pixels'    => _C_TIMELINE_PAINTER_JSON_BAND_0_PIXELS ,
		'band_0_unit'      => _C_TIMELINE_PAINTER_JSON_BAND_0_UNIT ,
		'band_1_date'      => _C_TIMELINE_PAINTER_JSON_BAND_DATE ,
		'band_1_width'     => _C_TIMELINE_PAINTER_JSON_BAND_1_WIDTH ,
		'band_1_pixels'    => _C_TIMELINE_PAINTER_JSON_BAND_1_PIXELS ,
		'band_1_unit'      => _C_TIMELINE_PAINTER_JSON_BAND_1_UNIT ,
		'band_1_layout'    => _C_TIMELINE_PAINTER_JSON_BAND_1_LAYOUT ,
		'band_1_syncwith'  => _C_TIMELINE_BAND_1_SYNCWITH ,
		'band_1_highlight' => _C_TIMELINE_BAND_1_HIGHLIGHT ,
	);

	$this->_param_painter_events = array(
		'band_0_date'      => _C_TIMELINE_PAINTER_EVENTS_BAND_DATE ,
		'band_0_width'     => _C_TIMELINE_PAINTER_EVENTS_BAND_0_WIDTH ,
		'band_0_pixels'    => _C_TIMELINE_PAINTER_EVENTS_BAND_0_PIXELS ,
		'band_0_unit'      => _C_TIMELINE_PAINTER_EVENTS_BAND_0_UNIT ,
		'band_1_date'      => _C_TIMELINE_PAINTER_EVENTS_BAND_DATE ,
		'band_1_width'     => _C_TIMELINE_PAINTER_EVENTS_BAND_1_WIDTH ,
		'band_1_pixels'    => _C_TIMELINE_PAINTER_EVENTS_BAND_1_PIXELS ,
		'band_1_unit'      => _C_TIMELINE_PAINTER_EVENTS_BAND_1_UNIT ,
		'band_1_layout'    => _C_TIMELINE_PAINTER_EVENTS_BAND_1_LAYOUT ,
		'band_1_syncwith'  => _C_TIMELINE_BAND_1_SYNCWITH ,
		'band_1_highlight' => _C_TIMELINE_BAND_1_HIGHLIGHT ,
	);

	$this->_param_monet_xml = array(
		'band_year'     => _C_TIMELINE_MONET_XML_BAND_YEAR ,
		'band_0_pixels' => _C_TIMELINE_MONET_XML_BAND_0_PIXELS ,
		'band_1_pixels' => _C_TIMELINE_MONET_XML_BAND_1_PIXELS ,
	);

	$this->_param_monet_events = array(
		'band_year'     => _C_TIMELINE_MONET_EVENTS_BAND_YEAR ,
		'band_0_pixels' => _C_TIMELINE_MONET_EVENTS_BAND_0_PIXELS ,
		'band_1_pixels' => _C_TIMELINE_MONET_EVENTS_BAND_1_PIXELS ,
	);

	$this->_icon_alone  = $this->_IMAGES_URL."/no-image-40.png" ; 
	$this->_band_0_icon = $this->_IMAGES_URL."/no-image-80.png" ; 

	$this->_timezone = intval( $this->_xoops_param_class->get_default_timezone() );
}

function &getSingleton( $dirname )
{
	static $singletons;
	if ( !isset( $singletons[ $dirname ] ) ) {
		$singletons[ $dirname ] = new timeline_compo_timeline( $dirname );
	}
	return $singletons[ $dirname ];
}

//---------------------------------------------------------
// main
//---------------------------------------------------------
function init_simple_xml()
{
	$this->set_params( $this->_param_simple_xml );
}

function init_simple_events()
{
	$this->set_params( $this->_param_simple_events );
}

function init_painter_json()
{
	$this->set_params( $this->_param_painter_json );
}

function init_painter_events()
{
	$this->set_params( $this->_param_painter_events );
}

function init_monet_xml()
{
	$this->set_params( $this->_param_monet_xml );
}

function init_monet_events()
{
	$this->set_params( $this->_param_monet_events );
}

function fetch_simple_xml( $param )
{
	$template = 'db:'. $this->_DIRNAME .'_inc_simple_xml_js.html' ;
	return $this->fetch_common( $param, $template );
}

function fetch_simple_events( $param )
{
	$template = 'db:'. $this->_DIRNAME .'_inc_simple_events_js.html' ;
	return $this->fetch_common( $param, $template );
}

function fetch_painter_json( $param )
{
	$template = 'db:'. $this->_DIRNAME .'_inc_painter_json_js.html' ;
	return $this->fetch_common( $param, $template );
}

function fetch_painter_events( $param )
{
	$template = 'db:'. $this->_DIRNAME .'_inc_painter_events_js.html' ;
	return $this->fetch_common( $param, $template );
}

function fetch_monet_xml( $param )
{
	$template = 'db:'. $this->_DIRNAME .'_inc_monet_xml_js.html' ;
	return $this->fetch_common( $param, $template );
}

function fetch_monet_events( $param )
{
	$template = 'db:'. $this->_DIRNAME .'_inc_monet_events_js.html' ;
	return $this->fetch_common( $param, $template );
}

function fetch_common( $params, $template )
{
	$tpl = new XoopsTpl();
	$tpl->assign( $params );
	return $tpl->fetch( $template );
}

function build_simple_xml( $id, $xml, $flag_header=true )
{
	$arr = $this->build_common( $id, $flag_header );
	$arr['xml'] = $xml ;
	return $arr;
}

function build_simple_events( $id, $events, $flag_header=true )
{
	$arr = $this->build_common( $id, $flag_header );
	$arr['events'] = $this->build_events( $events ) ;
	$arr['zoom']   = "true" ;
	return $arr;
}

function build_painter_json( $id, $json, $flag_header=true )
{
	$arr = $this->build_common( $id, $flag_header );
	$arr['json'] = $json ;
	return $arr;
}

function build_painter_events( $id, $events, $flag_header=true )
{
	$arr = $this->build_common( $id, $flag_header );
	$arr['events'] = $this->build_events( $events ) ;
	return $arr;
}

function build_monet_xml( $id, $xml, $flag_header=true )
{
	$arr = $this->build_common( $id, $flag_header );
	$arr['band_year'] = $this->_param_monet_xml['band_year'];
	$arr['xml'] = $xml ;
	return $arr;
}

function build_monet_events( $id, $events, $flag_header=true )
{
	$arr = $this->build_common( $id, $flag_header );
	$arr['band_year'] = $this->_param_monet_events['band_year'];
	$arr['events']    = $this->build_events( $events ) ;
	$arr['zoom']      = "true" ;
	return $arr;
}

function set_params( $param )
{
	$this->set_param_single( $param, 'band_0_date' );
	$this->set_param_single( $param, 'band_0_width' );
	$this->set_param_single( $param, 'band_0_pixels' );
	$this->set_param_single( $param, 'band_0_unit' );
	$this->set_param_single( $param, 'band_1_date' );
	$this->set_param_single( $param, 'band_1_width' );
	$this->set_param_single( $param, 'band_1_pixels' );
	$this->set_param_single( $param, 'band_1_unit' );
	$this->set_param_single( $param, 'band_1_syncwith' );
	$this->set_param_single( $param, 'band_1_highlight' );
	$this->set_param_single( $param, 'band_1_layout' );
}

function set_param_single( $param, $name )
{
	$var = '_'.$name;
	if ( isset($param[ $name ]) && ($param[ $name ] != '') ) {
		 $this->$var = $param[ $name ] ;
	}
}

function build_common( $id, $flag_header=true )
{
	$style = $this->_style.' width:'.$this->_width.'; height:'.$this->_height.'; ';
	$show  = false ;

	if ( $flag_header ) {
		$param = $this->_header_class->assign_or_get_timeline_js() ;
		$show  = $param['show'] ;
	}

	$arr = array(
		'id'                => $id ,
		'element'           => $this->build_element_id( $id ) ,
		'xoops_langcode'    => _LANGCODE ,
		'xoops_dirname'     => $this->_DIRNAME ,
		'module_url'        => $this->_MODULE_URL ,
		'show_timeline_js'  => $show ,
		'show_element'      => $this->_show_element ,
		'show_onload'       => $this->_show_onload ,
		'show_onresize'     => $this->_show_onresize ,
		'show_timeout'      => $this->_show_timeout ,
		'timeout'           => $this->_timeout ,
		'style'             => $style ,
		'center_date'       => $this->_center_date,
		'icon_alone'        => $this->_icon_alone,
		'band_0_date'       => $this->_band_0_date,
		'band_0_width'      => $this->_band_0_width,
		'band_0_pixels'     => $this->_band_0_pixels,
		'band_0_unit'       => $this->_band_0_unit,
		'band_0_icon'       => $this->_band_0_icon,
		'band_1_date'       => $this->_band_1_date,
		'band_1_width'      => $this->_band_1_width,
		'band_1_pixels'     => $this->_band_1_pixels,
		'band_1_unit'       => $this->_band_1_unit,
		'band_1_syncwith'   => $this->_band_1_syncwith ,
		'band_1_highlight'  => $this->_band_1_highlight ,
		'band_1_layout'     => $this->_band_1_layout,
	);
	return $arr;
}

function build_element_id( $id )
{
	$str = $this->_element_name.'_'.$id ;
	return $str ;
}

function bool_to_str( $bool )
{
	if ( $bool ) {
		return "true";
	}
	return "false";
}

function build_summary( $str )
{
	return $this->_multibyte_class->build_summary_with_wordwrap( 
		$str, $this->_desc_max, $this->_desc_width, $this->_desc_break );
}

function escape_quotation( $str )
{
// " -> \"
	return str_replace( '"', '\"', $str );
}

function unixtime_to_datetime( $time )
{
	if ( $time > 0 ) {
		return date( $this->_FMT_DATETIME, $time );
	}
	return false;
}

function set_band_unit( $unit )
{
	switch ( $unit )
	{
		case 'millennium':
			$this->set_band_0_unit( _C_TIMELINE_UNIT_CENTURY );
			$this->set_band_1_unit( _C_TIMELINE_UNIT_MILLENNIUM );
			$this->set_band_0_pixels( _C_TIMELINE_PIXELS_MILLENNIUM_CENTURY );
			$this->set_band_1_pixels( _C_TIMELINE_PIXELS_MILLENNIUM_MILLENNIUM );
			break;

		case 'century':
			$this->set_band_0_unit( _C_TIMELINE_UNIT_DECADE );
			$this->set_band_1_unit( _C_TIMELINE_UNIT_CENTURY );
			$this->set_band_0_pixels( _C_TIMELINE_PIXELS_CENTURY_DECADE );
			$this->set_band_1_pixels( _C_TIMELINE_PIXELS_CENTURY_CENTURY );
			break;

		case 'decade':
			$this->set_band_0_unit( _C_TIMELINE_UNIT_YEAR );
			$this->set_band_1_unit( _C_TIMELINE_UNIT_DECADE );
			$this->set_band_0_pixels( _C_TIMELINE_PIXELS_DECADE_YEAR );
			$this->set_band_1_pixels( _C_TIMELINE_PIXELS_DECADE_DECADE );
			break;

		case 'year':
			$this->set_band_0_unit( _C_TIMELINE_UNIT_MONTH );
			$this->set_band_1_unit( _C_TIMELINE_UNIT_YEAR );
			$this->set_band_0_pixels( _C_TIMELINE_PIXELS_YEAR_MONTH );
			$this->set_band_1_pixels( _C_TIMELINE_PIXELS_YEAR_YEAR );
			break;

		case 'month':
			$this->set_band_0_unit( _C_TIMELINE_UNIT_WEEK );
			$this->set_band_1_unit( _C_TIMELINE_UNIT_MONTH );
			$this->set_band_0_pixels( _C_TIMELINE_PIXELS_MONTH_WEEK );
			$this->set_band_1_pixels( _C_TIMELINE_PIXELS_MONTH_MONTH );
			break;	

		case 'week':
			$this->set_band_0_unit( _C_TIMELINE_UNIT_DAY );
			$this->set_band_1_unit( _C_TIMELINE_UNIT_MONTH );
			$this->set_band_0_pixels( _C_TIMELINE_PIXELS_WEEK_DAY );
			$this->set_band_1_pixels( _C_TIMELINE_PIXELS_WEEK_MONTH );
			break;	

		case 'day':
			$this->set_band_0_unit( _C_TIMELINE_UNIT_HOUR );
			$this->set_band_1_unit( _C_TIMELINE_UNIT_DAY );
			$this->set_band_0_pixels( _C_TIMELINE_PIXELS_DAY_HOUR );
			$this->set_band_1_pixels( _C_TIMELINE_PIXELS_DAY_DAY );
			break;

		case 'hour':
			$this->set_band_0_unit( _C_TIMELINE_UNIT_MINUTE );
			$this->set_band_1_unit( _C_TIMELINE_UNIT_HOUR );
			$this->set_band_0_pixels( _C_TIMELINE_PIXELS_HOUR_MINUTE );
			$this->set_band_1_pixels( _C_TIMELINE_PIXELS_HOUR_HOUR );
			break;
	}
}

//---------------------------------------------------------
// events
//---------------------------------------------------------
function build_events( $events )
{
	$arr = array();
	foreach( $events as $event )
	{
		$temp = $event;
		$temp = $this->supplement_dates( $temp );
		$temp = $this->remove_linecode( $temp );
		$arr[] = $temp;
	}
	return $arr;
}

function supplement_dates( $event )
{
	$event = $this->supplement_date_common( $event, 'start' );
	$event = $this->supplement_date_common( $event, 'end' );
	$event = $this->supplement_date_common( $event, 'latest_start' );
	$event = $this->supplement_date_common( $event, 'earliest_end' );
	return $event;
}

function supplement_date_common( $event, $prefix )
{
	$year    = $prefix .'_year';
	$month   = $prefix .'_month';
	$month_1 = $prefix .'_month_1';
	$day     = $prefix .'_day';
	$hour    = $prefix .'_hour';
	$minute  = $prefix .'_minute';
	$second  = $prefix .'_second';
	$tz      = $prefix .'_tz';

	if ( isset( $event[ $year ] ) ) {
		// month: Jan = 0
		if ( isset( $event[ $month ] ) ) {
			$event[ $month_1 ] = $event[ $month ] - 1;
		} else {
			$event[ $month ] = 1;
			$event[ $month_1 ] = 0;
		}
		if ( !isset( $event[ $day ] ) ) {
			$event[ $day ] = 1;
		}
		if ( !isset( $event[ $hour ] ) ) {
			if ( isset( $event[ $tz ] ) && ( $event[ $tz ] == 'GMT' ) ) {
				// set UTC
				$event[ $hour ] = $this->_timezone;
			} else {
				$event[ $hour ] = 0;
			}
		}
		if ( !isset( $event[ $minute ] ) ) {
			$event[ $minute ] = 0;
		}
		if ( !isset( $event[ $second ] ) ) {
			$event[ $second ] = 0;
		}
	}
	return $event;
}

function remove_linecode( $params )
{
	$search = array("\r\n", "\n", "\r");
	$arr = array();
	foreach( $params as $k => $v ){
		$arr[ $k ] = str_replace( $search, '', $v );
	}
	return $arr;
}

//---------------------------------------------------------
// option
//---------------------------------------------------------
function get_unit_lang_array()
{
	$arr = array(
//		'millisecond'=> $this->get_lang( 'UNIT_MILLISECOND' ) ,
//		'second'     => $this->get_lang( 'UNIT_SECOND' ) ,
//		'minute'     => $this->get_lang( 'UNIT_MINUTE' ) ,
		'hour'       => $this->get_lang( 'UNIT_HOUR' ) ,
		'day'        => $this->get_lang( 'UNIT_DAY' ) ,
		'week'       => $this->get_lang( 'UNIT_WEEK' ) ,
		'month'      => $this->get_lang( 'UNIT_MONTH' ) ,
		'year'       => $this->get_lang( 'UNIT_YEAR' ) ,
		'decade'     => $this->get_lang( 'UNIT_DECADE' ) ,
		'century'    => $this->get_lang( 'UNIT_CENTURY' ) ,
		'millennium' => $this->get_lang( 'UNIT_MILLENNIUM' ) ,
	);

	return $arr;
}

function get_int_unit_array()
{
	$arr = array(
//		_C_TIMELINE_UNIT_MILLISECOND => 'millisecond' ,
		_C_TIMELINE_UNIT_SECOND      => 'second' ,
		_C_TIMELINE_UNIT_MINUTE      => 'minute' ,
		_C_TIMELINE_UNIT_HOUR        => 'hour' ,
		_C_TIMELINE_UNIT_DAY         => 'day' ,
		_C_TIMELINE_UNIT_WEEK        => 'week' ,
		_C_TIMELINE_UNIT_MONTH       => 'month' ,
		_C_TIMELINE_UNIT_YEAR        => 'year' ,
		_C_TIMELINE_UNIT_DECADE      => 'decade' ,
		_C_TIMELINE_UNIT_CENTURY     => 'century' ,
		_C_TIMELINE_UNIT_MILLENNIUM  => 'millennium' ,
//		_C_TIMELINE_UNIT_EPOCH       => 'epoch' ,
//		_C_TIMELINE_UNIT_ERA         => 'era' ,
	);
	return $arr;
}

//---------------------------------------------------------
// language
//---------------------------------------------------------
function get_lang( $name )
{
	return $this->_language_class->get_constant( $name );
}

//---------------------------------------------------------
// set param
//---------------------------------------------------------
function set_show_element( $val )
{
	$this->_show_element = (bool)$val ;
}

function set_show_onload( $val )
{
	$this->_show_onload = (bool)$val ;
}

function set_show_onresize( $val )
{
	$this->_show_onresize = (bool)$val ;
}

function set_show_timeout( $val )
{
	$this->_show_timeout = (bool)$val ;
}

function set_timeout( $val )
{
	$this->_timeout = intval($val) ;
}

function set_height( $val )
{
	$this->_height = $val ;
}

function set_width( $val )
{
	$this->_width = $val ;
}

function set_style( $val )
{
	$this->_style = $val;
}

function set_element( $val )
{
	$this->_element = $val;
}

function set_element_name( $val )
{
	$this->_element_name = $val ;
}

function set_center_date( $val )
{
	$this->_center_date = $val ;
}

function set_band_0_unit( $val )
{
	$this->_band_0_unit = $val ;
}

function set_band_1_unit( $val )
{
	$this->_band_1_unit = $val ;
}

function set_band_0_pixels( $val )
{
	$this->_band_0_pixels = $val ;
}

function set_band_1_pixels( $val )
{
	$this->_band_1_pixels = $val ;
}

// --- class end ---
}

?>