sfHover = function() {
	var sfEls = document.getElementById("nav").getElementsByTagName("LI");
	for (var i=0; i<sfEls.length; i++) {
		sfEls[i].onmouseover=function() {
			this.className+=" sfhover";
         if (document.getElementById("sermonLists")) {
            document.getElementById("sermonLists").style.visibility="hidden";
         }
		}
		sfEls[i].onmouseout=function() {
			this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
			if (document.getElementById("sermonLists")) {
            document.getElementById("sermonLists").style.visibility="visible";
			}
		}
	}
}
if (window.attachEvent) window.attachEvent("onload", sfHover);