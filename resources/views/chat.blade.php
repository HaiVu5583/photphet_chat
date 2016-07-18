<html>
<head>
	<title>Loser</title>
	<meta charset='utf8' />
	@include('header')
	
	<style>
		@import 'https://fonts.googleapis.com/css?family=Sacramento';
		#banner{
			text-align: center;
		}
		#loser-banner{
			font-family: "Sacramento";
			font-weight: 100;
			font-size: 4em;
		}
		.collection{
			border: none;
		}
		.collection .collection-item{
			border: none;
		}
		#member{
			min-height: 30px;
		}
		#chat-content{
			border: 1px solid #e0e0e0;
			max-height: 50%;
			min-height: 50%;
			height: 50%;
			overflow-y: scroll;
			position: relative;
		}
		.preloader-wrapper{
			display: block;
			left: 49%;
			z-index: 10;
		}
		#user-avatar{
			width: 100%;
			height: 100%;
		}
		.online{
			background-color: #1de9b6;
		}
		.offline{
			background-color: #e4e4e4;
		}
	</style>
</head>
<body>
	<div class="fixed-action-btn horizontal click-to-toggle" id='function-btn' style="top: 10px; right: 10px;">
		<a class="btn-floating btn-large">
			<img alt="" class="circle white" id='user-avatar'>
			<!-- <i class="material-icons">menu</i> -->
		</a>
		<ul>
			<li><a class="btn-floating teal tooltipped" data-position="top" data-tooltip="Logout" id='logout'><i class="material-icons">input</i></a></li>
			<li><a class="btn-floating teal tooltipped" data-position="top" data-tooltip="Profile" id='profile'><i class="material-icons">perm_identity</i></a></li>
			
		</ul>
	</div>
	<div class='row'>
		<div class="col s12 m8 offset-m2 main-container">
			<div class="row" id="banner">
				<span id='loser-banner'>Loser</span>
			</div>
			<div class="row" id="member">
				<!-- <div class="chip teal"><img src="http://materializecss.com/images/yuna.jpg" alt="Contact Person">Long Hai</div> -->
			</div>
			<div class="row" id="chat-content">
				<div class="preloader-wrapper big active">
      <div class="spinner-layer spinner-blue">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>

      <div class="spinner-layer spinner-red">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>

      <div class="spinner-layer spinner-yellow">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>

      <div class="spinner-layer spinner-green">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>
    </div>
				<ul class="collection">
					<!-- Chat Node Template -->
					<!-- <li class="collection-item avatar">
						<span class="title">Title</span>
						<img src="http://materializecss.com/images/yuna.jpg" alt="" class="circle">
						<p>What the fuck?</p>
					</li> -->
				</ul>
			</div>
			<div class="row valign-wrapper">
				<div class="input-field col s10 valign">
					<textarea id="chatbox" class="materialize-textarea"></textarea>
				</div>
				<div class="input-filed col s2 valign" id="send-btn">
					<a class="waves-effect waves-light btn">Send<i class="material-icons">send</i></a>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="js/user.js"></script>
	<script type="text/javascript" src="js/chat.js"></script>
	<script type="text/javascript" src="js/room.js"></script>
	<script type="text/javascript" src="js/notification.js"></script>
	<script type="text/javascript" src="js/const.js"></script>
	<script type="text/javascript" src="js/session.js"></script>

	<script type="text/javascript">
		var chatbox = document.querySelector('#chatbox');
		var chatcontent = document.querySelector('#chat-content');
		var chatList = chatcontent.querySelector('.collection');
		var roomUsersInfo = [];
		var roomUsersInfoObject = {};
		var roomUsersSessionObject = {};
		
		// Asysn get current user, can't use immidiate
		//  Need review, all function need synchonize
		firebase.auth().onAuthStateChanged(function(user) {
			if (user) {
		    // User is signed in.
		    currentUser = user;

		    // Update online status
		    iSession.setSession(currentUser.uid, true);
		    var sessionInstance = iSession.getSessionInstance();
		    sessionInstance.on('child_added', function(data){
		    	var changedStatusUser = data.val();
		    	var userStatus = $('.user-status[for-user="'+changedStatusUser.uid+'"]');
		    	if (userStatus.hasClass('offline')){
		    		userStatus.removeClass('offline');
		    		userStatus.addClass('online');
		    	}
		    	if (roomUsersInfoObject[changedStatusUser.uid] && roomUsersInfoObject[changedStatusUser.uid].displayName){
		    		console.log('Need show online');
		    		Materialize.toast(roomUsersInfoObject[changedStatusUser.uid].displayName + ' now Online', 3000, 'rounded');
		    	}
		    });
		    
		     sessionInstance.on('child_removed', function(data){
		     	var changedStatusUser = data.val();
		    	var userStatus = $('.user-status[for-user="'+changedStatusUser.uid+'"]');
		    	if (userStatus.hasClass('online')){
		    		userStatus.removeClass('online');
		    		userStatus.addClass('offline');
		    	}
		    	if (roomUsersInfoObject[changedStatusUser.uid] && roomUsersInfoObject[changedStatusUser.uid].displayName){
		    		console.log('Need show offline');
		    		Materialize.toast(roomUsersInfoObject[changedStatusUser.uid].displayName + ' now Offline', 3000, 'rounded');
		    	}
		    });
		    // iSession.getSession('0NgE6zmCvGRVNlZnrPh14fLkyvK2').then(function(value){
		    // 	console.log('Value: '+JSON.stringify(value.val()));
		    // })
		    // Check if not user info, save
		    iUser.getUser(currentUser.uid).then(function(data){
		    	if (!data.val()){
		    		iUser.addUser(currentUser.uid, currentUser.photoURL, currentUser.displayName);
		    	}
		    });

		    // Get all user in default room (ID: 1)
		    iRoom.getRoomUser(1).then(function(data){
		    	var roomData = data.val();
		    	if (!roomData || !roomData[currentUser.uid]){
		    		iRoom.addRoomUser(currentUser.uid, 1);
		    	}
		    	var roomUsers = Object.keys(roomData);
		    	
		    	// Load online user
		    	var loadUserSession = new Promise(function (resolve, reject){
		    		for (var i=0; i<roomUsers.length; i++){
		    			iSession.getSession(roomUsers[i]).then(function(result){
		    				if (session=result.val()){
		    					roomUsersSessionObject[session.uid] = session;
		    				}
		    			});
		    		}
		    	});

		    	// Load all user info
		    	var loadUserInfo = new Promise(function (resolve, reject){
		    		for (var i=0; i<roomUsers.length; i++){
		    			iUser.getUser(roomUsers[i]).then(function(result){
		    				var infoItem = result.val();
	    					roomUsersInfo.push(infoItem);
		    				if (roomUsersInfo.length == roomUsers.length){
		    					resolve('Success');
		    				}
		    			});
		    		}
		    	});
		    	loadUserInfo.then(function(value){
		    		console.log('Room User Info: '+JSON.stringify(roomUsersInfo));
		    		console.log('Room User Session: '+JSON.stringify(roomUsersSessionObject));
		    		for (var i=0; i<roomUsersInfo.length;  i++){
		    			var userInfo = roomUsersInfo[i];
		    			roomUsersInfoObject[userInfo.uid] = userInfo;
		    			if (roomUsersSessionObject[userInfo.uid] && roomUsersSessionObject[userInfo.uid].online){
		    				document.querySelector('#member').innerHTML += '<div class="chip user-status online" for-user="'+userInfo.uid+'"><img src="' +userInfo.photo+'" alt="Contact Person">'+userInfo.displayName+'</div>';
		    			}else{
		    				document.querySelector('#member').innerHTML += '<div class="chip user-status offline" for-user="'+userInfo.uid+'"><img src="' +userInfo.photo+'" alt="Contact Person">'+userInfo.displayName+'</div>';
		    			}
		    			
		    		}

		    		// Show avatar of user in top right
		    		document.querySelector('#user-avatar').setAttribute('src', roomUsersInfoObject[currentUser.uid].photo);
		    		// Listen new message
		    		var messageRef = firebase.database().ref('/messages');
		    		var newestSender;
					messageRef.on('child_added', function(data) {
		    			var newMessage = data.val();
		    			newestSender = newMessage.authorID;
						 // set up new message node
						 var newMessageNode = document.createElement('li');
						 newMessageNode.className = "collection-item avatar tooltipped";
						 newMessageNode.setAttribute('data-position', 'left'); 
						 var sendDate = new Date(newMessage.timestamp);
						 newMessageNode.setAttribute('data-tooltip', sendDate.toDateString());

						  if (!roomUsersInfoObject[newMessage.authorID]){
						 	console.log(newMessage);
						 }
						 var imgAvatar = document.createElement('img');
						 imgAvatar.setAttribute('src', roomUsersInfoObject[newMessage.authorID].photo);
						 imgAvatar.className = "circle white";
						 var titleUser = document.createElement('span');
						 titleUser.setAttribute('src', 'title');
						 titleUser.setAttribute('style', 'color: rgba(0,0,0,0.3);');
						 titleUser.textContent = roomUsersInfoObject[newMessage.authorID].displayName;

						 var text = document.createElement('p');
						 text.textContent = newMessage.message;
						 newMessageNode.appendChild(imgAvatar);
						 newMessageNode.appendChild(titleUser);
						 newMessageNode.appendChild(text);
						 chatList.appendChild(newMessageNode);
						 chatcontent.scrollTop = chatcontent.scrollHeight;
						 
						 //Play sound and show notification
						 if (currentUser.uid != newMessage.authorID){
						 	notiSound.play();
						 	iNotification.notify(roomUsersInfoObject[newMessage.authorID].displayName, newMessage.message);
						 }
						 

						 // Hide loading icon
						 var loadingIcon = document.querySelector('.preloader-wrapper');
						 if (loadingIcon.style.display == '' || loadingIcon.style.display=='block'){
						 	loadingIcon.style.display = 'none';
						 }

					});
		    		
			    });

			    });

			} else {
			    // No user is signed in.
			}
		});
	
		document.addEventListener('DOMContentLoaded', function(event){
		});
		
		// Send button action
		document.querySelector('#send-btn').addEventListener('click', function(){
			if (chatbox.value && chatbox.value.trim()!=""){
				sendMessageAndUpdateUI(currentUser.uid, 1);
			}
		
		});

		// Press enter when typing
		chatbox.addEventListener('keyup', function(event){
			if(event.keyCode == 13 && chatbox.value && chatbox.value.trim()!=""){
				sendMessageAndUpdateUI(currentUser.uid, 1);
			}
		});

		// Logout button action
		document.querySelector('#logout').addEventListener('click', function(){
			iAuth.logout();
			// window.location.href = 'login';
		});
		
		// Update UI when message
		function sendMessageAndUpdateUI(userID, roomID){
			var text=chatbox.value.trim();
			chatbox.value = "";
			var sendPromise = iChat.sendMessage(userID, text, roomID);
			sendPromise.then(function(value) {
				return Promise.resolve('Success');
			}).catch(function(e) {
			  console.log('Error: '+e); // "oh, no!"
			})
		}
	</script>
</body>
</html>