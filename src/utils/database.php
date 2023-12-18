<?php

// creation of a pdo instance with database credentials secret

try {
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(array(
        'status' => false,
        'message' => 'Database connection failed'
    ));
    exit;
}
?>