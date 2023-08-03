<!DOCTYPE html>
<html>
<head>
	<meta>
		<title>Controle de Mensalidades</title>
		<link rel="stylesheet" href="assets/mens.css">
		<link rel="shortcut icon" type="imagex/png" href="imge/ico.png">

		
	</head>
<body>
	<h1>Controle de Mensalidades</h1>
	
	<?php
	// inclui o arquivo de configuração do banco de dados
	include("config/conexao.php");

	// seleciona todos os jogadores da base de dados
	$sql = "SELECT * FROM jogadores , mensalidade
	WHERE jogadores.id=mensalidade.id_jogador and jogadores.atv='ativo'";
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
		echo "<th>Mensalidade</th>";
		echo "<th>Pagamento</th>";
		echo "<th>Vence</th></th>";
		echo "<th>Status</th>";
		echo "<th>Ação</th>";
		echo "</tr>";
		while ($jogador = mysqli_fetch_assoc($resultado)) {
			echo "<tr>";
			echo "<td>{$jogador['nome']}</td>";
			echo "<td>{$jogador['cpf']}</td>";
			echo "<td>R$ {$jogador['valor']}</td>";
			echo "<td>{$jogador['pagamento']}</td>";
			echo "<td>{$jogador['vencimento']}</td>";

			
			$vencimento = strtotime($jogador['vencimento']);
        	$atual = time();
        if ($atual > $vencimento) {
            echo "<td>Vencido</td>";
        } else {
            echo "<td>" . ucfirst($jogador['status']) . "</td>";
        }

			echo "<td><a href='config/editar_mensalidade.php?id={$jogador['id']}'>Editar</a></td>";
			echo "</tr>";
		}
		echo "</table>";
	}

	// fecha a conexão com o banco de dados
	mysqli_close($conn);
	?>
	
</body>
</html>
