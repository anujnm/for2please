// ** disable support for IE8 and below
function getInternetExplorerVersion() {
    var rv = -1; // Return value assumes failure.
    if (navigator.appName == 'Microsoft Internet Explorer') {
        var ua = navigator.userAgent;
        var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
        if (re.exec(ua) != null)
            rv = parseFloat(RegExp.$1);
    }
    return rv;
}
function checkVersion() {
    var msg = false;
    var ver = getInternetExplorerVersion();
    if (ver > -1) {
        if (ver >= 8.0)
            msg = false;
        else
            msg = true;
    }
    if(msg==true)
	{window.location = "error-ie.html";
	}
	
}

checkVersion();

if (navigator.appVersion.indexOf("Mac")!=-1){
jQuery(body).css("background-color","#DEDEE0");	
};
