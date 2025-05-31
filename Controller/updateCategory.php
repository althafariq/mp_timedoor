<?php 
include('../Config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];
  $category_name = $_POST['category_name'];

  try {
    $stmt = $conn->prepare("UPDATE categories SET category_name = :category_name WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':category_name', $category_name);
    $stmt->execute();

    header('Location: ../View/listAllCategory.php');
    exit();
  } catch (Exception $e) {
    echo "Error updating record: " . $e->getMessage();
  }
}

$conn = null;
?>