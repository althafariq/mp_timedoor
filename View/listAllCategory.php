<?php 
include('../Config/db.php');

$sql = "SELECT * FROM categories";
$result = $conn->query($sql);

$categories = [];

if ($result->rowCount() > 0) {
  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $categories[] = $row;
  }
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>List all Category</title>
  <style>
    table{
      border-collapse: collapse;
      width: 30%;
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
  <h2>List all Category</h2>
  <a href="../index.php">Back to Product List</a>
  <br><br>
  <!-- add new category -->
  <a href="../View/createCategory.php">Add Category</a>
  <br><br>

  <table>
    <tr>
      <th>No</th>
      <th>Category Name</th>
      <th>Action</th>
    </tr>

    <!-- Show data with php and html -->
     <?php if (count($categories) > 0): ?>
      <?php $counter = 1; ?>
      <?php foreach ($categories as $category): ?>
        <tr>
          <td><?= $counter ?></td>
          <td><?= $category['category_name'] ?></td>
          <td>
            <a href="updateCategory.php?id=<?= $category['id'] ?>">Update</a>
            <a href="deleteCategory.php?id=<?= $category['id'] ?>">Delete</a>
          </td>
        </tr>
        <?php $counter++; ?>
      <?php endforeach; ?>
    <?php endif; ?>
  </table>
</body>
</html>