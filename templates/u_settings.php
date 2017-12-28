<main role="main" class="container">
	<div class="container">
		<div class="d-flex justify-content-center" >
			<div class="card card-block u_settings_col p-3 text-center">
				<h4 class="card-title">Nutzerdaten</h4>
				<form class="form-control card-text">
					Nutzername
					<input class="form-control inputs mx-auto text-center" disabled name="uname" type="text" value="{settings_uname}"></input>
					<br>
					Email: 
					<input class="form-control inputs2 mx-auto text-center" name="email" type="text" placeholder="{settings_email}"></input>
					<br>
					Password: <br>
					Zuletzt geändert am
					<br>
					{settings_changedate}
					<br>
					<br>
					<button type="submit" name="form" class="btn btn-primary ">Ändern</button>
				</form>
			</div>
			<div class="card card-block u_settings_col p-3 text-center">
				<h4 class="card-title">Passwort ändern</h4>
				<form class="form-control card-text">
					Altes Passwort
					<input class="form-control mx-auto inputs2" name="pword" type="password"></input>
					<br>
					Neues Passwort
					<input class="form-control mx-auto inputs2" name="pword" type="password"></input>
					Wiederholen
					<input class="form-control mx-auto inputs2" name="pword" type="password"></input>
					<br>
					<button type="submit" name="form" class="btn btn-primary ">Ändern</button>
				</form>
			</div>
		</div>
	</div>
</main>