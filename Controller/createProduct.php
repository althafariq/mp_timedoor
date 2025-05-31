<?php 
include('../Config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $product_name = $_POST['product_name'];
  $category_id = $_POST['category_id'];
  $price = $_POST['price'];
  $quantity = $_POST['quantity'];

  try {
    $stmt = $conn->prepare("INSERT INTO products (product_name, category_id ,price, quantity) VALUES (:product_name, :category_id, :price, :quantity)");
    $stmt->bindParam(':product_name', $product_name);
    $stmt->bindParam(':category_id', $category_id);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->execute();

    header('Location: ../index.php');
    exit();
  } catch (Exception $e) {
    echo "Error: " . $e->getMessage();
  }
}

$conn = null;
?>