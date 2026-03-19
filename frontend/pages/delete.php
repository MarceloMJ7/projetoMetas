<?php
require_once '../config/database.php';

if (isset($_GET['codigo'])) {
  $idRecebido = $_GET['codigo'];

  try {
    $sql = "DELETE FROM metas WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $idRecebido);

    if ($stmt->execute()) {
      header('Location: ../index.php');
      exit;
    }
  } catch (PDOException $e) {
    echo "Erro ao desmontar peça: " . $e->getMessage();
  }
}