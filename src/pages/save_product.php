<?php
$file = __DIR__ . "/products.json";
$products = json_decode(file_get_contents($file), true);
if (!is_array($products)) $products = [];

$uploadDir = "uploads/";
if (!is_dir($uploadDir)) mkdir($uploadDir);

$imagePath = "";
if (!empty($_FILES["image"]["name"])) {
    $ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
    $imagePath = $uploadDir . uniqid() . "." . $ext;
    move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
}

$products[] = [
    "name" => $_POST["name"],
    "price" => $_POST["price"],
    "category" => $_POST["category"],
    "batch" => $_POST["batch"],
    "image" => $imagePath,
    "link" => $_POST["link"]
];

file_put_contents($file, json_encode($products, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
header("Location: admin.php");
