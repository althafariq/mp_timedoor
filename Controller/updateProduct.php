<?php 
include('../Config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];
  $product_name = $_POST['product_name'];
  $category_id = $_POST['category_id'];
  $price = $_POST['price'];
  $quantity = $_POST['quantity'];

  try {
    $stmt = $conn->prepare("UPDATE products SET product_name = :product_name, category_id = :category_id, price = :price, quantity = :quantity WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':product_name', $product_name);
    $stmt->bindParam(':category_id', $category_id);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->execute();

    header('Location: ../index.php');
    exit();
  } catch (Exception $e) {
    echo "Error updating record: " . $e->getMessage();
  }
}

$conn = null;
?>