<?php
session_start();
include 'conexão.php';
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit;
}

// Excluir corrida
if (isset($_GET["excluir"])) {
    $id = intval($_GET["excluir"]);
    $conn->query("DELETE FROM tbcorridas WHERE ID_Corrida = $id");
    header("Location: corrida.php");
    exit;
}

// Atualizar corrida
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editar"])) {
    $id = intval($_POST["ID_Corrida"]);
    $dataInicio = $_POST["Data_Inicio"];
    $dataFim = $_POST["Data_fim"];
    $idPiloto = intval($_POST["ID_Piloto"]);
    $idEquipe = intval($_POST["ID_Equipe"]);
    $idCarro = intval($_POST["ID_Carro"]);

    $conn->query("UPDATE tbcorridas SET Data_Inicio='$dataInicio', Data_fim='$dataFim', ID_Piloto=$idPiloto, ID_Equipe=$idEquipe, ID_Carro=$idCarro WHERE ID_Corrida = $id");
    header("Location: corrida.php");
    exit;
}

// Cadastrar corrida
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cadastrar"])) {
    $dataInicio = $_POST["Data_Inicio"];
    $dataFim = $_POST["Data_fim"];
    $idPiloto = intval($_POST["ID_Piloto"]);
    $idEquipe = intval($_POST["ID_Equipe"]);
    $idCarro = intval($_POST["ID_Carro"]);

    $stmt = $conn->prepare("INSERT INTO tbcorridas (Data_Inicio, Data_fim, ID_Piloto, ID_Equipe, ID_Carro) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiii", $dataInicio, $dataFim, $idPiloto, $idEquipe, $idCarro);
    $stmt->execute();
    $stmt->close();
    header("Location: corrida.php");
    exit;
}

$pilotos = $conn->query("SELECT ID_Piloto, Nome FROM tbpilotos");
$equipes = $conn->query("SELECT ID_Equipe, Nome FROM tbequipes");
$carros = $conn->query("SELECT ID_Carro, Modelo FROM tbcarros");

$resultCorridas = $conn->query("
  SELECT c.*, p.Nome AS PilotoNome, e.Nome AS EquipeNome, ca.Modelo AS CarroModelo
  FROM tbcorridas c
  JOIN tbpilotos p ON c.ID_Piloto = p.ID_Piloto
  JOIN tbequipes e ON c.ID_Equipe = e.ID_Equipe
  JOIN tbcarros ca ON c.ID_Carro = ca.ID_Carro
");
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

<main class="container-fluid" 
style="min-height: 100vh; background: linear-gradient(rgba(0, 0, 0, 0.6),
rgba(0, 0, 0, 0.6)), url('IMG/capadtm.jpg') center/cover no-repeat fixed;">
  <div class="d-flex align-items-center justify-content-center text-light"
   style="height: 100vh;">
    <div class="text-center">
      <h1 class="display-4 fw-bold">Corridas</h1>
      <p class="lead"><b>O verdadeiro desafio não está
        em vencer os outros, mas em superar a si mesmo.</b></p>
    </div>
  </div>
</main>

<section class="container my-5">
  <div class="bg-light border border-primary rounded  p-4 rounded">
    <h2 class="text-center mb-4 ">Cadastro de Corridas</h2>
    <form method="post">
      <div class="row mb-3">
       
      </div>
      <div class="row mb-3">
        <div class="col-md-4">
          <label class="form-label ">Piloto:</label>
          <select name="ID_Piloto" class="form-select border border-primary rounded" required>
            <option disabled selected>Selecione</option>
            <?php while ($p = $pilotos->fetch_assoc()) echo "<option value='{$p['ID_Piloto']}'>{$p['Nome']}</option>"; ?>
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label">Equipe:</label>
          <select name="ID_Equipe" class="form-select border border-primary rounded " required>
            <option disabled selected>Selecione</option>
            <?php while ($e = $equipes->fetch_assoc()) echo "<option value='{$e['ID_Equipe']}'>{$e['Nome']}</option>"; ?>
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label">Carro:</label>
          <select name="ID_Carro" class="form-select border border-primary rounded" required>
            <option disabled selected>Selecione</option>
            <?php while ($c = $carros->fetch_assoc()) echo "<option value='{$c['ID_Carro']}'>{$c['Modelo']}</option>"; ?>
          </select>
        </div>
         <div class="col-md-6">
          <label class="form-label">Data de Início:</label>
          <input type="date" name="Data_Inicio" class="form-control border border-primary rounded " required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Data de Fim:</label>
          <input type="date" name="Data_fim" class="form-control border border-primary rounded " required>
        </div>
      </div>
      <button type="submit" name="cadastrar" class="btn btn-primary w-100">Cadastrar Corrida</button>
    </form>
  </div>

  <div class="bg-light border border-primary rounded p-4 rounded mt-5">
    <h2 class="text-center mb-4">Lista de Corridas</h2>
    <table class="table table-bordered border border-dark rounded">
        <tr>
          <th >Início</th>
          <th>Fim</th>
          <th>Piloto</th>
          <th>Equipe</th>
          <th>Carro</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Reinicializar ponteiros dos selects
        $pilotos->data_seek(0);
        $equipes->data_seek(0);
        $carros->data_seek(0);

        while ($row = $resultCorridas->fetch_assoc()) {
        ?>
        <tr>
          <form method="post">
              <td><input type="date" name="Data_Inicio" class="form-control" value="<?php echo $row['Data_Inicio']; ?>"></td>
            <td><input type="date" name="Data_fim" class="form-control" value="<?php echo $row['Data_fim']; ?>"></td>
            <td>
              <select name="ID_Piloto" class="form-select">
                <?php
                $pilotos->data_seek(0);
                while ($p = $pilotos->fetch_assoc()) {
                  $selected = $p['ID_Piloto'] == $row['ID_Piloto'] ? 'selected' : '';
                  echo "<option value='{$p['ID_Piloto']}' $selected>{$p['Nome']}</option>";
                }
                ?>
              </select>
            </td>
            <td>
              <select name="ID_Equipe" class="form-select">
                <?php
                $equipes->data_seek(0);
                while ($e = $equipes->fetch_assoc()) {
                  $selected = $e['ID_Equipe'] == $row['ID_Equipe'] ? 'selected' : '';
                  echo "<option value='{$e['ID_Equipe']}' $selected>{$e['Nome']}</option>";
                }
                ?>
              </select>
            </td>
            <td>
              <select name="ID_Carro" class="form-select">
                <?php
                $carros->data_seek(0);
                while ($c = $carros->fetch_assoc()) {
                  $selected = $c['ID_Carro'] == $row['ID_Carro'] ? 'selected' : '';
                  echo "<option value='{$c['ID_Carro']}' $selected>{$c['Modelo']}</option>";
                }
                ?>
              </select>
            
            </td>
            <td>
              <input type="hidden" name="ID_Corrida" value="<?php echo $row['ID_Corrida']; ?>">
              <button type="submit" name="editar" class="btn btn-primary btn-sm">Salvar</button>
              <a href="?excluir=<?php echo $row['ID_Corrida']; ?>" class="btn btn-dark btn-sm" onclick="return confirm('Excluir corrida?')">Excluir</a>
            </td>
          </form>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</section>

<?php $conn->close(); ?>
</body>
</html>
