<?php 
include('../Config/db.php');

$id = $_GET['id'];

try {
  $stmt = $conn->prepare(
    "SELECT products.id, products.product_name, products.category_id, categories.category_name, products.price, products.quantity
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

  // Ambil semua kategori untuk dropdown
  $stmtCat = $conn->prepare("SELECT * FROM categories");
  $stmtCat->execute();
  $categories = $stmtCat->fetchAll(PDO::FETCH_ASSOC);

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
  <title>Update Product</title>
</head>
<body>
  <h2>Update Product</h2>
  <a href="../index.php">Back to Product List</a>
  <br><br>
  <?php if (count($row) > 0): ?>
    <form action="../Controller/updateProduct.php" method="POST">
      <input type="hidden" name="id" value="<?= $row['id'] ?>">
      
      <label for="product_name">Product Name:</label>
      <input type="text" id="product_name" name="product_name" value="<?= $row['product_name'] ?>" required>
      <br><br>

      <label for="category_id">Category:</label>
      <select id="category_id" name="category_id" required>
        <?php foreach ($categories as $category): ?>
          <option value="<?= $category['id'] ?>" <?= $category['id'] == $row['category_id'] ? 'selected' : '' ?>>
            <?= $category['category_name'] ?>
          </option>
        <?php endforeach; ?>
      </select>
      <br><br>

      <label for="price">Price:</label>
      <input type="number" id="price" name="price" value="<?= $row['price'] ?>" required>
      <br><br>
      <label for="quantity">Quantity:</label>
      <input type="number" id="quantity" name="quantity" value="<?= $row['quantity'] ?>" required>
      <br><br>
      <input type="submit" value="Update Product">
    </form>
    <?php else: echo "Product not found."; endif; ?>
</body>
</html>