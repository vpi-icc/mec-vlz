/**
 * Created by root on 19.07.14.
 */


var cc = {
    top: {
        text: '0',
        info: '<abbr title="Суммарная выходная мощность">P<sub>общ.</sub></abbr>, Вт',
        dimension: 250,
        width: 30,
        fontsize: 30,
        fgcolor: '#777',
        bgcolor: '#d5d5d5',
        fill: '#ddd',
        total: 400,
        part: 0,
        icon: 'icon-long-arrow-up',
        iconsize: 24,
        iconcolor: '#090',
        border: 'outline'
    },
    wtop: {
        text: '0',
        info: '<abbr title="Выходная мощность турбины ветрогенератора">P<sub>ветр.</sub></abbr>, Вт',
        dimension: 200,
        width: 20,
        fontsize: 20,
        fgcolor: '#61a9dc',
        bgcolor: '#d5d5d5',
        //bgcolor: '#AED7F4',
        fill: '#ddd',
        //fill: '#C9DFF3',
        total: 300,
        part: 0,
        icon: 'icon-long-arrow-up',
        iconsize: 14,
        iconcolor: '#090',
        border: 'outline'
    },
    sbop: {
        text: '0',
        info: '<abbr title="Выходная мощность солнечной батареи">P<sub>солн.</sub></abbr>, Вт',
        dimension: 150,
        width: 25,
        fontsize: 16,
        fgcolor: '#ee3',
        bgcolor: '#555',
        fill: '#333',
        total: 100,
        part: 0,
        icon: 'icon-long-arrow-down',
        iconsize: 11,
        iconcolor: '#900',
        border: 'inline'
    }
}


function countDown(n, callback) {
    var counter = $('#countdown');
    var bgcolor = jQuery.Color(counter, 'background-color');
    var minute = setInterval( function() {
        counter.text(n);
        if ( --n < 0 ) {
            counter.animate({
                backgroundColor: '#406D41'
            }, 200, function(){
                counter.animate({
                    backgroundColor: bgcolor.toHexString()
                }, 1000)
            });
            clearInterval(minute);
            callback();
        }
    }, 1000);
}

function getNextIndications(){
    var url = '/test/grapher.php';
    var gd = chart.get('top').data;
    var tsLast = gd[gd.length-1].x;
    $.get( url, { tsLast: tsLast / 1000 } )
        .done( function( data ){
            //data = { ts: 1404161054000, top: 44, wtop: 32, sbop: 15, trv: 6700, bcl: 55 };
            if ( data == null ) {
                $('#dashboard').slideUp(500);
                $('#connection-info').slideDown(500);

                countDown(60, function() {
                    failCounter = $('#info-connection-lost');
                    m = parseInt(failCounter.text()) + 1;
                    failCounter.text(m);
                    console.log(m);
                });

                //$('#dashboard-body').fadeTo(500, 0.25);
                chart.showLoading('Временно потеряна связь с МЭК');
                return false;
            }
            if ( data.ts === tsLast ){
                return false;
            }
            $('#connection-info').slideUp(500);
            $('#dashboard-foot').slideUp(500);
            $('#dashboard-body').fadeTo(500, 1);
            chart.hideLoading();
            addDataPoints(chart, data);

            var indications = getLastIndications(data);
            setDashboardIndications(indications);
        });
}

function addDataPoints( chart, data ){

    var params = [ 'top', 'wtop', 'sbop', 'lp', 'trv', 'bcl' ];

    for ( var i = 0; i < data.ts.length; i++ )
    {
        for ( var j in params ) {
            var p = params[j];
            var point = [ data['ts'][i], data[p][i] ];
            chart.get(p).addPoint(point, false, false);
        }
    }

    chart.redraw();
}

function setChartData( chart, data ) {

    var params = [ 'top', 'wtop', 'sbop', 'lp', 'trv', 'bcl' ];
    var sd = {}; // series data

    for ( var j in params ) {
        var p = params[j];
        sd[p] = [];
        for ( var i = 0; i < data.ts.length; i++ ) {
            sd[p][i] = [ data['ts'][i], data[p][i] ];
        }
    }

    for ( var j in params ) {
        var p = params[j];
        var series = chart.get(p);
        series.setData(sd[p], false);

        if ( p === 'top' )
            series.setVisible(true);
    }
}

function setDashboardIndications( newValues ) {
    if ( newValues == null ) {
        return false;
    }
    var currentValues = getCurrentIndications();
    //newValues = { top: 40, wtop: 30, sbop: 10, trv: 5000, bcl: 100 };
    var paramsAll = [ 'top', 'wtop', 'sbop', 'trv', 'bcl', 'lp' ];
    for ( i in paramsAll ) {
        p = paramsAll[i];
        newValues[p] = Math.floor(newValues[p]);
    }
    var params = [ 'top', 'wtop', 'sbop' ];
    for ( j in params ){
        p = params[j];
        el = $('#' + p);
        el.html('');
        el.data('part', newValues[p]);
        el.data('text', newValues[p]);

        if ( newValues[p] == currentValues[p] ){
            el.removeData('icon');
        }
        else {
            var dir = newValues[p] >= currentValues[p] ? 'up' : 'down';
            el.data('icon', 'icon-long-arrow-' + dir);
            var iconcolor = ( dir === 'up' ) ? '#090' : '#900';
            el.data('iconcolor', iconcolor);
        }
        el.circliful();
    }
    $('#bcl').text(newValues.bcl);
    var levels = [ 0, 20, 20, 40, 40, 40, 60, 80, 80, 100, 100 ];
    var icon = $('#battery span[class^="icon-"]');
    icon.removeClass();
    icon.addClass('icon-battery-' + levels[Math.floor(newValues.bcl / 10)]);
    $('#trv abbr').text(newValues.trv);
    $('#lp').text(newValues.lp);
}

function getCurrentIndications(){
    return {
        top: $('#top').data('part'),
        wtop: $('#wtop').data('part'),
        sbop: $('#sbop').data('part')
        /*
         trv: $('#trv abbr').text().replace(/\s/, ''),
         bcl: $('#bcl').text()
         */
    }
}

function requestData(pid, active) {
    //var width = chart.container.style.width.slice(0, -2);
    //chart.setSize(width, 200);
    //chart.showLoading('Получение данных...');

    if ( typeof pid === "undefined" || pid === null ) {
        pid = 0;
    }

    $.getJSON('/test/grapher.php?pid=' + pid)
        .done( function( json ) {
            if ( json == null ) {
                $(chart.container).slideUp(500);
                $('#dashboard').slideUp(500);
                return false;
            }
            setChartData(chart, json);
            //chart.setSize(width, 400);

            if ( active || !pid ) {
                $('#dashboard').slideDown(500);
                var indications = getLastIndications(json);
                setDashboardIndications(indications);
                setInterval(getNextIndications, 1000 * 60);
            }
            else $('#dashboard').slideUp(500);

            $(chart.container).slideDown(500);
        })
        .fail( function( jqxhr, textStatus, error ) {
            var err = textStatus + ", " + error;
            console.log( "Request failed: " + err );
        })
        .always( function() {
            chart.hideLoading();
        });
}

function getLastIndications( data ) {

    var indications = [];
    var params = [ 'top', 'wtop', 'sbop', 'trv', 'bcl', 'lp' ];
    var iLast = data['ts'].length - 1;

    for ( var j in params ) {
        var p = params[j];
        indications[p] = Math.floor(data[p][iLast]);
    }

    return indications;
}



function toggleMap() {
    var altv = [ 'hide', 'show' ];
    var alts = [ 200, 500 ];
    var toggle = $('#btn-map-show').css('display') == 'none';

    var b1 = toggle ? altv[0] : altv[1];
    var b2 = toggle ? altv[1] : altv[0];

    var h = toggle ? alts[0] : alts[1];

    var b1 = $('#btn-map-' + b1);
    var b2 = $('#btn-map-' + b2);

    $('#map_canvas').animate({
        height: h + 'px'
    }, {
        complete: function(){
            google.maps.event.trigger(map, 'resize');
            b1.fadeOut(500, function(){
                b2.fadeIn(200);
            });
        }
    });
}