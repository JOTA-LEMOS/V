<?php
session_start();
include 'conexão.php';
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GT Stats - Cadastro</title>
  <link rel="shortcut icon" href="IMG/logo.jpg" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="navbar.css">
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <!-- Navbar -->
  <header>
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand me-3" href="index.php">
          <img src="IMG/logo.jpg" alt="Logo" style="height: 50px; width: auto;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
          <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="cadastro_piloto.php">Pilotos</a></li>
            <li class="nav-item"><a class="nav-link" href="cadastro_carro.php">Carros</a></li>
            <li class="nav-item"><a class="nav-link" href="cadastro_equipe.php">Equipes</a></li>
            <li class="nav-item"><a class="nav-link" href="corrida.php">Corrida</a></li>
            <li class="nav-item"><a class="nav-link" href="gt2.html">dashborad</a></li>
          </ul>
          <a href="logout.php" class="btn" style="background-color: #052c65; color: #fff;"> Logout</a></div>
      </div>
    </nav>
  </header>

  <!-- Main Background Section -->
  <main class="container-fluid" style="height: 100vh; background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('IMG/capadtm.jpg'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="d-flex align-items-center justify-content-center text-light" style="height: 100%;">
      <div class="text-center">
        <h1 class="display-4 fw-bold">GT STATS</h1>
        <p class="lead my-3"><b>Bem-vindo ao GT STATS! Aqui você encontra dados completos sobre as corridas GT3. Nosso portal facilita o acesso e a comparação de informações sobre pilotos, carros, equipes, pneus e pistas.</b></p>
      </div>
    </div>
  </main>
  <section class="container my-4">
  <div class="d-flex flex-wrap gap-4 justify-content-center">
    
    <!-- Pilotos -->
    <div class="card h-100" style="width: 18rem;">
      <a href="cadastro_piloto.php" class="text-decoration-none">
        <img src="IMG/icones/piloto.png" class="card-img-top" alt="GTWCE">
        <div class="card-body">
          <h5 class="card-title">Pilotos</h5>
          <p class="card-text">Registre aqui os pilotos, informando sua graduação e nacionalidade.</p>
        </div>
      </a>
    </div>

    <!-- Carros -->
    <div class="card h-100" style="width: 18rem;">
      <a href="cadastro_carro.php" class="text-decoration-none">
        <img src="IMG/icones/carros.png" class="card-img-top" alt="GTWCE">
        <div class="card-body">
          <h5 class="card-title">Carros</h5>
          <p class="card-text">Registre aqui os carros disponíveis para a competição.</p>
        </div>
      </a>
    </div>

    <!-- Equipe -->
    <div class="card h-100" style="width: 18rem;">
      <a href="cadastro_equipe.php" class="text-decoration-none">
        <img src="IMG/icones/equipe.png" class="card-img-top" alt="GTWCE">
        <div class="card-body">
          <h5 class="card-title">Equipe</h5>
          <p class="card-text">Registre aqui as equipes que participam do evento.</p>
        </div>
      </a>
    </div>
 <!-- C -->
 <div class="card h-100" style="width: 18rem;">
      <a href="cadastro_equipe.php" class="text-decoration-none">
        <img src="IMG/icones/corrida.png" class="card-img-top" alt="GTWCE">
        <div class="card-body">
          <h5 class="card-title">Corridas</h5>
          <p class="card-text">Registre aqui as que participam do evento.</p>
        </div>
      </a>
    </div>

  </div>
</section>
</body>
</html>
