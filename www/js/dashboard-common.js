/**
 * Created by root on 24.07.14.
 */


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