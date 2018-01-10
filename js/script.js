(function() {

var links = document.getElementsByClassName('nav')[0].getElementsByTagName("a");
for (var i = 0; i < links.length; i++) {
	if (links[i].getAttribute("href") == window.location.pathname) {
		links[i].parentElement.className = "active";
		break;
	}
}

})();