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
  <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-dark text-light p-5">
  <div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>🎯 Minhas Metas</h2>
      <a href="pages/create.php" class="btn btn-success fw-bold">+ Nova Meta</a>
    </div>

    <div class="table-responsive">
      <table class="table table-dark table-hover table-bordered border-secondary">
        <thead>
          <tr>
            <th>Título da Meta</th>
            <th>Prazo Limite</th>
            <th>Detalhes</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>

          <?php foreach ($minhasMetas as $meta): ?>

          <tr>
            <td> <?php echo $meta['titulo']; ?> </td>

            <td> <?php echo $meta['prazo']
                    ?>; </td>

            <td> <?php echo $meta['descricao'] ?>; </td>

            <td><a href="delete.php" class="btn btn-danger btn-sm">Deletar</a></td>
          </tr>

          <?php endforeach; ?>

        </tbody>
      </table>
    </div>

  </div>

</body>

</html>