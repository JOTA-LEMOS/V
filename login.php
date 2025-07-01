<?php
session_start();
include 'conexão.php';

if (isset($_POST['logar'])) {
    // 1. Recebe e limpa dados
    $nome  = trim($_POST['Nome']);
    $senha = trim($_POST['Senha']);

    // 2. Verifica se o usuário existe
    $query = "SELECT * FROM tbusuario WHERE Nome = ? AND Senha = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Erro na preparação da consulta: " . $conn->error);
    }
    $stmt->bind_param("ss", $nome, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    
    if ($result->num_rows > 0) {
        // Usuário encontrado, inicia a sessão
        $_SESSION['usuario'] = $nome;
        header("Location: index.php");
        exit;
         
    } else {
    echo "<script>
            alert('Usuário ou senha inválidos! por favor, cadastre um novo usuraio.');
            window.location.href = 'cadastro.html   ';
          </script>";
    exit;
}
}
?>