<?php
session_start();

if(isset($_POST['submit']) && !empty($_POST['nome']) && !empty($_POST['senha']))
{
    include_once('config.php');
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE nome = '$nome' and senha = '$senha'";

    $result = $conexao->query($sql);

    if(mysqli_num_rows($result) < 1)
    {
        $error = "Usuário não cadastrado!";
    }
    else
    {
        $_SESSION['nome'] = $nome;
        $_SESSION['senha'] = $senha;
        header('Location: sistema.php');
    }
}
else
{
    $error = "Preencha o usuário e senha.";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
        }
        div{
            background-color: rgba(0, 0, 0, 0.6);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            padding: 80px;
            border-radius: 15px;
            color: #fff;
        }
        input{
            padding: 15px;
            border: none;
            outline: none;
            font-size: 15px;
        }
        .inputSubmit{
            background-color: dodgerblue;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 10px;
            color: white;
            font-size: 15px;
        
        }
        .inputSubmit:hover{
            background-color: deepskyblue;
            cursor: pointer;
        }
        #back {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 15px;
            color: white;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <br><br>
    <a id="back" href="home.php">Voltar</a>
    <div>
        <h1>Login</h1>
        <form method="post" action="testLogin.php">
            <input type="text" name="nome" placeholder="Usuário">
            <br><br>
            <input type="password" name="senha" placeholder="Senha">
            <br><br>
            <span style="color: red;"><?php echo $error; ?></span>
            <br><br>
            <input class="inputSubmit" type="submit" name="submit" value="Enviar">
            </form>
    </div>
</body>
</html>