<?php
// $Id: index.php,v 1.1.1.1 2009/03/19 14:42:18 ohwada Exp $

//=========================================================
// timeline module
// 2009-03-15 K.OHWADA
//=========================================================

require '../../mainfile.php' ;
if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'set XOOPS_TRUST_PATH in mainfile.php' ) ;

$MY_DIRNAME = basename( dirname( __FILE__ ) ) ;

require XOOPS_ROOT_PATH.'/modules/'.$MY_DIRNAME.'/include/mytrustdirname.php' ; // set $mytrustdirname
require XOOPS_TRUST_PATH.'/modules/'.$MY_TRUST_DIRNAME.'/main.php' ;

?>