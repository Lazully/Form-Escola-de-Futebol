<!DOCTYPE html>
<html>
<head>
	<title>Editar Mensalidade</title>
    <style>
        h1 {
	text-align: center;
	font-size: 36px;
	margin-top: 50px;
	margin-bottom: 50px;
}

        form {
  max-width: 650px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f1f1f1;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0,0,0,0.3);
}

label {
  display: block;
  margin-bottom: 10px;
}

select {
  margin-bottom: 20px;
}

input[type="submit"] {
  background-color: #00c;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #009;
}
    </style>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css">

</head>
<body>
<link rel="shortcut icon" type="imagex/png" href="/escolinha/assets/imge/ico.png">
	<h1>Editar Mensalidade</h1>


	<?php
	// inclui o arquivo de configuração do banco de dados
	include('conexao.php');

	// verifica se foi submetido um formulário
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		// atualiza o status da mensalidade na base de dados
		$id = $_POST['id'];
		$status = $_POST['status'];
    $vencimento = $_POST['vencimento'];
    $modo_p = $_POST['modo_p'];
    $valor_m = $_POST['valor_m'];
    $socio = $_GET['socio'];
    // Obtém a data atual
    $data_atual = new DateTime();

    if($status == "pago"){
    $pagamento = date('Y-m-d');
    }else{
    $pagamento = 0000-00-00;
    }
  


// Define a data limite de pagamento como sendo mensal, trimestral e anual após a data atual


    if($socio == "sim"){

      $valor='70';


    }else{

      $valor='80';

    } if($modo_p == "mensal"){
      $data_limite_pagamento = clone $data_atual;
      $data_limite_pagamento->add(new DateInterval('P1M'));
      $vencimento = $data_limite_pagamento->format('Y-m-d');
      $vencimento = $data_limite_pagamento->format('Y-m-d');
      
      $valor_m = $valor * 1;

    }else if($modo_p == "trimestral"){
      $data_limite_pagamento = clone $data_atual;
      $data_limite_pagamento->add(new DateInterval('P3M'));
      $vencimento = $data_limite_pagamento->format('Y-m-d');
      $vencimento = $data_limite_pagamento->format('Y-m-d');

      $valor_m = $valor * 3;

    }else{
      $data_limite_pagamento = clone $data_atual;
      $data_limite_pagamento->add(new DateInterval('P1Y'));
      $vencimento = $data_limite_pagamento->format('Y-m-d');
      $vencimento = $data_limite_pagamento->format('Y-m-d');

      $valor_m = $valor * 12;
    }

   
    

		$sql = "UPDATE mensalidade SET status='$status', valor='$valor_m' ,pagamento='$pagamento' ,vencimento='$vencimento'  WHERE id=$id";
		$resultado = mysqli_query($conn, $sql);

		// verifica se houve algum erro na atualização
		if (!$resultado) {
			echo "<p>Erro ao atualizar mensalidade: " . mysqli_error($conn) . "</p>";
		} else {
			// exibe uma mensagem de confirmação
            echo "<p>Mensalidade atualizada com sucesso!</p>";
            header("location:/escolinha/visualizar.php");
        }
    }
    
    // verifica se foi passado um id pela url
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    
        // seleciona o jogador correspondente na base de dados
        $sql = "SELECT * FROM jogadores, mensalidade WHERE jogadores.id=$id and mensalidade.id_jogador=$id  ";
        $resultado = mysqli_query($conn, $sql);
    
        // verifica se houve algum erro na consulta
        if (!$resultado) {
            echo "<p>Erro ao consultar jogador: " . mysqli_error($conn) . "</p>";
        } else {
            $jogador = mysqli_fetch_assoc($resultado);
    
            // exibe o formulário de edição da mensalidade
            echo "<form method='POST'>";
            echo "<input type='hidden' name='id' value='{$jogador['id']}'>";
            echo "<label>Mensalidade: R$ {$jogador['valor']}</label><br>";

            echo "<label>Modo Pagamento </label>";
            echo "<select name='modo_p'>";
            echo "<option value='mensal' " . ($jogador['modo_p'] == 'mensal' ? 'selected' : '') . ">Mensal</option>";
            echo "<option value='trimestral' " . ($jogador['modo_p'] == 'trimestral' ? 'selected' : '') . ">Trimensal</option>";
            echo "<option value='anual' " . ($jogador['modo_p'] == 'anual' ? 'selected' : '') . ">Anual</option>";
            echo "</select><br>";

            echo "<label>Status: </label>";
            echo "<select name='status'>";
            echo "<option value='pendente' " . ($jogador['status'] == 'pendente' ? 'selected' : '') . ">Pendente</option>";
            echo "<option value='pago' " . ($jogador['status'] == 'pago' ? 'selected' : '') . ">Pago</option>";
            echo "</select><br>";
            echo "<br><br><input type='submit' value='Salvar'>";
            echo "</form>";
        }
    } else {
        echo "<p>Jogador não encontrado.</p>";
    }
    
    // fecha a conexão com o banco de dados
    mysqli_close($conn);
    ?>
</body>


