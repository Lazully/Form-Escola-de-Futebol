<?php
// Conecta ao banco de dados
$conn = mysqli_connect("localhost", "root", "", "escolinha_futebol");

// Verifica se o ID do jogador foi enviado
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    

    try {
        // Query para excluir o item na tabela "mensalidade"
        $query1 = "DELETE FROM mensalidade WHERE id_jogador= $id and id=$id";
        $conn->query($query1);
    
        // Query para excluir o item na tabela "jogadores"
        $query2 = "DELETE FROM jogadores WHERE id = $id";
        $conn->query($query2);
    
        // Commit da transação
        $conn->commit();
    
        echo "Item excluído com sucesso nas duas tabelas.";
        header("location:/escolinha/visualizar.php");
    } catch (Exception $e) {
        // Rollback da transação em caso de erro
        $conn->rollback();
    
        echo "Erro ao excluir o item: " . $e->getMessage();
    }
} else {
    echo "ID do jogador não informado.";
}

mysqli_close($conn);
?>
</body>
</html>
