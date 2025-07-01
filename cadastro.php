<?php
session_start();
include 'conexão.php';

if (isset($_POST['logar'])) {
    // Recebe e limpa dados
    $nome  = trim($_POST['Nome']);
    $senha = trim($_POST['Senha']);

    // Prepara e executa INSERT
    $query = "INSERT INTO tbusuario (Nome, Senha) VALUES (?, ?)";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ss", $nome, $senha);

        if ($stmt->execute()) {
            $_SESSION['usuario'] = $nome;
            echo "<script>
                    alert('Usuário cadastrado com sucesso!');
                    window.location.href = 'index.php';
                  </script>";
            exit;
        } else {
            echo "<script>
                    alert('Erro ao cadastrar usuário: {$stmt->error}');
                    window.location.href = 'cadastro.html';
                  </script>";
            exit;
        }
    } else {
        die("Erro na preparação da consulta: " . $conn->error);
    }
}
?>
