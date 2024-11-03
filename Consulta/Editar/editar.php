<?php
    include('../../conexao/config.php');

    if (isset($_GET["id"]))
    {
        $id = $_GET["id"];

        $nome = isset($_GET["nome"]) ? trim($_GET["nome"]) : '';
        $celular = isset($_GET["celular"]) ? trim($_GET["celular"]) : '';
        $email = isset($_GET["email"]) ? trim($_GET["email"]) : '';
        $idade = isset($_GET["idade"]) ? (int)$_GET["idade"] : 0;
        $sexo = isset($_GET["sexo"]) ? trim($_GET["sexo"]) : '';
        $endereco = isset($_GET["endereco"]) ? trim($_GET["endereco"]) : '';
        $religiao = isset($_GET["religiao"]) ? trim($_GET["religiao"]) : '';
        
        $decisao = [];
        $oracao = isset($_GET["oracao"]) ? $_GET["oracao"] : null;
        $visita = isset($_GET["visita"]) ? $_GET["visita"] : null;
        $conversao = isset($_GET["conversao"]) ? $_GET["conversao"] : null;
        $batismo = isset($_GET["batismo"]) ? $_GET["batismo"] : null;
        $data = isset($_GET["data"]) ? $_GET["data"] : '0000-00-00';

        if($oracao === "on")
        {
            $decisao[] = "Oração";
        }

        if($visita === "on")
        {
            $decisao[] = "Visita";
        }

        if($conversao === "on")
        {
            $decisao[] = "Conversão";
        }

        if($batismo === "on")
        {
            $decisao[] = "Batismo";
        }

        $decisao = !empty($decisao) ? implode(", ", $decisao) : "Nenhuma";
        
        if(empty($religiao))
        {
            $religiao = "Nenhuma";
        }
        
        if(empty($celular))
        {
            $celular = "Nenhum";
        }

        if(empty($email))
        {
            $email = "Nenhum";
        }

        $stmt = $conexao->prepare("UPDATE recomeco SET NOME=?, CELULAR=?, EMAIL=?, IDADE=?, SEXO=?, ENDERECO=?, RELIGIAO=?, DECISAO=?, DATA_REGISTRO=? WHERE ID=?");

        if($stmt)
        {
            $stmt->bind_param("ssissssssi", $nome, $celular, $email, $idade, $sexo, $endereco, $religiao, $decisao, $data, $id);
            
            if($stmt->execute())
            {
                header("Location: ./sucesso/");
                exit();
            }
            else
            {
                echo "Erro ao atualizar: " . $stmt->error;
            }

            $stmt->close();
        }
        else
        {
            echo "Erro na preparação da consulta: " . $conexao->error;
        }
    }
?>