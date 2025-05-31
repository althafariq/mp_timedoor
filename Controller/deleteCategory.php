<?php 
include('../Config/db.php');

$id = $_GET['id'];

try {
  // Cek apakah ada produk yang terkait dengan kategori ini
  $checkStmt = $conn->prepare("SELECT COUNT(*) FROM products WHERE category_id = :id");
  // Count artinya jumlah/seberapa banyak produk dengan id tertentu
  
  $checkStmt->bindParam(':id', $id);
  $checkStmt->execute();
  $productCount = $checkStmt->fetchColumn();

  if ($productCount > 0) {
    // Ada produk yang terkait, batalkan penghapusan
    echo "Kategori tidak dapat dihapus karena masih digunakan oleh $productCount produk.";
    echo "<br><button><a href='../View/listAllCategory.php'>Cancel</a></button>";
  } else {
    // Tidak ada produk terkait, lanjutkan hapus
    $stmt = $conn->prepare("DELETE FROM categories WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header('Location: ../View/listAllCategory.php');
    exit();
  }

} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
}

$conn = null;
?>
