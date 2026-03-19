<?php
require_once 'config/database.php';

try {
  $sql = "SELECT * FROM metas ORDER BY ID DESC";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $minhasMetas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Falha no motor de busca: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel de Metas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/index.css">
</head>

<body class="bg-dark text-light p-4 p-md-5 min-vh-100">

  <div class="container">

    <div class="row mb-4 align-items-center">
      <div class="col-sm-8">
        <h2 class="mb-0 text-white fw-bold">🎯 Meu Painel de Metas</h2>
        <p class="text-secondary mb-0 mt-1">Gerencie seus objetivos e acompanhe seus prazos.</p>
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
                <th class="py-3 text-secondary">Prazo Limite</th>
                <th class="py-3 w-50 text-secondary">Detalhes</th>
                <th class="text-center pe-4 py-3 text-secondary">Ações</th>
              </tr>
            </thead>

            <tbody>

              <?php if (empty($minhasMetas)): ?>
              <tr>
                <td colspan="4" class="text-center py-5">
                  <h5 class="text-secondary mb-2">Nenhuma meta encontrada.</h5>
                  <p class="text-secondary opacity-75 mb-0">Sua esteira está vazia. Comece criando uma nova meta!</p>
                </td>
              </tr>
              <?php else: ?>

              <?php foreach ($minhasMetas as $meta): ?>
              <tr class="border-bottom border-secondary border-opacity-25">

                <td class="ps-4 fw-semibold text-white fs-5">
                  <?= htmlspecialchars($meta['titulo']) ?>
                </td>

                <td>
                  <span class="badge bg-primary bg-opacity-25 text-primary rounded-pill px-3 py-2 border border-primary border-opacity-50">
                    <?= date('d/m/Y', strtotime($meta['prazo'])) ?>
                  </span>
                </td>

                <td class="text-light opacity-75">
                  <?= htmlspecialchars($meta['descricao']) ?>
                </td>

                <td class="text-center pe-4">
                  <div class="d-flex justify-content-center gap-2">
                    <a href="pages/edit.php?codigo=<?= $meta['id'] ?>" class="btn btn-outline-warning btn-sm fw-bold rounded">Editar</a>
                    <a href="pages/delete.php?codigo=<?= $meta['id'] ?>" class="btn btn-outline-danger btn-sm fw-bold rounded">Deletar</a>
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

</body>

</html>