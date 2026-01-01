function cancelButton() {
    var urlHome= document.getElementById("homeURL").value;
    var homeLoc= document.getElementById("homeLoc").value;
    var section= document.getElementById("section").value;
    top.location="http://"+urlHome+"/"+homeLoc+"?section="+section;
}

function popCal(where,fn){ 
/*    var dateon = "";
    if (document.forms[fn].elements[where].value != "" ) 
        dateon = document.forms[fn].elements[where].value; 
    if(dateon !== ""){ 
        dateon = dateon.split("/"); 
        dateon = dateon[2]+"-"+dateon[0]+"-"+dateon[1]; 
    } 
    var urlHome= document.getElementById("homeURL").value;
    var cal = window.open("/intranet/FRCForms/PHP-GlobalIncludes/smallcal.php?where="+where+"&fn="+fn+"&dateon="+dateon,"smallcal","width=300,height=300"); 
    cal.focus();
    */
}

function setTeamNameList(srcName, destName) {
    var webAdmin = document.getElementById("webAdmin").value;
    if ( webAdmin == "yes" ) {
        srcObj = document.getElementById(srcName);
        destObj = document.getElementById(destName);
        srcIdx = srcObj.selectedIndex;
        srcTxt = srcObj.options[srcIdx].text;
        teamTxt = srcTxt.substr(srcTxt.indexOf(" of ")+4);
        for ( i=0; i < destObj.options.length; i++ ) {
            if ( teamTxt == destObj.options[i].value ) {
                destObj.options[i].selected = true;
                destObj.selectedIndex=i;
            }
        }
    }
}
