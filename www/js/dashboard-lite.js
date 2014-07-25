/**
 * Created by root on 24.07.14.
 */


function setDashboardIndications() {
    var params = [ 'top', 'wtop', 'sbop' ];
    for ( j in params ) {
        var p = params[j];
        var el = $('#dashboard-lite #' + p);
        el.html(indications[p].value);

        var dir = el.children('i');
        dir.removeClass();
        if ( indications[p].direction !== null ) {
            dir.addClass('icon-long-arrow-' + indications[p].value.direction);
        }
    }
    $('#dashboard-lite #bcl').text(indications.bcl.value);
    $('#dashboard-lite #trv').text(indications.trv.value);
    $('#dashboard-lite #lp').text(indications.lp.value);
    var icon = $('#battery span[class^="icon-"]');
    icon.removeClass();
    icon.addClass('icon-battery-' + indications.bcl.level);
}