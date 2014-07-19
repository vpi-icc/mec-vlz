// JavaScript Document
var iconMarker = "images/WindGen.png",
    iconActiveMarker = "images/WindGenActive.png",
    iconCurMarker = "images/WindGenCur.png";

function sendForm() {
    if (marker != null) { //loc=marker.getPosition();
        obj = $("#title");
        //var dateTo="";
        //if(!$("#isActive").prop("checked"))
        //  dateTo="&dateto="+$("#dateto").val();


        $.ajaxFileUpload({
            url: 'work/savepoint.php',
            secureuri: false,
            fileElementId: 'imgPict',
            //	dataType: 'json',
            data: {
                title: $("#title").val(),
                desc: $("#desc").val(),
                idpoint: $("#idPoint").val(),
                fileName: $("#fileName").val(),
                passwd: $("#passwd").val()
            },
            success: function (dataHTML, status) {
                data = JSON.parse(dataHTML.body.innerText);
                if (data['status'] == "ok") {
                    $("#status").html("Точка добавлена в базу");
                    $("#status").html(data['message']);
                    $("#pointInfo").fadeOut("normal");

                    bEditPoint = false;
                    //	$("#btnAddPoint").show();
                    if (marker) {
                        marker.setMap(null);
                        marker = null;
                    }
                    getMapPoints();

                } else
                    $("#status").html(data['message']);
            },
            error: function (data, status, e) {
                $("#status").html("Ошибка обработки запроса");
            }
        })
    } else
        $("#status").html("Не выбрана точка на карте!!!");

}

function initFormValidation() {
    jQuery.validator.addMethod('pattern', function (value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
    }, "Неверный ввод");
    /*jQuery.validator.addMethod('dateCompare',function(value, element, regexp) {
     var strDateTo=$("#dateto").val();
     if(strDateTo=="") return true;
     var re = new RegExp("^(\\d){4}-(\\d){2}-(\\d){2}$");
     if (!re.test(strDateTo)) return false;
     $("#isActive").attr('checked', false);
     var df=new Date( $("#datefrom").val());
     var dt=new Date( $("#dateto").val());
     return df.valueOf()<=dt.valueOf();}
     ,"Неверный ввод");
     */
    obj = $("#savePointFrm");
    $("#savePointFrm").validate({
        rules: {
            title: {
                required: true,
                pattern: "^[а-яА-Яa-zA-Z0-9 \"\'\.\(\),:\-]+$"
            },
            desc: {
                required: true,
                pattern: "^[а-яА-Я0-9 \"\'\.\(\),:a-zA-Z!?;\r\n\-=]+$"
            },
            passwd: {
                required: true,
                pattern: "^.*$"
            }
        },
        errorPlacement: function (error, element) {
            var er = element.attr("name");
            element.addClass("error");
        }
    });

}

function savePoints(location) {

}
var map;
var marker;
var bEditPoint = false;
var actMarker = null;
var allMarkers = new Array();

function initialize() {
    var mapOptions = {
        center: new google.maps.LatLng(48.81, 44.69),
        zoom: 8,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("map_canvas"),
        mapOptions);
}

function removeMarkers() {
    allMarkers.forEach(function (marker) {
        marker.setPosition(null);
    });
}

function placeMarker(location) {
    if (marker == null)
        marker = new google.maps.Marker({
            position: location,
            map: map,
            icon: "images/WindGenCur.png"
        })
    else
        marker.setPosition(location);
}

function initPointInfoForm() {
    $("#status").html("");
    $("#desc").val("");
    $("#title").val("");
    $("#datefrom").val("");
    $("#dateto").val("");
    $("#isActive").prop('checked', false);
    $("#idPoint").val("0");
    $("#fileName").val("");
    $("#btnRemPoint").hide();
    bEditPoint = true;
    marker = null;
    $("#passwd").val("");

}

function editPointForm(mar) {
    $("#status").html("");
    $("#desc").val(mar.description);
    $("#title").val(mar.pointName);
    if (mar.datefrom)
        $("#datefrom").val(mar.datefrom);
    else
        $("#datefrom").val("");
    if (mar.datefrom)
        $("#dateto").val(mar.dateto);
    else
        $("#dateto").val("");
    $("#isActive").prop('checked', mar.isactive != "0");

    marker = mar;
    $("#pointInfo").show();
    bEditPoint = true;
    $("#btnAddPoint").hide();
    $("#idPoint").val(mar.idPoint);
    $("#fileName").val(mar.fileName)
    $("#btnRemPoint").show();
    $("#passwd").val("");

}

function delPoint() {
    $.ajax({
        url: "work/delpoints.php",
        type: "POST",
        timeout: 3000,
        dataType: 'json',
        data: {
            idpoint: $("#idPoint").val(),
            fileName: $("#fileName").val(),
            passwd: $("#passwd").val()
        },
        success: function (data) {
            if (data['status'] == "ok") {
                $("#status").html("Точка удалена из базы");
                $("#pointInfo").fadeOut("normal");
                bEditPoint = false;
                //	$("#btnAddPoint").show();
                getMapPoints();
            } else
                $("#status").html(data['message']);


        },
        error: function (xhr, status) {
            $("#status").html("Не удалось удалить точку из базы");
        }
    });


}

function markerClicked(){
    //alert(this.idPoint);
    requestData(this.idPoint, this.isActive);
}

function getMapPoints() {
    removeMarkers();
    $.ajax({
        url: "/maps/work/getpoints.php",
        type: "POST",
        timeout: 3000,
        dataType: 'json',
        success: function (data) {
            if (data['status'] == "ok") {
                data["points"].forEach(function (point) {
                    var pointMarker;
                    var pLatLon = new google.maps.LatLng(point["lat"], point["lon"]);
                    if (point["dateto"] != null)
                        iconName = "/maps/images/WindGen.png";
                    else
                        iconName = "/maps/images/WindGenActive.png";
                    pointMarker = new google.maps.Marker({
                        position: pLatLon,
                        map: map,
                        icon: iconName,
                    })
                    if (point["dateto"] != null) {
                        pointMarker.dateto = point["dateto"];
                        point["active"] = false;
                    } else {
                        pointMarker.dateto = null;
                        point["active"] = true;
                    }
                    if ( point["active"] ) {
                        pointMarker.setAnimation(google.maps.Animation.BOUNCE);

                    }

                    pointMarker.pointName = point["name"];
                    pointMarker.description = point["description"];
                    pointMarker.datefrom = point["datefrom"];

                    pointMarker.isActive = point["active"];
                    pointMarker.idPoint = point["id"];
                    //pointMarker.fileName = point["filename"];
                    allMarkers.push(pointMarker);
                    var fromStr = "",
                        toStr = "",
                        imgStr = "";
                    if (point["datefrom"] != null)
                        fromStr = "<p class='infoSubTitle'>МЭК установлен <span class='spnInfo'>" + point["datefrom"] + "</span></p>";
                    if (pointMarker.dateto != null)
                        toStr = "<p class='infoSubTitle'> свернут  <span class='spnInfo'>" + point["dateto"] + "</span></p>";
                    /*
                    if (point["filename"] != null)
                        imgStr = "<img class='rightimg' src='photos/rs_" + point["filename"] + "'>";
                    */
                    var contentString = '<div id="pointContent">' +
                        "<div id='infoWTitle'>" + point["name"] + "</div><p>" +
                        imgStr + point["description"] +
                        fromStr + toStr +
                        '</p></div>';
                    var infowindow = new google.maps.InfoWindow({
                        content: contentString
                    });

                    /*
                    google.maps.event.addListener(pointMarker, 'mouseover', function () {
                        infowindow.open(map, pointMarker);
                    });

                    google.maps.event.addListener(pointMarker, 'mouseout', function () {
                        infowindow.close();
                    });
                    */


                    /*
                    google.maps.event.addListener(pointMarker, 'click', function () {
                        if (!bEditPoint) editPointForm(this);
                    });
                    */
                    google.maps.event.addListener(pointMarker, 'click', markerClicked);
                });


            } else {
                alert(data["message"]);
            }
            //$("#status").html(data['message']);


        },
        error: function (xhr, status) {
            alert('error: ' + status);
            // $("#status").html("Не удалось добавить точку в базу");
        }
    });


}

$(document).ready(function () {
    initialize();
    getMapPoints();
    //$("#pointInfo").hide();
    //initFormValidation();
    /* $("#btnAddPoint").click(function(){
     initPointInfoForm();

     $("#pointInfo").show();
     bEditPoint=true;
     $("#btnAddPoint").hide();
     });
     */
    /*
     $("#btnCancelPoint").click(function () {

     bEditPoint = false;
     //  $("#btnAddPoint").show();
     if (marker && $("#btnRemPoint").is(":hidden"))
     marker.setMap(null);
     $("#pointInfo").fadeOut("normal");
     });

     $("#btnRemPoint").click(function () {
     delPoint();
     });


     $("#isActive").bind("click", function () {
     //	$("#dateto").prop('disabled', $(this).prop("checked"));
     if ($(this).prop("checked"))
     $("#dateto").val("");

     });

     // $( "#datefrom").datepicker($.datepicker.regional[ "ru" ]);
     //  $( "#datefrom" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
     //  $( "#dateto").datepicker($.datepicker.regional[ "ru" ]);
     // $( "#dateto" ).datepicker( "option", "dateFormat", "yy-mm-dd" );

     $("#testP").click(function () {
     $("#isAct").prop('checked', true);
     });
     $("#testM").click(function () {
     $("#isAct").prop('checked', false);
     });
     */
});