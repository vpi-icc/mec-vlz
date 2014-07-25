/**
 * Created by root on 19.07.14.
 */

var indications = {
    top: {
        text: 'Суммарная выходная мощность',
        value: null,
        direction: null
    },
    lp: {
        text: 'Мощность нагрузки',
        value: null,
    },
    wtop: {
        text: 'Выходная мощность турбины ветрогенератора',
        value: null,
        direction: null
    },
    trv: {
        text: 'Скорость вращения лопастей турбины ветрогенератора',
        value: null
    },
    sbop: {
        text: 'Выходная мощность солнечной батареи',
        value: null,
        direction: null
    },
    bcl: {
        text: 'Уровень заряда аккумуляторной батареи',
        value: null,
        level: null
    }
};

var dashboard = null;
var intervalId = null;

var requestHandler = '/grapher.php';