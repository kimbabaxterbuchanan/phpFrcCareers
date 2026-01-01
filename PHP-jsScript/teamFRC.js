
function cancelButton() {
    var urlHome= document.getElementById("homeURL");
    var homeLoc= document.getElementById("homeLoc");
    var section= document.getElementById("section");
    var sectionVal = section.value;
    var sub_section = document.getElementById("sub_section");
    var forward_sub_section = document.getElementById("forward_sub_section");
    if (forward_sub_section.value == "yes" )
        sectionVal += "&sub_section="+sub_section.value;
    alert("http://"+urlHome.value+"/"+homeLoc.value+"?section="+sectionVal);
    location.href="http://"+urlHome.value+"/"+homeLoc.value+"?section="+sectionVal;
}

function popCal(where,fn){
    var dateon = "";
    if (document.forms[fn].elements[where].value != "" )
        dateon = document.forms[fn].elements[where].value;
    if(dateon !== ""){
        dateon = dateon.split("/");
        dateon = dateon[2]+"-"+dateon[0]+"-"+dateon[1];
    }
    var cal = window.open("PHP-GlobalIncludes/smallcal.php?where="+where+"&fn="+fn+"&dateon="+dateon,"smallcal","width=300,height=300");
    cal.focus();
}

function popEmalList(mail,name,fn){
    var mailList = window.open("PHP-GlobalIncludes/emailSelectList.php?mail="+mail+"&name="+name+"&fn="+fn,"emailSelectList","width=300,height=300");
    mailList.focus();
}
function popEmalName(mail,name,fn){
    var mailList = window.open("PHP-GlobalIncludes/emailSelectName.php?mail="+mail+"&name="+name+"&fn="+fn,"emailSelectName","width=300,height=300");
    mailList.focus();
}
function popEmalToName(mail,name,fn){
    var mailList = window.open("PHP-GlobalIncludes/emailSelectToName.php?mail="+mail+"&name="+name+"&fn="+fn,"emailSelectName","width=300,height=300");
    mailList.focus();
}
function showTextFormat(where,fn){
    var editMenu = window.open("PHP-GlobalIncludes/editMenu.php?where="+where+"&fn="+fn,"editMenu","width=900,height=1000");
    editMenu.focus();
}