<?php
$file = __DIR__ . "/products.json";
$products = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
if (!is_array($products)) $products = [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>LITBUY | Admin Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Tailwind -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Fonts & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script>
tailwind.config = {
    theme: {
        extend: {
            fontFamily: { sans: ['Montserrat', 'sans-serif'] },
            colors: {
                gold: '#d4af37',
                darkbg: '#0f172a',
                cardbg: '#1e293b',
            }
        }
    }
}
</script>
</head>

<body class="bg-darkbg text-white font-sans min-h-screen">

<!-- HEADER -->
<header class="border-b border-slate-800 py-6 text-center">
    <h1 class="text-4xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-yellow-600">
        LITBUY ADMIN
    </h1>
    <p class="text-gray-400 text-sm mt-2">Product Management Panel</p>
</header>

<div class="container mx-auto px-6 py-12 max-w-6xl">

<!-- ADD PRODUCT -->
<div class="bg-cardbg border border-slate-700 rounded-2xl p-8 mb-12 shadow-xl">
    <h2 class="text-2xl font-bold text-gold mb-6 uppercase tracking-widest">
        Add New Product
    </h2>

    <form action="save_product.php" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <input name="name" placeholder="Product Name" required class="bg-slate-800 p-4 rounded-lg border border-slate-600 focus:border-gold outline-none">
        <input name="price" placeholder="Price ($)" required class="bg-slate-800 p-4 rounded-lg border border-slate-600 focus:border-gold outline-none">

        <select name="category" required class="bg-slate-800 p-4 rounded-lg border border-slate-600 focus:border-gold outline-none">
            <option value="">Select Category</option>
            <option>shoes</option>
            <option>hoodies</option>
            <option>t-shirts</option>
            <option>accessories</option>
        </select>

        <input name="batch" placeholder="Batch (optional)" class="bg-slate-800 p-4 rounded-lg border border-slate-600 focus:border-gold outline-none">
        <input type="file" name="image" accept="image/*" class="bg-slate-800 p-4 rounded-lg border border-slate-600">
        <input name="link" placeholder="Buy Link" required class="bg-slate-800 p-4 rounded-lg border border-slate-600 focus:border-gold outline-none">

        <button class="md:col-span-2 bg-gold text-black font-extrabold py-4 rounded-full hover:bg-yellow-400 transition uppercase tracking-widest">
            Save Product
        </button>
    </form>
</div>

<!-- PRODUCT LIST -->
<div class="bg-cardbg border border-slate-700 rounded-2xl p-8 shadow-xl">
    <h2 class="text-2xl font-bold text-gold mb-6 uppercase tracking-widest">
        Product List
    </h2>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-gray-400 uppercase tracking-wider border-b border-slate-700">
                    <th class="py-3">Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th class="text-right">Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $i => $p): ?>
                <tr class="border-b border-slate-800 hover:bg-slate-800/40 transition">
                    <td class="py-3">
                        <?php if (!empty($p['image'])): ?>
                            <img src="<?= htmlspecialchars($p['image']) ?>" class="h-12 rounded-lg">
                        <?php else: ?>
                            <div class="h-12 w-12 bg-slate-700 rounded-lg flex items-center justify-center text-xs text-gray-500">NO IMG</div>
                        <?php endif; ?>
                    </td>
                    <td class="font-semibold"><?= htmlspecialchars($p['name']) ?></td>
                    <td class="uppercase text-gray-400"><?= htmlspecialchars($p['category']) ?></td>
                    <td class="text-gold font-bold">$<?= htmlspecialchars($p['price']) ?></td>
                    <td class="text-right">
                        <a href="delete_product.php?id=<?= $i ?>" class="text-red-500 hover:text-red-400 font-bold">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</div>

<footer class="text-center text-xs text-gray-500 py-8 border-t border-slate-800 mt-16">
    © 2025 LITBUY ADMIN PANEL
</footer>

</body>
</html>
