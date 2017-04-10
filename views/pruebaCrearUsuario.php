<html>
<head>
	<title>Prueba de Crear Usuario</title>
</head>
<body>
	<h3>Prueba de unidad: Crear Usuario</h3>
	<fieldset>
	    <legend>Ingresar los siguientes datos:</legend>
		<form action="?controlador=Usuario&accion=pruebaRegistrarUsuario" method="post" enctype="multipart/form-data">
			<table>
				<tr>
					<td width='20%'>Nombre: </td>
					<td width='55%'><input name="nombre"/></td>
				</tr>
				<tr>
					<td>Apellido: </td>
					<td><input name="apellido"/></td>
				</tr>
				<tr>
					<td>Nickname: </td>
					<td><input name="nickname"/></td>
				</tr>
				<tr>
					<td>Mail: </td>
					<td><input name="mail"/></td>
				</tr>
				<tr>
					<td>Sexo: </td>
					<td>
						<input type="radio" name="sexo" value="M" checked> Masculino<br>
						<input type="radio" name="sexo" value="F"> Femenino<br>
					</td>
				</tr>
				<tr>
					<td>Password: </td>
					<td><input type="password" name="password"/></td>
				</tr>
				<tr>
					<td>Telefono: </td>
					<td><input name="telefono"/></td>
				</tr>
				<tr>
					<td>Fecha de nacimiento: </td>
					<td><input name="date" placeholder="Formato dd-mm-aaaa"/></td>
				</tr>
				<tr>
					<td>Fotografía: </td>
					<td><input type="file" name="imagen"/></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="Probar!"/></td>
				</tr>
			</table>
		</form>
	</fieldset>
</body>
</html>