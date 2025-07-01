<?php

session_start();
include 'conexão.php';
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit;
}

// Excluir piloto
if (isset($_GET["excluir"])) {
    $id = intval($_GET["excluir"]);
    $conn->query("DELETE FROM tbpilotos WHERE ID_Piloto = $id");
    header("Location: cadastro_piloto.php");
    exit;
}

// Atualizar piloto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editar"])) {
    $id = intval($_POST["ID_Piloto"]);
    $nome = $conn->real_escape_string($_POST["Nome"]);
    $graduacao = $conn->real_escape_string($_POST["Graduacao"]);
    $nacionalidade = $conn->real_escape_string($_POST["Nacionalidade"]);
    $conn->query("UPDATE tbpilotos SET Nome='$nome', Graduacao='$graduacao', Nacionalidade='$nacionalidade' WHERE ID_Piloto = $id");
    header("Location: cadastro_piloto.php");
    exit;
}

// Cadastrar piloto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cadastrar"])) {
    $nome = $conn->real_escape_string($_POST["Nome"]);
    $graduacao = $conn->real_escape_string($_POST["Graduacao"]);
    $nacionalidade = $conn->real_escape_string($_POST["Nacionalidade"]);
    $stmt = $conn->prepare("INSERT INTO tbpilotos (Nome, Graduacao, Nacionalidade) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $graduacao, $nacionalidade);
    $stmt->execute();
    $stmt->close();
    header("Location: cadastro_piloto.php");
    exit;
}

$result = $conn->query("SELECT * FROM tbpilotos");
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
<main class="container-fluid" style="height: 100vh; background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('IMG/capadtm.jpg'); background-size: cover; background-position: center; background-attachment: fixed;">
  <div class="d-flex align-items-center justify-content-center text-light" style="height: 100%;">
    <div class="text-center">
      <h1 class="display-4 fw-bold">Pilotos</h1>
      <p class="lead">O verdadeiro desafio não está em vencer os outros, mas em superar a si mesmo.</p>
    </div>
  </div>
</main>

<!-- Formulário e Lista -->
<section class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-9 border border-primary rounded p-4 bg-light">
      <h2 class="text-center mb-4">Cadastro de Piloto</h2>
      <form method="post">
        <input type="hidden" name="ID_Piloto" value="">
        <div class="mb-3">
          <label class="form-label">Nome:</label>
          <input type="text" class="form-control border-primary" name="Nome" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Graduação:</label>
          <select class="form-select border-primary" name="Graduacao">
            <option disabled selected>Selecione</option>
            <option value="Bronze">Bronze</option>
            <option value="Silver">Silver</option>
            <option value="Gold">Gold</option>
            <option value="Platinum">Platinum</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Nacionalidade:</label>
          <input type="text" class="form-control border-primary" name="Nacionalidade" required>
        </div>
        <button type="submit" name="cadastrar" class="btn btn-primary w-100">Cadastrar Piloto</button>
      </form>
    </div>
  </div>

  <div class="row justify-content-center mt-5">
    <div class="col-md-9 border border-primary rounded p-4 bg-light">
      <h2 class="text-center mb-4">Lista de Pilotos</h2>
      <table class="table table-bordered border-secondary">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Graduação</th>
            <th>Nacionalidade</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()) { ?>
          <tr>
            <form method="post">
              <td><input type="text" class="form-control" name="Nome" value="<?php echo htmlspecialchars($row['Nome']); ?>"></td>
              <td>
                <select class="form-select" name="Graduacao">
                  <option value="Bronze" <?php if ($row['Graduacao'] == "Bronze") echo "selected"; ?>>Bronze</option>
                  <option value="Silver" <?php if ($row['Graduacao'] == "Silver") echo "selected"; ?>>Silver</option>
                  <option value="Gold" <?php if ($row['Graduacao'] == "Gold") echo "selected"; ?>>Gold</option>
                  <option value="Platinum" <?php if ($row['Graduacao'] == "Platinum") echo "selected"; ?>>Platinum</option>
                </select>
              </td>
              <td><input type="text" class="form-control" name="Nacionalidade" value="<?php echo htmlspecialchars($row['Nacionalidade']); ?>"></td>
              <td>
                <input type="hidden" name="ID_Piloto" value="<?php echo $row['ID_Piloto']; ?>">
                <button type="submit" name="editar" class="btn btn-sm btn-primary">Salvar</button>
                <a href="?excluir=<?php echo $row['ID_Piloto']; ?>" class="btn btn-sm btn-dark" onclick="return confirm('Deseja excluir este piloto?')">Excluir</a>
              </td>
            </form>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<?php $conn->close(); ?>
</body>
</html>
