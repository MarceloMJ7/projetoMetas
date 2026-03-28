<?php
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nomeMeta = trim($_POST['titulo']);
  $prazoMeta = $_POST['prazo'];
  $descricaoMeta = trim($_POST['descricao']);

  try {
    $sql = "INSERT INTO metas (titulo, prazo, descricao) VALUES (:titulo, :prazo, :descricao)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':titulo', $nomeMeta);
    $stmt->bindParam(':prazo', $prazoMeta);
    $stmt->bindParam(':descricao', $descricaoMeta);

    if ($stmt->execute()) {
      $_SESSION['mensagem'] = "Meta criada com sucesso! 🚀";
      $_SESSION['tipo_alerta'] = "success";
      header('Location: ../index.php');
      exit;
    }
  } catch (PDOException $e) {
    $erro = "Erro no sistema: " . $e->getMessage();
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
          <h4 class="mb-0 text-white">Nova Meta Pessoal</h4>
        </div>
        <div class="card-body p-4">

          <?php if (isset($erro)): ?>
            <div class="alert alert-danger"><?= $erro ?></div>
          <?php endif; ?>

          <form action="" method="POST">
            <div class="mb-3">
              <label for="titulo" class="form-label fw-bold text-light">O que pretende alcançar?</label>
              <input type="text" name="titulo" id="titulo" class="form-control custom-input" placeholder="Estudar Java.." required>
            </div>
            <div class="mb-3">
              <label for="prazo" class="form-label fw-bold text-light">Prazo Limite</label>
              <input type="date" name="prazo" id="prazo" class="form-control custom-input" required>
            </div>
            <div class="mb-3">
              <label for="descricao" class="form-label fw-bold text-light">Detalhes (Opcional)</label>
              <textarea name="descricao" id="descricao" class="form-control custom-input" rows="3" placeholder="Descreva os passos para essa meta..."></textarea>
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

<?php require_once __DIR__ . '/../includes/footer.php'; ?>