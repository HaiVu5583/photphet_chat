var iUser = {
	getUser: function getUser(uid){
		return firebase.database().ref('users/' + uid).once('value');
	},
	addUser: function addUser(uid, photo, displayName){
		return firebase.database().ref('users/' + uid).set({
			uid: uid,
			photo: photo,
			displayName: displayName
		});
	},
	updateOnlineStatus: function updateOnlineStatus(uid, onlineStatus){
		var updates = {};
  		updates['/users/' + uid] = {online: onlineStatus};
		return firebase.database().ref().update(updates);
	}
}