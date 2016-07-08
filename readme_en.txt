$Id: readme_en.txt,v 1.4 2011/12/26 05:45:39 ohwada Exp $

=================================================
Version: 0.20
Date:   2011-12-25
Author: Kenichi OHWADA
URL:    http://linux2.ohwada.net/
Email:  webmaster@ohwada.net
=================================================

This module is the timeline using MIT Timeline

* Changes *
1. Migrating to PHP 5.3
Deprecated features in PHP 5.3.x
http://www.php.net/manual/en/migration53.deprecated.php
(1) Assigning the return value of new by reference is now deprecated.

2. add Monet's life
3. supoort before 1970 (unixtime)


=================================================
Version: 0.11
Date:   2009-04-10
=================================================

This module is the timeline using MIT Timeline

* Changes *
(1) add onload in template


=================================================
Version: 0.10
Date:   2009-03-15
=================================================

This module is the timeline using MIT Timeline
http://code.google.com/p/simile-widgets/wiki/Timeline

* Main features *
1. Sample
(1) Sample1 : simple exsample using XML format data
(2) Sample2 : simple exsample using Event object
(3) Sample3 : CompactEventPainter using JSON format date
(3) Sample4 : CompactEventPainter using Event object

2. API features
This modules provide the interface for the other module to show the timeline.


* Install *
1. common ( xoops 2.0.16a JP and XOOPS Cube 2.1.x )
When you unzip the zip file, there are two directories html and xoops_trust_path.
Please copy in the directory which XOOPS correspond

When you install, the xoops output warning like the following.
Please ignore, because xoops and webphoto work well.
-----
Warning [Xoops]: Smarty error: unable to read resource: "db:_inc_simple_xml_js.html" in file class/smarty/Smarty.class.php line 1095
-----

2. xoops 2.0.18
in addition to the above

(1) rename preload file.
XOOPS_TRUUST_PATH/modules/timeline/preload/_constants.php (with undebar)
 -> constants.php (without undebar)

(2) change _C_TIMELINE_PRELOAD_XOOPS_2018 in valid
remove // at the head.
-----
//define("_C_TIMELINE_PRELOAD_XOOPS_2018", "1" )
-----


* Special Thanks *
Special thanks to MIT Simile Project.
- http://code.google.com/p/simile-widgets/wiki/Timeline

