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
    echo "Erro ao buscar: " . $e->getMessage();
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $idParaAtualizar = $_POST['id'];
  $newTitulo = trim($_POST['titulo']);
  $newPrazo = $_POST['prazo'];
  $newDescricao = trim($_POST['descricao']);
  $newProgresso = $_POST['progresso']; // Captura o valor do Slider

  try {
    // A query SQL agora atualiza o progresso também
    $sql = "UPDATE metas SET titulo = :titulo, prazo = :prazo, descricao = :descricao, progresso = :progresso WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $idParaAtualizar);
    $stmt->bindParam(':titulo', $newTitulo);
    $stmt->bindParam(':prazo', $newPrazo);
    $stmt->bindParam(':descricao', $newDescricao);
    $stmt->bindParam(':progresso', $newProgresso); // Blinda o novo dado contra injeções

    if ($stmt->execute()) {
      $_SESSION['mensagem'] = "Meta e progresso atualizados com sucesso! 📈";
      $_SESSION['tipo_alerta'] = "info";
      header('Location: ../index.php');
      exit;
    }
  } catch (PDOException $e) {
    $erro = "Erro ao atualizar registo: " . $e->getMessage();
  }
}

$caminhoCss = "../css";
$classeBody = "bg-dark text-light min-vh-100 tela-formulario";
require_once __DIR__ . '/../includes/header.php';
?>

<div class="container">
  <div class="row justify-content-center w-100">
    <div class="col-md-5">
      <div class="card custom-card border-0">
        <div class="card-header text-center py-3 border-bottom border-secondary">
          <h4 class="mb-0 text-white">Atualizar Progresso</h4>
        </div>
        <div class="card-body p-4">

          <?php if (isset($erro)): ?>
          <div class="alert alert-danger"><?= $erro ?></div>
          <?php endif; ?>

          <form action="" method="POST">
            <input type="hidden" name="id" value="<?= $metaAtual['id'] ?>">

            <div class="mb-3">
              <label for="titulo" class="form-label fw-bold text-light">O que pretende alcançar?</label>
              <input type="text" name="titulo" id="titulo" class="form-control custom-input" value="<?= htmlspecialchars($metaAtual['titulo']) ?>" required>
            </div>

            <div class="mb-3">
              <label for="prazo" class="form-label fw-bold text-light">Prazo Limite</label>
              <input type="date" name="prazo" id="prazo" class="form-control custom-input" value="<?= $metaAtual['prazo'] ?>" required>
            </div>

            <div class="mb-4 bg-dark p-3 rounded border border-secondary">
              <label for="progresso" class="form-label fw-bold text-light d-flex justify-content-between w-100">
                <span>Nível de Conclusão:</span>
                <span id="progressoValor" class="badge bg-primary rounded-pill fs-6"><?= $metaAtual['progresso'] ?>%</span>
              </label>
              <input type="range" class="form-range" min="0" max="100" step="5" id="progresso" name="progresso" value="<?= $metaAtual['progresso'] ?>" oninput="document.getElementById('progressoValor').innerText = this.value + '%'">
            </div>

            <div class="mb-3">
              <label for="descricao" class="form-label fw-bold text-light">Detalhes (Opcional)</label>
              <textarea name="descricao" id="descricao" class="form-control custom-input" rows="3"><?= htmlspecialchars($metaAtual['descricao']) ?></textarea>
            </div>

            <div class="d-grid gap-2 mt-4">
              <button type="submit" class="btn btn-success fw-bold">Guardar Progresso</button>
              <a href="../index.php" class="btn btn-outline-secondary text-light">Voltar ao Início</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>