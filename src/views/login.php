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
	}
</script>
