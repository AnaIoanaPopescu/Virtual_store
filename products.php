<?php

// The amounts of products to show on each page for the NORMAL CHOCOLATE
$num_products_on_each_page = 4;
// The current page - in the URL, will appear as index.php?page=products&p=1, index.php?page=products&p=2, etc...
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
// Sorting option from the dropdown
$sort_option = isset($_GET['sort']) ? $_GET['sort'] : 'date_added_DESC';

// Define sorting options
$sorting_options = [
    'date_added_DESC' => 'date_added DESC',
    'date_added_ASC' => 'date_added ASC',
    'title_ASC' => 'title ASC',
    'title_DESC' => 'title DESC',
    'price_ASC' => 'price ASC',
    'price_DESC' => 'price DESC'
];
$order_by = isset($sorting_options[$sort_option]) ? $sorting_options[$sort_option] : 'date_added DESC';

// Select products ordered by the selected option, filtering for non-vegan products
$stmt = $pdo->prepare("SELECT * FROM products WHERE is_vegan = 0 ORDER BY $order_by LIMIT ?, ?");
$stmt->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
$stmt->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the products from the database and return the result as an Array
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of non-vegan products
$total_products = $pdo->query('SELECT COUNT(*) FROM products WHERE is_vegan = 0')->fetchColumn();
?>
<?=template_header('Produits')?>

<div class="products content-wrapper">
    <h1>Produits Non-Vegan</h1>
    <p><?=$total_products?> Produits</p>

    <!-- Sorting Dropdown -->
    <form method="GET" style="margin-bottom: 20px;">
        <input type="hidden" name="page" value="products">
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
        <?php foreach ($products as $product): ?>
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
        <a href="index.php?page=products&p=<?=$current_page-1?>&sort=<?=$sort_option?>" style="display: inline-block; padding: 10px 15px; color: white; text-decoration: none; border-radius: 5px; background-color: #cc9966;">Prev</a>
        <?php endif; ?>
        <?php if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($products)): ?>
        <a href="index.php?page=products&p=<?=$current_page+1?>&sort=<?=$sort_option?>" style="display: inline-block; padding: 10px 15px; color: white; text-decoration: none; border-radius: 5px; background-color: #cc9966;">Next</a>
        <?php endif; ?>
    </div>
</div>

<?=template_footer()?>
