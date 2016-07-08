/* ========================================================
 * $Id: timeline.js,v 1.3 2011/12/26 05:47:21 ohwada Exp $
 * http://code.google.com/p/simile-widgets/wiki/Timeline
 * ========================================================
 */

/* --------------------------------------------------------
 * change log
 * 2011-12-25
 * timeline_monet_xml()
 * --------------------------------------------------------
 */

var timeline_obj;
var timeline_resize_timer_id = null;

function timeline_simple_xml( param ) 
{
	var eventSource = new Timeline.DefaultEventSource();
	var bandinfos   = timeline_init_bandinfos( eventSource, param );

	timeline_obj = Timeline.create(document.getElementById(param["element"]), bandinfos);

	timeline_obj.loadXML( param["xml"], function(xml, url) { 
		eventSource.loadXML(xml, url); });
}

function timeline_simple_events( param, event_array ) 
{
	var eventSource = new Timeline.DefaultEventSource();
	var bandinfos   = timeline_init_bandinfos( eventSource, param );

	for( i=0 ; i< event_array.length ; i++ ){
		var event = new Timeline.DefaultEventSource.Event( event_array[i] );
		eventSource.add( event );
	}

	timeline_obj = Timeline.create(document.getElementById(param["element"]), bandinfos);
}

function timeline_painter_json( param ) 
{
	var eventSource = new Timeline.DefaultEventSource(0);

	var bandinfos = timeline_init_bandinfos_painter( eventSource, param );

	timeline_obj = Timeline.create( document.getElementById( param["element"] ), bandinfos, Timeline.HORIZONTAL );

	timeline_obj.loadJSON( param["json"], function(json, url) { 
		eventSource.loadJSON(json, url); });
}

function timeline_painter_events( param, event_array ) 
{
	var eventSource = new Timeline.DefaultEventSource(0);

	var bandinfos = timeline_init_bandinfos_painter( eventSource, param );

	for( i=0 ; i< event_array.length ; i++ ){
		var event = new Timeline.DefaultEventSource.Event( event_array[i] );
		eventSource.add( event );
	}

	timeline_obj = Timeline.create( document.getElementById( param["element"] ), bandinfos, Timeline.HORIZONTAL );

	var center_date;
	if ( param["center_date"] == null ) {
		center_date = eventSource.getLatestDate();
	} else {
		center_date = param["center_date"];
	}
	timeline_obj.getBand(0).setCenterVisibleDate( center_date );
}

function timeline_monet_xml( param ) 
{
	var eventSource = new Timeline.DefaultEventSource(0);
	var bandInfos   = timeline_init_bandinfos_monet( eventSource, param );

	timeline_obj = Timeline.create( document.getElementById(param["element"]), bandInfos, Timeline.HORIZONTAL );

	timeline_obj.loadXML( param["xml"], function(xml, url) { 
		eventSource.loadXML(xml, url); });
}

function timeline_monet_events( param, event_array ) 
{
	var eventSource = new Timeline.DefaultEventSource(0);
	var bandInfos   = timeline_init_bandinfos_monet( eventSource, param );

	for( i=0 ; i< event_array.length ; i++ ){
		var event = new Timeline.DefaultEventSource.Event( event_array[i] );
		eventSource.add( event );
	}

	timeline_obj = Timeline.create( document.getElementById(param["element"]), bandInfos, Timeline.HORIZONTAL );
}

function timeline_init_bandinfos( eventSource, param ) 
{
	var bandinfos = [
		Timeline.createBandInfo({
			eventSource:    eventSource,
			date:           param["band_0_date"],
			width:          param["band_0_width"], 
			intervalPixels: param["band_0_pixels"],
			intervalUnit:   param["band_0_unit"]
		}),

		Timeline.createBandInfo({
			eventSource:    eventSource,
			date:           param["band_1_date"],
			width:          param["band_1_width"], 
			intervalPixels: param["band_1_pixels"],
			intervalUnit:   param["band_1_unit"] 
		})
	];

	bandinfos[1].syncWith  = param["band_1_syncwith"];
	bandinfos[1].highlight = param["band_1_highlight"];

	return bandinfos;
}

function timeline_init_bandinfos_painter( eventSource, param ) 
{
// the default stand-alone icon
	var theme = Timeline.ClassicTheme.create();
	theme.event.instant.icon = param["icon_alone"];
	theme.event.instant.iconWidth  = 40;
	theme.event.instant.iconHeight = 40;

	var bandinfos = [
		Timeline.createBandInfo({
			eventSource:    eventSource,
			theme:          theme,
			date:           param["band_0_date"],
			width:          param["band_0_width"], 
			intervalPixels: param["band_0_pixels"],
			intervalUnit:   param["band_0_unit"],
			eventPainter:   Timeline.CompactEventPainter,

// per-event custom icons
			eventPainterParams: {
				iconLabelGap:     5,
				labelRightMargin: 20,
				iconWidth:        80, 
				iconHeight:       80,

// default icon in stacks 
				stackConcurrentPreciseInstantEvents: {
					limit: 5,
					moreMessageTemplate: "%0 More Events",
					icon:                 param["band_0_icon"], 
					iconWidth:            80,
					iconHeight:           80
				}
			}
		}),

		Timeline.createBandInfo({
			eventSource:    eventSource,
			theme:          theme,
			date:           param["band_1_date"],
			width:          param["band_1_width"], 
			intervalPixels: param["band_1_pixels"],
			intervalUnit:   param["band_1_unit"],
			layout:         param["band_1_layout"]
		})
	];

	bandinfos[1].syncWith = 0;
	bandinfos[1].highlight = true;
	return bandinfos;
}

function timeline_init_bandinfos_monet( eventSource, param ) 
{
	var theme = Timeline.ClassicTheme.create();
	theme.event.bubble.width = 320;
	theme.event.bubble.height = 220;
	theme.ether.backgroundColors[1] = theme.ether.backgroundColors[0];
	var d = Timeline.DateTime.parseGregorianDateTime( param["band_year"] )

	var bandInfos = [
		Timeline.createBandInfo({
			width:          "10%", 
			intervalUnit:   Timeline.DateTime.DECADE, 
			intervalPixels: param["band_0_pixels"],
			date:           d,
			showEventText:  false,
			theme:          theme
		}),
		Timeline.createBandInfo({
			width:          "90%", 
			intervalUnit:   Timeline.DateTime.DECADE, 
			intervalPixels: param["band_1_pixels"],
			eventSource:    eventSource,
			date:           d,
			theme:          theme
		})
	];

	bandInfos[0].etherPainter = new Timeline.YearCountEtherPainter({
		startDate:  "Nov 14 1840 00:00:00 GMT",
		multiple:   5,
		theme:      theme
	});

	bandInfos[0].syncWith = 1;
	bandInfos[0].highlight = false;

	bandInfos[0].decorators = [
		new Timeline.SpanHighlightDecorator({
			startDate:  "Nov 14 1840 00:00:00 GMT",
			endDate:    "Dec 05 1926 00:00:00 GMT",
			startLabel: "birth",
			endLabel:   "death",
			color:      "#FFC080",
			opacity:    50,
			theme:      theme
		})
	];

	return bandInfos;
}

function timeline_get_center_date()
{
	return timeline_obj.getBand(0).getCenterVisibleDate();
}

function timeline_resize() 
{
	if (timeline_resize_timer_id == null) {
		timeline_resize_timer_id = window.setTimeout( function() {
			timeline_resize_timer_id = null;
			timeline_obj.layout();
		}, 500);
	}
}
