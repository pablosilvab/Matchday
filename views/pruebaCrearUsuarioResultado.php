<html>
<head>
	<title>Resultado</title>
</head>

<?php
$resultado = $vars['resultado'];
if ($resultado == 1){
	$msg = "Éxito";
	$usuario = $vars['nuevoUsuario'];
	?>
<body>
	<h3>Resultado: <?php echo $msg?></h3>
	<table>
		<?php
		foreach ($usuario as $key ) {
		?>
		<tr>
			<td>ID: </td>
			<td><?php echo $key['idUsuario']?></td>
		</tr>
		<tr>
			<td>Nombre: </td>
			<td><?php echo $key['nombre']?></td>
		</tr>
		<tr>
			<td>Apellido: </td>
			<td><?php echo $key['apellido']?></td>
		</tr>
		<tr>
			<td>Nickname: </td>
			<td><?php echo $key['nickname']?></td>
		</tr>
		<tr>
			<td>Mail: </td>
			<td><?php echo $key['mail']?></td>
		</tr>
		<tr>
			<td>Sexo: </td>
			<td><?php echo $key['sexo']?></td>
		</tr>
		<tr>
			<td>Password: </td>
			<td><?php echo $key['password']?></td>
		</tr>
		<tr>
			<td>Teléfono: </td>
			<td><?php echo $key['telefono']?></td>
		</tr>
		<tr>
			<td>Fecha de nacimiento: </td>
			<td><?php echo $key['fechaNacimiento']?></td>
		</tr>
		<tr>
			<td>Perfil: </td>
			<td><?php echo $key['perfil']?></td>
		</tr>
		<tr>
			<td>Estado: </td>
			<td><?php echo $key['estado']?></td>
		</tr>
		<tr>
			<td>Fotografia</td>
			<td><?php echo $key['fotografia']?></td>
		</tr>
		<?php
		}
		?>
	</table>
</body>
</html>

	<?php
} else {
	$msg = "Fallido";
?>

<body>
	<h3>Resultado: <?php echo $msg?></h3>
	<p>El usuario no se ingreso a la base de datos.</p>
</body>
</html>
<?php
}
?>

