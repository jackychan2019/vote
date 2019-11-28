var userAgent = navigator.userAgent.toLowerCase();
var is_opera = userAgent.indexOf('opera') != -1 && opera.version();
var is_moz = (navigator.product == 'Gecko') && userAgent.substr(userAgent.indexOf('firefox') + 8, 3);
var is_ie = (userAgent.indexOf('msie') != -1 && !is_opera) && userAgent.substr(userAgent.indexOf('msie') + 5, 3);

function $v(id) {
	return document.getElementById(id);
}

function newfunction(func){
	var args = new Array();
	for(var i=1; i<arguments.length; i++) args.push(arguments[i]);
	return function(event){
		doane(event);
		window[func].apply(window, args);
		return false;
	}
}

function changedisplay(obj, display) {
	if(display == 'auto') {
		obj.style.display = obj.style.display == '' ? 'none' : '';
	} else {
		obj.style.display = display;
	}
	return false;
}

var evalscripts = new Array();
function evalscript(s) {
	if(s.indexOf('<script') == -1) return s;
	var p = /<script[^\>]*?src=\"([^\>]*?)\"[^\>]*?(reload=\"1\")?(?:charset=\"([\w\-]+?)\")?><\/script>/ig;
	var arr = new Array();
	while(arr = p.exec(s)) {
		appendscript(arr[1], '', arr[2], arr[3]);
	}
	s = s.replace(p, '');
	p = /<script(.*?)>([^\x00]+?)<\/script>/ig;
	while(arr = p.exec(s)) {
		appendscript('', arr[2], arr[1].indexOf('reload=') != -1);
	}
	return s;
}

function checkall(form, prefix, checkall) {
	var checkall = checkall ? checkall : 'chkall';
	for(var i = 0; i < form.elements.length; i++) {
		var e = form.elements[i];
		if(e.name && e.name != checkall && (!prefix || (prefix && e.name.match(prefix)))) {
			e.checked = form.elements[checkall].checked;
		}
	}
}

function doane(event) {
	e = event ? event : window.event;
	if(is_ie) {
		e.returnValue = false;
		e.cancelBubble = true;
	} else if(e) {
		e.stopPropagation();
		e.preventDefault();
	}
}

function fetchCheckbox(cbn) {
	return $v(cbn) && $v(cbn).checked == true ? 1 : 0;
}

function getcookie(name) {
	var cookie_start = document.cookie.indexOf(name);
	var cookie_end = document.cookie.indexOf(";", cookie_start);
	return cookie_start == -1 ? '' : unescape(document.cookie.substring(cookie_start + name.length + 1, (cookie_end > cookie_start ? cookie_end : document.cookie.length)));
}

function in_array(needle, haystack) {
	if(typeof needle == 'string' || typeof needle == 'number') {
		for(var i in haystack) {
			if(haystack[i] == needle) {
					return true;
			}
		}
	}
	return false;
}

function isUndefined(variable) {
	return typeof variable == 'undefined' ? true : false;
}

function mb_strlen(str) {
	var len = 0;
	for(var i = 0; i < str.length; i++) {
		len += str.charCodeAt(i) < 0 || str.charCodeAt(i) > 255 ? (charset == 'utf-8' ? 3 : 2) : 1;
	}
	return len;
}

function setcookie(cookieName, cookieValue, seconds, path, domain, secure) {
	var expires = new Date();
	expires.setTime(expires.getTime() + seconds);
	document.cookie = escape(cookieName) + '=' + escape(cookieValue)
		+ (expires ? '; expires=' + expires.toGMTString() : '')
		+ (path ? '; path=' + path : '/')
		+ (domain ? '; domain=' + domain : '')
		+ (secure ? '; secure' : '');
}

function strlen(str) {
	return (is_ie && str.indexOf('\n') != -1) ? str.replace(/\r?\n/g, '_').length : str.length;
}

function trim(str) {
	return (str + '').replace(/(\s+)$/g, '').replace(/^\s+/g, '');
}

function _attachEvent(obj, evt, func) {
	if(obj.addEventListener) {
		obj.addEventListener(evt, func, false);
	} else if(obj.attachEvent) {
		obj.attachEvent("on" + evt, func);
	}
}
function wait_goto(gourl,zt) {
          if(zt==1) {
		           window.location.reload();
		  } else {
		           window.location.href=gourl;
		  }
}

function autoiframesize(pTar,zt) {
	if(pTar && !window.opera) {		
		if(zt==1 || zt==2) {				
		   pTar.width = "100%";				
		}		
		if(zt==0 || zt==2) {	
		   if(pTar.contentDocument && pTar.contentDocument.body.offsetHeight) {
				pTar.height = pTar.contentDocument.body.offsetHeight; 
		   } else if(pTar.Document && pTar.Document.body.scrollHeight) {
				pTar.height = pTar.Document.body.scrollHeight;
		   }
		}
	}
}

function JumpMenu(selObj) {
	if(selObj.options[selObj.selectedIndex].value!='') {
	   window.open(selObj.options[selObj.selectedIndex].value);
	}
}

function ToJumpMenu(aturl,selObj) {
	if(selObj.options[selObj.selectedIndex].value!='') {
	   window.location.href=aturl+selObj.options[selObj.selectedIndex].value;
	}
}

function GoToJump(aturl,value) {
	 window.location.href=aturl+value;
}

function closeErrors() {
   return true;
}
window.onerror=closeErrors;

var tipstime;
function disappear() {
    $(".tips").remove();
	if(tipstime) { clearTimeout(tipstime); }
}
function tips(icon,text,setime) {
    if(icon=='cls') {
			disappear();					
	} else {			
			var scrollTop,tipsTop,tipsbox,tipscontent,tipsi;
			$(".tips").remove();
			if(tipstime) { clearTimeout(tipstime); }
			scrollTop = window.pageYOffset;
			tipsTop = parseInt((document.documentElement.clientHeight-46)/3+scrollTop)+"px";
			tipsbox=$("<div></div>").addClass("tips");
			$("body").append(tipsbox);
			tipscontent=$("<span></span>")
			$(".tips").append(tipscontent);
			
			if(icon=="ok") {
				tipsi=$("<i></i>").addClass("tip-ok");
			} else if(icon=="no") {
				tipsi=$("<i></i>").addClass("tip-no");
			} else if(icon=="load") {
				tipsi=$("<i></i>").addClass("tip-load");
			} else {
				tipsi=$("<i></i>").addClass("tip-none");
			}
			$(".tips span").append(tipsi,text);
			$(".tips").css("top",tipsTop)
			if(setime>0){ tipstime = setTimeout("disappear()", (setime*1000)); }
	}
}

