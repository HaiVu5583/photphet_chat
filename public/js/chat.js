var iChat = {
	sendMessage : function sendMessage(authorID, message, roomID){
		var timestamp = new Date().getTime();
		var messageBody = {
			authorID: authorID,
			message: message,
			roomID: roomID,
			timestamp: timestamp
		};
		// var newKey = firebase.database().ref().child('messages').push().key;
		var updates = {};
  		updates['/messages/' + timestamp] = messageBody;
  		return firebase.database().ref().update(updates);
	}
}

