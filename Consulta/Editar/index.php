<?php
    if(!empty($_GET['id']))
    {
        include('../../conexao/config.php');

        $id = $_GET['id'];

        $sqlResults = "Select * From recomeco Where id=$id";

        $result = $conexao->query($sqlResults);

        if($result->num_rows >= 1)
        {
            while($user_data = mysqli_fetch_assoc($result))
            {
                $id = $user_data["ID"];
                $nome = $user_data["NOME"];
                $celular = $user_data["CELULAR"];
                $email = $user_data["EMAIL"];
                $idade = $user_data["IDADE"];
                $sexo = $user_data["SEXO"];
                $endereco = $user_data["ENDERECO"];
                $religiao = $user_data["RELIGIAO"];

                $decisao = explode(', ', $user_data["DECISAO"]);

                $oracao = in_array('Oração', $decisao);
                $visita = in_array('Visita', $decisao);
                $conversao = in_array('Conversão', $decisao);
                $batismo = in_array('Batismo', $decisao);

                $data = $user_data["DATA_REGISTRO"];
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="PT-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../style/editar-recomeco.css">
        <title>Shallom - Recomeço (Eitar)</title>
        <style>
            a.back
            {
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 18px;
                transition: .8s;
                font-size: 20px;
                background-color: #127acf;
                color: white;
                height: 40px;
                width: 100px;
                margin: 0px auto 50px auto;
                text-decoration: none;
                border-radius: 10px;
                border: 1px solid #D1D5DB;
                font-family: Arial, Helvetica, sans-serif;
            }

            a.back:hover
            {
                font-size: 25px;
                transition: .8s;
                box-shadow: 0px 0px 20px #127acfb1;
                background-color: #303245;
                border: 1px solid #127acf;
            }

            body > div
            {
                flex-direction: column;
                align-items: flex-start;
            }

            body
            {
                align-items: flex-start;
            }
        </style>
    </head>
    <body>
        <div>
            <form action="./editar.php" method="GET" class="Formulario-Shallom">
                <h1>Recomeço - Editar</h1>
                <p>Edite a pessoa aqui!</p>

                <input type="hidden" name="id" id="id" value="<?php echo $id;?>"/>
                <div class="nome">
                    <label for="nome">Nome *</label>
                    <input type="text" name="nome" id="nome" maxlength="255" required value="<?php echo $nome;?>">
                </div>
                <div class="celular">
                    <label for="celular">Celular</label>
                    <input type="text" name="celular" id="celular" maxlength="19" value="<?php echo ($celular == 'Nenhum') ? '' : $celular;?>">
                </div>
                <div class="email">
                    <label for="email">E-mail</label>
                    <input type="text" name="email" id="email" maxlength="255" value="<?php echo ($email == 'Nenhum') ? '' : $email;?>">
                </div>
                <div class="idade">
                    <label for="idade">Idade *</label>
                    <input type="number" name="idade" id="idade" min="1" max="120" required value="<?php echo $idade ;?>">
                </div>
                <div class="sexo">
                    <label for="sexo">Sexo *</label>
                    <select name="sexo" id="sexo" required>
                        <option value="" disabled selected>Selecione</option>
                        <option value="M" <?php echo ($sexo == "M") ? 'selected' : '' ?>>Masculino</option>
                        <option value="F" <?php echo ($sexo == "F") ? 'selected' : '' ?>>Feminino</option>
                    </select>
                </div>
                <div class="endereco">
                    <label for="endereco">Endereço</label>
                    <input type="text" name="endereco" id="endereco" maxlength="255" value="<?php echo $endereco;?>">
                </div>
                <div class="religiao">
                    <label for="religiao">Religião</label>
                    <input type="text" name="religiao" id="religiao" maxlength="70" value="<?php echo ($religiao == 'Nenhuma') ? '' : $religiao;?>">
                </div>
                <div class="decisao" id="especial">
                    <label for="decisao">Decisão</label>
                    <div class="my-form" style="background-color: #303245; padding: 5px; border-radius: 5px;">
                        <div>
                            <input id="check-1" type="checkbox" name="oracao" <?php echo ($oracao == true) ? 'checked' : ''?>/>
                            <label for="check-1">Oração</label>
                        </div>
                        <div>
                            <input id="check-2" type="checkbox" name="visita" <?php echo ($visita == true) ? 'checked' : ''?>/>
                            <label for="check-2">Visita</label>
                        </div>
                        <div>
                            <input id="check-3" type="checkbox" name="conversao" <?php echo ($conversao == true) ? 'checked' : ''?>/>
                            <label for="check-3">Conversão</label>
                        </div>
                        <div>
                            <input id="check-4" type="checkbox" name="batismo" <?php echo ($batismo == true) ? 'checked' : ''?>/>
                            <label for="check-4">Batismo</label>
                        </div>
                    </div>
                </div>
                <div class="data">
                    <label for="data">Data *</label>
                    <input type="date" name="data" id="data" required value="<?php echo $data;?>">
                </div>
                <div class="submit">
                    <input type="submit" value="Editar" class="submit">
                </div>
            </form>

            <a href="../" target="_self" class="back" style="margin-top: 20px;">Voltar</a>

        </div>

        <script>

            document.addEventListener('DOMContentLoaded', () =>
            {
                const input = document.getElementById('celular');

                input.addEventListener('input', formatPhoneNumber);

                function formatPhoneNumber(event)
                {
                    let value = event.target.value;

                    value = value.replace(/\D/g, '');

                    if(!value.startsWith('55'))
                    {
                        value = '55' + value;
                    }

                    if(value.length > 10)
                    {
                        value = value.replace(/^(\d{2})(\d{2})(\d{5})(\d{4})$/, '+$1 ($2) $3-$4');
                    }
                    else if(value.length > 6)
                    {
                        value = value.replace(/^(\d{2})(\d{2})(\d{0,5})$/, '+$1 ($2) $3');
                    }
                    else if(value.length > 2)
                    {
                        value = value.replace(/^(\d{2})(\d{0,5})$/, '+$1 $2');
                    }
                    else
                    {
                        value = '+' + value;
                    }

                    event.target.value = value;
                }
            });

        </script>
    </body>
</html>