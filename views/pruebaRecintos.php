<html>
<head>
	<title>Prueba de Recintos</title>
</head>
<body>
	<h3>Resultado de prueba: Obtener recintos</h3>
	<?php
	$recintos = $vars['recintos'];
	?>
	<table>
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>Tipo</th>
			<th>Superficie</th>
			<th>Direccion</th>
			<th>Telefono</th>
			<th>Fotografia</th>
			<th>Puntuacion</th>
			<th>Estado</th>
			<th>ID Usuario</th>
		</tr>
				<?php
		foreach ($recintos as $key){
			?>
		<tr>
			<td><?php echo $key['idRecinto']?></td>
			<td><?php echo $key['nombre']?></td>
			<td><?php echo $key['tipo']?></td>
			<td><?php echo $key['superficie']?></td>
			<td><?php echo $key['direccion']?></td>
			<td><?php echo $key['telefono']?></td>
			<td><?php echo $key['fotografia']?></td>
			<td><?php echo $key['puntuacion']?></td>
			<td><?php echo $key['estado']?></td>
			<td><?php echo $key['idUsuario']?></td>
				
		</tr>
		<?php
		}
		?>		
	</table>
</body>
</html>