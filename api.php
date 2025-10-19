<?php
include 'config.php';

$action = $_GET['action'] ?? '';

switch ($action) {
  case 'getProducts':
    $result = $conn->query("SELECT * FROM products ORDER BY id DESC");
    $data = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($data);
    break;

  case 'addProduct':
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $date = $_POST['date_added'];
    $stmt = $conn->prepare("INSERT INTO products (name, description, price, date_added) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $name, $description, $price, $date);
    $stmt->execute();
    echo "OK";
    break;

  case 'updateProduct':
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $date = $_POST['date_added'];
    $stmt = $conn->prepare("UPDATE products SET name=?, description=?, price=?, date_added=? WHERE id=?");
    $stmt->bind_param("ssdsi", $name, $description, $price, $date, $id);
    $stmt->execute();
    echo "OK";
    break;

  case 'deleteProduct':
    $id = $_POST['id'];
    $conn->query("DELETE FROM products WHERE id=$id");
    echo "OK";
    break;

  case 'addBug':
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $status = $_POST['status'] ?? 'open';
    $date = date('Y-m-d');
    $stmt = $conn->prepare("INSERT INTO bugs (title, description, status, date_reported) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $desc, $status, $date);
    $stmt->execute();
    echo "OK";
    break;
}
?>
