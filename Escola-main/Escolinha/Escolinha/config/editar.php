<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<title>Editar Jogador</title>
    <style>
       header {
  background-color: #333;
  color: white;
  padding: 10px;
}

h1 {
  margin-top: 0;
  text-align: center;
}

/* Estilos para os formulários de cadastro e edição */
form {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f1f1f1;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0,0,0,0.3);
}

form label {
  display: block;
  margin-bottom: 5px;
}

form input[type="text"],
form input[type="email"],
form input[type="date"],
form input[type="number"],
form input[type="tel"] {
  display: block;
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  font-size: 16px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

form input[type="radio"] {
  margin-right: 10px;
}

form input[type="submit"] {
  display: block;
  width: 100%;
  padding: 10px;
  background-color: #333;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

    </style>
    <link rel="shortcut icon" type="imagex/png" href="img/ico.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>

	<h1>Editar Jogador</h1>

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

	// Verifica se o ID do jogador foi recebido pela URL
	if (isset($_GET["id"])) {
	    $id = $_GET["id"];

	    // Consulta os dados do jogador no banco de dados
	    $sql = "SELECT * FROM jogadores WHERE id='$id'";
	    $result = mysqli_query($conn, $sql);

	    // Verifica se o jogador existe no banco de dados
	    if (mysqli_num_rows($result) > 0) {
	        $row = mysqli_fetch_assoc($result);

	        // Exibe um formulário com os dados do jogador preenchidos
            echo "<form method='post' enctype='multipart/form-data'>";
            echo "<input type='hidden' name='id' value='".$row["id"]."'>";
            echo "Nome: <input type='text' name='nome' value='".$row["nome"]."'><br>";
            echo "Apelido: <input type='text' name='apelido' value='".$row["apelido"]."'><br>";
            echo "Email: <input type='email' name='email' value='".$row["email"]."'><br>";
            echo "Data de Nascimento: <input type='date' name='nascimento' value='".$row["nascimento"]."'><br>";
            echo "RG/RA: <input type='text' name='rg' value='".$row["rg"]."'><br>";
            echo "CPF: <input type='text' name='cpf' value='".$row["cpf"]."'><br>";
            echo "Sexo: <input type='radio' name='sexo' value='M' ".($row["sexo"]=='M'?'checked':'')."> Masculino <input type='radio' name='sexo' value='F' ".($row["sexo"]=='F'?'checked':'')."> Feminino <br>";
            echo "Nome do Pai: <input type='text' name='nome_pai' value='".$row["nome_pai"]."'><br>";
            echo "Nome da Mãe: <input type='text' name='nome_mae' value='".$row["nome_mae"]."'><br>";
            echo "Endereço: <input type='text' name='endereco' value='".$row["endereco"]."'><br>";
            echo "Cidade: <input type='text' name='cidade' value='".$row["cidade"]."'><br>";
            echo "Estado: <input type='text' name='estado' value='".$row["estado"]."'><br>";
            echo "Bairro: <input type='text' name='bairro' value='".$row["bairro"]."'><br>";
            echo "Telefone Celular: <input type='text' name='telefone' value='".$row["telefone"]."'><br>";
            echo "Orientação Médica: <input type='text' name='orientacao' value='".$row["orientacao"]."'><br>";
            echo "Período de Treino: <input type='radio' name='periodo' value='Tarde' ".($row["periodo"]=='Tarde'?'checked':'')."> Tarde <input type='radio' name='periodo' value='Manhã' ".($row["periodo"]=='Manhã'?'checked':'')."> Manhã<br>";
            echo "É socio do clube? <input type='radio' id='sim' name='socio' value='sim'  ".($row["socio"]=='sim'?'checked':'')."> sim <input type='radio' id='nao' name='socio' value='nao' ".($row["socio"]=='nao'?'checked':'')."> Não<br>";
            echo "O jogador esta em atividade? <input type='radio' id='sim' name='atv' value='sim'  ".($row["atv"]=='sim'?'checked':'')."> sim <input type='radio' id='nao' name='atv' value='nao' ".($row["atv"]=='nao'?'checked':'')."> Não<br>";
            echo "<br>Foto: <input type='file' name='foto'>";
            echo "<input type='submit' name='editar' value='Salvar'>";
            echo "</form>";
            } else {
            echo "Jogador não encontrado.";
            }
            } else {
            echo "ID do jogador não informado.";
            }
            // Verifica se o formulário foi enviado
if (isset($_POST["editar"])) {
    $id = $_POST["id"];
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
    $socio = $_POST["socio"];
    $atv = $_POST["atv"];
    


    //Obter o status da atividade do jogador
    if ($atv == "sim") {
      $atv = 'Ativo';
    } else {
      $atv = 'Inativo';
    }

    if($socio =="sim"){
      $valor = '70';
    }else{
      $valor = '80';
    }

    if ($row["atv"] == "sim") {
      $valor = 'mensalidade';
  } else {
      $valor = "0";
    
  }



    // Verifica se foi enviado uma nova foto
    if ($_FILES["foto"]["name"] != "") {
        $target_file = $_FILES["foto"]["name"];
        $target_file_tmp = $_FILES["foto"]["tmp_name"];
        $target_file_size = $_FILES["foto"]["size"];
        $target_file_error = $_FILES["foto"]["error"];
        $target_file_type = $_FILES["foto"]["type"];

        // Verifica se a extensão da foto é permitida
        $allowed = array("jpg", "jpeg", "png", "gif");
        $ext = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (in_array($ext, $allowed)) {
            // Move a foto para a pasta "fotos"
            $target_dir = "/escolinha/assets/foto/";
            $target_file = $target_dir . basename($_FILES["foto"]["name"]);
            move_uploaded_file($_FILES ["foto"] ["tmp_name"], $target_file);
        } else {
            echo "Erro ao enviar foto: extensão inválida.";
            exit;
        }
    } else {
        // Não foi enviado uma nova foto
        $target_file = $_POST["foto"];
}
    // Atualiza os dados do jogador no banco de dados
    $sql = "UPDATE jogadores SET nome='$nome', apelido='$apelido', email='$email', nascimento='$nascimento', rg='$rg', cpf='$cpf', sexo='$sexo', nome_pai='$nome_pai', nome_mae='$nome_mae', endereco='$endereco', cidade='$cidade', estado='$estado', bairro='$bairro', telefone='$telefone', orientacao='$orientacao', periodo='$periodo',socio='$socio', atv='$atv', foto='$target_file'  WHERE id=$id";
    if (!$conn->query($sql)) {
      echo "Error: " . $conn->error;
      exit();
  }
    $men = "UPDATE mensalidade SET valor='$valor'";
    
    if (!$conn->query($men)) {
      echo "Error: " . $conn->error;
      exit();
  
  }
 
  header("location:/escolinha/visualizar.php");
    
    
    
}

mysqli_close($conn);

?>
</body>
</html>


