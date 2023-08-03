<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAGO</title>
</head>
<body>
    <p>Essa pagina é para deixar todos os alunos cadastrados com o status "pagos" ao inves de pendente</p>

    <form method='POST'>
    <input type='submit' value='Salvar'>
    </form>
</body>
</html>

<?php
// inclui o arquivo de configuração do banco de dados
include('conexao.php');

// verifica se foi submetido um formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // atualiza o status da mensalidade na base de dados
    
    $status = $_POST['status'];
    $vencimento = $_POST['vencimento'];
     $pago = $_POST['pago']; // novo campo para o status de pagamento

// Obtém a data atual
$data_atual = new DateTime();

// Define a data limite de pagamento como sendo 10 dias após a data atual
$data_limite_pagamento = clone $data_atual;
$data_limite_pagamento->add(new DateInterval('P1M'));
$vencimento = $data_limite_pagamento->format('Y-m-d');

$vencimento = $data_limite_pagamento->format('Y-m-d');

// obter status do pagamento
$pago = ($pago == 'pago');

$status = 'pago';


if($status == "pago"){
    $pagamento = date('Y-m-d');
}else{
    $pagamento = 0000-00-00;
}

    $sql = "UPDATE mensalidade SET _status='$status',  pagamento=$pagamento,vencimento='$vencimento'";
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
