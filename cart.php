<?php
// If the user clicked the add to cart button on the product page we can check for the form data
// If the user clicked the add-to-cart button
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];

    // Check if the product exists in the database
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product && $quantity > 0) {
        // Check if the product has enough stock
        if ($product['quantity'] >= $quantity) {
            // Add to cart session
            if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                if (array_key_exists($product_id, $_SESSION['cart'])) {
                    $_SESSION['cart'][$product_id] += $quantity;
                } else {
                    $_SESSION['cart'][$product_id] = $quantity;
                }
            } else {
                $_SESSION['cart'] = array($product_id => $quantity);
            }

            // Reduce the quantity in the database
            $stmt = $pdo->prepare('UPDATE products SET quantity = quantity - ? WHERE id = ?');
            $stmt->execute([$quantity, $product_id]);

        } else {
            // Insufficient stock
            echo '<script>alert("Not enough stock available!");</script>';
            header('location: index.php?page=product&id=' . $product_id);
            exit;
        }
    }

    // Redirect to cart page after adding
    header('location: index.php?page=cart');
    exit;
}
// Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$_GET['remove']]);
}
// Update product quantities in cart if the user clicks the "Update" button on the shopping cart page
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'quantity') !== false && is_numeric($value)) {
            $id = str_replace('quantity-', '', $key);
            $new_quantity = (int)$value;

            // Validate the product ID
            if (is_numeric($id)) {
                // Fetch the current stock from the database
                $stmt = $pdo->prepare('SELECT quantity FROM products WHERE id = ?');
                $stmt->execute([$id]);
                $product = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($product) {
                    $current_stock = (int)$product['quantity'];

                    // Check if enough stock is available
                    if ($new_quantity <= $current_stock) {
                        // Reduce stock in the database
                        $stmt = $pdo->prepare('UPDATE products SET quantity = quantity - ? WHERE id = ?');
                        $stmt->execute([$new_quantity, $id]);

                        // Update the session with the new quantity
                        $_SESSION['cart'][$id] = $new_quantity;
                    } else {
                        echo '<script>alert("Not enough stock available!");</script>';
                    }
                    if ($new_quantity > $current_stock) {
                        echo '<script>alert("Insufficient stock available for this product!");</script>';
                        header('Location: index.php?page=cart');
                        exit;
                    }
                }
            }
        }
    }

    // Redirect to prevent resubmission
    header('Location: index.php?page=cart');
    exit;
}
// Send the user to the place order page if they click the Place Order button, also the cart should not be empty
if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    header('Location: index.php?page=placeorder');
    exit;
}
// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
// If there are products in cart
if ($products_in_cart) {
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['id']];
    }
}
?>
<?=template_header('Panier')?>

<div class="cart content-wrapper">
    <h1>Panier</h1>
    <form action="index.php?page=cart" method="post">
        <table>
            <thead>
                <tr>
                    <td colspan="2">Produit</td>
                    <td>Prix</td>
                    <td>Quantité</td>
                    <td>Totale</td>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;">Vous n'avez aucun produit ajouté dans votre panier</td>
                </tr>
                <?php else: ?>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td class="img">
                        <a href="index.php?page=product&id=<?=$product['id']?>">
                            <img src="imgs/<?=$product['img']?>" width="50" height="50" alt="<?=$product['title']?>">
                        </a>
                    </td>
                    <td>
                        <a href="index.php?page=product&id=<?=$product['id']?>"><?=$product['title']?></a>
                        <br>
                        <a href="index.php?page=cart&remove=<?=$product['id']?>" class="remove">Retirer</a>
                    </td>
                    <td class="price"><?=$product['price']?> RON</td>
                    <td class="quantity">
                        <input 
                        type="number" 
                        name="quantity-<?=$product['id']?>" 
                        value="<?=$products_in_cart[$product['id']]?>" 
                        min="1" 
                        max="<?=$product['quantity']?>" 
                        placeholder="Quantity" 
                        required
                        <?= $product['quantity'] <= 0 ? 'disabled' : '' ?>>
                    </td>
                    <td class="price"><?=$product['price'] * $products_in_cart[$product['id']]?> RON</td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="subtotal">
            <span class="text">Subtotal</span>
            <span class="price"><?=$subtotal?> RON</span>
        </div>
        <div class="buttons">
            <input type="submit" value="Update" name="update">
            <input type="submit" value="Passer la commande" name="placeorder">
        </div>
    </form>
</div>

<?=template_footer()?>