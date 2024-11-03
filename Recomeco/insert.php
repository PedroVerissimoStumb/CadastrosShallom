<?php
    include('../conexao/config.php');

    $nome = isset($_GET["nome"]) ? htmlspecialchars($_GET["nome"], ENT_QUOTES, 'UTF-8') : '';
    $celular = isset($_GET["celular"]) ? htmlspecialchars($_GET["celular"], ENT_QUOTES, 'UTF-8') : '';
    $email = isset($_GET["email"]) ? htmlspecialchars($_GET["email"], ENT_QUOTES, 'UTF-8') : '';
    $idade = isset($_GET["idade"]) ? (int)$_GET["idade"] : 0;
    $sexo = isset($_GET["sexo"]) ? htmlspecialchars($_GET["sexo"], ENT_QUOTES, 'UTF-8') : '';
    $endereco = isset($_GET["endereco"]) ? htmlspecialchars($_GET["endereco"], ENT_QUOTES, 'UTF-8') : '';
    $religiao = isset($_GET["religiao"]) ? htmlspecialchars($_GET["religiao"], ENT_QUOTES, 'UTF-8') : '';
    $oracao = isset($_GET["oracao"]) ? $_GET["oracao"] : null;
    $visita = isset($_GET["visita"]) ? $_GET["visita"] : null;
    $conversao = isset($_GET["conversao"]) ? $_GET["conversao"] : null;
    $batismo = isset($_GET["batismo"]) ? $_GET["batismo"] : null;
    $decisao = [];
    $data = isset($_GET["data"]) ? $_GET["data"] : '0000-00-00';

    if(!DateTime::createFromFormat('Y-m-d', $data))
    {
        $data = '0000-00-00';
    }

    if ($oracao === "on") $decisao[] = "Oração";
    if ($visita === "on") $decisao[] = "Visita";
    if ($conversao === "on") $decisao[] = "Conversão";
    if ($batismo === "on") $decisao[] = "Batismo";

    $decisao = !empty($decisao) ? implode(", ", $decisao) : "Nenhuma";

    if(empty($religiao)) $religiao = "Nenhuma";
    if(empty($endereco)) $endereco = "Nenhum";
    if(empty($celular)) $celular = "Nenhum";
    if(empty($email)) $email = "Nenhum";

    $stmt = $conexao->prepare("INSERT INTO recomeco (NOME, CELULAR, EMAIL, IDADE, SEXO, ENDERECO, RELIGIAO, DECISAO, DATA_REGISTRO) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $nome, $celular, $email, $idade, $sexo, $endereco, $religiao, $decisao, $data);

    if(!$stmt->execute())
    {
        die('Erro ao executar a consulta: ' . $stmt->error);
    }

    $stmt->close();
    $conexao->close();

    header("Location: ./sucesso/");
    exit();
?>