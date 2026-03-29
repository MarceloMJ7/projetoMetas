<?php
require_once 'config/database.php';

try {
  $sql = "SELECT * FROM metas ORDER BY id DESC";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $minhasMetas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Falha no motor de busca: " . $e->getMessage();
}

// Configurações do Cabeçalho para esta página (Layout em Bloco)
$caminhoCss = "css";
$classeBody = "bg-dark text-light p-4 p-md-5 min-vh-100 d-block";
require_once __DIR__ . '/includes/header.php';
?>

<div class="container d-block">

  <?php if (isset($_SESSION['mensagem'])): ?>
  <div class="alert alert-<?= $_SESSION['tipo_alerta'] ?> alert-dismissible fade show shadow-sm" role="alert">
    <strong>Aviso:</strong> <?= $_SESSION['mensagem'] ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
  </div>
  <?php
    // Limpa a memória após exibir para não repetir o alerta ao atualizar a página
    unset($_SESSION['mensagem']);
    unset($_SESSION['tipo_alerta']);
    ?>
  <?php endif; ?>

  <div class="row mb-4 align-items-center">
    <div class="col-sm-8">
      <h2 class="mb-0 text-white fw-bold">Painel de Metas</h2>
      <p class="text-secondary mb-0 mt-1">Escreva seus objetivos e acompanhe os resultados.</p>
    </div>
    <div class="col-sm-4 text-sm-end mt-3 mt-sm-0">
      <a href="pages/create.php" class="btn btn-success fw-bold px-4 py-2 shadow-sm">
        + Nova Meta
      </a>
    </div>
  </div>

  <div class="card bg-secondary bg-opacity-10 border-secondary shadow-lg rounded-4 overflow-hidden">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-dark table-hover table-borderless mb-0 align-middle">
          <thead class="border-bottom border-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">
            <tr>
              <th class="ps-4 py-3 text-secondary">Título da Meta</th>
              <th class="py-3 text-secondary text-center px-4">Prazo Limite</th>
              <th class="py-3 w-25 text-secondary text-center px-4">Progresso</th>
              <th class="py-3 text-secondary px-4">Detalhes</th>
              <th class="text-center pe-4 py-3 text-secondary">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($minhasMetas)): ?>
            <tr>
              <td colspan="5" class="text-center py-5">
                <h5 class="text-secondary mb-2">Nenhuma meta encontrada.</h5>
                <p class="text-secondary opacity-75 mb-0">A sua esteira está vazia. Comece a criar uma nova meta!</p>
              </td>
            </tr>
            <?php else: ?>
            <?php foreach ($minhasMetas as $meta): ?>
            <tr class="border-bottom border-secondary border-opacity-25 align-middle">
              <td class="ps-4 fw-semibold text-white fs-5">
                <?= htmlspecialchars($meta['titulo']) ?>
              </td>

              <td class="text-center px-4">
                <span class="badge bg-primary bg-opacity-25 text-primary rounded-pill px-3 py-2 border border-primary border-opacity-50">
                  <?= date('d/m/Y', strtotime($meta['prazo'])) ?>
                </span>
              </td>

              <td class="px-4">
                <?php
                    $progresso = $meta['progresso'];
                    // Lógica de Negócio Visual: Define a cor da barra baseada no valor
                    $corBarra = $progresso == 100 ? 'bg-success' : ($progresso > 50 ? 'bg-info' : 'bg-warning');
                    ?>
                <div class="d-flex align-items-center gap-2">
                  <div class="progress flex-grow-1 bg-dark border border-secondary" style="height: 12px;">
                    <div class="progress-bar <?= $corBarra ?> progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?= $progresso ?>%;" aria-valuenow="<?= $progresso ?>" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <span class="text-secondary fw-bold" style="font-size: 0.85rem; min-width: 35px;"><?= $progresso ?>%</span>
                </div>
              </td>

              <td class="text-light opacity-75 px-4">
                <?= htmlspecialchars($meta['descricao']) ?>
              </td>
              <td class="text-center pe-4">
                <div class="d-flex justify-content-center gap-2">
                  <a href="pages/edit.php?codigo=<?= $meta['id'] ?>" class="btn btn-outline-warning btn-sm fw-bold rounded">Editar</a>
                  <a href="pages/delete.php?codigo=<?= $meta['id'] ?>" class="btn btn-outline-danger btn-sm fw-bold rounded">Eliminar</a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>