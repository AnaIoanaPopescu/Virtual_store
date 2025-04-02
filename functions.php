<?php
function pdo_connect_mysql() {
    // Update the details below with your MySQL details
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'shoppingcart';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}
// Initialize $pdo
$pdo = pdo_connect_mysql();
// Template header, feel free to customize this
function template_header($title) {
    // Start the session if it hasn't been started yet
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    // Get the number of items in the shopping cart, which will be displayed in the header.
$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="animation.css">
        <link rel="stylesheet" href="style2.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <style>
            header {
                border-bottom: 2px solid #bf8040; /* Change the line color */
                width: 100%; /* Ensure it spans the full width */
            }
            main .recentlyadded h2 {
                border-bottom: 2px solid #bf8040; /* Change the line color */
                width: 100%; /* Ensure full width */
                padding-bottom: 10px; /* Optional spacing for aesthetics */
            }
        </style>
	</head>
	<body style="background-color: white">
        <header style="border-bottom: 2px solid #bf8040; width: 100%;">
            <div class="content-wrapper">
                <h1>Offrez-vous des chocolats fabriqués avec passion et amour &#128151</h1>
                <nav>
                    <a href="index.php">Home</a>
                    <a href="index.php?page=products">Produits</a>
                    <a href="vegan.php?page=products">Vegan</a>
                    <a href="chocolate_animation.php?page=products">Animation</a>
                </nav>
                <div class="link-icons">
                    <a href="index.php?page=cart">
						<img src="imgs/logo_for_shopping_bascket.jpg" alt="Shopping Cart Logo" width="80" height="80">
                        <span>$num_items_in_cart</span>
					</a>
                </div>
            </div>
        </header>
        <main>
EOT;
}
// Template footer
function template_footer() {
$year = date('Y');
echo <<<EOT
        </main>
        <footer style="border-top: 2px solid #bf8040; width: 100%;">
            <div class="content-wrapper">
                <p>&copy; $year, Délices Chocolatés. Fait avec ♥ pour tous les amoureux du chocolat. Les moments gourmands commencent ici!</p>
            </div>
        </footer>
    </body>
</html>
EOT;
}
?>