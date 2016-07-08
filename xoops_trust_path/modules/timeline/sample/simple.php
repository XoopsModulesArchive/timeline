<?php
// $Id: simple.php,v 1.1.1.1 2009/03/19 14:41:41 ohwada Exp $

//=========================================================
// timeline module
// 2009-03-15 K.OHWADA
//=========================================================

//---------------------------------------------------------
// original
// http://simile.mit.edu/wiki/How_to_Create_Timelines
//---------------------------------------------------------
function timelime_sample_simple()
{
	$arr = array();

	$arr[] = array(
		'start'   => "May 28 2006 09:00:00 GMT" , 
		'end'     => "Jun 15 2006 09:00:00 GMT" ,
		'is_duration' => "true" ,
		'title'   => "Writing Timeline documentation" ,
		'image'   => "http://simile.mit.edu/images/csail-logo.gif" ,
		'description' => "A few days to write some documentation for &lt;a href='http://simile.mit.edu/timeline/'&gt;Timeline&lt;/a&gt;." ,
	);

	$arr[] = array(
		'start'   => "Jun 16 2006 00:00:00 GMT" , 
		'end'     => "Jun 26 2006 00:00:00 GMT" ,
		'title'   => "Friend's wedding" ,
		'description' => "I'm not sure precisely when my friend's wedding is." ,
	);

	$arr[] = array(
		'start'   => "Aug 02 2006 00:00:00 GMT" , 
		'title'   => "Trip to Beijing" ,
		'link'    => "http://travel.yahoo.com/" ,
		'description' => "Woohoo!" ,
	);

	return $arr;
}

?>