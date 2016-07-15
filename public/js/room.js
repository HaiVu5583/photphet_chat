var iRoom = {
	addRoomUser: function addRoomUser(uid, roomID){
		var updates = {};
  		updates['/room/' + roomID + '/' + uid] = uid ;
  		return firebase.database().ref().update(updates);
	},
	getRoomUser: function getRoomUser(roomID){
		return firebase.database().ref('room/' + roomID).once('value');
	}
}