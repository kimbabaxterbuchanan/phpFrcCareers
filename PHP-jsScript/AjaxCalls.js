// this section of functions are used to load the system news div with API information. 

var aobj;
var typeForm = "";
function getUserPreferences(phpObj,formtype) {
    typeForm = formtype;
    if ( typeof phpObj != 'object')
        aobj = new getObj(phpObj);
    var url = "";
    var selIdx = aobj.selectedIndex;
    var selVal = aobj.options[selIdx].value;
    if ( formtype == 'tar') {
        url = "classes/servlets/UserPreference.php";
    }
    new Ajax.Request(url, {
        method: "post",
        parameters: "userId="+userId,
        asynchronous: false,
        onComplete: onCompleteResults,
        onSuccess: getResults,
        onFailure: failResults
    });
}

// this function is called if the Ajax call succeeds.

function getResults(REQ) {
    if ( typeForm == 'tar' ) {
        var rtnAry = request.responseText;
        var fieldAry = rtnAry[0];
        var valueAry = rtnAry[1];
        for ( i = 0; i < fieldAry.length; i++ ) {
            var field = fieldAry[i];
            var value = valueAry[i];
            if ( field.substr(0,5) == "flight") {
                var obj = document.getElementById("departure_"+field);
                obj.value=value;
                var obj = document.getElementById("return_"+field);
                obj.value=value;
            } else {
                var obj = document.getElementById(field);
                obj.value=value;
            }
        }
    }
}

// this function is called if the Ajax call fails.

function failResults(REQ) {
    var msg = "UnSpecified Error occurred... Try again...";
    if ( ajaxAction == "signature" ) {
        aobj.value="";
        msg = "You have entered an invalid Password for your signature... try again....";
    } else if ( ajaxAction == "check" ) {
    aobj.checked = false;
    msg = "The Career selection has failed to be added to your current list of careers... try again....";
} else if ( ajaxAction == "uncheck" ) {
aobj.checked = true;
msg = "The Career selection has failed to be removed to your current list of careers... try again....";
}
alert(msg);
}

// this section of functions are used to log the user into the website. The submitForm gets
// the basic element values to be passed to the servlets.
function onCompleteResults(REQ){
}


