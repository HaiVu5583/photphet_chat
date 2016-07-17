var iAuth = {
	checkLoginStatus : function checkLoginStatus(){
		if (firebase){
			var href = window.location.href;
			firebase.auth().onAuthStateChanged(function(user) {
				if (user) {
					if (href.includes('login')){
						Materialize.toast('Login Sucess! Redirecting... ', 3000, 'rounded');
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
		firebase.auth().signInWithRedirect(provider);
		return firebase.auth().getRedirectResult();
		// return firebase.auth().signInWithPopup(provider);
	},
	facebookLogin : function facebookLogin(){
		var provider = new firebase.auth.FacebookAuthProvider();
		provider.addScope('user_birthday');
		firebase.auth().signInWithRedirect(provider);
		return firebase.auth().getRedirectResult();
		// return firebase.auth().signInWithPopup(provider);
	},
	emailLogin: function emailLogin(email, password){
		return firebase.auth().signInWithEmailAndPassword(email, password);
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




		
