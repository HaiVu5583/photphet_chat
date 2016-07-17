<html>
<head>
	<title>Loser</title>
	<meta charset='utf8' />
	@include('header')
	<style type="text/css">
		@import 'https://fonts.googleapis.com/css?family=Sacramento';
		#banner{
			text-align: center;
		}
		#loser-banner{
			font-family: "Sacramento";
			font-weight: 100;
			font-size: 3em;
		}
	</style>

</head>
<body>
	<div class="row">
		<div class="col s12 m4 offset-m4 card">
			<form class="col s12" id='register-form'>
				<div class="row" id="banner">
					<span id='loser-banner'>Loser</span>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input id="display_name" type="text" aria-required="true" class="validate" required="" />
						<label for="display_name" data-error="Must fill">Display Name</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input id="email" type="email" class="validate" aria-required="true" required="" />
						<label for="email" data-error="Invalid email address">Email</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input id="password" type="password" class="validate" aria-required="true" required="" pattern=".{5,}"/>
						<label for="password">Password</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input id="repassword" type="password" class="validate" aria-required="true" required="" pattern=".{5,}"/>
						<label for="repassword">Re-type Password</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<button id ="register-btn" class="input-field col s12 btn waves-effect waves-light" type="submit" name="action">Register</button>
					</div>
				</div>
			</form>
			
		</div>
	</div>
	<script type="text/javascript" src="js/user.js"></script>
	<script type="text/javascript">
		var submitted = false;
		var password = document.querySelector('#password');
		var repassword = document.querySelector('#repassword');
		var email = document.querySelector('#email');
		var displayName = document.querySelector('#display_name');
		var defaultPhoto = "{{url('img/default-avatar.png')}}";
		document.querySelector('#register-form').addEventListener('submit', function(event){
			event.preventDefault();
			firebase.auth().createUserWithEmailAndPassword(email.value, password.value).then(function(user){
				iUser.addUser(user.uid, defaultPhoto, displayName.value).then(function(result){
					Materialize.toast('Register Sucess! Signing in... ', 3000, 'rounded');
					window.location.href = "login";
				});
				
			})
			.catch(function(error) {
				var errorCode = error.code;
				var errorMessage = error.message;
				console.log(Materialize);
				Materialize.toast('Register Error: '+errorMessage, 3000, 'rounded')
			});
		});
		repassword.addEventListener('keyup', function(event){
			if (this.value && this.value.length < 6){
				this.setCustomValidity('At least 6 character long');
			}else if(password.value && password.value.trim()!="" && password.value != this.value){
				this.setCustomValidity('Password Not Match');
			}else{
				this.setCustomValidity('');
				password.setCustomValidity('');
			}
		});
		password.addEventListener('keyup', function(event){
			if (this.value && this.value.length < 6){
				this.setCustomValidity('At least 6 character long');
			}else if(this.value && this.value.trim()!="" && repassword.value != this.value){
				this.setCustomValidity('Password Not Match');
			}else{
				this.setCustomValidity('');
				repassword.setCustomValidity('');
			}
		});
	</script>
</body>
</html>