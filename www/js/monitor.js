/**
 * Created by root on 19.07.14.
 */

function init() {

    dashboard = $('#dashboard');

    $('#dashboard #top').data(cc.top).circliful();
    $('#dashboard #wtop').data(cc.wtop).circliful();
    $('#dashboard #sbop').data(cc.sbop).circliful();

    initChart();
    requestData();

    // user interface
    $('#btn-map-show').click(toggleMap);
    $('#btn-map-hide').click(toggleMap);
}

function toggleMap( evt, latLngCntr ) {
    var altv = [ 'hide', 'show' ];
    var alts = [ 200, 500 ];
    var toggle = $('#btn-map-show').css('display') == 'none';

    var b1 = toggle ? altv[0] : altv[1];
    var b2 = toggle ? altv[1] : altv[0];

    var h = toggle ? alts[0] : alts[1];

    b1 = $('#btn-map-' + b1);
    b2 = $('#btn-map-' + b2);

    $('#map_canvas').animate({
        height: h + 'px'
    }, {
        complete: function(){
            google.maps.event.trigger(map, 'resize');
            if ( typeof latLngCntr === 'object' ) {
                map.setCenter(latLngCntr);
            }
            b1.fadeOut(500, function(){
                b2.fadeIn(200);
            });
        }
    });
}

function hideMap( latLngCntr ) {

    if ( $('#btn-map-show').css('display') == 'none' ) {
        toggleMap(latLngCntr);
    }
    else {
        map.setCenter(latLngCntr);
    }
}