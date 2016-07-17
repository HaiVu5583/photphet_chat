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
			<form class="col s12" id="login-form">
				<div class="row" id="banner">
					<span id='loser-banner'>Loser</span>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input id="email" type="text" class="validate">
						<label for="email">Email</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input id="password" type="password" class="validate">
						<label for="password">Password</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<button class="input-field col s12 btn waves-effect waves-light" type="submit" name="action" id="email-login-btn">Login
						</button>
					</div>
				</div>
			</form>
			<div class="col s12 valign-wrapper">
				<div class="col s5 valign" style="height: 1px; background-color: rgba(0,0,0,0.2);"></div>
				<div class="col s2 valign" style="text-align: center;">OR</div>
				<div class="col s5 valign" style="height: 1px; background-color: rgba(0,0,0,0.2);"></div>
			</div>

			<div class="col s12 row">
				<div class="input-field col s12">
					<button id="facebook-login-btn" class="input-field col s12 btn waves-effect waves-light blue darken-3" type="submit" name="action">Login with Facebook</button>
				</div>
				<div class="input-field col s12">
					<button id ="google-login-btn" class="input-field col s12 btn waves-effect waves-light red darken-2" type="submit" name="action">Login with Google+</button>
				</div>
				<div class="input-field col s12">
					<a id ="register-btn" class="input-field col s12 btn waves-effect waves-light" type="submit" href="register">Register an account</a>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="js/user.js"></script>
	<script type="text/javascript">
		var email = document.querySelector('#email');
		var password = document.querySelector('#password');
		document.querySelector("#google-login-btn").addEventListener("click", function(){
			iAuth.googleLogin().catch(function(error){
				Materialize.toast('Error: '+JSON.stringify(error), 3000, 'rounded');
			});
		});
		document.querySelector("#facebook-login-btn").addEventListener("click", function(){
			iAuth.facebookLogin().catch(function(error){
				console.log('Error: '+JSON.stringify(error));
				Materialize.toast('Error: '+JSON.stringify(error), 3000, 'rounded');
			});;
		});
		document.querySelector('#email-login-btn').addEventListener("click", function(){

		});
		document.querySelector('#login-form').addEventListener('submit', function(event){
			event.preventDefault();
			iAuth.emailLogin(email.value, password.value).then(function(result){
				Materialize.toast('Login Sucess! Redirecting... ', 3000, 'rounded');
			});
		});
	</script>
</body>
</html>