$Id: readme_jp.txt,v 1.4 2011/12/26 05:45:39 ohwada Exp $

=================================================
Version: 0.20
Date:    2011-12-25
Author:  Kenichi OHWADA
URL:     http://linux.ohwada.jp/
Email:   webmaster@ohwada.jp
=================================================

MIT Timeline を使用してタイムラインを表示するモジュールです。

変更内容
1. PHP 5.3 対応
PHP 5.3.x で推奨されない機能 を修正した
http://www.php.net/manual/ja/migration53.deprecated.php
(1) new の返り値を参照で代入すること

2. モネの生涯を追加した
3. 1970年 (unixtime) 以前に対応した


=================================================
Version: 0.11
Date:    2009-04-10
=================================================

MIT Timeline を使用してタイムラインを表示するモジュールです。

変更内容
(1) テンプレートに onload を追加した


=================================================
Version: 0.10
Date:    2009-03-15
=================================================

MIT Timeline を使用してタイムラインを表示するモジュールです。
http://code.google.com/p/simile-widgets/wiki/Timeline

● 主な機能
1. 見本
(1) 例１：XML 形式のデータを読込むシンプルな例
(2) 例２：Event オブジェクトを設定するシンプルな例
(3) 例３：JSON 形式のデータを読込む CompactEventPainter の例
(3) 例４：Event オブジェクトを設定する CompactEventPainter の例

2. API機能
他のモジュールがタイムラインを表示するためのインタフェースを提供する


● インストール
1. 共通 ( xoops 2.0.16a JP および XOOPS Cube 2.1.x )
解凍すると、html と xoops_trust_path の２つディレクトリがあります。
それぞれ、XOOPS の該当するディレクトリに格納ください。

イントール時に下記のような Warning が出ますが、
動作には支障ないので、無視してください。
-----
Warning [Xoops]: Smarty error: unable to read resource: "db:_inc_simple_xml_js.html" in file class/smarty/Smarty.class.php line 1095
-----

2. xoops 2.0.18
上記に加えて
(1) preload ファイルをリネームする
XOOPS_TRUST_PATH/modules/timeline/preload/_constants.php (アンダーバーあり)
 -> constants.php (アンダーバーなし)

(2) _C_TIMELINE_PRELOAD_XOOPS_2018 を有効にする
先頭の // を削除する
-----
//define("_C_TIMELINE_PRELOAD_XOOPS_2018", 1 ) ;
-----


● 謝辞
MIT Simile Project の方々に、感謝します。
- http://code.google.com/p/simile-widgets/wiki/Timeline
