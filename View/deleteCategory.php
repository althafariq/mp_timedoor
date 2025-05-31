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
  <title>Delete Category</title>
</head>
<body>
  <h1>Delete Category</h1>
  <?php if (count($row) > 0): ?>
  <form action="../Controller/deleteCategory.php" method="GET">
    <input type="hidden" name="id" value="<?= $row['id']; ?>">
    <p>Are you sure you want to delete category <span><b><?php echo $row['category_name']; ?></b>?</span></p>
    <button type="submit">Delete</button>
    <a href="../View/listAllCategory.php">Cancel</a>
  </form>
  <?php else: ?>
  <p>Category not found.</p>
  <?php endif; ?>
</body>
</html>