<?php 
include('../Config/db.php');

$id = $_GET['id'];

try {
  $stmt = $conn->prepare("DELETE FROM products WHERE id = :id");
  $stmt->bindParam(':id', $id);
  $stmt->execute();

  header('Location: ../index.php');
  exit();
} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
}

$conn = null;
?>