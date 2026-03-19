<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nomeMeta = $_POST['titulo'];
  $prazoMeta = $_POST['prazo'];
  $descricaoMeta = $_POST['descricao'];
  //conexão com banco
  require_once '../config/database.php';
  try {
    //Segurança
    $sql = "INSERT INTO metas (titulo, prazo, descricao) VALUES (:titulo, :prazo, :descricao)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':titulo', $nomeMeta);
    $stmt->bindParam(':prazo', $prazoMeta);
    $stmt->bindParam(':descricao', $descricaoMeta);

    if ($stmt->execute()) { //Se a execução der certo avisamos o user
      echo "<script>alert('Dados enviados com sucesso'); window.location.href='../index.php';</script>";
    }
  } catch (PDOException $e) {
    // Se alguma engrenagem travar no banco de dados, capturamos o erro aqui.
    echo "Erro no sistema: " . $e->getMessage();
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
            <h4 class="mb-0 text-white">Nova Meta Pessoal</h4>
          </div>

          <div class="card-body p-4">
            <form action="" method="POST">

              <div class="mb-3">
                <label for="titulo" class="form-label fw-bold text-light">O que você pretende alcançar?</label>
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

</body>

</html>