var links = document.getElementsByClassName('nav')[0].getElementsByTagName("a");
for (var i = 0; i < links.length; i++) {
	if (links[i].getAttribute("href") === window.location.pathname) {
		links[i].parentElement.className = "active";
		break;
	}
}

var filename = window.location.pathname;
if (filename === '/events.php') {
	function setEventModal(eventName, eventDetail, isEventEnded) {
		var modalContent = document.getElementsByClassName('modal-content')[0];

		// Aesthetics 
		if (eventDetail !== 'ERROR: No such event.') {
			modalContent.getElementsByClassName('modal-title')[0].textContent = eventName;
			modalContent.getElementsByClassName('event-organizer')[0].textContent = eventDetail['organizer'];
			modalContent.getElementsByClassName('event-time')[0].textContent = eventDetail['time'];
			modalContent.getElementsByClassName('event-date')[0].textContent = eventDetail['date'];
			modalContent.getElementsByClassName('event-venue')[0].textContent = eventDetail['venue'];
			modalContent.getElementsByClassName('event-description')[0].textContent = eventDetail['description'];
		}

		// Inputs
		if (isEventEnded || eventDetail === 'ERROR: No such event.') { // Hide going button
			modalContent.getElementsByClassName('going-btn')[0].classList.add('hidden');
		} else { // Show going button
			modalContent.getElementsByClassName('input-event-name')[0].value = eventName;
			var goingButton = modalContent.getElementsByClassName('going-btn')[0];
			goingButton.classList.remove('hidden');
			if (eventDetail['attendance']) { // Make going button blue
				goingButton.classList.remove('btn-default');
				goingButton.classList.add('btn-primary');
				modalContent.getElementsByClassName('input-attendance')[0].value = true;
			} else { // Make going button white
				goingButton.classList.remove('btn-primary');
				goingButton.classList.add('btn-default');
				modalContent.getElementsByClassName('input-attendance')[0].value = false;
			}
		}
	};

	// Reference: https://stackoverflow.com/questions/22119673
	function findAncestor(el, cls) {
		while ((el = el.parentElement) && !el.classList.contains(cls));
		return el;
	}

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
				var isEventEnded = findAncestor(e.target, 'tab-pane').id === 'past';
				setEventModal(eventName, JSON.parse(xhr.responseText), isEventEnded);
			} else {
				console.log('Request failed.  Returned status of ' + xhr.status);
			}
		};
		xhr.send();
	};

	// Assign a click event listener to the wrapper of event cards
	var eventsWrapper = document.getElementsByClassName('tab-content')[0];
	eventsWrapper.addEventListener('click', eventWellHandler);
} else if (filename === '/dashboard.php') {
    function setEventModal(eventName, attendees) {
        var modalContent = document.getElementsByClassName('modal-content')[0];
		modalContent.getElementsByClassName('modal-title')[0].textContent = eventName;
		if (eventName === "ERROR:  No such event.") {
			return;
		}
        modalContent.getElementsByClassName('attendees-count')[0].textContent = attendees.length;
        // Get UL.
        // Remove all previous children.
        var ul = document.getElementById('attendees_list');
        while (ul.firstChild) {
            ul.removeChild(ul.firstChild);
        }
        // Append new li children.
        for (var i = 0; i < attendees.length; i++) {
            var li = document.createElement('li');
            li.appendChild(document.createTextNode(attendees[i]['name']));
            li.className = "list-group-item";
            ul.appendChild(li);
        }
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

		// AJAX's POST request to retrieve details of this specific event
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "api.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("eventAttendees=true&eventName="+eventName);

		xhr.onload = function() {
			if (xhr.status === 200) {
                console.log(xhr.responseText);
				setEventModal(eventName, JSON.parse(xhr.responseText));
			} else {
				console.log('Request failed.  Returned status of ' + xhr.status);
			}
		};
		
	};

	// Assign a click event listener to the wrapper of event cards
	var eventsWrapper = document.getElementsByClassName('tab-content')[0];
	eventsWrapper.addEventListener('click', eventWellHandler);
}