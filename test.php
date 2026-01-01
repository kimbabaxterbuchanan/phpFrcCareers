<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <title>Example of  Forms.Selection - JSFromHell.com: JavaScript Repository</title>
    </head>
    <body id="example-body">
        <div id="all">
            <div id="content">
                <h1>
                    Selection
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
                    <fieldset>
                        <legend>Selection Test</legend>
                        <textarea name="text" rows="10" cols="30">
www.jsfromhell.com
Jonas Carlos Lalala
Bin Laden x Bush
                        </textarea><br />
                        <input name="getText" type="button" value="[Get selected text]" />
                        <input name="getSel" type="button" value="[Get cursor]" />
                        <br /><input name="setText" type="button" value="[Set selected text]" />
                        <input name="setSel" type="button" value="[Set cursor]" />
                    </fieldset>
                </form>



            </div>
        </div>
        <script type="text/javascript">
            //<![CDATA[

            var f = document.forms.form;
            var selection = new Selection(f.text);

            f.getText.onclick = function(){
                alert(selection.getText());
                f.text.focus();
            };
            f.setText.onclick = function(){
                var s = prompt("New text:", selection.getText());
                s !== null && selection.setText(s);
                f.text.focus();
            };
            f.getSel.onclick = function(){
                var s = selection.getCaret();
                alert("Start: " + s.start + "\nEnd: " + s.end);
                f.text.focus();
            };
            f.setSel.onclick = function(){
                var s = selection.getCaret();
                selection.setCaret(+prompt("Start:", s.start) || 0, +prompt("End:", s.end) || 0);
                f.text.focus();
            };

            //]]>
        </script>
    </body>
</html>
