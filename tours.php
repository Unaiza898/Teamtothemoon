<?php
// Check to make sure the id parameter is specified in the URL
if (isset($_GET['id'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT * FROM tours WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    // Fetch the tours from the database and return the result as an Array
    $tours = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the tours exists (array is not empty)
    if (!$tours) {
        // Simple error to display if the id for the tours doesn't exists (array is empty)
        exit('tours does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    exit('Product does not exist!');
}
?>




