<?php
// $Id: server_info.php,v 1.1.1.1 2009/03/19 14:41:43 ohwada Exp $

//=========================================================
// timeline module
// 2009-03-15 K.OHWADA
//=========================================================

//=========================================================
// class timeline_base_lib_server_info
//=========================================================
class timeline_base_lib_server_info
{
	var $_lang_need_on = 'Need ON' ;
	var $_lang_recommend_off = 'Recommend OFF' ;

// color
	var $_SPAN_STYLE_RED   = 'color:#ff0000; font-weight:bold;';
	var $_SPAN_STYLE_GREEN = 'color:#00ff00; font-weight:bold;';
	var $_SPAN_STYLE_BLUE  = 'color:#0000ff; font-weight:bold;';

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function timeline_base_lib_server_info()
{
	// dummy
}

//---------------------------------------------------------
// server info
//---------------------------------------------------------
function build_server()
{
	$str  = "OS: ". php_uname() ."<br />\n"; 
	$str .= "PHP: ". PHP_VERSION ."<br />\n"; 
	$str .= "MySQL: ". mysql_get_server_info() ."<br />\n"; 
	$str .= "XOOPS: ". XOOPS_VERSION ."<br />\n"; 
	return $str;
}

function build_php_secure()
{
	$off  = " ( ". $this->_lang_recommend_off . " ) ";
	$str  = $this->build_ini_on_off( 'register_globals' ) . $off ."<br />\n";
	$str .= $this->build_ini_on_off( 'allow_url_fopen' )  . $off ."<br />\n";
	return $str;
}

function build_php_etc()
{
	$str  = "error_reporting: ". error_reporting() ."<br />\n";
	$str .= $this->build_ini_int( 'display_errors' ) ."<br />\n";
	$str .= $this->build_ini_int( 'memory_limit' ) ."<br />\n";
	$str .= "magic_quotes_gpc: ". intval( get_magic_quotes_gpc() ) ."<br />\n";
	$str .= $this->build_ini_int( 'safe_mode' ) ."<br />\n";
	$str .= $this->build_ini_val( 'open_basedir' ) ."<br />\n";
	return $str;
}

function build_php_iconv()
{
	$str = "iconv extention: ". $this->build_func_load( 'iconv' ) ."<br />\n" ;
	return $str;
}

function build_php_exif()
{
	$str = "exif extention: ". $this->build_func_load( 'exif_read_data' ) ."<br />\n" ;
	return $str;
}

function build_php_mbstring()
{
	$str = '' ;
	if ( function_exists('mb_internal_encoding') ) {
		$str .= "mbstring.language: ". mb_language() ."<br />\n";
		$str .= "mbstring.detect_order: ". implode (' ', mb_detect_order() ) ."<br />\n";
		$str .= $this->build_ini_val( 'mbstring.http_input' ) ."<br />\n";
		$str .= "mbstring.http_output: ". mb_http_output() ."<br />\n";
		$str .= "mbstring.internal_encoding: ". mb_internal_encoding() ."<br />\n";
		$str .= $this->build_ini_val( 'mbstring.script_encoding' ) ."<br />\n";
		$str .= $this->build_ini_val( 'mbstring.substitute_character' ) ."<br />\n";
		$str .= $this->build_ini_val( 'mbstring.func_overload' ) ."<br />\n";
		$str .= $this->build_ini_int( 'mbstring.encoding_translation' ) ."<br />\n";
		$str .= $this->build_ini_int( 'mbstring.strict_encoding' ) ."<br />\n";

	} else {
		$str .= $this->highlight_red( 'mbstring: not loaded' ) ."<br />\n";
	}

	return $str;
}

function build_php_upload()
{
	$str  = $this->build_ini_on_off( 'file_uploads' ) ;
	$str .= " ( ". $this->_lang_need_on . " ) <br />\n";
	$str .= $this->build_ini_val( 'upload_max_filesize' ) ."<br />\n";
	$str .= $this->build_ini_val( 'post_max_size' ) ."<br />\n";
	$str .= $this->build_php_upload_tmp_dir();
	return $str;
}

function build_php_upload_tmp_dir()
{
	$upload_tmp_dir = ini_get('upload_tmp_dir') ;

	$str = "upload_tmp_dir : ". $upload_tmp_dir ."<br />\n" ;

	$tmp_dirs = explode( PATH_SEPARATOR , $upload_tmp_dir ) ;
	foreach( $tmp_dirs as $dir ) 
	{
		if( $dir != "" && ( ! is_writable( $dir ) || ! is_readable( $dir ) ) ) {
			$msg = "Error: upload_tmp_dir ($dir) is not writable nor readable ." ;
			$str .= $this->highlight_red( $msg ) ."<br />\n";
		}
	}
	return $str;
}

function build_ini_int( $key )
{
	$str = $key .': '. intval( ini_get( $key ) ) ;
	return $str;
}

function build_ini_val( $key )
{
	$str = $key .': '. ini_get( $key ) ;
	return $str;
}

function build_ini_on_off( $key )
{
	$str = $key .': '. $this->build_on_off( ini_get( $key ) );
	return $str;
}

function build_func_load( $func )
{
	if ( function_exists( $func ) ) {
		$str = 'loaded';
	} else {
		$str = $this->highlight_red( 'not loaded' );
	}
	return $str;
}

function set_lang_need_on( $val )
{
	$this->_lang_need_on = $val ;
}

function set_lang_recommend_off( $val )
{
	$this->_lang_recommend_off = $val ;
}

//---------------------------------------------------------
// utility
//---------------------------------------------------------
function build_ret_msg( $ret , $msg )
{
	if ( !$ret ) {
		$msg = $this->highlight_red( $msg );
	}
	$str = $msg ."<br />\n";
	return $str ;
}

function build_on_off( $val, $flag_red=false )
{
	$str = '';
	if ( $val ) {
		$str = $this->highlight_green('on');
	} elseif ( $flag_red ) { 
		$str = $this->highlight_red('off');
	} else { 
		$str = $this->highlight_green('off');
	}
	return $str;
}

function highlight_red( $msg )
{
	$str  = '<span style="'. $this->_SPAN_STYLE_RED .'">';
	$str .= $msg;
	$str .= "</span>\n";
	return $str;
}

function highlight_green( $msg )
{
	$str  = '<span style="'. $this->_SPAN_STYLE_GREEN .'">';
	$str .= $msg;
	$str .= "</span>\n";
	return $str;
}

function highlight_blue( $msg )
{
	$str  = '<span style="'. $this->_SPAN_STYLE_BLUE .'">';
	$str .= $msg;
	$str .= "</span>\n";
	return $str;
}

// --- class end ---
}

?>