<?php
require_once '../config/database.php';

if (isset($_GET['codigo'])) {
  $idRecebido = $_GET['codigo'];

  try {
    $sql = "DELETE FROM metas WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $idRecebido);

    if ($stmt->execute()) {
      $_SESSION['mensagem'] = "Meta eliminada com sucesso! 🗑️";
      $_SESSION['tipo_alerta'] = "danger";
      header('Location: ../index.php');
      exit;
    }
  } catch (PDOException $e) {
    $_SESSION['mensagem'] = "Erro ao eliminar a meta: " . $e->getMessage();
    $_SESSION['tipo_alerta'] = "danger";
    header('Location: ../index.php');
    exit;
  }
}
