var iNotification = {
	notify: function notify(sender, message){
		var icon = "img/loser.png";
		if (!("Notification" in window)) {
			console.log("This browser does not support desktop notification");
		}else if (Notification.permission === "granted") {
			this.buildNotification(sender, message, icon);
		}else if (Notification.permission !== 'denied') {
			Notification.requestPermission(function (permission) {
				if (permission === "granted") {
					this.buildNotification(sender, message, icon);
				}
			});
		}
	},
	buildNotification: function buildNotification(title, body, icon){
		var options = {
			body: body,
			icon: icon
		}
		var notification = new Notification(title, options);
		notification.onclick = function(event){
			window.focus();
			notification.close();
		}
	}
};