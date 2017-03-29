/**
 * 
 */


function show(what) {
	if(!$.isArray(what)) {
		what = [what];
	}
	
	for(var i=0; i<what.length; i++) {
		_show(what[i]);
	}
}


function hide(what) {
	if(!$.isArray(what)) {
		what = [what];
	}
	
	for(var i=0; i<what.length; i++) {
		_hide(what[i]);
	}
}


function _show(id) {
	$('#'+id).show();
}

function _hide(id) {
	$('#'+id).hide();
}


function handleFocus() {
	var e = $('[_focus="1"]');
	if(e.length > 0) {
		e.get(0).focus();
	}
}

function handleHtmlLoaded() {
	handleFocus();
}