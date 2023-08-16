<?php

    $username = $_SESSION['username'];
    $profileImageQuery = $con->prepare("SELECT profile_image FROM member WHERE username = ?");
    $profileImageQuery->bind_param("s", $username);
    $profileImageQuery->execute();
    $profileImage = $profileImageQuery->get_result()->fetch_array()['profile_image'];
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,700">
		<link rel="stylesheet" type="text/css" href="css/header_member_style.css" />
	</head>
	<body>
		<header>
			<div id="cd-logo">
				<a href="../">
					<img src="img/ic_logo.svg" alt="Logo" />
					<p>Librerria virtual ITLA Tarea</p>
				</a>
			</div>
			
			<div class="dropdown">
			<span class="dropbtn">
                  <img src="profile_images/<?php echo $profileImage; ?>" alt="<?php echo $profileImage; ?> ">
                 <p id="librarian-name"><?php echo $_SESSION['username']; ?></p>
                    </span>
    
				<div class="dropdown-content">
					<a>
						<?php
							$query = $con->prepare("SELECT balance FROM member WHERE username = ?;");
							$query->bind_param("s", $_SESSION['username']);
							$query->execute();
							$balance = (int)$query->get_result()->fetch_array()[0];
							echo "Balance: $".$balance;
						?>
					</a>
					<a href="my_books.php">Mis Libros</a>
					<a href="../logout.php">Cerrar Sesión</a>
				</div>
			</div>
		</header>
	</body>
</html>