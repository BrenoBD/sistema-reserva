<?php
	date_default_timezone_set('America/Sao_Paulo');
	$pdo = new PDO('mysql:host=localhost;dbname=sistema','root','');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Reservas</title>
</head>
<link rel="preconnect" href="https://fonts.googleapis.com">
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			font-family: "Lato";
		}

		body{
			background: rgb(230, 255, 255);
		}

		header{
			padding: 10px 0;
			background: #0a50f5;
			color: black;
		}

		nav.menu ul{
			list-style-type: none;
		}

		nav.menu li{
			display: inline-block;
			padding: 0 8px;
		}
		nav.menu a{
			color: lightgray;
			text-decoration: none;
		}

		.logo{
			float: left;
		}

		.clear{clear: both;}

		nav.menu{
			position: relative;
			top: 4px;
			float: right;
		}

		.center{
			max-width: 1100px;
			margin: 0 auto;
			padding: 0 2%;
		}
		section.reserva{
			padding: 40px 0;
		}
		section.reserva select{
			width: 20%;
			margin: 10px;
			border: 4px solid ;
			border-color: black;
			cursor: pointer;
		}
		section.reserva input[type=submit]{
			background: #f4ff78;
			width: 100px;
			height: 27px;
			border: 1;
			cursor: pointer;
		}
		.sucesso{
			width: 30%;
			margin: 10px 0;
			padding: 8px 15px;
			color: #000000;
			background:#efff96 ;
		}
	</style>
<body>
	<header>
		<div class="center">
		<div class="logo">
			<h2>Site do BD</h2>
		</div>
		<nav class="menu">
			<ul>
				<li><a href="">Reservas</a></li>
				<li><a href="">Sobre</a></li>
				<li><a href="">Contato</a></li>
			</ul>
		</nav>
		<div class="clear"></div>
		</div>
	</header>
	<section class="reserva">
		<div class="center">
			<?php

				if(isset($_POST['datahora'])){
					$datahora = $_POST['datahora'];
					$date = DateTime::createFromFormat('Y/m/d H:i:s',$datahora);
					$datahora = $date->format('Y/m/d H:i:s');
					$sql = $pdo->prepare("INSERT INTO `tb_agendados` VALUES (null,?)");
					$sql->execute(array($datahora));
					echo '<div class="sucesso">Seu horario foi agendado com sucesso!</div>';

				}
				
			?>
			<form method="post">
					<select name="datahora">
						<?php
							for ($i = 0; $i <= 23 ; $i++){ 
								$hora = $i;
								if ($i < 10 ){
									$hora = '0'.$hora;
								}
								$hora.=':00:00';

								$verifica = date('Y/m/d').' '.$hora;
								$slq = $pdo->prepare("SELECT * FROM `tb_agendados` WHERE horario = '$verifica'");
								$sql->execute();

								if ($slq->rowCount() == 0){
									$datahora = date('Y/m/d').' '.$hora;
									echo '<option value="'.$datahora.'">'.$datahora.'</option>';
								}
							
							}
						?>
					</select>
				<input type="submit" name="acao" value="Reservar!">
			</form>
		</div>
	</section>

</body>
</html>