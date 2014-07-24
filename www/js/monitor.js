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
        //iconcolor: '#090',
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
        //iconcolor: '#090',
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
        //iconcolor: '#900',
        border: 'inline'
    }
}


function countDown(n, callback) {
    var infoblock = $('#infoblock-countdown p');
    var counter = $('#countdown');
    //var bgcolor = jQuery.Color($('#infoblock-countdown'), 'background-color');
    var minute = setInterval( function() {
        counter.text(n);
        if ( --n <= 0 ) {
            infoblock.animate({
                //backgroundColor: '#406D41'
                backgroundColor: '#7E9BF7'
            }, 100)
            .delay(500)
            .animate({
                //backgroundColor: bgcolor.toHexString()
                backgroundColor: 'transparent'
            }, 1500);
            clearInterval(minute);
            if ( typeof callback !== 'undefined' ) callback();
        }
    }, 1000);
}

function updateConnectionInfoCounter(n) {
    var failCounter = $('#info-connection-lost');
    if ( n === undefined ) {
        n = parseInt(failCounter.text()) + 1;
    }
    failCounter.text(n);
}

function updateConnectionGraph(since) {
    var series = chart.get('lost');
    var dataSeries = chart.get('top');
    var n = series.data.length;
    var m = dataSeries.data.length;
    var ts = (new Date()).getTime();
    var tsLast = dataSeries.data[m-1].x;
    var plotLineOptions = {
        value: dataSeries.data[m-1].x,
        color: '#fdd',
        width: 1
    };

    if ( ts - tsLast < 60 * 1000 ) {
        if ( dataSeries.data[m-2].y === null ) {
            var tsLinkEstalished = dataSeries.data[m-1].x;
            series.addPoint([tsLinkEstalished - 1, 0]);
            chart.xAxis[0].addPlotLine(plotLineOptions);
            var tsLinkLost = null;
            for ( var i = m - 2; i >= 0; i-- ) {
                if ( dataSeries.data[i].y !== null ) {
                    tsLinkLost = dataSeries.data[i].x;
                    break;
                }
            }
            chart.xAxis[0].addPlotBand({
                from: tsLinkLost,
                to: tsLinkEstalished,
                color: '#fdd',
                //label: { text: '2 мин.' }
            });
            //console.log('Connection established:' + dataSeries.data[m-1].y);
        }
        return;
    }

    if ( n == 0 ) {
        series.addPoint([tsLast, 0]);
    }
    else {
        series.data[n-1].update(0);
    }
    series.addPoint([ts, 0]);

    if ( dataSeries.data[m-1].y !== null ) {
        chart.xAxis[0].addPlotLine(plotLineOptions);
    }

    // if still no data received, set values of the parameters to null
    var params = [ 'top', 'wtop', 'sbop', 'lp', 'trv', 'bcl' ];

    for ( j in params ) {
        p = params[j];
        dataSeries = chart.get(p);
        dataSeries.addPoint([ts, null]);
    }

    return;

/*
    if ( typeof since !== 'undefined' ) {
        series.addPoint([since, 0]);
        series.addPoint([ts, 0]);
        return;
    }
*/

    // if there's a previous point and its' y value is null and it's a minute away
    // set its' value to zero (mark as active)
    if ( (n > 1) && (series.data[n-1].y === null) && (ts - series.data[n-1].x <= 60) ) {
        series.data[n-2].update(0);
        console.log(series.data[n-2]);
    }

    // if still no data received, set values of the parameters to null
    var params = [ 'top', 'wtop', 'sbop', 'lp', 'trv', 'bcl' ];


    if ( ts - tsLast >= 60 * 1000 ) {
        series.addPoint([ts, 0]);
        for ( j in params ) {
            p = params[j];
            dataSeries = chart.get(p);
            dataSeries.addPoint([ts, null]);
        }
        console.log('No data connection: ' + series.data[n-1].y);
    }
    else {
        series.data[n-1].update(0);
        console.log('Connection established:' + series.data[n-1].y);
    }
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
                countDown(60, updateConnectionInfoCounter);
                updateConnectionGraph();
                chart.showLoading('Временно потеряна связь с МЭК');
                return false;
            }
            if ( data.ts === tsLast ){
                return false;
            }
            $('#connection-info').slideUp(500);
            chart.hideLoading();
            addDataPoints(chart, data);
            updateConnectionGraph();
            $('#info-connection-lost').text('1');

            var values = getLastIndications(data);
            updateIndications(values);
            setDashboardIndications();

            countDown(60);
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
        var tsLast = data['ts'][data.ts.length-1];
        chart.get('lost').addPoint([tsLast, null] , false, false);
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


// update values in the 'indications' object
function updateIndications( newValues ) {

    if ( newValues == null ) {
        return false;
    }

    var params = [ 'top', 'wtop', 'sbop', 'trv', 'bcl', 'lp' ];

    // round parameters' values
    for ( i in params ) {
        p = params[i];
        newValues[p] = Math.floor(newValues[p]);
    }

    // detect values' directions changes for TOP, WTOP and SBOP
    var keyParams = [ 'top', 'wtop', 'sbop' ];
    for ( j in keyParams ){
        p = keyParams[j];
        var dir;
        if ( newValues[p] == indications[p].value ){
            dir = null; // direction is horizontal
        }
        else {
            dir = newValues[p] > indications[p].value ? 'up' : 'down';
        }
        indications[p].direction = dir;
    }

    // saving new values into memory
    for ( var i in params ) {
        p = params[i];
        indications[p].value = newValues[p];
    }

    // determining the projection of the current battery charge level
    // to a grid of 0, 20, 40, 60, 80 and 100
    var levels = [ 0, 20, 20, 40, 40, 40, 60, 80, 80, 100, 100 ];
    indications.bcl.level = levels[Math.floor(newValues.bcl / 10)];
}

function setDashboardIndications() {

    var params = [ 'top', 'wtop', 'sbop' ];
    for ( j in params ) {
        p = params[j];
        el = $('#dashboard #' + p);
        el.html('');
        el.data('part', indications[p].value);
        el.data('text', indications[p].value);

        if ( indications[p].direction === null ) {
            el.removeData('icon');
        }
        else {
            el.data('icon', 'icon-long-arrow-' + indications[p].direction);
        }
        el.circliful();
    }
    $('#dashboard #bcl').text(indications.bcl.value);
    $('#dashboard #trv abbr').text(indications.trv.value);
    $('#dashboard #lp').text(indications.lp.value);
    var icon = $('#battery span[class^="icon-"]');
    icon.removeClass();
    icon.addClass('icon-battery-' + indications.bcl.level);
}

/*
function getCurrentIndications(){
    return {
        top: $('#top').data('part'),
        wtop: $('#wtop').data('part'),
        sbop: $('#sbop').data('part')
    }
}
*/

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
                $('#chart').slideUp(500);
                $('#dashboard').slideUp(500);
                toggleMap();
                return false;
            }
            setChartData(chart, json);
            //chart.setSize(width, 400);

            if ( active || !pid ) {
                var values = getLastIndications(json);
                updateIndications(values);
                setDashboardIndications();
                var n = json.ts.length;
                var time = new Date();
                var now = time.getTime();
                var diff = parseInt( (now - json.ts[n-1]) / 1000 );
                if ( diff <= 60 ) {
                    $('#dashboard').slideDown(500);
                    chart.hideLoading();
                }
                else {
                    var m = parseInt( diff / 60 );
                    updateConnectionInfoCounter(m);
                    $('#connection-info').slideDown(500);
                    updateConnectionGraph(json.ts[n-1]);
                    chart.showLoading('Нет связи с МЭК');
                }

                countDown(60, updateConnectionInfoCounter);
                setInterval(getNextIndications, 1000 * 60);
                $('#infoblock-countdown').slideDown(500);
            }
            else $('#dashboard').slideUp(500);

            var width = chart.container.style.width.slice(0, -2);
            //chart.setSize(width-200, 500);
            //chart.redraw();
            //chart.reflow();
            $('#chart').show(500);
        })
        .fail( function( jqxhr, textStatus, error ) {
            var err = textStatus + ", " + error;
            console.log( "Request failed: " + err );
        })
        .always( function() {
        });
}

function getLastIndications( data ) {

    var values = [];
    var params = [ 'top', 'wtop', 'sbop', 'trv', 'bcl', 'lp' ];
    var iLast = data['ts'].length - 1;

    for ( var j in params ) {
        var p = params[j];
        values[p] = Math.floor(data[p][iLast]);
    }

    return values;
}



function toggleMap() {
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
            b1.fadeOut(500, function(){
                b2.fadeIn(200);
            });
        }
    });
}