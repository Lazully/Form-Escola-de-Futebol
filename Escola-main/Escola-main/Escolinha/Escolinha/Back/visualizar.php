<!DOCTYPE html>
<html>
<head>

	<title>Visualizar Jogadores</title>
	<link rel="shortcut icon" type="imagex/png" href="assets/imge/ico.png">
	
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;1,200;1,300;1,400&display=swap');
		body {
			font-family: 'Poppins', sans-serif;
			margin: 0;
			padding: 20px;
			background: white ;
		}
		h1 {
		text-align: center;
	}

	.btn {
		display: inline-block;
		margin-right: 10px;
		padding: 10px 20px;
		font-size: 16px;
		border: black;
		border-radius: 4px;
		background-color: black;
		color: white;
		cursor: pointer;
	}

	.btn:hover {
		background-color: red;
	}

	.search-container {
		margin-top: 20px;
		margin-bottom: 20px;
		text-align: center;
	}

	.search-form {
		display: inline-block;
	}

	.search-input {
		padding: 10px;
		font-size: 16px;
		border: 1px solid black;
		border-radius: 4px;
		box-sizing: border-box;
		
	}

	.search-button {
		padding: 10px;
		border:black;
		border-radius: 20%;
		background: black;
		cursor: pointer;
		color:whitesmoke;
	}


	table {
		width: 100%;
		border-collapse: collapse;
		
	}

	table th, table td {
		padding: 8px;
		text-align: left;
		border-bottom: 1px solid black;
	}

	table th {
		background-color: red;
		color: black;
	}

	table tr:nth-child(even) {
		background-color: white;
	}

	.search-button:hover{
		background-color: red;
	}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>

<h1>Jogadores Cadastrados</h1>

<div style="text-align: center;">
	<a href="cadastro.html"><button class="btn">Cadastrar</button></a>
	<a href="mensalidades.php"><button class="btn">Controle de mensalidade</button></a>
	<a href="config/pago.php"><button class="btn">Pagos</button></a>
	<a href="config/rea_mens.php"><button class="btn">Reajuste de Mensalidade</button></a>
	<a href="config/his.php"><button class="btn">Historico de Pagamento</button></a>
</div>

<div class="search-container">
	<form method="GET" action="" class="search-form">
		<input type="text" class="search-input" id="busca" name="busca" placeholder="Digite o nome do jogador...">
		<button type="submit" class="search-button">Buscar</button>
	</form>
</div>
<table class="table-bordered">
	<thead>
		<tr>
			<th>Nome</th>
			<th>Apelido</th>
			<th>Data de Nascimento</th>
			<th>CPF</th>
			<th>Telefone</th>
			<th>Período de Treino</th>
			<th>Sócio</th>
			<th>Status do Jogador</th>
			<th>Status da Mensalidade</th>
			<th>Foto</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>
		<?php

		// Conexão com o banco de dados
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "escolinha_futebol";
		$conn = mysqli_connect($servername, $username, $password, $dbname);

		// Verifica se a conexão foi bem sucedida
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}

		// Consulta os jogadores cadastrados no banco de dados
		if(isset($_GET['busca'])) {
			$busca = mysqli_real_escape_string($conn, $_GET['busca']);
			$sql = "SELECT * FROM jogadores, mensalidade WHERE nome LIKE '%$busca%' OR apelido LIKE '%$busca%' OR status LIKE '%$busca%' OR atv LIKE '%$busca%' ";
		  } else {
			$sql = "SELECT * FROM jogadores, mensalidade WHERE jogadores.id=mensalidade.id_jogador";
		  }
		  
		$result = mysqli_query($conn, $sql);

		// Exibe os resultados em uma tabela
		if (mysqli_num_rows($result) > 0) {
		    while($row = mysqli_fetch_assoc($result)) {
		        echo "<tr>";
		        echo "<td>".$row["nome"]."</td>";
		        echo "<td>".$row["apelido"]."</td>";
		        echo "<td>".$row["nascimento"]."</td>";
		        echo "<td>".$row["cpf"]."</td>";
		        echo "<td>".$row["telefone"]."</td>";
		        echo "<td>".$row["periodo"]."</td>";
            	echo "<td>".$row["socio"]."</td>";
           	 	echo "<td>".$row["atv"]."</td>";

				$vencimento = strtotime($row['vencimento']);
        	$atual = time();
        if ($atual > $vencimento) {
            echo "<td>Vencido</td>";
        } else {
				echo "<td>" . ucfirst($row['status']) . "</td>";
		}
		        echo "<td><img src='".$row["foto"]."' width='65px'></td>";
		        echo "<td><a href='config/editar.php?id={$row['id']}' onClick=\"return confirm('Tem certeza que deseja editar este jogador?')\"'>Editar</a>| <a href='config/editar_mensalidade.php?id=".$row["id"]."'>Mensalidade</a> | <a href='config/excluir.php?id={$row['id']}' onClick=\"return confirm('Tem certeza que deseja excluir este jogador?')\">Excluir</a></td>";
                echo "</tr>";
            }
        } else {
            
        }
    
        mysqli_close($conn);      

        
    
        ?>
		<tbody>
    </table>
    </body>
	
</html>