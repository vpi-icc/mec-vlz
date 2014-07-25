/**
 * Created by root on 24.07.14.
 */


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



function getNextIndications(){
    var url = '/test/grapher.php';
    var gd = chart.get('top').data;
    var tsLast = gd[gd.length-1].x;
    $.get( url, { tsLast: tsLast / 1000 } )
        .done( function( data ) {
            //data = { ts: 1404161054000, top: 44, wtop: 32, sbop: 15, trv: 6700, bcl: 55 };
            if ( data == null ) {
                dashboard.slideUp(5500);
                $('#connection-info').slideDown(1000);
                countDown(60, updateConnectionInfoCounter);
                updateConnectionGraph();
                //chart.showLoading('Временно потеряна связь с МЭК');
                return false;
            }
            if ( data.ts === tsLast ){
                return false;
            }
            $('#connection-info').slideUp(1000);
            //chart.hideLoading();
            addDataPoints(chart, data);
            updateConnectionGraph();
            $('#info-connection-lost').text('1');

            var values = getLastIndications(data);
            updateIndications(values);
            setDashboardIndications();
            dashboard.slideDown(1500);
            countDown(60);
        });
}

function requestData(pid, active) {
    //var width = chart.container.style.width.slice(0, -2);
    //chart.setSize(width, 200);
    //chart.showLoading('Получение данных...');

    //reloadChart();

    if ( typeof pid === "undefined" || pid === null ) {
        pid = 0;
    }

    $.getJSON('/test/grapher.php?pid=' + pid)
        .done( function( json ) {
            if ( json == null ) {
                $('#chart').hide();
                dashboard.hide();
                //toggleMap();
                $('#info-mec-offline').slideDown(500);
                return false;
            }
            setChartData(json);
            //chart.setSize(width, 400);

            if ( active || !pid ) {
                var values = getLastIndications(json);
                updateIndications(values);
                setDashboardIndications();
                var n = json.ts.length;
                var now = (new Date()).getTime();
                var diff = parseInt( (now - json.ts[n-1]) / 1000 );
                if ( diff <= 60 ) {
                    dashboard.slideDown(1500);
                    //chart.hideLoading();
                }
                else {
                    var m = parseInt( diff / 60 );
                    updateConnectionInfoCounter(m);
                    $('#connection-info').slideDown(1000);
                    updateConnectionGraph(json.ts[n-1]);
                    dashboard.hide();
                    //console.log('pid: ' + pid + ', active: ' + active);
                    //chart.showLoading('Нет связи с МЭК');
                }

                countDown(60, updateConnectionInfoCounter);
                intervalId = setInterval(getNextIndications, 1000 * 60);
                $('#infoblock-countdown').slideDown(1500);
            }
            else {
                //console.log('switched ok');
                clearInterval(intervalId);
                dashboard.slideUp(500);
                $('#infoblock-countdown').slideUp(500);
                chart.setTitle(chart.options.title, null);
            }

            //var width = chart.container.style.width.slice(0, -2);
            //chart.setSize(width-200, 500);
            //chart.redraw();
            //chart.reflow();
            $('#chart').show(1500);
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
