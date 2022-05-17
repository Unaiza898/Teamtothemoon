<?php
// If the user clicked the add to cart button on the tours page we can check for the form data
if (isset($_POST['tours_id'], $_POST['quantity']) && is_numeric($_POST['tours_id']) && is_numeric($_POST['quantity'])) {
    // Set the post variables so we easily identify them, also make sure they are integer
    $tours_id = (int)$_POST['tours_id'];
    $quantity = (int)$_POST['quantity'];
    // Prepare the SQL statement, we basically are checking if the tours exists in our databaser
    $stmt = $pdo->prepare('SELECT * FROM tours WHERE id = ?');
    $stmt->execute([$_POST['tours_id']]);
    // Fetch the tours from the database and return the result as an Array
    $tours = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the tours exists (array is not empty)
    if ($tours && $quantity > 0) {
        // tours exists in database, now we can create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($tours_id, $_SESSION['cart'])) {
                // tours exists in cart so just update the quanity
                $_SESSION['cart'][$tours_id] += $quantity;
            } else {
                // tours is not in cart so add it
                $_SESSION['cart'][$tours_id] = $quantity;
            }
        } else {
            // There are no tourss in cart, this will add the first tours to cart
            $_SESSION['cart'] = array($tours_id => $quantity);
        }
    }
    // Prevent form resubmission...
    header('location: routing.php?page=cart');
    exit;
}