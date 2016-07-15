var iAuth = {
	checkLoginStatus : function checkLoginStatus(){
		if (firebase){
			var href = window.location.href;
			firebase.auth().onAuthStateChanged(function(user) {
				if (user) {
					if (href.includes('login')){
						window.location.href = "chat";
					}
				} else {
					if (href.includes('chat')){
						window.location.href = "login";
					}
				}
			});
		}else{
			console.log('Error firebase not found');
		}
	},
	googleLogin : function googleLogin(){
		var provider = new firebase.auth.GoogleAuthProvider();
		provider.addScope('https://www.googleapis.com/auth/plus.login');
		return firebase.auth().signInWithPopup(provider);
	},
	facebookLogin : function facebookLogin(){
		var provider = new firebase.auth.FacebookAuthProvider();
		provider.addScope('user_birthday');
		return firebase.auth().signInWithPopup(provider);
	},
	logout : function logout(){
		firebase.auth().signOut().then(function() {
		  // Sign-out successful.
		  window.location.href = "login";
		}, function(error) {
		  // An error happened.
		  console.log('Error'+error);
		});
	},
	getCurrentUser: function getCurrentUser(){
		return firebase.auth().currentUser;
	}

};




		
