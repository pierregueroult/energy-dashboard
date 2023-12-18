<?php

if (!isset($_GET['department'])) {
    echo json_encode(array(
        'status' => false,
        'message' => 'Invalid request'
    ));
    exit;
}

if (!isset($_GET['year'])) {
    echo json_encode(array(
        'status' => false,
        'message' => 'Invalid request'
    ));
    exit;
}

$department = $_GET['department'];
$year = $_GET['year'];

require '../../src/constants/deps.php';
require '../../src/utils/getAllKeysFromArray.php';
require '../../src/constants/years.php';

if (!in_array($department, getAllKeysFromArray(DEPARTMENTS))) {
    echo json_encode(array(
        'status' => false,
        'message' => 'Invalid department'
    ));
    exit;
}

if (!in_array($year, YEARS)) {
    echo json_encode(array(
        'status' => false,
        'message' => 'Year out of range'
    ));
    exit;
}

require '../../src/constants/database.secret.php';
require '../../src/utils/database.php';

$query = 'SELECT DISTINCT `Opérateur`, `Consommation totale (MWh)` as "Somme Conso" FROM `' . PREFIX . $department . '` WHERE `Année` = ' . $year . ' ORDER BY `Consommation totale (MWh)` DESC;';

$result = $pdo->query($query);

if (!$result) {
    echo json_encode(array(
        'status' => false,
        'message' => 'Database query failed'
    ));
    exit;
}

$data = $result->fetchAll(PDO::FETCH_ASSOC);

// round the consumption
foreach ($data as $key => $value) {
    $data[$key]['Somme Conso'] = round($value['Somme Conso']);
}

echo json_encode(array(
    'status' => true,
    'data' => $data
));

exit;

?>