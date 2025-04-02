<?php
// Include the functions file to initialize the $pdo connection FOR THE VEGAN PAGE
include 'functions.php';

// Default sorting
$sort_option = isset($_GET['sort']) ? $_GET['sort'] : 'date_added_DESC';

// Define the SQL sorting logic
$sorting = [
    'date_added_DESC' => 'date_added DESC',
    'date_added_ASC' => 'date_added ASC',
    'title_ASC' => 'title ASC',
    'title_DESC' => 'title DESC',
    'price_ASC' => 'price ASC',
    'price_DESC' => 'price DESC'
];
$order_by = isset($sorting[$sort_option]) ? $sorting[$sort_option] : 'date_added DESC';

// The number of vegan products to show on each page
$num_products_on_each_page = 4;
// The current page - in the URL, will appear as vegan.php?p=1, vegan.php?p=2, etc...
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;

// Select vegan products ordered by the chosen sort option
$stmt = $pdo->prepare("SELECT * FROM products WHERE is_vegan = 1 ORDER BY $order_by LIMIT ?, ?");
$stmt->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
$stmt->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
$stmt->execute();
$vegan_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total_vegan_products = $pdo->query('SELECT COUNT(*) FROM products WHERE is_vegan = 1')->fetchColumn();
?>

<?=template_header('Vegan Products')?>

<div class="products content-wrapper">
    <h1>Produits Vegan</h1>
    <p><?=$total_vegan_products?> Produits Vegan</p>

    <!-- Sorting Dropdown -->
    <form method="GET" style="margin-bottom: 20px;">
        <input type="hidden" name="p" value="<?=$current_page?>">
        <label for="sort">Sort by:</label>
        <select name="sort" id="sort" onchange="this.form.submit()">
            <option value="date_added_DESC" <?= $sort_option == 'date_added_DESC' ? 'selected' : '' ?>>Newest First</option>
            <option value="date_added_ASC" <?= $sort_option == 'date_added_ASC' ? 'selected' : '' ?>>Oldest First</option>
            <option value="title_ASC" <?= $sort_option == 'title_ASC' ? 'selected' : '' ?>>Title A-Z</option>
            <option value="title_DESC" <?= $sort_option == 'title_DESC' ? 'selected' : '' ?>>Title Z-A</option>
            <option value="price_ASC" <?= $sort_option == 'price_ASC' ? 'selected' : '' ?>>Price Low-High</option>
            <option value="price_DESC" <?= $sort_option == 'price_DESC' ? 'selected' : '' ?>>Price High-Low</option>
        </select>
    </form>

    <div class="products-wrapper">
        <?php foreach ($vegan_products as $product): ?>
        <a href="index.php?page=product&id=<?=$product['id']?>" class="product">
            <img src="imgs/<?=$product['img']?>" width="200" height="200" alt="<?=$product['title']?>">
            <span class="name"><?=$product['title']?></span>
            <span class="price">
                <?=$product['price']?> RON
                <?php if ($product['rrp'] > 0): ?>
                <span class="rrp"><?=$product['rrp']?> RON</span>
                <?php endif; ?>
            </span>
        </a>
        <?php endforeach; ?>
    </div>

    <div class="buttons">
        <?php if ($current_page > 1): ?>
        <a href="vegan.php?p=<?=$current_page-1?>&sort=<?=$sort_option?>" class="btn">Prev</a>
        <?php endif; ?>
        <?php if ($total_vegan_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($vegan_products)): ?>
        <a href="vegan.php?p=<?=$current_page+1?>&sort=<?=$sort_option?>" class="btn">Next</a>
        <?php endif; ?>
    </div>
</div>

<?=template_footer()?>
