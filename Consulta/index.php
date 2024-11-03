<?php
    include('../conexao/config.php');
    
    $sql = 'SELECT * FROM recomeco ORDER BY ID DESC';

    $result = $conexao->query($sql);
?>


<!DOCTYPE html>
<html lang="PT-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style/consulta.css">
        <title>Shallom - Consulta</title>
        <style>
            .blue
            {
                color: #a5a5ff;
            }

            .red
            {
                color: #ffa5a5;
            }

            button
            {
                transition: .8s;
                font-size: 20px;
                background-color: #127acf;
                color: white;
                width: 30%;
                min-width: 300px;
                max-width: 470px;
                padding: 10px;
                margin: 0px auto 30px auto;
                border-radius: 13px;
                border: .3px solid #ffffffa8;
            }

            button:hover
            {
                font-size: 22px;
                transition: .8s;
                box-shadow: 0px 0px 20px #127acfb1;
                background-color: #303245;
                border: 1px solid #127acf;
            }

            a.ButtonDelete
            {
                background-color: #cf1212;
                padding: 7px;
                border-radius: 8px;
                color: white;
            }
        </style>
    </head>
    <body>
        <div id="ConsultaShallom">
            <h1>Shallom - Banco de dados</h1>
            <h2>Consultar | <span class="blue">Editar</span> | <span class="red">Remover</span></h2>
            
            <button id="refresh" onclick="refresh()">Atualizar</button>
            
            <div class="contents">
                <table style="margin: 0 0px 65px 0px">
                    <tr id="header">
                        <th class="head">ID</th>
                        <th class="head">Nome</th>
                        <th class="head">Celular</th>
                        <th class="head">Email</th>
                        <th class="head">Idade</th>
                        <th class="head">Sexo</th>
                        <th class="head">Endereço</th>
                        <th class="head">Religião</th>
                        <th class="head">Decisão</th>
                        <th class="head">Data</th>
                        <th class="head">...</th>
                        <th class="head">...</th>
                    </tr>
                    <?php
                        while($user_data = mysqli_fetch_assoc($result))
                        {
                            echo "<tr>";
                            echo "<td>" . $user_data['ID'] . "</td>";
                            echo "<td>" . $user_data['NOME'] . "</td>";
                            echo "<td>" . $user_data['CELULAR'] . "</td>";
                            echo "<td>" . $user_data['EMAIL'] . "</td>";
                            echo "<td>" . $user_data['IDADE'] . "</td>";
                            echo "<td>" . $user_data['SEXO'] . "</td>";
                            echo "<td>" . $user_data['ENDERECO'] . "</td>";
                            echo "<td>" . $user_data['RELIGIAO'] . "</td>";
                            echo "<td>" . $user_data['DECISAO'] . "</td>";
                            echo "<td>" . $user_data['DATA_REGISTRO'] . "</td>";
                            echo "<td style=\"padding: 18px 7px;\">
                                    <a href=\"./Editar/index.php?id=" . $user_data['ID']. "\" target=\"_SELF\" class=\"ButtonEdit\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-pencil\" viewBox=\"0 0 16 16\"><path d=\"M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325\"/></svg></a>
                                </td>";
                                echo "<td style=\"padding: 18px 7px;\">
                                <a href=\"./Excluir/index.php?id=" . $user_data['ID']. "\" target=\"_SELF\" class=\"ButtonDelete\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-trash\" viewBox=\"0 0 16 16\"><path d=\"M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z\"/><path d=\"M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z\"/></svg></a></td>";
                            echo "</tr>";
                        }
                    ?>
                </table>
            </div>
            <a href="../" target="_SELF" class="back" style="margin-top: 10px;">Voltar</a>
        </div>
        <script>
            function refresh()
            {
                location.reload();
            }
        </script>
    </body>
</html>