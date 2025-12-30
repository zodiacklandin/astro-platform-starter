<?php
$file = __DIR__ . "/products.json";
$products = json_decode(file_get_contents($file), true);

$id = $_GET["id"] ?? null;

if ($id !== null && isset($products[$id])) {
    if (file_exists($products[$id]["image"])) {
        unlink($products[$id]["image"]);
    }
    array_splice($products, $id, 1);
}

file_put_contents($file, json_encode($products, JSON_PRETTY_PRINT));
header("Location: admin.php");
