<main>
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
	<div id="__fogot_container">
	</div>
</main>

<!--
<script>
	let user_inpt = document.getElementById("user_inpt");
	let pass_inpt = document.getElementById("pass_inpt");
	let submit_btn = document.getElementById("submit_btn");
	
	submit_btn.onclick = function(e) {
		let form_data = new FormData();
		form_data.append("name", user_inpt.value);
		form_data.append("pass", pass_inpt.value);
		_api_fetch("/api/Login?fn=login", form_data)
			.then(resp => resp.json())
			.then(jresp => {
				
			});
	}
</script>
-->
