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
	}
}