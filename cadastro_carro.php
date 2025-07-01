<?php
session_start();
include 'conexão.php';
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit;
}

// Excluir carro
if (isset($_GET["excluir"])) {
    $id = intval($_GET["excluir"]);
    $conn->query("DELETE FROM tbcarros WHERE ID_Carro = $id");
    header("Location: cadastro_carro.php");
    exit;
}

// Atualizar carro
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editar"])) {
    $id = intval($_POST["ID_Carro"]);
    $Modelo = $conn->real_escape_string($_POST["Modelo"]);
    $Fabricante = $conn->real_escape_string($_POST["Fabricante"]);
    $conn->query("UPDATE tbcarros SET Modelo='$Modelo', Fabricante='$Fabricante' WHERE ID_Carro = $id");
    header("Location: cadastro_carro.php");
    exit;
}

// Cadastrar carro
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cadastrar"])) {
    $Modelo = $conn->real_escape_string($_POST["Modelo"]);
    $Fabricante = $conn->real_escape_string($_POST["Fabricante"]);
    $stmt = $conn->prepare("INSERT INTO tbcarros (Modelo, Fabricante) VALUES (?, ?)");
    $stmt->bind_param("ss", $Modelo, $Fabricante);
    $stmt->execute();
    $stmt->close();
    header("Location: cadastro_carro.php");
    exit;
}

$result = $conn->query("SELECT * FROM tbcarros");
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

<!-- Seção de Fundo Principal -->
<main class="container-fluid" style="height: 100vh; background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('IMG/carros.jpg'); background-size: cover; background-position: center; background-attachment: fixed;">
  <div class="d-flex align-items-center justify-content-center text-light" style="height: 100%;">
    <div class="text-center">
      <h1 class="display-4 fw-bold">Carros</h1>
      <p class="lead">Eu construo motores e junto-lhes rodas.</p>
    </div>
  </div>
</main>

<!-- Seção de Cadastro e Lista -->
<section class="container my-4">
  <div class="row justify-content-center">
    <div class="col-md-8 mt-4 border border-primary rounded p-4 bg-light">
      <h2 class="text-center mb-4">Cadastro de Carros</h2>
      <form method="post">
        <input type="hidden" name="ID_Carro" value="">
        <div class="mb-3">
          <label class="form-label">Fabricante:</label>
          <input type="text" class="form-control border-primary" placeholder="Insira a Fabricante" name="Fabricante" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Modelo:</label>
          <input type="text" class="form-control border-primary" placeholder="Insira o Modelo" name="Modelo" required>
        </div>
        <button type="submit" name="cadastrar" class="btn btn-primary w-100">Cadastrar Carro</button>
      </form>
    </div>
  </div>

  <!-- Lista de Carros com Edição Inline -->
<div class="row justify-content-center mt-5">
    <div class="col-md-8 border border-primary rounded p-4 bg-light">
        <h2 class="text-center mb-4">Lista de Carros</h2>
        <table class="table table-bordered border-secondary">
            <thead>
                <tr>
                    <th>Fabricante</th>
                    <th>Modelo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <form method="post">
                        <td><input type="text" class="form-control" name="Fabricante" value="<?php echo htmlspecialchars($row["Fabricante"]); ?>"></td>
                        <td><input type="text" class="form-control" name="Modelo" value="<?php echo htmlspecialchars($row["Modelo"]); ?>"></td>
                        <td>
                            <input type="hidden" name="ID_Carro" value="<?php echo $row["ID_Carro"]; ?>">
                            <button type="submit" name="editar" class="btn btn-sm btn-primary">Salvar</button>
                            <a href="?excluir=<?php echo $row["ID_Carro"]; ?>" class="btn btn-sm btn-dark" onclick="return confirm('Deseja realmente excluir este carro?')">Excluir</a>
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
