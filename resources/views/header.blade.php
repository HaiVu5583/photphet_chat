<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
<link rel="shortcut icon" href="img/loser.png" />
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.1.0/firebase.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script type="text/javascript" src="js/login.js"></script>

<script>
	// Initialize Firebase
	var config = {
		apiKey: "AIzaSyDC7CYwqN6LS_Wgtv5knI6rnnEHHLFf_Ts",
		authDomain: "chatapp-7ed7f.firebaseapp.com",
		databaseURL: "https://chatapp-7ed7f.firebaseio.com",
		storageBucket: "chatapp-7ed7f.appspot.com",
	};
	firebase.initializeApp(config);
	iAuth.checkLoginStatus();

	// Flag indicate user is focusing current tab
	var isFocus;
	window.addEventListener('focus', function(){
		isFocus = true;
	});
	window.addEventListener('blur', function(){
		isFocus = false;
	});

	//Notification Sound
	var notiSound = new Audio('sound/noti.ogg');

</script>
