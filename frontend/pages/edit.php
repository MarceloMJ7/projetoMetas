<?php
require_once '../config/database.php';

if (isset($_GET['codigo'])) {
  $idRecebido = $_GET['codigo'];

  try {
    $sql = 'SELECT * FROM metas WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $idRecebido);
    $stmt->execute();

    $metaAtual = $stmt->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo "Erro ao buscar" . $e->getMessage();
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $idParaAtualizar = $_POST['id'];
  $newTitulo = $_POST['titulo'];
  $newPrazo = $_POST['prazo'];
  $newDescricao = $_POST['descricao'];

  try {
    $sql = "UPDATE metas SET titulo = :titulo, prazo = :prazo, descricao = :descricao WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $idParaAtualizar);
    $stmt->bindParam(':titulo', $newTitulo);
    $stmt->bindParam(':prazo', $newPrazo);
    $stmt->bindParam(':descricao', $newDescricao);

    if ($stmt->execute()) {
      header('Location: ../index.php');
      exit;
    }
  } catch (PDOException $e) {
    echo "Erro ao atualizar peça: " . $e->getMessage();
  }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulário Metas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>

  <div class="container">
    <div class="row justify-content-center w-100">
      <div class="col-md-5">

        <div class="card custom-card border-0">
          <div class="card-header text-center py-3 border-bottom border-secondary">
            <h4 class="mb-0 text-white">Editar Meta</h4>
          </div>

          <div class="card-body p-4">
            <form action="" method="POST">
              <input type="hidden" name="id" value="<?= $metaAtual['id'] ?>">
              <div class="mb-3">
                <label for="titulo" class="form-label fw-bold text-light">O que você pretende alcançar?</label>
                <input type="text" name="titulo" id="titulo" class="form-control custom-input" placeholder="Estudar Java.." value="<?= $metaAtual['titulo'] ?>" required>
              </div>

              <div class="mb-3">
                <label for="prazo" class="form-label fw-bold text-light">Prazo Limite</label>
                <input type="date" name="prazo" id="prazo" class="form-control custom-input" value="<?= $metaAtual['prazo'] ?>" required>
              </div>

              <div class="mb-3">
                <label for="descricao" class="form-label fw-bold text-light">Detalhes (Opcional)</label>
                <textarea name="descricao" id="descricao" class="form-control custom-input" rows="3" placeholder="Descreva os passos para essa meta..."><?= $metaAtual['descricao'] ?></textarea>
              </div>

              <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-success fw-bold">Salvar Meta</button>
                <a href="../index.php" class="btn btn-outline-secondary text-light">Voltar ao Início</a>
              </div>

            </form>
          </div>
        </div>

      </div>
    </div>
  </div>

</body>

</html>