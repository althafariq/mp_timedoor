<?php 
include('../Config/db.php');

$id = $_GET['id'];

try {
  $stmt = $conn->prepare(
    "SELECT products.id, products.product_name, categories.category_name, products.price, products.quantity
    FROM products
    JOIN categories ON products.category_id = categories.id
    WHERE products.id = :id"
  );
  $stmt->bindParam(':id', $id);
  $stmt->execute();

  $row = [];

  if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  }
} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete Product</title>
</head>
<body>
  <h2>Delete Product</h2>
  <a href="../index.php">Back to Product List</a>
  <br><br>
  <?php if (count($row) > 0): ?>
    <p><b>Are you sure you want to delete the following product?</b></p> 
    <table>
      <tr>
        <td>ID:</td>
        <td><?= $row['id'] ?></td>
      </tr>
      <tr>
        <td>Product Name:</td>
        <td><?= $row['product_name'] ?></td>
      </tr>
      <tr>
        <td>Category:</td>
        <td><?= $row['category_name'] ?></td>
      </tr>
      <tr>
        <td>Price:</td>
        <td><?= $row['price'] ?></td>
      </tr>
      <tr>
        <td>Quantity:</td>
        <td><?= $row['quantity'] ?></td>
      </tr>
    </table>

    <form action="../Controller/deleteProduct.php" method="GET">
      <input type="hidden" name="id" value="<?= $row['id'] ?>">
      <input type="submit" value="Delete Product">
    </form>
  <?php else :  ?>
    <p>Product not found.</p>
  <?php endif; ?>
</body>
</html>