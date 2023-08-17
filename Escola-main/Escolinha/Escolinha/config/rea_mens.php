<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reajuste</title>
    <style>
        p{
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
</head>
<body>
    <p>Essa pagina é para fazer reajustes a Mensalidade</p>
    <p>Preferencia que avise a mudança com um mes de antecedencia</p>

    <form method='POST'>


    <label for="valor">Alteração:</label><br>
        <input type="text" name="valor" required><br><br>
        <label for="socio">Sócio:</label>
        <select name="socio">
            <option value="sim">Sim</option>
            <option value="nao">Não</option>
        </select><br><br>

        <label for="Vencimento">Alteração:</label><br>
        <input type="date" name="vencimento" required><br><br>

        <input type="submit" value="Salvar">
    </form>
</body>
</html>

<?php
// inclui o arquivo de configuração do banco de dados
include('conexao.php');

// verifica se foi submetido um formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // atualiza o status da mensalidade na base de dados
    $socio = $_POST['socio'];
    $vencimento = $_POST['vencimento'];
    $valor = $_POST['valor'];



if($socio == "sim"){

}

if ($socio == "nao") {
    $valor += 10;
}

if ($status == "pago") {
    $pagamento = date('Y-m-d');
} else {
    $pagamento = 0000 - 00 - 00;
}

$sql = "UPDATE mensalidade, jogadores SET valor='$valor', vencimento='$vencimento' WHERE socio='$socio'";
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



// fecha a conexão com o banco de dados
mysqli_close($conn);

?>
