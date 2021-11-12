<<<<<<< HEAD
<h1>Iniciar Sesion</h1>

<form id="sesion_data" method="POST" 
      enctype="application/x-www-form-urlencoded">
	<input type="text" />
	<input type="password" />
	<button type="submit" onsubmit="log_in">Entrar</button>
</div>

<script>
	function log_in(e) {
		e.preventDefault()
=======
<main>
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
</main>


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
>>>>>>> 468f93e19ab0ae12c32e92a979e55b113d2bd94e
	}
</script>
