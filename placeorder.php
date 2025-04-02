<?=template_header('Place Order')?>

<style>
    /* Center the form and make it vertical */
    form {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 15px; /* Space between form elements */
        margin: 20px 0;
        width: 300px; /* Adjust width */
    }

    label {
        font-size: 16px;
        font-weight: bold;
    }

    input[type="text"], input[type="tel"], input[type="email"] {
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 100%;
        box-sizing: border-box;
    }

    input[type="submit"] {
        padding: 10px;
        font-size: 16px;
        color: #fff;
        background-color: #4CAF50; /* Green button */
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
    }

    input[type="submit"]:hover {
        background-color: #45a049; /* Darker green on hover */
    }

    /* Style for the confirmation text */
    .confirmation {
        margin-top: 20px;
        font-size: 16px;
        color: green;
        font-weight: bold;
    }
</style>

<div class="placeorder content-wrapper">
    <h1>Votre commande a été passée</h1>
    <p>Merci d'avoir commandé chez nous ! Nous vous contacterons par email avec les détails de votre commande.</p>

    <!-- Add the form -->
    <form action="" method="post">
        <label for="name">Nom:</label>
        <input type="text" id="name" name="name" placeholder="Votre nom complet" required>

        <label for="phone">Numéro de téléphone:</label>
        <input type="tel" id="phone" name="phone" placeholder="Votre numéro de téléphone" required>

        <label for="email">Adresse e-mail:</label>
        <input type="email" id="email" name="email" placeholder="Votre email" required>

        <input type="submit" name="submit" value="Envoyer">
    </form>

    <?php
    date_default_timezone_set('Europe/Bucharest'); // Set your local timezone
    // Check if form is submitted
    if (isset($_POST['submit'])) {
        // Retrieve form inputs
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $order_date = date('Y-m-d H:i:s'); // Current date and time

        // Insert into the database
        $stmt = $pdo->prepare('INSERT INTO buyers (name, phone_number, email, order_date) VALUES (?, ?, ?, ?)');
        $stmt->execute([$name, $phone, $email, $order_date]);

        // Confirmation message
        echo '<p class="confirmation">Vos informations ont été enregistrées avec succès !</p>';
    }
    ?>
</div>

<?=template_footer()?>
