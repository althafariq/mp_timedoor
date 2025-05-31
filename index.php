<?php 
include('Config/db.php');
$sql = "SELECT products.id, products.product_name, categories.category_name, products.price, products.quantity
        FROM products
        JOIN categories ON products.category_id = categories.id";
$result = $conn->query($sql);

$products = [];

if ($result->rowCount() > 0) {
  // output data of each row
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $products[] = $row;
  }
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product List</title>
  <style>
    table{
      border-collapse: collapse;
      width: 100%;
    }
    th, td{
      padding: 8px;
      text-align: left;
      border: 1px solid #ddd;
    }
    tr:hover{
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>
  <h2>Product List</h2>
  <a href="View/listAllCategory.php">See All Category</a>
  <br><br>
  <a href="View/createProduct.php">Add Product</a>
  <br><br>

  <table>
    <tr>
      <th>No</th>
      <th>Product Name</th>
      <th>Category</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Action</th>
    </tr>

    <!-- Show data with php and html -->
     <?php if (count($products) > 0): ?>
      <?php $counter = 1; ?>
      <?php foreach ($products as $product): ?>
        <tr>
          <td><?= $counter ?></td>
          <td><?= $product['product_name'] ?></td>
          <td><?= $product['category_name'] ?></td>
          <td><?= $product['price'] ?></td>
          <td><?= $product['quantity'] ?></td>
          <td>
            <a href="View/detailProduct.php?id=<?= $product['id'] ?>">View</a>
            <a href="View/updateProduct.php?id=<?= $product['id'] ?>">Update</a>
            <a href="View/deleteProduct.php?id=<?= $product['id'] ?>">Delete</a>
          </td>
        </tr>
        <?php $counter++; ?>
      <?php endforeach; ?>
     <?php else: ?>
      <tr>
        <td colspan="5">0 result</td>
      </tr>
     <?php endif; ?>
  </table>
</body>
</html>