/**
 * Created by root on 19.07.14.
 */

var chart = null;

Highcharts.setOptions({
    global: {
        useUTC: false
    }
});

var chartOptions = {
    chart: {
        renderTo: 'chart',
        defaultSeriesType: 'spline',
        events: {
            //load: requestData
        }
    },
    title: {
        text: 'График показаний измерительных приборов МЭК'
    },
    subtitle: {
        text: 'динамика измерений за последний час'
    },
    plotOptions: {
        series: {
            lineWidth: 1,
            marker: {
                symbol: 'circle',
                enabled: false,
                fillColor: '#fff',
            }
        }
    },
    xAxis: {
        type: 'datetime',
        //tickPixelInterval: 150,
        tickInterval: 5 * 60 * 1000,
        labels: {
            format: '{value:%H:%M}'
        },
        title: {
            text: 'время, чч:мм'
        },
        showEmpty: false
    },
    yAxis: [ {
        id: 'power',
        minPadding: 0.2,
        maxPadding: 0.2,
        floor: 0,
        ceiling: 300,
        title: {
            text: 'выходная мощность, Вт'
        },
        showEmpty: false
    }, {
        id: 'velocity',
        title: {
            text: 'скорость вращения, об./мин.'
        },
        lineColor: '#61a9dc',
        lineWidth: 1,
        showEmpty: false
    }, {
        id: 'level',
        floor: 0,
        ceiling: 100,
        opposite: true,
        title: {
            text: 'уровень заряда, %'
        },
        lineColor: '#eee',
        lineWidth: 5,
        showEmpty: false
    }
    ],
    series: [{
        id: 'top',
        name: indications.top.text,
        yAxis: 'power',
        visible: false,
        color: '#777',
        lineWidth: 3,
        marker: {
            fillColor: '#999',
            enabled: true,
            lineColor: '#fff',
            lineWidth: 4
        },
        data: []
    }, {
        id: 'lp',
        name: indications.lp.text,
        yAxis: 'power',
        visible: false,
        color: '#a55',
        lineWidth: 3,
        marker: {
            fillColor: '#a55',
            enabled: false,
            lineColor: '#fff',
            lineWidth: 3
        },
        data: []
    }, {
        id: 'bcl',
        name: indications.bcl.text,
        yAxis: 'level',
        visible: false,
        type: 'areaspline',
        color: '#eee',
        fillColor: '#fefefe',
        lineWidth: 3,
        color: '#eee',
        zIndex: -1,
        marker: {
            radius: 5,
            lineWidth: 5,
            fillColor: '#999',
            lineColor: null
        },
        data: []
    }, {
        id: 'wtop',
        name: indications.wtop.text,
        yAxis: 'power',
        visible: false,
        lineWidth: 2,
        color: '#61a9dc',
        marker: {
            fillColor: null,
        },
        data: []
    }, {
        id: 'sbop',
        name: indications.sbop.text,
        yAxis: 'power',
        visible: false,
        color: '#ee3',
        lineWidth: 2,
        //shadow: { color: '#555' },
        data: [],
    }, {
        id: 'trv',
        name: indications.trv.text,
        yAxis: 'velocity',
        visible: false,
        color: '#61a9dc',
        lineWidth: 1,
        dashStyle: 'longDash',
        marker: {
            radius: 1,
            lineWidth: 1,
            fillColor: null
        },
        data: []
    }, {
        id: 'lost',
        type: 'line',
        yAxis: 'power',
        name: 'Потери связи',
        lineWidth: 10,
        color: '#d55',
        enableMouseTracking: false,
        showInLegend: false,
        data: []
            /*
            [(new Date()).getTime(), 0],
            [(new Date()).getTime() + 10 * 60 * 1000, 0]
        */
    }],
    noData: {
        style: {
            fontWeight: 'bold',
            fontSize: '15px',
            color: '#303030'
        }
    },
    loading: {
        labelStyle: {
            top: '35%',
        },
        style: {
            opacity: 0.25,
            backgroundColor: '#eee'
        }
    },
    lang: {
        noData: "За последний час никаких показаний от МЭК не поступало"
    }
}

function updateConnectionGraph() {

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
                color: '#fff5f5',
                //label: { text: '2 мин.' }
            });
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
}

function addDataPoints( chart, data ) {

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

function setChartData( data ) {

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
    chart.get('lost').setData(null);
}

function initChart() {
    chart = new Highcharts.Chart(chartOptions);
}

function reloadChart() {
    if ( chart !== null ) {
        $('#chart').highcharts().destroy();
        console.log('chart destroyed');
    }
    chart = new Highcharts.Chart(chartOptions);
}