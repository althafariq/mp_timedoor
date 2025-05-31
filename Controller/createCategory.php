<?php 
include('../Config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $category_name = $_POST['category_name'];

  try {
    // Cek apakah nama kategori sudah ada
    $checkStmt = $conn->prepare("SELECT COUNT(*) FROM categories WHERE category_name = :category_name");
    $checkStmt->bindParam(':category_name', $category_name);
    $checkStmt->execute();
    // Ambil jumlah hasil yang disimpan ke variable $count
    $count = $checkStmt->fetchColumn();

    if ($count > 0) {
      // Nama kategori sudah ada
      echo "Kategori dengan nama '$category_name' sudah ada. Silakan gunakan nama lain.";
    } else {
      // Insert jika belum ada
      $stmt = $conn->prepare("INSERT INTO categories (category_name) VALUES (:category_name)");
      $stmt->bindParam(':category_name', $category_name);
      $stmt->execute();

      header('Location: ../View/listAllCategory.php');
      exit();
    }
  } catch (Exception $e) {
    echo "Error: " . $e->getMessage();
  }
}

$conn = null;
?>
