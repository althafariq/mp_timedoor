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
  <title>Create Category</title>
</head>
<body>
  <h2>Create Category</h2>
  <a href="../index.php">Back to Category List</a>
  <br><br>

  <form action="../Controller/createCategory.php" method="POST">
    <label for="category_name">Category Name:</label>
    <input type="text" id="category_name" name="category_name" required>
    <br><br>
    <input type="submit" value="Create Category">
  </form>
</body>
</html>