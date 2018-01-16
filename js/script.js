var links = document.getElementsByClassName('nav')[0].getElementsByTagName("a");
for (var i = 0; i < links.length; i++) {
	if (links[i].getAttribute("href") === window.location.pathname) {
		links[i].parentElement.className = "active";
		break;
	}
}

var filename = window.location.pathname;
if (filename === '/events.php') {
	function setEventModal(eventName, eventDetail) {
		var modalContent = document.getElementsByClassName('modal-content')[0];
		modalContent.getElementsByClassName('modal-title')[0].textContent = eventName;
		if (eventDetail === 'ERROR: No such event.') {
			return;
		}
		modalContent.getElementsByClassName('event-organizer')[0].textContent = eventDetail['organizer'];
		modalContent.getElementsByClassName('event-time')[0].textContent = eventDetail['time'];
		modalContent.getElementsByClassName('event-date')[0].textContent = eventDetail['date'];
		modalContent.getElementsByClassName('event-venue')[0].textContent = eventDetail['venue'];
		modalContent.getElementsByClassName('event-description')[0].textContent = eventDetail['description'];
	};

	function eventWellHandler(e) {
		// Get event name
		var eventName;
		if (e.target.classList.contains('well')) {
			eventName = e.target.getElementsByTagName('h4')[0].textContent;
		} else if (e.target.tagName === 'P') {
			eventName = e.target.parentNode.getElementsByTagName('h4')[0].textContent;
		} else if (e.target.tagName === 'H4') {
			eventName = e.target.textContent;
		} else { // User didn't click a specific event card
			return;
		}

		// AJAX's GET request to retrieve details of this specific event
		var xhr = new XMLHttpRequest();
		xhr.open('GET', 'api.php?eventName='+eventName);
		xhr.onload = function() {
			if (xhr.status === 200) {
				setEventModal(eventName, JSON.parse(xhr.responseText));
			} else {
				console.log('Request failed.  Returned status of ' + xhr.status);
			}
		};
		xhr.send();
	};

	// Assign a click event listener to the wrapper of event cards
	var eventsWrapper = document.getElementsByClassName('tab-content')[0];
	eventsWrapper.addEventListener('click', eventWellHandler);
}