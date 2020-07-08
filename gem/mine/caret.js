var ie = (typeof document.selection != "undefined" && document.selection.type != "Control") && true;
var w3 = (typeof window.getSelection != "undefined") && true;



function getCaretPosition(element) {
    var caretOffset = 0;
    if (w3) {
        var range = window.getSelection().getRangeAt(0);
        var preCaretRange = range.cloneRange();
        preCaretRange.selectNodeContents(element);
        preCaretRange.setEnd(range.endContainer, range.endOffset);
        caretOffset = preCaretRange.toString().length;
    } else if (ie) {
        var textRange = document.selection.createRange();
        var preCaretTextRange = document.body.createTextRange();
        preCaretTextRange.moveToElementText(element);
        preCaretTextRange.setEndPoint("EndToEnd", textRange);
        caretOffset = preCaretTextRange.text.length;
    }
    return caretOffset;
}

function getCaretHTMLBegin(element) {
    var caretOffset = 0;
    if (w3) {
        var range = window.getSelection().getRangeAt(0);
        var preCaretRange = range.cloneRange();
        preCaretRange.selectNodeContents(element);
        preCaretRange.setEnd(range.endContainer, range.beginOffset);
        caretOffset = preCaretRange.toString().length;
    } else if (ie) {
        caretOffset = 'n/a';
    }
    return caretOffset;
}

function getCaretBegin(element) {
    var caretOffset = 0;
    if (w3) {
        var range = window.getSelection().getRangeAt(0);
        var preCaretRange = range.cloneRange();
        preCaretRange.selectNodeContents(element);
        preCaretRange.setEnd(range.endContainer, range.beginOffset);
        caretOffset = preCaretRange.toString().length;
    } else if (ie) {
        var textRange = document.selection.createRange();
        var preCaretTextRange = document.body.createTextRange();
        preCaretTextRange.moveToElementText(element);
        preCaretTextRange.setEndPoint("EndToStart", textRange);
        caretOffset = preCaretTextRange.text.length;
    }
    return caretOffset;
}

function getSelectionBegin(element) {
    var caretOffset = 0;
    if (w3) {
    }
    else if (ie) {
        var textRange = document.selection.createRange();
        var preCaretTextRange = document.body.createTextRange();
        preCaretTextRange.moveToElementText(element);
        preCaretTextRange.setEndPoint("EndToStart", textRange);
        caretOffset = preCaretTextRange.text.length;
    }
    return caretOffset;
}

function getSelectedRange(element) {
    var selection = {
        position: 'n/a',
        begin: 'n/a',
        end: 'n/a',
        size: 'n/a',
        htmlBegin: 'n/a',
        htmlEnd: 'n/a',
        wordBegin: 'n/a',
        wordEnd: 'n/a'
    };
    if (ie) {
        var textRange = document.selection.createRange();
        var preCaretTextRange = document.body.createTextRange();
        preCaretTextRange.moveToElementText(element);
        preCaretTextRange.setEndPoint("EndToEnd", textRange);
        selection.end = preCaretTextRange.text.length;
        
        preCaretTextRange.moveToElementText(element);
        preCaretTextRange.setEndPoint("EndToStart", textRange);
        selection.begin = preCaretTextRange.text.length;
        selection.size = selection.end - selection.begin;
    }
    return selection;
}