<?php
    include('../../conexao/config.php');

    if (isset($_GET["id"]))
    {
        $id = $_GET["id"];

        if (filter_var($id, FILTER_VALIDATE_INT))
        {
            $stmt = $conexao->prepare("DELETE FROM recomeco WHERE id = ?");
            $stmt->bind_param("i", $id);
            
            $stmt->execute();

            $stmt->close();
        }
    }

    header("Location: ./sucesso/");
    exit();
?>