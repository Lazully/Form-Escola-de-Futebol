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

include("vlf.php");

// Recebe as informações do formulário
$nome = $_POST["nome"];
$apelido = $_POST["apelido"];
$email = $_POST["email"];
$nascimento = $_POST["nascimento"];
$rg = $_POST["rg"];
$cpf = $_POST["cpf"];
$sexo = $_POST["sexo"];
$nome_pai = $_POST["nome_pai"];
$nome_mae = $_POST["nome_mae"];
$endereco = $_POST["endereco"];
$cidade = $_POST["cidade"];
$estado = $_POST["estado"];
$bairro = $_POST["bairro"];
$telefone = $_POST["telefone"];
$orientacao = $_POST["orientacao"];
$periodo = $_POST["periodo"];
$socio = $_POST['socio'];
$atv = $_POST['atv'];
$status = $_POST['status'];




//Obter o status da atividade do jogador
if ($atv == "sim") {
    $atv = 'Ativo';
} else {
    $atv = 'Inativo';
}


// Obtém a data atual
$data_atual = new DateTime();



// Define a data limite de pagamento como sendo 10 dias após a data atual
$data_limite_pagamento = clone $data_atual;
$data_limite_pagamento->add(new DateInterval('P1M'));
$vencimento = $data_limite_pagamento->format('Y-m-d');

$vencimento = $data_limite_pagamento->format('Y-m-d');


if ($status == "sim") {
    $status = "pago";
} else {
    $status = "pendente";
}


if ($status == "pago") {
    $pagamento = date('Y-m-d');
} else {
    $pagamento = 0000 - 00 - 00;
}



// Verifica se o jogador é sócio ou não e define o valor da mensalidade
if ($socio == "sim") {
    $valor = '70';
} else {
    $valor = '80';
}




if (!valieCPF($cpf)) {
    echo "CPF inválido.";
    header("location:cadastro.html");

}


// Verifica se o jogador já está cadastrado
$sql = "SELECT * FROM jogadores WHERE cpf = '$cpf'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "Jogador já cadastrado.";
    header("location:/escolinha/cadastro.html");

}





// Verifica se o nome foi preenchido
if (empty($nome)) {
    $errors[] = "O campo nome é obrigatório.";
}

// Verifica se o email é válido
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "O email informado é inválido.";
}




// Upload da foto
$target_dir = "/escolinha/assets/uploads/";
$target_file = $target_dir . basename($_FILES["foto"]["name"]);
move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);









// Insere os dados do jogador no banco de dados
$sql = "INSERT INTO jogadores (nome, apelido, email, nascimento, rg, cpf, sexo, nome_pai, nome_mae, endereco, cidade, estado, bairro, telefone, orientacao, periodo, socio, atv, foto) 
VALUES ('$nome', '$apelido', '$email', '$nascimento', '$rg', '$cpf', '$sexo', '$nome_pai', '$nome_mae', '$endereco', '$cidade', '$estado', '$bairro', '$telefone', '$orientacao', '$periodo', '$socio', '$atv' ,'$target_file')";


if (!$conn->query($sql)) {
    echo "Error: " . $conn->error;
    exit();
}



$men = "INSERT INTO mensalidade (id_jogador, valor, status, pagamento, vencimento) 
VALUES (LAST_INSERT_ID() , '$valor','$status', '$pagamento','$vencimento')";



if (!$conn->query($men)) {
    echo "Error: " . $conn->error;
    exit();

}
mysqli_close($conn);
header("location:/escolinha/visualizar.php");

?>
