/**
 * Created by root on 24.07.14.
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
        total: 280,
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
        total: 200,
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
        total: 80,
        part: 0,
        icon: 'icon-long-arrow-down',
        iconsize: 11,
        //iconcolor: '#900',
        border: 'inline'
    }
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