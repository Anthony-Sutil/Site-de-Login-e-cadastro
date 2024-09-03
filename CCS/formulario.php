<?php
if(isset($_POST['submit'])) {
    include_once('config.php');

    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $data_nasc = $_POST['data_nasc'];
    $dominios_permitidos = array('pucpr.br', 'pucpr.edu.br');

    if(!empty($nome) && !empty($sobrenome) && !empty($email) && !empty($senha) && strlen($senha) >= 10) {
        if($data_nasc >= '2006-12-30') {
            echo "<div id='mensagem'>Usuário deve ter mais do que 18 anos!</div>";
        } else {
            $dominio = substr($email, strpos($email, '@') + 1);
            $email_valido = false;

            foreach ($dominios_permitidos as $dominio_permitido) {
                if (strpos($dominio, $dominio_permitido) !== false) {
                    $email_valido = true;
                    break;
                }
            }
            if ($email_valido) {
                $result = mysqli_query($conexao, "INSERT INTO usuarios(nome,sobrenome,email,senha,data_nasc) 
                VALUES ('$nome','$sobrenome','$email','$senha','$data_nasc')");
                echo "<div id='mensagem-sucesso'>Gravado com sucesso!</div>";
                echo "<script>setTimeout(function() { window.location.href = 'home.php'; }, 3000);</script>";
            } else {
                echo "<div id='mensagem'>Somente é permitido cadastrar um e-mail institucional da PUCPR!</div>";
            }
        }
    } else {
        echo "<div id='mensagem'>Todos os campos devem ser preenchidos corretamente!</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <style>
        body{
          font-family: Arial, Helvetica, sans-serif;
          background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
        }
        .box{
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            background-color: rgba(0, 0, 0, 0.6);
            padding: 15px;
            border-radius: 15px;
            width: 20%;
        }
        fieldset{
            border: 3px solid dodgerblue;
        }
        legend{
            border: 1px solid dodgerblue;
            padding: 10px;
            text-align: center;
            background-color: dodgerblue;
            border-radius: 8px;
        }
        .inputBox{
            position: relative;
        }
        .inputUser{
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 15px;
            width: 100%;
            letter-spacing: 2px;
        }
        .labelInput{
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;
        }
        .inputUser:focus ~ .labelInput,
        .inputUser:valid ~ .labelInput{
            top: -20px;
            font-size: 12px;
            color: dodgerblue;
        }
        #data_nasc{
            border: none;
            padding: 8px;
            border-radius: 10px;
            outline: none;
            font-size: 15px;
        }
        #submit{
            background-image: linear-gradient(to right,rgb(0, 92, 197), rgb(90, 20, 220));
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }
        #submit:hover{
            background-image: linear-gradient(to right,rgb(0, 80, 172), rgb(80, 19, 195));
        }
        #back {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 15px;
            color: white;
            border-radius: 10px;
        }
        #mensagem {
            color: white;
            background-color: red;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
        }
        #mensagem-sucesso {
            color: white;
            background-color: green;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <br><br>
    <a id ="back" href="home.php">Voltar</a>
    <div class="box">
        <form action="formulario.php" method="POST">
            <fieldset>
                <legend><b>Fórmulário de Clientes</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                    <label for="nome" class="labelInput">Nome</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="sobrenome" id="sobrenome" class="inputUser" required>
                    <label for="sobrenome" class="labelInput">Sobrenome</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="email" id="email" class="inputUser" required>
                    <label for="email" class="labelInput">Email</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="password" name="senha" id="senha" class="inputUser" required><br>
                    <label for="senha" class="labelInput">Senha</label>
                <br><br>
                </div>
                    <label for="data_nasc"><b>Data de Nascimento:</b></label>
                    <input type="date" name="data_nasc" id="data_nasc" required>
                <br><br>
                <input type="submit" name="submit" id="submit">
            </fieldset>
        </form>
    </div>
</body>
</html>