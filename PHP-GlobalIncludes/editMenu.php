<?php
$fname = $_GET['fn'];
$wname = $_GET['where'];
$fwname = $fname.".".$wname;

?>
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <title>Example of  Forms.Selection - JSFromHell.com: JavaScript Repository</title>
        <script type="text/javascript">
            function getParent() {
                var txt = opener.document.<?php echo $fwname?>.value;
                return txt;
            }
            function updateParent(){
                var s = confirm("Are you sure you want to save these changes...");
                if ( s ) {
                    opener.document.<?php echo $fwname?>.value = document.forms.form.text.value;
                    window.close();
                }
            }
            function closeWindow() {
                var s = confirm("Are you sure you want to cancel these changes...");
                if ( s )
                    window.close();
            }
            function viewChanges(){
                var changeText = document.forms.form.text.value;
                var viewTxt = window.open("../PHP-GlobalIncludes/viewChanges.php?changeText="+changeText,"viewMenu");
                viewTxt.focus;
            }
        </script>
    </head>
    <body id="example-body">
        <h1>
            <?php echo $_GET['where']?>
            <a href="/forms/selection/example"></a>
        </h1>
        <script type="text/javascript">
            //<![CDATA[

            document.write = function(){
                document.getElementById("content").appendChild(document.createElement("span")).innerHTML = [].slice.call(arguments).join("");
            };

            Selection = function(input){
                this.isTA = (this.input = input).nodeName.toLowerCase() == "textarea";
            };
            with({o: Selection.prototype}){
                o.setCaret = function(start, end){
                    var o = this.input;
                    if(Selection.isStandard)
                        o.setSelectionRange(start, end);
                    else if(Selection.isSupported){
                        var t = this.input.createTextRange();
                        end -= start + o.value.slice(start + 1, end).split("\n").length - 1;
                        start -= o.value.slice(0, start).split("\n").length - 1;
                        t.move("character", start), t.moveEnd("character", end), t.select();
                    }
                };
                o.getCaret = function(){
                    var o = this.input, d = document;
                    if(Selection.isStandard)
                        return {start: o.selectionStart, end: o.selectionEnd};
                    else if(Selection.isSupported){
                        var s = (this.input.focus(), d.selection.createRange()), r, start, end, value;
                        if(s.parentElement() != o)
                            return {start: 0, end: 0};
                        if(this.isTA ? (r = s.duplicate()).moveToElementText(o) : r = o.createTextRange(), !this.isTA)
                            return r.setEndPoint("EndToStart", s), {start: r.text.length, end: r.text.length + s.text.length};
                        for(var $ = "[###]"; (value = o.value).indexOf($) + 1; $ += $);
                        r.setEndPoint("StartToEnd", s), r.text = $ + r.text, end = o.value.indexOf($);
                        s.text = $, start = o.value.indexOf($);
                        if(d.execCommand && d.queryCommandSupported("Undo"))
                            for(r = 3; --r; d.execCommand("Undo"));
                        return o.value = value, this.setCaret(start, end), {start: start, end: end};
                    }
                    return {start: 0, end: 0};
                };
                o.getText = function(){
                    var o = this.getCaret();
                    return this.input.value.slice(o.start, o.end);
                };
                o.setText = function(text){
                    var o = this.getCaret(), i = this.input, s = i.value;
                    i.value = s.slice(0, o.start) + text + s.slice(o.end);
                    this.setCaret(o.start += text.length, o.start);
                };
                new function(){
                    var d = document, o = d.createElement("input"), s = Selection;
                    s.isStandard = "selectionStart" in o;
                    s.isSupported = s.isStandard || (o = d.selection) && !!o.createRange();
                };
            }
            //]]>
        </script>

        <form id="form">

            <?php
            echo "<input type='hidden' name='fname' id='fname' value='".$fname."'>";
            echo "<input type='hidden' name='wname' id='wname' value='".$wname."'>";
            ?>

            <table>
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td>
                                    <input type=button id=crlf name=crlf value='New Line'/>
                                </td>
                                <td>
                                    <input type=button id=italic name=italic value='Italic'/>
                                </td>
                                <td>
                                    <input type=button id=bold name=bold value='Bold'/>
                                </td>
                                <td>
                                    <input type=button id=center name=center value='Center'/>
                                </td>
                                <td>
                                    <input type=button id=hr name=hr value='Horizontal Line'/>
                                </td>
                                <td>
                                    <input type=button id=underline name=underline value='Underline'/>
                                </td>
                            </tr>
                            <tr><td colspan="6">&nbsp;</td></tr>
                            <tr>
                                <td colspan=4>
                                   | <input type=button id=ol name=ol value='Indent Numbers'/>
                                    &nbsp; &nbsp;
                                    <input type=button id=li name=li value='Numbers'/> |
                                </td>
                                <td colspan=2>
                                    <input type=button id=ul name=ul value='Indent Bullets'/>
                                    &nbsp;&nbsp;
                                    <input type=button id=uli name=uli value='Bullets'/>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td colspan=3>
                                    <textarea name="text" rows="30" cols="80"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td align=center>
                                    <input type=button onclick="updateParent()" id=save name=save value='Save'/>
                                </td>
                                <td align=center>
                                    <input type=button onclick="viewChanges()" id=view name=view value='PreView Changes'/>
                                </td>
                                <td align=center>
                                    <input type=button onclick="closeWindow()" id=cancel name=cancel value='Cancel'/>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </form>
        <script type="text/javascript">
            //<![CDATA[
            var f = document.forms.form;
            var fname = f.fname;
            var wname = f.wname;
            var ff = opener.document.forms[fname.value];
            var pObj = ff.elements[wname.value];
            var v = f.text;
            v.value=pObj.value;
            var selection = new Selection(v);

            f.crlf.onclick = function(){
                var s = "<BR>";
                s !== null && selection.setText(s);
//                updateParent();
                f.text.focus();
            };
            f.ol.onclick = function(){
                var t = selection.getText();
                var s = "<ol>"+t+"</ol>";
                s !== null && selection.setText(s);
                var s = selection.getCaret();
                selection.setCaret(s.start, s.end-10);
//                updateParent();
                f.text.focus();
            };
            f.ul.onclick = function(){
                var t = selection.getText();
                var s = "<ul>"+t+"</ul>";
                s !== null && selection.setText(s);
                var s = selection.getCaret();
                selection.setCaret(s.start, s.end-10);
//                updateParent();
                f.text.focus();
            };
            f.li.onclick = function(){
                var t = selection.getText();
                var s = "<li>"+t+"</li>";
                s !== null && selection.setText(s);
                var s = selection.getCaret();
                selection.setCaret(s.start, s.end-5);
//                updateParent();
                f.text.focus();
            };
            f.uli.onclick = function(){
                var t = selection.getText();
                var s = "<li>"+t+"</li>";
                s !== null && selection.setText(s);
                var s = selection.getCaret();
                selection.setCaret(s.start, s.end-5);
//                updateParent();
                f.text.focus();
            };
            f.italic.onclick = function(){
                var t = selection.getText();
                var s = "<i>"+t+"</i>";
                s !== null && selection.setText(s);
                var s = selection.getCaret();
                selection.setCaret(s.start, s.end-4);
//                updateParent();
                f.text.focus();
            };
            f.bold.onclick = function(){
                var t = selection.getText();
                var s = "<b>"+t+"</b>";
                s !== null && selection.setText(s);
                var s = selection.getCaret();
                selection.setCaret(s.start, s.end-4);
//                updateParent();
                f.text.focus();
            };
            f.center.onclick = function(){
                var t = selection.getText();
                var s = "<center>"+t+"</center>";
                s !== null && selection.setText(s);
                var s = selection.getCaret();
                selection.setCaret(s.start, s.end-5);
//                updateParent();
                f.text.focus();
            };
            f.underline.onclick = function(){
                var t = selection.getText();
                var s = "<u>"+t+"</u>";
                s !== null && selection.setText(s);
                var s = selection.getCaret();
                selection.setCaret(s.start, s.end-4);
//                updateParent();
                f.text.focus();
            };
            f.hr.onclick = function(){
                var s = "<hr>";
                s !== null && selection.setText(s);
//                updateParent();
                f.text.focus();
            };
            //]]>
        </script>
    </body>
</html>