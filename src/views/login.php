<main>
	<div id="loading" hidden>Iniciando sesión...</div>
	<div id="message" hidden></div>
	<div id="__login_container">
		<h1>Iniciar Sesión</h1>
		<div class="field">
			<label>Usuario</label>
			<input type="text" id="user_inpt" />
		</div>

		<div class="field">
			<label>Contraseña</label>
			<input type="password" id="pass_inpt" />
		</div>

		<div class="field">
			<button id="submit_btn">Entrar</button>
		</div>
	</div>
	
</main>

<script>
	let container = document.getElementById("__login_container");
	let loading = document.getElementById("loading");
	let message = document.getElementById("message");
	let user_inpt = document.getElementById("user_inpt");
	let pass_inpt = document.getElementById("pass_inpt");
	let submit_btn = document.getElementById("submit_btn");
	
	submit_btn.onclick = function(e) {
		let form_data = new FormData();
		form_data.append("name", user_inpt.value);
		form_data.append("pass", pass_inpt.value);
		loading.hidden = false;
		message.hidden = false;
		container.hidden = true;
		_api_fetch("/api/Login?fn=login", form_data)
			.then(resp => resp.json())
			.then(jresp => {
				if(jresp.return) {
					location.replace("/menu");
				} else { 
					message.hidden = false;
					message.innerText = "Error al iniciar sesion, verifique los datos";
					loading.hidden = true;
					container.hidden = false;
				}
				console.log(jresp);
			});
	}
</script>
