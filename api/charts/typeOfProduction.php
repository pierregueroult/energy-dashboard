<?php

if (!isset($_GET['department'])) {
    echo json_encode(array(
        'status' => false,
        'message' => 'Invalid request'
    ));
    exit;
}

$department = $_GET['department'];

require '../../src/constants/deps.php';
require '../../src/utils/getAllKeysFromArray.php';

if (!in_array($department, getAllKeysFromArray(DEPARTMENTS))) {
    echo json_encode(array(
        'status' => false,
        'message' => 'Invalid department'
    ));
    exit;
}

$region = DEPARTMENTS[$department]['region'];

require '../../src/constants/database.secret.php';
require '../../src/utils/database.php';

$query = 'SELECT SUM(`Thermique (MW)`) as `Thermique`,SUM(`Nucléaire (MW)`) as `Nucléaire`,SUM(`Eolien (MW)`) as `Éolien`,SUM(`Solaire (MW)`) as `Solaire`,SUM(`Hydraulique (MW)`) as `Hydraulique`,SUM(`Bioénergies (MW)`) as `Bioénergies`,SUM(`Ech. physiques (MW)`) as `Ech. Physiques` FROM ' . $region . " WHERE `Date` LIKE '2021%';";

$result = $pdo->query($query);

if (!$result) {
    echo json_encode(array(
        'status' => false,
        'message' => 'Database query failed'
    ));
    exit;
}

$data = $result->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    echo json_encode(array(
        'status' => false,
        'message' => 'No data found'
    ));
    exit;
}

foreach ($data as $key => $value) {
    $data[$key] = floatval($value);
}

arsort($data);

echo json_encode(array(
    'status' => true,
    'data' => $data
));

?>