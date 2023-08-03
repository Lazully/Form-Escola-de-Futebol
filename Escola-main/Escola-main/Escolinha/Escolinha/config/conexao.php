<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "escolinha_futebol";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verifica se houve algum erro na conexão
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}
?>