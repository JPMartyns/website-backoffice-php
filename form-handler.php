<?php

// Função para limpar os dados
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$nome = $email = $mensagem = $telefone = "";
$nomeError = $emailError = $telefoneError = $mensagemError  = "";
$min = 10;
$max = 500;

$isFormValid = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validação do nome
    if ($_POST["nome"] == "") {
        $nomeError = "Falta o nome";
        $isFormValid = false;
    } else {
        $nome = test_input($_POST["nome"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $nome)) {
            $nomeError = "Só letras e espaços!";
            $isFormValid = false;
        }
    }

    // Validação do email
    if ($_POST["email"] == "") {
        $emailError = "Falta o email";
        $isFormValid = false;
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Formato de email inválido!";
            $isFormValid = false;
        }
    }

    // Validação do telefone
    if ($_POST["telefone"] == "") {
        $telefoneError = "Falta o telefone";
        $isFormValid = false;
    } else {
        $telefone = test_input($_POST["telefone"]);
        if (!preg_match("/^\d{9}$/", $telefone)) {
            $telefoneError = "Só números (9 dígitos)!";
            $isFormValid = false;
        }
    }

    // Validação da mensagem
    if ($_POST["mensagem"] == "") {
        $mensagemError = "Falta a mensagem";
        $isFormValid = false;
    } else {
        $mensagem = test_input($_POST["mensagem"]);
        if (strlen($mensagem) < $min) {
            $mensagemError = "Mensagem com menos de 10 caracteres!";
            $isFormValid = false;
        } elseif (strlen($mensagem) > $max) {
            $mensagemError = "Mensagem com mais de 500 caracteres!";
            $isFormValid = false;
        }
    }

    // SE ESTIVER TUDO OK, FAZ O INSERT
    if ($isFormValid) {
        require "config.php"; // aqui colocas o teu ficheiro de ligação à base de dados

        $nome = $connection->real_escape_string($nome);
        $email = $connection->real_escape_string($email);
        $telefone = $connection->real_escape_string($telefone);
        $mensagem = $connection->real_escape_string($mensagem);

        $sql = "INSERT INTO contactos (nome, email, telefone, mensagem) VALUES ('$nome', '$email', '$telefone', '$mensagem')";

        if ($connection->query($sql) === TRUE) {
            $successMessage = "Formulário enviado com sucesso!";
        } else {
            $formError = "Erro ao enviar formulário: " . $connection->error;
        }
    }
}
?>
