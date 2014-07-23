function GoogleTracking(url) {
	if (typeof(_gat) == 'object') {
		var pageTracker = _gat._getTracker("UA-22573395-1");
		pageTracker._initData();
		pageTracker._trackPageview(url);
	} else {
		window.setTimeout("GoogleTracking('" + url + "')", 500);
	}
}