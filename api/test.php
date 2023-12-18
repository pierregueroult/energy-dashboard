<?php

if (!isset($_GET['department'])) {
    echo json_encode(array(
        'status' => false,
        'message' => 'Invalid request'
    ));
    exit;
}

$department = $_GET['department'];

require '../src/constants/deps.php';
require '../src/utils/getAllKeysFromArray.php';

if (!in_array($department, getAllKeysFromArray(DEPARTMENTS))) {
    echo json_encode(array(
        'status' => false,
        'message' => 'Invalid department'
    ));
    exit;
}

require '../src/constants/database.secret.php';
require '../src/utils/database.php';

$query = "SELECT * FROM $department;";

$result = $pdo->query($query);

if (!$result) {
    echo json_encode(array(
        'status' => false,
        'message' => 'Database query failed'
    ));
    exit;
}

$data = $result->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(array(
    'status' => true,
    'data' => $data
));

?>
