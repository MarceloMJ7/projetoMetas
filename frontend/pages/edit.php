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

  try {
    $sql = "UPDATE metas SET titulo = :titulo, prazo = :prazo, descricao = :descricao WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $idParaAtualizar);
    $stmt->bindParam(':titulo', $newTitulo);
    $stmt->bindParam(':prazo', $newPrazo);
    $stmt->bindParam(':descricao', $newDescricao);

    if ($stmt->execute()) {
      $_SESSION['mensagem'] = "Meta atualizada com sucesso! ✏️";
      $_SESSION['tipo_alerta'] = "info";
      header('Location: ../index.php');
      exit;
    }
  } catch (PDOException $e) {
    $erro = "Erro ao atualizar peça: " . $e->getMessage();
  }
}

// Configurações do Cabeçalho para esta página (Layout Centralizado)
$caminhoCss = "../css";
$classeBody = "bg-dark text-light min-vh-100 tela-formulario";
require_once __DIR__ . '/../includes/header.php';
?>

<div class="container">
  <div class="row justify-content-center w-100">
    <div class="col-md-5">
      <div class="card custom-card border-0">
        <div class="card-header text-center py-3 border-bottom border-secondary">
          <h4 class="mb-0 text-white">Editar Meta</h4>
        </div>
        <div class="card-body p-4">

          <?php if (isset($erro)): ?>
            <div class="alert alert-danger"><?= $erro ?></div>
          <?php endif; ?>

          <form action="" method="POST">
            <input type="hidden" name="id" value="<?= $metaAtual['id'] ?>">
            <div class="mb-3">
              <label for="titulo" class="form-label fw-bold text-light">O que pretende alcançar?</label>
              <input type="text" name="titulo" id="titulo" class="form-control custom-input" placeholder="Estudar Java.." value="<?= htmlspecialchars($metaAtual['titulo']) ?>" required>
            </div>
            <div class="mb-3">
              <label for="prazo" class="form-label fw-bold text-light">Prazo Limite</label>
              <input type="date" name="prazo" id="prazo" class="form-control custom-input" value="<?= $metaAtual['prazo'] ?>" required>
            </div>
            <div class="mb-3">
              <label for="descricao" class="form-label fw-bold text-light">Detalhes (Opcional)</label>
              <textarea name="descricao" id="descricao" class="form-control custom-input" rows="3" placeholder="Descreva os passos para essa meta..."><?= htmlspecialchars($metaAtual['descricao']) ?></textarea>
            </div>
            <div class="d-grid gap-2 mt-4">
              <button type="submit" class="btn btn-success fw-bold">Salvar Alterações</button>
              <a href="../index.php" class="btn btn-outline-secondary text-light">Voltar ao Início</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>