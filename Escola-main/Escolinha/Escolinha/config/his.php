<!DOCTYPE html>
<html>
<head>
	<meta>
		<title>Controle de Mensalidades</title>
		<link rel="stylesheet" href="/escolinha/assets/mens.css">
		<link rel="shortcut icon" type="imagex/png" href="/escolinha/assets/imge/ico.png">
		<style>
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
		</style>
		
	</head>
<body>
	<h1>Historico de mensalidade</h1>
	<div class="search-container">
	<form method="GET" action="" class="search-form">
		<input type="text" class="search-input" id="busca" name="busca" placeholder="Digite o nome do jogador...">
		<button type="submit" class="search-button">Buscar</button>
	</form>
</div>
	<?php
	// inclui o arquivo de configuração do banco de dados
	include("conexao.php");



	if(isset($_GET['busca'])) {
		$busca = mysqli_real_escape_string($conn, $_GET['busca']);
		$sql = "SELECT * FROM jogadores, mensalidade WHERE nome LIKE '%$busca%' OR apelido LIKE '%$busca%' OR status LIKE '%$busca%' OR atv LIKE '%$busca%' ";
	  }
	// seleciona todos os jogadores da base de dados
	$sql = "SELECT * FROM jogadores , config
	WHERE jogadores.id=config.id_mensalidade";
	$resultado = mysqli_query($conn, $sql);

	// verifica se houve algum erro na consulta
	if (!$resultado) {
		echo "<p>Erro ao consultar jogadores: " . mysqli_error($conn) . "</p>";
	} else {
		// exibe a tabela de jogadores e suas respectivas mensalidades
		echo "<table>";
		echo "<tr>";
		echo "<th>Nome</th>";
        echo "<th>CPF</th>";
		echo "<th>Pagamento</th>";
		echo "<th>Vence</th></th>";
		echo "</tr>";
		while ($jogador = mysqli_fetch_assoc($resultado)) {
			echo "<tr>";
			echo "<td>{$jogador['nome']}</td>";
			echo "<td>{$jogador['cpf']}</td>";
			echo "<td>{$jogador['data_pgt']}</td>";
			echo "<td>{$jogador['data_ven']}</td>";

		}
		echo "</table>";
	}

	// fecha a conexão com o banco de dados
	mysqli_close($conn);
	?>
	
</body>
</html>
