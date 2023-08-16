<?php
	require "../db_connect.php";
	require "../message_display.php";
	require "verify_librarian.php";
	require "header_librarian.php";
?>

<html>
	<head>
		<title>Agregar Libro</title>
		<link rel="stylesheet" type="text/css" href="../css/global_styles.css" />
		<link rel="stylesheet" type="text/css" href="../css/form_styles.css" />
		<link rel="stylesheet" href="css/insert_book_style.css">
	</head>
	<body>
		<form class="cd-form" method="POST" action="#">
			<legend>Ingresa toda la información del libro</legend>
			
				<div class="error-message" id="error-message">
					<p id="error"></p>
				</div>
				
				<div class="icon">
					<input class="b-ID" id="b_ID" type="number" name="b_ID" placeholder="ID" required />
				</div>
				
				<div class="icon">
					<input class="b-title" type="text" name="b_title" placeholder="Título" required />
				</div>
				
				<div class="icon">
					<input class="b-author" type="text" name="b_author" placeholder="Autor" required />
				</div>
				
				<div class="icon">

				
					<input class="b-category" type="text"name="b_category" placeholder="Categoria" required>
						
				</div>
				
				<div class="icon">
					<input class="b-price" type="number" name="b_price" placeholder="Precio" required />
				</div>
				
				<div class="icon">
					<input class="b-copies" type="number" name="b_copies" placeholder="Número de Copias" required />
				</div>
				
				<br />
				<input class="b-ID" type="submit" name="b_add" value="Agregar" />
		</form>
	<body>
	
	<?php
		if(isset($_POST['b_add']))
		{
			$query = $con->prepare("SELECT id_titulo FROM book WHERE id_titulo = ?;");
			$query->bind_param("s", $_POST['b_ID']);
			$query->execute();
			
			if(mysqli_num_rows($query->get_result()) != 0)
				echo error_with_field("Ya existe un libro con ese ID", "b_ID");
			else
			{
				$query = $con->prepare("INSERT INTO book VALUES(?, ?, ?, ?, ?, ?);");
				$query->bind_param("ssssdd", $_POST['b_ID'], $_POST['b_title'], $_POST['b_author'], $_POST['b_category'], $_POST['b_price'], $_POST['b_copies']);
				
				if(!$query->execute())
					die(error_without_field("ERROR: No se pudo agregar el libro"));
				echo success("Libro Agregado Satisfactoriamente");
			}
		}
	?>
</html>