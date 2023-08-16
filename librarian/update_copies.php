<?php
	require "../db_connect.php";
	require "../message_display.php";
	require "verify_librarian.php";
	require "header_librarian.php";
?>

<html>
	<head>
		<title>Actualización de Copias</title>
		<link rel="stylesheet" type="text/css" href="../css/global_styles.css" />
		<link rel="stylesheet" type="text/css" href="../css/form_styles.css" />
		<link rel="stylesheet" href="css/update_copies_style.css">
	</head>
	<body>
		<form class="cd-form" method="POST" action="#">
			<legend>Ingresa la información</legend>
			
				<div class="error-message" id="error-message">
					<p id="error"></p>
				</div>
				
				<div class="icon">
					<input class="b-ID" type='text' name='b_ID' id="b_ID" placeholder="ID del libro" required />
				</div>
					
				<div class="icon">
					<input class="b-copies" type="number" name="b_copies" placeholder="Número de copias a agregar" required />
				</div>
						
				<input type="submit" name="b_add" value="Agregar copias" />
		</form>
	</body>
	
	<?php
		if(isset($_POST['b_add']))
		{
			$query = $con->prepare("SELECT id_titulo FROM book WHERE id_titulo = ?;");
			$query->bind_param("s", $_POST['b_ID']);
			$query->execute();
			if(mysqli_num_rows($query->get_result()) != 1)
				echo error_with_field("ID inválido", "b_ID");
			else
			{
				$query = $con->prepare("UPDATE book SET copies = copies + ? WHERE id_titulo = ?;");
				$query->bind_param("ds", $_POST['b_copies'], $_POST['b_ID']);
				if(!$query->execute())
					die(error_without_field("ERROR: No se pudieron agregar copias"));
				echo success("Copias actualizadas con éxito");
			}
		}
	?>
</html>