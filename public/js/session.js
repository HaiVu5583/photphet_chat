var iSession = {
	getSession: function getSession(uid){
		return firebase.database().ref('session/' + uid).once('value');
	},
	setSession: function setSession(uid, online){
		var sessionRef = firebase.database().ref('session/' + uid);
		sessionRef.onDisconnect().remove();
		return sessionRef.set({
			uid: uid,
			online: online
		});
	},
	getSessionInstance: function getSessionInstance(){
		return firebase.database().ref('session/');
	}

}