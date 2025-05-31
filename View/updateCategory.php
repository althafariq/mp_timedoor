<?php 
include('../Config/db.php');

$id = $_GET['id'];

try {
  $stmt = $conn->prepare(
    "SELECT * FROM categories WHERE id = :id"
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
  <title>Update Category</title>
</head>
<body>
  <h2>Update Category</h2>
  <a href="../View/listAllCategory.php">Back to Category List</a>
  <br><br>
  <?php if (count($row) > 0): ?>
    <form action="../Controller/updateCategory.php" method="POST">
      <input type="hidden" name="id" value="<?= $row['id'] ?>">
      <label for="category_name">Category Name:</label>
      <input type="text" id="category_name" name="category_name" value="<?= $row['category_name'] ?>" required>
      <br><br>
      <input type="submit" value="Update Category">
    </form>
    <?php else: echo "Category not found."; endif; ?>
</body>
</html>