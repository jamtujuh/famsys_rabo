var idleTime    = null;
var timeOut     = '';
var base_url	= null;

function init(b, idleTimeConfig) {
	base_url	= b;
	idleTime	= idleTimeConfig?idleTimeConfig:30*60*1000;
	Event.observe(document.body, 'mousemove', resetIdle, true);
	Event.observe(document.body, 'click', resetIdle, true);
	Event.observe(document.body, 'keypress', resetIdle, true);
	setIdle();
}

function onIdleFunction(){
	new Ajax.Request(base_url+'/users/logout?rsn=inactivity', 
	{asynchronous:true,	onComplete:function(){document.location.href=base_url+'/users/login'}});
}

function resetIdle(){
	window.clearTimeout( timeOut );
	setIdle();
}

function setIdle(){
	timeOut = window.setTimeout( "onIdleFunction()", idleTime );
}

//Event.observe(window, 'load', init, false);
//Event.observe(window, 'unload', unloadReport, false);
