<?php
session_start();
include 'conexão.php';
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit;
}
// Excluir equipe
if (isset($_GET["excluir"])) {
    $id = intval($_GET["excluir"]);
    $conn->query("DELETE FROM tbequipes WHERE ID_Equipe = $id");
    header("Location: cadastro_equipe.php");
    exit;
}

// Atualizar equipe
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editar"])) {
    $id = intval($_POST["ID_Equipe"]);
    $nome = $conn->real_escape_string($_POST["Nome"]);
    $pais = $conn->real_escape_string($_POST["Pais_sede"]);
    $conn->query("UPDATE tbequipes SET Nome = '$nome', Pais_sede = '$pais' WHERE ID_Equipe = $id");
    header("Location: cadastro_equipe.php");
    exit;
}

// Cadastrar equipe
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cadastrar"])) {
    $Nome       = $conn->real_escape_string($_POST["Nome"]);
    $Pais_sede  = $conn->real_escape_string($_POST["Pais_sede"]);
    $conn->query("INSERT INTO tbequipes (Nome, Pais_sede) VALUES ('$Nome', '$Pais_sede')");
    header("Location: cadastro_equipe.php");
    exit;
}

$result = $conn->query("SELECT * FROM tbequipes");
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
            </ul>
          <a href="logout.php" class="btn" style="background-color: #052c65; color: #fff;"> Logout</a></div>
      </div>
      </div>
    </nav>
  </header>
  <!-- Main Background Section -->
  <main class="container-fluid" style="height: 100vh; background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('IMG/equipe.jpg'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="d-flex align-items-center justify-content-center text-light" style="height: 100%;">
      <div class="text-center">
        <h1 class="display-4 fw-bold">Equipes</h1>
        <p class="lead my-3"><b> Os carros de corrida não são nem bonitos nem feios. Tornam-se bonitos com a vitória</b></p>
      </div>
    </div>
  </main>

  <!-- Cadastro e Tabela -->
  <div class="container mt-5 mb-5">
    <div class="bg-light border border-primary p-4 rounded">
      <h2 class="text-center mb-4 ">Cadastro de Equipes</h2>
      <form method="post">
        <input type="hidden" name="ID_Equipe" value="">
        <div class="mb-3 ">
          <label class="form-label">Nome da Equipe:</label>
          <input type="text" class="form-control border border-primary " name="Nome" required>
        </div>
        <div class="mb-3">
          <label class="form-label">País de Sede:</label>
          <input type="text" class="form-control border border-primary " name="Pais_sede" required>
        </div>
        <button type="submit" name="cadastrar"  class="btn btn-primary w-100">Cadastrar Equipe </button>      
      </form>
    </div>

    <div class="bg-light -  border border-primary p-4 rounded secondary p-4 rounded mt-5">
      <h2 class="text-center mb-4">Lista de Equipes</h2>
      <table class="table table-bordered">
          <tr>
            <th>Nome</th>
            <th>País de Sede</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()) { ?>
          <tr>
            <form method="post">
              <td><input type="text" name="Nome" class="form-control" value="<?php echo htmlspecialchars($row['Nome']); ?>"></td>
              <td><input type="text" name="Pais_sede" class="form-control" value="<?php echo htmlspecialchars($row['Pais_sede']); ?>"></td>
              <td>
                <input type="hidden" name="ID_Equipe" value="<?php echo $row['ID_Equipe']; ?>">
                <button type="submit" name="editar" class="btn btn-primary btn-sm">Salvar</button>
                <a href="?excluir=<?php echo $row['ID_Equipe']; ?>" class="btn btn-dark btn-sm" onclick="return confirm('Deseja excluir esta equipe?')">Excluir</a>
              </td>
            </form>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <?php $conn->close(); ?>
</body>
</html>
