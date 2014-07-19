/**
 * Created by root on 19.07.14.
 */




Highcharts.setOptions({
    global: {
        useUTC: false
    }
});

var chart = new Highcharts.Chart({

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
        tickPixelInterval: 150,
        tickInterval: 5 * 60 * 1000,
        labels: {
            format: '{value:%H:%M}'
        },
        title: {
            text: 'время, мм:сс'
        },
        showEmpty: false
    },
    yAxis: [ {
        id: 'power',
        minPadding: 0.2,
        maxPadding: 0.2,
        floor: -300,
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
    /*
     colors: [
     '#000',
     ],
     */

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
    },
});

console.log(chart);